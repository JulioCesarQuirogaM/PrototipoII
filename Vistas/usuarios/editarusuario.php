<?php 
include_once ("../Funciones/sessiones.php");
?>
<!-- quick email widget -->


    <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="usuario">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="usuario_ID">Codigo:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="usuario_ID" name="usuario_ID" placeholder="Codigo Usuario"
                            value = "" readonly="true"  data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="unidadres_ID">Codigo Unidad:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="unidadres_ID" name="unidadres_ID">
                            <option value="" selected>Seleccione ...</option>
                                <?php foreach($listaUnidad as $fila){ ?>
                                <option value="<?php echo trim($fila['unidadres_ID']); ?>" >
                                <?php echo utf8_encode(trim($fila['unidadres_Nomb'])); ?> </option>

                                <?php } ?>
                            </select>   
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="persona_ID">Documento Persona:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="persona_ID" name="persona_ID">
                            <option value="" selected>Seleccione ...</option>
                                <?php foreach($listaPersona as $fila){ ?>
                                <option value="<?php echo trim($fila['persona_ID']); ?>" >
                                <?php echo utf8_encode(trim($fila['persona_Nomb'])); ?> </option>

                                <?php } ?>
                            </select>   
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="rol_ID">Rol Usuario:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="rol_ID" name="rol_ID">
                            <option value="" selected>Seleccione ...</option>
                                <?php foreach($listaRol as $fila){ ?>
                                <option value="<?php echo trim($fila['rol_ID']); ?>" >
                                <?php echo utf8_encode(trim($fila['rol_ID'])); ?> </option>

                                <?php } ?>
                            </select>   
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="usuario_Login">Usuario:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="usuario_Login" name="usuario_Login" placeholder="Usuario"
                            value = "">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="usuario_Pass">Contraseña:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="usuario_Pass" name="usuario_Pass" placeholder="Contraseña"
                            value = "">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="usuario_Estado">Estado Usuario:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="usuario_Estado" name="usuario_Estado" placeholder="Estado"
                            value = "">
                        </div>
                    </div>

                    
                    
                    <!-- <div class="form-group">
                        <label class="control-label col-sm-2" for="muni_codi">Municipio:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="muni_codi" name="muni_codi">
                            <option value="" selected>Seleccione ...</option>
                                <?php foreach($listaMunicipio as $fila){ ?>
                                <option value="<?php echo trim($fila['muni_codi']); ?>" >
                                <?php echo utf8_encode(trim($fila['muni_nomb'])); ?> </option>

                                <?php } ?>
                            </select>   
                        </div>
                    </div> -->

                     <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="actualizar" class="btn btn-primary" data-toggle="tooltip" title="Actualizar Usuario">Actualizar Usuario</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

                    <input type="hidden" id="nuevo" value="editar" name="accion"/>
            </fieldset>

        </form>
    </div>