<?php
session_start();
require_once('../../config.php');

//1. verificar que el rol sea administrador
if (($_SESSION['user_rol']) !== 'admin') {
    exit('No tienes permisos para acceder a esta página');
}

//2. comprobar si se ha proporcionado un ID de testimonio
if (!isset($_GET['id'])) {
    exit('ID de testimonio no proporcionado');
}

$testimonial_id = $_GET['id'];

//3. obtener los datos del testimonio existente
$stmt = $mysqli->prepare("SELECT name, surname, description, thumbnail FROM TESTIMONIALS WHERE id = ?");
$stmt->bind_param('i', $testimonial_id);
$stmt->execute();
$stmt->bind_result($name, $surname, $description, $thumbnail);
$stmt->fetch();
$stmt->close();

//4. comprobar si el formulario ha sido enviado
if (isset($_POST['name'])) {
    //5. recoger los datos del formulario
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $description = $_POST['description'];
    $thumbnail = $_POST['thumbnail'];

    //6. preparar la consulta para actualizar el testimonio
    $stmt = $mysqli->prepare(
        "UPDATE TESTIMONIALS SET name = ?, surname = ?, description = ?, thumbnail = ? WHERE id = ?"
    );

    //7. comprobar que la preparación tuvo éxito
    if (!$stmt) {
        exit('Error en la preparación: ' . $mysqli->error);
    }

    //8. bindear los parámetros
    $stmt->bind_param('ssssi', $name, $surname, $description, $thumbnail, $testimonial_id);

    //9. ejecutar la consulta
    if ($stmt->execute()) {
        header('Location: ../adminTestimonials.php'); // Redirigir a la página de administración de testimonios
        exit;
    } else {
        exit('Error al actualizar el testimonio');
    }

    //10. cerrar la conexión
    $stmt->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario editar testimonio</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

    <h1 class="mb-4">Formulario editar testimonio</h1>
    <form action="" method="POST">

        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($name); ?>" required>
        </div>

        <div class="form-group">
            <label for="surname">Apellido:</label>
            <input type="text" id="surname" name="surname" class="form-control" value="<?php echo htmlspecialchars($surname); ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Descripción:</label>
            <textarea name="description" id="description" class="form-control" cols="30" rows="10" required><?php echo htmlspecialchars($description); ?></textarea>
        </div>

        <div class="form-group">
            <label for="thumbnail">Imagen:</label>
            <input type="text" id="thumbnail" name="thumbnail" class="form-control" value="<?php echo htmlspecialchars($thumbnail); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>

    <!-- Incluir Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.amazonaws.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>