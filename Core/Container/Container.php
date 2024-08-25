<?php

namespace Core\Container;

use Closure;

class Container
{
    protected array $bindings = [];
    protected array $singletons = [];
    public function bind(string $abstract, string|Closure|null $concrete = null, $singleton = false): void
    {
        if(!$concrete) $concrete = $abstract;
        $this->bindings[$abstract] = [
            "concrete"  => $concrete,
            "singleton" => $singleton,
        ];
    }

    public function singleton(string $abstract, string|Closure|null $concrete = null): void
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
            $this->singletons[$abstract] = $this->instantiate($abstract, $bindings["concrete"]);
            return $this->singletons[$abstract];
        }
        return $this->instantiate($abstract, $bindings["concrete"]);
    }

    protected function instantiate($abstract, $concrete)
    {
        if(is_callable($concrete)){
            return $concrete();
        }
        throw new \Exception("Instantiation failed. Closure provided for $abstract is not callable");
    }
}