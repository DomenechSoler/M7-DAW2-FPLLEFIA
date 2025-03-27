<?php
session_start();
require_once('../config.php');

//1. verificar que el rol sea administrador
if (($_SESSION['user_rol']) !== 'admin') {
    echo 'No tienes permisos para acceder a esta página';
    exit;
}

//aqui irn todas las tablas de la base de datos para que el admin pueda gestionarlas

//extraccion de testimonios
$resultTestimonios = $mysqli->query("SELECT * FROM TESTIMONIALS");
$testimonios = $resultTestimonios->fetch_all(MYSQLI_ASSOC);

//extraccion de usuarios
$results = $mysqli->query("SELECT * FROM USERS");
$clientes = $results->fetch_all(MYSQLI_ASSOC);

//extraccion de noticias
$resultsNews = $mysqli->query("SELECT * FROM NEWS");
$news = $resultsNews->fetch_all(MYSQLI_ASSOC);

//extraccion de proyectos
$resultsProjects = $mysqli->query("SELECT * FROM PROJECTS");
$proyectos = $resultsProjects->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de administrador</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Panel de administrador</h1>
        <h2>Testimonios</h2> 
        <a href="testimonials/add-testimonial.php" class="btn btn-success mb-3">Añadir testimonio</a>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Testimonio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($testimonios as $item) : ?>
                    <tr>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td><?= htmlspecialchars($item['surname']) ?></td>
                        <td><?= htmlspecialchars($item['description']) ?></td>
                        <td>
                        <div class="d-flex">
                            <a href="testimonials/edit-testimonial.php?id=<?= $item['id'] ?>" class="btn btn-primary btn-sm mb-3 mr-2 d-flex align-items-center">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a href="testimonials/delete-testimonial.php?id=<?= $item['id'] ?>" class="btn btn-danger btn-sm mb-3 d-flex align-items-center">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Usuarios</h2>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Fecha de Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente) : ?>
                    <tr>
                        <td><?= htmlspecialchars($cliente['name']) ?></td>
                        <td><?= htmlspecialchars($cliente['surname']) ?></td>
                        <td><?= htmlspecialchars($cliente['email']) ?></td>
                        <td><?= htmlspecialchars($cliente['rol']) ?></td>
                        <td><?= htmlspecialchars($cliente['date_register']) ?></td>
                        <td>
                            <div class="d-flex">
                                <a href="users/edit-user.php?id=<?= $cliente['id'] ?>" class="btn btn-primary btn-sm mb-3 mr-2 d-flex align-items-center">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="users/delete-user.php?id=<?= $cliente['id'] ?>" class="btn btn-danger btn-sm mb-3 d-flex align-items-center">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Noticias</h2>
        <a href="news/add-new.php" class="btn btn-success mb-3">Añadir noticia</a>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Título</th>
                    <th>Subtítulo</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($news as $noticia) : ?>
                    <tr>
                        <td><?= htmlspecialchars($noticia['title']) ?></td>
                        <td><?= htmlspecialchars($noticia['subtitle']) ?></td>
                        <td><?= htmlspecialchars($noticia['description']) ?></td>
                        <td><img src="<?= htmlspecialchars($noticia['thumbnail']) ?>" width="100px" height="100px" alt="imagen de noticia"></td>
                        <td><?= htmlspecialchars($noticia['new_date']) ?></td>
                        <td>
                            <div class="d-flex">
                                <a href="news/edit-new.php?id=<?= $noticia['id'] ?>" class="btn btn-primary btn-sm mb-3 mr-2 d-flex align-items-center">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="news/delete-new.php?id=<?= $noticia['id'] ?>" class="btn btn-danger btn-sm mb-3 d-flex align-items-center">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Proyectos</h2>
        <a href="projects/add-project.php" class="btn btn-success mb-3">Añadir proyecto</a>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($proyectos as $proyecto) : ?>
                    <tr>
                        <td><?= htmlspecialchars($proyecto['title']) ?></td>
                        <td><?= htmlspecialchars($proyecto['description']) ?></td>
                        <td><?= htmlspecialchars($proyecto['category']) ?></td>
                        <td><img src="<?= htmlspecialchars($proyecto['thumbnail']) ?>" width="100px" height="100px" alt="imagen de proyecto"></td>
                        <td>
                            <div class="d-flex">
                                <a href="projects/edit-project.php?id=<?= $proyecto['id'] ?>" class="btn btn-primary btn-sm mb-3 mr-2 d-flex align-items-center">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="projects/delete-project.php?id=<?= $proyecto['id'] ?>" class="btn btn-danger btn-sm mb-3 d-flex align-items-center">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>