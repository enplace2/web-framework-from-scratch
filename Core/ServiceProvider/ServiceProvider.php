<?php

namespace Core\ServiceProvider;

use Core\Container\Container;

class ServiceProvider implements ServiceProviderInterface
{
    protected Container $container;
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function register()
    {

    }
}