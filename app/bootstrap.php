<?php
//config
require_once 'config/config.php';
//lib
//require_once 'libraries/controler.php';
//require_once 'libraries/core.php';
//require_once 'libraries/database.php';
//autolaod core lib
spl_autoload_register(function ($className) {
    require_once 'libraries/' . $className . '.php';
});
