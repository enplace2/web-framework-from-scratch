<?php

namespace Core\ServiceProvider;

interface ServiceProviderInterface
{

    public function register();
    public function boot();

}