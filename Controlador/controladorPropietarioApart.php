<?php
 
require_once '../Modelo/modeloPropietarioApart.php';
$datos = $_GET;
switch ($_GET['accion']){

    case 'editar':
        $propietarioApart = new PropietarioApart();
        $resultado = $propietarioApart->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;

    case 'nuevo':
        $propietarioApart = new PropietarioApart();
        $resultado = $propietarioApart->nuevo($datos);
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
		$propietarioApart = new PropietarioApart();
		$resultado = $propietarioApart->borrar($datos['codigo']);
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
        $propietarioApart = new PropietarioApart();
        $propietarioApart->consultar($datos['codigo']);

        if($propietarioApart->getPropietarioApart_ID() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $propietarioApart->getPropietarioApart_ID(),
                'unidades' => $propietarioApart->getUnidadres_ID(),
                'apartamentos' =>$propietarioApart->getApart_ID(),
                'personas' =>$propietarioApart->getPersona_ID(),
               // 'propietario' =>$propietarioApart->getPropietarioApart_ID(),
                
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $propietarioApart = new PropietarioApart();
        $listado = $propietarioApart->listaPropietarioApart();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>
