<?php
define('BASE_PATH', __DIR__ . '/../' . '/');
define('APP_PATH', BASE_PATH . 'app' . '/');
define('CONFIG_PATH', BASE_PATH . 'config' . '/');

require __DIR__ . '/../app/bootstrap.php';

use Symfony\Component\HttpFoundation\Response;
$content = '<h1>Hello</h1>';
$status = 200;
$headers = array('text/html');
$response = new Response($content, $status, $headers);
$response->send();
