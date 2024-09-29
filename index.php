<?php
require_once "Core/globals/globals.php";
require_once "autoload.php";
require_once "app/routes/routes.php";
require_once "app/routes/auth.php";

use Core\Kernel\Kernel;

$container = require_once "./app/bootstrap.php";
$kernel = new Kernel($container);
$kernel->handle()->send();