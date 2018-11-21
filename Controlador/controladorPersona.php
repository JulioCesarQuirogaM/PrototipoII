<?php
 
require_once '../Modelo/modeloPersona.php';
$datos = $_GET;
switch ($_GET['accion']){

    case 'editar':
        $persona = new Persona();
        $resultado = $persona->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;

    case 'nuevo':
        $persona = new Persona();
        $resultado = $persona->nuevo($datos);
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
		$persona = new Persona();
		$resultado = $persona->borrar($datos['codigo']);
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
        $persona = new Persona();
        $persona->consultar($datos['codigo']);

        if($persona->getPersona_ID() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $persona->getPersona_ID(),
                'ciudads' => $persona ->getCiudad_ID(),
                'nombres' => $persona->getPersona_Nomb(),
                'apellidos' => $persona->getPersona_Apel(),
                'Sexo' => $persona->getSexo(),
                'Contacto' => $persona->getPersona_Cel(),
                'Mail' => $persona->getPersona_Mail(),
                'apartamentos' => $persona->getApart_ID(),
                'rols' => $persona->getRol_ID(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $persona = new Persona();
        $listado = $persona->listaPersona();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>