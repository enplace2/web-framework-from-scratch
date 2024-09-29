<?php

namespace Core\Router\RouteGroup;

use Closure;

class RouteGroup
{
    public array $middleware = [];
    public array $withoutMiddleware = [];

    public function __construct(
        protected Closure $createGroup
    )
    {
    }

    public function middleware(array $middleware): static
    {
        $this->middleware = $middleware;
        return $this;
    }

    public function withoutMiddleware(array $middleware): static
    {
        $this->withoutMiddleware = $middleware;
        return $this;
    }

    public function create(): void
    {
        ($this->createGroup)();
    }
}