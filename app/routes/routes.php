<?php

use app\Controllers\PostController;
use app\Controllers\TestController;
use app\Middleware\TestMiddleware;
use app\Middleware\TestMiddleware2;
use app\Middleware\TestMiddleware3;
use Core\Router\Router;

Router::group(function () {
    Router::get("/", [TestController::class, 'test'])->middleware([TestMiddleware2::class]);
    /*First nested group*/
    Router::group(function () {
        Router::get("/hello", [TestController::class, 'test2']);
        /*Second nested group*/
        Router::group(function () {
            Router::get("/hello/{id}", [TestController::class, 'testWildCard']);
            Router::get("/hello/{id}/{id2}", [TestController::class, 'testWildCard2'])->withoutMiddleware([TestMiddleware2::class]);
        })->middleware([TestMiddleware3::class])
            //->withoutMiddleware([TestMiddleware2::class])
            ->create();

    })->middleware([TestMiddleware2::class])->create();




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
})
    ->middleware([TestMiddleware::class])
    //->withoutMiddleware([TestMiddleware::class])
    ->create();



