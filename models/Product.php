<?php
include_once 'Model.php';

class Product extends Model
{
    public $id;

    // object properties
    public $name;
    public $description;
    public $image;
    public $price;
    public $quantity;
    public $category;
    protected $table_name = 'products';
    protected $searchableColumns = ['name','description', 'price', 'quantity'];

    // constructor with $db as database connection

    function __construct($db)
    {
        parent::__construct($db);
    }


    function create()
    {

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    description=:description, price=:price, name=:name
                    , quantity=:quantity, category_id=:category
                    ,image=:image";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":category", $this->category);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":image", $this->image);

        // execute query
        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
       // var_dump($stmt->errorInfo());
        //die();
        return false;
    }


    function edit()
    {

        // query to insert record
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    description=:description, price=:price, name=:name
                    , quantity=:quantity, category_id=:category
                    ,image=:image"
            . ' WHERE id=' . $this->id;

        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":category", $this->category);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":image", $this->image);

        // execute query
        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        // var_dump($stmt->errorInfo());
        //die();
        return false;
    }

    public function getLatestProduct(){
        $query = "SELECT * FROM " . $this->table_name . " ORDER by id DESC LIMIT 6";

        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }



}
