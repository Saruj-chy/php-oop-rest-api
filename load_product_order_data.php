<?php
header('Content-Type: application/json');
require_once "./model/ProductOrder.php";
include 'db_local.php';
$output = [];

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    
    $productOrder = new ProductOrder($conn, $_GET);
    
    $stid    = $productOrder->LoadProductOrder();
    $ArrayList = [];
    while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
        $ArrayList[] = $row;
    }

    $output = ["success" => 200,
            "data"              => $ArrayList];


} else {
    $output = [
        "success" => 406,
        "msg"     => "Please Data Push GET Method",

    ];
}
echo json_encode($output);


