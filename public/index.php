<?php declare(strict_types = 1);

require __DIR__ . '/../app/bootstrap.php';

// use Symfony\Component\HttpFoundation\Request;
// $request = Request::createFromGlobals();
use Symfony\Component\HttpFoundation\Response;
$content = '<h1>Hello</h1>';
$status = 200;
$headers = array('text/html');
$response = new Response($content, $status, $headers);
$response->send();
