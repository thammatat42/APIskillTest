<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');


$requestMethod = $_SERVER["REQUEST_METHOD"];

switch($requestMethod) {
    case 'GET':
        include_once './function.php';

        if(isset($_GET['id'])){
            $response = getUser($_GET);
        } else {
            $response = getUsers();

        }
        echo $response;
        break;
    default:
        header("HTTP/1.1 405 Method Not Allowed");
        break;
}
?>