<?php
include_once 'apitransacciones.php';
include_once 'apiusuario.php';

switch ($_POST["accion"]) {
    case 'registrarUsuario':
        echo 'registrarUsuario';
        $apiusuario = new apiusuario();
        $usuario = array(
            "nombre" => $_POST["nombre"],
            "firma" => $_POST["firma"],
            "password" => $_POST["password"],
        );
        $apiusuario->registrar($usuario);
        break;

    default:
        # code...
        break;
}
?>