<?php

namespace Core\Router\Route;

use Core\Middleware\MiddlewareInterface;

class Route
{
    public function __construct(
        public string $method,
        public string $uri,
        public array  $action,
        public array  $middleware = [],
        public array $excludedMiddleware =[]
    )
    {
    }
    /**
     * Add middleware to the route.
     *
     * @param array<string<MiddlewareInterface>> $middlewareClasses
     * @return static
     */
    public function middleware(array $middlewareClasses): static
    {
        foreach ($middlewareClasses as $middlewareClass) {
            $this->middleware[] = $middlewareClass;
        }
        return $this;
    }

    /**
     * Add middleware to be excluded from the route.
     *
     * @param array<string<MiddlewareInterface>> $middlewareClasses
     * @return static
     */
    public function withoutMiddleware(array $middlewareClasses): static
    {
        foreach ($middlewareClasses as $middlewareClass) {
            $this->excludedMiddleware[] = $middlewareClass;
        }
        return $this;
    }
}