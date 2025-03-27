<?php
session_start();
require_once('../../config.php');

//1. verificar que el rol sea administrador
if (($_SESSION['user_rol']) !== 'admin') {
    exit('No tienes permisos para acceder a esta página');
}

//2. comprobar si se ha proporcionado un ID de usuario
if (!isset($_GET['id'])) {
    exit('ID de usuario no proporcionado');
}

$user_id = $_GET['id'];

//3. obtener los datos del usuario existente
$stmt = $mysqli->prepare("SELECT name, email, surname, avatar, rol FROM USERS WHERE id = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$stmt->bind_result($name, $email, $surname, $avatar, $rol);
$stmt->fetch();
$stmt->close();

//4. comprobar si el formulario ha sido enviado
if (isset($_POST['name'])) {
    //5. recoger los datos del formulario
    $name = $_POST['name'];
    $email = $_POST['email'];
    $surname = $_POST['surname'];
    $avatar = $_POST['avatar'];
    $rol = $_POST['rol'];

    //6. preparar la consulta para actualizar el usuario
    $stmt = $mysqli->prepare(
        "UPDATE USERS SET name = ?, email = ?, surname = ?, avatar = ?, rol = ? WHERE id = ?"
    );

    //7. comprobar que la preparación tuvo éxito
    if (!$stmt) {
        exit('Error en la preparación: ' . $mysqli->error);
    }

    //8. bindear los parámetros
    $stmt->bind_param('sssssi', $name, $email, $surname, $avatar, $rol, $user_id);

    //9. ejecutar la consulta
    if ($stmt->execute()) {
        header('Location: ../adminUsers.php'); // Redirigir a la página de administración de usuarios
        exit;
    } else {
        exit('Error al actualizar el usuario');
    }

    //10. cerrar la conexión
    $stmt->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario editar usuario</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

    <h1 class="mb-4">Formulario editar usuario</h1>
    <form action="" method="POST">

        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($name); ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>" required>
        </div>

        <div class="form-group">
            <label for="surname">Apellido:</label>
            <input type="text" id="surname" name="surname" class="form-control" value="<?php echo htmlspecialchars($surname); ?>" required>
        </div>

        <div class="form-group">
            <label for="avatar">Avatar:</label>
            <input type="text" id="avatar" name="avatar" class="form-control" value="<?php echo htmlspecialchars($avatar); ?>" required>
        </div>

        <div class="form-group">
            <label for="rol">Rol:</label>
            <input type="text" id="rol" name="rol" class="form-control" value="<?php echo htmlspecialchars($rol); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>

    <!-- Incluir Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>