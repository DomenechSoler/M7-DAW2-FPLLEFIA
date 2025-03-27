<?php
session_start();
require_once('../../config.php');

//1. verificar que el rol sea administrador
if (($_SESSION['user_rol']) !== 'admin') {
    echo 'No tienes permisos para acceder a esta página';
    exit;
}

//2. comprobar si se ha proporcionado un ID de comentario
if (!isset($_GET['id'])) {
    echo 'ID de comentario no proporcionado';
    exit;
}

$comment_id = $_GET['id'];

//3. preparar la consulta para eliminar el comentario
$stmt = $mysqli->prepare("DELETE FROM COMMENTS WHERE id = ?");
$stmt->bind_param('i', $comment_id);

//4. ejecutar la consulta
if ($stmt->execute()) {
    header('Location: ../adminComments.php');
    exit();
} else {
    echo 'Error al eliminar el comentario';
}

//5. cerrar la conexión
$stmt->close();
$mysqli->close();
?>