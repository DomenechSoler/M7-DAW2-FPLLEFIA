<?php
session_start();

class Usuario {
    public $nombre;
    public $edad;
    public $email;

    public function __construct($nombre, $edad, $email) {
        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->email = $email;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nombre']) && isset($_POST['edad']) && isset($_POST['email'])) {
        $nombre = $_POST['nombre'];
        $edad = $_POST['edad'];
        $email = $_POST['email'];

        $usuario = new Usuario($nombre, $edad, $email);
        $_SESSION['usuario'] = serialize($usuario);

        // Mensaje de depuración
        error_log("Datos guardados en la sesión: " . print_r($_SESSION['usuario'], true));

        header('Location: clases/usuario.php');
        exit();
    } else {
        echo "No se han recibido todos los datos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Usuario</title>
</head>
<body>
    <form action="/index.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>