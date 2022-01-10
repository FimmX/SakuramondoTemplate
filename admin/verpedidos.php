<?php 
session_start();
include "../php/conexion.php";
if(!isset($_SESSION['datos_login'])){
  header("Location: ../index.php");
}
$arregloUsuario = $_SESSION['datos_login'];
if($arregloUsuario['nivel']!='cliente'){
    header("Location: ../index.php");
}  
$resultado = $conexion ->query("
    SELECT ventas.*, usuario.nombre, usuario.telefono, usuario.email 
    FROM ventas 
    INNER JOIN usuario on ventas.id_usuario= usuario.id
    WHERE usuario.id=".$arregloUsuario['id_usuario']) or die ($conexion -> error);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pasteleria Ya!| Panel de control</title>

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

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center" style="background: #fff6e7;">
    <img class="animation__shake" src="./dashboard/dist/img/PasteleriaYa-Logo.jpg" alt="" height="150" width="500">
  </div>

    <?php include "./layouts/header.php";?>

  <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="background: #fff6e7;">
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
     

        <div id="accordion">
                <?php 
                    while($f=mysqli_fetch_array($resultado)){
                ?>
            <div class="card">
                <div class="card-header" id="heading<?php echo $f['id'];?>">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $f['id']  ;?>" aria-expanded="true" aria-controls="collapseOne">
                    <?php echo $f['fecha'].' || '.$arregloUsuario['nombre'].' || Pedido #'.$f['id'] ;?>
                    </button>
                </h5>
                </div>

                <div id="collapse<?php echo $f['id'] ;?>" class="collapse" aria-labelledby="heading<?php echo $f['id']  ;?>" data-parent="#accordion">
                <div class="card-body">
                        <p class="h4">Datos cliente</p>
                        <hr>
                        <input type="hidden" id="idEdit" name="id" >
                        
                        <p>Nombre cliente: <?php echo $f['nombre'] ;?></p>
                        <p>Email cliente: <?php echo $f['email'] ;?></p>
                        <p>Telefono cliente: <?php echo $f['telefono'] ;?></p>
                        <p>Estatus: 
                        <div class="form-group">
                            <input type="text" name="nombre" placeholder="nombre"  class="form-control" value="<?php echo $f['estatus']?>"require>
                        </div></p>
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
    $(document).ready(function(){
        var idEliminar= -1;
        var idEditar= -1;
        var fila;
        $(".btnEliminar").click(function(){
            idEliminar= $(this).data('id'); 
            fila=$(this).parent('td').parent('tr');
        });
        $(".eliminar").click(function(){
            $.ajax({
                url: '../php/eliminarProducto.php',
                method:'POST',
                data:{
                    id:idEliminar
                }
                
            }).done(function(res){
                alert(res);
                $(fila).fadeOut(1000);
            });
        });
        $(".btnEditar").click(function(){
            idEditar=$(this).data('id');
            var nombre=$(this).data('nombre');
            var descripcion=$(this).data('descripcion');
            var precio=$(this).data('precio');
            var inventario=$(this).data('inventario');
            var categoria=$(this).data('categoria');
            $("#nombreEdit").val(nombre);
            $("#descripcionEdit").val(descripcion);
            $("#precioEdit").val(precio);
            $("#inventarioEdit").val(inventario);
            $("#categoriaEdit").val(categoria);
            $("#idEdit").val(idEditar);
        });
    });
</script>
</body>
</html>
