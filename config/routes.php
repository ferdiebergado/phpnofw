<?php declare(strict_types = 1);
return [
    ['GET', '/', ['App\Controllers\HomeController', 'index']],
    ['GET', '/login', ['App\Controllers\LoginController', 'showLoginForm']],
    ['POST', '/login', ['App\Controllers\LoginController', 'login']],
    ['POST', '/logout', ['App\Controllers\LoginController', 'logout']],
    ['GET', '/users', ['App\Controllers\HomeController', 'users']],
    ['GET', '/user/{id}/edit', ['App\Controllers\HomeController', 'user']],
];
