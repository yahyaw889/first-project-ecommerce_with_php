<?php

// include "../layout/connect.php";



class catigory {

    private $db;
    
    public  function __construct() {
        $this->db = new DbConnect();
    }

    public function getCatigorys(){
        $sql  = "SELECT id,  name , img FROM catagories WHERE visabillity = 0";
        $result =  $this->db->select($sql);
        return $result;
    }
    public function getCatigory($id){
        $sql  = "SELECT  id, name  FROM catagories WHERE visabillity = 0 AND id = '$id'";
        $result =  $this->db->select($sql);
        return $result;
    }
    public function topSell(){
        $sql = "SELECT * FROM catagories JOIN item ON item.categoryID = catagories.id
        WHERE catagories.visabillity = 0
        ORDER BY sallery DESC LIMIT 10";
        $result = $this->db->select($sql);
        return $result;
    }
    public function itemImg($id) {
        $sql = "SELECT * FROM imgs WHERE itemID = '$id' LIMIT 1";
        $result = $this->db->select($sql);
        return $result;
    }
    public function itemImgs($id) {
        $sql = "SELECT * FROM imgs WHERE itemID = '$id'";
        $result = $this->db->select($sql);
        return $result;
    }
    public function someItems(){
        $sql = "SELECT * FROM catagories 
                JOIN item ON item.categoryID = catagories.id
                WHERE catagories.visabillity = 0 
                ORDER BY item.trustSeller DESC, item.rating DESC 
                LIMIT 15";
        $result = $this->db->select($sql);
        return $result;
    }
    
    public function newProducts(){
        $sql ="SELECT * FROM catagories 
                JOIN item ON item.categoryID = catagories.id
                WHERE catagories.visabillity = 0 
                ORDER BY item.date DESC 
                LIMIT 7"; 
        $result = $this->db->select($sql);
        return $result;
    }
    public function ads(){
        $sql = "SELECT * FROM ads LIMIT 7";
        $result = $this->db->select($sql);
        return $result;
    }
    public function getItem($id){
        $sql = "SELECT * FROM item WHERE id = '$id'";
        $result = $this->db->select($sql);
        return $result;
    }
    public function getSeller($id){
            $sql = "SELECT * FROM users WHERE userID = '$id'";
            $result = $this->db->select($sql);
            return $result;
    }
    public function topSellOfProduct($catID){
        $sql = "SELECT * FROM item WHERE categoryID = '$catID' LIMIT 10";
            $result = $this->db->select($sql);
            return $result;
    }
    
    
}