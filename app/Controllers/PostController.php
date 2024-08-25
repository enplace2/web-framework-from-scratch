<?php
namespace app\Controllers;

use Core\Database\Database;

class PostController{
    public function index(){
        $db = app(Database::class);
        return $db->get("select * from posts");
    }

    public function show($id){
//        $db1 = app(Database::class);
//        $db2 = app(Database::class);
//        $db3 = app(Database::class);
//        $configs = [
//            'driver'   => 'mysql',
//            'host'     => '127.0.0.1',
//            'port'     => '3306',
//            'dbname'   => 'web_application_framework_demo',
//            'charset'  => 'utf8mb4',
//            'username' => 'root',
//            'password' => ''
//        ];
//        $db = new Database($configs);
//
//        echo "Object ID of db1: " . spl_object_id($db1) . "\n";
//        echo "Object ID of db2: " . spl_object_id($db2) . "\n";
//        echo "Object ID of db3: " . spl_object_id($db3) . "\n";
//        echo "Object ID of db: " . spl_object_id($db) . "\n";
//        dd($db);


        $db = app(Database::class);

        return $db->fetch("select * from posts where id = :id", ["id"=>$id]);
    }
}