<?php
header('Content-Type: application/json');
require_once "./model/ProductOrder.php";
include 'db_local.php';
$output = [];

if ($_SERVER['REQUEST_METHOD'] == "PATCH") {
    @$_PATCH                 = json_decode(file_get_contents('php://input'), true);
    $productOrder = new ProductOrder($conn, $_PATCH);
    
    $update    = $productOrder->UpdateProductOrder();
    if($update){
        $output = ["success" => 200,
            "msg"              => "Data updated successfully"];
    }else{
        $output = ["success" => 500,
            "msg"              => "No Data Updated"];
    }


} else {
    $output = [
        "success" => 406,
        "msg"     => "Please Data Push PATCH Method",

    ];
}
echo json_encode($output);


