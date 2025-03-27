<?php
session_start();
require_once 'config.php';

// Obtener el ID del partido desde la URL
$partido_id = $_GET['partido_id'] ?? null;

if ($partido_id) {
    // Obtener datos del partido
    $partidoResult = $mysqli->query("SELECT * FROM Partidos WHERE id = $partido_id");
    $partido = $partidoResult->fetch_assoc();

    // Obtener estadísticas del partido
    $estadisticasResult = $mysqli->query("
        SELECT p.nombre AS personaje_nombre, e.goles, e.amarillas, e.rojas, e.asistencias, e.pasesClave, e.regates, e.paradas, e.porteriaCero, e.valoracion
        FROM EstadisticasPersonajePartido e
        JOIN Personajes p ON e.personaje_id = p.id
        WHERE e.partido_id = $partido_id
    ");
    $estadisticas = $estadisticasResult->fetch_all(MYSQLI_ASSOC);
} else {
    // Redirigir a la página de partidos si no se proporciona un ID de partido
    header('Location: partidos.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas del Partido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>
<body class="">

<?php include('header.php'); ?>

<div class="container mt-5">
<br>
    <h1 class="text-center mb-4">Estadísticas del Partido</h1>

    <?php if ($partido): ?>
        <h2>Partido: <?php echo $partido['resultado_local'] . ' - ' . $partido['resultado_visitante']; ?></h2>
        <h3>División: <?php echo $partido['division']; ?></h3>

        <h2>Estadísticas</h2>
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
    <?php else: ?>
        <p class="text-center">No se encontraron estadísticas para este partido.</p>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+3i4l0i/tI1p4b5j5g5t5g5t5g5t5" crossorigin="anonymous"></script>
</body>
</html>