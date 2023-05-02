<?php 
session_start();
error_reporting(E_ALL); 

/* On production */
// error_reporting(0);

date_default_timezone_set('Asia/Bangkok');

class Database {
  
    private $host = "localhost";
    private $dbname = "demo_api";
    private $username = "baadmin";
    private $password = "7WlwsbPCuLa2yli5";
    private $conn = null;

    public function connect() {
        try{
            /** PHP PDO */
            $this->conn = new PDO('mysql:host='.$this->host.'; 
                                dbname='.$this->dbname.'; 
                                charset=utf8', 
                                $this->username, 
                                $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "เชื่อมต่อสำเร็จ";
        }catch(PDOException $exception){
            echo "Can't connect DB: " . $exception->getMessage();
            exit();
        }
        return $this->conn;
    }
}

/**
 * ประกาศ Instance ของ Class Database
 */
$Database = new Database();
$connect = $Database->connect();
