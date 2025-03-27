<?php
session_start();
require_once './config.php';

$results = $mysqli->query("SELECT * FROM USERS");

$clientes = $results->fetch_all(MYSQLI_ASSOC);

$resultsProjects = $mysqli->query("SELECT * FROM PROJECTS ORDER BY id DESC LIMIT 5");

$proyectos = $resultsProjects->fetch_all(MYSQLI_ASSOC);

$resultsNews = $mysqli->query("SELECT * FROM NEWS");

$news = $resultsNews->fetch_all(MYSQLI_ASSOC);

$resultsNews3 = $mysqli->query("SELECT * FROM NEWS ORDER BY id DESC LIMIT 3");

$news3 = $resultsNews3->fetch_all(MYSQLI_ASSOC);

$resultsTestimonials = $mysqli->query("SELECT * FROM TESTIMONIALS");

$testimonials = $resultsTestimonials->fetch_all(MYSQLI_ASSOC);

function getImage($id, $mysqli)
{
  $result = $mysqli->query("SELECT thumbnail FROM NEWS WHERE id = $id");
  if ($result->num_rows > 0) {
    $news = $result->fetch_assoc();
    return $news['thumbnail'];
  }
  return null;
}
?>








<!DOCTYPE html>


<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>Agen | Bootstrap Agency Template</title>

  <!-- mobile responsive meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- theme meta -->
  <meta name="theme-name" content="agen" />

  <!-- ** Plugins Needed for the Project ** -->
  <!-- Bootstrap -->
  <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
  <!-- slick slider -->
  <link rel="stylesheet" href="plugins/slick/slick.css">
  <!-- themefy-icon -->
  <link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">
  <!-- venobox css -->
  <link rel="stylesheet" href="plugins/venobox/venobox.css">
  <!-- card slider -->
  <link rel="stylesheet" href="plugins/card-slider/css/style.css">

  <!-- Main Stylesheet -->
  <link href="css/style.css" rel="stylesheet">

  <!--Favicon-->
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="images/favicon.ico" type="image/x-icon">

  <style>
    /* Ajuste de las imágenes dentro de los proyectos */
    .project-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      /* Mantiene proporción y recorta si es necesario */
    }

    /* Configuración de las imágenes en las columnas laterales */
    .project-item-half {
      height: 50vh;
      /* Cada imagen ocupa la mitad de la pantalla */
    }

    /* Imagen central más grande */
    .project-item-full {
      height: 100vh;
      /* Ocupa toda la pantalla */
    }
  </style>

</head>

<body>

  <?php include('header.php'); ?>


  <!-- 
<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto text-center">
        <h2 class="section-title">Noticias</h2>
        <div class="row">
          <?php foreach ($news as $noticia): ?>
            <div class="col-lg-4 mb-4">
              <div class="card">
                <img src="<?php echo $noticia['thumbnail']; ?>" class="card-img-top" alt="imagen de noticia">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $noticia['title']; ?></h5>
                  <p class="card-text"><?php echo $noticia['subtitle']; ?></p>
                  <p class="card-text"><?php echo $noticia['description']; ?></p>
                  <p class="card-text"><?php echo $noticia['new_date']; ?></p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto text-center">
        <h2 class="section-title">Testimonios</h2>
        <div class="row">
          <?php foreach ($testimonials as $testimonial): ?>
            <div class="col-lg-4 mb-4">
              <div class="card">
                <img src="<?php echo $testimonial['thumbnail']; ?>" class="card-img-top" alt="imagen de testimonio">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $testimonial['name'] . ' ' . $testimonial['surname']; ?></h5>
                  <p class="card-text"><?php echo $testimonial['description']; ?></p>
                  <p class="card-text"><?php echo $testimonial['date']; ?></p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>


