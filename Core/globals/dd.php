<?php
function dd($value){
    dump($value);
    die();
}

function dump($value){
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
}