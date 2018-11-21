<?php
 
require_once '../Modelo/modeloObjetoApart.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $objApart = new objApart();
        $resultado = $objApart->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $objApart = new objApart();
        $resultado = $objApart->nuevo($datos);
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
		$objApart = new objApart();
		$resultado = $objApart->borrar($datos['codigo']);
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
        $objApart = new objApart();
        $objApart->consultar($datos['codigo']);

        if($objApart->getzonap() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'objetoxapto_ID' => $objApart->getobjetoxapto_ID(),
                'objeto_ID' => $objApart->getobjeto_ID(),
                'persona_ID' =>$objApart->getpersona_ID(),
                'Fecha_Entrada' =>$objApart->getFecha_Entrada(),
                'Fecha_salida' =>$objApart->getFecha_salida(),
                
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $objApart = new objApart();
        $listado = $objApart->listaObjApart();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>
