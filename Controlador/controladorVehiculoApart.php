<?php
 
require_once '../Modelo/modeloVehiculoApart.php';
$datos = $_GET;
switch ($_GET['accion']){

    case 'editar':
        $vehiculoApart = new VehiculoApart();
        $resultado = $vehiculoApart->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
        
    case 'nuevo':
        $vehiculoApart = new VehiculoApart();
        $resultado = $vehiculoApart->nuevo($datos);
        if($resultado > 0) {
            $respuesta = array(
                'respuesta' => $resultado
            );
        }  else {
            $respuesta = array(
                'respuesta' => $resultado
            );
        }
        echo json_encode($respuesta);
        break;
       
    case 'borrar':
		$vehiculoApart = new VehiculoApart();
		$resultado = $vehiculoApart->borrar($datos['codigo']);
        if($resultado > 0) {
            $respuesta = array(
                'respuesta' => 'correcto'
            );
        }  else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'consultar':
        $vehiculoApart = new VehiculoApart();
        $vehiculoApart->consultar($datos['codigo']);

        if($vehiculoApart->getVehiculoApart_ID() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $vehiculoApart->getVehiculoApart_ID(),
                'vehiculos' => $vehiculoApart->getVehiculo_ID(),
                'placaVehi' =>$vehiculoApart->getPlaca(),
                'personas' =>$vehiculoApart->getPersona_ID(),
                'bloques' =>$vehiculoApart->getBloque_ID(),
                'apartamentos' =>$vehiculoApart->getApart_ID(),
                
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $vehiculoApart = new VehiculoApart();
        $listado = $vehiculoApart->listaVehiculoApart();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>
