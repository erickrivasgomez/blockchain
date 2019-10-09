<?php

include_once 'db.php';

class usuario extends DB{
    
    function autenticarUsuario($credenciales){
        $query = $this->connect()->prepare('SELECT id FROM usuarios WHERE nombre = :username AND password = md5(:password)');
        $query->execute([
            'username' => $credenciales['username'],
            'password' => $credenciales['password'],
            ]);
        return $query;
    }

    function obtenerPeliculas(){
        $query = $this->connect()->query('SELECT * FROM pelicula');
        return $query;
    }

    function obtenerPelicula($id){
        $query = $this->connect()->prepare('SELECT * FROM pelicula WHERE id = :id');
        $query->execute(['id' => $id]);
        return $query;
    }

    function registrarUsuario($usuario){
        $query = $this->connect()->prepare('INSERT INTO usuarios (nombre, password, firma) VALUES (:nombre, md5(:password), :firma)');
        $query->execute([
            'nombre' => $usuario['nombre'],
            'password' => $usuario['password'],
            'firma' => $usuario['firma'],
            ]);
        return $query;
    }

    /*
    INSERT INTO `transacciones`(`id_usuario`, `certificado`, `monto`, `fecha`, `comprobado`, `puntero`) 
    select 1,'dfdsggh',-10.90,now(),0,tr.id from transacciones tr where id_usuario = 1 ORDER BY id desc limit 1
    */

}

?>