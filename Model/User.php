<?php
session_start();
require_once('DAO.php');
class User extends DAO{

    public function __construct(){
        parent::__construct();
    }

    public function checkLogin($username, $password){
        $sql = "SELECT * from user WHERE username='$username'";
        $result = mysqli_query($this->conn, $sql);
        $count = $result->num_rows;
        if($count>0){
            while($row = mysqli_fetch_assoc($result)){
                if(password_verify($password, $row['password'])){
                    return true;
                }
            }
        }else return false;
    }

    function insert(){
        $username = 'thinh';
        $password = password_hash('123', PASSWORD_DEFAULT);
        $sql = "insert into user (username, password) values ('$username', '$password')";
        $result = mysqli_query($this->conn, $sql);
        echo $result;
    }
    //cng phải insert thê này à
}

// $u = new User();
// $u->insert();

?>