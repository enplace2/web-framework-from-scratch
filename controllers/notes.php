<?php
$title = "Notes";

$dbConfigs = require "config.php";


//$id = $_GET["user_id"];
$query = "select * from notes where user_id = :user_id";

$db = new Database($dbConfigs["database"]);
$notes = $db->query($query, ["user_id" => 1])->fetchAll();



require "views/notes.view.php";