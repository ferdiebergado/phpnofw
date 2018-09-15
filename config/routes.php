<?php declare(strict_types = 1);
return [
    ['GET', '/', ['App\Controllers\HomeController', 'index']],
    ['GET', '/login', ['App\Controllers\LoginController', 'showLoginForm']],
    ['POST', '/login', ['App\Controllers\LoginController', 'login']],
    ['POST', '/logout', ['App\Controllers\LoginController', 'logout']],
    ['GET', '/user/{id:\d+}/edit', ['App\Controllers\UserController', 'edit']]
];
