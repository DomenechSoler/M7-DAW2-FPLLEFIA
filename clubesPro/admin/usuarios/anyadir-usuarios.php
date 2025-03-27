<?php
session_start();
require_once('../../config.php');

//1. verificar que el rol sea administrador
if ($_SESSION['user_rol'] !== 'admin') {
    echo 'No tienes permisos para acceder a esta página';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $avatar = $_FILES['avatar']['name'];
    $avatarTmpName = $_FILES['avatar']['tmp_name'];
    $avatarFolder = '../../uploads/' . basename($avatar);

    // mover el archivo subido a la carpeta de destino si se ha subido un avatar
    if (!empty($avatar) && move_uploaded_file($avatarTmpName, $avatarFolder)) {
        $avatarPath = 'uploads/' . basename($avatar);
    } else {
        $avatarPath = 'uploads/default-avatar.png'; // Ruta al avatar por defecto
    }

    // preparar la consulta antes de insertar para evitar el sql injection
    $stmt = $mysqli->prepare("INSERT INTO Usuarios (nombre, correo, avatar) VALUES (?, ?, ?)");

    // comprobar que la preparación tuvo éxito
    if (!$stmt) {
        echo 'Error en la preparación de la consulta: ' . $mysqli->error;
        exit;
    }

    // bindear los parámetros
    $stmt->bind_param('sss', $nombre, $correo, $avatarPath);

    // ejecutar la consulta
    if ($stmt->execute()) {
        header('Location: ../adminUsuarios.php');
        exit();
    } else {
        echo 'Error al añadir el usuario: ' . $mysqli->error;
    }

    // cerrar la conexión
    $stmt->close();
    $mysqli->close();
}
?>