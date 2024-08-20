<?php





class logging {

    private $db;
    
    public  function __construct() {
        $this->db = new DbConnect();
    }

    public function loginCheck($username , $pass){
        $sql  = "SELECT userID , username , password FROM users WHERE username = '$username'  and password = '$pass' LIMIT 1";
        $result =  $this->db->select($sql);
        return $result;
    }
}