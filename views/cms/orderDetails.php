<?php
include_once '../../config/setting.php';
include_once 'auth.php';
include_once "../../models/Order.php";
include_once "../../models/OrderItem.php";
include_once "../../config/Database.php";
$database = new Database();
$db = $database->getConnection();
$orderDb = new Order($db);
$orderItemDb = new OrderItem($db);
if (isset($_GET["id"])) {
    $order = $orderDb->find($_GET["id"]);
    if (!$order) {
        header("Location:" . $siteUrl . "cms/login.php");
    }
    $orderItems = $orderItemDb->getOrderItems($_GET["id"]);
} else {
    header("Location:" . $siteUrl . "cms/login.php");
}
?>
<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Shop | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap-rtl.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="dist/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="dist/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE-rtl.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins-rtl.min.css">
    <!-- iCheck -->


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>الإدارة</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">لوحة <b>الإدارة</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <li class="dropdown user user-menu">
                        <a href="<?= $siteUrl . "logout.php" ?>">
                            <span class="hidden-xs">تسجيل الخروج</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">

                <div class=" info">
                    <p><?= $_SESSION['admin'] ?></p>
                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li>
                    <a href=<?= $siteUrl . "cms/index.php" ?>>
                        <i class="fa fa-dashboard"></i> <span>الرئيسية</span>
                    </a>
                </li>
                <li>
                    <a href=<?= $siteUrl . "cms/members.php" ?>>
                        <i class="fa  fa-users"></i> <span>المشتركين</span>
                    </a>
                </li>
                <li>
                    <a href=<?= $siteUrl . "cms/categories.php" ?>>
                        <i class="fa  fa-folder"></i> <span>الأقسام</span>
                    </a>
                </li>
                <li>
                    <a href=<?= $siteUrl . "cms/products.php" ?>>
                        <i class="fa fa-product-hunt"></i> <span>المنتجات</span>
                    </a>
                </li>
                <li class="active">
                    <a href=<?= $siteUrl . "cms/orders.php" ?>>
                        <i class="fa fa-shopping-cart"></i> <span>الطلبات</span>
                    </a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"> تفاصيل الطلبية </h3>
                            <div class="box-body">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label class="col-sm-4 control-label"> اسم الزبون الاول </label>
                                        <div class="col-sm-8">
                                            <span> <?php echo $order['user_first_name']; ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="col-sm-4 control-label"> كنية الزبون </label>
                                        <div class="col-sm-8">
                                            <span> <?php echo $order['user_last_name']; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label class="col-sm-4 control-label"> ايميل الزبون </label>
                                        <div class="col-sm-8">
                                            <span> <?php echo $order['user_email']; ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="col-sm-4 control-label"> رقم هاتف الزبون </label>
                                        <div class="col-sm-8">
                                            <span> <?php echo $order['user_phone']; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label class="col-sm-4 control-label"> حالة الطلبية </label>
                                        <div class="col-sm-8">
                                            <span> <?php echo $order['status']; ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="col-sm-4 control-label"> المبلغ الاجمالي </label>
                                        <div class="col-sm-8">
                                            <span> <?php echo $order['total']; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-hover">
                                    <tbody>
                                    <tr>
                                        <th>المنتج</th>
                                        <th> السعر</th>
                                        <th>الكمية</th>
                                    </tr>
                                    <?php

                                    foreach ($orderItems as $orderItem) {
                                        echo '
                  <tr>
                  <td>            
                ' . $orderItem["product_name"] . '           
            </td> 
              <td>            
                ' . $orderItem["product_price"] . '           
            </td> 
                   <td>           
                ' . $orderItem["product_quantity"] . '               
            </td>    
            
          </tr>';
                                    }
                                    ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="modal-delete">

        <!-- /.modal-dialog -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">

        </div>
        <strong>جميع الحقوق محفوظة &copy; <a>آية محمود && لمى عيسى</a>.</strong>
    </footer>


    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<!-- <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script> -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>

<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

</body>

</html>
