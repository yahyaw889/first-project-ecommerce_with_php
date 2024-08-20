<?php
require_once "../config/config.php";

class DbConnect {
    public $host = HOST;
    public $user = USER;
    public $password = PASSWORD;
    public $database = DATABASE;
    public $conn;
    public $err;

    public function __construct(){
        $this->connect();    
    }

    public function connect(){
        $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function insert($query){
        $result = mysqli_query($this->conn , $query);

        if (!$result) {
            $this->err = mysqli_error($this->conn);
            return false;
        } else {
            return $result;
        }
    }
    public function select($query){
        $result = mysqli_query($this->conn , $query);

        if (!$result) {
            $this->err = mysqli_error($this->conn);
            return false;
        } else {
            return $result;
        }
    }
    public function update($query){
        $result = mysqli_query($this->conn , $query);
        if(!$result){
            $this->err = mysqli_error($this->conn);
        }else{
            return $result ;
        }
    }
    public function delete($query){
        $result = mysqli_query($this->conn , $query);
        if(!$result){
            $this->err = mysqli_error($this->conn);
        }else{
            return $result ;
        }
    }
}