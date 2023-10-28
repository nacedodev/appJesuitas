<?php
require '../classes/crudLugar.php';
require '../config/configdb.php';

    $crud = new CrudLugar(HOST, USUARIO, PASSWORD, BASEDATOS);
    $accion = $_GET["accion"];

    if ($accion === "Alta") {
        $ip = $_GET["ip"];
        $lugar = $_GET["lugar"];
        $descripcion = empty($_GET["descripcion"]) ? "NULL" : "'".$_GET["descripcion"]."'";

        if (count(explode('.',$ip)) === 4) {
            $resultado = $crud->altaLugar($ip, $lugar, $descripcion);
            header("Location: listar.php");
        } else {
            echo "IP inválida.";
        }
    } elseif ($accion === "modificar") {
        $ip = $_GET["ip"];
        $lugar = $_GET["lugar"];
        $descripcion = $_GET["descripcion"];
        $resultado = $crud->modificarLugar($ip, $lugar, $descripcion);
        header("Location: listar.php");
    } elseif ($accion === "borrar") {
        $ip = $_GET["ip"];
        $resultado = $crud->borrarLugar($ip);
        header("Location: listar.php");
    }

    // Cierra la conexión a la base de datos
    unset($crud); //ESTO ES PARA LLAMAR AL DESTRUCTOR DE LA CLASE, EN ESTE CASO PARA QUE CIERRE LA CONEXION