<?php
include_once '../../config/setting.php';
include_once "../../config/Database.php";
include_once "../../models/Cart.php";
$database = new Database();
$db = $database->getConnection();
$cartDb = new Cart($db);
session_start();
if(isset($_SESSION['user_id'])){
    $userID =  $_SESSION['user_id'] ;
    $cartCount = $cartDb->getCartCount($userID);
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

      <title>متجر التميز - اتصل بنا </title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!--

TemplateMo 546 Sixteen Clothing

https://templatemo.com/tm-546-sixteen-clothing

-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="assets/css/owl.css">

  </head>

  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php"><h2>متجر <em>التميز</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav ml-auto">
                  <?php
                  if(!isset($_SESSION["admin"]) & !isset($_SESSION["user"])){
                      echo ' <li class="nav-item">
                        <a class="nav-link" href="../cms/login.php">تسجيل الدخول </a>
                    </li>';
                  }else{  echo ' <li class="nav-item">
                        <a class="nav-link" href="../logout.php">تسجيل الخروج </a>
                    </li>';
                      echo ' <li class="nav-item">
                        <a class="nav-link" href="basket.php">السلة 
                         ('.$cartCount .')</a>
                    </li>';

                  }
                  ?>
                  <li class="nav-item">
                      <a class="nav-link " href="about.php">من نحن </a>
                  </li>
                  <li class="nav-item active">
                      <a class="nav-link" href="contact.php">اتصل بنا</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="products.php">منتجاتنا</a>
                  </li>
                  <li class="nav-item ">
                      <a class="nav-link" href="index.php">الرئيسية
                          <span class="sr-only">(current)</span>
                      </a>
                  </li>
              </ul>
          </div>
        </div>
      </nav>
    </header>

    <!-- Page Content -->
    <div class="page-heading contact-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>اتصل بنا</h4>
              <h2>لا تتردد بالاتصال بنا</h2>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="find-us">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>موقعنا على الخريطة</h2>
            </div>
          </div>
          <div class="col-md-8">
<!-- How to change your own map point
	1. Go to Google Maps
	2. Click on your location point
	3. Click "Share" and choose "Embed map" tab
	4. Copy only URL and paste it within the src="" field below
-->
            <div id="map">
              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2296.181363422662!2d35.80756211600726!3d35.521810161913656!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1526ac18a2d4d5cd%3A0x3dc7dc57373f03b4!2sTishreen%20University!5e0!3m2!1sen!2sus!4v1624954391106!5m2!1sen!2sus&output=embed" width="100%" height="330px" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
          </div>
          <div class="col-md-4">
            <div class="left-content">
              <h4>مكتبنا في اللاذقية</h4>
              <p>متواجدين من الساعة الثامنة سباحا الى الساعة الثامنة مساءا<br><br>لا تتردد في زيارة مكتبنا للمساعدة</p>
              <ul class="social-icons">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                <li><a href="#"><i class="fa fa-behance"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <div class="send-message">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>أرسل رسالتك</h2>
            </div>
          </div>
          <div class="col-md-12">
            <div class="contact-form">
              <form id="contact" action="" method="post">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                      <input name="name" type="text" class="form-control" id="name" placeholder="الاسم الكامل" required="">
                    </fieldset>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                      <input name="email" type="text" class="form-control" id="email" placeholder="البريد الاكلتروني" required="">
                    </fieldset>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                      <input name="subject" type="text" class="form-control" id="subject" placeholder="الموضوع" required="">
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
                      <textarea name="message" rows="6" class="form-control" id="message" placeholder="رسالتك" required=""></textarea>
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
                      <button type="submit" id="form-submit" class="filled-button">ارسال</button>
                    </fieldset>
                  </div>
                </div>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>


    
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="inner-content">
                <p>جميع الحقوق محفوظة &copy; 2021  </p> </div>
          </div>
        </div>
      </div>
    </footer>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/accordions.js"></script>


    <script language = "text/Javascript"> 
      cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
      function clearField(t){                   //declaring the array outside of the
      if(! cleared[t.id]){                      // function makes it static and global
          cleared[t.id] = 1;  // you could use true and false, but that's more typing
          t.value='';         // with more chance of typos
          t.style.color='#fff';
          }
      }
    </script>


  </body>

</html>
