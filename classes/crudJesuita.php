<?php

class CrudJesuita {
    private $conexion;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conexion = new mysqli($servername, $username, $password, $dbname);
        $this->conexion->set_charset('UTF8');

        if ($this->conexion->connect_error) {
            die("Error de conexión: ".$this->conexion->connect_error);
        }
    }

    public function altaJesuita($idJesuita, $nombre, $firma) {
        $sql = "INSERT INTO jesuita (idJesuita,nombre, firma) VALUES ('".$idJesuita."','".$nombre."','".$firma."')";

        try {
            if ($this->conexion->query($sql) === TRUE) {
                $mensaje = "Jesuita creado correctamente.";
            } else {
                $mensaje = "Error al crear Jesuita: ".$this->conexion->error;
            }
        } catch (mysqli_sql_exception $e) {
            // Verifica si el error es debido a una ip duplicada
            if ($e->getCode() === 1062) {
                $mensaje = "Error: El Jesuita asociado a esa IP ya existe en la base de datos.";
            } else {
                $mensaje = "Error: " . $e->getMessage();
            }
        }
        return $mensaje;
    }

    public function listarJesuitas(){
        $sql = "select nombre from jesuita order by nombre;";
        $result = $this->conexion->query($sql);
        if ($result){
            if($result->num_rows > 0)
                return $result;
            else
                $mensaje = "No existen Jesuitas";
        }else{
            $mensaje = "Error al buscar Jesuitas: ".$this->conexion->error;
        }
        return $mensaje;
    }

        public function verificarJesuita($nombre, $firma) {
            $sql = "SELECT firma FROM jesuita WHERE nombre = '" . $nombre . "';";
            $result = $this->conexion->query($sql);

            if ($result) {
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $firmaJesuita = $row['firma'];

                    if ($firma == $firmaJesuita) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    $mensaje = "No se encontró al jesuita con el nombre proporcionado.";
                }
            } else {
                $mensaje = "Error al verificar al jesuita: ".$this->conexion->error;
            }
            return $mensaje;
        }

    public function listarFirmas(){
        $sql = "SELECT firma FROM jesuita order by firma";
        $result = $this->conexion->query($sql);
        if ($result){
            if($result->num_rows > 0)
                return $result;
            else
                $mensaje = "No existen Jesuitas";
        }else{
            $mensaje = "Error al buscar Jesuitas: ".$this->conexion->error;
        }
        return $mensaje;
    }

    public function buscarJesuita($idJesuita){
        $sql = "SELECT idJesuita, nombre, firma FROM jesuita WHERE idJesuita = '".$idJesuita."'";
        $result = $this->conexion->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                return $result;
            } else {
                $mensaje = "No se encontró un Jesuita con el ID proporcionado.";
            }
        } else {
            $mensaje = "Error al buscar Jesuita: ".$this->conexion->error;
        }
        return $mensaje;
    }

    public function modificarJesuita($idJesuita, $nombre, $firma) {
        $sql = "UPDATE jesuita SET nombre = '".$nombre."', firma = '".$firma."' WHERE idJesuita = '".$idJesuita."'";

        if ($this->conexion->query($sql) === TRUE) {
            $mensaje = "Jesuita modificado correctamente.";
        }else{
            $mensaje = "Error al modificar Jesuita: ".$this->conexion->error;
        }
        return $mensaje;
    }

    public function borrarJesuita($idJesuita) {
        $sql = "DELETE FROM jesuita WHERE idJesuita = '".$idJesuita."'";

        if ($this->conexion->query($sql) === TRUE) {
            $mensaje = "Jesuita borrado correctamente.";
        }else{
            $mensaje = "Error al borrar Jesuita: ".$this->conexion->error;
        }
        return $mensaje;
    }

    public function __destruct() {
        $this->conexion->close();
    }
}


