<?php
session_start();
require_once('../config.php');

//1. verificar que el rol sea administrador
if (($_SESSION['user_rol']) !== 'admin') {
    echo 'No tienes permisos para acceder a esta página';
    exit;
}

//extraccion de estadísticas con unión a la tabla de personajes
$query = "
    SELECT e.id, e.personaje_id, e.goles, e.amarillas, e.rojas, e.asistencias, e.pasesClave, e.regates, e.paradas, e.porteriaCero, e.valoracion, p.nombre AS jugador_nombre
    FROM EstadisticasPersonajePartido e
    JOIN Personajes p ON e.personaje_id = p.id
";
$resultsEstadisticas = $mysqli->query($query);
if (!$resultsEstadisticas) {
    die('Error en la consulta: ' . $mysqli->error);
}
$estadisticas = $resultsEstadisticas->fetch_all(MYSQLI_ASSOC);

//extraccion de jugadores
$queryJugadores = "SELECT id, nombre FROM Personajes";
$resultsJugadores = $mysqli->query($queryJugadores);
if (!$resultsJugadores) {
    die('Error en la consulta: ' . $mysqli->error);
}
$jugadores = $resultsJugadores->fetch_all(MYSQLI_ASSOC);

//extraccion de los 10 partidos más recientes
$queryPartidos = "SELECT id, resultado_local, resultado_visitante, division FROM Partidos ORDER BY id DESC LIMIT 10";
$resultsPartidos = $mysqli->query($queryPartidos);
if (!$resultsPartidos) {
    die('Error en la consulta: ' . $mysqli->error);
}
$partidos = $resultsPartidos->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Estadísticas</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<?php include('headerAdmin.php'); ?>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Administrar Estadísticas</h1>
        <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#addEstadisticaModal">Añadir Estadística</button>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Jugador</th>
                    <th>Goles</th>
                    <th>Amarillas</th>
                    <th>Rojas</th>
                    <th>Asistencias</th>
                    <th>Pases Clave</th>
                    <th>Regates</th>
                    <th>Paradas</th>
                    <th>Portería a Cero</th>
                    <th>Valoración</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($estadisticas) > 0): ?>
                    <?php foreach ($estadisticas as $estadistica) : ?>
                        <tr>
                            <td><?= htmlspecialchars($estadistica['jugador_nombre']) ?></td>
                            <td><?= htmlspecialchars($estadistica['goles']) ?></td>
                            <td><?= htmlspecialchars($estadistica['amarillas']) ?></td>
                            <td><?= htmlspecialchars($estadistica['rojas']) ?></td>
                            <td><?= htmlspecialchars($estadistica['asistencias']) ?></td>
                            <td><?= htmlspecialchars($estadistica['pasesClave']) ?></td>
                            <td><?= htmlspecialchars($estadistica['regates']) ?></td>
                            <td><?= htmlspecialchars($estadistica['paradas']) ?></td>
                            <td><?= $estadistica['porteriaCero'] ? 'Sí' : 'No'; ?></td>
                            <td><?= number_format($estadistica['valoracion'], 2); ?></td>
                            <td>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-primary btn-sm mb-3 mr-2 d-flex align-items-center" data-toggle="modal" data-target="#editEstadisticaModal" data-id="<?= $estadistica['id'] ?>" data-personaje_id="<?= $estadistica['personaje_id'] ?>" data-goles="<?= $estadistica['goles'] ?>" data-amarillas="<?= $estadistica['amarillas'] ?>" data-rojas="<?= $estadistica['rojas'] ?>" data-asistencias="<?= $estadistica['asistencias'] ?>" data-pasesClave="<?= $estadistica['pasesClave'] ?>" data-regates="<?= $estadistica['regates'] ?>" data-paradas="<?= $estadistica['paradas'] ?>" data-porteriaCero="<?= $estadistica['porteriaCero'] ?>" data-valoracion="<?= $estadistica['valoracion'] ?>">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <a href="estadisticas/eliminar-estadisticas.php?id=<?= $estadistica['id'] ?>" class="btn btn-danger btn-sm mb-3 d-flex align-items-center">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="11" class="text-center">No hay estadísticas disponibles</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Añadir Estadística -->
    <div class="modal fade" id="addEstadisticaModal" tabindex="-1" aria-labelledby="addEstadisticaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEstadisticaModalLabel">Formulario añadir estadística</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="estadisticas/anyadir-estadisticas.php" method="POST">
                        <div class="form-group">
                            <label for="personaje_id">Jugador:</label>
                            <select id="personaje_id" name="personaje_id" class="form-control" required>
                                <option value="">Seleccionar Jugador</option>
                                <?php foreach ($jugadores as $jugador): ?>
                                    <option value="<?= $jugador['id'] ?>"><?= htmlspecialchars($jugador['nombre']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="partido_id">Partido:</label>
                            <select id="partido_id" name="partido_id" class="form-control" required>
                                <option value="">Seleccionar Partido</option>
                                <?php foreach ($partidos as $partido): ?>
                                    <option value="<?= $partido['id'] ?>">
                                        <?= htmlspecialchars("{$partido['resultado_local']} - {$partido['resultado_visitante']} ({$partido['division']})") ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="goles">Goles:</label>
                            <input type="number" id="goles" name="goles" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="amarillas">Amarillas:</label>
                            <input type="number" id="amarillas" name="amarillas" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="rojas">Rojas:</label>
                            <input type="number" id="rojas" name="rojas" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="asistencias">Asistencias:</label>
                            <input type="number" id="asistencias" name="asistencias" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="pasesClave">Pases Clave:</label>
                            <input type="number" id="pasesClave" name="pasesClave" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="regates">Regates:</label>
                            <input type="number" id="regates" name="regates" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="paradas">Paradas:</label>
                            <input type="number" id="paradas" name="paradas" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="porteriaCero">Portería a Cero:</label>
                            <select id="porteriaCero" name="porteriaCero" class="form-control">
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="valoracion">Valoración:</label>
                            <input type="number" step="0.01" id="valoracion" name="valoracion" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Estadística -->
    <div class="modal fade" id="editEstadisticaModal" tabindex="-1" aria-labelledby="editEstadisticaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEstadisticaModalLabel">Formulario editar estadística</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="estadisticas/editar-estadisticas.php" method="POST">
                        <input type="hidden" id="edit_estadistica_id" name="id">
                        <div class="form-group">
                            <label for="edit_personaje_id">Jugador:</label>
                            <select id="edit_personaje_id" name="personaje_id" class="form-control" required>
                                <option value="">Seleccionar Jugador</option>
                                <?php foreach ($jugadores as $jugador): ?>
                                    <option value="<?= $jugador['id'] ?>"><?= htmlspecialchars($jugador['nombre']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_goles">Goles:</label>
                            <input type="number" id="edit_goles" name="goles" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="edit_amarillas">Amarillas:</label>
                            <input type="number" id="edit_amarillas" name="amarillas" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="edit_rojas">Rojas:</label>
                            <input type="number" id="edit_rojas" name="rojas" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="edit_asistencias">Asistencias:</label>
                            <input type="number" id="edit_asistencias" name="asistencias" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="edit_pasesClave">Pases Clave:</label>
                            <input type="number" id="edit_pasesClave" name="pasesClave" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="edit_regates">Regates:</label>
                            <input type="number" id="edit_regates" name="regates" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="edit_paradas">Paradas:</label>
                            <input type="number" id="edit_paradas" name="paradas" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="edit_porteriaCero">Portería a Cero:</label>
                            <select id="edit_porteriaCero" name="porteriaCero" class="form-control">
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_valoracion">Valoración:</label>
                            <input type="number" step="0.01" id="edit_valoracion" name="valoracion" class="form-control" required>
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
        $('#editEstadisticaModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var personaje_id = button.data('personaje_id');
            var goles = button.data('goles');
            var amarillas = button.data('amarillas');
            var rojas = button.data('rojas');
            var asistencias = button.data('asistencias');
            var pasesClave = button.data('pasesClave');
            var regates = button.data('regates');
            var paradas = button.data('paradas');
            var porteriaCero = button.data('porteriaCero');
            var valoracion = button.data('valoracion');

            var modal = $(this);
            modal.find('#edit_estadistica_id').val(id);
            modal.find('#edit_personaje_id').val(personaje_id);
            modal.find('#edit_goles').val(goles);
            modal.find('#edit_amarillas').val(amarillas);
            modal.find('#edit_rojas').val(rojas);
            modal.find('#edit_asistencias').val(asistencias);
            modal.find('#edit_pasesClave').val(pasesClave);
            modal.find('#edit_regates').val(regates);
            modal.find('#edit_paradas').val(paradas);
            modal.find('#edit_porteriaCero').val(porteriaCero);
            modal.find('#edit_valoracion').val(valoracion);
        });
    </script>
</body>
</html>