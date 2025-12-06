<?php
header('Content-Type: application/json');
require_once "./model/ProductOrder.php";
include 'db_local.php';
$posts = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $productOrder = new ProductOrder($conn, $_POST);
    

    $response = $productOrder->InsertProductOrder();
    if($response){
        http_response_code(200);
        $posts = [
            "success"      => 200,
            "msg"          => "Insert  successfully."
        ];
    }else{
        http_response_code(200);
        $posts = [
            "success"      => 200,
            "msg"          => "Insert  successfully."
        ];

    }  
} else {
    $posts = [
        "success" => 406,
        "msg"     => "Please Data Push POST Method",

    ];
}
echo json_encode($posts);


