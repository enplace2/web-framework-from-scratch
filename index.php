<?php

require "classes/Database.php";
require "globals/globals.php";
$session = session_start();
$_SESSION["Key"] = "value";
dd($_SESSION["Key"]);
$dbConfigs = require "config.php";



require "router/router.php";