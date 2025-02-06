<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patrones de diseño</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="bg-secondary">
<div class="container bg-light mt-3">
    <nav class="container border-solid-3 shadow navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="estructurals.php">Estructurales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="creacion.php">De Creación</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="comportament.php">De Comportamineto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

        <h1 class="text-center mb-5 mt-3">Patrones de diseño</h1>
        <div class="row">
            <div class="col-md-6">
                <img class="" src="imagenes/patronesDiseño.png" alt="" style="display: block; margin: 0 auto; width: 100%;">
            </div>
            <div class="col-md-6 mt-5">
                <h3>Que son los patrones de diseño</h3>
                <p>Los patrones de diseño (design patterns) son soluciones habituales a problemas comunes en el diseño de software. Cada patrón es como un plano que se puede personalizar para resolver un problema de diseño particular de tu código.</p>
                <h3>Ventajas de los patrones de diseño</h3>
                <p>Los patrones son un juego de herramientas que brindan soluciones a problemas habituales en el diseño de software. Definen un lenguaje común que ayuda a tu equipo a comunicarse con más eficiencia.</p>
                <h3>Clasificación</h3>
                <p>Los patrones de diseño varían en su complejidad, nivel de detalle y escala de aplicabilidad. Además, pueden clasificarse por su propósito y dividirse en tres grupos.</p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-4 shadow">
                <div class="card bg-secondary">
                    <div class="card-body">
                        <h5 class="card-title">Estructurales</h5>
                        <p class="card-text">Patrones que tratan cómo están estructuradas las clases y objetos.</p>
                        <a href="estructurals.php" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 shadow">
                <div class="card bg-secondary">
                    <div class="card-body">
                        <h5 class="card-title">De Creación</h5>
                        <p class="card-text">Patrones que tratan con la creación de objetos.</p>
                        <a href="creacion.php" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 shadow">
                <div class="card bg-secondary">
                    <div class="card-body">
                        <h5 class="card-title">De Comportamiento</h5>
                        <p class="card-text">Patrones que tratan con la comunicación entre objetos.</p>
                        <a href="comportament.php" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br><br>
    </div>
</body>
</html>
