<!DOCTYPE html>
<html lang="en">
<head>
    <title>ALTA</title>
    <link rel="stylesheet" type="text/css" href="../assets/style.css">
</head>
<body>
<h1>ALTA</h1>
<form method="POST" action="procesarForm.php" id="alta-form">
    <label for="ip">IP del Lugar:</label>
    <input type="text" name="ip" required>

    <label for="lugar">Lugar:</label>
    <input type="text" name="lugar" required><br>

    <label for="descripcion">Descripcion:</label>
    <input type="text" name="descripcion" required><br>

    <input type="submit" name="accion" value="Alta">
</form>
</body>
</html>
