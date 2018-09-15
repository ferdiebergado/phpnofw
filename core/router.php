<?php

$routeDefinitionCallback = function (\FastRoute\RouteCollector $r) {
    $routes = require( CONFIG_PATH . 'routes.php');
    foreach ($routes as $route) {
        $r->addRoute($route[0], $route[1], $route[2]);
    }
};

$dispatcher = \FastRoute\cachedDispatcher($routeDefinitionCallback, [
    'cacheFile' => TMP_PATH . '/route.cache', /* required */
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
        return view('404', compact('title'));
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        return view('404', compact('title'));
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
