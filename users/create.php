<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');


$requestMethod = $_SERVER["REQUEST_METHOD"];

switch($requestMethod) {
    case 'POST':
        include_once './function.php';

        $data = json_decode(file_get_contents("php://input"), true);

        if(empty($data)) {
            $response = InsertUsers($_POST);
        } else {
            $response = InsertUsers($data);
        }

        echo $response;
        break;
    default:
        header("HTTP/1.1 405 Method Not Allowed");
        break;
}
?>