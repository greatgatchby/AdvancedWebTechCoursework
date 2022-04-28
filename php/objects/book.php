<?php

class Book
{
    // Make database connection and also check the table name
    private $conn;
    private $table_name = "book";

    // object properties
    public $id;
    public $title;
    public $author;
    public $publisher;
    public $description;
    public $isbn;
    public $category;
    public $price;
    public $currency;
    public $stock_count;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // create book
    function create()
    {
        $this->price = floatval($this->price);
        $this->stock_count = floatval($this->stock_count);
        // query to add book to db
        $query = "INSERT INTO ".$this->table_name." SET title=:title, author=:author, publisher=:publisher, isbn=:isbn, category=:category, price=:price, currency=:currency, stock_count=:stock_count";

        // prepare query
        $stmt = $this->conn->prepare($query);

        //sanitize
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->publisher = htmlspecialchars(strip_tags($this->publisher));
        $this->isbn = htmlspecialchars(strip_tags($this->isbn));
        $this->category = htmlspecialchars(strip_tags($this->category));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->currency = htmlspecialchars(strip_tags($this->currency));
        $this->stock_count = htmlspecialchars(strip_tags($this->stock_count));

        // bind values
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":author", $this->author);
        $stmt->bindParam(":publisher", $this->publisher);
        $stmt->bindParam(":isbn", $this->isbn);
        $stmt->bindParam(":category", $this->category);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":currency", $this->currency);
        $stmt->bindParam(":stock_count", $this->stock_count);

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
    function find_all_by_category()
    {
        // select all query
        $query = "SELECT * FROM " . $this->table_name . " WHERE category=:category";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->category = htmlspecialchars(strip_tags($this->category));
        // bind values
        $stmt->bindParam(":category", $this->category);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    function update()
    {
        $this->stock_count= floatval($this->stock_count);
        $this->price= floatval($this->price);
        //use of COALESCE to return no value if item is set to null or 0 dependant on datatype
        $query = "UPDATE book SET title=COALESCE(NULLIF(:title, null), title), author=COALESCE(NULLIF(:author, null), author), publisher=COALESCE(NULLIF(:publisher, null), publisher), isbn=COALESCE(NULLIF(:isbn, null), isbn), category=COALESCE(NULLIF(:category, null), category), price=COALESCE(NULLIF(:price, 0), price), currency=COALESCE(NULLIF(:currency, null), currency), stock_count=COALESCE(NULLIF(:stock_count, 0), stock_count) WHERE id=:id";

        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->publisher = htmlspecialchars(strip_tags($this->publisher));
        $this->isbn = htmlspecialchars(strip_tags($this->isbn));
        $this->category = htmlspecialchars(strip_tags($this->category));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->currency = htmlspecialchars(strip_tags($this->currency));
        $this->stock_count = htmlspecialchars(strip_tags($this->stock_count));

        // bind values
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":author", $this->author);
        $stmt->bindParam(":publisher", $this->publisher);
        $stmt->bindParam(":isbn", $this->isbn);
        $stmt->bindParam(":category", $this->category);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":currency", $this->currency);
        $stmt->bindParam(":stock_count", $this->stock_count);
        if ($stmt->execute()) {
            return 'message: ' . $this->id . ' updated successfully';
        }
        return false;
    }

    function delete_one()
    {
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

    function delete_all()
    {
        // select all query
        $query = "DELETE FROM " . $this->table_name;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    function title_already_exist()
    {
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
                title='" . $this->title . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function category_exists()
    {
        $query = "SELECT *
            FROM
                category
            WHERE
                id='" . $this->category . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
