<?php 
include "./php/conexion.php";
if (!isset($_GET['id_venta'])){
    header("Location: ./");
}

$datos= $conexion->query("SELECT 
        ventas.*, 
        usuario.nombre, usuario.telefono, usuario.email
        FROM ventas 
        INNER JOIN usuario ON ventas.id_usuario = usuario.id
        WHERE ventas.id=".$_GET['id_venta'])or die($conexion -> error);
$datosUsuario = mysqli_fetch_row($datos);
$datos2= $conexion -> query("SELECT * FROM envios WHERE id_venta=".$_GET['id_venta'])or die($conexion->error);
$datosEnvio = mysqli_fetch_row($datos2);

$datos3= $conexion -> query("SELECT productos_venta.*,
        productos.nombre as Nombre_Producto, productos.imagen
        FROM productos_venta 
        INNER JOIN productos ON productos_venta.id_producto = productos.id
        WHERE id_venta=".$_GET['id_venta']
        )or die($conexion->error);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Web Sakuramondo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css"> 
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">


    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">
    
  </head>
  <body>
  
  <div class="site-wrap">
  <?php include("./layouts/header.php"); ?> 

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="h3 mb-3 text-black">Orden de Reserva</h2>
          </div>
          <div class="col-md-7">

            <form action="#" method="post">
              
              <div class="p-3 p-lg-5 border">
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_fname" class="text-black">N??mero Pedido #<?php echo $_GET['id_venta']; ?></label>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_fname" class="text-black">Nombre: <?php echo $datosUsuario[6]; ?></label>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_fname" class="text-black">Correo: <?php echo $datosUsuario[8]; ?></label>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_fname" class="text-black">Region: <?php echo $datosEnvio[1]; ?></label>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_fname" class="text-black">Comuna: <?php echo $datosEnvio[3]; ?></label>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_fname" class="text-black">Estatus: <?php echo $datosUsuario[4]; ?></label>
                  </div>
                </div>                
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_fname" class="text-black">Medio de Pago: <?php echo $datosUsuario[5]; ?></label>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-5 ml-auto">
            <?php 
                while($f = mysqli_fetch_array($datos3))
                {
            ?>
            <div class="p-4 border mb-3">
              <img src="./images/<?php echo $f['imagen'];?>" height="150" width="250px" alt="" >
              <span class="d-block text-primary h6 text-uppercase"><?php echo $f['Nombre_Producto'];?></span>
              <span class="d-block text-primary h6 text-uppercase">Cantidad: <?php echo $f['cantidad'];?></span>
              <span class="d-block text-primary h6 text-uppercase">Precio: <?php echo $f['precio'];?></span>
              <span class="d-block text-primary h6 text-uppercase">Subtotal: <?php echo $f['subtotal'];?></span>

            </div>
            <?php } ?>
            <h4>Total Reserva: <?php echo $datosUsuario[2];?></h4>
          </div>
        </div>
      </div>
    </div>

    <?php include("./layouts/footer.php"); ?> 
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>
    
  </body>
</html>