<?php
    function usuarioAutenticado(){
        if(!verificarUsuario()){
            header("location:../../Login.php");
            exit();
        }
    }
    function verificarUsuario(){
        return isset($_SESSION["usuario"]);
    }
    session_start();
    usuarioAutenticado();

?>