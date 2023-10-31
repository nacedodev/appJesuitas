<?php
require '../config/configdb.php';
class ModelLugar{
    private $conexion; // Variable para almacenar la conexión a la base de datos

    // Constructor de la clase  se ejecuta al crear un objeto CrudLugar
    public function __construct($servername, $username, $password, $dbname)
    {
        // Establece una conexion con la base de datos utilizando los datos proporcionados
        $this->conexion = new mysqli($servername, $username, $password, $dbname);
        $this->conexion->set_charset('UTF8'); // Configura la codificacion de caracteres
        // Verifica si la conexion a la base de datos falla y muestra un mensaje de error
        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }
    // Método para agregar un lugar a la base de datos
    public function insertLugar($ip, $lugar, $descipcion)
    {
        $sql = "INSERT INTO lugar (ip, lugar, descripcion) VALUES ('" . $ip . "', '" . $lugar . "',$descipcion)";
        $result = $this->conexion->query($sql);
        return $result;
    }

    public function selectLugares(){

        $sql = "SELECT ip, lugar, descripcion FROM lugar order by lugar";
        $result = $this->conexion->query($sql);
        return $result;
    }

    public function selectLugaresByName(){

        $sql = "SELECT lugar FROM lugar order by lugar";
        $result = $this->conexion->query($sql);
        return $result;
    }

    public function updateLugar($ip,$lugar,$descripcion){

        $sql = "UPDATE lugar SET lugar = '".$lugar."', descripcion = '".$descripcion."' WHERE ip = '".$ip."';";
        $result = $this->conexion->query($sql);
        return $result;
    }

    public function deleteLugar($ip){

        $sql = "DELETE FROM lugar WHERE ip = '".$ip."'";
        $result = $this->conexion->query($sql);
        return $result;
    }

    public function selectLugar($ip){

        $sql = "SELECT ip, lugar, descripcion FROM lugar WHERE ip = '".$ip."';";
        $result = $this->conexion->query($sql);
        return $result;
    }

    public function __destruct() {
        $this->conexion->close();
    }

}
