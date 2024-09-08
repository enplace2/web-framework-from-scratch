<?php

use app\ServiceProviders\DatabaseServiceProvider;
use app\ServiceProviders\SessionHandlerServiceProvider;
use Core\Container\Container;

$container = new Container();

$serviceProviders = [
    DatabaseServiceProvider::class,
    SessionHandlerServiceProvider::class,
];

$container->registerServiceProviders($serviceProviders);
$container->bootServiceProviders($serviceProviders);

return $container;