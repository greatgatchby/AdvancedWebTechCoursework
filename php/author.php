<?php
header("Content-Type:application/json");
// include database and object files
include_once './config/database.php';
include_once './objects/author.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

$request_method = $_SERVER['REQUEST_METHOD'];
// prepare user object
$author = new Author($db);
switch ($request_method) {
    case "GET":
        if (!empty($_GET['id'])) {
            $author->id = $_GET['id'];
            $stmt = $author->find_one();
            if ($stmt->rowCount() > 0) {
                // get retrieved row
                $author_list = ["status" => true,
                    "message" => "Success!"];
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $author_item = array(
                        "id" => $row['id'],
                        "firstname" => $row['firstname'],
                        "lastname" => $row['lastname']
                    );
                    array_push($author_list, $author_item);
                }
            } else {
                $author_list = array(
                    "status" => 400,
                    "message" => "No authors found.",
                );
            }
        } else {
            $stmt = $author->readAll();
            if ($stmt->rowCount() > 0) {
                // get retrieved row
                $author_list = ["status" => true,
                    "message" => "Success!"];
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $author_item = array(
                        "id" => $row['id'],
                        "firstname" => $row['firstname'],
                        "lastname" => $row['lastname']
                    );
                    array_push($author_list, $author_item);
                }
            } else {
                $author_list = array(
                    "status" => 400,
                    "message" => "No authors found.",
                );
            }
        }
        // make it json format
        print_r(json_encode($author_list));
        break;
    case "POST":
        if (!empty($_POST['firstname'] )){
            $author->firstname = $_POST['firstname'];
            $author->lastname = $_POST['lastname'];
            $stmt = $author->create();
            $arr = array(
                "status" => "200",
                "message" => "category created successfully",
                "category" => array(
                    "firstname" => $author->firstname,
                    "lastname" => $author->lastname
                ),
            );
            print_r(json_encode($arr));

        }else{
            print_r("please enter a category firstname");
        }
        break;
    case "PUT":
        parse_str(file_get_contents("php://input"),$post_vars);
        if (!empty($post_vars['id'])){
            $author->id = $post_vars['id'];
            if(isset($post_vars['firstname'])){
                $author->firstname = $post_vars['firstname'];
            }
            if(isset($post_vars['lastname'])){
                $author->lastname = $post_vars['lastname'];
            }
            $stmt = $author->update();
            print_r(json_encode($stmt));
        }else{
            print_r("please enter a category id");
        }
        break;
    case "DELETE":
        print_r("no delete statement");
        break;
}
?>
