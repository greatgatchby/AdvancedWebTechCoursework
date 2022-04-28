<?php
class User{
    // Make database connection and also check the table name
    private $conn;
    private $table_name = "restusers";

    // object properties
    public $phone;
    public $country_code;
    public $email;
    public $password;
    public $created;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // signup user
    function signup(){

        if($this->isAlreadyExist()){
            return false;
        }
        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " SET email=:email,phone=:phone,country_code=:country_code, password=:password, created=:created";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->phone=htmlspecialchars(strip_tags($this->phone));
        $this->country_code=htmlspecialchars(strip_tags($this->country_code));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->created=htmlspecialchars(strip_tags($this->created));

        // bind values
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":created", $this->created);

        // execute query
        if($stmt->execute()){
            $this->phone = $this->conn->lastInsertId();
            return true;
        }

        return false;

    }
    // login user
    function login(){
        // select all query
        $query = "SELECT * FROM " . $this->table_name . " WHERE phone='".$this->phone."' AND password='".$this->password."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }
    function isAlreadyExist(){
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
                username='".$this->username."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}
