<?php
    require_once("../inc/session_start.php");

    require_once("main.php");

    $id = limpiar_cadena($_POST['usuario_id']);

    $check_user = conexion();
    $check_user = $check_user->query("SELECT * FROM usuario WHERE usuario_id = $id");

    if ($check_user->rowCount() == 0) {
        alertError("","ID de usuario no existente");
        exit();
    }else{
        $datos = $check_user->fetch();

    }
    $check_user = null;

    $admin_usuario=limpiar_cadena($_POST['administrador_usuario']);
    $admin_clave=limpiar_cadena($_POST['administrador_clave']);


    if($admin_usuario=="" || $admin_clave==""){
       alertError("","No ha llenado los campos que corresponden a su USUARIO o CLAVE");
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9]{4,20}",$admin_usuario)){
        alertError("","Su USUARIO no coincide con el formato solicitado");
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$admin_clave)){
        alertError("","Su CLAVE no coincide con el formato solicitado");
        exit();
    }

    $check_admin=conexion();
    $check_admin=$check_admin->query("SELECT usuario_usuario,usuario_clave FROM usuario WHERE usuario_usuario='$admin_usuario' AND usuario_id='".$_SESSION['id']."'");
    if($check_admin->rowCount()==1){

    	$check_admin=$check_admin->fetch();

    	if($check_admin['usuario_usuario']!=$admin_usuario || !password_verify($admin_clave, $check_admin['usuario_clave'])){
    		alertError("","USUARIO o CLAVE de administrador incorrectos");
	        exit();
    	}

    }else{
    	alertError("","USUARIO o CLAVE de administrador incorrectos");
        exit();
    }
    $check_admin=null;


    $nombre=limpiar_cadena($_POST['usuario_nombre']);
    $apellido=limpiar_cadena($_POST['usuario_apellido']);

    $usuario=limpiar_cadena($_POST['usuario_usuario']);
    $email=limpiar_cadena($_POST['usuario_email']);

    $clave_1=limpiar_cadena($_POST['usuario_clave_1']);
    $clave_2=limpiar_cadena($_POST['usuario_clave_2']);


    if($nombre=="" || $apellido=="" || $usuario==""){
        alertError("","No has llenado todos los campos que son obligatorios");
        exit();
    }


    /*== Verificando integridad de los datos (usuario) ==*/
    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$nombre)){
       alertError("","El NOMBRE no coincide con el formato solicitado");
        exit();
    }

    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$apellido)){
        alertError("","El APELLIDO no coincide con el formato solicitado");
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9]{4,20}",$usuario)){
        alertError("","El USUARIO no coincide con el formato solicitado");
        exit();
    }
