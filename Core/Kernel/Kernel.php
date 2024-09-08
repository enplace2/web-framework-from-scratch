<?php

namespace Core\Kernel;

use Core\Container\Container;
use Core\Response\Response;
use Core\Router\Router;

class Kernel
{
    // make a request instance
    // handle the request
    // send the request
    protected $response;

    protected static Container $container;

    public function __construct(Container $container)
    {
        self::$container = $container;
    }

    public static function container(){
        return self::$container;
    }

    public function handle(): Kernel
    {
        $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $method = $_SERVER["REQUEST_METHOD"];
        $this->response = Response::make(Router::resolve($uri, $method));
        return $this;
    }

    public function send(): void
    {
        $this->response->send();
    }

}