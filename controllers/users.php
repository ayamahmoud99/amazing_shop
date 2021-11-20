<?php
include_once '../config/setting.php';
// get database connection
include_once '../config/Database.php';

// instantiate user object
include_once '../models/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if (isset($_POST['req'])) {
    switch ($_POST['req']) {

        case "delete":
            $user->delete($_POST['id']);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            break;

        case "create":
            $user->email = $_POST['email'];
            if ($user->email == "") {
                session_start();
                $_SESSION['addUserMsgError'] = "* يجب ادخال ايميل";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                break;
            }
            $user->password = $_POST['password'];
            $pwdConfirm = $_POST['passwordConfirmation'];

            if ($user->password != $pwdConfirm) {
                session_start();
                $_SESSION['addUserMsgError'] = "* كلمة السر غير متطابقة";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                break;
            }
            $user->firstName = $_POST['firstName'];
            $user->lastName = $_POST['lastName'];
            $user->phone = $_POST['phone'];
            $message = '';
            if ($user->signup($message)) {
                session_start();
                $_SESSION['addUserMsgError'] = '';
                $_SESSION['user'] =   $user->firstName . " " . $user->lastName;
                $_SESSION['user_id'] = $user->id ;
                header("Location:" . $siteUrl);
            } else {
                session_start();
                $_SESSION['addUserMsgError'] = $message;
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }

            break;

        default:
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            break;
    }
}
