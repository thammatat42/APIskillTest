<?php
header('Content-Type: application/json');
require_once '../inc/connect.php';


function InsertUsers($userInput) {
    global $connect;

    $firstname = $userInput['firstname'];
    $lastname = $userInput['lastname'];
    $contact = $userInput['contact'];
    $img = $userInput['img'];
    $email = $userInput['email'];
    $gender = $userInput['gender'];
    $address = $userInput['address'];

    if(empty(trim($firstname))) {
        return ErrorMsg('กรุณากรอกชื่อ');
    } elseif(empty(trim($lastname))) {
        return ErrorMsg('กรุณากรอกนามสกุล');
    } elseif(empty(trim($contact))) {
        return ErrorMsg('กรุณากรอกเบอร์โทรศัพท์');
    } elseif(empty(trim($email))) {
        return ErrorMsg('กรุณากรอกอีเมล');
    } elseif(empty(trim($gender))) {
        return ErrorMsg('กรุณาเลือกเพศ');
    } elseif(empty(trim($address))) {
        return ErrorMsg('กรุณากรอกที่อยู่');
    } else {

        // upload รูปภาพ
        // $t = microtime(true);
        // $micro = sprintf("%06d",($t - floor($t)) * 1000000);
        // $datetime = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
        // $CHG_FILES = explode(".",$_FILES["customfile"]["name"]);
        // $CHG_FILES = $datetime->format("Ymdu").'.'.$CHG_FILES[1];
        // $target_dir = "../../assets/upload/";
        // $target_file = $target_dir . basename($CHG_FILES);
        // $uploadOk = 1;
        // $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        // if (isset($_POST["upload"])) {

        //     if ($target_file == "upload/") {
        //         $msg = "cannot be empty";
        //         $uploadOk = 0;
        //     }  
        //     if (file_exists($target_file)) {
        //         $msg = "Sorry, file already exists.";
        //         $uploadOk = 0;
        //     } 
        //     if ($_FILES["customfile"]["size"] > 5000000) {
        //         $msg = "Sorry, your file is too large.";
        //         $uploadOk = 0;
        //     } 
        //     if ($uploadOk == 0) {
        //         $msg = "Sorry, your file was not uploaded.";

        //     } else {
        //         if (move_uploaded_file($_FILES["customfile"]["tmp_name"], $target_file)) {
        //             $msg = "The file " . basename($target_file) . " has been uploaded.";
        //         }
        //     }
        // }

        


        $stmt_insert = $connect->prepare("INSERT INTO tb_user (FNAME, LNAME, CONTACT, IMG, EMAIL, GENDER, ADDRESS)
        VALUES (:FNAME, :LNAME, :CONTACT, :IMG, :EMAIL, :GENDER, :ADDRESS)");
        $stmt_insert->bindParam(':FNAME', $firstname);
        $stmt_insert->bindParam(':LNAME', $lastname);
        $stmt_insert->bindParam(':CONTACT', $contact);
        $stmt_insert->bindParam(':IMG', $img);
        $stmt_insert->bindParam(':EMAIL', $email);
        $stmt_insert->bindParam(':GENDER', $gender);
        $stmt_insert->bindParam(':ADDRESS', $address);
        $INSERT_User = $stmt_insert->execute();

        if($INSERT_User) {
            $response = [
                'status' => true,
                'message' => 'Insert user Successfully'
            ];
            http_response_code(201);
            header("HTTP/1.1 201 Created");
            return json_encode($response);
        } else {
            $response = [
                'status' => false,
                'message' => 'Internal Server Error'
            ];
            http_response_code(500);
            header("HTTP/1.1 500 Internal Server Error");
            return json_encode($response);
        }
    }

}

function getUsers(){
    global $connect;


    $stmt_show_data = $connect->prepare("SELECT * FROM tb_user"); 
    $exec = $stmt_show_data->execute();

    if($exec) {

        $result_show_data = $stmt_show_data->fetchAll(PDO::FETCH_ASSOC);

        if(count($result_show_data) > 0){
            $response = [
                'status' => true,
                'response' => $result_show_data,
                'message' => 'List user Successfully'
            ];
            http_response_code(200);
            header("HTTP/1.1 200 OK");
            return json_encode($response);
    
        } else {
            $response = [
                'status' => false,
                'message' => 'Not found data'
            ];
            http_response_code(404);
            header("HTTP/1.1 404 Not found data");
            return json_encode($response);
        }

    } else {
        $response = [
            'status' => false,
            'message' => 'Internal Server Error'
        ];
        http_response_code(500);
        header("HTTP/1.1 500 Internal Server Error");
        return json_encode($response);
    }
}


function ErrorMsg($message) {
    $response = [
        'status' => false,
        'message' => $message
    ];
    http_response_code(422);
    header("HTTP/1.1 422 Unprocessable Entity");
    return json_encode($response);

}

?>