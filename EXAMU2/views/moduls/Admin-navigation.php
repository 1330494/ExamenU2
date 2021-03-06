<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/School.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">System Fest</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/escudo.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Modo: Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">

            <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Menu
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="index.php?action=usuarios" class="nav-link">
                  <i class="fa fa-users"></i>
                  <p>Usuarios</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?action=alumnas" class="nav-link">
                  <i class="nav-icon fa fa-circle-o text-info"></i>
                  <p>Alumnas</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?action=grupos" class="nav-link">
                  <i class="fa fa-tag"></i>
                  <p>Grupos</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?action=pagos" class="nav-link">
                  <i class="nav-icon fa fa-circle-o text-info"></i>
                  <p>Pagos</p>
                </a>
              </li>

            </ul>

          </li>

          <li class="nav-item">
            <a href="index.php?action=salir" class="nav-link">
              <i class="nav-icon fa fa-circle-o text-danger"></i>
              <p class="text">Salir</p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>