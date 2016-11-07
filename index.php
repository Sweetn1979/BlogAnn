<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include ('bootstrap.php');

//@todo необходимо написать простой роутинг по контроллерам
$query=parse_url($_SERVER['REQUEST_URI']);

$_path= explode("/", $query['path']);
$controller=$_path[1];
$action=$_path[2];

$controller=$controller."Controller";
$action="action".$action;

//require_once ("controllers/$controller.php");
require("controllers/$controller.php");
$cnt= new $controller;

$cnt->$action();