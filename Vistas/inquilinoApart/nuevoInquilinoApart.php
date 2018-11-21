<?php include_once ("../Funciones/sessiones.php"); ?>
<!-- quick email widget -->

    <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="finquilinoApart">
          <div class="form-group">
                        <label class="control-label col-sm-1" for="inquilinoApart_ID">Codigo:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-tags"></i></span>
                            <input type="text" class="form-control " id="inquilinoApart_ID" name="inquilinoApart_ID" placeholder="Ingrese Codigo"
                            value = "" readonly="true"  data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="unidadres_ID">Unidad:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fa fa-city"></i></span>
                            <select class="form-control" id="unidadres_ID" name="unidadres_ID">
                            <option value="" selected>Seleccione ...</option>
                                <?php foreach($listaInquilinoApart as $fila){ ?>
                                <option value="<?php echo trim($fila['unidadres_ID']); ?>" >
                                <?php echo utf8_encode(trim($fila['unidadres_Nomb'])); ?> </option>

                                <?php } ?>
                            </select>   
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="apart_ID">Apartamento:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fa fa-city"></i></span>
                            <select class="form-control" id="apart_ID" name="apart_ID">
                            <option value="" selected>Seleccione ...</option>
                                <?php foreach($listaInquilinoApart as $fila){ ?>
                                <option value="<?php echo trim($fila['apart_ID']); ?>" >
                                <?php echo utf8_encode(trim($fila['apart_Sigla'])); ?> </option>

                                <?php } ?>
                            </select>   
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="persona_ID">Inquilino:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fa fa-city"></i></span>
                            <select class="form-control" id="persona_ID" name="persona_ID">
                            <option value="" selected>Seleccione ...</option>
                                <?php foreach($listaInquilinoApart as $fila){ ?>
                                <option value="<?php echo trim($fila['persona_ID']); ?>" >
                                <?php echo utf8_encode(trim($fila['persona_Nomb'])); ?> </option>

                                <?php } ?>
                            </select>   
                        </div>
                    </div>


                    <!--  -->                   

           <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="grabar" class="btn btn-primary" data-toggle="tooltip" title="Grabar Inquilino">Grabar</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

          <input type="hidden" id="nuevo" value="nuevo" name="accion"/>
      </fieldset>

    </form>
  </div>