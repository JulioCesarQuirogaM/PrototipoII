<?php include_once ("../Funciones/sessiones.php"); ?>
      
      <h1>
        Gestión de
        <small>  ROOT</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Vehiculo por Apartamento </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Listado de Vehiculos por Apartamento</h3>
              <div class="box-tools pull-right">
                  <button class="btn btn-info btn-sm" id="nuevo"  data-toggle="tooltip" 
                      title="Nueva Usuarios"><i class="fa fa-plus" aria-hidden="true"></i></button> 
              </div>
            </div>
           
        
            <!-- /.box-header -->
            <div class="box-body">
            <div id="editar"></div>
            <div id="listado">
              <table id="tablaVehiculoApart" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Vehiculo</th>
                  <th>Placa</th>
                  <th>Propietario</th>
                  <th>Bloque</th>
                  <th>Apartamento</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                
                </tbody>
                <tfoot>
                <tr>
                  <th>Codigo</th>
                  <th>Vehiculo</th>
                  <th>Placa</th>
                  <th>Propietario</th>
                  <th>Bloque</th>
                  <th>Apartamento</th>
                  <th>Acciones</th>
                </tr>
                </tfoot>
              </table>
               <li><?php echo "<script>window.open('././PDF/Vista/PDFVehiculos.php', '_blank');</script>";?> <a> PDf De Prueba</a></li> 
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  </div>
  <!-- /.content-wrapper -->

<script src="./Recursos/js/funcionesVehiculoApart.js"></script>
<!-- Funciones de Lógica de neogcio -->
<script>
    $(document).ready(vehiculoAparts);
</script>
