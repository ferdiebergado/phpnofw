<?php

function config($key) {
    $config = require(CONFIG_PATH . 'app.php');
    if (array_key_exists($key, $config)) {
        return $config[$key];
    }
}

function view($view, $data = null) {
    if (config('debug_mode')) {
        $debugbar = new DebugBar\StandardDebugBar;
        $debugbar->addCollector(new DebugBar\DataCollector\PDO\PDOCollector);
        $debugbarRenderer = $debugbar->getJavascriptRenderer();
        $debugbarRenderer->setBaseUrl('/debugbar');
    }
    $content = $data;
    $headers = require_once(CONFIG_PATH . 'headers.php');
    foreach ($headers as $key => $value) {
        header("$key: $value", false);
    }
    require VIEW_PATH . 'sections/header.php';
    require VIEW_PATH . $view . '.php';
    require VIEW_PATH . 'sections/footer.php';
}

function csrf_token() {
    if (empty($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }
    $token = $_SESSION['token'];
    echo <<<CSRF
    <input type="hidden" name="csrf_token" value="$token">
CSRF;
}

function verify_token($post_token) {
    if (!empty($post_token) && isset($_SESSION['token'])) {
        if (hash_equals($_SESSION['token'], $post_token)) {
         // Proceed to process the form data
            return true;
        } else {
         // Log this as a warning and keep an eye on these attempts
            return false;
        }
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

