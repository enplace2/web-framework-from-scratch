<?php
require "globals/globals.php";
require "autoload.php";
require "routes/routes.php";

use Core\Kernel\Kernel;

$kernel = new Kernel();
$kernel->handle()->send();