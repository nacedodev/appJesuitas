<?php

class Visita {
    private $conexion;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conexion = new mysqli($servername, $username, $password, $dbname);

        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    public function hacerVisita($idJesuita, $ip) {
        $sql = "INSERT INTO visita (idJesuita,ip, fechaHora) VALUES ('$idJesuita','$ip', now())";

        if ($this->conexion->query($sql) === TRUE) {
            return "Visita creada correctamente.";
        } else {
            return "Error al crear la Visita: " . $this->conexion->error;
        }
    }

    public function __destruct() {
        $this->conexion->close();
    }
}


