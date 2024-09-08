<?php
require_once "Core/globals/globals.php";
require_once "autoload.php";
require_once "app/routes/routes.php";

use Core\Kernel\Kernel;

$container = require_once "./app/bootstrap.php";
$_SESSION["TEST"] = "WHHHAAAA";
$_SESSION["TEST2"] = ["some data" => ["some nested data"=> 3]];

dd($_SESSION);

$kernel = new Kernel($container);
$kernel->handle()->send();