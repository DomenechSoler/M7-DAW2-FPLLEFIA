<?php
session_start();
require_once './config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comment = $_POST['comment'];
    $post_id = $_POST['post_id'];
    $id_comment = !empty($_POST['id_comment']) ? $_POST['id_comment'] : null;
    $type = $_POST['type'];

    // Obtener el ID del usuario de la sesión
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
    $user_surname = $_SESSION['user_surname'];

    if (!empty($comment) && !empty($post_id) && !empty($user_id)) {
        if ($type === 'project') {
            $stmt = $mysqli->prepare("INSERT INTO COMMENTS (description, id_project, id_user, date, id_comment) VALUES (?, ?, ?, NOW(), ?)");
        } else {
            $stmt = $mysqli->prepare("INSERT INTO COMMENTS (description, id_new, id_user, date, id_comment) VALUES (?, ?, ?, NOW(), ?)");
        }
        if ($stmt) {
            $stmt->bind_param('siii', $comment, $post_id, $user_id, $id_comment);
            if ($stmt->execute()) {
                header('Location: blog-single.php?id=' . $post_id . '&type=' . $type);
                exit();
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