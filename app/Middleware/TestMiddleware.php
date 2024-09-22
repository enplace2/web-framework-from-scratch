<?php

namespace app\Middleware;
use Core\Middleware\Middleware;
use Closure;
class TestMiddleware extends Middleware
{

    public function handle(Closure $next)
    {
        $response = $next();
        $response->setContent(["alsdkjfalñdskjf"=>"TEST"]);
        return $response;
    }
}