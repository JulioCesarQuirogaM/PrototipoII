<?php include_once ("../Funciones/sessiones.php"); ?>
<!-- quick email widget -->


    <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="fpropietarioApart">
 					<div class="form-group">
                        <label class="control-label col-sm-2" for="propietarioApart_ID">Codigo:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="propietarioApart_ID" name="propietarioApart_ID" placeholder="Ingrese Codigo"
                            value = "" readonly="true"  data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="unidadres_ID">Unidad:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="unidadres_ID" name="unidadres_ID">
                            <option value="" selected>Seleccione ...</option>
                                <?php foreach($listaPropietarioApart as $fila){ ?>
                                <option value="<?php echo trim($fila['unidadres_ID']); ?>" >
                                <?php echo utf8_encode(trim($fila['unidadres_Nomb'])); ?> </option>

                                <?php } ?>
                            </select>   
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="apart_ID">Apartamento:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="apart_ID" name="apart_ID">
                            <option value="" selected>Seleccione ...</option>
                                <?php foreach($listaPropietarioApart as $fila){ ?>
                                <option value="<?php echo trim($fila['apart_ID']); ?>" >
                                <?php echo utf8_encode(trim($fila['apart_Sigla'])); ?> </option>

                                <?php } ?>
                            </select>   
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-2" for="persona_ID">Propietario:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="persona_ID" name="persona_ID">
                            <option value="" selected>Seleccione ...</option>
                                <?php foreach($listaPropietarioApart as $fila){ ?>
                                <option value="<?php echo trim($fila['persona_ID']); ?>" >
                                <?php echo utf8_encode(trim($fila['persona_Nomb'])); ?> </option>

                                <?php } ?>
                            </select>   
                        </div>
                    </div>	

                    <!--  -->	
					
                    

					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="actualizar" class="btn btn-primary" data-toggle="tooltip" title="Actualizar Propietario">Actualizar</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="editar" name="accion"/>
			</fieldset>

		</form>
	</div>