<?php
session_start();
include "./conexion.php";

if(isset($_POST['email']) && isset($_POST['pass']) ){
    
    $resultado = $conexion -> query("SELECT * FROM administrador WHERE 
    email='".$_POST['email']."' AND 
    password='".$_POST['pass']."' LIMIT 1")or die($conexion -> error);
if(mysqli_num_rows($resultado)>0){
    $datos_usuario = mysqli_fetch_row($resultado);
    $nombre = $datos_usuario[1];
    $id_usuario = $datos_usuario[0];
    $email = $datos_usuario[3];
    $imagen_perfil = $datos_usuario[5];
    $nivel = $datos_usuario[6];
    $_SESSION['datos_login'] = array(
        'nombre'=>$nombre,
        'id_usuario'=>$id_usuario,
        'email'=>$email,
        'imagen'=>$imagen_perfil,
        'nivel'=>$nivel
    );
    header("Location: ../admin/pedidos.php");
}else{
    header("Location: ../login.php?error=Credenciales_incorrectas");
}

}else{
    header("../login.php");
}

?>