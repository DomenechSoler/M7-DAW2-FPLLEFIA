<?php
session_start();
require_once('../../config.php');

//1. verificar que el rol sea administrador
if (($_SESSION['user_rol']) !== 'admin') {
    echo 'No tienes permisos para acceder a esta página';
    exit;
}

//2. comprobar si se ha proporcionado un ID de personaje
if (!isset($_GET['id']) && !isset($_POST['id'])) {
    echo 'ID de personaje no proporcionado';
    exit;
}

$personaje_id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];

//3. obtener los datos del personaje existente si el ID se proporciona a través de GET
if (isset($_GET['id'])) {
    $stmt = $mysqli->prepare("SELECT nombre, posicion, altura FROM Personajes WHERE id = ?");
    $stmt->bind_param('i', $personaje_id);
    $stmt->execute();
    $stmt->bind_result($nombre, $posicion, $altura);
    $stmt->fetch();
    $stmt->close();
}

//4. comprobar si el formulario ha sido enviado
if (isset($_POST['nombre'])) {
    //5. recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $posicion = $_POST['posicion'];
    $altura = $_POST['altura'];

    //6. preparar la consulta para actualizar el personaje
    $stmt = $mysqli->prepare(
        "UPDATE Personajes SET nombre = ?, posicion = ?, altura = ? WHERE id = ?"
    );

    //7. comprobar que la preparación tuvo éxito
    if (!$stmt) {
        die('Error en la preparación: ' . $mysqli->error);
    }

    //8. bindear los parámetros
    $stmt->bind_param('ssii', $nombre, $posicion, $altura, $personaje_id);

    //9. ejecutar la consulta
    if ($stmt->execute()) {
        header('Location: ../adminPersonajes.php');
        exit();
    } else {
        echo 'Error al actualizar el personaje';
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
    <title>Formulario editar personaje</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h1 class="mb-4">Formulario editar personaje</h1>
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($personaje_id); ?>">

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo htmlspecialchars($nombre); ?>" required>
        </div>

        <div class="form-group">
            <label for="posicion">Posición:</label>
            <input type="text" id="posicion" name="posicion" class="form-control" value="<?php echo htmlspecialchars($posicion); ?>" required>
        </div>

        <div class="form-group">
            <label for="altura">Altura:</label>
            <input type="number" id="altura" name="altura" class="form-control" value="<?php echo htmlspecialchars($altura); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>

    <!-- Incluir Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>