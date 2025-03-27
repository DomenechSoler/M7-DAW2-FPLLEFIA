<?php
session_start();
require_once('../../config.php');

//1. verificar que el rol sea administrador
if (($_SESSION['user_rol']) !== 'admin') {
    echo 'No tienes permisos para acceder a esta página';
    exit;
}

//2. comprobar si se ha proporcionado un ID de testimonio
if (!isset($_GET['id'])) {
    echo 'ID de testimonio no proporcionado';
    exit;
}

$testimonial_id = $_GET['id'];

//3. preparar la consulta para eliminar el testimonio
$stmt = $mysqli->prepare("DELETE FROM TESTIMONIALS WHERE id = ?");
$stmt->bind_param('i', $testimonial_id);

//4. ejecutar la consulta
if ($stmt->execute()) {
    header('Location: ../adminTestimonials.php');
    exit();
} else {
    echo 'Error al eliminar el testimonio';
}

//5. cerrar la conexión
$stmt->close();
$mysqli->close();
?>