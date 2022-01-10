<?php 
session_start();
include "../php/conexion.php";
if(!isset($_SESSION['datos_login'])){
  header("Location: ../index.php");
}
$arregloUsuario = $_SESSION['datos_login'];
if($arregloUsuario['nivel']!='admin'){
    header("Location: ./verpedidos.php");
}  
$resultado = $conexion ->query("
    SELECT ventas.*, usuario.nombre, usuario.telefono, usuario.email 
    FROM ventas 
    INNER JOIN usuario on ventas.id_usuario = usuario.id ORDER BY ventas.id DESC
    ") or die ($conexion -> error);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sakuramondo | Panel de control</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="./dashboard/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="./dashboard/https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="./dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="./dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="./dashboard/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dashboard/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="./dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="./dashboard/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="./dashboard/plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper" >
    <div class="brand-link d-flex justify-content-between align-items-center">
        <a class="pushmenu" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </div>
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center" >
    <img class="animation__shake" src="./dashboard/dist/img/logosm-01.png" alt="" height="150" width="500">
  </div>

    <?php include "./layouts/header.php";?>

  <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Pedidos</h1>
                    </div><!-- /.col -->
                    
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
   
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <?php 
            if(isset($_GET['error'])){
          ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_GET['error'];?>
        </div>
        <?php } ?>
        <?php 
            if(isset($_GET['success'])){
          ?>
        <div class="alert alert-success" role="alert">
            ¡Se ha insertado correctamente!
        </div>
        <?php } ?>

        <div id="accordion">
                <?php 
                    while($f=mysqli_fetch_array($resultado)){
                ?>
            <div class="card">
                <div class="card-header" id="heading<?php echo $f['id'] ;?>">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $f['id'] ;?>" aria-expanded="true" aria-controls="collapseOne">
                    <?php echo $f['fecha'].' || '.$f['nombre'].' || Pedido #'.$f['id'] ;?>
                    </button>
                </h5>
                </div>

                <div id="collapse<?php echo $f['id'] ;?>" class="collapse" aria-labelledby="heading<?php echo $f['id'] ;?>" data-parent="#accordion">
                <div class="card-body">
                        <p class="h4">Datos cliente</p>
                        <hr>
                        
                        <p>Nombre cliente: <?php echo $f['nombre'] ;?></p>
                        <p>Email cliente: <?php echo $f['email'] ;?></p>
                        <p>Telefono cliente: <?php echo $f['telefono'] ;?></p>
                        <p>Medio de pago: <?php echo $f['pago'] ;?></p>
                        <p>Estatus: <b><?php echo $f['estatus'] ;?></p></b> 
                        <button class="btn btn-secondary btn-small col-md-1 modificaPedido" 
                            data-id="<?php echo $f['id'];?>"
                            data-estatus="<?php echo $f['estatus'];?>"
                            data-bs-toggle="modal" data-bs-target="#modaleditarpedido">
                            <i class="fa fa-edit"> Editar Estado</i>
                        </button>
                        <p class="h4">Datos de envio</p>
                        <hr>
                        <?php
                            $re= $conexion->query("SELECT * FROM envios WHERE id_venta=".$f['id'])or die($conexion -> error);
                            $fila=mysqli_fetch_row($re);
                        ?>
                        <p>Direccion: <?php echo $fila[2];?></p>
                        <p>Comuna: <?php echo $fila[3];?></p>
                        <p>Codigo Postal: <?php echo $fila[4];?></p>
                        <!---->
                        <table class="table">
                            <thead>
                                <tr>
                                    
                                    <th>Nombre Producto</th>
                                    <th>Precio</th>
                                    <th>Categoria</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>                          
                            </thead>
                            <tbody>
                                <?php 
                                $re= $conexion->query("SELECT productos_venta.*, productos.nombre, categorias.nombre as catego FROM productos_venta 
                                INNER JOIN productos ON productos_venta.id_producto = productos.id INNER JOIN categorias ON categorias.id= productos.id_categoria
                                WHERE productos_venta.id_venta=".$f['id'])or die($conexion -> error);
                                    while($f2 = mysqli_fetch_array($re)){
                                ?>
                                <tr>
                                    
                                    <td><?php echo $f2['nombre'];?></td>
                                    <td><?php echo number_format($f2['precio'],2,'.','');?></td>
                                    <td><?php echo $f2['catego'];?></td>
                                    <td><?php echo $f2['cantidad'];?></td>
                                    <td><?php echo $f2['subtotal'];?></td>
                                    
                                </tr>
                                <?php 
                                    }
                                ?>
                            </tbody>
                        </table>
                        <!---->
                </div>
                </div>
            </div>
                <?php } ?>
        </div>    

            
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
   
        <!--Modal Editar -->
    <div class="modal fade" id="modaleditarpedido" tabindex="-1" aria-labelledby="modaleditarpedido" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="../php/editaPedido.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modaleditarpedido">Editar Pedido</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="idEdit" name="id" >
                        <div class="form-group">
                            <select name="estatus" id="estatusEdit" class="form-control col-md-4" >
                                <option value="preparacion">Preparacion</option>
                                <option value="enRuta">En ruta</option>
                                <option value="entregado">Entregado</option>
                                <option value="cancelado">Cancelado</option>
                            </select> 
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary editar">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>       
    <?php include "./layouts/footer.php";?>
</div>
<!-- ./wrapper -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

<!-- jQuery -->
<script src="./dashboard/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="./dashboard/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="./dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="./dashboard/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="./dashboard/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="./dashboard/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="./dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="./dashboard/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="./dashboard/plugins/moment/moment.min.js"></script>
<script src="./dashboard/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="./dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="./dashboard/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="./dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="./dashboard/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="./dashboard/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="./dashboard/dist/js/pages/dashboard.js"></script>

<script>
var idEditar =-1;
    $(document).ready(function(){
        $(".modificaPedido").click(function(){
            idEditar= $(this).data('id');  
            var estatus=$(this).data('estatus'); 
            $("#estatusEdit").val(estatus);
            $("#idEdit").val(idEditar);
        });
    });
</script>
</body>
</html>
