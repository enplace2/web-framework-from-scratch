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

    public static function resolve(string $requestUri, string $requestMethod)
    {
        foreach (self::$routes as $route)
        {
            if($route["uri"]=== $requestUri && $requestMethod=== $route["method"]){
                return self::callAction($route["action"]);
            }
        }

        abort("Requested Resource Not Found");
    }

    public static function getRoutes(): array
    {
        return self::$routes;
    }
    protected static function callAction(array $action)
    {
        list ($class, $method) = $action;
        if(!class_exists($class)) {
            throw new \Exception("Method $method not found on class $class");
        }

        if(!method_exists($class, $method)) {
            throw new \Exception("Method $method not found on class $class");
        }

        return (new $class())->$method();
    }


}