<?php

use Controllers\TestController;
use Core\Router\Router;

Router::get("/", [TestController::class, 'test']);
Router::get("/hello", [TestController::class, 'test2']);