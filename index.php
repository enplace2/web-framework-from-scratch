<?php
require "globals/globals.php";
require "autoload.php";
require "routes/routes.php";

use Core\Kernel\Kernel;
use Core\Database\Database;

$configs = [
    'driver'   => 'mysql',
    'host'     => '127.0.0.1',
    'port'     => '3306',
    'dbname'   => 'web_application_framework_demo',
    'charset'  => 'utf8mb4',
    'username' => 'root',
    'password' => ''
];
$db = new Database($configs);

$statement = $db->get("select * from posts where id = :id", ["id"=>3]);
$statement = $db->get("select * from posts");


dd($statement);
$kernel = new Kernel();
$kernel->handle()->send();