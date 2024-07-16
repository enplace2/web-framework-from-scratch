<?php
require "globals/globals.php";
require "autoload.php";
use Core\Router\Router;
require "routes/routes.php";


$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$method = $_SERVER["REQUEST_METHOD"];
Router::resolve($uri, $method);