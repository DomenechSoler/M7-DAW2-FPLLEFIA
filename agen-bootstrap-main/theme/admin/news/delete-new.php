<?php
session_start();
require_once('../../config.php');

//1. verificar que el rol sea administrador
if (($_SESSION['user_rol']) !== 'admin') {
    echo 'No tienes permisos para acceder a esta página';
    exit;
}

//2. comprobar si se ha proporcionado un ID de noticia
if (!isset($_GET['id'])) {
    echo 'ID de noticia no proporcionado';
    exit;
}

$new_id = $_GET['id'];

//3. preparar la consulta para eliminar la noticia
$stmt = $mysqli->prepare("DELETE FROM NEWS WHERE id = ?");
$stmt->bind_param('i', $new_id);

//4. ejecutar la consulta
if ($stmt->execute()) {
    header('Location: ../adminNews.php');
    exit();
} else {
    echo 'Error al eliminar la noticia';
}

//5. cerrar la conexión
$stmt->close();
$mysqli->close();
?>