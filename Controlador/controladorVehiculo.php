<?php
 
require_once '../Modelo/modeloVehiculo.php';
$datos = $_GET;

switch ($_GET['accion']){

    case 'editar':
        $pais = new Pais();
        $resultado = $pais->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
        
    case 'nuevo':
        $pais = new Pais();
        $resultado = $pais->nuevo($datos);
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
        $pais = new Pais();
        $resultado = $pais->borrar($datos['codigo']);
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
        $vehiculo = new Vehiculo();
        $vehiculo->consultar($datos['codigo']);

        if($vehiculo->getVehiculo_ID() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $vehiculo->getVehiculo_ID(),                
                'vehiculoDescrip' =>$vehiculo->getVehiculo_Descrip(),
                                
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $vehiculo = new Vehiculo();
        $listado = $vehiculo->listaVehiculo();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>