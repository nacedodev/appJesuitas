<?php
require '../models/modelLugar.php';
// definicion de la clase CrudLugar
class CrudLugar {
    private $conexion; // Variable para almacenar la conexión a la base de datos
    private $model;
    // Constructor de la clase  se ejecuta al crear un objeto CrudLugar
    public function __construct($servername, $username, $password, $dbname) {
        // Establece una conexion con la base de datos utilizando los datos proporcionados
        $this->conexion = new mysqli($servername, $username, $password, $dbname);
        $this->conexion->set_charset('UTF8'); // Configura la codificacion de caracteres
        $this->model = new ModelLugar($servername,$username,$password,$dbname);
        // Verifica si la conexion a la base de datos falla y muestra un mensaje de error
        if ($this->conexion->connect_error) {
            die("Error de conexión: ".$this->conexion->connect_error);
        }
    }
    // Método para agregar un lugar a la base de datos
    public function altaLugar($ip, $lugar, $descipcion) {
        // $descricpion no lleva comillas ya que se le añaden a la propia variable dependiendo si tiene contenido o no
        try {
            if ($this->model->insertLugar($ip,$lugar,$descipcion)) {
                $mensaje = "Lugar creado correctamente";
            } else {
                $mensaje = "Error al crear Lugar";
            }
        } catch (mysqli_sql_exception $e) {
            // Verifica si el error es debido a una ip duplicada y muestra un mensaje adecuado
            if ($e->getCode() === 1062) {
                $mensaje = "El lugar asociado a esa IP ya existe en la base de datos.";
            } else {
                $mensaje = "Error: ". $e->getMessage();
            }
        }
        return $mensaje; // Devuelve un mensaje indicando el resultado de la operacion
    }

    // Método para listar todos los lugares de la base de datos
    public function listarLugares(){
        $result = $this->model->selectLugares();
        if ($result){
            if($result->num_rows > 0)
                return $result; // Si hay lugares , devuelve los resultados
            else
                $mensaje =  "No existen Lugares";
        }else{
            $mensaje = "Error al buscar Lugares";
        }
        return $mensaje; // Devuelve un mensaje indicando el resultado de la operación
    }
    // Método para listar solo los nombres de los lugares
    public function nombreLugares(){
        $result = $this->model->selectLugaresByName();
        if ($result){
            if($result->num_rows > 0)
                return $result; // Si hay lugares, devuelve los resultados
            else
                $mensaje =  "No existen Lugares";
        }else{
            $mensaje = "Error al buscar Lugares";
        }
        return $mensaje; // Devuelve un mensaje indicando el resultado de la operación
    }
    // Método para modificar la información de un lugar existente
    public function modificarLugar($ip, $lugar, $descripcion) {

        if ($this->model->updateLugar($ip,$lugar,$descripcion)) {
            $mensaje = "Lugar modificado correctamente.";
        } else {
            $mensaje = "Error al modificar Lugar";
        }
        return $mensaje; // Devuelve un mensaje indicando el resultado de la operación
    }
    // Método para eliminar un lugar de la base de datos
    public function borrarLugar($ip) {

        if ($this->model->deleteLugar($ip)) {
            $mensaje =  "Lugar borrado correctamente.";
        } else {
            $mensaje = "Error al borrar Lugar: ".$this->conexion->error;
        }
        return $mensaje; // Devuelve un mensaje indicando el resultado de la operación
    }

    public function buscarLugar($ip)
    {
        $result = $this->model->selectLugar($ip);

        if ($result) {
            if ($result->num_rows > 0) {
                return $result; // Si se encontraron resultados , devuelve los resultados.
            } else {
                $mensaje = "No se encontró un Lugar con la IP seleccionada.";
            }
        } else {
            $mensaje = "Error al buscar Lugar: ".$this->conexion->error;
        }
        return $mensaje; // Devuelve un mensaje indicando el resultado de la búsqueda
    }

    public function __destruct() {
        unset($this->model);
    }
}