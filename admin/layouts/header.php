  <!-- Navbar -->

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="#e3b76e">
    <!-- Brand Logo -->
    <a href="./" class="brand-link">
    <img src="./dashboard/dist/img/logosm-01.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../images/users/<?php echo $arregloUsuario['imagen'];?>" class="img-circle elevation-2" 
          alt="<?php echo $arregloUsuario['nombre'];?>">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $arregloUsuario['nombre'];?></a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
          <li class="nav-item">
            <a href="./pedidos.php" class="nav-link">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
               Pedidos
              </p>
            </a>
          </li>
          <?php 
          if($arregloUsuario['nivel']=='admin'){
          ?>
            <li class="nav-item">
              <a href="./productos.php" class="nav-link">
                <i class="nav-icon fas fa-boxes"></i>
                <p>
                  Productos
                </p>
              </a>
            </li>
          <?php } ?>
          <li class="nav-item">
            <a href="../php/cerrar_sesion.php" class="nav-link">
              <i class="nav-icon fas fa-users-slash"></i>
              <p>
                Salir
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>