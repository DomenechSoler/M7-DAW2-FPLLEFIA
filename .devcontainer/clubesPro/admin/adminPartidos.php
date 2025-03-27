<?php
session_start();
require_once('../config.php');

// Verificar que el rol sea administrador
if ($_SESSION['user_rol'] !== 'admin') {
    echo 'No tienes permisos para acceder a esta página';
    exit;
}

// Extracción de partidos
$resultPartidos = $mysqli->query("SELECT * FROM Partidos");
$partidos = $resultPartidos->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Partidos</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<?php include('headerAdmin.php'); ?>
<body class="bg-dark">
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Administrar Partidos</h1>
        <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#addPartidoModal">Añadir Partido</button>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Resultado Local</th>
                    <th>Resultado Visitante</th>
                    <th>División</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($partidos as $partido) : ?>
                    <tr>
                        <td><?= htmlspecialchars($partido['resultado_local'] ?? '') ?></td>
                        <td><?= htmlspecialchars($partido['resultado_visitante'] ?? '') ?></td>
                        <td><?= htmlspecialchars($partido['division'] ?? '') ?></td>
                        <td>
                            <div class="d-flex">
                                <button type="button" class="btn btn-primary btn-sm mb-3 mr-2 d-flex align-items-center" data-toggle="modal" data-target="#editPartidoModal" data-id="<?= $partido['id'] ?>" data-local="<?= htmlspecialchars($partido['resultado_local'] ?? '') ?>" data-visitante="<?= htmlspecialchars($partido['resultado_visitante'] ?? '') ?>" data-division="<?= htmlspecialchars($partido['division'] ?? '') ?>">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <a href="partidos/eliminar-partidos.php?id=<?= $partido['id'] ?>" class="btn btn-danger btn-sm mb-3 d-flex align-items-center">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Añadir Partido -->
    <div class="modal fade" id="addPartidoModal" tabindex="-1" aria-labelledby="addPartidoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPartidoModalLabel">Formulario añadir partido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="partidos/anyadir-partidos.php" method="POST">
                        <div class="form-group">
                            <label for="resultado_local">Resultado Local:</label>
                            <input type="text" id="resultado_local" name="resultado_local" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="resultado_visitante">Resultado Visitante:</label>
                            <input type="text" id="resultado_visitante" name="resultado_visitante" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="division">División:</label>
                            <input type="text" id="division" name="division" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Partido -->
    <div class="modal fade" id="editPartidoModal" tabindex="-1" aria-labelledby="editPartidoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPartidoModalLabel">Formulario editar partido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="partidos/editar-partidos.php" method="POST">
                        <input type="hidden" id="edit_partido_id" name="id">
                        <div class="form-group">
                            <label for="edit_resultado_local">Resultado Local:</label>
                            <input type="text" id="edit_resultado_local" name="resultado_local" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="edit_resultado_visitante">Resultado Visitante:</label>
                            <input type="text" id="edit_resultado_visitante" name="resultado_visitante" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="edit_division">División:</label>
                            <input type="text" id="edit_division" name="division" class="form-control" required>
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
        $('#editPartidoModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var local = button.data('local');
            var visitante = button.data('visitante');
            var division = button.data('division');

            var modal = $(this);
            modal.find('#edit_partido_id').val(id);
            modal.find('#edit_resultado_local').val(local);
            modal.find('#edit_resultado_visitante').val(visitante);
            modal.find('#edit_division').val(division);
        });
    </script>
</body>
</html>