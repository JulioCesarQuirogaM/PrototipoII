<?php include_once ("../Funciones/sessiones.php"); ?>
<!-- quick email widget -->


    <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="fpersona">
 					<div class="form-group">
                        <label class="control-label col-sm-1" for="persona_ID">C.C.:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-tags"></i></span>
                            <input type="text" class="form-control " id="persona_ID" name="persona_ID" placeholder="Ingrese Numero de Identificacion"
                            value = "" readonly="true" data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="ciudad_ID">Ciudad:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-home"></i></span>
                            <select class="form-control" id="ciudad_ID" name="ciudad_ID">
                            <option value="" selected>Seleccione ...</option>
                                <?php foreach($listaPersona as $fila){ ?>
                                <option value="<?php echo trim($fila['ciudad_ID']); ?>" >
                                <?php echo utf8_encode(trim($fila['ciudad_Nomb'])); ?> </option>

                                <?php } ?>
                            </select>   
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="persona_Nomb">Nombre:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" id="persona_Nomb" name="persona_Nomb" placeholder="Ingrese Nombre de la Persona"
                            value = "">
                        </div>                    
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="persona_Apel">Apellido:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" id="persona_Apel" name="persona_Apel" placeholder="Ingrese Apellido de la Persona"
                            value = "">
                        </div>                    
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="sexo">Sexo:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" id="sexo" name="sexo" placeholder="Ingrese la inicial del Sexo"
                            value = "">
                        </div>                    
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="persona_Cel">Cel:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-phone"></i></span>
                            <input type="text" class="form-control" id="persona_Cel" name="persona_Cel" placeholder="Ingrese Numero Celular de la Persona"
                            value = "">
                        </div>                    
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="persona_Mail">Mail:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-envelope"></i></span>
                            <input type="text" class="form-control" id="persona_Mail" name="persona_Mail" placeholder="Ingrese Mail de la Persona"
                            value = "">
                        </div>                    
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-sm-1" for="apart_ID">Apartamento:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-home"></i></span>
                            <select class="form-control" id="apart_ID" name="apart_ID">
                            <option value="" selected>Seleccione ...</option>
                                <?php foreach($listaPersona as $fila){ ?>
                                <option value="<?php echo trim($fila['apart_ID']); ?>" >
                                <?php echo utf8_encode(trim($fila['apart_Sigla'])); ?> </option>

                                <?php } ?>
                            </select>   
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-sm-1" for="rol_ID">Rol:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-addon"><i class="fas fa-clipboard-list"></i></span>
                            <select class="form-control" id="rol_ID" name="rol_ID">
                            <option value="" selected>Seleccione ...</option>
                                <?php foreach($listaPersona as $fila){ ?>
                                <option value="<?php echo trim($fila['rol_ID']); ?>" >
                                <?php echo utf8_encode(trim($fila['rol_Descripcion'])); ?> </option>

                                <?php } ?>
                            </select>   
                        </div>
                    </div>

					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="actualizar" class="btn btn-primary" data-toggle="tooltip" title="Actualizar">Actualizar</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="editar" name="accion"/>
			</fieldset>

		</form>
	</div>
