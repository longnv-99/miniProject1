<?php
if(isset($_SESSION)){
    session_start(); 
}
require('../Model/User.php');

$data = $_POST;
// print_r( $data);
// die;
$username = $data['username'];
$password = md5($data['password']);

/**click remember or not */
if(isset($data['remember'])){
    //create cookies
   setcookie('username', $username, time() + (86400 * 30), "/");
   setcookie('password', $data['password'], time() + (86400 * 30), "/");
}else{
    setcookie('username', $username, time() - (86400 * 30), "/");
    setcookie('password', $data['password'], time() - (86400 * 30), "/");
}

//call model
$user = new User();
$result = $user->checkLogin($username, $password)->num_rows;

if($result>0){
    $_SESSION['isLogin'] = $username;
    header("location: ../View/templates/admin/index.php");
}else{
    $_SESSION['error'] = "Incorrect username or password";
    $_SESSION['data'] = $data;
    header("location: ../View/templates/admin/Login.php");
}
