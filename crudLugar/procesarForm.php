<?php
require 'CrudLugar.php';
require '../assets/config.php';

    $crud = new CrudLugar($host, $usuario, $password, $basedatos);
    $accion = $_POST["accion"];

    if ($accion === "Alta") {
        $ip = $_POST["ip"];
        $lugar = $_POST["lugar"];
        $descripcion = $_POST["descripcion"];

        if (count(explode('.',$ip)) === 4) {
            $resultado = $crud->altaLugar($ip, $lugar, $descripcion);
            echo $resultado;
        } else {
            echo "IP inválida.";
        }
    } elseif ($accion === "modificar") {
        $ip = $_POST["ip"];
        $lugar = $_POST["lugar"];
        $descripcion = $_POST["descripcion"];
        $resultado = $crud->modificarLugar($ip, $lugar, $descripcion);
        echo $resultado;
    } elseif ($accion === "borrar") {
        $ip = $_POST["ip"];
        $resultado = $crud->borrarLugar($ip);
        echo $resultado;
    }

    // Cierra la conexión a la base de datos
    unset($crud); //ESTO ES PARA LLAMAR AL DESTRUCTOR DE LA CLASE, EN ESTE CASO PARA QUE CIERRE LA CONEXION