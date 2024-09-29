<?php

namespace app\Middleware;
use Core\Middleware\Middleware;
use Closure;
class TestMiddleware extends Middleware
{

    public function handle(Closure $next)
    {
        dump("TestMiddleWare Before");
        $response = $next();
        dump("TestMiddleWare After");
        return $response;
    }
}