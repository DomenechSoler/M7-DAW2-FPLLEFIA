<?php
require_once('../../config.php');

if (!isset($_GET['id'])) {
    echo 'ID de usuario no proporcionado';
    exit();
}

$id = (int) $_GET['id'];
$result = $mysqli->query("SELECT * FROM USERS WHERE id = $id");

$user = $result->fetch_assoc();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $surname = $_POST['surname'];
    $avatar = $_POST['avatar'];
    $rol = $_POST['rol'];

}

$query = "UPDATE USERS SET name = ?, email = ?, surname = ?, avatar = ?, rol = ? WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('sssssi', $name, $email, $surname, $avatar, $rol, $id);
$stmt->execute();

header ('Location: index.php');
exit();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar usuario</title>
</head>
<body>
    <h1>Editar usuario</h1>
    <form action="" method="post">
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" value="<?= $user['name']; ?>">
        <br>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= $user['email']; ?>">
        <label for="surname">Apellidos</label>
        <input type="text" name="surname" id="surname" value="<?= $user['surname']; ?>">
        <label for="avatar">Avatar</label>
        <input type="text" name="avatar" id="avatar" value="<?= $user['avatar']; ?>">
        <label for="rol">Rol</label>
        <input type="text" name="rol" id="rol" value="<?= $user['rol']; ?>">
        <br>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
