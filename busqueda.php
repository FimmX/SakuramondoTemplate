<?php 
include('./php/conexion.php'); 
if(!isset($_GET['texto'])){
    header("Location: ./index.php"); 
}

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

          <div class="row mb-5">
            <div class="col-md-9 order-2">

            <h2>Busqueda de <?php echo $_GET['texto']?></h2>
              <div class="row mb-5">
              <?php 
                

                $resultado = $conexion -> query("SELECT * FROM productos WHERE 
                nombre LIKE '%".$_GET['texto']."%' or
                descripcion LIKE '%".$_GET['texto']."%'
               

                ORDER BY id DESC LIMIT 10") or die($conexion -> error);
                if(mysqli_num_rows($resultado) >0){
                    
                while($fila = mysqli_fetch_array($resultado)){ 

               
              ?>
                
                <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                  <div class="block-4 text-center border">
                    <figure class="block-4-image">
                      <a href="shop-single.php?id=<?php echo $fila['id'];?>">
                      <img src="images/<?php echo $fila['imagen'];?>" alt="<?php echo $fila['nombre'];?>" class="img-fluid">
                      </a>
                    </figure>
                    <div class="block-4-text p-4">
                      <h3><a href="shop-single.php?id=<?php echo $fila['id'];?>"><?php echo $fila['nombre'];?></a></h3>
                      <p class="mb-0"><?php echo $fila['descripcion'];?></p>
                      <p class="text-primary font-weight-bold">$ <?php echo $fila['precio'];?></p>
                    </div>
                  </div>
                </div>
                
              <?php  } }else{
                  echo '<h2>Sin resultados</h2>';
              } ?>

              </div>

              

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