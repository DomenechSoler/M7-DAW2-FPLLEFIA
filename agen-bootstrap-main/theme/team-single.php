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
        <h1 class="display-1 text-white font-weight-bold font-primary">Our Team</h1>
      </div>
    </div>
  </div>
</section>
<!-- /page-title -->

<!-- team single -->
<section>
  <div class="container">
    <div class="row mb-100">
      <div class="col-lg-4 col-md-6">
        <div class="bg-secondary p-4 text-center">
          <div class="img-thumb-circle mx-auto mb-3">
            <img src="images/team/member-3.jpg" alt="team-member" class="img-fluid">
          </div>
          <h2 class="text-white">Alita Wilson</h2>
          <p class="text-gradient-primary h4">Chief Executive Officer</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
            dolore magna aliqua.enim ad minim veniam,</p>
          <a href="#" class="btn btn-primary">Download CV</a>
        </div>
      </div>
      <div class="col-lg-7 offset-lg-1 col-md-6">
        <div class="pt-5">
          <h2>Working Skill</h2>
          <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
            labore et
            dolore magna aliqua. Ut enim ad minim veniam.</p>
          <div class="progress-block">
            <h6 class="text-uppercase">HTML5 Expertise</h6>
            <div class="progress">
              <div class="progress-bar" data-percent="85">
                <span class="skill-number text-dark font-weight-bold"><span class="count">85</span>%</span>
              </div>
            </div>
          </div>
          <div class="progress-block">
            <h6 class="text-uppercase">jQuery Expertise</h6>
            <div class="progress">
              <div class="progress-bar" data-percent="95">
                <span class="skill-number text-dark font-weight-bold"><span class="count">95</span>%</span>
              </div>
            </div>
          </div>
          <div class="progress-block">
            <h6 class="text-uppercase">PHP Expertise</h6>
            <div class="progress">
              <div class="progress-bar" data-percent="79">
                <span class="skill-number text-dark font-weight-bold"><span class="count">79</span>%</span>
              </div>
            </div>
          </div>
          <div class="progress-block">
            <h6 class="text-uppercase">User Interface Expertise</h6>
            <div class="progress">
              <div class="progress-bar" data-percent="90">
                <span class="skill-number text-dark font-weight-bold"><span class="count">90</span>%</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8">
        <div class="row border-bottom mb-4">
          <div class="col-sm-6">
            <h4 class="mb-4">Contact Information</h4>
            <ul class="list-unstyled">
              <li class="mb-3"><i class="ti-mobile mr-3"></i>+88 525 325 22</li>
              <li class="mb-3"><i class="ti-email mr-3"></i>philipwilson@agen.com</li>
              <li class="mb-3"><i class="ti-flag-alt mr-3"></i>2/A Southampton, Sandiago, USA.</li>
            </ul>
          </div>
          <div class="col-sm-6">
            <h4 class="mb-4">Follow Me</h4>
            <ul class="list-inline social-icons">
              <li class="list-inline-item"><a href="#"><i class="ti-facebook"></i></a></li>
              <li class="list-inline-item"><a href="#"><i class="ti-twitter-alt"></i></a></li>
              <li class="list-inline-item"><a href="#"><i class="ti-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
        <h4>Work History & Feedback</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
          dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
          commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
          nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim
          id est laborum. Sed ut perspiciatis.</p>

      </div>
      <div class="col-lg-4">
        <div class="bg-secondary p-4">
          <ul class="list-unstyled">
            <li class="mb-4">
              <p class="text-white mb-1">Projects Done</p>
              <strong class="text-white">32</strong>
            </li>
            <li class="mb-4">
              <p class="text-white mb-1">Success Rate</p>
              <strong class="text-white">92%</strong>
            </li>
            <li class="mb-4">
              <p class="text-white mb-1">Experience Of</p>
              <strong class="text-white">10 years</strong>
            </li>
            <li class="mb-4">
              <p class="text-white mb-1">From</p>
              <strong class="text-white">San Diago. NY</strong>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /team -->

<!-- team -->
<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto text-center">
        <h2>Our Team</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor</p>
        <div class="section-border"></div>
      </div>
    </div>
    <div class="row no-gutters">
      <div class="col-lg-3 col-sm-6">
        <div class="card hover-shadow">
          <img src="images/team/member-1.jpg" alt="team-member" class="card-img-top">
          <div class="card-body text-center position-relative zindex-1">
            <h4><a class="text-dark" href="team-single.php">Sara Adams</a></h4>
            <i>Designer</i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card hover-shadow">
          <img src="images/team/member-2.jpg" alt="team-member" class="card-img-top">
          <div class="card-body text-center position-relative zindex-1">
            <h4><a class="text-dark" href="team-single.php">Tom Bills</a></h4>
            <i>Developer</i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card hover-shadow">
          <img src="images/team/member-3.jpg" alt="team-member" class="card-img-top">
          <div class="card-body text-center position-relative zindex-1">
            <h4><a class="text-dark" href="team-single.php">Anna Walle</a></h4>
            <i>Manager</i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card hover-shadow">
          <img src="images/team/member-4.jpg" alt="team-member" class="card-img-top">
          <div class="card-body text-center">
            <h4>Devid Json</h4>
            <i>CEO</i>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /team -->

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