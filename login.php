<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Web Sakuramondo - Login </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./admin/dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="./admin/dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./admin/dashboard/dist/css/adminlte.min.css">
  <!-- Theme Fimm-->
  <link rel="stylesheet" href="./admin/dashboard/dist/css/style-fimm.css">
</head>
<body class="hold-transition login-page" id="fondo-login">
<div class="login-box">
  <div class="login-logo">
  <a href="index.php"><img src="./images/logosm-01.png" class="img-fluid"></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body" >
      <p class="login-box-msg">Ingresa para iniciar sesion</p>

      <form action="./php/check.php" method="post">
        <div class="input-group mb-3">
          <input type="email" required  class="form-control" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" required class="form-control" placeholder="Password" name="pass">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Recuerdame
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
          <!-- /.col -->

        <?php 
            if(isset($_GET['error'])){
                echo '<div class="col-12 mt-2 alert alert-danger">'.$_GET['error'].'</div>';
            }
        ?>
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="./admin/dashboard/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./admin/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./admin/dashboard/dist/js/adminlte.min.js"></script>
</body>
</html>
