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

    public function hacerVisita($nombre,$lugar,$firma) {
        $sql = "SELECT idJesuita FROM jesuita WHERE nombre = '".$nombre."' AND firma = '".$firma."'";
        $result = $this->conexion->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $idJesuita = $row['idJesuita'];

                $sql = "SELECT ip FROM lugar WHERE lugar = '".$lugar."'";
                $result = $this->conexion->query($sql);

                if ($result) {
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $ip = $row['ip'];
                        // Insertar la visita en la tabla visitas
                        $sql = "INSERT INTO visita (idJesuita, ip, fechaHora) VALUES ('".$idJesuita."','".$ip."', now())";
                        $result = $this->conexion->query($sql);

                        if ($result) {
                            $mensaje = "Visita registrada exitosamente.";
                        } else {
                            $mensaje = "Error al registrar la visita: ".$this->conexion->error;
                        }
                    } else {
                        $mensaje = "No se encontró la IP del lugar.";
                    }
                } else {
                    $mensaje = "Error al obtener la IP del lugar: ".$this->conexion->error;
                }
            } else {
                $mensaje = "No se encontró al jesuita con el nombre y firma proporcionados.";
            }
        } else {
            $mensaje = "Error al obtener el idJesuita: ".$this->conexion->error;
        }
        return $mensaje;
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
                $mensaje =  "No existen Visitas";
        }else{
            $mensaje = "Error al buscar Visitas: ".$this->conexion->error;
        }
        return $mensaje;
    }

    public function __destruct() {
        $this->conexion->close();
    }
}


