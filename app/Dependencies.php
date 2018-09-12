<?php declare(strict_types = 1);

namespace App;

$db = require(CONFIG_PATH . 'database.php');
$dsn = "mysql:host=". $db['host'] . ";port=" . $db['port'] . ";dbname=" . $db['dbname'] . ";charset=" . $db['charset'];

$injector = new \Auryn\Injector;

$injector->define('PDO', [
    ':dsn' => $dsn,
    ':username' => $db['username'],
    ':passwd' => $db['password'],
    ':options' => $db['options']
]);
$injector->share('PDO');

use \Symfony\Component\HttpFoundation\Request;
$request = new Request(
    $_GET, $_POST, array(), $_COOKIE, $_FILES, $_SERVER
);
$injector->share($request);

use \Symfony\Component\HttpFoundation\Response;
$response = new Response;
$injector->share($response);

use \DebugBar\StandardDebugBar;
$standardDebugBar = new StandardDebugBar;
$injector->share($standardDebugBar);

// $injector->make('App\\DebugbarRenderer');

return $injector;
