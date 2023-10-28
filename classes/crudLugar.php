<?php

class CrudLugar {
    private $conexion;
    public function __construct($servername, $username, $password, $dbname) {
        $this->conexion = new mysqli($servername, $username, $password, $dbname);
        $this->conexion->set_charset('UTF8');

        if ($this->conexion->connect_error) {
            die("Error de conexión: ".$this->conexion->connect_error);
        }
    }

    public function altaLugar($ip, $lugar, $descipcion) {
        $sql = "INSERT INTO lugar (ip, lugar, descripcion) VALUES ('".$ip."', '".$lugar."',$descipcion)";

        try {
            if ($this->conexion->query($sql) === TRUE) {
                $mensaje = "Lugar creado correctamente";
            } else {
                $mensaje = "Error al crear Lugar: ".$this->conexion->error;
            }
        } catch (mysqli_sql_exception $e) {
            // Verifica si el error es debido a una ip duplicada
            if ($e->getCode() === 1062) {
                $mensaje = "Error: El lugar asociado a esa IP ya existe en la base de datos.";
            } else {
                $mensaje = "Error: " . $e->getMessage();
            }
        }
        return $mensaje;
    }

    public function buscarLugar($ip){
        $sql = "SELECT ip, lugar, descripcion FROM lugar WHERE ip = '".$ip."';";
        $result = $this->conexion->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                return $result;
            } else {
                $mensaje = "No se encontró un Lugar con la IP seleccionada.";
            }
        } else {
            $mensaje = "Error al buscar Lugar: ".$this->conexion->error;
        }
        return $mensaje;
    }

    public function listarLugares(){
        $sql = "SELECT ip, lugar, descripcion FROM lugar order by lugar";
        $result = $this->conexion->query($sql);
        if ($result){
            if($result->num_rows > 0)
                return $result;
            else
                $mensaje =  "No existen Lugares";
        }else{
            $mensaje = "Error al buscar Lugares: ".$this->conexion->error;
        }
        return $mensaje;
    }

    public function nombreLugares(){
        $sql = "SELECT lugar FROM lugar order by lugar";
        $result = $this->conexion->query($sql);
        if ($result){
            if($result->num_rows > 0)
                return $result;
            else
                $mensaje =  "No existen Lugares";
        }else{
            $mensaje = "Error al buscar Lugares: ".$this->conexion->error;
        }
        return $mensaje;
    }

    public function modificarLugar($ip, $lugar, $descripcion) {
        $sql = "UPDATE lugar SET lugar = '".$lugar."', descripcion = '".$descripcion."' WHERE ip = '".$ip."';";

        if ($this->conexion->query($sql) === TRUE) {
            $mensaje = "Lugar modificado correctamente.";
        } else {
            $mensaje = "Error al modificar Lugar: ".$this->conexion->error;
        }
        return $mensaje;
    }

    public function borrarLugar($ip) {
        $sql = "DELETE FROM lugar WHERE ip = '".$ip."';";

        if ($this->conexion->query($sql) === TRUE) {
            $mensaje =  "Lugar borrado correctamente.";
        } else {
            $mensaje = "Error al borrar Lugar: ".$this->conexion->error;
        }
        return $mensaje;
    }

    public function __destruct() {
        $this->conexion->close();
    }
}


