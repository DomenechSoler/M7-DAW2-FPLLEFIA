<?php
require_once 'config.php';
session_start();

//0. comprobar si el formulario ha sido enviado
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //1. Recibir datos
    $nombre = $_POST['name'];
    $correo = $_POST['email'];
    $contraseña = $_POST['password'];
    $avatar = $_FILES['avatar']['name'];
    $avatarTmpName = $_FILES['avatar']['tmp_name'];
    $avatarFolder = 'uploads/' . basename($avatar);

    //2. cifrar contraseña
    $contraseñaHashed = password_hash($contraseña, PASSWORD_DEFAULT);

    //3. mover el archivo subido a la carpeta de destino si se ha subido un avatar
    if (!empty($avatar) && move_uploaded_file($avatarTmpName, $avatarFolder)) {
        $avatarPath = $avatarFolder;
    } else {
        $avatarPath = 'uploads/default-avatar.png'; // Ruta al avatar por defecto
    }

    //4. preparar la consulta antes de insertar para evitar el sql injection
    $stmt = $mysqli->prepare("INSERT INTO Usuarios (nombre, correo, contraseña, avatar) VALUES (?, ?, ?, ?)");

    //5. comprobar que la preparación tuvo éxito
    if(!$stmt) {
        echo 'Error en la preparación de la consulta: ' . $mysqli->error;
    } 

    //6. bindear los parámetros
    $stmt->bind_param('ssss', $nombre, $correo, $contraseñaHashed, $avatarPath);

    //7. ejecutar la consulta
    if($stmt->execute()) {
        // Redirigir al login después de un registro exitoso
        header('Location: login.php');
        exit();
    } else {
        echo 'Error al registrar el usuario: ' . $mysqli->error;
    }

    //8. cerrar la conexión
    $stmt->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <h2>Registro</h2>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="avatar" class="form-label">Avatar</label>
                                <input type="file" name="avatar" id="avatar" class="form-control">
                            </div>
                            <div class="d-grid">
                                <input type="submit" value="Registrar" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>