<?php
session_start();
require_once('../../config.php');

//1. verificar que el rol sea administrador
if (($_SESSION['user_rol']) !== 'admin') {
    echo 'No tienes permisos para acceder a esta página';
    exit;
}

//2. comprobar si se ha proporcionado un ID de proyecto
if (!isset($_GET['id'])) {
    echo 'ID de proyecto no proporcionado';
    exit;
}

$project_id = $_GET['id'];

//3. preparar la consulta para eliminar el proyecto
$stmt = $mysqli->prepare("DELETE FROM PROJECTS WHERE id = ?");
$stmt->bind_param('i', $project_id);

//4. ejecutar la consulta
if ($stmt->execute()) {
    header('Location: ../adminProjects.php');
    exit();
} else {
    echo 'Error al eliminar el proyecto';
}

//5. cerrar la conexión
$stmt->close();
$mysqli->close();
?>