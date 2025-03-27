<?php
session_start();
require_once('../../config.php');

//1. verificar que el rol sea administrador
if (($_SESSION['user_rol']) !== 'admin') {
    exit('No tienes permisos para acceder a esta página');
}

//2. comprobar si se ha proporcionado un ID de comentario
if (!isset($_GET['id'])) {
    exit('ID de comentario no proporcionado');
}

$comment_id = $_GET['id'];

//3. obtener los datos del comentario existente
$stmt = $mysqli->prepare("SELECT description, id_new, id_user, id_comment FROM COMMENTS WHERE id = ?");
$stmt->bind_param('i', $comment_id);
$stmt->execute();
$stmt->bind_result($description, $id_new, $id_user, $id_comment);
$stmt->fetch();
$stmt->close();

//4. comprobar si el formulario ha sido enviado
if (isset($_POST['description'])) {
    //5. recoger los datos del formulario
    $description = $_POST['description'];
    $id_new = $_POST['id_new'];
    $id_user = $_POST['id_user'];
    $id_comment = !empty($_POST['id_comment']) ? $_POST['id_comment'] : null;

    //6. preparar la consulta para actualizar el comentario
    $stmt = $mysqli->prepare(
        "UPDATE COMMENTS SET description = ?, id_new = ?, id_user = ?, id_comment = ? WHERE id = ?"
    );

    //7. comprobar que la preparación tuvo éxito
    if (!$stmt) {
        exit('Error en la preparación: ' . $mysqli->error);
    }

    //8. bindear los parámetros
    $stmt->bind_param('siiii', $description, $id_new, $id_user, $id_comment, $comment_id);

    //9. ejecutar la consulta
    if ($stmt->execute()) {
        header('Location: ../adminComments.php'); // Redirigir a la página de administración de comentarios
        exit;
    } else {
        exit('Error al actualizar el comentario: ' . $stmt->error);
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
    <title>Formulario editar comentario</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

    <h1 class="mb-4">Formulario editar comentario</h1>
    <form action="" method="POST">

        <div class="form-group">
            <label for="description">Descripción:</label>
            <textarea name="description" id="description" class="form-control" cols="30" rows="10" required><?php echo htmlspecialchars($description); ?></textarea>
        </div>

        <div class="form-group">
            <label for="id_new">ID Noticia:</label>
            <input type="number" id="id_new" name="id_new" class="form-control" value="<?php echo htmlspecialchars($id_new); ?>" required>
        </div>

        <div class="form-group">
            <label for="id_user">ID Usuario:</label>
            <input type="number" id="id_user" name="id_user" class="form-control" value="<?php echo htmlspecialchars($id_user); ?>" required>
        </div>

        <div class="form-group">
            <label for="id_comment">ID Comentario:</label>
            <input type="number" id="id_comment" name="id_comment" class="form-control" value="<?php echo htmlspecialchars($id_comment); ?>">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>

    <!-- Incluir Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>