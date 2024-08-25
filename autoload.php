<?php

function autoload(string $class)
{
    // Base directory for the application
    $base_dir = __DIR__ . '/';

    // Convert the namespace to a file path
    $file = $base_dir . str_replace('\\', '/', $class) . '.php';

    // If the file exists, require it
    if (file_exists($file)) {
        require $file;
        return true;
    }

    return false;
}

spl_autoload_register('autoload');