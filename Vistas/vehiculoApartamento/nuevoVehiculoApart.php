<?php include_once ("../Funciones/sessiones.php"); ?>
<!-- quick email widget -->

    <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="fvehiculoApart">
 					<div class="form-group">
                        <label class="control-label col-sm-1" for="vehiculoApart_ID">Codigo:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-tags"></i></span>
                            <input type="text" class="form-control " id="vehiculoApart_ID" name="vehiculoApart_ID" placeholder="Ingrese Codigo"
                            value = "" readonly="true"  data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="vehiculo_ID">Vehiculo:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fa fa-city"></i></span>
                            <select class="form-control" id="vehiculo_ID" name="vehiculo_ID">
                            <option value="" selected>Seleccione ...</option>
                                <?php foreach($listaVehiculoApart as $fila){ ?>
                                <option value="<?php echo trim($fila['vehiculo_ID']); ?>" >
                                <?php echo utf8_encode(trim($fila['vehiculo_Descrip'])); ?> </option>

                                <?php } ?>
                            </select>   
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="placa">Placa:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-building"></i></span>
                            <input type="text" class="form-control" id="placa" name="placa" placeholder="Placa"
                            value = "">
                        </div>                    
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="persona_ID">Propietario:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fa fa-city"></i></span>
                            <select class="form-control" id="persona_ID" name="persona_ID">
                            <option value="" selected>Seleccione ...</option>
                                <?php foreach($listaVehiculoApart as $fila){ ?>
                                <option value="<?php echo trim($fila['persona_ID']); ?>" >
                                <?php echo utf8_encode(trim($fila['persona_Nomb'])); ?> </option>

                                <?php } ?>
                            </select>   
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="bloque_ID">Bloque:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fa fa-city"></i></span>
                            <select class="form-control" id="bloque_ID" name="bloque_ID">
                            <option value="" selected>Seleccione ...</option>
                                <?php foreach($listaVehiculoApart as $fila){ ?>
                                <option value="<?php echo trim($fila['bloque_ID']); ?>" >
                                <?php echo utf8_encode(trim($fila['bloque_Descrip'])); ?> </option>

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
                                <?php foreach($listaVehiculoApart as $fila){ ?>
                                <option value="<?php echo trim($fila['apart_ID']); ?>" >
                                <?php echo utf8_encode(trim($fila['apart_Descrip'])); ?> </option>

                                <?php } ?>
                            </select>   
                        </div>
                    </div>                    

					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="grabar" class="btn btn-primary" data-toggle="tooltip" title="Grabar Vehiculo por Apartamento">Grabar</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="nuevo" name="accion"/>
			</fieldset>

		</form>
	</div>