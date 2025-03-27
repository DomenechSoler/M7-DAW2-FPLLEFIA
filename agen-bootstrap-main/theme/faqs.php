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
        <h1 class="display-1 text-white font-weight-bold font-primary">Contact Us</h1>
      </div>
    </div>
  </div>
</section>
<!-- /page-title -->

<!-- FAQ's -->
<section class="section bg-light">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div id="accordion">
          <!-- accordion item 1 -->
          <div class="card mb-4 rounded-0 border-0">
            <div class="card-header rounded-0 bg-white p-0 border-0">
              <a class="card-link h4 d-flex tex-dark mb-0 py-3 px-4 justify-content-between" data-toggle="collapse" href="#accordion1">
                <span>¿Qué tipos de impresoras 3D utilizáis?</span> <i class="ti-plus text-right"></i>
              </a>
            </div>
            <div id="accordion1" class="collapse" data-parent="#accordion">
              <div class="card-body font-secondary text-color">
                Utilizamos impresoras 3D de alta precisión, tanto para resina como para filamento, lo que nos permite ofrecer resultados detallados y de gran calidad en cada figura.
              </div>
            </div>
          </div>
          <!-- accordion item 2 -->
          <div class="card mb-4 rounded-0 border-0">
            <div class="card-header rounded-0 bg-white p-0 border-0">
              <a class="card-link h4 d-flex tex-dark mb-0 py-3 px-4 justify-content-between" data-toggle="collapse" href="#accordion2">
                <span>¿Qué materiales están disponibles para las figuras?</span> <i class="ti-plus text-right"></i>
              </a>
            </div>
            <div id="accordion2" class="collapse" data-parent="#accordion">
              <div class="card-body font-secondary text-color">
                Ofrecemos figuras impresas en resina y en filamento. Cada material aporta características distintas: la resina ofrece mayor detalle y un acabado superior, mientras que el filamento resulta ideal para modelos más robustos y económicos.
              </div>
            </div>
          </div>
          <!-- accordion item 3 -->
          <div class="card mb-4 rounded-0 border-0">
            <div class="card-header rounded-0 bg-white p-0 border-0">
              <a class="card-link h4 d-flex tex-dark mb-0 py-3 px-4 justify-content-between" data-toggle="collapse" href="#accordion3">
                <span>¿Cuánto tarda el proceso de impresión?</span> <i class="ti-plus text-right"></i>
              </a>
            </div>
            <div id="accordion3" class="collapse" data-parent="#accordion">
              <div class="card-body font-secondary text-color">
                El tiempo de impresión varía según el tamaño y la complejidad del diseño, pero generalmente las piezas se completan entre 3 y 7 días hábiles.
              </div>
            </div>
          </div>
          <!-- accordion item 4 -->
          <div class="card mb-4 rounded-0 border-0">
            <div class="card-header rounded-0 bg-white p-0 border-0">
              <a class="card-link h4 d-flex tex-dark mb-0 py-3 px-4 justify-content-between" data-toggle="collapse" href="#accordion4">
                <span>¿Puedo solicitar un diseño personalizado?</span> <i class="ti-plus text-right"></i>
              </a>
            </div>
            <div id="accordion4" class="collapse" data-parent="#accordion">
              <div class="card-body font-secondary text-color">
                Sí, ofrecemos servicios de diseño personalizado. El precio base depende de la complejidad y los detalles requeridos, y puede aumentar en función de las especificaciones y acabados solicitados.
              </div>
            </div>
          </div>
          <!-- accordion item 5 -->
          <div class="card mb-4 rounded-0 border-0">
            <div class="card-header rounded-0 bg-white p-0 border-0">
              <a class="card-link h4 d-flex tex-dark mb-0 py-3 px-4 justify-content-between" data-toggle="collapse" href="#accordion5">
                <span>¿Cómo garantizáis la calidad de las figuras?</span> <i class="ti-plus text-right"></i>
              </a>
            </div>
            <div id="accordion5" class="collapse" data-parent="#accordion">
              <div class="card-body font-secondary text-color">
                Cada pieza es sometida a un estricto control de calidad. Además, contamos con opciones de post-procesado, como pintura y acabado adicional, para asegurar un resultado impecable en cada figura.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /FAQ's -->

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