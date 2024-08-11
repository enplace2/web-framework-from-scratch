<?php

use Controllers\TestController;
use Core\Router\Router;

Router::get("/", [TestController::class, 'test']);
Router::get("/hello", [TestController::class, 'test2']);
Router::get("/hello/{id}", [TestController::class, 'testWildCard']);
Router::get("/hello/{id}/{id2}", [TestController::class, 'testWildCard2']);