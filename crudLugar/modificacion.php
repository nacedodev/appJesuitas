<!DOCTYPE html>
<html lang="en">
<head>
    <title>MODIFICACION</title>
    <link rel="stylesheet" type="text/css" href="../assets/style.css">
</head>
<body id="modificar-form">
<h1>Modificación del lugar</h1>
<form method="POST">
    <label for="ip">IP del lugar:</label>
    <input type="text" name="ip" required>
    <input type="submit" name="buscar" value="Buscar">
</form>
<?php
require 'CrudLugar.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["buscar"])) {
    $crud = new CrudLugar('localhost', 'root', '', 'Jesuitas');
    $ip = $_POST["ip"];
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
}
?>
<form method="POST" action="procesarForm.php">
    <input type="hidden" name="ip" value="<?php echo $ip; ?>">
    <label for="lugar">Lugar:</label>
    <input type="text" name="lugar" value="<?php echo $lugar; ?>"><br>

    <label for="descripcion">Descripcion:</label>
    <input type="text" name="descripcion" value="<?php echo $descripcion; ?>"><br>

    <input type="submit" name="accion" value="modificar">
</form>
</body>
</html>