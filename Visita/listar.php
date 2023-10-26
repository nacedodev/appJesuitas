
<?php
require '../config/configdb.php';
require '../classes/visita.php';
$crud = new Visita(HOST, USUARIO, PASSWORD, BASEDATOS);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTADO DE VISITAS</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<h2 style="text-align: center;">LISTADO DE VISITAS</h2>
<table>
    <tr>
        <td colspan = "3">VISITAS</td>
    </tr>
    <tr>
        <td>N PUESTO</td>
        <td>IP</td>
        <td>FECHA - HORA</td>
    </tr>
    <?php

    $result = $crud->listarVisitas();

    if(!$result->num_rows) {
        echo "<tr>";
        echo "<td colspan='3'> No hay coincidencias </td>";
        echo "</tr>";
    }else {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["idJesuita"]."</td>";
            echo "<td>".$row["ip"]."</td>";
            echo "<td>".$row["fechaHora"]."</td>";
            echo "</tr>";
        }
    }
    unset($crud);
    ?>
</table>
</body>
</html>
