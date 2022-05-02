<?php
header("Content-Type:application/json");
header('Access-Control-Allow-Origin: *');
// include database and object files
include_once './config/database.php';
include_once './objects/category.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

$request_method = $_SERVER['REQUEST_METHOD'];
// prepare user object
$category = new Category($db);

switch ($request_method) {
    case "GET":
        if (!empty($_GET['id'])) {
            $category->id = isset($_GET['id']) ? $_GET['id'] : die();
            $stmt = $category->find_one();
            if ($stmt->rowCount() > 0) {
                $category_arr = ["status" => true,
                    "message" => "Success!"];
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $cat_item = array(
                        "status" => 200,
                        "message" => "Success!",
                        "id" => $row['id'],
                        "name" => $row['name'],
                        "parent" => $row['parent'],
                        "display_homepage" => $row['display_homepage']
                    );
                    array_push($category_arr, $cat_item);
                }
            } else {
                $category_arr = array(
                    "status" => 400,
                    "message" => "No categories found",
                );
            }
        } else {
            $stmt = $category->readAll();
            if ($stmt->rowCount() > 0) {
                // get retrieved row
                $data_arr = [];
                $display_homepage = false;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    switch ($row['display_homepage']){
                        case 1 : $display_homepage = true; break;
                        case 0 :  $display_homepage = false; break;
                    }
                    $cat_item = array(
                        "id" => $row['id'],
                        "name" => $row['name'],
                        "parent" => $row['parent'],
                        "placeholder" => $row['placeholder'],
                        "display_homepage" => $display_homepage
                    );
                    array_push($data_arr, $cat_item);
                }
                $category_arr = ["status" => true,
                    "message" => "Success!",
                    "data" => $data_arr
                ];
                array_push($data_arr, $category_arr);
                // create array

            } else {
                $category_arr = array(
                    "status" => "400",
                    "message" => "No categories found",
                );
            }
        }
        // make it json format
        print_r(json_encode($category_arr));
        break;
    case
    "POST":
        if (!empty($_POST['name'] )){
            $category->name = $_POST['name'];
            $category->placeholder = isset($_POST['placeholder']) ?  $_POST['placeholder'] : null;
            $category->parent = isset($_POST['parent']) ?  $_POST['parent'] : null;
            if(!empty($_POST['parent'])){
                $category->parent = $_POST['parent'];
                if ($category->parent_already_exist()){
                    $stmt = $category->create();
                    print_r(json_encode($stmt));
                } else {
                    print_r(json_encode("message: parent does not exist"));
                }
            }else{
                $stmt = $category->create();
                $arr = array(
                    "status" => "200",
                    "message" => "category created successfully",
                    "category" => array(
                        "name" => $category->name,
                        "parent" => $category->parent,
                        "placeholder" => $category->placeholder
                    ),
                );
                print_r(json_encode($arr));
            }
        }else{
            print_r("please enter a category name");
        }
        break;
    case "PUT":
        parse_str(file_get_contents("php://input"),$post_vars);
        if (!empty($post_vars['id'])){
            $category->id = $post_vars['id'];
            $category->name = isset($post_vars['name']) ?  $post_vars['name'] : null;
            $category->placeholder = isset($post_vars['placeholder']) ?  $post_vars['placeholder'] : null;
            $category->parent = isset($post_vars['parent']) ?  $post_vars['parent'] : null;
            $category->display_homepage = isset($post_vars['display_homepage']) ?  $post_vars['display_homepage'] : null;
            if($stmt = $category->update()) {
                print_r(json_encode(array(
                    "status" => 200,
                    "message" => 'Category updated successfully'
                )));
            } else {
                print_r(json_encode(
                    array(
                        "status" => 500,
                        "message" => 'error updating category'
                    )
                ));
            }
        }else{
            print_r("please enter a category id");
        }
        break;
    case "DELETE":
        parse_str(file_get_contents("php://input"),$post_vars);
        echo $post_vars['id'];
        if (!empty($post_vars['id'])){
            $category->id = $post_vars['id'];
            $stmt = $category->delete_one();
            print_r(json_encode($stmt));
        }else{
            $stmt = $category->delete_all();
            print_r(json_encode($stmt));
        }
        break;
}
?>
