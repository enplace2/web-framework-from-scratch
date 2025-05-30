<?php

namespace Core\Router\Route;

use Closure;
use Core\Pipeline\Pipe\PipeInterface;
use Core\Response\Response;

class Route
{

    protected array $params = [];

    public function __construct(
        public string $method,
        public string $uri,
        public array  $action,
        public array  $middleware = [],
        public array  $withoutMiddleware = [],
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
            $this->withoutMiddleware[] = $middlewareClass;
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
        $params = $this->params;

        return function () use ($class, $method, $params) {
            return Response::make((new $class())->$method(...$params));
        };
    }

    public function gatherMiddleware(): array
    {
        return array_unique(array_diff($this->middleware, $this->withoutMiddleware));
    }
}