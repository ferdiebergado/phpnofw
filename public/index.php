<?php
/**
 * PHPNoFW - A No Framework PHP Web Application Skeleton
 *
 * @project  PHPNoFW
 * @author   Ferdinand Saporas Bergado <ferdiebergado@gmail.com>
 */

/* Declare constants */
define('BASE_URL', 'http://localhost:8000');
define('BASE_PATH', __DIR__ . '/../' . '/');
define('APP_PATH', BASE_PATH . 'app/');
define('CORE_PATH', BASE_PATH . 'core/');
define('CONFIG_PATH', BASE_PATH . 'config/');
define('CONTROLLER_PATH', APP_PATH . 'Controllers/');
define('VIEW_PATH', APP_PATH . 'views/');
define('VENDOR_PATH', BASE_PATH . 'vendor/');
define('TMP_PATH', BASE_PATH . 'tmp/');
define('LOG_FILE', TMP_PATH . 'app_' . date('Y') . '.log');
/* end constants */

/* Load composer libraries */
require_once VENDOR_PATH . 'autoload.php';
/* end libraries */

/* Register the error handler */
error_reporting(E_ALL);
$whoops = new Whoops\Run;
if (config('debug_mode')) {
    $whoops->pushHandler(new Whoops\Handler\PrettyPageHandler);
} else {
    $whoops->pushHandler(function($e) use($whoops) {
        $whoops->allowQuit(false);
        $whoops->writeToOutput(false);
        $whoops->pushHandler(new Whoops\Handler\PrettyPageHandler());
        $body = $whoops->handleException($e);
        Core\Mail::send('ferdiebergado@gmail.com', 'Error Exception', $body);
        logger($e->getMessage(), 2);
        require VIEW_PATH . '500.php';
    });
}
$whoops->register();
/* end error handler */

/* Initialize dependency injection container */
$container = require_once(CORE_PATH . 'container.php');
/* end container */

/* Start bullet-proof session */
if (session_status() === PHP_SESSION_NONE) {
    $config = require_once(CONFIG_PATH . 'session.php');
    Core\SessionManager::sessionStart($config['name'], $config['cookie_lifetime'], '/', null, null, $config['save_path']);
}
/* end session */

/* Set secure headers */
set_secure_headers();
/* end headers */

/* Filter superglobals */
sanitizeglobals();
/* end superglobals */

/* Dispatch the router */
require_once CORE_PATH . 'router.php';
/* end router */

/* LET'S ROCK!!! */
