<?php

$routeDefinitionCallback = function (\FastRoute\RouteCollector $r) {
    $routes = require_once( CONFIG_PATH . 'routes.php');
    foreach ($routes as $route) {
        $r->addRoute($route[0], $route[1], $route[2]);
    }
};

$dispatcher = \FastRoute\cachedDispatcher($routeDefinitionCallback, [
    'cacheFile' => '/tmp/route.cache', /* required */
    'cacheDisabled' => config('debug_mode'),     /* optional, enabled by default */
]);

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}

$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
$title = 'Page not found';

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        require VIEW_PATH . '404.php';
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        require VIEW_PATH . '404.php';
        break;
    case FastRoute\Dispatcher::FOUND:
        $className = $routeInfo[1][0];
        $method = $routeInfo[1][1];
        $vars = $routeInfo[2];
        $class = $container->create($className);
        // $class = new $className;
        $class->$method($vars);
        break;
}
