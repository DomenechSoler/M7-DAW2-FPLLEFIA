<?php
session_start();
require_once './config.php';

$new_id = $_GET['id'];
$type = $_GET['type'];

// Obtener información del proyecto o noticia según el tipo
if ($type === 'project') {
  $stmt = $mysqli->prepare("SELECT * FROM PROJECTS WHERE id = ?");
} else {
  $stmt = $mysqli->prepare("SELECT * FROM NEWS WHERE id = ?");
}

if (!$stmt) {
  die("Error en la preparación de la consulta SQL: " . $mysqli->error);
}
$stmt->bind_param("i", $new_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($type === 'project') {
  $stmtComentarios = $mysqli->prepare("SELECT COMMENTS.*, USERS.name FROM COMMENTS INNER JOIN USERS ON COMMENTS.id_user = USERS.id WHERE id_project = ? AND id_comment IS NULL");
} else {
  $stmtComentarios = $mysqli->prepare("SELECT COMMENTS.*, USERS.name FROM COMMENTS INNER JOIN USERS ON COMMENTS.id_user = USERS.id WHERE id_new = ? AND id_comment IS NULL");
}

if (!$stmtComentarios) {
  die("Error en la preparación de la consulta SQL: " . $mysqli->error);
}
$stmtComentarios->bind_param("i", $new_id);
$stmtComentarios->execute();
$resultsComentarios = $stmtComentarios->get_result();
if (!$resultsComentarios) {
  die("Error en la consulta SQL: " . $mysqli->error);
}

$comentarios = $resultsComentarios->fetch_all(MYSQLI_ASSOC);

function obtenerRespuestas($id_comentario, $mysqli) {
  $stmtRespuestas = $mysqli->prepare("SELECT COMMENTS.*, USERS.name FROM COMMENTS INNER JOIN USERS ON COMMENTS.id_user = USERS.id WHERE id_comment = ?");
  if (!$stmtRespuestas) {
    die("Error en la preparación de la consulta SQL para respuestas: " . $mysqli->error);
  }
  $stmtRespuestas->bind_param("i", $id_comentario);
  $stmtRespuestas->execute();
  $resultsRespuestas = $stmtRespuestas->get_result();
  $respuestas = [];
  if ($resultsRespuestas) {
    while ($respuesta = $resultsRespuestas->fetch_assoc()) {
      $respuesta['respuestas'] = obtenerRespuestas($respuesta['id'], $mysqli);
      $respuestas[] = $respuesta;
    }
  }
  return $respuestas;
}

foreach ($comentarios as &$comentario) {
  $comentario['respuestas'] = obtenerRespuestas($comentario['id'], $mysqli);
}

$resultsNews3 = $mysqli->query("SELECT * FROM NEWS ORDER BY id DESC LIMIT 3");

$image = "theme/uploads/" . $data['thumbnail'];
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>Agen | Bootstrap Agency Template</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="plugins/slick/slick.css">
  <link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="plugins/venobox/venobox.css">
  <link rel="stylesheet" href="plugins/card-slider/css/style.css">
  <link href="css/style.css" rel="stylesheet">
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="images/favicon.ico" type="image/x-icon">
</head>

<body>
  <?php include('header.php'); ?>

  <section class="page-title bg-cover" data-background="images/backgrounds/page-title.jpg">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center">
          <h1 class="display-1 text-white font-weight-bold font-primary">Detalles del Proyecto</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 mx-auto">
          <h3 class="font-tertiary mb-5 text-center"><?php echo $data['title']; ?></h3>
          <img src="<?php echo $image; ?>" alt="post-thumb" class="img-fluid w-100 mb-3 rounded">
          <p class="text-muted"><?php echo $data['project_date'] ?? $data['new_date'] ?? ''; ?></p>
          <div class="content">
            <h5 class="font-weight-bold text-secondary"><?php echo $data['subtitle'] ?? ''; ?></h5>
            <p class="lead"><?php echo $data['description']; ?></p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <br>
  <br>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-lg-10 mx-auto">
          <div class="p-5 mb-4 bg-light rounded">
            <?php foreach ($comentarios as $comentario): ?>
              <div class="media border-bottom py-4">
                <div class="media-body">
                  <h5 class="mb-0 text-secondary"><?php echo $comentario['name']; ?></h5>
                  <span class="mr-3 text-muted"><?php echo $comentario['date']; ?></span>
                  <a href="#" class="btn btn-transparent py-1 px-2 reply-btn" data-id="<?php echo $comentario['id']; ?>" data-name="<?php echo $comentario['name']; ?>" data-description="<?php echo $comentario['description']; ?>"><i class="ti-share-alt"></i> Responder</a>
                  <p><?php echo $comentario['description']; ?></p>

                  <?php if (!empty($comentario['respuestas'])): ?>
                    <div class="ml-4">
                      <?php foreach ($comentario['respuestas'] as $respuesta): ?>
                        <div class="media border-bottom py-4">
                          <div class="media-body">
                            <h5 class="mb-0 text-secondary"><?php echo $respuesta['name']; ?></h5>
                            <span class="mr-3 text-muted"><?php echo $respuesta['date']; ?></span>
                            <a href="#" class="btn btn-transparent py-1 px-2 reply-btn" data-id="<?php echo $respuesta['id']; ?>" data-name="<?php echo $respuesta['name']; ?>" data-description="<?php echo $respuesta['description']; ?>"><i class="ti-share-alt"></i> Responder</a>
                            <p><?php echo $respuesta['description']; ?></p>

                            <?php if (!empty($respuesta['respuestas'])): ?>
                              <div class="ml-4">
                                <?php foreach ($respuesta['respuestas'] as $subrespuesta): ?>
                                  <div class="media border-bottom py-4">
                                    <div class="media-body">
                                      <h5 class="mb-0 text-secondary"><?php echo $subrespuesta['name']; ?></h5>
                                      <span class="mr-3 text-muted"><?php echo $subrespuesta['date']; ?></span>
                                      <a href="#" class="btn btn-transparent py-1 px-2 reply-btn" data-id="<?php echo $subrespuesta['id']; ?>" data-name="<?php echo $subrespuesta['name']; ?>" data-description="<?php echo $subrespuesta['description']; ?>"><i class="ti-share-alt"></i> Responder</a>
                                      <p><?php echo $subrespuesta['description']; ?></p>
                                    </div>
                                  </div>
                                <?php endforeach; ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <h4 class="mb-3 pb-3 text-secondary">Deja un comentario</h4>
          <form action="submit-comment.php" method="post" class="row">
            <div class="col-12">
              <textarea name="comment" id="comment" placeholder="Mensaje" class="form-control mb-4 border" required></textarea>
            </div>
            <div class="col-md-10">
              <input type="hidden" name="post_id" value="<?php echo $new_id; ?>">
              <input type="hidden" name="id_comment" id="id_comment" value="">
              <input type="hidden" name="type" value="<?php echo $type; ?>">
              <div id="replying-to" class="alert alert-info d-none">
                Respondiendo a: <strong id="replying-to-name"></strong>
                <p id="replying-to-description"></p>
                <button type="button" class="close" aria-label="Close" onclick="clearReply()">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-secondary rounded-0">Enviar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="row">
        <?php foreach ($resultsNews3 as $noticia3): ?>
          <div class="col-lg-4 col-md-6 mb-4">
            <article class="card">
              <img src="theme/uploads/<?php echo $noticia3['thumbnail']; ?>" alt="post-thumb" class="card-img-top mb-2 rounded">
              <div class="card-body p-0">
                <time class="text-muted"><?php echo $noticia3['new_date'] ?? ''; ?></time>
                <a href="blog-single.php?id=<?= $noticia3['id'] ?>&type=news" class="h4 card-title d-block my-3 text-dark hover-text-underline"><?php echo $noticia3['title']; ?></a>
                <p class="card-text"><?php echo $noticia3['subtitle'] ?? ''; ?></p>
                <a href="blog-single.php?id=<?= $noticia3['id'] ?>&type=news" class="btn btn-transparent">Leer más</a>
              </div>
            </article>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php include('footer.php'); ?>

  <!-- jQuery -->
  <script src="plugins/jQuery/jquery.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="plugins/bootstrap/bootstrap.min.js"></script>
  <!-- slick slider -->
  <script src="plugins/slick/slick.min.js"></script>
  <!-- venobox -->
  <script src="plugins/venobox/venobox.min.js"></script>
  <!-- shuffle -->
  <script src="plugins/shuffle/shuffle.min.js"></script>
  <!-- apear js -->
  <script src="plugins/counto/apear.js"></script>
  <!-- counter -->
  <script src="plugins/counto/counTo.js"></script>
  <!-- card slider -->
  <script src="plugins/card-slider/js/card-slider-min.js"></script>
  <!-- google map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places"></script>
  <script src="plugins/google-map/gmap.js"></script>

  <!-- Main Script -->
  <script src="js/script.js"></script>

  <script>
    document.querySelectorAll('.reply-btn').forEach(button => {
      button.addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('id_comment').value = this.getAttribute('data-id');
        document.getElementById('replying-to-name').innerText = this.getAttribute('data-name');
        document.getElementById('replying-to-description').innerText = this.getAttribute('data-description');
        document.getElementById('replying-to').classList.remove('d-none');
        document.getElementById('comment').focus();
      });
    });

    function clearReply() {
      document.getElementById('id_comment').value = '';
      document.getElementById('replying-to').classList.add('d-none');
    }
  </script>

</body>

</html>