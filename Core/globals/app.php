<?php

use Core\Kernel\Kernel;

function app($abstract){
    $container = Kernel::container();
    return $container->resolve($abstract);
}