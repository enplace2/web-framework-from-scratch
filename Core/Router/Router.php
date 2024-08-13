<?php
namespace Core\Router;
use Core\Response\Response;

class Router {
    protected static array $routes = [];

    public static function listRoutes(): array
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

    /**
     * @throws \Exception
     */
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

    /**
     * Calls the method of the controller class provided with params.
     * Handles returning the response via the Response class.
     * @param array $action
     * @param array $params
     * @return mixed
     * @throws \Exception
     */
    protected static function callAction(array $action, array $params)
    {
        list ($class, $method) = $action;
        //Todo: should create specific exception classes for these
        if(!class_exists($class)) {
            throw new \Exception("Class $class not found");
        }

        if(!method_exists($class, $method)) {
            throw new \Exception("Method $method not found on class $class");
        }

        return (new $class())->$method(...$params);
    }


}