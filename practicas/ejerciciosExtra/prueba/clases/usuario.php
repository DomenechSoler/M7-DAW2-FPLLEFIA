<?php
session_start();
require_once '../index.php'; // Incluir la definición de la clase Usuario
// Verificar si se han enviado datos serializados a través de la sesión
if (isset($_SESSION['usuario'])) {
    // Deserializar los datos recibidos
    $usuario = unserialize($_SESSION['usuario']);
    
    // Mensaje de depuración
    error_log("Datos deserializados: " . print_r($usuario, true));

    // Mostrar el objeto deserializado
    echo "<h1>Usuario Deserializado</h1>";
    echo "<ul>";
    echo "<li>";
    echo "Nombre: " . htmlspecialchars($usuario->nombre) . "<br>";
    echo "Edad: " . htmlspecialchars($usuario->edad) . "<br>";
    echo "Email: " . htmlspecialchars($usuario->email) . "<br>";
    echo "</li>";
    echo "</ul>";
} else {
    echo "No se han recibido datos.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Edad</th>
            <th>Email</th>
        </tr>
        <tr>
            <td><?php echo $usuario->nombre; ?></td>
            <td><?php echo $usuario->edad; ?></td>
            <td><?php echo $usuario->email; ?></td>
        </tr>
    </table>
</body>
</html>