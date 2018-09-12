<?php
define('DEBUG_MODE', true);
define('BASE_URL', 'http://localhost:8000');
define('BASE_PATH', __DIR__ . '/../' . '/');
define('APP_PATH', BASE_PATH . 'app' . '/');
define('CONFIG_PATH', BASE_PATH . 'config' . '/');
define('TMP_PATH', BASE_PATH . 'tmp' . '/');
define('VENDOR_PATH', BASE_PATH . 'vendor' . '/');
define('VIEW_PATH', APP_PATH . 'views' . '/');
define('CONTROLLER_PATH', APP_PATH . 'Controllers' . '/');

$session_config = require(CONFIG_PATH . 'session.php');
session_start($session_config);

require_once APP_PATH . 'bootstrap.php';
