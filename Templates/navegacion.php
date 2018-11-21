<?php include_once ("./Funciones/sessiones.php"); ?>
<!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="./Recursos/img/avatar04.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION["apellido"];?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENÚ DE ADMINSITRACIÓN</li>
        <li class="treeview">
          <?php 
            if($_SESSION['rol']==1){
              echo '<a href="#">
            <i class="fas fa-tachometer-alt"></i> <span>Recurso Humano</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="./vistas/Usuario/usuario.php"><i class="fas fa-building"></i> Usuarios</a></li>

            <li><a href="./vistas/Personas/persona.php"><i class="fas fa-building"></i>Personas</a></li>

            <li><a href="./vistas/propietarioApart/propietarioApart.php"><i class="fas fa-building"></i>Propietarios por Apartamento</a></li>

            <li><a href="./vistas/inquilinoApart/inquilinoApart.php"><i class="fas fa-building"></i>Inquilinos por Apartamento</a></li>

          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i>
            <span>Infraestructura</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="./vistas/pais/pais.php"><i class="fas fa-building"></i>Pais</a></li> 

            <li><a href="./vistas/ciudad/ciudad.php"><i class="fas fa-building"></i>ciudad</a></li>

            <li><a href="./vistas/unidades/unidades.php"><i class="fas fa-building"></i>Unidades Residenciales</a></li>

            <li><a href="./vistas/zonaP/zonaP.php"><i class="fas fa-building"></i>Zona Publica</a></li>

            <li><a href="./vistas/bloque/bloque.php"><i class="fas fa-building"></i>Bloques</a></li>

            <li><a href="./vistas/apartamento/apart.php"><i class="fas fa-building"></i>Apartamentos</a></li> 
            
            <li><a href="./vistas/vehiculoApartamento/vehiculoApart.php"><i class="fas fa-building"></i>Vehiculo por Apartamento</a></li>
            
            
          </ul>
        </li>
        ';
            }elseif ($_SESSION['rol']==7) {
              echo '<li class="treeview">
                      <a href="#">
                        <i class="fas fa-tachometer-alt"></i> 
                        <span>Parqueadero</span>
                      </a>
                      <ul class="treeview-menu">
                        <li><a href="./vistas/Vehiculo/vehiculo.php"><i class="fa fa-car-side"></i> Portero</a></li>
                      </ul>
                    </li>';

                  }elseif ($_SESSION['rol']==5) {
              echo '<li class="treeview">
                      <a href="#">
                        <i class="fas fa-tachometer-alt"></i> 
                        <span>Secrearia</span>
                      </a>
                      <ul class="treeview-menu">
                        <li><a href="./correo/index.php"><i class="fa fa-car-side"></i>Notificación</a></li>
                      </ul>
                    </li>';
              
            }
          ?>
       
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->