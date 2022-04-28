<?php
header("Content-Type:application/json");
// include database and object files
include_once './config/database.php';
include_once './objects/order.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

$request_method = $_SERVER['REQUEST_METHOD'];
// prepare user object
$order = new Order($db);
switch ($request_method) {
    case "GET":
        if (!empty($_GET['id'])) {
            $order->id = $_GET['id'];
            $stmt = $order->find_one();
            if ($stmt->rowCount() > 0) {
                // get retrieved row
                $order_list = ["status" => true,
                    "message" => "Success!"];
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $order_item = array(
                        "id" => $row['id'],
                        "user" => $row['user'],
                        "shipping_address" => $row['shipping_address'],
                        "items" => $row['items'],
                    );
                    array_push($order_list, $order_item);
                }
            } else {
                $order_list = array(
                    "status" => 400,
                    "message" => "No orders found.",
                );
            }
        } else {
            $stmt = $order->read_all();
            if ($stmt->rowCount() > 0) {
                // get retrieved row
                $order_list = ["status" => true,
                    "message" => "Success!"];
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $order_item = array(
                        "id" => $row['id'],
                        "firstname" => $row['firstname'],
                        "lastname" => $row['lastname']
                    );
                    array_push($order_list, $order_item);
                }
            } else {
                $order_list = array(
                    "status" => 400,
                    "message" => "No orders found.",
                );
            }
        }
        // make it json format
        print_r(json_encode($order_list));
        break;
    case "POST":
        if (!empty($_POST['user'] )){
            $order->user = $_POST['user'];
            $order->shipping_address = $_POST['shipping_address'];
            $order->items = $_POST['items'];
            $order->total = $_POST['total'];
            if ($stmt = $order->create()){
                $arr = array(
                    "status" => "200",
                    "message" => "order created successfully",
                    "order" => array(
                        "id" => $order->id,
                        "user" => $order->user,
                        "items" => $order->items,
                        "shipping_address" => $order->shipping_address,
                        "total" => $order->total
                    ),
                );
            } else {
                $arr = array(
                    "status" => "500",
                    "message" => "there was an error creating your order"
                );
            }
            print_r(json_encode($arr));
        }else{
            print_r("please enter a category firstname");
        }
        break;
    case "PUT":
        parse_str(file_get_contents("php://input"),$post_vars);
        if (!empty($post_vars['id'])){
            $order->id = $post_vars['id'];
            if(isset($post_vars['firstname'])){
                $order->firstname = $post_vars['firstname'];
            }
            if(isset($post_vars['lastname'])){
                $order->lastname = $post_vars['lastname'];
            }
            $stmt = $order->update();
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
