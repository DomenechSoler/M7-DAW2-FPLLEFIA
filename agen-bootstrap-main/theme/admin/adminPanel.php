<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .panel-item {
            border: 2px solid #ccc;
            padding: 50px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
            margin-bottom: 20px;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }
        .full-height {
            height: 100vh;
        }
    </style>
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center full-height">
        <div class="w-100">
            <div class="row mb-5">
                <div class="col-md-6 d-flex">
                    <a href="adminTestimonials.php" class="panel-item w-100">
                        <h2>Testimonios</h2>
                        <p>Gestiona los testimonios de los usuarios.</p>  
                    </a>
                </div>
                <div class="col-md-6 d-flex">
                    <a href="adminNews.php" class="panel-item w-100">
                        <h2>Noticias</h2>
                        <p>Gestiona las noticias y actualizaciones.</p>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 d-flex">
                    <a href="adminUsers.php" class="panel-item w-100">
                        <h2>Usuarios</h2>
                        <p>Gestiona los usuarios registrados.</p>
                    </a>
                </div>
                <div class="col-md-6 d-flex">
                    <a href="adminProjects.php" class="panel-item w-100">
                        <h2>Proyectos</h2>
                        <p>Gestiona los proyectos en curso.</p>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 d-flex">
                    <a href="adminComments.php" class="panel-item w-100">
                        <h2>Comentarios</h2>
                        <p>Gestiona los comentarios de los usuarios.</p>
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