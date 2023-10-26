<?php
require '../classes/crudLugar.php';
require '../config/configdb.php';

    $crud = new CrudLugar(HOST, USUARIO, PASSWORD, BASEDATOS);
    $accion = $_POST["accion"];

    if ($accion === "Alta") {
        $ip = $_POST["ip"];
        $lugar = $_POST["lugar"];
        $descripcion = empty($_POST["descripcion"]) ? "NULL" : "'".$_POST["descripcion"]."'";

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