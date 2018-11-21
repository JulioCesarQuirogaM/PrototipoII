<?php
 
require_once '../Modelo/modeloBloque.php';
$datos = $_GET;
switch ($_GET['accion']){

    case 'editar':
        $bloque = new Bloque();
        $resultado = $bloque->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;

    case 'nuevo':
        $bloque = new Bloque();
        $resultado = $bloque->nuevo($datos);
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
        $bloque = new Bloque();
        $resultado = $bloque->borrar($datos['codigo']);
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
        $bloque = new Bloque();
        $bloque->consultar($datos['codigo']);

        if($bloque->getBloque_ID() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $bloque->getBloque_ID(),
                'unidades' => $bloque->getUnidadres_ID(),
                'bloque_Des' =>$bloque->getBloque_Descrip(),
                'estados' =>$bloque->getEstado_ID(),
                
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $bloque = new Bloque();
        $listado = $bloque->listaBloque();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>
