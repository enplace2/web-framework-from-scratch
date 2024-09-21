<?php

namespace Core\Router\Route;

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

    public function setMiddleware(array $middlewareClasses)
    {
        $this->middleware = $middlewareClasses;
        return $this;
    }

    public function middleware(string $middlewareClass)
    {
        $this->middleware[] = $middlewareClass;
        return $this;
    }

    public function setExcludedMiddleware(array $middlewareClasses){
        $this->excludedMiddleware = $middlewareClasses;
        return $this;
    }
    public function withoutMiddleware(string $middlewareClass)
    {
        $this->excludedMiddleware[] = $middlewareClass;
        return $this;
    }
}