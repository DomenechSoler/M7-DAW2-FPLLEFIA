<?php
session_start();
require_once('../../config.php');

//1. verificar que el rol sea administrador
if (($_SESSION['user_rol']) !== 'admin') {
    echo 'No tienes permisos para acceder a esta página';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $posicion = $_POST['posicion'];
    $altura = $_POST['altura'];
    $usuario_id = $_SESSION['user_id']; // Obtener el usuario_id de la sesión

    // preparar la consulta para insertar el personaje
    $stmt = $mysqli->prepare("INSERT INTO Personajes (nombre, posicion, altura, usuario_id) VALUES (?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param('ssii', $nombre, $posicion, $altura, $usuario_id);
        if ($stmt->execute()) {
            header('Location: ../adminPersonajes.php');
            exit();
        } else {
            echo 'Error al añadir el personaje: ' . $mysqli->error;
        }
        $stmt->close();
    } else {
        echo 'Error en la preparación de la consulta: ' . $mysqli->error;
    }
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Personaje</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h1 class="mb-4">Añadir Personaje</h1>
    <form action="" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="posicion">Posición:</label>
            <input type="text" id="posicion" name="posicion" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="altura">Altura:</label>
            <input type="number" id="altura" name="altura" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>