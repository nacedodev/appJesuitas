<?php

class CrudLugar {
    private $conexion;
    public function __construct($servername, $username, $password, $dbname) {
        $this->conexion = new mysqli($servername, $username, $password, $dbname);

        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    public function altaLugar($ip, $lugar, $descipcion) {
        $sql = "INSERT INTO lugar (ip,lugar, descripcion) VALUES ('$ip','$lugar', '$descipcion')";

        if ($this->conexion->query($sql) === TRUE) {
            return "Jesuita creado correctamente.";
        } else {
            return "Error al crear Jesuita: " . $this->conexion->error;
        }
    }

    public function buscarLugar($ip){
        $sql = "SELECT ip, lugar, descripcion FROM lugar WHERE ip = '".$ip."';";
        $result = $this->conexion->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                return $result;
            } else {
                return "No se encontró un Lugar con la IP seleccionada.";
            }
        } else {
            return "Error al buscar Lugar: " . $this->conexion->error;
        }
    }

    public function modificarLugar($ip, $lugar, $descripcion) {
        $sql = "UPDATE lugar SET lugar = '$lugar', descripcion = '$descripcion' WHERE ip = '".$ip."';";

        if ($this->conexion->query($sql) === TRUE) {
            return "Lugar modificado correctamente.";
        } else {
            return "Error al modificar Lugar: " . $this->conexion->error;
        }
    }

    public function borrarLugar($ip) {
        $sql = "DELETE FROM lugar WHERE ip = '".$ip."';";

        if ($this->conexion->query($sql) === TRUE) {
            return "Lugar borrado correctamente.";
        } else {
            return "Error al borrar Lugar: ". $this->conexion->error;
        }
    }

    public function __destruct() {
        $this->conexion->close();
    }
}


