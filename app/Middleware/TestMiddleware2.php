<?php

namespace app\Middleware;
use Core\Middleware\Middleware;
use Closure;
class TestMiddleware2 extends Middleware
{

    public function handle(Closure $next)
    {
        dump("TestMiddleWare2 Before");
        $response = $next();
        dump("TestMiddleWare2 After");
        return $response;
    }
}