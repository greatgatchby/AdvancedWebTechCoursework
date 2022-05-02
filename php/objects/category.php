<?php
class Category
{
    // Make database connection and also check the table name
    private $conn;
    private $table_name = "category";

    // object properties
    public $id;
    public $name;
    public $parent;
    public $placeholder;
    public $display_homepage;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // create category
    function create()
    {

        if ($this->name_already_exist()) {
            return false;
        }
        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, parent=:parent, display_homepage=:display_homepage, placeholder=:placeholder, created_at=CURRENT_DATE()";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->parent = htmlspecialchars(strip_tags($this->parent));
        $this->placeholder = htmlspecialchars(strip_tags($this->placeholder));
        $this->display_homepage = htmlspecialchars(strip_tags($this->display_homepage));
        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":parent", $this->parent);
        $stmt->bindParam(":placeholder", $this->placeholder);
        $stmt->bindParam(":display_homepage", $this->display_homepage);

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
            $this->name = htmlspecialchars(strip_tags($this->name));
        }
        if(empty($this->parent)){
           $this->parent = '';
            $this->parent = htmlspecialchars(strip_tags($this->parent));
        }
        switch ($this->display_homepage){
            case 'true'||'TRUE':
                $this->display_homepage = 1;
                break;
            case 'false'||'FALSE':
                $this->display_homepage = 0;
                break;
            default: $this->display_homepage = 0;
        }
        $query = "UPDATE category SET name=COALESCE(NULLIF(:name, ''), name), parent=COALESCE(NULLIF(:parent, ''), parent), placeholder=COALESCE(NULLIF(:placeholder, ''), placeholder), display_homepage=:display_homepage, updated_at=CURRENT_DATE() WHERE id=:id";

        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->placeholder = htmlspecialchars(strip_tags($this->placeholder));
        $this->display_homepage = htmlspecialchars(strip_tags($this->display_homepage));

        // bind values
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":parent", $this->parent);
        $stmt->bindParam(":placeholder", $this->placeholder);
        $stmt->bindParam(":display_homepage", $this->display_homepage);
        if($stmt->execute()) {
            return 'message: ' . $this->name . ' updated successfully';
        }
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
    function parent_already_exist(){
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
                id='".$this->parent."'";
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
    function name_already_exist(){
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
                name='".$this->name."'";
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
