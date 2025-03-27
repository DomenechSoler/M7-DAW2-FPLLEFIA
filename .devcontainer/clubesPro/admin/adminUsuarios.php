<?php
session_start();
require_once('../config.php');

//1. verificar que el rol sea administrador
if ($_SESSION['user_rol'] !== 'admin') {
    echo 'No tienes permisos para acceder a esta página';
    exit;
}

//extraccion de usuarios
$results = $mysqli->query("SELECT * FROM Usuarios");
$clientes = $results->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
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
        <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#addUsuarioModal">Añadir Usuario</button>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente) : ?>
                    <tr>
                        <td><?= htmlspecialchars($cliente['nombre']) ?></td>
                        <td><?= htmlspecialchars($cliente['correo']) ?></td>
                        <td>
                            <div class="d-flex">
                                <button type="button" class="btn btn-primary btn-sm mb-3 mr-2 d-flex align-items-center" data-toggle="modal" data-target="#editUsuarioModal" data-id="<?= $cliente['id'] ?>" data-nombre="<?= htmlspecialchars($cliente['nombre']) ?>" data-correo="<?= htmlspecialchars($cliente['correo']) ?>" data-avatar="<?= htmlspecialchars($cliente['avatar']) ?>">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <a href="usuarios/eliminar-usuarios.php?id=<?= $cliente['id'] ?>" class="btn btn-danger btn-sm mb-3 d-flex align-items-center">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Añadir Usuario -->
    <div class="modal fade" id="addUsuarioModal" tabindex="-1" aria-labelledby="addUsuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUsuarioModalLabel">Formulario añadir usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="usuarios/anyadir-usuarios.php" method="POST">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo electrónico:</label>
                            <input type="email" id="correo" name="correo" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="avatar">Avatar:</label>
                            <input type="text" id="avatar" name="avatar" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Usuario -->
    <div class="modal fade" id="editUsuarioModal" tabindex="-1" aria-labelledby="editUsuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUsuarioModalLabel">Formulario editar usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="usuarios/editar-usuarios.php" method="POST">
                        <input type="hidden" id="edit_usuario_id" name="id">
                        <div class="form-group">
                            <label for="edit_nombre">Nombre:</label>
                            <input type="text" id="edit_nombre" name="nombre" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_correo">Correo electrónico:</label>
                            <input type="email" id="edit_correo" name="correo" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_avatar">Avatar:</label>
                            <input type="text" id="edit_avatar" name="avatar" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $('#editUsuarioModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var nombre = button.data('nombre');
            var correo = button.data('correo');
            var avatar = button.data('avatar');

            var modal = $(this);
            modal.find('#edit_usuario_id').val(id);
            modal.find('#edit_nombre').val(nombre);
            modal.find('#edit_correo').val(correo);
            modal.find('#edit_avatar').val(avatar);
        });
    </script>
</body>
</html>