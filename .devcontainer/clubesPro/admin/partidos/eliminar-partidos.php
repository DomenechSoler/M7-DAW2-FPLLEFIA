<?php
session_start();
require_once('../../config.php');

//1. verificar que el rol sea administrador
if (($_SESSION['user_rol']) !== 'admin') {
    echo 'No tienes permisos para acceder a esta página';
    exit;
}

//2. comprobar si se ha proporcionado un ID de partido
if (!isset($_GET['id'])) {
    echo 'ID de partido no proporcionado';
    exit;
}

$partido_id = $_GET['id'];

//3. preparar la consulta para eliminar el partido
$stmt = $mysqli->prepare("DELETE FROM Partidos WHERE id = ?");
$stmt->bind_param('i', $partido_id);

//4. ejecutar la consulta
if ($stmt->execute()) {
    header('Location: ../adminPartidos.php');
    exit();
} else {
    echo 'Error al eliminar el partido';
}

//5. cerrar la conexión
$stmt->close();
$mysqli->close();
?>