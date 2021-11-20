<?php

class Model
{

    // database connection and table name
    protected $table_name;
    protected $conn;
    protected $searchableColumns = array();

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function findAllWithoutLimit(){
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }
    public function findAll($search, $page)
    {
        $query = "SELECT * FROM " . $this->table_name;

        // search
        if (count($this->searchableColumns) > 0 && $search != '') {
            $query = $query . ' WHERE ';
            $index = 0;
            foreach ($this->searchableColumns as $searchableColumn) {
                if ($index != 0) {
                    $query = $query . ' OR ';
                }
                $query = $query . $searchableColumn . ' LIKE ' . "'%" . $search . "%'";
                $index++;
            }
        }
        // pagination
        $page = ($page - 1) * 10;
        $query = $query . " ORDER by id LIMIT " . $page . ",10";
        // SELECT * FROM table LIMIT offset,items_per_page
        // prepare query statement


        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function find($id)
    {

        $query = "SELECT * FROM " . $this->table_name . " WHERE id=:id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        // execute query
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data[0];
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        // prepare query statement

        $stmt = $this->conn->prepare($query);


        $stmt->bindParam(":id", $id);

        // execute query
        try {

            $stmt->execute();

        } catch (Exception $ex) {

            return false;
        }
        return true;
    }
}
