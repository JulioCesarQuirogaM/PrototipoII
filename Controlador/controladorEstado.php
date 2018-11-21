<?php
 
require_once '../Modelo/modeloEstado.php';
$datos = $_GET;

switch ($_GET['accion']){

    case 'editar':
        $estado = new Estado();
        $resultado = $estado->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
        
    case 'nuevo':
        $estado = new Estado();
        $resultado = $estado->nuevo($datos);
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
        $estado = new Estado();
        $resultado = $estado->borrar($datos['codigo']);
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
        $estado = new Estado();
        $estado->consultar($datos['codigo']);

        if($estado->getEstado_ID() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $estado->getEstado_ID(),               
                'estados' =>$estado->getEstado(),
                
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $estado = new Estado();
        $listado = $estado->listaEstado();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>