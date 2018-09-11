<?php declare(strict_types = 1);

namespace App;

$db = require_once(CONFIG_PATH . 'database.php');
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
use \Symfony\Component\HttpFoundation\Response;

$request = new Request(
   $_GET,
    $_POST,
    array(),
    $_COOKIE,
    $_FILES,
    $_SERVER
);

// $injector->alias('\\Symfony\\Component\\HttpFoundation\\Request', 'Request');
$injector->share($request);
// $injector->define('\\Symfony\\Component\\HttpFoundation\\Request', [
//     ':query' => $_GET,
//     ':request' => $_POST,
//     ':attributes' => array(),
//     ':cookies' => $_COOKIE,
//     ':files' => $_FILES,
//     ':server' => $_SERVER
// ]);

$injector->alias('Symfony\\Component\\HttpFoundation\\Response', 'Response');
$injector->share('Response');

return $injector;
