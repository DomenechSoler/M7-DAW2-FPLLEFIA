<?php
session_start();
require_once('../../config.php');

//1. verificar que el rol sea administrador
if (($_SESSION['user_rol']) !== 'admin') {
    echo 'No tienes permisos para acceder a esta página';
    exit;
}

//2. comprobar si se ha proporcionado un ID de partido
if (!isset($_GET['id']) && !isset($_POST['id'])) {
    echo 'ID de partido no proporcionado';
    exit;
}

$partido_id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];

//3. obtener los datos del partido existente si el ID se proporciona a través de GET
if (isset($_GET['id'])) {
    $stmt = $mysqli->prepare("SELECT resultado_local, resultado_visitante, division FROM Partidos WHERE id = ?");
    $stmt->bind_param('i', $partido_id);
    $stmt->execute();
    $stmt->bind_result($resultado_local, $resultado_visitante, $division);
    $stmt->fetch();
    $stmt->close();
}

//4. comprobar si el formulario ha sido enviado
if (isset($_POST['resultado_local'])) {
    //5. recoger los datos del formulario
    $resultado_local = $_POST['resultado_local'] !== '' ? $_POST['resultado_local'] : null;
    $resultado_visitante = $_POST['resultado_visitante'] !== '' ? $_POST['resultado_visitante'] : null;
    $division = $_POST['division'];

    //6. preparar la consulta para actualizar el partido
    $stmt = $mysqli->prepare(
        "UPDATE Partidos SET resultado_local = ?, resultado_visitante = ?, division = ? WHERE id = ?"
    );

    //7. comprobar que la preparación tuvo éxito
    if (!$stmt) {
        die('Error en la preparación: ' . $mysqli->error);
    }

    //8. bindear los parámetros
    $stmt->bind_param('sssi', $resultado_local, $resultado_visitante, $division, $partido_id);

    //9. ejecutar la consulta
    if ($stmt->execute()) {
        header('Location: ../adminPartidos.php');
        exit();
    } else {
        echo 'Error al actualizar el partido';
    }

    //10. cerrar la conexión
    $stmt->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario editar partido</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h1 class="mb-4">Formulario editar partido</h1>
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($partido_id); ?>">

        <div class="form-group">
            <label for="resultado_local">Resultado Local:</label>
            <input type="text" id="resultado_local" name="resultado_local" class="form-control" value="<?php echo htmlspecialchars($resultado_local); ?>">
        </div>

        <div class="form-group">
            <label for="resultado_visitante">Resultado Visitante:</label>
            <input type="text" id="resultado_visitante" name="resultado_visitante" class="form-control" value="<?php echo htmlspecialchars($resultado_visitante); ?>">
        </div>

        <div class="form-group">
            <label for="division">División:</label>
            <input type="text" id="division" name="division" class="form-control" value="<?php echo htmlspecialchars($division); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>

    <!-- Incluir Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>