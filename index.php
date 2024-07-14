<?php
require "globals/globals.php";
require "autoload.php";
use Core\Router\Router;
require "routes/routes.php";

dd(Router::getRoutes());