<?php
namespace Core\Router;
class Router {
    protected static array $routes = [];

    public static function getRoutes(): array
    {
        return self::$routes;
    }
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
        foreach (self::$routes as $route) {
            $params = [];

            if ($requestMethod === $route["method"] && self::match($route["uri"], $requestUri, $params)) {
                // Pass the extracted parameters to callAction
                return self::callAction($route["action"], $params);
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
    protected static function callAction(array $action, array $params)
    {
        list ($class, $method) = $action;
        if(!class_exists($class)) {
            throw new \Exception("Class $class not found");
        }

        if(!method_exists($class, $method)) {
            throw new \Exception("Method $method not found on class $class");
        }

        return (new $class())->$method(...$params);
    }


}