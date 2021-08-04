<?php
class LoginController{
    public function checkLogin(){
        if(!isset($_SESSION)){
            session_start(); 
        }
        require_once('Model/User.php');
        
        $data = $_POST;
        $username = $data['username'];
        $password = $data['password'];
        $password_encrypt = password_hash($password, PASSWORD_DEFAULT);
        
        /**click remember or not */
        if(isset($data['remember'])){
            //create cookies
           setcookie('username', $username, time() + (86400 * 30), "/");
           setcookie('password', $password_encrypt, time() + (86400 * 30), "/");
        }
        
        //call model
        $user = new User();
        $result = $user->checkLogin($username, $password);
        
        if($result){
            $_SESSION['isLogin'] = $username;
            header("location: http://localhost/miniProject1/View/templates/admin/index.php");
        }else{
            $_SESSION['error'] = "Incorrect username or password";
            $_SESSION['data'] = $data;
            header("location: http://localhost/miniProject1/View/templates/admin/Login.php");
        }
        
    }
}