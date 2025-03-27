<?php
require_once 'config.php';
session_start();
//0. comprobar si el formulario ha sido enviado
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //1. Recibir datos
    $name = $_POST['name'];
    $email = $_POST['email'];
    $surname = $_POST['surname'];
    $avatar = $_POST['avatar'];
    $password = $_POST['password'];
    //2. cifrar contraseña
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

    //3. preparar la consulta antes de insertar para evitar el sql injection
    //comprobar con la base de datos para ver
    $stmt = $mysqli->prepare("INSERT INTO USERS (name, email, surname, avatar, password, rol, date_register) VALUES (?, ?, ?, ?, ?, 'user', NOW())");

    //4.comprobar que la preparacion tuvo exito
    if(!$stmt) {
        echo 'Error en la preparacion de la consulta' . $mysqli->error;
    } 

    //5. bindear los parametros
    $stmt->bind_param('sssss', $name, $email, $surname, $avatar, $passwordHashed);

    //6. ejecutar la consulta
    if($stmt->execute()) {
        echo 'Usuario registrado';
    } else {
        echo 'Error al registrar el usuario' . $mysqli->error;
    //7. cerrar la conexion
    $stmt->close();
    $mysqli->close();
    }
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
                                <label for="surname" class="form-label">Apellido</label>
                                <input type="text" name="surname" id="surname" class="form-control" required>
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
                                <label for="avatar" class="form-label">Imagen</label>
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



