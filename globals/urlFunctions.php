<?php

function urlIs($value){
    return requestUri() === $value;
}

function requestUri(){
    return $_SERVER["REQUEST_URI"];
}

function baseUri(){
    return parse_url($_SERVER["REQUEST_URI"])["path"];
}

function abort($message){
    http_response_code(404);
    echo $message;
    die();
}