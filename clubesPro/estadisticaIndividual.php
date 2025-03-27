<?php
session_start();
require_once 'config.php';

// Obtener datos de los usuarios
$usuariosResult = $mysqli->query("SELECT id, nombre FROM Usuarios");
$usuarios = $usuariosResult->fetch_all(MYSQLI_ASSOC);

// Obtener datos de los personajes
$personajesResult = $mysqli->query("SELECT id, nombre FROM Personajes");
$personajes = $personajesResult->fetch_all(MYSQLI_ASSOC);

// Obtener estadísticas globales
$estadisticasResult = $mysqli->query("SELECT p.id AS personaje_id, p.nombre AS personaje_nombre, SUM(e.goles) AS goles, SUM(e.amarillas) AS amarillas, SUM(e.rojas) AS rojas, SUM(e.asistencias) AS asistencias, SUM(e.pasesClave) AS pasesClave, SUM(e.regates) AS regates, SUM(e.paradas) AS paradas, SUM(e.porteriaCero) AS porteriaCero, AVG(e.valoracion) AS valoracion FROM EstadisticasPersonajePartido e JOIN Personajes p ON e.personaje_id = p.id GROUP BY p.id, p.nombre");
$estadisticas = $estadisticasResult->fetch_all(MYSQLI_ASSOC);

// Filtrar estadísticas por usuario o personaje
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_POST['usuario_id'] ?? null;
    $personaje_id = $_POST['personaje_id'] ?? null;

    $query = "SELECT p.id AS personaje_id, p.nombre AS personaje_nombre, SUM(e.goles) AS goles, SUM(e.amarillas) AS amarillas, SUM(e.rojas) AS rojas, SUM(e.asistencias) AS asistencias, SUM(e.pasesClave) AS pasesClave, SUM(e.regates) AS regates, SUM(e.paradas) AS paradas, SUM(e.porteriaCero) AS porteriaCero, AVG(e.valoracion) AS valoracion FROM EstadisticasPersonajePartido e JOIN Personajes p ON e.personaje_id = p.id WHERE 1=1";

    if ($usuario_id) {
        $query .= " AND p.usuario_id = $usuario_id";
    }

    if ($personaje_id) {
        $query .= " AND e.personaje_id = $personaje_id";
    }

    $query .= " GROUP BY p.id, p.nombre";

    $estadisticasResult = $mysqli->query($query);
    $estadisticas = $estadisticasResult->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas Individuales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>
<body class="">

<?php include('header.php'); ?>

<div class="container mt-5">
<br>
    <h1 class="text-center mb-4">Estadísticas Individuales</h1>

    <form method="post" class="mb-4">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="usuario_id" class="form-label">Filtrar por Usuario</label>
                <select name="usuario_id" id="usuario_id" class="form-select">
                    <option value="">Seleccionar Usuario</option>
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?php echo $usuario['id']; ?>"><?php echo $usuario['nombre']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="personaje_id" class="form-label">Filtrar por Personaje</label>
                <select name="personaje_id" id="personaje_id" class="form-select">
                    <option value="">Seleccionar Personaje</option>
                    <?php foreach ($personajes as $personaje): ?>
                        <option value="<?php echo $personaje['id']; ?>"><?php echo $personaje['nombre']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-gold text-white">Filtrar</button>
    </form>

    <h2>Estadísticas Globales</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Personaje</th>
                <th>Goles</th>
                <th>Amarillas</th>
                <th>Rojas</th>
                <th>Asistencias</th>
                <th>Pases Clave</th>
                <th>Regates</th>
                <th>Paradas</th>
                <th>Portería a Cero</th>
                <th>Valoración</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($estadisticas as $estadistica): ?>
                <tr>
                    <td><?php echo $estadistica['personaje_nombre']; ?></td>
                    <td><?php echo $estadistica['goles']; ?></td>
                    <td><?php echo $estadistica['amarillas']; ?></td>
                    <td><?php echo $estadistica['rojas']; ?></td>
                    <td><?php echo $estadistica['asistencias']; ?></td>
                    <td><?php echo $estadistica['pasesClave']; ?></td>
                    <td><?php echo $estadistica['regates']; ?></td>
                    <td><?php echo $estadistica['paradas']; ?></td>
                    <td><?php echo $estadistica['porteriaCero'] ? 'Sí' : 'No'; ?></td>
                    <td><?php echo number_format($estadistica['valoracion'], 2); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+3i4l0i/tI1p4b5j5g5t5g5t5g5t5" crossorigin="anonymous"></script>
</body>
</html>