<?php
session_start();
require_once '../index.php'; // Incluir la definición de la clase Usuario
// Verificar si se han enviado datos serializados a través de la sesión
if (isset($_SESSION['usuario'])) {
    // Deserializar los datos recibidos
    $usuario = unserialize($_SESSION['usuario']);
    
    // Mensaje de depuración
    error_log("Datos deserializados: " . print_r($usuario, true));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Usuario Deserializado</h1>
    <p>Nombre: <?php echo $usuario->nombre; ?></p>
    <p>Edad: <?php echo $usuario->edad; ?></p>
    <p>correu: <?php echo $usuario->correu; ?></p>

</body>
</html>