<?php
    $modulo_buscador = $_POST['modulo_buscador'];
    
    $modulos = ['usuario','categoria','producto'];

    if(in_array($modulo_buscador,$modulos)){

        $modulos = $_POST['modulo_buscador'];
        
        $modulo_url = [
            'usuario' => 'user_search',
            'categoria' => 'category_user',
            'producto' => 'product_search'
        ];
        $modulo_url = $modulo_url[$modulo_buscador];

        $modulo_buscador = "busqueda_".$modulo_buscador;

        if(isset($_POST['text_buscar'])){
            echo "entre al txt";

            $txt = limpiar_cadena($_POST['text_buscar']);
            
            // inicciar busqueda
            if(($txt == "") || (verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}",$txt) )){
                echo '
                    <div class="error">
                        <div class="error_text">
                            <strong>A ocurrido un error</strong> <br>
                            <p>Ingrese una busqueda valida</p>
                        </div>
                    </div>
                ';
            }else{
                $_SESSION['modulo_buscador'];
                if(headers_sent()){
                    echo"<script>window.location.href='index.php?vista=".$modulo_url."'</script>";
                    exit();
                }else{
                    echo "sesiion mod";
                    header("Location: index.php?vista=".$modulo_url,true,303);
                    exit();
                }
            }
        }

        // eliminar busqueda
        if(isset($_POST['eliminar_buscador'])){
            unset($_SESSION['modulo_buscador']);
            header("Location: index.php?vista=".$modulo_url,true,303);
            exit();
        }

    }else{
        echo '
        <div class="error">
            <div class="error_text">
                <strong>A ocurrido un error</strong> <br>
                <p>No fue posible realizar la peticion</p>
            </div>
        </div>
    ';
    }
