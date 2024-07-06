<?php

require "classes/Database.php";

require "globals/globals.php";
$dbConfigs = require "config.php";


$query = "select * from posts";

$db = new Database($dbConfigs["database"]);
$q  = $db->query($query)->fetchAll();
dd($q);


require "router/router.php";