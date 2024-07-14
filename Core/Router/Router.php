<?php
namespace Core\Router;
class Router {
    protected static array $routes = [];

    public static function get(string $uri, array $action) :void
    {
        self::addRoute("GET", $uri, $action);
    }
    public static function put(string $uri, array $action):void
    {
        self::addRoute("PUT", $uri, $action);
    }
    public static function patch(string $uri, array $action) :void
    {
        self::addRoute("PATCH", $uri, $action);
    }
    public static function delete(string $uri, array $action) :void
    {
        self::addRoute("DELETE", $uri, $action);
    }
    public static function addRoute(string $method, string $uri, array $action) :void
    {
        self::$routes[] =[
            "method" => $method,
            "uri" => $uri,
            "action" => $action,
        ];
    }

    public static function getRoutes(): array
    {
        return self::$routes;
    }
}