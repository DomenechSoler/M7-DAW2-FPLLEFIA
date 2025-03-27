<?php
session_start();
require_once('../config.php');

//1. verificar que el rol sea administrador
if (($_SESSION['user_rol']) !== 'admin') {
    echo 'No tienes permisos para acceder a esta página';
    exit;
}

//extraccion de comentarios
$resultsComments = $mysqli->query("SELECT * FROM COMMENTS");
$comments = $resultsComments->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Comentarios</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<?php include('headerAdmin.php'); ?>

<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Administrar Comentarios</h1>
        <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#addCommentModal">Añadir comentario</button>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>ID Noticia</th>
                    <th>ID Usuario</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>ID Comentario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comments as $comment) : ?>
                    <tr>
                        <td><?= htmlspecialchars($comment['id'] ?? '') ?></td>
                        <td><?= htmlspecialchars($comment['id_new'] ?? '') ?></td>
                        <td><?= htmlspecialchars($comment['id_user'] ?? '') ?></td>
                        <td><?= htmlspecialchars($comment['description'] ?? '') ?></td>
                        <td><?= htmlspecialchars($comment['date'] ?? '') ?></td>
                        <td><?= htmlspecialchars($comment['id_comment'] ?? '') ?></td>
                        <td>
                            <div class="d-flex">
                                <a href="comments/edit-comment.php?id=<?= $comment['id'] ?>" class="btn btn-primary btn-sm mb-3 mr-2 d-flex align-items-center">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="comments/delete-comment.php?id=<?= $comment['id'] ?>" class="btn btn-danger btn-sm mb-3 d-flex align-items-center">
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
    <div class="modal fade" id="addCommentModal" tabindex="-1" aria-labelledby="addCommentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCommentModalLabel">Formulario añadir comentario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="comments/add-comment.php" method="POST">
                        <div class="form-group">
                            <label for="comment">Comentario:</label>
                            <textarea id="comment" name="comment" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="post_id">ID Noticia:</label>
                            <input type="number" id="post_id" name="post_id" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="user_id">ID Usuario:</label>
                            <input type="number" id="user_id" name="user_id" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="id_comment">ID Comentario:</label>
                            <input type="number" id="id_comment" name="id_comment" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Añadir Comentario</button>
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