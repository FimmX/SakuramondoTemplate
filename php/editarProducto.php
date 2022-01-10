<?php 
include "./conexion.php";
if(isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['precio']) 
&& isset($_POST['inventario']) && isset($_POST['categoria'])){

    if($_FILES['imagen']['name']!=''){

        $carpeta="../images/";
        $nombre = $_FILES['imagen']['name'];

        $temp=explode( '.',$nombre);
        $extension = end($temp);
    
        $nombreFinal = time().'.'.$extension;
        
        if($extension=='jpg' || $extension=='png'){
            if(move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta.$nombreFinal)){
                $fila = $conexion -> query("SELECT imagen FROM productos WHERE id=".$_POST['id']);                
                $id = mysqli_fetch_row($fila);
                if(file_exists('../images/'.$id[0])){
                    unlink('../images/'.$id[0]);
                }
                $conexion ->query("UPDATE productos SET imagen='".$nombreFinal."' WHERE id=".$_POST['id']);
            }

        }
    }
    
    $conexion ->query("UPDATE productos SET 
    nombre='".$_POST['nombre']."',
    descripcion='".$_POST['descripcion']."',
    precio=".$_POST['precio'].",
    inventario=".$_POST['inventario'].",
    id_categoria=".$_POST['categoria']."
    WHERE id=".$_POST['id']);
    header("Location: ../admin/productos.php?edit-successfull");

} 

?>