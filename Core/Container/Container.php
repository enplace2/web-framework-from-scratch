<?php

namespace Core\Container;

use Closure;
use Core\ServiceProvider\ServiceProviderInterface;

class Container
{
    protected array $bindings = [];
    protected array $singletons = [];
    public function bind(string $abstract, Closure $concrete, $singleton = false): void
    {
        $this->bindings[$abstract] = [
            "concrete"  => $concrete,
            "singleton" => $singleton,
        ];
    }

    public function singleton(string $abstract, Closure $concrete): void
    {
        $this->bind($abstract, $concrete, true);
    }

    public function resolve(string $abstract)
    {
        if(array_key_exists($abstract, $this->singletons))
        {
            return $this->singletons[$abstract];
        }
        else return $this->build($abstract);
    }

    protected function build(string $abstract)
    {
        $bindings = $this->bindings[$abstract];

        if($bindings["singleton"] === true){
            $this->singletons[$abstract] = $bindings["concrete"]();
            return $this->singletons[$abstract];
        }
        return $bindings["concrete"]();
    }

    public function registerServiceProviders(array $serviceProviders): void
    {
        foreach ($serviceProviders as $serviceProvider) {
            $serviceProvider = new $serviceProvider($this);
            $this->register($serviceProvider);
        }

    }
    protected function register(ServiceProviderInterface $serviceProvider): void
    {
        $serviceProvider->register();
    }
}