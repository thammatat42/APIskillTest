<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');


$requestMethod = $_SERVER["REQUEST_METHOD"];

switch($requestMethod) {
    case 'PUT':
        include_once './function.php';

        $data = json_decode(file_get_contents("php://input"), true);

       
        $response = UpdateUsers($data, $_GET);

        echo $response;
        break;
    default:
        header("HTTP/1.1 405 Method Not Allowed");
        break;
}
?>