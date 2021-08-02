<?php
session_start();
session_destroy();
header("location: ../View/templates/admin/Login.php");
?>