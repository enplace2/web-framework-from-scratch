<?php
namespace Controllers;

use Core\Database\Database;

class PostController{
    public function index(){
        $db = app(Database::class);
        $statement = $db->get("select * from posts");
        return $statement;
    }

    public function show($id){
        $db = app(Database::class);
        $statement = $db->fetch("select * from posts where id = :id", ["id"=>$id]);
        return $statement;
    }
}