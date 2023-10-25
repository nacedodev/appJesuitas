<?php

class Visita {
    private $conexion;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conexion = new mysqli($servername, $username, $password, $dbname);

        if ($this->conexion->connect_error) {
            die("Error de conexión: ".$this->conexion->connect_error);
        }
    }

    public function hacerVisita($idJesuita, $ip) {
        $sql = "INSERT INTO visita (idJesuita,ip, fechaHora) VALUES ('$idJesuita','$ip', now())";

        try {
            if ($this->conexion->query($sql) === TRUE) {
                return "Visita creada correctamente.";
            } else {
                return "Error al crear la Visita: ".$this->conexion->error;
            }
        } catch (mysqli_sql_exception $e) {
            // Verifica si el error es debido a una ip duplicada
            if ($e->getCode() === 1062) {
                return "Ya has visitado esta ciudad , prueba con otra";
            } else {
                return "Error: ".$e->getMessage();
            }
        }
    }

    public function listarVisitas(){
        $sql = "SELECT idJesuita, ip, fechaHora FROM visita";
        $result = $this->conexion->query($sql);
        if ($result){
            if($result->num_rows > 0)
                return $result;
            else
                return  "No existen Visitas";
        }else{
            return "Error al buscar Visitas: ".$this->conexion->error;
        }
    }

    public function __destruct() {
        $this->conexion->close();
    }
}


