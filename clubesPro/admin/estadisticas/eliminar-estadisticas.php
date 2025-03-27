<?php
session_start();
require_once('../../config.php');

//1. verificar que el rol sea administrador
if (($_SESSION['user_rol']) !== 'admin') {
    echo 'No tienes permisos para acceder a esta página';
    exit;
}

//2. comprobar si se ha proporcionado un ID de estadística
if (!isset($_GET['id'])) {
    echo 'ID de estadística no proporcionado';
    exit;
}

$estadistica_id = $_GET['id'];

//3. preparar la consulta para eliminar la estadística
$stmt = $mysqli->prepare("DELETE FROM EstadisticasPersonajePartido WHERE id = ?");
$stmt->bind_param('i', $estadistica_id);

//4. ejecutar la consulta
if ($stmt->execute()) {
    header('Location: ../adminEstadisticas.php');
    exit();
} else {
    echo 'Error al eliminar la estadística';
}

//5. cerrar la conexión
$stmt->close();
$mysqli->close();
?>