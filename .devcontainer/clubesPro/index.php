<?php
session_start();
require_once './config.php';

// Obtener datos de la tabla Personajes con la valoración media
$personajesResult = $mysqli->query("
    SELECT p.id, p.nombre, p.posicion, p.altura, u.nombre AS usuario_nombre, AVG(e.valoracion) AS valoracion_media
    FROM Personajes p
    JOIN Usuarios u ON p.usuario_id = u.id
    LEFT JOIN EstadisticasPersonajePartido e ON p.id = e.personaje_id
    GROUP BY p.id, p.nombre, p.posicion, p.altura, u.nombre
");
$personajes = $personajesResult->fetch_all(MYSQLI_ASSOC);

// Obtener datos de la tabla Partidos
$partidosResult = $mysqli->query("SELECT * FROM Partidos");
$partidos = $partidosResult->fetch_all(MYSQLI_ASSOC);

// Inicializar contadores
$partidosJugadosLocal = 0;
$partidosGanadosLocal = 0;
$partidosEmpatadosLocal = 0;
$partidosPerdidosLocal = 0;

$partidosJugadosVisitante = 0;
$partidosGanadosVisitante = 0;
$partidosEmpatadosVisitante = 0;
$partidosPerdidosVisitante = 0;

// Contar partidos jugados, ganados, empatados y perdidos
foreach ($partidos as $partido) {
    if (!empty($partido['resultado_local'])) {
        $partidosJugadosLocal++;
        list($golesLocal, $golesVisitante) = explode('-', $partido['resultado_local']);
        if ($golesLocal > $golesVisitante) {
            $partidosGanadosLocal++;
        } elseif ($golesLocal == $golesVisitante) {
            $partidosEmpatadosLocal++;
        } else {
            $partidosPerdidosLocal++;
        }
    }

    if (!empty($partido['resultado_visitante'])) {
        $partidosJugadosVisitante++;
        list($golesVisitante, $golesLocal) = explode('-', $partido['resultado_visitante']);
        if ($golesVisitante < $golesLocal) {
            $partidosGanadosVisitante++;
        } elseif ($golesVisitante == $golesLocal) {
            $partidosEmpatadosVisitante++;
        } else {
            $partidosPerdidosVisitante++;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas de Clubes Pro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>
<body class="">

<?php include('header.php'); ?>

<div class="container mt-5">
<br>
    <h1 class="text-center mb-4">Estadísticas de Clubes Pro</h1>
    
    <h2>Personajes</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Posición</th>
                <th>Altura</th>
                <th>Usuario</th>
                <th>Valoración media</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($personajes as $personaje): ?>
                <tr>
                    <td><?php echo $personaje['nombre']; ?></td>
                    <td><?php echo $personaje['posicion']; ?></td>
                    <td><?php echo $personaje['altura']; ?></td>
                    <td><?php echo $personaje['usuario_nombre']; ?></td>
                    <td><?php echo number_format($personaje['valoracion_media'], 2); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>

<hr>
    <br>
    <h2>Partidos como Local</h2>
    <h5>Partidos Jugados: <?php echo $partidosJugadosLocal; ?></h5>
    <h5>Partidos Ganados: <?php echo $partidosGanadosLocal; ?></h5>
    <h5>Partidos Empatados: <?php echo $partidosEmpatadosLocal; ?></h5>
    <h5>Partidos Perdidos: <?php echo $partidosPerdidosLocal; ?></h5>
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>Resultado Local</th>
                <th>División</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($partidos as $partido): ?>
                <?php if (!empty($partido['resultado_local'])): ?>
                    <tr onclick="window.location.href='estadisticaPartido.php?partido_id=<?php echo $partido['id']; ?>'">
                        <td><?php echo $partido['resultado_local']; ?></td>
                        <td><?php echo $partido['division']; ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>

<hr>
    <br>

    <h2>Partidos como Visitante</h2>
    <h5>Partidos Jugados: <?php echo $partidosJugadosVisitante; ?></h5>
    <h5>Partidos Ganados: <?php echo $partidosGanadosVisitante; ?></h5>
    <h5>Partidos Empatados: <?php echo $partidosEmpatadosVisitante; ?></h5>
    <h5>Partidos Perdidos: <?php echo $partidosPerdidosVisitante; ?></h5>
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>Resultado Visitante</th>
                <th>División</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($partidos as $partido): ?>
                <?php if (!empty($partido['resultado_visitante'])): ?>
                    <tr onclick="window.location.href='estadisticaPartido.php?partido_id=<?php echo $partido['id']; ?>'">
                        <td><?php echo $partido['resultado_visitante']; ?></td>
                        <td><?php echo $partido['division']; ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+3i4l0i/tI1p4b5j5g5t5g5t5g5t5" crossorigin="anonymous"></script>
</body>
</html>