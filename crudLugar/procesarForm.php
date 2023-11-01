<?php
require '../controllers/crudLugar.php';
require '../config/configdb.php';

    $crud = new CrudLugar(HOST,USUARIO,PASSWORD,BASEDATOS);
    $accion = $_GET["accion"];

    if ($accion === "Alta") {
        $ip = $_GET["ip"];
        $lugar = $_GET["lugar"];
        $input = $_GET["descripcion"];
        $resultado = $crud->altaLugar($ip,$lugar,$input);

    } elseif ($accion === "modificar") {
        $ip = $_GET["ip"];
        $lugar = $_GET["lugar"];
        $descripcion = $_GET["descripcion"];
        $resultado = $crud->modificarLugar($ip, $lugar, $descripcion);
    } elseif ($accion === "borrar") {
        $ip = $_GET["ip"];
        $resultado = $crud->borrarLugar($ip);
    }

    // Cierra la conexión a la base de datos
    unset($crud); //ESTO ES PARA LLAMAR AL DESTRUCTOR DE LA CLASE, EN ESTE CASO PARA QUE CIERRE LA CONEXION
?>
<link rel="stylesheet" href="../assets/style.css">
<p id="result"><?php echo $resultado ?></p>
<a href="listar.php" id="volver">VOLVER</a>
