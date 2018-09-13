<?php declare(strict_types = 1);

namespace App;

require VENDOR_PATH . 'autoload.php';
require_once 'helpers.php';

/**
* Register the error handler
*/
if (config('env') === 'dev') {
    error_reporting(E_ALL);
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
    $whoops->pushHandler(function($e){
        echo 'Todo: Friendly error page and send an email to the developer';
    });
}
$whoops->register();

$container = require 'container.php';

require 'router.php';

return $container;
