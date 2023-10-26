<?php

class Visita {
    private $conexion;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conexion = new mysqli($servername, $username, $password, $dbname);
        $this->conexion->set_charset('UTF8');

        if ($this->conexion->connect_error) {
            die("Error de conexión: ".$this->conexion->connect_error);
        }
    }

    public function hacerVisita($nombre,$lugar) {
        $sql = "SELECT idJesuita FROM jesuita WHERE nombre = '$nombre'";
        $result = $this->conexion->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $idJesuita = $row['idJesuita'];

                // Obtener la IP del lugar (puedes usar $lugar para buscar la IP)
                $sql = "SELECT ip FROM lugar WHERE Lugar = '$lugar'";
                $result = $this->conexion->query($sql);

                if ($result) {
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $ip = $row['ip'];

                        // Insertar la visita en la tabla visitas
                        $sql = "INSERT INTO visitas (idJesuita, ip, fechaHora) VALUES ('".$idJesuita."','".$ip."', now())";
                        $result = $this->conexion->query($sql);

                        if ($result) {
                            return "Visita registrada exitosamente.";
                        } else {
                            return "Error al registrar la visita: ".$this->conexion->error;
                        }
                    } else {
                        return "No se encontró la IP del lugar.";
                    }
                } else {
                    return "Error al obtener la IP del lugar: ".$this->conexion->error;
                }
            } else {
                return "No se encontró al jesuita con el nombre y firma proporcionados.";
            }
        } else {
            return "Error al obtener el idJesuita: ".$this->conexion->error;
        }
    }

    public function listarVisitas(){
        $sql = "SELECT v.idVisita, j.nombre, v.fechaHora, l.lugar
                    FROM visita v
                    INNER JOIN jesuita j ON v.idJesuita = j.idJesuita
                    INNER JOIN lugar l ON v.ip = l.ip
                    ORDER BY v.fechaHora DESC
                    LIMIT 5;";

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


