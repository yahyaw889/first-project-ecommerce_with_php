<?php

class Carts {

private $db;

public  function __construct() {
    $this->db = new DbConnect();
}

public function itemImg($id) {
    $sql = "SELECT * FROM imgs WHERE itemID = '$id' LIMIT 1";
    $result = $this->db->select($sql);
    return $result;
}
public function getItem($id){
    $sql = "SELECT * FROM item WHERE id = '$id'";
    $result = $this->db->select($sql);
    return $result;
}
}