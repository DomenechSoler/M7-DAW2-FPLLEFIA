<?php
session_start();
require_once 'config.php';

// Obtener datos de la tabla Partidos
$partidosResult = $mysqli->query("
    SELECT p.*, 
           (SELECT nombre 
            FROM Personajes 
            JOIN EstadisticasPersonajePartido e ON Personajes.id = e.personaje_id 
            WHERE e.partido_id = p.id 
            ORDER BY e.valoracion DESC 
            LIMIT 1) AS mvp
    FROM Partidos p
");
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
    <title>Partidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>
<body class="">

<?php include('header.php'); ?>

<div class="container mt-5">
<br>
    <h1 class="text-center mb-4">Partidos</h1>

    <div class="d-flex justify-content-between mb-3">
        <div>
            <input class="form-check-input" type="checkbox" id="switchPartidos" checked>
            <label class="form-check-label" for="switchPartidos"><h5>Mostrar Partidos de Local</h5></label>
        </div>
    </div>

    <div id="contadoresLocal">
        <h6>Partidos Jugados: <?php echo $partidosJugadosLocal; ?></h6>
        <h6>Partidos Ganados: <?php echo $partidosGanadosLocal; ?></h6>
        <h6>Partidos Empatados: <?php echo $partidosEmpatadosLocal; ?></h6>
        <h6>Partidos Perdidos: <?php echo $partidosPerdidosLocal; ?></h6>
    </div>

    <div id="contadoresVisitante" style="display: none;">
        <h6>Partidos Jugados: <?php echo $partidosJugadosVisitante; ?></h6>
        <h6>Partidos Ganados: <?php echo $partidosGanadosVisitante; ?></h6>
        <h6>Partidos Empatados: <?php echo $partidosEmpatadosVisitante; ?></h6>
        <h6>Partidos Perdidos: <?php echo $partidosPerdidosVisitante; ?></h6>
    </div>

    <table class="table table-striped mt-4" id="tablaLocal">
        <thead>
            <tr>
                <th>Resultado Local</th>
                <th>División</th>
                <th>MVP</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($partidos as $partido): ?>
                <?php if (!empty($partido['resultado_local'])): ?>
                    <tr onclick="window.location.href='estadisticaPartido.php?partido_id=<?php echo $partido['id']; ?>'">
                        <td><?php echo $partido['resultado_local']; ?></td>
                        <td><?php echo $partido['division']; ?></td>
                        <td><?php echo $partido['mvp']; ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <table class="table table-striped mt-4" id="tablaVisitante" style="display: none;">
        <thead>
            <tr>
                <th>Resultado Visitante</th>
                <th>División</th>
                <th>MVP</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($partidos as $partido): ?>
                <?php if (!empty($partido['resultado_visitante'])): ?>
                    <tr onclick="window.location.href='estadisticaPartido.php?partido_id=<?php echo $partido['id']; ?>'">
                        <td><?php echo $partido['resultado_visitante']; ?></td>
                        <td><?php echo $partido['division']; ?></td>
                        <td><?php echo $partido['mvp']; ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+3i4l0i/tI1p4b5j5g5t5g5t5g5t5" crossorigin="anonymous"></script>
<script>
document.getElementById('switchPartidos').addEventListener('change', function() {
    const isChecked = this.checked;
    const tablaLocal = document.getElementById('tablaLocal');
    const tablaVisitante = document.getElementById('tablaVisitante');
    const contadoresLocal = document.getElementById('contadoresLocal');
    const contadoresVisitante = document.getElementById('contadoresVisitante');

    if (isChecked) {
        tablaLocal.style.display = '';
        tablaVisitante.style.display = 'none';
        contadoresLocal.style.display = '';
        contadoresVisitante.style.display = 'none';
    } else {
        tablaLocal.style.display = 'none';
        tablaVisitante.style.display = '';
        contadoresLocal.style.display = 'none';
        contadoresVisitante.style.display = '';
    }
});
</script>
</body>
</html>