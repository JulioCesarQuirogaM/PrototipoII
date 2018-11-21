<?php
require_once '../Modelo/modeloUsuario.php';

switch ($_GET['accion']){
   
    case 'login':
        $usuario = htmlspecialchars(trim("$_GET[usuario]"));
        $password = htmlspecialchars(trim("$_GET[password]"));
        $datos = array("usuario"=>$usuario, "password"=>$password);
        $usuario = new Usuario();
        $usuario->consultar($datos);

        if($usuario->getUsuario_ID() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            if(password_verify($datos['password'],$usuario->getUsuario_pwd())){
                session_start();
                $_SESSION['usuario'] = $usuario->getUsuario_ID();
                $_SESSION['nombre'] = $usuario->getPersona_ID();                
                $_SESSION['apellido'] = $usuario->getPersona_ID();
                $_SESSION['rol'] = $usuario->getRol_ID();
                $respuesta = array(
                    'respuesta' =>'existe'
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'no existe'
                );
            }
            
        }
        echo json_encode($respuesta);
        break;
    break;
    case 'editar':
        $comuna = new Comuna();
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
        $usuario = new Usuario();
        $listado = $usuario->listaUsuario();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>
