<?php
require '../classes/visita.php';
require '../config/configdb.php';

    $crud = new Visita(HOST, USUARIO, PASSWORD, BASEDATOS);
    $accion = $_POST["accion"];

    if ($accion === "Alta") {
        $idJesuita = $_POST["idJesuita"];
        $ip = $_POST["ip"];

        if (count(explode('.',$ip)) === 4) {
            $resultado = $crud->hacerVisita($idJesuita, $ip);
            echo $resultado;
        } else {
            echo "IP inválida.";
        }
    }
    unset($crud); //ESTO ES PARA LLAMAR AL DESTRUCTOR DE LA CLASE, EN ESTE CASO PARA QUE CIERRE LA CONEXION