<?php
session_start();
require_once('DAO.php');
class User extends DAO{
    public $id;
    public $username;
    public $password;
    public $fullname;

    public function __construct(){
        parent::__construct();
    }

    public function checkLogin($a, $b){
        $sql = "SELECT * from user WHERE username='".$a."' AND password='".$b."'";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }
}

?>