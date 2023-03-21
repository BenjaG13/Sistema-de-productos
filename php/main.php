<?php

     # conexion a la base de datos
    function conexion(){
        $pdo = new PDO('mysql:host=localhost;dbname=inventario','root','');
        return $pdo;   
    };
    

   # verificar datos
    function verificar_datos($filtro,$cadena){
        if(preg_match("/^".$filtro."$/",$cadena)){
            return false;
        }else{
            return true;
        }
    }

   
    #  evitar inyeccion sql
    function limpiar_cadena($string){
        $pattern = '/(DROP TABLE|SELECT \* FROM|TRUNCATE TABLE|SHOW TABLES|\<|==|\<?php|\?|\/|--|\:|\;|script|\>|\^|\[|\]|DELETE FROM|INSERT INTO|DROP DATABASE|SHOW DATABASE)/i';
        $string =  preg_replace($pattern, '', $string);
        $string = trim($string);
        return  $string;
    } 

    #  renombrar fotos
    function renombrar_fotos($nombre){
		$nombre=str_ireplace(" ", "_", $nombre);
		$nombre=str_ireplace("/", "_", $nombre);
		$nombre=str_ireplace("#", "_", $nombre);
		$nombre=str_ireplace("-", "_", $nombre);
		$nombre=str_ireplace("$", "_", $nombre);
		$nombre=str_ireplace(".", "_", $nombre);
		$nombre=str_ireplace(",", "_", $nombre);
		$nombre=$nombre."_".rand(0,100);
		return $nombre;
	}
    

    function alertError($prin,$secu){
        if($prin == ""){
            $prin = "A ocurrido un error";
        }
        echo '
        <div class="error">
            <div class="error_text">
                <strong> '. $prin .' </strong> <br>
                <p> '.  $secu .'</p>
            </div>
        </div>
        ';
    }

    function alertExito($prin,$secu){
        echo '
        <div class="exito">
            <div class="exito_text">
                <strong>'. $prin .'</strong> <br>
                <p> '.  $secu .'</p>
            </div>
        </div>
     ';
    }