<?php
require_once 'config.php';
session_start();

$uploadDir = 'uploads/';
//0. comprobar si el formulario ha sido enviado
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //1. Recibir datos
    $name = $_POST['name'];
    $email = $_POST['email'];
    $surname = $_POST['surname'];
    $password = $_POST['password'];
    //2. cifrar contraseña
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);


    //2.1 subir imagen
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        //obtener informacion del archivo
        $fileTmpPath = $_FILES['avatar']['tmp_name']; //ruta temporal
        $fileName = $_FILES['avatar']['name']; //nombre original del archivo
    } 

    //separar el nombre y la extension del archivo
    $fileNameCmps = explode('.', $fileName); //ruta temporal
    $fileExtension = strtolower(end($fileNameCmps)); //extension del archivo

    //Definir las extensiones permitidas
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    if (in_array($fileExtension, $allowedExtensions)) {
        //Renombrar el archivo para evitar duplicados
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    } 

    //mover el archivo a la carpeta de destino
    $dest_path = $uploadDir . $newFileName;

    //Mover el archivo de la carpeta temporal a la carpeta de uploads
    if (!move_uploaded_file($fileTmpPath, $dest_path)) {
        die ('Error: no se pudo mover el archivo a la carpeta de destino');
    }


    //3. preparar la consulta antes de insertar para evitar el sql injection
    //comprobar con la base de datos para ver
    $stmt = $mysqli->prepare("INSERT INTO USERS (name, email, surname, avatar, password, rol, date_register) VALUES (?, ?, ?, ?, ?, 'user', NOW())");

    //4.comprobar que la preparacion tuvo exito
    if(!$stmt) {
        echo 'Error en la preparacion de la consulta' . $mysqli->error;
    } 

    //5. bindear los parametros
    $stmt->bind_param('sssss', $name, $email, $surname, $dest_path, $passwordHashed);

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
                                <input type="file" name="avatar" id="avatar" accept="image/*" class="form-control">
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



