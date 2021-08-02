<?php

$controller = $_GET['controller'];
$action = $_REQUEST['action'];

$controllerName = $controller.'Controller';
require_once('Controller/'.$controllerName.'.php');

$controller = new $controllerName();
$controller->$action(); //call method of controller

?>