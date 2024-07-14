<?php

$dbConfigs = require "config.php";


$id = $_GET["id"];
$query = "select * from notes where id = :id";

$db = new Database($dbConfigs["database"]);
$note = $db->query($query, ["id" => $id])->fetch();

if(!$note) abort("Resource not found", 403);

if($note["user_id"]!== 1) abort("Unauthorized");

$title = $note["title"];


require "views/note.view.php";