<?php
session_start();
require_once('../../config.php');

//1. verificar que el rol sea administrador
if (($_SESSION['user_rol']) !== 'admin') {
    echo 'No tienes permisos para acceder a esta página';
    exit;
}

//2. comprobar si se ha proporcionado un ID de estadística
if (!isset($_GET['id']) && !isset($_POST['id'])) {
    echo 'ID de estadística no proporcionado';
    exit;
}

$estadistica_id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];

//3. obtener los datos de la estadística existente si el ID se proporciona a través de GET
if (isset($_GET['id'])) {
    $stmt = $mysqli->prepare("SELECT personaje_id, goles, amarillas, rojas, asistencias, pasesClave, regates, paradas, porteriaCero, valoracion FROM EstadisticasPersonajePartido WHERE id = ?");
    $stmt->bind_param('i', $estadistica_id);
    $stmt->execute();
    $stmt->bind_result($personaje_id, $goles, $amarillas, $rojas, $asistencias, $pasesClave, $regates, $paradas, $porteriaCero, $valoracion);
    $stmt->fetch();
    $stmt->close();
}

//4. comprobar si el formulario ha sido enviado
if (isset($_POST['valoracion'])) {
    //5. recoger los datos del formulario
    $personaje_id = $_POST['personaje_id'];
    $goles = $_POST['goles'] ?? null;
    $amarillas = $_POST['amarillas'] ?? null;
    $rojas = $_POST['rojas'] ?? null;
    $asistencias = $_POST['asistencias'] ?? null;
    $pasesClave = $_POST['pasesClave'] ?? null;
    $regates = $_POST['regates'] ?? null;
    $paradas = $_POST['paradas'] ?? null;
    $porteriaCero = $_POST['porteriaCero'] ?? null;
    $valoracion = $_POST['valoracion'];

    //6. preparar la consulta para actualizar la estadística
    $stmt = $mysqli->prepare(
        "UPDATE EstadisticasPersonajePartido SET personaje_id = ?, goles = ?, amarillas = ?, rojas = ?, asistencias = ?, pasesClave = ?, regates = ?, paradas = ?, porteriaCero = ?, valoracion = ? WHERE id = ?"
    );

    //7. comprobar que la preparación tuvo éxito
    if (!$stmt) {
        die('Error en la preparación: ' . $mysqli->error);
    }

    //8. bindear los parámetros
    $stmt->bind_param('iiiiiiiiidi', $personaje_id, $goles, $amarillas, $rojas, $asistencias, $pasesClave, $regates, $paradas, $porteriaCero, $valoracion, $estadistica_id);

    //9. ejecutar la consulta
    if ($stmt->execute()) {
        header('Location: ../adminEstadisticas.php');
        exit();
    } else {
        echo 'Error al actualizar la estadística';
    }

    //10. cerrar la conexión
    $stmt->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario editar estadística</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h1 class="mb-4">Formulario editar estadística</h1>
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($estadistica_id); ?>">

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
                        $selected = $jugador['id'] == $personaje_id ? 'selected' : '';
                        echo "<option value='{$jugador['id']}' $selected>{$jugador['nombre']}</option>";
                    }
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="goles">Goles:</label>
            <input type="number" id="goles" name="goles" class="form-control" value="<?php echo htmlspecialchars($goles); ?>">
        </div>

        <div class="form-group">
            <label for="amarillas">Amarillas:</label>
            <input type="number" id="amarillas" name="amarillas" class="form-control" value="<?php echo htmlspecialchars($amarillas); ?>">
        </div>

        <div class="form-group">
            <label for="rojas">Rojas:</label>
            <input type="number" id="rojas" name="rojas" class="form-control" value="<?php echo htmlspecialchars($rojas); ?>">
        </div>

        <div class="form-group">
            <label for="asistencias">Asistencias:</label>
            <input type="number" id="asistencias" name="asistencias" class="form-control" value="<?php echo htmlspecialchars($asistencias); ?>">
        </div>

        <div class="form-group">
            <label for="pasesClave">Pases Clave:</label>
            <input type="number" id="pasesClave" name="pasesClave" class="form-control" value="<?php echo htmlspecialchars($pasesClave); ?>">
        </div>

        <div class="form-group">
            <label for="regates">Regates:</label>
            <input type="number" id="regates" name="regates" class="form-control" value="<?php echo htmlspecialchars($regates); ?>">
        </div>

        <div class="form-group">
            <label for="paradas">Paradas:</label>
            <input type="number" id="paradas" name="paradas" class="form-control" value="<?php echo htmlspecialchars($paradas); ?>">
        </div>

        <div class="form-group">
            <label for="porteriaCero">Portería a Cero:</label>
            <select id="porteriaCero" name="porteriaCero" class="form-control">
                <option value="1" <?php echo $porteriaCero ? 'selected' : ''; ?>>Sí</option>
                <option value="0" <?php echo !$porteriaCero ? 'selected' : ''; ?>>No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="valoracion">Valoración:</label>
            <input type="number" step="0.01" id="valoracion" name="valoracion" class="form-control" value="<?php echo htmlspecialchars($valoracion); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>

    <!-- Incluir Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>