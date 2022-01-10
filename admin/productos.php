<?php 
session_start();
include "../php/conexion.php";
if(!isset($_SESSION['datos_login'])){
  header("Location: ../index.php");
}
$arregloUsuario = $_SESSION['datos_login'];
if($arregloUsuario['nivel']!='admin'){
    header("Location: ../index.php");
}   
$resultado = $conexion ->query("
    SELECT productos.*, categorias.nombre as catego 
    FROM productos
    INNER JOIN categorias ON productos.id_categoria = categorias.id
    ORDER BY id DESC") or die ($conexion -> error);

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
<div class="wrapper">
    <div class="brand-link d-flex justify-content-between align-items-center">
        <a class="pushmenu" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </div>
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
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
                        <h1 class="m-0">Productos</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6 text-right">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa fa-plus"></i>Insertar Producto
                        </button>
                    </div>
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
         <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Categoria</th>
                    <th>Inventario</th>
                    <th>Editar</th>
                </tr>                          
            </thead>
            <tbody>
                <?php 
                    while($f = mysqli_fetch_array($resultado)){
                ?>
                <tr>
                    <td><?php echo $f['id'];?></td>
                    <td>
                        <img src="../images/<?php echo $f['imagen'];?>"  width="25px" height="25px" alt="" >
                        <?php echo $f['nombre'];?>
                    </td>
                    <td><?php echo $f['descripcion'];?></td>
                    <td>$ <?php echo number_format($f['precio'],2,'.','');?></td>
                    <td><?php echo $f['catego'];?></td>
                    <td><?php echo $f['inventario'];?></td>
                    <td>
                        <button class="btn btn-primary btn-small btnEditar" 
                        data-id="<?php echo $f['id'];?>"
                        data-nombre="<?php echo $f['nombre'];?>"
                        data-descripcion="<?php echo $f['descripcion'];?>"
                        data-precio="<?php echo $f['precio'];?>"
                        data-inventario="<?php echo $f['inventario'];?>"
                        data-categoria="<?php echo $f['id_categoria'];?>"
                        data-bs-toggle="modal" data-bs-target="#modalEditar">
                            <i class="fa fa-edit"></i>
                        </button>
                        
                    </td>
                </tr>
                <?php 
                    }
                ?>
            </tbody>
         </table>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="../php/insertarProducto.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Insertar Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" placeholder="nombre" id="nombre" class="form-control" require>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <input type="text" name="descripcion" placeholder="descripcion" id="descripcion" class="form-control" require>
                        </div>
                        <div class="form-group">
                            <label for="imagen">Imagen</label>
                            <input type="file" name="imagen" id="imagen" class="form-control" require>
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="text" min="0" name="precio" placeholder="precio" id="precio" class="form-control" require>
                        </div>
                        <div class="form-group">
                            <label for="inventario">Inventario</label>
                            <input type="text" name="inventario" placeholder="inventario" id="inventario" class="form-control" require>
                        </div>
                        <div class="form-group">
                            <label for="categoria">Categoria</label>
                            <select name="categoria" id="categoria" class="form-control" require>
                                <?php $res= $conexion ->query("SELECT * FROM categorias");
                                while($f=mysqli_fetch_array($res)){
                                    echo '<option value="'.$f['id'].'">'.$f['nombre'].'</option>';
                                }
                                ?>
                                
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>               
    <!-- Modal Eliminar -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEliminarLabel">Eliminar Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                       ¿Desea eliminar el producto?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger eliminar" data-bs-dismiss="modal">Eliminar</button>
                    </div>

            </div>
        </div>
    </div>     
        <!--Modal Editar -->
    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditar" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="../php/editarProducto.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditar">Editar Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="idEdit" name="id" >
                        <div class="form-group">
                            <label for="nombreEdit">Nombre</label>
                            <input type="text" name="nombre" placeholder="nombre" id="nombreEdit" class="form-control" require>
                        </div>
                        <div class="form-group">
                            <label for="descripcionEdit">Descripcion</label>
                            <input type="text" name="descripcion" placeholder="descripcion" id="descripcionEdit" class="form-control" require>
                        </div>
                        <div class="form-group">
                            <label for="imagen">Imagen</label>
                            <input type="file" name="imagen" id="imagen" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="precioEdit">Precio</label>
                            <input type="text" min="0" name="precio" placeholder="precio" id="precioEdit" class="form-control" require>
                        </div>
                        <div class="form-group">
                            <label for="inventarioEdit">Inventario</label>
                            <input type="text" name="inventario" placeholder="inventario" id="inventarioEdit" class="form-control" require>
                        </div>
                        <div class="form-group">
                            <label for="categoriaEdit">Categoria</label>
                            <select name="categoria" id="categoriaEdit" class="form-control" require>
                                <?php $res= $conexion ->query("SELECT * FROM categorias");
                                while($f=mysqli_fetch_array($res)){
                                    echo '<option value="'.$f['id'].'">'.$f['nombre'].'</option>';
                                }
                                ?>
                                
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
