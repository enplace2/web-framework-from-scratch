<?php

use Core\Container\Container;
use ServiceProviders\DatabaseServiceProvider;

$container = new Container();

$serviceProviders = [
    DatabaseServiceProvider::class
];

foreach ($serviceProviders as $serviceProvider) {
    (new $serviceProvider($container))->register();
}


return $container;