<?php

$usuario =limpiar_cadena($_POST['user']);
$contraseña = limpiar_cadena($_POST['pass']);

if (verificar_datos("[a-zA-Z0-9]{4,20}",$usuario)){
    echo '
            <div class="error">
                <div class="error_text">
                    <strong>A ocurrido un error</strong> <br>
                    <p>EL USUARIO no coincide con el formato solicitado</p>
                </div>
            </div>
    ';
    exit();
}

if (verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$contraseña)) {
    echo '
            <div class="error">
                <div class="error_text">
                    <strong>A ocurrido un error</strong> <br>
                    <p>La CONTRASEÑA no coincide con el formato solicitado</p>
                </div>
            </div>
        ';
        exit();
}

$check_user = conexion();
$check_user = $check_user->query("SELECT * FROM usuario WHERE usuario_usuario = '$usuario'");
if ($check_user->rowCount() == 1){
    $check_user = $check_user->fetch();

    if(($check_user['usuario_usuario'] == $usuario) && (password_verify($contraseña,$check_user['usuario_clave']))){
       
        $_SESSION['id'] = $check_user['usuario_id'];
        $_SESSION['nombre'] = $check_user['usuario_nombre'];
        $_SESSION['apellido'] = $check_user['usuario_apellido'];
        $_SESSION['email'] = $check_user['usuario_email'];
        $_SESSION['usuario'] = $check_user['usuario_usuario'];

        if(headers_sent()){
            echo"<script>window.location.href='index.php?vista=home'</script>";
        }else{
            header("location: index.php?vista=home ");
        }
    }else{
        echo '
            <div class="error">
                <div class="error_text">
                    <strong>A ocurrido un error</strong> <br>
                    <p>usuario o contraseña incorrectos</p>
                </div>
            </div>
        ';
        exit();
    }
}else{
    echo '
        <div class="error">
            <div class="error_text">
                <strong>A ocurrido un error</strong> <br>
                <p>usuario o contraseña incorrectos</p>
            </div>
        </div>
    ';
    exit();
}
$check_user=null;


