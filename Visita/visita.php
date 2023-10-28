<?php
require '../config/configdb.php';
require '../classes/visita.php';
require '../classes/crudJesuita.php';
require '../classes/crudLugar.php';
//Conecta con la base de datos ($conexión)
$crudJ = new CrudJesuita(HOST, USUARIO, PASSWORD, BASEDATOS); //Conecta con la base de datos
$crudL = new CrudLugar(HOST,USUARIO,PASSWORD,BASEDATOS);
//Desactivar errores
//$controlador = new mysqli_driver();
//$controlador->report_mode = MYSQLI_REPORT_OFF;
//
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VISITAR</title>
    <link rel="stylesheet" type="text/css" href="../assets/style.css">
</head>
<body>
<h1>VISITA</h1>
<form method="POST" action="procesarForm.php" id="alta-form">
    <label for="nombre">Quién eres?</label>
    <select id="nombre" name="nombre">
        <?php
        $result = $crudJ->listarJesuitas();
        while($row = $result->fetch_assoc()){//Extrae cada una de las filas del resultado de la consulta
            echo "<option value= '".$row["nombre"]."'>".$row["nombre"]."</option>";
        }
        ?>
    </select>

    <label for="firma">Cuál es tu firma?</label>
    <select id="firma" name="firma">
        <?php
        $result = $crudJ->listarFirmas();
        while($row = $result->fetch_array()) {
            echo "<option value='" . $row["firma"] . "'>" . $row["firma"] . "</option>";
        }
        ?>
    </select>

    <label for="firma">Que lugar te gustaría visitar:</label>
    <select id="firma" name="lugar">
        <?php
        $result = $crudL->nombreLugares();
        while($row = $result->fetch_array()){
            echo "<option value='".$row["lugar"]."'>".$row["lugar"]."</option>";
        }
        ?>
    </select>
    <input type="submit" name="accion" value="Visitar">
</form>
<a href="main.html" id="volver">VOLVER</a>
</body>
</html>