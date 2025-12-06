<?php
header('Content-Type: application/json');
require_once "./model/TestUser.php";
include 'db_local.php';
$posts = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $input = json_decode(file_get_contents("php://input"), true);
    if (!$input || !isset($input["NAME"]) ) {
        echo json_encode(["error" => "Invalid data"]);
        exit;
    }
    
    $testUser = new TestUser($input);

    $insert = InsertTestUser($conn, $testUser);
    if($insert){
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

function InsertTestUser($conn, $TEST_USER)
{
    $insert;
    $sql  = "INSERT INTO CRM.TEST_USER T (T.ID, T.NAME, T.EMAIL, T.PHONE_NUMBER, T.PASSWORD, T.CREATED_BY, T.RECEIVE_DATE, T.CREATED_DATE) VALUES(CRM.TEST_USER_SEQ.NEXTVAL,:NAME_STR, :EMAIL, :PHONE_NUMBER, :PASSWORD_STR, :CREATED_BY, SYSDATE, SYSDATE)";
    $stid = oci_parse($conn, $sql) or die("Connection Failed");
    oci_bind_by_name($stid, ":NAME_STR", $TEST_USER->NAME);
    oci_bind_by_name($stid, ":EMAIL", $TEST_USER->EMAIL);
    oci_bind_by_name($stid, ":PHONE_NUMBER", $TEST_USER->PHONE_NUMBER);
    oci_bind_by_name($stid, ":PASSWORD_STR", $TEST_USER->PASSWORD);
    oci_bind_by_name($stid, ":CREATED_BY", $TEST_USER->CREATED_BY);
    if (! oci_execute($stid)) {
        $e      = oci_error($stid);
        $insert = false;
    } else {
        $insert = true;
    }
    oci_commit($conn);
    return $insert;
}
