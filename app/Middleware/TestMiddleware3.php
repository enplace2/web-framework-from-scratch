<?php

namespace app\Middleware;
use Core\Middleware\Middleware;
use Closure;
class TestMiddleware3 extends Middleware
{

    public function handle(Closure $next)
    {
        dump("TestMiddleWare3 Before");
        $response = $next();
        dump("TestMiddleWare3 After");
        return $response;
    }
}