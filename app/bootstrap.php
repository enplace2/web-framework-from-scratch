<?php

use app\ServiceProviders\DatabaseServiceProvider;
use Core\Container\Container;

$container = new Container();

$serviceProviders = [
    DatabaseServiceProvider::class
];

$container->registerServiceProviders($serviceProviders);


return $container;