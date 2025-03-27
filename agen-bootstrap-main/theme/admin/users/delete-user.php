<?php
session_start();
require_once('../../config.php');

//1. verificar que el rol sea administrador
if (($_SESSION['user_rol']) !== 'admin') {
    echo 'No tienes permisos para acceder a esta página';
    exit;
}

//2. comprobar si se ha proporcionado un ID de usuario
if (!isset($_GET['id'])) {
    echo 'ID de usuario no proporcionado';
    exit;
}

$user_id = $_GET['id'];

//3. preparar la consulta para eliminar el usuario
$stmt = $mysqli->prepare("DELETE FROM USERS WHERE id = ?");
$stmt->bind_param('i', $user_id);

//4. ejecutar la consulta
if ($stmt->execute()) {
    header('Location: ../adminUsers.php');
    exit();
} else {
    echo 'Error al eliminar el usuario';
}

//5. cerrar la conexión
$stmt->close();
$mysqli->close();
?>