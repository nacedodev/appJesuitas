<!DOCTYPE html>
<html lang="en">
    <head>
        <title>MODIFICACION</title>
        <link rel="stylesheet" type="text/css" href="../assets/style.css">
    </head>
    <body id="modificar-form">
        <?php
        require 'CrudJesuita.php';
        require '../assets/config.php';
        if (isset($_POST["buscar"])) {
            $crud = new CrudJesuita($host,$usuario,$password, $basedatos);
            $idJesuita = $_POST["idJesuita"];
            $result = $crud->buscarJesuita($idJesuita);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $nombre = $row["nombre"];
                $firma = $row["firma"];
            }
            else{
                $nombre = 'No hay coincidencias';
                $firma  =  'No hay coincidencias';
            }
        }
        ?>
        <form method="POST" action="procesarForm.php">
            <label for="idJesuita">N° Puesto:</label>
            <input type="text" name="idJesuita" value="<?php echo $idJesuita; ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $nombre; ?>"><br>

            <label for="firma">Firma:</label>
            <input type="text" name="firma" value="<?php echo $firma; ?>"><br>

            <input type="submit" name="accion" value="modificar">
        </form>
    </body>
</html>
