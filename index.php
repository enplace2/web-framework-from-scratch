<?php
require_once "globals/globals.php";
require_once "autoload.php";
require_once "routes/routes.php";

use Core\Kernel\Kernel;

$container = require_once "./app/bootstrap.php";

$kernel = new Kernel($container);
$kernel->handle()->send();