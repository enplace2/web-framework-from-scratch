<?php

namespace app\ServiceProviders;
use Core\Database\Database;
use Core\ServiceProvider\ServiceProvider;
use Core\SessionHandlers\DatabaseSessionHandler;

class SessionHandlerServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->container->singleton(DatabaseSessionHandler::class, function(){
            $db = $this->container->resolve(Database::class);
            return new DatabaseSessionHandler($db);
        });
    }

    public function boot():void
    {
        session_set_save_handler($this->container->resolve(DatabaseSessionHandler::class));
        session_start();
    }
}