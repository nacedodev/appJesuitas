<?php
require 'CrudJesuita.php';
$host = 'localhost';
$usuario = 'root';
$password = '';
$basedatos = 'Jesuitas';

    $crud = new CrudJesuita($host, $usuario, $password, $basedatos);
    $accion = $_POST["accion"];

    if ($accion === "Alta") {
        $idJesuita = $_POST["idJesuita"];
        $nombre = $_POST["nombre"];
        $firma = $_POST["firma"];

        if ($idJesuita > 0) {
            $resultado = $crud->altaJesuita($idJesuita, $nombre, $firma);
            echo $resultado;
        } else {
            echo "ID de Jesuita inválido.";
        }
    } elseif ($accion === "modificar") {
        $idJesuita = $_POST["idJesuita"];
        $nombre = $_POST["nombre"];
        $firma = $_POST["firma"];
        $resultado = $crud->modificarJesuita($idJesuita, $nombre, $firma);
        echo $resultado;
    } elseif ($accion === "borrar") {
        $idJesuita = $_POST["idJesuita"];
        $resultado = $crud->borrarJesuita($idJesuita);
        echo $resultado;
    }

    // Cierra la conexión a la base de datos
    unset($crud); //ESTO ES PARA LLAMAR AL DESTRUCTOR DE LA CLASE, EN ESTE CASO PARA QUE CIERRE LA CONEXION