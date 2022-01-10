
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
<!--Cambiar contenido para listar los productos del cliente-->
<!--Cambiar contenido para listar los productos del cliente-->
<!--Cambiar contenido para listar los productos del cliente-->
<!--Cambiar contenido para listar los productos del cliente-->
<!--Cambiar contenido para listar los productos del cliente-->
<!--Cambiar contenido para listar los productos del cliente-->
<!--Cambiar contenido para listar los productos del cliente-->
<!--Cambiar contenido para listar los productos del cliente-->
<!--Cambiar contenido para listar los productos del cliente-->
<!--Cambiar contenido para listar los productos del cliente-->
<!--Cambiar contenido para listar los productos del cliente-->
<!--Cambiar contenido para listar los productos del cliente-->

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7 mx-auto">
            <h2 class="h3 mb-3 text-black ">Buscar Numero de Venta</h2>
          </div>
          <div class="col-md-7 mx-auto">

            <form action="./buscarPedido.php" method="GET">
              <div class="p-3 p-lg-5 border">
              <div class="col-md-12">
                    <label for="idventa" class="text-black">Orden de compra <span class="text-danger">*</span></label>
                    <input type="text" required class="form-control" id="idventa" name="idventa"> 
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="email" class="text-black">Correo asociado a la venta <span class="text-danger">*</span></label>
                    <input type="email" required class="form-control" id="email" name="email" placeholder="example@email.com">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-12">
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Enviar Mensaje">
                  </div>
                </div>
              </div>
            </form>
          </div>
          
        </div>
      </div>
    </div>
    <br>
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