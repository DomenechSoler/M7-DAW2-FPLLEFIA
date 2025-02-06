<?php
session_start();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <form action="" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <button type="submit">Enviar</button>
    </form>
    <?php 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_SESSION['nombre'] = $_POST['nombre'] ?? '';
        }

        if (isset($_SESSION['nombre']) && !empty($_SESSION['nombre'])) {
            echo '<p>Bienvenido, ' . htmlspecialchars($_SESSION['nombre']) . '!</p>';
        }
    ?>
    <a href="bienvenida.php">Ir a Bienvenida</a>

</body>
</html>