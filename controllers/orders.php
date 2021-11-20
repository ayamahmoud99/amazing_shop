<?php
include_once '../config/setting.php';
// get database connection
include_once '../config/Database.php';

// instantiate user object
include_once '../models/Order.php';

$database = new Database();
$db = $database->getConnection();

$order = new Order($db);

if (isset($_POST['req'])) {
    switch ($_POST['req']) {

        case "delete":
            $order->delete($_POST['id']);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            break;


        default:
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            break;
    }
}
