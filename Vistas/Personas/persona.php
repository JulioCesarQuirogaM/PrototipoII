<?php include_once ("../Funciones/sessiones.php"); ?>

      <h1>
        <font face="lucida calligraphy">Personas</font>
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
              <div class="box-tools pull-right">
                  <button class="btn btn-info btn-sm" id="nuevo"  data-toggle="tooltip"
                      title="Nueva Persona"><i class="fa fa-plus" aria-hidden="true"></i></button>
                      <!-- <a href="Vistas/Personas/exPDF.php" class="btn btn-info btn-sm" id="exportar"  data-toggle="tooltip"
                          title="Exportar"><i class="fas fa-file-export"></i></a> -->
              </div>
            </div>


            <!-- /.box-header -->
            <div class="box-body">
            <div id="editar"></div>
            <div id="listado">
              <table id="tablaPersona" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>C.C.</th>
                  <th>Ciudad</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Sexo</th>
                  <th>Cel</th>
                  <th>Email</th>
                  <th>Apartamento</th>
                  <th>Rol</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
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
    $(document).ready(personas);
</script>
