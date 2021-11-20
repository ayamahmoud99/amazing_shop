<?php
include_once 'Model.php';
include_once 'Product.php';

class OrderItem extends Model
{
    public $id;

    // object properties
    protected $table_name = 'order_items';
    protected $searchableColumns = [];

    // constructor with $db as database connection

    function __construct($db)
    {
        parent::__construct($db);
    }
    function create($orderId , $productId , $number)
    {
        $database = new Database();
        $db = $database->getConnection();
        $productDb = new Product($db);
        $product = $productDb->find($productId);
        $product_name = $product['name'];
        $product_price =  $product['price'];
        $product_quantity = $number;
        $total = $product['price']  * $number ;
        $order_id= $orderId ;
        $product_id = $productId;

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    product_name=:product_name, product_price=:product_price, product_quantity=:product_quantity
                    ,total=:total,order_id=:order_id,product_id=:product_id";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":product_name", $product_name);
        $stmt->bindParam(":product_price", $product_price);
        $stmt->bindParam(":product_quantity", $product_quantity);
        $stmt->bindParam(":total", $total);
        $stmt->bindParam(":order_id", $order_id);
        $stmt->bindParam(":product_id", $product_id);
        // execute query
        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        // var_dump($stmt->errorInfo());
        //die();
        return false;
    }
    function getOrderItems($orderId){
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
              order_id='" . $orderId . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        $items = $stmt->fetchAll();
        return $items;
    }
}
