<?php

spl_autoload_register(function($_class){
    $classLocations = array("configs","controllers","core","models","repositories");
    foreach ($classLocations as $classDir){
        $classPath = __DIR__."/{$classDir}/{$_class}.php";
        if(file_exists($classPath)) {
            require_once $classPath;
        }
    }
});