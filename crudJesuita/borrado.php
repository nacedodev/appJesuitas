<!DOCTYPE html>
<html lang="en">
<head>
    <title>BORRADO</title>
    <link rel="stylesheet" type="text/css" href="../assets/style.css">
</head>
<body>
<h1>Borrar Jesuita</h1>
<form method="post" action="procesarForm.php" id="borrar-form">
    <label for="idJesuita">ID del Jesuita a borrar:</label>
    <input type="text" name="idJesuita" required><br>

    <input type="hidden" name="accion" value="borrar">
    <input type="submit" value="Borrar Jesuita">
</form>
</body>
</html>
