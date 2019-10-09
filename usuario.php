<?php

include_once 'db.php';

class usuario extends DB{
    
    function autenticarUsuario($credenciales){
        $query = $this->connect()->prepare('SELECT id FROM usuarios WHERE nombre = :username AND password = :password');
        echo  md5($credenciales['password']);
        $query->execute([
            'username' => $credenciales['username'],
            'password' => md5($credenciales['password']),
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

    function nuevaPelicula($pelicula){
        $query = $this->connect()->prepare('INSERT INTO pelicula (nombre, imagen) VALUES (:nombre, :imagen)');
        $query->execute(['nombre' => $pelicula['nombre'], 'imagen' => $pelicula['imagen']]);
        return $query;
    }

    /*
    INSERT INTO `transacciones`(`id_usuario`, `certificado`, `monto`, `fecha`, `comprobado`, `puntero`) 
    select 1,'dfdsggh',-10.90,now(),0,tr.id from transacciones tr where id_usuario = 1 ORDER BY id desc limit 1
    */

}

?>