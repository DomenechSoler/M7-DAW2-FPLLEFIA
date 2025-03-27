<?php
session_start();
require_once('../../config.php');

//1. verificar que el rol sea administrador
if (($_SESSION['user_rol']) !== 'admin') {
    exit('No tienes permisos para acceder a esta página');
}

//2. comprobar si se ha proporcionado un ID de proyecto
if (!isset($_GET['id'])) {
    exit('ID de proyecto no proporcionado');
}

$project_id = $_GET['id'];

//3. obtener los datos del proyecto existente
$stmt = $mysqli->prepare("SELECT title, thumbnail, description, category FROM PROJECTS WHERE id = ?");
$stmt->bind_param('i', $project_id);
$stmt->execute();
$stmt->bind_result($title, $thumbnail, $description, $category);
$stmt->fetch();
$stmt->close();

//4. comprobar si el formulario ha sido enviado
if (isset($_POST['title'])) {
    //5. recoger los datos del formulario
    $title = $_POST['title'];
    $description = $_POST['description'];
    $thumbnail = $_POST['thumbnail'];
    $category = $_POST['category'];

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

    //7. preparar la consulta para actualizar el proyecto
    $stmt = $mysqli->prepare(
        "UPDATE PROJECTS SET title = ?, thumbnail = ?, description = ?, category = ? WHERE id = ?"
    );

    //8. comprobar que la preparación tuvo éxito
    if (!$stmt) {
        exit('Error en la preparación: ' . $mysqli->error);
    }

    //9. bindear los parámetros
    $stmt->bind_param('ssssi', $title, $thumbnail, $description, $category, $project_id);

    //10. ejecutar la consulta
    if ($stmt->execute()) {
        header('Location: ../adminProjects.php'); // Redirigir a la página de administración de proyectos
        exit;
    } else {
        exit('Error al actualizar el proyecto');
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
    <title>Formulario editar proyecto</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

    <h1 class="mb-4">Formulario editar proyecto</h1>
    <form action="" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="title">Título:</label>
            <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($title); ?>" required>
        </div>

        <div class="form-group">
            <label for="category">Categoría:</label>
            <input type="text" id="category" name="category" class="form-control" value="<?php echo htmlspecialchars($category); ?>" required>
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