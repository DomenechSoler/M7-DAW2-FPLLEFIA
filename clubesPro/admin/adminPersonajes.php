<?php
session_start();
require_once('../config.php');

//1. verificar que el rol sea administrador
if (($_SESSION['user_rol']) !== 'admin') {
    echo 'No tienes permisos para acceder a esta página';
    exit;
}

//extraccion de personajes
$resultsPersonajes = $mysqli->query("SELECT * FROM Personajes");
$personajes = $resultsPersonajes->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Personajes</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<?php include('headerAdmin.php'); ?>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Administrar Personajes</h1>
        <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#addPersonajeModal">Añadir Personaje</button>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Posición</th>
                    <th>Altura</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($personajes as $personaje) : ?>
                    <tr>
                        <td><?= htmlspecialchars($personaje['nombre']) ?></td>
                        <td><?= htmlspecialchars($personaje['posicion']) ?></td>
                        <td><?= htmlspecialchars($personaje['altura']) ?></td>
                        <td>
                            <div class="d-flex">
                                <button type="button" class="btn btn-primary btn-sm mb-3 mr-2 d-flex align-items-center" data-toggle="modal" data-target="#editPersonajeModal" data-id="<?= $personaje['id'] ?>" data-nombre="<?= htmlspecialchars($personaje['nombre']) ?>" data-posicion="<?= htmlspecialchars($personaje['posicion']) ?>" data-altura="<?= htmlspecialchars($personaje['altura']) ?>">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <a href="personajes/eliminar-personajes.php?id=<?= $personaje['id'] ?>" class="btn btn-danger btn-sm mb-3 d-flex align-items-center">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Añadir Personaje -->
    <div class="modal fade" id="addPersonajeModal" tabindex="-1" aria-labelledby="addPersonajeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPersonajeModalLabel">Formulario añadir personaje</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="personajes/anyadir-personajes.php" method="POST">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="posicion">Posición:</label>
                            <input type="text" id="posicion" name="posicion" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="altura">Altura:</label>
                            <input type="number" id="altura" name="altura" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Personaje -->
    <div class="modal fade" id="editPersonajeModal" tabindex="-1" aria-labelledby="editPersonajeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPersonajeModalLabel">Formulario editar personaje</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="personajes/editar-personajes.php" method="POST">
                        <input type="hidden" id="edit_personaje_id" name="id">
                        <div class="form-group">
                            <label for="edit_nombre">Nombre:</label>
                            <input type="text" id="edit_nombre" name="nombre" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_posicion">Posición:</label>
                            <input type="text" id="edit_posicion" name="posicion" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_altura">Altura:</label>
                            <input type="number" id="edit_altura" name="altura" class="form-control" required>
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
        $('#editPersonajeModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var nombre = button.data('nombre');
            var posicion = button.data('posicion');
            var altura = button.data('altura');

            var modal = $(this);
            modal.find('#edit_personaje_id').val(id);
            modal.find('#edit_nombre').val(nombre);
            modal.find('#edit_posicion').val(posicion);
            modal.find('#edit_altura').val(altura);
        });
    </script>
</body>
</html>