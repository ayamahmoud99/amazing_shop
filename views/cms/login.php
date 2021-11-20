<?php
include_once '../../config/setting.php';
include_once "../../config/Database.php";
include_once '../../models/User.php';
$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$validation_error = '';
session_start();
if (isset($_POST['email'])) {
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];
    $stmt = $user->login();
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row['is_admin'] == 1) {
            $_SESSION['admin'] = $row['first_name'] . " " . $row['last_name'];
            $_SESSION['user_id'] = $row['id'];
            header("Location:index.php");
        } else {
            $_SESSION['user'] = $row['first_name'] . " " . $row['last_name'];
            $_SESSION['user_id'] = $row['id'];
            header("Location:" . $siteUrl);
        }
    } else {
        $validation_error = "* اسم المستخدم أو كلمة السر غير صحيح";
    }
}

?>
<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Shop |Log in</title>
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
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

</head>

<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#">متجر <b>التميز</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">متجر التميز  </p>

        <form method="post">
            <?php

            if ($validation_error != '') {
                echo ' <div class="row">
          <div class="col-12" style="text-align:center;font-weight: bold;">';
                echo "<span class='login-box-msg mt-1 text-danger'> " . $validation_error . "</span>";
                echo '</div> </div>';
            }

            ?>

            <div class="form-group has-feedback">
                <input required name="email" type="text" class="form-control" placeholder="الإيميل">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input required name="password" type="password" class="form-control" placeholder="كلمة السر">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">تسجيل</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <br>
        <a href="userRegister.php" style="margin-right: 20%">انشاء حساب </a>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>

</html>
