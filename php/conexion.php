<?php
    $servidor="localhost";
    $usuario="";
    $pass="";
    $dbname="";

    $conexion = new mysqli($servidor,$usuario,$pass,$dbname);
    if($conexion -> connect_error){
        die("Connection Failed");
    }

?>