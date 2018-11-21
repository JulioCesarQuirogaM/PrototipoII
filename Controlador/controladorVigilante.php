<?php
 
require_once '../Modelo/modeloVigilante.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $vigilante = new Vigilante();
        $resultado = $vigilante->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $vigilante = new Vigilante();
        $resultado = $vigilante->nuevo($datos);
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
		$vigilante = new Vigilante();
		$resultado = $vigilante->borrar($datos['codigo']);
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
        $vigilante = new Vigilante();
        $vigilante->consultar($datos['codigo']);

        if($vigilante->getVigilante_ID() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $vigilante->getVigilante_ID(),
                'vigilante' => $vigilante->getVigilante_nomb(),
                'unidadres' =>$vigilante->getUnidadres_ID(),
                'objeto' =>$vigilante->getObjeto_Descrip(),
                'fechaingreso'=>$vigilante->getFecha_Ingreso(),
                'fechasalida'=>$vigilante->getFecha_Salida(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $vigilante = new Vigilante();
        $listado = $vigilante->listaVigilante();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>
