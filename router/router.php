<?php

$routes = [
    "/" => "controllers/index.php",
    "/about" => "controllers/about.php"
];

if(array_key_exists(baseUri(), $routes)){
    require($routes[baseUri()]);
}else{
    abort("Resource not found");
}