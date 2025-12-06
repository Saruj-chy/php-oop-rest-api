<?php
header('Content-Type: application/json');
require_once "./model/Product.php";
include 'db_local.php';
$posts = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $input = json_decode(file_get_contents("php://input"), true);
    if (!$input || !isset($input["NAME"]) ) {
        echo json_encode(["error" => "Invalid data"]);
        exit;
    }
    
    $product = new Product($input, $conn);
    

    $response = $product->InsertProduct();
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
    http_response_code(406);
    $posts = [
        "success" => 406,
        "msg"     => "Please Data Push POST Method",

    ];
}
echo json_encode($posts);


