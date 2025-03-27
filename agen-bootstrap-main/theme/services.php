<?php
session_start();
require_once './config.php';
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

</head>

<body>
  

<?php include('header.php'); ?>

<!-- page-title -->
<section class="page-title bg-cover" data-background="images/backgrounds/page-title.jpg">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="display-1 text-white font-weight-bold font-primary">Nuestros servicios</h1>
      </div>
    </div>
  </div>
</section>
<!-- /page-title -->

<!-- service -->
<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-sm-6 mb-4">
        <div class="card hover-bg-secondary shadow py-4">
          <div class="card-body text-center">
            <div class="position-relative">
              <i class="icon-lg icon-box bg-gradient-primary rounded-circle ti-palette mb-5 d-inline-block text-white"></i>
              <i class="icon-lg icon-watermark text-white ti-palette"></i>
            </div>
            <h4 class="mb-4">Diseño Personalizado</h4>
            <p>En [Nombre de la Empresa], cada figura comienza con un diseño único. Ya sea que traigas tus propias ideas o necesites un diseño desde cero, nuestros expertos en modelado 3D trabajarán contigo para crear una figura detallada y acorde a tus expectativas, siempre con un enfoque artesanal y profesional.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 mb-4">
        <div class="card hover-bg-secondary shadow py-4">
          <div class="card-body text-center">
            <div class="position-relative">
            <i class="icon-lg icon-box bg-gradient-primary rounded-circle ti-crown mb-5 d-inline-block text-white"></i>
            <i class="icon-lg icon-watermark text-white ti-crown"></i>
            </div>
            <h4 class="mb-4">Impresión de Alta Calidad</h4>
            <p>Nuestra tecnología de impresión 3D avanzada te garantiza un acabado perfecto en filamento o resina. Desde detalles minuciosos hasta la estructura general de la figura, nuestras impresoras de última generación aseguran que cada pieza sea precisa y duradera, sin importar el tamaño o complejidad del diseño.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 mb-4">
        <div class="card hover-bg-secondary shadow py-4">
          <div class="card-body text-center">
            <div class="position-relative">
              <i class="icon-lg icon-box bg-gradient-primary rounded-circle ti-brush mb-5 d-inline-block text-white"></i>
              <i class="icon-lg icon-watermark text-white ti-brush"></i>
            </div>
            <h4 class="mb-4">Personalización y Acabados a Mano</h4>
            <p>Para quienes buscan una pieza única, ofrecemos servicios de pintura y acabado a mano. Nuestro equipo de artistas trabaja en cada figura para aplicar colores, sombras y detalles finos, asegurando que tu figura no solo sea visualmente impresionante, sino también una pieza exclusiva que refleje tu estilo o temática preferida.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 mb-4">
        <div class="card hover-bg-secondary shadow py-4">
          <div class="card-body text-center">
            <div class="position-relative">
              <i class="icon-lg icon-box bg-gradient-primary rounded-circle ti-pencil mb-5 d-inline-block text-white"></i>
              <i class="icon-lg icon-watermark text-white ti-pencil"></i>
            </div>
            <h4 class="mb-4">Creación de Prototipos</h4>
            <p>¿Tienes una idea para un producto o figura pero necesitas ver cómo se ve en el mundo real? Nuestro servicio de creación de prototipos en 3D te permite materializar tus ideas antes de llevarlas a producción en masa. A través de nuestra tecnología de impresión, puedes obtener un modelo físico detallado que te ayudará a visualizar y perfeccionar tu concepto.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 mb-4">
        <div class="card hover-bg-secondary shadow py-4">
          <div class="card-body text-center">
            <div class="position-relative">
            <!-- Icono de Regalo -->
            <i class="icon-lg icon-box bg-gradient-primary rounded-circle ti-gift mb-5 d-inline-block text-white"></i>
            <i class="icon-lg icon-watermark text-white ti-gift"></i>
            </div>
            <h4 class="mb-4">Figuras para Eventos y Regalos</h4>
            <p>Haz que tus eventos y regalos sean inolvidables con nuestras figuras personalizadas. Ya sea para bodas, cumpleaños, aniversarios o cualquier ocasión especial, diseñamos y fabricamos figuras únicas que capturan momentos, personajes o temáticas que harán que tu regalo o evento se destaque. ¡Con nosotros, cada detalle cuenta!</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 mb-4">
        <div class="card hover-bg-secondary shadow py-4">
          <div class="card-body text-center">
            <div class="position-relative">
              <i class="icon-lg icon-box bg-gradient-primary rounded-circle ti-tag mb-5 d-inline-block text-white"></i>
              <i class="icon-lg icon-watermark text-white ti-tag"></i>
            </div>
            <h4 class="mb-4">Coleccionables y Ediciones Limitadas</h4>
            <p>Si eres un coleccionista, ofrecemos figuras de edición limitada diseñadas para que tu colección sea aún más especial. Trabajamos en colaboración contigo para crear figuras que sean tanto una pieza de arte como un objeto de colección, asegurándonos de que cada detalle sea único y de alta calidad.

</p>
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