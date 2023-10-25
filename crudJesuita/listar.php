
<?php
require '../assets/config.php';
require 'CrudJesuita.php';
$crud = new CrudJesuita($host, $usuario, $password, $basedatos);
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
        <td colspan = "3">JESUITAS</td>
    </tr>
    <tr>
        <td>N PUESTO</td>
        <td>NOMBRE</td>
        <td>FIRMA</td>
    </tr>
    <?php

    $result = $crud->listarJesuitas();

    if(!$result->num_rows) {
        echo "<tr>";
        echo "<td colspan='3'> No hay coincidencias </td>";
        echo "</tr>";
    }else {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";   // CREAMOS UNA NUEVA FILA EN LA TABLA
            echo "<td>".$row["idJesuita"]."</td>";
            echo "<td>".$row["nombre"]."</td>"; //CREAMOS UNA CELDA CON EL VALOR DE "i" EN SU INTERIOR, EL NUMERO AL QUE QUEREMOS HALLAR EL FACTORIAL EN ESTA ITERACION
            echo "<td style='font-size: 12px'>".$row["firma"]."</td>"; //CREAMOS UNA CELDA CON EL CALCULO DEL FACTORIAL PARA EL VALOR "i"
            echo "</tr>"; //CERRAMOS LA NUEVA FILA DE LA TABLA
        }
    }
    unset($crud);
    ?>
</table>
</body>
</html>
