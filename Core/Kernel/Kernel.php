<?php

namespace Core\Kernel;

use Closure;
use Core\Container\Container;
use Core\Pipeline\Pipeline;
use Core\Response\Response;
use Core\Router\Router;

class Kernel
{
    // make a request instance
    // handle the request
    // send the request
    protected Response $response;

    protected static Container $container;

    public function __construct(Container $container)
    {
        self::$container = $container;
    }

    public static function container()
    {
        return self::$container;
    }

    public function handle(): Kernel
    {
        $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $method = $_SERVER["REQUEST_METHOD"];

        $route = Router::resolve($uri, $method);

        (new Pipeline())->run($route->getAction())
            ->through($route->middleware)
            ->send()
            ->then($this->setResponse());

        return $this;
    }

    public function send(): void
    {
        $this->response->send();
    }

    protected function setResponse(): Closure
    {
        return function (Response $response) {
            $this->response = $response;
        };
    }


}