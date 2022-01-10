<?php
session_start();
if(!isset($_SESSION['carrito'])){
  header('Location: ./index.php');

}
$arreglo = $_SESSION['carrito'];


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
    <form action="./thankyou2.php" method="POST">
      <div class="site-section">
        <div class="container">

          <div class="row">
            <div class="col-md-6 mb-5 mb-md-0">
              <h2 class="h3 mb-3 text-black">Detalle de Venta</h2>
              <div class="p-3 p-lg-5 border">
                
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_fname" class="text-black">Nombre <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_fname" name="c_fname" required>
                  </div>
                  <div class="col-md-6">
                    <label for="c_lname" class="text-black">Apellido <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_lname" name="c_lname" required>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_companyname" class="text-black">Region</label>
                    <input type="text" class="form-control" id="c_companyname" name="c_region" required>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_address" class="text-black">Direccion <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_address" name="c_direccion" placeholder="direccion" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_state_country" class="text-black">Comuna <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_state_country" name="c_comuna" required>
                  </div>
                  <div class="col-md-6">
                    <label for="c_postal_zip" class="text-black">Codigo Postal <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_postal_zip" name="c_cpostal" required>
                  </div>
                </div>

                <div class="form-group row mb-5">
                  <div class="col-md-6">
                    <label for="c_email_address" class="text-black">Correo Electronico<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_email_address" name="c_email"required > 
                  </div>
                  <div class="col-md-6">
                    <label for="c_phone" class="text-black">Telefono <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_phone" name="c_phone" placeholder="Phone Number" required>
                  </div>
                </div>

              </div>
            </div>
            <div class="col-md-6">

              
              
              <div class="row mb-5">
                <div class="col-md-12">
                  <h2 class="h3 mb-3 text-black">Tu Orden</h2>
                  <div class="p-3 p-lg-5 border">
                    <table class="table site-block-order-table mb-5">
                      <thead>
                        <th>Producto</th>
                        <th>Total</th>
                      </thead>
                      <tbody>
                        <?php 
                        $total = 0;
                        for($i=0; $i < count($arreglo); $i++){
                          $total = $total + $arreglo[$i]['Precio'] * $arreglo[$i]['Cantidad'];
                        
                        ?>
                        <tr>
                          <td><?php echo $arreglo[$i]['Nombre'];?></td>
                          <td>$ <?php echo number_format($arreglo[$i]['Precio'],2,'.','');?></td>
                        </tr>
                        <?php } ?>
                        <tr> 
                          <td class="text-black font-weight-bold"><strong>Orden Total</strong></td>
                          <td class="text-black font-weight-bold"><strong>$ <?php echo number_format($total,2,'.','');?></strong></td>
                        </tr>
                      </tbody>
                    </table>
                          <h4>Metodos de pago disponibles</h4>
                    <div class="border p-3 mb-3">
                      <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Transferencia Bancaria</a></h3>

                      <div class="collapse" id="collapsebank">
                        <div class="py-2">
                          <p class="mb-0">
                                RUT:                96.524.363-5 <br>
                                Numero de cuenta:   21542365488 <br>
                                Tipo de cuenta:     Cuenta Corriente <br>
                                Nombre del titular: PasteleriaYa <br>
                                Correo:             cobranzas@pasteleriaya.cl <br>
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="border p-3 mb-5">
                      <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">Cobro contra entrega</a></h3>

                      <div class="collapse" id="collapsepaypal">
                        <div class="py-2">
                          <p class="mb-0">Modalidad de "Cobro Contra Entrega" permite paga en el momento que llegue tu producto y poder pargar en efectivo como con debito.</p>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <button class="btn btn-primary btn-lg py-3 btn-block" type="submit">Generar Orden</button>

                    </div>

                  </div>
                </div>
              </div>

            </div>
          </div>
          
        </div>
      </div>
    </form>
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