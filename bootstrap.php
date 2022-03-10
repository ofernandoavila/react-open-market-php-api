<?php

require_once 'config.php';

spl_autoload_register(function($className) {
    if(file_exists('core/' . $className . '.php')) {
        require_once 'core/' . $className . '.php';
    } else if (file_exists('model/' . $className . '.php')) {
        require_once 'model/' . $className . '.php';
    } else if (file_exists('libraries/' . $className . '.php')) {
        require_once 'libraries/' . $className . '.php';
    }
});
