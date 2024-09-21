<?php

namespace Core\Middleware;

use Closure;

interface MiddlewareInterface
{
    public function handle(Closure $next);
}