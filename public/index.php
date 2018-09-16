<?php
define('BASE_URL', 'http://localhost:8000');
define('BASE_PATH', __DIR__ . '/../' . '/');
define('APP_PATH', BASE_PATH . 'app/');
define('CORE_PATH', BASE_PATH . 'core/');
define('CONFIG_PATH', BASE_PATH . 'config/');
define('CONTROLLER_PATH', APP_PATH . 'Controllers/');
define('VIEW_PATH', APP_PATH . 'views/');
define('VENDOR_PATH', BASE_PATH . 'vendor/');
define('TMP_PATH', BASE_PATH . 'tmp/');

require_once VENDOR_PATH . 'autoload.php';

if (config('debug_mode')) {
    error_reporting(E_ALL);
    $whoops = new Whoops\Run;
    $whoops->pushHandler(new Whoops\Handler\PrettyPageHandler);
    $whoops->register();
}

$container = require_once(CORE_PATH . 'container.php');

if (session_status() === PHP_SESSION_NONE) {
    $config = require_once(CONFIG_PATH . 'session.php');
    Core\SessionManager::sessionStart($config['name'], $config['cookie_lifetime'], '/', null, null, $config['save_path']);
}

set_secure_headers();
sanitizeglobals();

require_once CORE_PATH . 'router.php';
