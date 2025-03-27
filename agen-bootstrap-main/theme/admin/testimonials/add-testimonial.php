<?php
require_once '../../config.php';
session_start();

$uploadDir = '../../uploads/';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $description = $_POST['description'];

    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['thumbnail']['tmp_name'];
        $fileName = $_FILES['thumbnail']['name'];
        $fileNameCmps = explode('.', $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileExtension, $allowedExtensions)) {
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $dest_path = $uploadDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $stmt = $mysqli->prepare("INSERT INTO TESTIMONIALS (name, surname, description, thumbnail) VALUES (?, ?, ?, ?)");
                if ($stmt) {
                    $stmt->bind_param('ssss', $name, $surname, $description, $dest_path);
                    if ($stmt->execute()) {
                        header('Location: ../adminTestimonials.php');
                        exit();
                    } else {
                        echo 'Error al añadir el testimonio: ' . $mysqli->error;
                    }
                    $stmt->close();
                } else {
                    echo 'Error en la preparación de la consulta: ' . $mysqli->error;
                }
            } else {
                echo 'Error al mover el archivo a la carpeta de destino';
            }
        } else {
            echo 'Extensión de archivo no permitida';
        }
    } else {
        echo 'Error al subir el archivo';
    }
    $mysqli->close();
}
?>