<?php
namespace App\Controllers;

class BaseController {
    protected function middleware(...$types) {
        foreach ($types as $type) {
            switch ($type) {
                case 'auth':
                    if (!isset($_SESSION['isLoggedIn'])) {
                        return header('Location: /');
                    }
                    break;
                case 'active':
                    if ($_SESSION['isLoggedIn'] && !$_SESSION['USER_ACTIVE']) {
                        App\Controllers\LoginController::logout();
                        return header('Location: /');
                    }
                    break;
                default:
                    # code...
                    break;
            }
        }
    }
}
