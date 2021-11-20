<?php
include_once '../config/setting.php';
// get database connection
include_once '../config/Database.php';

// instantiate user object
include_once '../models/Product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

if (isset($_POST['req'])) {
    switch ($_POST['req']) {

        case "delete":
            $product->delete($_POST['id']);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            break;

        case "create":

            $product->category = $_POST['category'];
            $product->name = $_POST['name'];
            $product->quantity = $_POST['quantity'];
            $product->description = $_POST['description'];
            $product->price = $_POST['price'];

            if (!empty($_FILES['image'])) {
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $name = "products" . time() . "." . $ext;
                $path = "../views/uploads/" . $name;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {

                    $product->image = $name;
                    if($product->create()){
                        header('Location: ' .$siteUrl . 'cms/products.php');
                        break;
                    }
                }


            }
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            break;

        case "edit":

            $product->id = $_POST['id'];
            $product->category = $_POST['category'];
            $product->name = $_POST['name'];
            $product->quantity = $_POST['quantity'];
            $product->description = $_POST['description'];
            $product->price = $_POST['price'];
            $realProduct=$product->find($product->id);
            if (!empty($_FILES['image']) && $_FILES['image']['name'] != '') {
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $name = "products" . time() . "." . $ext;
                $path = "../views/uploads/" . $name;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {

                    $product->image = $name;
                }
            }else{
                $product->image = $realProduct['image'];
            }
            if($product->edit()){
                header('Location: ' .$siteUrl . 'cms/products.php');
                break;
            }
            break;

        default:
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            break;
    }
}
