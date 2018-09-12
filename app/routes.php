<?php declare(strict_types = 1);

return [
    ['GET', '/', ['App\Controllers\HomeController', 'index']],
    ['GET', '/user/{id:[0-9]+}', ['App\Controllers\HomeController', 'user']],
];