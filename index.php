<?php
require "globals/globals.php";
require "autoload.php";
require "routes/routes.php";

use Core\Container\Container;
use Core\Kernel\Kernel;
use Core\Database\Database;

$container = new Container();

$container->bind(Database::class, function (){
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



$kernel = new Kernel($container);
$kernel->handle()->send();