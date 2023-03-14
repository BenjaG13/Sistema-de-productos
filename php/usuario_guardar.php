<?php
require_once("main.php");

$nombre = limpiar_cadena($_POST['usuario_nombre']);
$apellido = limpiar_cadena($_POST['usuario_apellido']);

$usuario = limpiar_cadena($_POST['usuario_usuario']);
$email = limpiar_cadena($_POST['usuario_email']);

$contra1 = limpiar_cadena($_POST['usuario_contra1']);
$contra2 = limpiar_cadena($_POST['usuario_contra2']);


if($nombre=="" || $apellido=="" || $usuario=="" || $email=="" || $contra1=="" || $contra2==""){
    echo '
            <div class="error">
                <div class="error_text">
                    <strong>A ocurrido un error</strong> <br>
                    <p>Todos los campos son obligatorios</p>
                </div>
            </div>
        ';
    exit();
}

if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$nombre)){
    echo '
            <div class="error">
                <div class="error_text">
                    <strong>A ocurrido un error</strong> <br>
                    <p>EL NOMBRE no coincide con el formato solicitado</p>
                </div>
            </div>
    ';
    exit();
}
if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$apellido)){
    echo '
            <div class="error">
                <div class="error_text">
                    <strong>A ocurrido un error</strong> <br>
                    <p>EL APELLIDO no coincide con el formato solicitado</p>
                </div>
            </div>
    ';
    exit();
}
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
if ((verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$contra1)) || (verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$contra2))) {
    echo '
            <div class="error">
                <div class="error_text">
                    <strong>A ocurrido un error</strong> <br>
                    <p>LAS CLAVES no coinciden con el formato solicitado</p>
                </div>
            </div>
        ';
        exit();
}
if (filter_var($email,FILTER_VALIDATE_EMAIL)){
    $check_email = conexion();
    $check_email = $check_email->query("SELECT usuario_email FROM usuario WHERE usuario_email='$email'");
    if($check_email->rowCount() > 0) {
        echo '
            <div class="error">
                <div class="error_text">
                    <strong>A ocurrido un error</strong> <br>
                    <p>EL EMAIL ya a sido registrado. intentelo nuevamente con otro</p>
                </div>
            </div>
            ';
            exit();
    }
    $check_email=null;
}else{
    echo '
            <div class="error">
                <div class="error_text">
                    <strong>A ocurrido un error</strong> <br>
                    <p>EL EMAIL ingrasado no es valido</p>
                </div>
            </div>
        ';
        exit();
}

$check_usuario = conexion();
$check_usuario = $check_usuario->query("SELECT usuario_usuario FROM usuario WHERE usuario_usuario='$usuario'");
if($check_usuario->rowCount() > 0) {
    echo '
        <div class="error">
            <div class="error_text">
                <strong>A ocurrido un error</strong> <br>
                <p>EL USUARIO ya a sido registrado. intentelo nuevamente con otro</p>
            </div>
        </div>
        ';
        exit();
}
$check_usuario=null;

if($contra1!=$contra2){
    echo '
        <div class="error">
            <div class="error_text">
                <strong>A ocurrido un error</strong> <br>
                <p>LAS CONTRASEÑAS no coinciden</p>
            </div>
        </div>
        ';
        exit();
}else{
    $contra = password_hash($contra1,PASSWORD_BCRYPT,["cost"=>10]);
}

$guardar_usuario = conexion();
$guardar_usuario = $guardar_usuario->prepare("INSERT INTO usuario (usuario_nombre,usuario_apellido,usuario_clave,usuario_usuario,usuario_email) VALUES (:nombre, :apellido, :contra, :usuario, :email)");

$array_insert = [
    ":nombre" => $nombre,
    "apellido" => $apellido,
    ":contra" => $contra,
    ":usuario" => $usuario,
    ":email" => $email
];
   
$guardar_usuario->execute($array_insert);


if($guardar_usuario->rowCount() == 1){
    echo '
        <div class="exito">
            <div class="exito_text">
                <strong>USUARIO REGISTRADO</strong> <br>
                <p>el usuario se registro correctamente</p>
            </div>
        </div>
        ';
}else{
    echo '
        <div class="error">
            <div class="error_text">
                <strong>A ocurrido un error</strong> <br>
                <p>no se pudo registrar el usuario. intentelo nuevamente</p>
            </div>
        </div>
        ';
        exit();
} 

$guardar_usuario=null;