<?php

namespace Core\Router\Route;

use Closure;
use Core\Pipeline\Pipe\PipeInterface;

class Route
{
    public array $middleware = [];
    public array $excludedMiddleware = [];
    protected array $params = [];

    public function __construct(
        public string $method,
        public string $uri,
        public array  $action,
    )
    {
    }

    /**
     * Add middleware to the route.
     *
     * @param array<string<PipeInterface>> $middlewareClasses
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
     * @param array<string<PipeInterface>> $middlewareClasses
     * @return static
     */
    public function withoutMiddleware(array $middlewareClasses): static
    {
        foreach ($middlewareClasses as $middlewareClass) {
            $this->excludedMiddleware[] = $middlewareClass;
        }
        return $this;
    }

    public function setParams(array $params)
    {
        $this->params = $params;
        return $this;
    }

    /**
     * Returns the route action with the proided params
     * @return Closure
     * @throws \Exception
     */
    public function getAction(): Closure
    {
        list ($class, $method) = $this->action;
        //Todo: should create specific exception classes for these
        if (!class_exists($class)) {
            throw new \Exception("Class $class not found");
        }

        if (!method_exists($class, $method)) {
            throw new \Exception("Method $method not found on class $class");
        }

        return function () use ($class, $method){
            return (new $class())->$method(...$this->params);
    };
    }
}