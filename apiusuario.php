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

    public function autenticar($credenciales)
    {
        $usuario = new Usuario();
        $respuesta = array();

        $resultado = $usuario->autenticarUsuario($credenciales);
        if ($resultado->rowCount() == 1) {
            $row = $res->fetch();

            $item = array(
                "id" => $row['id'],
            );
            array_push($respuesta["items"], $item);
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

    public function subirImagen($file)
    {
        $directorio = "imagenes/";

        $this->imagen = basename($file["name"]);
        $archivo = $directorio . basename($file["name"]);

        $tipoArchivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));

        // valida que es imagen
        $checarSiImagen = getimagesize($file["tmp_name"]);

        if ($checarSiImagen != false) {
            //validando tamaño del archivo
            $size = $file["size"];

            if ($size > 500000) {
                $this->error = "El archivo tiene que ser menor a 500kb";
                return false;
            } else {

                //validar tipo de imagen
                if ($tipoArchivo == "jpg" || $tipoArchivo == "jpeg") {
                    // se validó el archivo correctamente
                    if (move_uploaded_file($file["tmp_name"], $archivo)) {
                        //echo "El archivo se subió correctamente";
                        return true;
                    } else {
                        $this->error = "Hubo un error en la subida del archivo";
                        return false;
                    }
                } else {
                    $this->error = "Solo se admiten archivos jpg/jpeg";
                    return false;
                }
            }
        } else {
            $this->error = "El documento no es una imagen";
            return false;
        }
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function getError()
    {
        return $this->error;
    }
}
