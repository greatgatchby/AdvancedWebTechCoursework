<?php
header("Content-Type:application/json");
$welcome_message = "welcome to 18021745's book management system";
$array = array(
    "status" => 200,
    "message" => "success",
    "data" => $welcome_message
);
print_r(json_encode($array));
