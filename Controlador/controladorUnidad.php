<?php
 
require_once '../Modelo/modeloUnidad.php';
$datos = $_GET;
switch ($_GET['accion']){

    case 'editar':
        $unidad = new Unidad();
        $resultado = $unidad->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;

    case 'nuevo':
        $unidad = new Unidad();
        $resultado = $unidad->nuevo($datos);
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
		$unidad = new Unidad();
		$resultado = $unidad->borrar($datos['codigo']);
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
        $unidad = new Unidad();
        $unidad->consultar($datos['codigo']);

        if($unidad->getUnidadres_ID() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $unidad->getUnidadres_ID(),
                'ciudad_Uni' => $unidad->getCiudad_ID(),
                'unidad_Nom' =>$unidad->getUnidadres_Nomb(),
                'unidad_Dire' =>$unidad->getUnidadres_Dir(),
                'unidadres_Tele' =>$unidad->getUnidadres_Tel(),
                'esatados' =>$unidad->getEstado_ID(),
                
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $unidad = new Unidad();
        $listado = $unidad->listaUnidad();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>
