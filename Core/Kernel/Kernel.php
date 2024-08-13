<?php

namespace Core\Kernel;

use Core\Response\Response;
use Core\Router\Router;

class Kernel
{
    // make a request instance
    // handle the request
    // send the request
    protected $response;

    public function handle(): Kernel
    {
        $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $method = $_SERVER["REQUEST_METHOD"];

        $this->response = Response::make(Router::resolve($uri, $method));
        return $this;
    }

    public function send() {
        $this->response->send();
    }
}