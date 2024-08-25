<?php

namespace ServiceProviders;
use Core\Database\Database;
use Core\ServiceProvider\ServiceProvider;
class DatabaseServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->container->singleton(Database::class, function (){
            $configs = [
                'driver'   => 'mysql',
                'host'     => '127.0.0.1',
                'port'     => '3306',
                'dbname'   => 'web_application_framework_demo',
                'charset'  => 'utf8mb4',
                'username' => 'root',
                'password' => ''
            ];
            return new Database($configs);
        });
    }
}