<?php

include_once 'usuario.php';

class apiusuario
{

    private $error;
    private $imagen;

    public function getAll()
    {
        $pelicula = new Pelicula();
        $peliculas = array();
        $peliculas["items"] = array();

        $res = $pelicula->obtenerPeliculas();

        if ($res->rowCount()) {
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {

                $item = array(
                    "id" => $row['id'],
                    "nombre" => $row['nombre'],
                    "imagen" => $row['imagen'],
                );
                array_push($peliculas["items"], $item);
            }

            $this->printJSON($peliculas);
        } else {
            $this->error('No hay elementos');
        }
    }

    public function getById($id)
    {
        $pelicula = new Pelicula();
        $peliculas = array();
        $peliculas["items"] = array();

        $res = $pelicula->obtenerPelicula($id);

        if ($res->rowCount() == 1) {
            $row = $res->fetch();

            $item = array(
                "id" => $row['id'],
                "nombre" => $row['nombre'],
                "imagen" => $row['imagen'],
            );
            array_push($peliculas["items"], $item);
            $this->printJSON($peliculas);
        } else {
            $this->error('No hay elementos');
        }
    }

    public function registrar($datos_usuario)
    {
        $usuario = new Usuario();
        $respuesta = array();
        $respuesta["items"] = array();

        $res = $usuario->registrarUsuario($datos_usuario);

        return $res;
    }

    public function autenticar($credenciales)
    {
        $usuario = new Usuario();
        $respuesta = array();

        $res = $usuario->autenticarUsuario($credenciales);

        if ($res->rowCount()) {
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {

                $item = array(
                    "id" => $row['id'],
                );
                array_push($respuesta, $item);
            }
            $this->printJSON($respuesta);
        } else {
            $this->error(null);
        }
    }

    public function add($item)
    {
        $pelicula = new Pelicula();

        $resultado = $pelicula->nuevaPelicula($item);
        return $resultado;
    }

    public function error($mensaje)
    {
        echo '<code>' . json_encode(array('mensaje' => $mensaje)) . '</code>';
    }

    public function exito($mensaje)
    {
        echo '<code>' . json_encode(array('mensaje' => $mensaje)) . '</code>';
    }

    public function printJSON($array)
    {
        echo '<code>' . json_encode($array) . '</code>';
    }

    public function getError()
    {
        return $this->error;
    }
}
