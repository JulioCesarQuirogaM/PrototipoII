<?php include_once ("./Funciones/sessiones.php"); ?>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="adminper.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>SGR</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>SGR</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
       <i class="fas fa-bars"></i>
        
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="./Recursos/img/avatar04.png" class="user-image" alt="User Image">
              <span class="hidden-xs"> <?php echo $_SESSION["usuario"]; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="./Recursos/img/avatar04.png" class="img-circle" alt="User Image">

                <p>
                  <?php echo $_SESSION["usuario"]; ?>
                  <?php echo $_SESSION["rol"]; ?>
                  <small><?php echo $_SESSION["apellido"]; ?></small>
                </p>
              </li>
              <!-- Menu Body -->

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="Login.php?cerrar_session=true" class="btn btn-danger">Cerrar</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->