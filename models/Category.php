<?php
include_once 'Model.php';

class Category extends Model
{
    public $id;

    // object properties
    public $name;
    public $brief;
    public $image;
    public $active;
    protected $table_name = 'categories';
    protected $searchableColumns = ['name', 'brief'];

    // constructor with $db as database connection

    function __construct($db)
    {
        parent::__construct($db);
    }

    function getCategoryName($id)
    {
        return $this->find($id)['name'];
    }

    function create()
    {

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    brief=:brief, active=:active, name=:name
                    ,image=:image";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":brief", $this->brief);
        $stmt->bindParam(":active", $this->active);
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
        $query = "UPDATE " . $this->table_name . "
                SET
                    brief=:brief, active=:active, name=:name
                    ,image=:image"
         . ' WHERE id=' . $this->id;

        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":brief", $this->brief);
        $stmt->bindParam(":active", $this->active);
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


    public function getStatus($category){
        if(isset($category["active"]) && $category["active"] ==1){
            return "نشط";
        }
        return  "غير نشط";
    }

    function getActiveCategory(){
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
              active='" . 1 . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        $items = $stmt->fetchAll();
        return $items;
    }


}
