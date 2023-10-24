<!DOCTYPE html>
<html lang="en">
<head>
    <title>ALTA</title>
    <link rel="stylesheet" type="text/css" href="../assets/style.css">
</head>
<body>
<h1>ALTA</h1>
<form method="POST" action="procesarForm.php" id="alta-form">
    <label for="idJesuita">ID del Jesuita</label>
    <input type="text" name="idJesuita" required>

    <label for="ip">IP:</label>
    <input type="text" name="ip" required><br>

    <input type="submit" name="accion" value="Alta">
</form>
</body>
</html>