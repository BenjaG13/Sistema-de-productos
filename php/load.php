<?php



require 'main.php';
$conn = conexion();
/* Un arreglo de las columnas a mostrar en la tabla */
$columns = ['usuario_id','usuario_nombre', 'usuario_apellido', 'usuario_email', 'usuario_usuario'];

/* Nombre de la tabla */
$table = "usuario";

$id = 'usuario_id';

$campo = isset($_POST['campo']) ? limpiar_cadena(($_POST['campo'])) : null;


/* Filtrado */
$where = '';

if ($campo != null) {
    $where = "WHERE (";

    $cont = count($columns);
    for ($i = 0; $i < $cont; $i++) {
        $where .= $columns[$i] . " LIKE '%" . $campo . "%' OR ";
    }
    $where = substr_replace($where, "", -3);
    $where .= ")";
}

/* Limit */
$limit = isset($_POST['registros']) ? limpiar_cadena(($_POST['registros'])) : 10;
$pagina = isset($_POST['pagina']) ? limpiar_cadena(($_POST['pagina'])) : 0;

if (!$pagina) {
    $inicio = 0;
    $pagina = 1;
} else {
    $inicio = ($pagina - 1) * $limit;
}

$sLimit = "LIMIT $inicio , $limit";

/**
 * Ordenamiento
 */

 $sOrder = "";
 if(isset($_POST['orderCol'])){
    $orderCol = $_POST['orderCol'];
    $oderType = isset($_POST['orderType']) ? $_POST['orderType'] : 'asc';
    
    $sOrder = "ORDER BY ". $columns[intval($orderCol)] . ' ' . $oderType;
 }


/* Consulta */
$sql = "SELECT SQL_CALC_FOUND_ROWS " . implode(", ", $columns) . "
FROM $table
$where
$sOrder
$sLimit";
$stmt = $conn->prepare($sql);
$stmt->execute();
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
$num_rows = $stmt->rowCount();

/* Consulta para total de registro filtrados */
$sqlFiltro = "SELECT FOUND_ROWS()";
$stmtFiltro = $conn->prepare($sqlFiltro);
$stmtFiltro->execute();
$row_filtro = $stmtFiltro->fetch(PDO::FETCH_NUM);
$totalFiltro = $row_filtro[0];

/* Consulta para total de registro filtrados */
$sqlTotal = "SELECT count($id) FROM $table ";
$stmtTotal = $conn->prepare($sqlTotal);
$stmtTotal->execute();
$row_total = $stmtTotal->fetch(PDO::FETCH_NUM);
$totalRegistros = $row_total[0];

/* Mostrado resultados */
$output = [];
$output['totalRegistros'] = $totalRegistros;
$output['totalFiltro'] = $totalFiltro;
$output['data'] = '';
$output['paginacion'] = '';

if ($num_rows > 0) {
    foreach ($resultado as $row) {
        $output['data'] .= '<tr>';
        $output['data'] .= '<td>' . $row['usuario_id'] . '</td>';
        $output['data'] .= '<td>' . $row['usuario_nombre'] . '</td>';
        $output['data'] .= '<td>' . $row['usuario_apellido'] . '</td>';
        $output['data'] .= '<td>' . $row['usuario_usuario'] . '</td>';
        $output['data'] .= '<td>' . $row['usuario_email'] . '</td>';
        $output['data'] .= '<td><a class="user_edit" href="index.php?vista=user_update&user_edit=' . $row['usuario_id'] . '">Editar</a></td>';
        $output['data'] .= "<td ><a class='user_delete' href='index.php?vista=lista_user_acpDEL&user_del=" . $row['usuario_id'] . "'>Eliminar</a></td>";
        $output['data'] .= '</tr>';
    }
} else {
    $output['data'] .= '<tr>';
    $output['data'] .= '<td colspan="7">Sin resultados</td>';
    $output['data'] .= '</tr>';
}

if ($output['totalRegistros'] > 0) {
    $totalPaginas = ceil($output['totalRegistros'] / $limit);

 
    $output['paginacion'] .= '<div class="paginador">';

    $numeroInicio = 1;

    if(($pagina - 4) > 1){
        $numeroInicio = $pagina - 4;
    }

    $numeroFin = $numeroInicio + 9;

    if($numeroFin > $totalPaginas){
        $numeroFin = $totalPaginas;
    }

    for ($i = $numeroInicio; $i <= $numeroFin; $i++) {
        if ($pagina == $i) {
            $output['paginacion'] .= '<a class="active" href="#">' . $i . '</a>';
        } else {
            $output['paginacion'] .= '<a href="#" onclick="nextPage(' . $i . ')">' . $i . '</a>';
        }
    }

    $output['paginacion'] .= '</div>';
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);
$conn = null;