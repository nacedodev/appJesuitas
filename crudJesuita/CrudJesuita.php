<?php

class CrudJesuita {
    private $conexion;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conexion = new mysqli($servername, $username, $password, $dbname);

        if ($this->conexion->connect_error) {
            die("Error de conexión: ".$this->conexion->connect_error);
        }
    }

    public function altaJesuita($idJesuita, $nombre, $firma) {
        $sql = "INSERT INTO jesuita (idJesuita,nombre, firma) VALUES ('$idJesuita','$nombre','$firma')";

        try {
            if ($this->conexion->query($sql) === TRUE) {
                return "Jesuita creado correctamente.";
            } else {
                return "Error al crear Jesuita: ".$this->conexion->error;
            }
        } catch (mysqli_sql_exception $e) {
            // Verifica si el error es debido a una ip duplicada
            if ($e->getCode() === 1062) {
                return "Error: El Jesuita asociado a esa IP ya existe en la base de datos.";
            } else {
                return "Error: " . $e->getMessage();
            }
        }
    }

    public function listarJesuitas(){
        $sql = "SELECT idJesuita, nombre, firma FROM jesuita";
        $result = $this->conexion->query($sql);
        if ($result){
            if($result->num_rows > 0)
                return $result;
            else
                return  "No existen Jesuitas";
        }else{
            return "Error al buscar Jesuitas: ".$this->conexion->error;
        }
    }

    public function buscarJesuita($idJesuita){
        $sql = "SELECT idJesuita, nombre, firma FROM jesuita WHERE idJesuita = $idJesuita";
        $result = $this->conexion->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                return $result;
            } else {
                return "No se encontró un Jesuita con el ID proporcionado.";
            }
        } else {
            return "Error al buscar Jesuita: ".$this->conexion->error;
        }
    }

    public function modificarJesuita($idJesuita, $nombre, $firma) {
        $sql = "UPDATE jesuita SET nombre = '$nombre', firma = '$firma' WHERE idJesuita = $idJesuita";

        if ($this->conexion->query($sql) === TRUE) {
            return "Jesuita modificado correctamente.";
        } else {
            return "Error al modificar Jesuita: ".$this->conexion->error;
        }
    }

    public function borrarJesuita($idJesuita) {
        $sql = "DELETE FROM jesuita WHERE idJesuita = $idJesuita";

        if ($this->conexion->query($sql) === TRUE) {
            return "Jesuita borrado correctamente.";
        } else {
            return "Error al borrar Jesuita: ".$this->conexion->error;
        }
    }

    public function __destruct() {
        $this->conexion->close();
    }
}


