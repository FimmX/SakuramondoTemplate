<?php 
include "./conexion.php";

if(isset($_POST['estatus'])){

    $conexion ->query("UPDATE ventas SET 
    estatus='".$_POST['estatus']."'
    WHERE id=".$_POST['id']);


    header("Location: ../admin/pedidos.php?edit-successfull");

}
    

?>
