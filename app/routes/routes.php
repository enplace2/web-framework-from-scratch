<?php

use app\Controllers\PostController;
use app\Controllers\TestController;
use app\Middleware\TestMiddleware;
use Core\Router\Router;



Router::get("/", [TestController::class, 'test'])
    ->middleware([TestMiddleware::class])
    ->withoutMiddleware([TestMiddleware::class]);
Router::get("/hello", [TestController::class, 'test2']);
Router::get("/hello/{id}", [TestController::class, 'testWildCard']);
Router::get("/hello/{id}/{id2}", [TestController::class, 'testWildCard2']);

Router::get('/string', [TestController::class, 'stringResponse']);
Router::get('/json', [TestController::class, 'jsonResponse']);
Router::get('/custom', [TestController::class, 'customResponse']);
Router::get('/assoc-array', [TestController::class, 'assocArrayResponse']);
Router::get('/array', [TestController::class, 'arrayResponse']);
Router::get('/model', [TestController::class, 'modelResponse']);
Router::get('/posts', [PostController::class, 'index']);
Router::get('/posts/{id}', [PostController::class, 'show']);
Router::get('/posts/{id}', [PostController::class, 'show']);
Router::get('/posts/{id}', [PostController::class, 'show']);

