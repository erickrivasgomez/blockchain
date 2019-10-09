<?php
    include_once 'apitransacciones.php';
    include_once 'apiusuario.php';

    $api = new apitransacciones();
    $apiusuario = new apiusuario();

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        if(is_numeric($id)){
            $api->obtenertransacciones($id);
        }else{
            $api->error('El id es incorrecto');
        }
    }else{
        $api->obtenertransacciones($id);
    }

    if(isset($_GET['username'])){
        $credenciales = array(
            'username' => $_GET['username'],
            'password' => $_GET['password'],
        );

        $apiusuario->autenticar($credenciales);
    }else{
        $api->obtenertransacciones($id);
    }
    
?>