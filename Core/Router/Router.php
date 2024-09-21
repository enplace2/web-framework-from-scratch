<?php

namespace Core\Router;

use Closure;
use Core\Router\Route\Route;

class Router
{
    protected static array $routes = [];

    public static function listRoutes(): array
    {
        return static::$routes;
    }

    public static function get(string $uri, array $action): Route
    {
        return static::addRoute("GET", $uri, $action);
    }

    public static function post(string $uri, array $action): Route
    {
        return static::addRoute("POST", $uri, $action);
    }

    public static function put(string $uri, array $action): Route
    {
        return static::addRoute("PUT", $uri, $action);
    }

    public static function patch(string $uri, array $action): Route
    {
        return static::addRoute("PATCH", $uri, $action);
    }

    public static function delete(string $uri, array $action): Route
    {
        return static::addRoute("DELETE", $uri, $action);
    }

    public static function addRoute(string $method, string $uri, array $action): Route
    {
        $route = new Route(
            method: $method,
            uri: $uri,
            action: $action,
        );
        static::$routes[$method][] = $route;
        return $route;
    }

    /**
     * @throws \Exception
     */
    public static function resolve(string $requestUri, string $requestMethod): Route
    {
        foreach (static::$routes[$requestMethod] as $route) {
            $params = [];
            if (static::match($route->uri, $requestUri, $params)) {
                return $route->setParams($params);
            }
        }

        abort("Requested Resource Not Found");
    }

    protected static function match(string $routeUri, string $requestUri, &$params): bool
    {
        // Convert route URI with placeholders to regex pattern
        $pattern = preg_replace('/\{[^\}]+\}/', '([^/]+)', $routeUri);
        $pattern = "/^" . str_replace('/', '\/', $pattern) . "$/";

        if (preg_match($pattern, $requestUri, $matches)) {
            array_shift($matches); // Remove the full match
            $params = $matches;
            return true;
        }

        return false;
    }



}