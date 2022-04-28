<?php
class Order{
    private $conn;
    private $table_name = "order";
    
    public $id;
    public $user;
    public $shipping_address;
    public $items;
    public $total;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function create(){
        $query = "INSERT INTO order SET user=1, shipping_address=123, items=123, total=123.00 ";
        $stmt = $this->conn->prepare($query);
        /*
        $stmt = $this->conn->prepare($query);
                $this->total = floatval($this->total);
                $this->user = htmlspecialchars(strip_tags($this->user));
                $this->shipping_address = htmlspecialchars(strip_tags($this->shipping_address));
                $this->items = htmlspecialchars(strip_tags($this->items));

                // bind values
                $stmt->bindParam(":user", $this->user);
                $stmt->bindParam(":shipping_address", $this->shipping_address);
                $stmt->bindParam(":items", $this->items);
                $stmt->bindParam(":total", $this->total);
        */
        // execute query
        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }
    function find_one(){
        $query = "SELECT * FROM ".$this->table_name." WHERE id=:id";

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind values
        $stmt->bindParam(":id", $this->id);

        // execute query
        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }
    function read_all() {
        // select all query
        $query = "SELECT * FROM " . $this->table_name;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }
    function update(){

    }
    function delete_one(){

    }
    function delete_all(){

    }
}
