<?php
 
require_once '../Modelo/modeloestadoApart.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $estadoapart = new estApar();
        $resultado = $estadoapart->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $estadoapart = new estApar();
        $resultado = $estadoapart->nuevo($datos);
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
		$estadoapart = new estApar();
		$resultado = $estadoapart->borrar($datos['codigo']);
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
        $estadoapart = new estApar();
        $estadoapart->consultar($datos['codigo']);

        if($estadoapart->getApart_ID() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'aparEstado_ID' => $estadoapart->getAparEstado_ID(),
                'unidadres_ID' => $estadoapart->getUnidadres_ID(),
                'apart_ID' =>$estadoapart->getApart_ID(),
                'persona_ID' =>$estadoapart->getPersona_ID(),
                'apartamento_Estado' =>$estadoapart->getApartamento_Estado(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $estadoapart = new estApar();
        $listado = $estadoapart->listaEstApart();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>
