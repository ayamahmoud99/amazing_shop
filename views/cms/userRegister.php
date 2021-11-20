<?php 
     session_start();
?>
<!DOCTYPE html>
<html dir="rtl">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Shop |User Registration </title>
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
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="#">متجر <b> التميز</b></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">أنشأ حساب المستخدم الخاص بك </p>

    <form action="../../controllers/users.php" method="post">
     <input name="req" type="hidden" value="create">
     <?php 
     
           
                if (isset($_SESSION['addUserMsgError'])) {
              
                  echo ' <div class="row">
                         <div class="col-12" style="text-align:center;font-weight: bold;">';
                  echo "<span class='login-box-msg mt-1 text-danger'> ".$_SESSION["addUserMsgError"] . "</span>";
                  echo '</div> </div>';
                }
      ?>
      <div class="form-group has-feedback">
        <input required name="firstName" type="text" class="form-control" placeholder=" الاسم الأول">
        <span class="fa fa-address-card form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input required name="lastName" type="text" class="form-control" placeholder=" الكنية">
        <span class="fa fa-address-card-o form-control-feedback"></span>
      </div>
        <div class="form-group has-feedback">
            <input required name="phone" type="number" class="form-control" placeholder=" رقم الهاتف">
            <span class="fa fa-phone form-control-feedback"></span>
        </div>
      <div class="form-group has-feedback">
        <input required  name="email" type="email" class="form-control" placeholder="الإيميل">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input required name="password" type="password" class="form-control" placeholder="كلمة السر">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input required name="passwordConfirmation" type="password" class="form-control" placeholder="تأكيد كلمة السر">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
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
    <a  href="login.php" style="margin-right: 20%">لدي حساب بالفعل</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="plugins/select2/select2.full.min.js"></script>
<script>
  $(function () {
    $(".select2").select2();
  });
</script>
</body>
</html>
