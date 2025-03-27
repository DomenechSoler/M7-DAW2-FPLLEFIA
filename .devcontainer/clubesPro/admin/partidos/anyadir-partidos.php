<?php
require_once '../../config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultado_local = $_POST['resultado_local'] !== '' ? $_POST['resultado_local'] : null;
    $resultado_visitante = $_POST['resultado_visitante'] !== '' ? $_POST['resultado_visitante'] : null;
    $division = $_POST['division'];

    // preparar la consulta para insertar el partido
    $stmt = $mysqli->prepare("INSERT INTO Partidos (resultado_local, resultado_visitante, division) VALUES (?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param('sss', $resultado_local, $resultado_visitante, $division);
        if ($stmt->execute()) {
            header('Location: ../adminPartidos.php');
            exit();
        } else {
            echo 'Error al añadir el partido: ' . $mysqli->error;
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
    <title>Añadir Partido</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h1 class="mb-4">Añadir Partido</h1>
    <form action="" method="POST">
        <div class="form-group">
            <label for="resultado_local">Resultado Local:</label>
            <input type="text" id="resultado_local" name="resultado_local" class="form-control">
        </div>
        <div class="form-group">
            <label for="resultado_visitante">Resultado Visitante:</label>
            <input type="text" id="resultado_visitante" name="resultado_visitante" class="form-control">
        </div>
        <div class="form-group">
            <label for="division">División:</label>
            <input type="text" id="division" name="division" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>