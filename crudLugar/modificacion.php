<!DOCTYPE html>
<html lang="en">
<head>
    <title>MODIFICACION</title>
    <link rel="stylesheet" type="text/css" href="../assets/style.css">
</head>
<body id="modificar-form">
<h1>Modificación del lugar</h1>
<?php
require '../classes/crudLugar.php';
require '../config/configdb.php';

    $crud = new CrudLugar(HOST, USUARIO, PASSWORD, BASEDATOS);
    $ip = $_GET["ip"];
    $result = $crud->buscarLugar($ip);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lugar = $row["lugar"];
        $descripcion = $row["descripcion"];
    }
    else{
        $lugar = 'No hay coincidencias';
        $descripcion  =  'No hay coincidencias';
}
?>
<form method="GET" action="procesarForm.php">
    <label for="ip">IP:</label>
    <input type="text" name="ip" value="<?php echo $ip; ?>">
    <label for="lugar">Lugar:</label>
    <input type="text" name="lugar" value="<?php echo $lugar; ?>"><br>

    <label for="descripcion">Descripcion:</label>
    <input type="text" name="descripcion" value="<?php echo $descripcion; ?>"><br>

    <input type="submit" name="accion" value="modificar">
</form>
<a href="listar.php" id="volver">VOLVER</a>
</body>
</html>
