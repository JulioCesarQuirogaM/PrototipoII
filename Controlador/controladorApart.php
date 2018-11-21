<?php
 
require_once '../Modelo/modeloApart.php';
$datos = $_GET;
switch ($_GET['accion']){

    case 'editar':
        $apartamento = new Apartamento();
        $resultado = $apartamento->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;

    case 'nuevo':
        $apartamento = new Apartamento();
        $resultado = $apartamento->nuevo($datos);
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
		$apartamento = new Apartamento();
		$resultado = $apartamento->borrar($datos['codigo']);
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
        $apartamento = new Apartamento();
        $apartamento->consultar($datos['codigo']);

        if($apartamento->getApart_ID() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $apartamento->getApart_ID(),
                'unidades' => $apartamento->getUnidadres_ID(),
                'bloques' =>$apartamento->getBloque_ID(),
                'apartSigla' =>$apartamento->getApart_Sigla(),
                'estados' =>$apartamento->getEstado_ID(),
                
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $apartamento = new Apartamento();
        $listado = $apartamento->listaApartamento();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>
