<?php
session_start();
require_once('../config.php');

//1. verificar que el rol sea administrador
if (($_SESSION['user_rol']) !== 'admin') {
    echo 'No tienes permisos para acceder a esta página';
    exit;
}

//extraccion de usuarios
$results = $mysqli->query("SELECT * FROM USERS");
$clientes = $results->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Usuarios</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<?php include('headerAdmin.php'); ?>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Administrar Usuarios</h1>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Fecha de Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente) : ?>
                    <tr>
                        <td><?= htmlspecialchars($cliente['name']) ?></td>
                        <td><?= htmlspecialchars($cliente['surname']) ?></td>
                        <td><?= htmlspecialchars($cliente['email']) ?></td>
                        <td><?= htmlspecialchars($cliente['rol']) ?></td>
                        <td><?= htmlspecialchars($cliente['date_register']) ?></td>
                        <td>
                            <div class="d-flex">
                                <a href="users/edit-user.php?id=<?= $cliente['id'] ?>" class="btn btn-primary btn-sm mb-3 mr-2 d-flex align-items-center">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="users/delete-user.php?id=<?= $cliente['id'] ?>" class="btn btn-danger btn-sm mb-3 d-flex align-items-center">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>