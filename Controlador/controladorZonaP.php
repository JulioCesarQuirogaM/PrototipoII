<?php
 
require_once '../Modelo/modeloZonaP.php';
$datos = $_GET;
switch ($_GET['accion']){

    case 'editar':
        $zonaP = new ZonaP();
        $resultado = $zonaP->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
        
    case 'nuevo':
        $zonaP = new ZonaP();
        $resultado = $zonaP->nuevo($datos);
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
		$zonaP = new ZonaP();
		$resultado = $zonaP->borrar($datos['codigo']);
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
        $zonaP = new ZonaP();
        $zonaP->consultar($datos['codigo']);

        if($zonaP->getZonaP_ID() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $zonaP->getZonaP_ID(),
                'unidades' => $zonaP->getUnidadres_ID(),
                'zonaP_Des' =>$zonaP->getZonaP_Descrip(),
                'estados' =>$zonaP->getEstado_ID(),
                
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $zonaP = new ZonaP();
        $listado = $zonaP->listaZona();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>
