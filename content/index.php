<?php
require "../load.php";
use Src\Controller\UserController;
use Src\Services\UserService;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");




$requestMethod = $_SERVER["REQUEST_METHOD"];
// pass the request method and user ID to the UserController:
$controller = new UserController($requestMethod, $userId);
$controller->processRequest();

?>
