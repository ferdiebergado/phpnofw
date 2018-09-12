<?php declare(strict_types = 1);

namespace App;

require VENDOR_PATH . 'autoload.php';

error_reporting(E_ALL);

$environment = 'development';

/**
* Register the error handler
*/
$whoops = new \Whoops\Run;
if ($environment !== 'production') {
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
    $whoops->pushHandler(function($e){
        echo 'Todo: Friendly error page and send an email to the developer';
    });
}
$whoops->register();

require_once 'helpers.php';

$injector = include APP_PATH . 'Dependencies.php';

require 'router.php';
