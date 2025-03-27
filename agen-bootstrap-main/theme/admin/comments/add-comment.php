<?php
session_start();
require_once('../../config.php');

//1. verificar que el rol sea administrador
if (($_SESSION['user_rol']) !== 'admin') {
    echo 'No tienes permisos para acceder a esta página';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comment = $_POST['comment'];
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];
    $id_comment = !empty($_POST['id_comment']) ? $_POST['id_comment'] : null;

    if (!empty($comment) && !empty($post_id) && !empty($user_id)) {
        $stmt = $mysqli->prepare("INSERT INTO COMMENTS (description, id_new, id_user, date, id_comment) VALUES (?, ?, ?, NOW(), ?)");
        if ($stmt) {
            $stmt->bind_param('siii', $comment, $post_id, $user_id, $id_comment);
            if ($stmt->execute()) {
                header('Location: ../adminComments.php');
            } else {
                echo 'Error al añadir el comentario: ' . $mysqli->error;
            }
            $stmt->close();
        } else {
            echo 'Error en la preparación de la consulta: ' . $mysqli->error;
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Comentario</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Añadir Comentario</h2>
    <form action="add-comment.php" method="post">
        <div class="form-group">
            <label for="comment">Comentario:</label>
            <textarea id="comment" name="comment" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="post_id">ID Noticia:</label>
            <input type="number" id="post_id" name="post_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="user_id">ID Usuario:</label>
            <input type="number" id="user_id" name="user_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="id_comment">ID Comentario:</label>
            <input type="number" id="id_comment" name="id_comment" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Añadir Comentario</button>
    </form>

    <!-- Incluir Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.amazonaws.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>