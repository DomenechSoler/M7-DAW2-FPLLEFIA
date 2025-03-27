<?php
session_start();
require_once('../../config.php');

//1. verificar que el rol sea administrador
if (($_SESSION['user_rol']) !== 'admin') {
    echo 'No tienes permisos para acceder a esta página';
    exit;
}

//2. comprobar si se ha proporcionado un ID de personaje
if (!isset($_GET['id'])) {
    echo 'ID de personaje no proporcionado';
    exit;
}

$personaje_id = $_GET['id'];

//3. preparar la consulta para eliminar el personaje
$stmt = $mysqli->prepare("DELETE FROM Personajes WHERE id = ?");
$stmt->bind_param('i', $personaje_id);

//4. ejecutar la consulta
if ($stmt->execute()) {
    header('Location: ../adminPersonajes.php');
    exit();
} else {
    echo 'Error al eliminar el personaje';
}

//5. cerrar la conexión
$stmt->close();
$mysqli->close();
?>