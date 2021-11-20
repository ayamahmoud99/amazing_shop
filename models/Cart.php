<?php
include_once 'Model.php';

class Cart extends Model
{
    public $id;

    // object properties
    public $productId;
    public $userID;
    public $number;
    protected $table_name = 'cart';
    protected $searchableColumns = [];

    // constructor with $db as database connection

    function __construct($db)
    {
        parent::__construct($db);
    }

    function removeFromCart($userID, $productId)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE user_id=:user_id And product_id=:product_id";
        // prepare query statement

        $stmt = $this->conn->prepare($query);


        $stmt->bindParam(":user_id", $userID);
        $stmt->bindParam(":product_id", $productId);

        // execute query
        try {

            $stmt->execute();

        } catch (Exception $ex) {

            return $this->getCartCount($userID);
        }
        return $this->getCartCount($userID);
    }

    public function getCartCount($userID)
    {
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
              user_id='" . $userID . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt->rowCount();
    }

    function addToCart($userID, $productId)
    {
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
                user_id='" . $userID . "'" .
            "AND product_id ='" . $productId . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        if ($stmt->rowCount() > 0) {

            return $this->getCartCount($userID);
        }

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    product_id=:product_id, user_id=:user_id, number=1";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":product_id", $productId);
        $stmt->bindParam(":user_id", $userID);

        // execute query
        $stmt->execute();
        return $this->getCartCount($userID);
    }

    public function getCartProduct($userID)
    {
        $productsIds = [];
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
              user_id='" . $userID . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        $items = $stmt->fetchAll();
        foreach ($items as $item) {
            $productsIds[] = $item['product_id'];
        }
        return $productsIds;
    }

    public function getCart($userID)
    {
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
              user_id='" . $userID . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        $items = $stmt->fetchAll();
        return $items;
    }

    public function clearCart($userID)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE user_id=:id";
        // prepare query statement

        $stmt = $this->conn->prepare($query);


        $stmt->bindParam(":id", $userID);

        // execute query
        try {

            $stmt->execute();

        } catch (Exception $ex) {

            return false;
        }
        return true;
    }


}
