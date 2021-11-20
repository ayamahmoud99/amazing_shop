<?php
include_once '../config/setting.php';
// get database connection
include_once '../config/Database.php';

// instantiate user object
include_once '../models/Category.php';

$database = new Database();
$db = $database->getConnection();

$category = new Category($db);

if (isset($_POST['req'])) {
    switch ($_POST['req']) {

        case "delete":
            $category->delete($_POST['id']);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            break;

        case "create":

            $category->brief = $_POST['brief'];
            $category->name = $_POST['name'];
            if (isset($_POST['active'])) {
                $category->active = $_POST['active'] == 'on' ? 1 : 0;
            } else {
                $category->active = 0;
            }


            if (!empty($_FILES['image'])) {
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $name = "categories" . time() . "." . $ext;
                $path = "../views/uploads/" . $name;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {

                    $category->image = $name;
                    if($category->create()){
                        header('Location: ' .$siteUrl . 'cms/categories.php');
                        break;
                    }
                }


            }
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            break;

        case "edit":
            $category->id = $_POST['id'];
            $category->brief = $_POST['brief'];
            $category->name = $_POST['name'];
            if (isset($_POST['active'])) {
                $category->active = $_POST['active'] == 'on' ? 1 : 0;
            } else {
                $category->active = 0;
            }

            $realCategory=$category->find($category->id);

            if (!empty($_FILES['image']) && $_FILES['image']['name'] != '') {
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $name = "categories" . time() . "." . $ext;
                $path = "../views/uploads/" . $name;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {

                    $category->image = $name;
                }

            }else{
                $category->image = $realCategory['image'];
            }
            if($category->edit()){
                header('Location: ' .$siteUrl . 'cms/categories.php');
                break;
            }
            break;

        default:
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            break;
    }
}
