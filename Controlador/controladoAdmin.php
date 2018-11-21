<?php
require_once '../Modelo/modeloRoot.php';

switch ($_POST['accion']){
    case 'editar':
        $User = new usuario();
        $resultado = $comuna->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $comuna = new Comuna();
        $resultado = $comuna->nuevo($datos);
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
        $comuna = new Comuna();
        $resultado = $comuna->borrar($datos['codigo']);
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
        $comuna = new Comuna();
        $comuna->consultar($datos['codigo']);

        if($comuna->getComu_codi() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $comuna->getComu_codi(),
                'comuna' => $comuna->getComu_nomb(),
                'municipio' =>$comuna->getMuni_codi(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $comuna = new Comuna();
        $listado = $comuna->listaUsuario();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>
