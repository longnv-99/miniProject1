<?php
session_start();
session_destroy();
setcookie('username', $username, time() - (86400 * 30), "/");
setcookie('password', $password, time() - (86400 * 30), "/");
header("location: ../View/templates/admin/Login.php");
?>