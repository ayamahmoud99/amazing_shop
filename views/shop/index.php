<?php
include_once '../../config/setting.php';
include_once "../../models/Product.php";
include_once "../../config/Database.php";
include_once "../../models/Category.php";
include_once "../../models/Cart.php";
$database = new Database();
$db = $database->getConnection();
$categoryDb = new Category($db);
$productDb = new Product($db);
$cartDb = new Cart($db);
$products = $productDb->getLatestProduct();
session_start();
if(isset( $_GET["addToCart"])){
    $productId = $_GET["addToCart"];
    if(isset($_SESSION['user_id'])){
        $userID =  $_SESSION['user_id'] ;
        $cartDb->addToCart($userID,$productId);
    }
}
if(isset( $_GET["removeFromCart"])){
    $productId = $_GET["removeFromCart"];
    if(isset($_SESSION['user_id'])){
        $userID =  $_SESSION['user_id'] ;
        $cartDb->removeFromCart($userID,$productId);
    }
}
if(isset($_SESSION['user_id'])){
    $userID =  $_SESSION['user_id'] ;
    $cartCount = $cartDb->getCartCount($userID);
    $productIds = $cartDb->getCartProduct($userID);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
          rel="stylesheet">

    <title>متجر التميز</title>

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
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
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
                        <a class="nav-link" href="basket.php">
                         ('.$cartCount .')السلة </a>
                    </li>';

                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">من نحن </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">اتصل بنا</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products.php">منتجاتنا</a>
                    </li>
                    <li class="nav-item active">
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
<!-- Banner Starts Here -->
<div class="banner header-text">
    <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
            <div class="text-content">
                <h4>أفضل الهدايا</h4>
                <h2>فاجئ المقربين بهدية لطيفة </h2>
            </div>
        </div>
        <div class="banner-item-02">
            <div class="text-content">
                <h4>شراء مباشر</h4>
                <h2>احصل على منتجك مباشرة</h2>
            </div>
        </div>
        <div class="banner-item-03">
            <div class="text-content">
                <h4>منتجات طبيعية </h4>
                <h2>احصل على منتجات من الطبيعة مباشرة</h2>
            </div>
        </div>
    </div>
</div>
<!-- Banner Ends Here -->

<div class="latest-products">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2> أحدث المنتجات</h2>
                    <a href="http://localhost/Amazing_Shop/views/cms/login.php">مشاهدة جميع المنتجات <i class="fa fa-angle-right"></i></a>
                </div>
            </div>
            <?php
            foreach ($products as $product) {
                echo ' <div class="col-md-4">';
                echo ' <div class="product-item">';
                echo '  <a href="#"><img class="product-image" src="' . $siteUrl . '/uploads/' . $product["image"] . '" alt=""></a>';
                echo ' <div class="down-content">';
                echo '  <a href="#"><h4>' . $product['name'].'</h4></a>';
                echo '  <h6>' .$product['price']  . ' ليرة ' .'</h6>';
                echo '    <p>' .$product['description'] .'</p>';
                if(isset($_SESSION["admin"]) || isset($_SESSION["user"])){
                    if(!in_array($product["id"],$productIds)){
                        echo '  <a href="'. $siteUrl . 'shop/index.php?addToCart=' . $product["id"] .'"> أضف الى السلة</a>';
                    }else{
                        echo '  <a href="'. $siteUrl . 'shop/index.php?removeFromCart=' . $product["id"] .'"> حذف من السلة</a>';
                    }

                }
                echo '   </div>';
                echo '   </div>';
                echo '   </div>';

            }
            ?>


        </div>
    </div>
</div>

<div class="best-features">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>من نحن</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="left-content">
                    <h4>تبحث عن المنتج الأفضل؟</h4>
                    <p>لقد وصلت لدينا افضل المنتجات </p>
                    <ul class="featured-list">
                        <li><a href="#">جودة عالية</a></li>
                        <li><a href="#">اسعار منافسة</a></li>
                        <li><a href="#">كفالة حقيقة</a></li>
                        <li><a href="#">توصيل الى المنزل ضمن اللادقية</a></li>
                        <li><a href="#">شحن الى المحافظات</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="right-image">
                    <img src="assets/images/feature-image.jpg" alt="">
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
                    <p>جميع الحقوق محفوظة &copy; 2021  </p>
                </div>
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


<script language="text/Javascript">
    cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
    function clearField(t) {                   //declaring the array outside of the
        if (!cleared[t.id]) {                      // function makes it static and global
            cleared[t.id] = 1;  // you could use true and false, but that's more typing
            t.value = '';         // with more chance of typos
            t.style.color = '#fff';
        }
    }
</script>


</body>

</html>
