<?php
session_start();
require_once('../config.php');

//1. verificar que el rol sea administrador
if (($_SESSION['user_rol']) !== 'admin') {
    echo 'No tienes permisos para acceder a esta página';
    exit;
}

//extraccion de testimonios
$resultTestimonios = $mysqli->query("SELECT * FROM TESTIMONIALS");
$testimonios = $resultTestimonios->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Testimonios</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<?php include('headerAdmin.php'); ?>

<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Administrar Testimonios</h1>
        <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#addTestimonialModal">Añadir testimonio</button>
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
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addTestimonialModal" tabindex="-1" aria-labelledby="addTestimonialModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTestimonialModalLabel">Formulario añadir testimonio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="testimonials/add-testimonial.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="surname">Apellido:</label>
                            <input type="text" id="surname" name="surname" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción:</label>
                            <textarea name="description" id="description" class="form-control" cols="30" rows="10" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="thumbnail">Imagen:</label>
                            <input type="file" id="thumbnail" name="thumbnail" class="form-control" accept="image/*" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>