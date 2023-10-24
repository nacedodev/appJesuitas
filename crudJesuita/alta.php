<!DOCTYPE html>
<html lang="en">
<head>
    <title>ALTA</title>
    <link rel="stylesheet" type="text/css" href="../assets/style.css">
</head>
<body>
<h1>ALTA</h1>
<form method="POST" action="procesarForm.php" id="alta-form">
    <label for="idJesuita">ID del Jesuita:</label>
    <input type="number" name="idJesuita" required>

    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" required><br>

    <label for="firma">Firma:</label>
    <input type="text" name="firma" required><br>

    <input type="submit" name="accion" value="Alta">
</form>
</body>
</html>
