<?php
session_start();
require_once('../../config.php');

//1. verificar que el rol sea administrador
if (($_SESSION['user_rol']) !== 'admin') {
    exit('No tienes permisos para acceder a esta página');
}

//2. comprobar si se ha proporcionado un ID de noticia
if (!isset($_GET['id'])) {
    exit('ID de noticia no proporcionado');
}

$new_id = $_GET['id'];

//3. obtener los datos de la noticia existente
$stmt = $mysqli->prepare("SELECT title, subtitle, description, thumbnail FROM NEWS WHERE id = ?");
$stmt->bind_param('i', $new_id);
$stmt->execute();
$stmt->bind_result($title, $subtitle, $description, $thumbnail);
$stmt->fetch();
$stmt->close();

//4. comprobar si el formulario ha sido enviado
if (isset($_POST['title'])) {
    //5. recoger los datos del formulario
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $description = $_POST['description'];
    $thumbnail = $_POST['thumbnail'];

    //6. manejar la subida del archivo
    if (isset($_FILES['thumbnail_file']) && $_FILES['thumbnail_file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../uploads/';
        $fileTmpPath = $_FILES['thumbnail_file']['tmp_name'];
        $fileName = $_FILES['thumbnail_file']['name'];
        $fileNameCmps = explode('.', $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileExtension, $allowedExtensions)) {
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $dest_path = $uploadDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $thumbnail = $dest_path;
            } else {
                exit('Error al mover el archivo a la carpeta de destino');
            }
        } else {
            exit('Extensión de archivo no permitida');
        }
    }

    //7. preparar la consulta para actualizar la noticia
    $stmt = $mysqli->prepare(
        "UPDATE NEWS SET title = ?, subtitle = ?, description = ?, thumbnail = ? WHERE id = ?"
    );

    //8. comprobar que la preparación tuvo éxito
    if (!$stmt) {
        exit('Error en la preparación: ' . $mysqli->error);
    }

    //9. bindear los parámetros
    $stmt->bind_param('ssssi', $title, $subtitle, $description, $thumbnail, $new_id);

    //10. ejecutar la consulta
    if ($stmt->execute()) {
        header('Location: ../adminNews.php'); // Redirigir a la página de administración de noticias
        exit;
    } else {
        exit('Error al actualizar la noticia');
    }

    //11. cerrar la conexión
    $stmt->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario editar noticia</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

    <h1 class="mb-4">Formulario editar noticia</h1>
    <form action="" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="title">Título:</label>
            <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($title); ?>" required>
        </div>

        <div class="form-group">
            <label for="subtitle">Subtítulo:</label>
            <input type="text" id="subtitle" name="subtitle" class="form-control" value="<?php echo htmlspecialchars($subtitle); ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Descripción:</label>
            <textarea name="description" id="description" class="form-control" cols="30" rows="10" required><?php echo htmlspecialchars($description); ?></textarea>
        </div>

        <div class="form-group">
            <label for="thumbnail">Imagen (URL):</label>
            <input type="text" id="thumbnail" name="thumbnail" class="form-control" value="<?php echo htmlspecialchars($thumbnail); ?>">
        </div>

        <div class="form-group">
            <label for="thumbnail_file">Subir Imagen:</label>
            <input type="file" id="thumbnail_file" name="thumbnail_file" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>

    <!-- Incluir Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>