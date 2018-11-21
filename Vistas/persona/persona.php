<?php include_once ("../Funciones/sessiones.php"); ?>
      
      <h1>
        Gestión de
        <small>  ROOT</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Persona</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Listado de Personas</h3>
              <div class="box-tools pull-right">
                  <button class="btn btn-info btn-sm" id="nuevo"  data-toggle="tooltip" 
                      title="Nueva Persona"><i class="fa fa-plus" aria-hidden="true"></i></button> 
              </div>
            </div>
           
        
            <!-- /.box-header -->
            <div class="box-body">
            <div id="editar"></div>
            <div id="listado">
              <table id="tablaPersona" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>persona_ID</th>
                  <th>ciudad_ID</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>sexo</th>
                  <th>Direccion</th> 
                  <th>Telefono</th>
                  <th>Celular</th>
                  <th>Mail</th>
                  <th>Estado_Civil</th>
                  <th>imagen</th>
                  <th>Estado</th> 
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                
                </tbody>
                <tfoot>
                <tr>
                  <th>persona_ID</th>
                  <th>ciudad_ID</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>sexo</th>
                  <th>Direccion</th> 
                  <th>Telefono</th>
                  <th>Celular</th>
                  <th>Mail</th>
                  <th>Estado_Civil</th>
                  <th>imagen</th>
                  <th>Estado</th> 
                  <th>Acciones</th>
                </tr>
                </tfoot>
              </table>
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

<script src="./Recursos/js/funcionesPersona.js"></script>
<!-- Funciones de Lógica de neogcio -->
<script>
    $(document).ready(Persona);
</script>


