<?php
include_once 'Model.php';

class User extends Model
{
    public $id;
    // object properties
    public $admin;
    public $phone;
    public $email;
    public $password;
    public $firstName;
    public $lastName;
    protected $table_name = 'users';
    protected $searchableColumns = ['first_name', 'last_name', 'phone', 'email'];

    // constructor with $db as database connection

    function __construct($db)
    {
        parent::__construct($db);
    }



    // signup user
    function signup(&$message)
    {

        if ($this->isAlreadyExist($message)) {
            return false;
        }
       

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    email=:email, password=:password, first_name=:firstName
                    ,last_name=:lastName,phone=:phone";

        // prepare query
        $stmt = $this->conn->prepare($query);


        $pwd =  sha1($this->password) ;
        // bind values
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password",$pwd);
        $stmt->bindParam(":firstName", $this->firstName);
        $stmt->bindParam(":lastName", $this->lastName);
        $stmt->bindParam(":phone", $this->phone);

    

        // execute query
        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        // var_dump($stmt->errorInfo());
       // die();

        return false;
    }

    function isAlreadyExist(&$message)
    {
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
                email='" . $this->email . "'" .
            "AND id !='" . $this->id . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $message = '* الإيميل موجود مسبقا';

            return true;
        }
        return false;
    }

    // login user

    function login()
    {
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                WHERE
                    email='" . $this->email . "' AND password='" . sha1($this->password) . "'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

}
