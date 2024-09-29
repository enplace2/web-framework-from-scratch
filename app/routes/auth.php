<?php

use app\Controllers\AuthenticationController;
use Core\Router\Router;

Router::post('/register', [AuthenticationController::class, 'register']);
Router::post('/login', [AuthenticationController::class, 'login']);
Router::post('/logout', [AuthenticationController::class, 'logout']);