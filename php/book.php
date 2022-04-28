<?php
header("Content-Type:application/json");
header('Access-Control-Allow-Origin: *');
// include database and object files
include_once './config/database.php';
include_once './objects/book.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

$request_method = $_SERVER['REQUEST_METHOD'];
// prepare user object
$book = new Book($db);
switch ($request_method) {
    case "GET":
        if (!empty($_GET['id'])) {
            $book->id = $_GET['id'];
            $stmt = $book->find_one();
            if ($stmt->rowCount() > 0) {
                $book_arr = ["status" => 200,
                    "message" => "Success!"];
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $bk_item = array(
                        "id" => $row['id'],
                        "title" => $row['title'],
                        "author_id" => $row['author'],
                        "publisher" => $row['publisher'],
                        "isbn" => $row['isbn'],
                        "category_id" => $row['category'],
                        "price" => $row['price'],
                        "currency" => $row['currency'],
                        "stock_count" => $row['stock_count']
                    );
                    array_push($book_arr, $bk_item);
                }
            } else {
                $book_arr = array(
                    "status" => 400,
                    "message" => "Invalid id!",
                );
            }
        } else if (!empty($_GET['category'])) {
            $book->category = $_GET['category'];
            $stmt = $book->find_all_by_category();
            if ($stmt->rowCount() > 0) {
                $book_arr = ["status" => 200,
                    "message" => "Success!"];
                $book_list = [];
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $bk_item = array(
                        "id" => $row['id'],
                        "title" => $row['title'],
                        "author_id" => $row['author'],
                        "publisher" => $row['publisher'],
                        "isbn" => $row['isbn'],
                        "category_id" => $row['category'],
                        "price" => $row['price'],
                        "currency" => $row['currency'],
                        "stock_count" => $row['stock_count']
                    );
                    array_push($book_list, $bk_item);
                }
                $book_arr = ["status" => 200,
                    "message" => "Success!",
                    "data" => $book_list,
                ];
            } else {
                $book_arr = array(
                    "status" => 400,
                    "message" => "Invalid category id!",
                );
            }
        } else {
            $stmt = $book->readAll();
            $book_arr = ["status" => 200,
                                "message" => "Success!"];
            if ($stmt->rowCount() > 0) {
                // get retrieved row
                $book_list = [];
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $bk_item = array(
                        "id" => $row['id'],
                        "title" => $row['title'],
                        "author_id" => $row['author'],
                        "description" => $row['description'],
                        "publisher" => $row['publisher'],
                        "isbn" => $row['isbn'],
                        "category_id" => $row['category'],
                        "price" => $row['price'],
                        "currency" => $row['currency'],
                        "stock_count" => $row['stock_count']
                    );
                    array_push($book_list, $bk_item);
                }
                $book_arr = ["status" => 200,
                    "message" => "Success!",
                    "data" => $book_list,
                ];
                // create array

            } else {
                $book_arr = array(
                    "status" => 400,
                    "message" => "Invalid id!",
                );
            }
        }
        // make it json format
        print_r(json_encode($book_arr));
        break;
    case "POST":
        if (!empty($_POST['title'])) {
            $book->title = $_POST['title'];
            $book->author = $_POST['author'];
            if(isset($_POST['publisher'])){$book->publisher = $_POST['publisher'];};
            if(isset($_POST['isbn'])){$book->isbn = $_POST['isbn'];};
            if(isset($_POST['category'])){
                $book->category = $_POST['category'];
                if (!empty($_GET['category'])){
                    if(!$book->category_exists()){
                        return array(
                            "status" => 400,
                            "message" => "Category does not exist",
                        );                }
                }
            };
            if(isset($_POST['price'])){$book->price = $_POST['price'];};
            if(isset($_POST['currency'])){$book->currency = $_POST['currency'];};
            if(isset($_POST['stock_count'])){$book->stock_count = $_POST['stock_count'];};
            if(!$book->title_already_exist()){
                if($stmt = $book->create()){

                    $arr = array(
                        "status" => "200",
                        "message" => "category created successfully",
                        "response" => array(
                            "id" => $book->id,
                            "title" => isset($_POST['title']) ? $_POST['title'] : '',
                            "author" => isset($_POST['author']) ? $_POST['author'] : '',
                            "publisher" => isset($_POST['publisher']) ? $_POST['publisher'] : '',
                            "isbn" => isset($_POST['isbn']) ? $_POST['isbn'] : '',
                            "category" => isset($_POST['category']) ? $_POST['category'] : '',
                            "price" => isset($_POST['price']) ? $_POST['price'] : '',
                            "currency" => isset($_POST['currency']) ? $_POST['currency'] : '',
                            "stock_count" => isset($_POST['stock_count']) ? $_POST['stock_count'] : '',
                        ),
                    );
                    print_r(json_encode($arr));
                } else {
                    print_r(json_encode(array(
                        'code' => 500,
                        'error' => 'an error occured while processing the request',
                    )));
                }
            } else {
                print_r(json_encode(array("status"=>300,"error"=>"title already exists")));
            }

        } else {
            print_r("please enter a category name");
        }
        break;
        break;
    case "PUT":
        parse_str(file_get_contents("php://input"),$post_vars);
        if (!empty($post_vars['id'])){
            if($book->find_one()){
                $book->id = $post_vars['id'];
                if(isset($post_vars['title'])){$book->title = $post_vars['title'];};
                if(isset($post_vars['author'])){$book->author = $post_vars['author'];};
                if(isset($post_vars['publisher'])){$book->publisher = $post_vars['publisher'];};
                if(isset($post_vars['isbn'])){$book->isbn = $post_vars['isbn'];};
                if(isset($post_vars['category'])){$book->category = $post_vars['category'];};
                if(isset($post_vars['price'])){$book->price = $post_vars['price'];};
                if(isset($post_vars['currency'])){$book->currency = $post_vars['currency'];};
                if(isset($post_vars['stock_count'])){$book->stock_count = $post_vars['stock_count'];};
                if($stmt = $book->update()){
                        print_r(json_encode(array(
                            "status" => 200,
                            "message" => "success",
                            "response" => array(
                                "id" => $post_vars['id'],
                                "title" => isset($post_vars['title']) ? $post_vars['title'] : '',
                                "author" => isset($post_vars['author']) ? $post_vars['author'] : '',
                                "publisher" => isset($post_vars['publisher']) ? $post_vars['publisher'] : '',
                                "isbn" => isset($post_vars['isbn']) ? $post_vars['isbn'] : '',
                                "category" => isset($post_vars['category']) ? $post_vars['category'] : '',
                                "price" => isset($post_vars['price']) ? $post_vars['price'] : '',
                                "currency" => isset($post_vars['currency']) ? $post_vars['currency'] : '',
                                "stock_count" => isset($post_vars['stock_count']) ? $post_vars['stock_count'] : '',
                            )
                        )));
                    print_r(json_encode(array("status"=>300,"message"=>"title already exists")));
                } else {
                    print_r(json_encode(array("status" => 300, "message" => "internal server error")));
                }

            } else {
                print_r(json_encode(array("error" => "an error has occurred")));
            }
        }else{
            print_r("please enter an item id");
        }
        break;
    case "DELETE":
        parse_str(file_get_contents("php://input"),$del_vars);
        if (!empty($del_vars['id'])){
            $book->id = $del_vars['id'];
            $stmt = $book->delete_one();
            print_r(json_encode(array(
                "status:"=>200,
                "message:"=>"deleted book from db"
            )));
        }else{
            $stmt = $book->delete_all();
            print_r(json_encode(array(
                "status:"=>200,
                "message:"=>"deleted all books from db"
            )));
        }
        break;
}
?>
