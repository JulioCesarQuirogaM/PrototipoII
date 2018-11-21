<?php
 
require_once '../Modelo/modeloInquilinoApart.php';
$datos = $_GET;
switch ($_GET['accion']){

    case 'editar':
        $inquilinoApart = new InquilinoApart();
        $resultado = $inquilinoApart->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;

    case 'nuevo':
        $inquilinoApart = new InquilinoApart();
        $resultado = $inquilinoApart->nuevo($datos);
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
		$inquilinoApart = new InquilinoApart();
		$resultado = $inquilinoApart->borrar($datos['codigo']);
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
        $inquilinoApart = new InquilinoApart();
        $inquilinoApart->consultar($datos['codigo']);

        if($inquilinoApart->getInquilinoApart_ID() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $inquilinoApart->getInquilinoApart_ID(),
                'unidades' => $inquilinoApart->getUnidadres_ID(),
                'apartamento' =>$inquilinoApart->getApart_ID(),
                'persona' =>$inquilinoApart->getPersona_ID(),
               // 'propietario' =>$inquilinoApart->getPropietarioApart_ID(),
                
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $inquilinoApart = new InquilinoApart();
        $listado = $inquilinoApart->listaInquilinoApart();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>
