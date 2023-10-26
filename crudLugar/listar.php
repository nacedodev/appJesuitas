
<?php
require '../assets/configdb.php';
require 'CrudLugar.php';
$crud = new CrudLugar($host, $usuario, $password, $basedatos);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respuesta del Formulario</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<h2 style="text-align: center;">LISTADO DE JESUITAS</h2>
<table>
    <tr>
        <td colspan = "3">LUGARES</td>
    </tr>
    <tr>
        <td>IP</td>
        <td>LUGAR</td>
        <td>DESCRIPCION</td>
    </tr>
    <?php

    $result = $crud->listarLugares();

    if(!$result->num_rows) {
        echo "<tr>";
        echo "<td colspan='3'> No hay coincidencias </td>";
        echo "</tr>";
    }else {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["ip"]."</td>";
            echo "<td>".$row["lugar"]."</td>";
            echo "<td>".$row["descripcion"]."</td>";
            echo "</tr>";
        }
    }
    unset($crud);
    ?>
</table>
</body>
</html>
