<?php include_once ("../Funciones/sessiones.php"); ?>
<!-- quick email widget -->


    <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="fciudad">
 					<div class="form-group">
                        <label class="control-label col-sm-2" for="ciudad_ID">Codigo:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="ciudad_ID" name="ciudad_ID" placeholder="Ingrese Codigo"
                            value = "" readonly="true"  data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="ciudad_Nomb">Ciudad:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="ciudad_Nomb" name="ciudad_Nomb" placeholder="Ingrese La Ciudad"
                            value = "">
                        </div>
                    </div>  

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pais_ID">Pais:</label>
                        <div class="col-sm-10">
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
                        <label class="control-label col-sm-2" for="estado_ID">Estado:</label>
                        <div class="col-sm-10">
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
                            <button type="button" id="actualizar" class="btn btn-primary" data-toggle="tooltip" title="Actualizar Ciudad">Actualizar</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="editar" name="accion"/>
			</fieldset>

		</form>
	</div>