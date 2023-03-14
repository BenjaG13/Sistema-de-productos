<?php
require("main.php");

$id_del = limpiar_cadena($_GET['user_del']);

$conex = conexion();
$check_user = $conex->query("SELECT usuario_id FROM usuario WHERE usuario_id= $id_del");




if($check_user->rowCount() == 1){

    $check_product = $conex->query("SELECT usuario_id FROM producto WHERE usuario_id= $id_del");
    if($check_product->rowCount() < 1){

        $check_user = $conex->prepare("DELETE FROM usuario WHERE usuario_id = :id");
        $check_user->execute(["id"=>$id_del]);

        if($check_user->rowCount() == 1){
            echo '
                <div class="exito">
                    <div class="exito_text">
                        <strong>USUARIO ELIMINADO</strong> <br>
                        <p>el usuario se elimino correctamente</p>
                    </div>
                </div>
             ';
             header("Location: index.php?vista=lista_user");
        }

    }else{
        echo '
        <div class="error">
            <div class="error_text">
                <strong>A ocurrido un error</strong> <br>
                <p>no es posible eliminar al usuario seleccionado ya que tiene productos registrados </p>
            </div>
        </div>
        ';
    }
    $conex = null;

}else{
    echo '
        <div class="error">
            <div class="error_text">
                <strong>A ocurrido un error</strong> <br>
                <p>El usuario seleccionado no existe</p>
            </div>
        </div>
        ';
}
$conex = null;