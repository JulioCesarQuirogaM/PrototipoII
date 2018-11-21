<?php include_once ("../Funciones/sessiones.php"); ?>
<!-- quick email widget -->


    <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="fzonaP">
 					<div class="form-group">
                        <label class="control-label col-sm-2" for="zonaP_ID">Codigo:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="zonaP_ID" name="zonaP_ID" placeholder="Ingrese Codigo"
                            value = "" readonly="true"  data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="unidadres_ID">Unidad Residencial:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="unidadres_ID" name="unidadres_ID">
                            <option value="" selected>Seleccione ...</option>
                                <?php foreach($listaZona as $fila){ ?>
                                <option value="<?php echo trim($fila['unidadres_ID']); ?>" >
                                <?php echo utf8_encode(trim($fila['unidadres_Nomb'])); ?> </option>

                                <?php } ?>
                            </select>   
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-2" for="zonaP_Descrip">Zona Publica:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="zonaP_Descrip" name="zonaP_Descrip" placeholder="Ingrese La Zona Publicaa"
                            value = "">
                        </div>
                    </div>	

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="estado_ID">Estado:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="estado_ID" name="estado_ID">
                            <option value="" selected>Seleccione ...</option>
                                <?php foreach($listaZona as $fila){ ?>
                                <option value="<?php echo trim($fila['estado_ID']); ?>" >
                                <?php echo utf8_encode(trim($fila['estado'])); ?> </option>

                                <?php } ?>
                            </select>   
                        </div>
                    </div>			
					
                    

					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="actualizar" class="btn btn-primary" data-toggle="tooltip" title="Actualizar Zona Publica">Actualizar</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="editar" name="accion"/>
			</fieldset>

		</form>
	</div>