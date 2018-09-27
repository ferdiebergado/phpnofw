<?php
/*** Application Router ***/

use Lead\Router\Router;

$router = new Router();

// Bind to all methods
$router->bind('foo/bar', function() {
    return "Hello World!";
});

// Bind to POST and PUT at dev.example.com only
$router->bind('foo/bar/edit', ['methods' => ['POST',' PUT'], 'host' => 'dev.example.com'], function() {
    return "Hello World!!";
});

// The Router class makes no assumption of the ingoing request, so you have to pass
// uri, methods, host, and protocol into `->route()` or use a PSR-7 Compatible Request.
// Do not rely on $_SERVER, you must check or sanitize it!
$route = $router->route(
    $_SERVER['REQUEST_URI'], // foo/bar
    $_SERVER['REQUEST_METHOD'], // get, post, put...etc
    $_SERVER['HTTP_HOST'], // www.example.com
    $_SERVER['SERVER_PROTOCOL'] // http or https
);

echo $route->dispatch(); // Can throw an exception if the route is not valid.
