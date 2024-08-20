<?php

// include "../layout/connect.php";



class Order {

    private $db;
    
    public  function __construct() {
        $this->db = new DbConnect();
    }

    public function askOrder($idItem , $quantity , $idUser , $name){
        $date = date('Y-m-d H:i:s');
        $sql  = "INSERT INTO orders( name, date,  userID, itemID, count) VALUES ('$name','$date','$idUser','$idItem','$quantity')";
        $result =  $this->db->insert($sql);
        if( $result ) {
            return "success";
        }else{
            return "failed";
        }
    }
}