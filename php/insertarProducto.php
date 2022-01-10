<?php 
include "./conexion.php";
if(isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['precio']) 
&& isset($_POST['inventario']) && isset($_POST['categoria'])){

    $carpeta="../images/";
    $nombre = $_FILES['imagen']['name'];

    $temp=explode( '.',$nombre);
    $extension = end($temp);

    $nombreFinal = time().'.'.$extension;
    
    if($extension=='jpg' || $extension=='png'){
        if(move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta.$nombreFinal)){
            $conexion ->query("INSERT INTO productos (nombre, descripcion, precio, imagen, inventario, id_categoria)
            VALUES(
                '".$_POST['nombre']."',
                '".$_POST['descripcion']."',
                ".$_POST['precio'].",
                '$nombreFinal',
                ".$_POST['inventario'].",
                ".$_POST['categoria']."
            )
            ")or die($conexion -> error);
            header("Location: ../admin/productos.php?success");
        }else{
            header("Location: ../admin/productos.php?error=No se pudo subir la imagen");
        }
    }else{
        header("Location: ../admin/productos.php?error=Favor subir una imagen valida - JPG o PNG");
    }


}else{
    header("Location: ../admin/productos.php?error=Favor de llena todos los campos");
}

?>