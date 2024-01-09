<?php
    include_once 'config'.DIRECTORY_SEPARATOR.'config.php';
    spl_autoload_register(function ($class) {
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        $path = '..'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.$class . '.php';

        if (file_exists($path)) {
            include_once $path;
            return true;
        }
        return false;
    });
    try {
        \core\Router::init();
    }catch (\Exception $e) {
        echo $e->getMessage();
    }
