<?php 
session_start();
include "./conexion.php";

if(isset($_POST['email']) && isset($_POST['idventa']) ){

    $resultado = $conexion -> query("SELECT ventas.*, usuario.email FROM usuario 
    INNER JOIN ventas ON ventas.id_usuario = usuario.id WHERE usuario.email='".$_POST['email']."'
    AND ventas.id='".$_POST['idventa']."' LIMIT 1") or die($conexion -> error);
    if(mysqli_num_rows($resultado)>0){
        $datos_usuario = mysqli_fetch_row($resultado);
        $email= $datos_usuario[9];
        $idventa = $datos_usuario[1];
        $_SESSION['datos_consulta']=array(
            'email'=>$email,
            'id_venta'=>$idventa
        );
        header("Location: ../buscarPedido2.php");
    }else{
        header("Location: ../estatuspedido.php?error=correo_o_Orden_de_venta_Incorrecta");
    }

}else{
    header("Location: ../estatuspedido.php");
}

?>