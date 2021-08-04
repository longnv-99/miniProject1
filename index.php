<?php

$controller = $_REQUEST['controller'];
$action = $_REQUEST['action'];

$controllerName = $controller.'Controller';
require_once('Controller/'.$controllerName.'.php');

$controller = new $controllerName();
$controller->$action();

?>