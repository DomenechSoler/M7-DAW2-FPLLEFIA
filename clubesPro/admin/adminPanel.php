<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../style.css" rel="stylesheet">
</head>
<body class="admin-panel-body"> <!-- Fondo negro -->

    <div class="container admin-panel-container d-flex align-items-center justify-content-center full-height">
        <div class="w-100">
            <div class="row mb-5">
                <div class="col-md-6 d-flex">
                    <a href="adminPartidos.php" class="panel-item w-100">
                        <h2>Partidos</h2>
                        <p>Gestiona los partidos.</p>  
                    </a>
                </div>
                <div class="col-md-6 d-flex">
                    <a href="adminPersonajes.php" class="panel-item w-100">
                        <h2>Personajes</h2>
                        <p>Gestiona los personajes.</p>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 d-flex">
                    <a href="adminUsuarios.php" class="panel-item w-100">
                        <h2>Usuarios</h2>
                        <p>Gestiona los usuarios registrados.</p>
                    </a>
                </div>
                <div class="col-md-6 d-flex">
                    <a href="adminEstadisticas.php" class="panel-item w-100">
                        <h2>Estadísticas</h2>
                        <p>Gestiona las estadísticas.</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>