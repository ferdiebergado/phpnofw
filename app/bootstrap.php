<?php declare(strict_types = 1);

namespace App;

require VENDOR_PATH . 'autoload.php';
require_once 'helpers.php';

/**
* Register the error handler
*/
$whoops = new \Whoops\Run;
if (config('env') === 'dev') {
    error_reporting(E_ALL);
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
    $whoops->pushHandler(function($e){
        echo 'Todo: Friendly error page and send an email to the developer';
    });
}
$whoops->register();

$injector = include APP_PATH . 'Dependencies.php';

require 'router.php';

return $injector;
