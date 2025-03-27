<?php
session_start();
require_once 'config.php';

$results = $mysqli->query("SELECT * FROM USERS");

echo '<pre>'; 
print_r($results);
echo '</pre>'; 

$clientes = $results->fetch_all(MYSQLI_ASSOC);

echo '<pre>'; 
print_r($clientes);
echo '</pre>'; 

foreach ($clientes as $cliente) {
    echo $cliente['name'] . '<br>';
    echo $cliente['email'] . '<br>';
    //poner imagen en una card
    echo '<img src="' . $cliente['image'] . '" width="100px" height="100px" alt="imagen de usuario">';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <header class="bg-secondary p-4 d-flex justify-content-between align-items-center">
        <h1 class="text-white">Tarjetas de datos</h1>
        <nav class="d-flex align-items-center">
            <?php if (isset($_SESSION['user_id'])): ?>
                <img src="<?= $_SESSION['user_avatar']?>" alt="Avatar" class="rounded-circle me-2" width="40" height="40">
                <p class="text-white mb-0 me-3"><?= $_SESSION['user_name']?></p>
                <p class="text-white mb-0 me-3"><?= $_SESSION['user_surname']?></p>
                <a href="logout.php" class="btn btn-outline-light me-2">Cerrar Sesión</a>
                <?php if ($_SESSION['user_rol'] === 'admin'): ?>
                    <a href="admin/adminPanel.php" class="text-white ml-4"><img src="./assets/admin.png" alt=""></a>
                <?php endif; ?>
            <?php endif; ?>
        </nav>
    </header>
</body>
</html>


