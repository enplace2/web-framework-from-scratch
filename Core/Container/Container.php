<?php

namespace Core\Container;

use Closure;

class Container
{
    protected array $bindings = [];
    protected array $singletons = [];
    public function bind(string $abstract, string|Closure|null $concrete = null): void
    {
        if(!$concrete) $concrete = $abstract;
        $this->bindings[$abstract] = $concrete;
    }

    public function resolve(string $abstract)
    {
        if(array_key_exists($abstract, $this->singletons))
        {
            return $this->singletons[$abstract];
        }
        else return $this->build($this->bindings[$abstract]);
    }

    public function build($concrete)
    {
        if(is_callable($concrete)){
            return $concrete();
        }

    }
}