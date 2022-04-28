<?php

class Author
{
    // Make database connection and also check the table firstname
    private $conn;
    private $table_name = "author";

    // object properties
    public $id;
    public $firstname;
    public $lastname;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // create category
    function create()
    {

        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " SET firstname=:firstname, lastname=:lastname";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));

        // bind values
        $stmt->bindParam(":firstname", $this->firstname);
        $stmt->bindParam(":lastname", $this->lastname);

        // execute query
        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;

    }

    function readAll()
    {
        // select all query
        $query = "SELECT * FROM " . $this->table_name;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    function find_one()
    {
        // select all query
        $query = "SELECT * FROM " . $this->table_name . " WHERE id=:id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));
        // bind values
        $stmt->bindParam(":id", $this->id);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    function update()
    {
        if(empty($this->name)){
            $this->name = '';
        }
        if(empty($this->parent)){
            $this->parent = '';
        }
        $query = "UPDATE author SET firstname=COALESCE(NULLIF(:firstname, ''), firstname), lastname=COALESCE(NULLIF(:lastname, ''), lastname) WHERE id=:id";

        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));

        // bind values
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":firstname", $this->firstname);
        $stmt->bindParam(":lastname", $this->lastname);
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
    function delete_one(){
        // select all query
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));
        // bind values
        $stmt->bindParam(":id", $this->id);
        // execute query
        $stmt->execute();
        return $stmt;
    }
    function delete_all(){
        // select all query
        $query = "DELETE FROM " . $this->table_name;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }
}
