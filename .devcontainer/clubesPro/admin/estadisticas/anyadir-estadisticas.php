<?php
session_start();
require_once('../../config.php');

//1. verificar que el rol sea administrador
if (($_SESSION['user_rol']) !== 'admin') {
    echo 'No tienes permisos para acceder a esta página';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $personaje_id = $_POST['personaje_id'];
    $partido_id = $_POST['partido_id'];
    $goles = $_POST['goles'] ?? null;
    $amarillas = $_POST['amarillas'] ?? null;
    $rojas = $_POST['rojas'] ?? null;
    $asistencias = $_POST['asistencias'] ?? null;
    $pasesClave = $_POST['pasesClave'] ?? null;
    $regates = $_POST['regates'] ?? null;
    $paradas = $_POST['paradas'] ?? null;
    $porteriaCero = $_POST['porteriaCero'] ?? null;
    $valoracion = $_POST['valoracion'];

    // preparar la consulta para insertar la estadística
    $stmt = $mysqli->prepare("INSERT INTO EstadisticasPersonajePartido (personaje_id, partido_id, goles, amarillas, rojas, asistencias, pasesClave, regates, paradas, porteriaCero, valoracion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param('iiiiiiiiiii', $personaje_id, $partido_id, $goles, $amarillas, $rojas, $asistencias, $pasesClave, $regates, $paradas, $porteriaCero, $valoracion);
        if ($stmt->execute()) {
            header('Location: ../adminEstadisticas.php');
            exit();
        } else {
            echo 'Error al añadir la estadística: ' . $stmt->error;
        }
        $stmt->close();
    } else {
        echo 'Error en la preparación de la consulta: ' . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Estadística</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h1 class="mb-4">Añadir Estadística</h1>
    <form action="" method="POST">
        <div class="form-group">
            <label for="personaje_id">Jugador:</label>
            <select id="personaje_id" name="personaje_id" class="form-control" required>
                <option value="">Seleccionar Jugador</option>
                <?php
                // Obtener la lista de jugadores
                $queryJugadores = "SELECT id, nombre FROM Personajes";
                $resultsJugadores = $mysqli->query($queryJugadores);
                if ($resultsJugadores) {
                    while ($jugador = $resultsJugadores->fetch_assoc()) {
                        echo "<option value='{$jugador['id']}'>{$jugador['nombre']}</option>";
                    }
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="partido_id">Partido:</label>
            <select id="partido_id" name="partido_id" class="form-control" required>
                <option value="">Seleccionar Partido</option>
                <?php
                // Obtener la lista de partidos
                $queryPartidos = "SELECT id, CONCAT(resultado_local, ' - ', resultado_visitante, ' (', division, ')') AS partido FROM Partidos";
                $resultsPartidos = $mysqli->query($queryPartidos);
                if ($resultsPartidos) {
                    while ($partido = $resultsPartidos->fetch_assoc()) {
                        echo "<option value='{$partido['id']}'>{$partido['partido']}</option>";
                    }
                }
                ?>
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

        <button type="submit" class="btn btn-primary">Añadir</button>
    </form>

    <!-- Incluir Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>