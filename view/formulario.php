<?php
require_once 'config/Database.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de registro </title>
</head>
<body>

<?php

try {
    $db = Database::conectar();
    echo "Conectado a Base de Datos con exito!";
} catch (exception $e) {
    echo "Error en conexion con Base de Datos.";
}
?>
    <form method="post">
        <h1>Formulario de Registro</h1>

        <label>Username: </label>
        <input type="text" name="username">
        <button type="submit" href="index.php?action=registro">Registrar</button>
    </form>

</body>
</html>