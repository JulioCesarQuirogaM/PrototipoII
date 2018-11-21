<?php include_once ("../Funciones/sessiones.php"); ?>
<!-- quick email widget -->

    <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="fciudad">
 					<div class="form-group">
                        <label class="control-label col-sm-1" for="ciudad_ID">Codigo:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-tags"></i></span>
                            <input type="text" class="form-control " id="ciudad_ID" name="ciudad_ID" placeholder="Ingrese Codigo"
                            value = "" readonly="true"  data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="ciudad_Nomb">Nombre:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-building"></i></span>
                            <input type="text" class="form-control" id="ciudad_Nomb" name="ciudad_Nomb" placeholder="Nombre de la Ciudad"
                            value = "">
                        </div>                    
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="pais_ID">Pais:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fa fa-city"></i></span>
                            <select class="form-control" id="pais_ID" name="pais_ID">
                            <option value="" selected>Seleccione ...</option>
                                <?php foreach($listaPais as $fila){ ?>
                                <option value="<?php echo trim($fila['pais_ID']); ?>" >
                                <?php echo utf8_encode(trim($fila['pais_Nomb'])); ?> </option>

                                <?php } ?>
                            </select>   
                        </div>
                    </div>
                    

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="estado_ID">Estado:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fa fa-city"></i></span>
                            <select class="form-control" id="estado_ID" name="estado_ID">
                            <option value="" selected>Seleccione ...</option>
                                <?php foreach($listaPais as $fila){ ?>
                                <option value="<?php echo trim($fila['estado_ID']); ?>" >
                                <?php echo utf8_encode(trim($fila['estado'])); ?> </option>

                                <?php } ?>
                            </select>   
                        </div>
                    </div>

					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="grabar" class="btn btn-primary" data-toggle="tooltip" title="Grabar Ciudad">Grabar</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="nuevo" name="accion"/>
			</fieldset>

		</form>
	</div>