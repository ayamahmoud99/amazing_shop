<?php
include_once 'Model.php';
include_once 'User.php';
include_once 'Cart.php';
include_once 'Product.php';
include_once 'OrderItem.php';

class Order extends Model
{
    public $id;

    // object properties
    protected $table_name = 'orders';
    protected $searchableColumns = ['total', 'user_first_name', 'user_last_name', 'user_email'
        , 'user_phone', 'status'];

    // constructor with $db as database connection

    function __construct($db)
    {
        parent::__construct($db);
    }

    function create()
    {
        if (!isset($_SESSION['user_id'])) {
            return false;
        }
        $database = new Database();
        $db = $database->getConnection();
        $cartDb = new Cart($db);
        $userDb = new User($db);
        $orderItem = new OrderItem($db);
        $productDb = new Product($db);
        $userID = $_SESSION['user_id'];
        $user = $userDb->find($userID);
        $cartItems = $cartDb->getCart($userID);
        $total = 0;
        foreach ($cartItems as $item) {
            $product = $productDb->find($item['product_id']);
            $total = $total + $product['price'];
        }
        if($total == 0){
            return false;
        }

        $payment_method = 'cash';
        $note = '';
        $status = 'new';
        $user_id = $userID;
        $user_first_name = $user['first_name'];
        $user_last_name = $user['last_name'];
        $user_email = $user['email'];
        $user_phone = $user['phone'];
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    total=:total, payment_method=:payment_method, note=:note
                    ,status=:status,user_id=:user_id,user_first_name=:user_first_name
                    ,user_last_name=:user_last_name
                    ,user_email=:user_email,user_phone=:user_phone";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":total", $total);
        $stmt->bindParam(":payment_method", $payment_method);
        $stmt->bindParam(":note", $note);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":user_first_name", $user_first_name);
        $stmt->bindParam(":user_last_name", $user_last_name);
        $stmt->bindParam(":user_email", $user_email);
        $stmt->bindParam(":user_phone", $user_phone);

        // execute query
        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            foreach ($cartItems as $item) {
                $orderItem->create($this->id, $item['product_id'], $item['number']);
            }
            $cartDb->clearCart($userID);
            return true;
        }
        // var_dump($stmt->errorInfo());
        //die();
        return false;
    }
}
