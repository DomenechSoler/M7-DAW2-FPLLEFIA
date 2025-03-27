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
        <h1 class="display-1 text-white font-weight-bold font-primary">Nuestros Precios</h1>
      </div>
    </div>
  </div>
</section>
<!-- /page-title -->

<!-- pricing -->
<section class="section pb-0">
  <div class="container">
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