hero area -->




  <!-- banner -->
  <section class="banner bg-cover position-relative d-flex justify-content-center align-items-center"
    data-background="images/banner/banner2.jpg">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center">
          <h1 class="display-1 text-white font-weight-bold font-primary">Kilizan 3D</h1>
        </div>
      </div>
    </div>
  </section>
  <!-- /banner -->

  <!-- service -->
  <section class="section">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 mx-auto text-center">
          <h2 class="section-title">Nuestros servicios</h2>
          <p class="lead">En Kilizan 3D nos especializamos en crear figuras personalizadas de alta calidad, impresas en 3D utilizando filamento o resina. Ya sea que busques una figura única para un regalo, un elemento decorativo o una pieza de colección, tenemos todo lo que necesitas.</p>
          <div class="section-border"></div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 mb-4 mb-lg-0">
          <div class="card hover-bg-secondary shadow py-4">
            <div class="card-body text-center">
              <div class="position-relative">
                <i class="icon-lg icon-box bg-gradient-primary rounded-circle ti-palette mb-5 d-inline-block text-white"></i>
                <i class="icon-lg icon-watermark text-white ti-palette"></i>
              </div>
              <h4 class="mb-4">Diseño Personalizado</h4>
              <p>En Kilizan 3D, cada figura comienza con un diseño único. Ya sea que traigas tus propias ideas o necesites un diseño desde cero, nuestros expertos en modelado 3D trabajarán contigo para crear una figura detallada y acorde a tus expectativas, siempre con un enfoque artesanal y profesional.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-4 mb-lg-0">
          <div class="card hover-bg-secondary shadow py-4">
            <div class="card-body text-center">
              <div class="position-relative">
                <i class="icon-lg icon-box bg-gradient-primary rounded-circle ti-dashboard mb-5 d-inline-block text-white"></i>
                <i class="icon-lg icon-watermark text-white ti-dashboard"></i>
              </div>
              <h4 class="mb-4">Impresión de Alta Calidad</h4>
              <p>Nuestra tecnología de impresión 3D avanzada te garantiza un acabado perfecto en filamento o resina. Desde detalles minuciosos hasta la estructura general de la figura, nuestras impresoras de última generación aseguran que cada pieza sea precisa y duradera, sin importar el tamaño o complejidad del diseño.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-4 mb-lg-0">
          <div class="card hover-bg-secondary shadow py-4">
            <div class="card-body text-center">
              <div class="position-relative">
                <i class="icon-lg icon-box bg-gradient-primary rounded-circle ti-announcement mb-5 d-inline-block text-white"></i>
                <i class="icon-lg icon-watermark text-white ti-announcement"></i>
              </div>
              <h4 class="mb-4">Personalización y Acabados a Mano</h4>
              <p>Para quienes buscan una pieza única, ofrecemos servicios de pintura y acabado a mano. Nuestro equipo de artistas trabaja en cada figura para aplicar colores, sombras y detalles finos, asegurando que tu figura no solo sea visualmente impresionante, sino también una pieza exclusiva que refleje tu estilo o temática preferida.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /service -->

  <!-- feature -->
  <section class="section bg-secondary position-relative">
    <div class="bg-image overlay-secondary">
      <img src="images/feature.jpg" alt="bg-image">
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <div class="row align-items-center">
            <div class="col-lg-4 mb-4 mb-lg-0">
              <img src="images/feature.jpg" alt="feature-image" class="img-fluid">
            </div>
            <div class="col-lg-7 offset-lg-1">
              <div class="row">
                <div class="col-12">
                  <h3 class="text-white">Sabemos cómo dar forma a tus ideas</h3>
                  <div class="section-border ml-0"></div>
                </div>
                <div class="col-md-6 mb-4">
                  <div class="media">
                    <i class="icon text-gradient-primary ti-headphone-alt mr-3"></i>
                    <div class="media-body">
                      <h4 class="text-white">Experiencia personalizada</h4>
                      <p class="text-light">En Kilizan 3D entendemos la importancia de cada detalle. Nos especializamos en crear figuras personalizadas que se ajustan perfectamente a tus ideas y necesidades. Ya sea para un regalo, decoración o colección, nuestra experiencia nos permite ofrecerte una pieza única, adaptada a lo que deseas.</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <div class="media">
                    <i class="icon text-gradient-primary ti-ruler-pencil mr-3"></i>
                    <div class="media-body">
                      <h4 class="text-white">Diseños a Medida</h4>
                      <p class="text-light">Tu visión es nuestra prioridad. Desde la creación de modelos 3D hasta la pintura a mano, trabajamos contigo para dar vida a tus proyectos. Cada figura es diseñada de forma precisa y detallada, asegurando que obtengas el resultado que esperas.</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <div class="media">
                    <i class="icon text-gradient-primary ti-layout mr-3"></i>
                    <div class="media-body">
                      <h4 class="text-white">Soluciones en Impresión 3D</h4>
                      <p class="text-light">Ya sea que necesites figuras en filamento o resina, ofrecemos soluciones flexibles para todos los gustos. Nuestros materiales de alta calidad garantizan que cada figura tenga una gran durabilidad y un acabado impecable, ya sea en tamaños pequeños o grandes.</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <div class="media">
                    <i class="icon text-gradient-primary ti-vector mr-3"></i>
                    <div class="media-body">
                      <h4 class="text-white">Tecnología Avanzada</h4>
                      <p class="text-light">Trabajamos con la última tecnología en impresión 3D para ofrecerte un producto preciso y de alta calidad. Gracias a nuestras impresoras avanzadas, podemos crear figuras detalladas, prototipos, y diseños personalizados en tiempo récord.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /feature -->

  <!-- team -->
  <section class="section">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 mx-auto text-center">
          <h2>Nuestras herramientas</h2>
          <p>Utilizamos tecnología de vanguardia para dar vida a cada detalle, asegurando precisión, resistencia y un acabado de alta calidad en cada figura.</p>
          <div class="section-border"></div>
        </div>
      </div>
      <div class="row no-gutters">
        <div class="col-lg-3 col-sm-6">
          <div class="card hover-shadow">
            <img src="images/team/member-1.jpg" alt="team-member" class="card-img-top">
            <div class="card-body text-center position-relative zindex-1">
              <h4><a class="text-dark" href="team-single.php">Elegoo</a></h4>
              <i>Impresora resina</i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card hover-shadow">
            <img src="images/team/feature.jpg" alt="team-member" class="card-img-top">
            <div class="card-body text-center position-relative zindex-1">
              <h4><a class="text-dark" href="team-single.php">Elegoo mercury +</a></h4>
              <i>Máquina curado</i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card hover-shadow">
            <img src="images/team/member-3.jpg" alt="team-member" class="card-img-top">
            <div class="card-body text-center position-relative zindex-1">
              <h4><a class="text-dark" href="team-single.php">Hephestos 2</a></h4>
              <i>Impresora filamento</i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card hover-shadow">
            <img src="images/team/member-4.jpg" alt="team-member" class="card-img-top">
            <div class="card-body text-center">
              <h4>Devid Json</h4>
              <i>Aerografo</i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /team -->

  <!-- project -->
  <section class="section">
    <div class="container-fluid px-0">
      <div class="row">
        <div class="col-lg-10 mx-auto text-center">
          <h2>Últimos proyectos</h2>
          <div class="section-border"></div>
        </div>
      </div>

      <div class="row no-gutters shuffle-wrapper">
        <?php if (count($proyectos) > 0): ?>
          <div class="col-lg-4 col-md-6 shuffle-item d-flex flex-column">
            <?php if (isset($proyectos[1])): ?>
              <div class="project-item project-item-half">
                <a href="blog-single.php?id=<?= $proyectos[1]['id'] ?>&type=project">
                  <img src="theme/uploads/<?= $proyectos[1]['thumbnail'] ?>" alt="project-image">
                  <div class="project-hover bg-secondary px-4 py-3">
                    <a href="blog-single.php?id=<?= $proyectos[1]['id'] ?>&type=project" class="text-white h4"><?= $proyectos[1]['title'] ?></a>
                    <a href="blog-single.php?id=<?= $proyectos[1]['id'] ?>&type=project"><i class="ti-link icon-xs text-white"></i></a>
                  </div>
                </a>
              </div>
            <?php endif; ?>
            <?php if (isset($proyectos[2])): ?>
              <div class="project-item project-item-half">
                <a href="blog-single.php?id=<?= $proyectos[2]['id'] ?>&type=project">
                  <img src="theme/uploads/<?= $proyectos[2]['thumbnail'] ?>" alt="project-image">
                  <div class="project-hover bg-secondary px-4 py-3">
                    <a href="blog-single.php?id=<?= $proyectos[2]['id'] ?>&type=project" class="text-white h4"><?= $proyectos[2]['title'] ?></a>
                    <a href="blog-single.php?id=<?= $proyectos[2]['id'] ?>&type=project"><i class="ti-link icon-xs text-white"></i></a>
                  </div>
                </a>
              </div>
            <?php endif; ?>
          </div>
          <div class="col-lg-4 col-md-6 shuffle-item">
            <div class="project-item project-item-full">
              <a href="blog-single.php?id=<?= $proyectos[0]['id'] ?>&type=project">
                <img src="theme/uploads/<?= $proyectos[0]['thumbnail'] ?>" alt="project-image">
                <div class="project-hover bg-secondary px-4 py-3">
                  <a href="blog-single.php?id=<?= $proyectos[0]['id'] ?>&type=project" class="text-white h4"><?= $proyectos[0]['title'] ?></a>
                  <a href="blog-single.php?id=<?= $proyectos[0]['id'] ?>&type=project"><i class="ti-link icon-xs text-white"></i></a>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 shuffle-item d-flex flex-column">
            <?php if (isset($proyectos[3])): ?>
              <div class="project-item project-item-half">
                <a href="blog-single.php?id=<?= $proyectos[3]['id'] ?>&type=project">
                  <img src="theme/uploads/<?= $proyectos[3]['thumbnail'] ?>" alt="project-image">
                  <div class="project-hover bg-secondary px-4 py-3">
                    <a href="blog-single.php?id=<?= $proyectos[3]['id'] ?>&type=project" class="text-white h4"><?= $proyectos[3]['title'] ?></a>
                    <a href="blog-single.php?id=<?= $proyectos[3]['id'] ?>&type=project"><i class="ti-link icon-xs text-white"></i></a>
                  </div>
                </a>
              </div>
            <?php endif; ?>
            <?php if (isset($proyectos[4])): ?>
              <div class="project-item project-item-half">
                <a href="blog-single.php?id=<?= $proyectos[4]['id'] ?>&type=project">
                  <img src="theme/uploads/<?= $proyectos[4]['thumbnail'] ?>" alt="project-image">
                  <div class="project-hover bg-secondary px-4 py-3">
                    <a href="blog-single.php?id=<?= $proyectos[4]['id'] ?>&type=project" class="text-white h4"><?= $proyectos[4]['title'] ?></a>
                    <a href="blog-single.php?id=<?= $proyectos[4]['id'] ?>&type=project"><i class="ti-link icon-xs text-white"></i></a>
                  </div>
                </a>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <!-- /project -->

  <!-- Llamado a la acción -->
  <section class="section">
    <div class="container section-sm overlay-secondary-half bg-cover" data-background="images/backgrounds/Impresora-Resina.jpg" style="background-position: left;">
      <div class="row">
        <div class="col-lg-8 offset-lg-1">
          <h2 class="text-gradient-primary">¡Empieza con nosotros!</h2>
          <p class="h4 font-weight-bold text-white mb-4">Dale vida a tus ideas con nuestra tecnología y experiencia.</p>
          <a href="contact.php" class="btn btn-lg btn-primary">Contáctanos</a>
        </div>
      </div>
    </div>
  </section>
  <!-- /Llamado a la acción -->

  <!-- pricing -->
  <section class="section pb-0">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 mx-auto text-center">
          <h2>Nuestros Precios</h2>
          <div class="section-border"></div>
        </div>
      </div>
      <div class="row d-flex align-items-stretch">
        <!-- Figura Pequeña -->
        <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0 d-flex">
          <div class="card bottom-shape bg-secondary pt-4 pb-5 flex-fill">
            <div class="card-body text-center">
              <h4 class="text-white">Figura Pequeña</h4>
              <p class="text-light mb-4">Impresión en resina</p>
              <p class="text-white mb-4"><span class="display-3 font-weight-bold vertical-align-middle">40€</span></p>
              <ul class="list-unstyled mb-5">
                <li class="text-white mb-3">Impresion en filamento: 30€</li>
                <li class="text-white mb-3">Acabado estándar</li>
                <li class="text-white mb-3">Plus para pintar figura (opcional)</li>
                <li class="text-white mb-3">Precio sujeto a variación según detalle</li>
              </ul>
              <a href="contact.php" class="btn btn-outline-light">¡Pide la tuya!</a>
            </div>
          </div>
        </div>
        <!-- Figura Grande -->
        <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0 d-flex">
          <div class="card bottom-shape bg-secondary pt-4 pb-5 flex-fill">
            <div class="card-body text-center">
              <h4 class="text-white">Figura Grande</h4>
              <p class="text-light mb-4">Impresión en resina</p>
              <p class="text-white mb-4"><span class="display-3 font-weight-bold vertical-align-middle">80€</span></p>
              <ul class="list-unstyled mb-5">
                <li class="text-white mb-3">Impresion en filamento: 60€</li>
                <li class="text-white mb-3">Mayor tamaño y nivel de detalle</li>
                <li class="text-white mb-3">Opción de acabado premium</li>
                <li class="text-white mb-3">Plus para pintura opcional</li>
                <li class="text-white mb-3">Precio variable según diseño</li>
              </ul>
              <a href="contact.php" class="btn btn-outline-light">¡Pide la tuya!</a>
            </div>
          </div>
        </div>
        <!-- Diseño Personalizado -->
        <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0 d-flex">
          <div class="card bottom-shape bg-secondary pt-4 pb-5 flex-fill">
            <div class="card-body text-center">
              <h4 class="text-white">Diseño Personalizado</h4>
              <p class="text-light mb-4">A partir de un precio mínimo</p>
              <p class="text-white mb-4"><span class="display-3 font-weight-bold vertical-align-middle">50€</span></p>
              <ul class="list-unstyled mb-5">
                <li class="text-white mb-3">Adaptado a tus necesidades</li>
                <li class="text-white mb-3">Precio sujeto a complejidad del diseño</li>
                <li class="text-white mb-3">Plus para pintar figura (opcional)</li>
                <li class="text-white mb-3">El costo puede incrementarse según el nivel de personalización</li>
              </ul>
              <a href="contact.php" class="btn btn-outline-light">¡Cotiza ahora!</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /pricing -->


  <!-- blog -->
  <section class="section">
    <div class="container">
      <div class="row">
        <?php foreach ($news3 as $noticia3): ?>
          <div class="col-lg-4 col-md-6 mb-4">
            <a href="blog-single.php?id=<?= $noticia3['id'] ?>&type=news" class="card-link">
              <article class="card">
                <?php $image = getImage($noticia3['id'], $mysqli) ?: $noticia3['thumbnail']; ?>
                <img src="theme/uploads/<?php echo $image; ?>" alt="post-thumb" class="card-img-top mb-2">
                <div class="card-body p-0">
                  <time><?php echo $noticia3['new_date']; ?></time>
                  <h4 class="card-title d-block my-3 text-dark hover-text-underline"><?php echo $noticia3['title']; ?></h4>
                  <p class="card-text"><?php echo $noticia3['subtitle']; ?></p>
                  <a href="blog-single.php?id=<?= $noticia3['id'] ?>&type=news" class="btn btn-transparent">Leer más</a>
                </div>
              </article>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <!-- /blog -->

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

</body>

</html>