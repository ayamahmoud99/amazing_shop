<?php
include_once '../../config/setting.php';
include_once 'auth.php';
include_once "../../models/Category.php";
include_once "../../config/Database.php";
$database = new Database();
$db = $database->getConnection();
$categoryDb = new Category($db);
if (isset($_GET["id"])) {
    $category = $categoryDb->find($_GET["id"]);
    if (!$category) {
        header("Location:" . $siteUrl . "cms/login.php");
    }
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
            <span class="logo-mini"><b>??????????????</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">???????? <b>??????????????</b></span>
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
                            <span class="hidden-xs">?????????? ????????????</span>
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
                        <i class="fa fa-dashboard"></i> <span>????????????????</span>
                    </a>
                </li>
                <li>
                    <a href=<?= $siteUrl . "cms/members.php" ?>>
                        <i class="fa  fa-users"></i> <span>??????????????????</span>
                    </a>
                </li>
                <li class="active">
                    <a href=<?= $siteUrl . "cms/categories.php" ?>>
                        <i class="fa  fa-folder"></i> <span>??????????????</span>
                    </a>
                </li>
                <li>
                    <a href=<?= $siteUrl . "cms/products.php" ?>>
                        <i class="fa fa-product-hunt"></i> <span>????????????????</span>
                    </a>
                </li>
                <li>
                    <a href=<?= $siteUrl . "cms/orders.php" ?>>
                        <i class="fa fa-shopping-cart"></i> <span>??????????????</span>
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
                            <h3 class="box-title"> ?????????? ?????? ???????? </h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form action="../../controllers/categories.php" method="post" enctype="multipart/form-data"
                              class="form-horizontal">
                            <input name="req" type="hidden" value="edit">
                            <input name="id" type="hidden"  value="<?= $category['id']?>" >
                            <div class="box-body">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label class="col-sm-4 control-label"> ?????? ?????????? </label>
                                        <div class="col-sm-8">
                                            <input type="text" value="<?= $category['name']?>" required name="name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="col-sm-4 control-label"> ???????? ?????????? </label>
                                        <div class="col-sm-8">
                                            <img  style="width: 250px;height: 110px;" src="<?= $siteUrl . '/uploads/' . $category["image"] ?>" alt="?????? ?????????? ????????????" />
                                            <input type="file" accept='image/*'   name="image"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="col-sm-4 control-label"> ?????? ?????????? </label>
                                        <div class="col-sm-8">
                                            <textarea required name="brief" class="form-control">
                                                <?= $category['brief']?>
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="col-sm-4 control-label"> ?????????? ??  </label>
                                        <div class="col-sm-8">
                                            <input type="checkbox"<?= $category['active'] == 1 ? 'checked' : '' ?>  name="active" >

                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">

                                <button type="submit" class="btn btn-info pull-right">??????</button>
                            </div>
                            <!-- /.box-footer -->
                        </form>
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
        <strong>???????? ???????????? ???????????? &copy; <a>?????? ?????????? && ?????? ????????</a>.</strong>
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
