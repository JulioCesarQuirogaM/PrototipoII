<?php 
include_once ("../Funciones/sessiones.php");
?>
<!-- quick email widget -->


    <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="fvigilante">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="vigilante_ID">Codigo:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="vigilante_ID" name="vigilante_ID" placeholder="Codigo Vigilante"
                            value = "" readonly="true"  data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="vigilante_Nomb">Nombre Vigilante:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="vigilante_Nomb" name="vigilante_Nomb" placeholder="Nombre Vigilante"
                            value = "">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="vigilante_Apel">Apellido Vigilante:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="vigilante_Apel" name="vigilante_Apel" placeholder="Apellido Vigilante"
                            value = "">
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
                        <label class="control-label col-sm-2" for="unidadres_ID">Codigo Unidad:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="objeto_ID" name="objeto_ID">
                            <option value="" selected>Seleccione ...</option>
                                <?php foreach($listaObjeto as $fila){ ?>
                                <option value="<?php echo trim($fila['objeto_ID']); ?>" >
                                <?php echo utf8_encode(trim($fila['objeto_Descrip'])); ?> </option>

                                <?php } ?>
                            </select>   
                        </div>
                    </div>


                    <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="actualizar" class="btn btn-primary" data-toggle="tooltip" title="Actualizar Vigilante">Actualizar Vigilante</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

                    <input type="hidden" id="nuevo" value="editar" name="accion"/>
            </fieldset>

        </form>
    </div>