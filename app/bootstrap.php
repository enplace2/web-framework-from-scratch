<?php

use app\ServiceProviders\DatabaseServiceProvider;
use Core\Container\Container;

$container = new Container();

$serviceProviders = [
    DatabaseServiceProvider::class
];

foreach ($serviceProviders as $serviceProvider) {
    (new $serviceProvider($container))->register();
}


return $container;