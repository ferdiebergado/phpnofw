<?php declare(strict_types = 1);

return [
    ['GET', '/', ['App\Controllers\HomeController', 'index']],
    ['GET', '/users', ['App\Controllers\HomeController', 'users']],
    ['GET', '/login', ['App\Controllers\HomeController', 'login']],
];