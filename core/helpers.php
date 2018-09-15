<?php

function config($key) {
    $config = require(CONFIG_PATH . 'app.php');
    if (array_key_exists($key, $config)) {
        return $config[$key];
    }
}

function view($view, $data = [], $viewonly = false) {
    $headers = require_once(CONFIG_PATH . 'headers.php');
    foreach ($headers as $key => $value) {
        header("$key: $value", false);
    }
    if (!$viewonly) {
        require VIEW_PATH . 'sections/header.php';
    }
    require VIEW_PATH . $view . '.php';
    if (!$viewonly) {
        require VIEW_PATH . 'sections/footer.php';
    }
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

function sanitizeglobals() {
    //
    // Sanitize all dangerous PHP super globals.
    //
    // The FILTER_SANITIZE_STRING filter removes tags and remove or encode special
    // characters from a string.
    //
    // Possible options and flags:
    //
    //   FILTER_FLAG_NO_ENCODE_QUOTES - Do not encode quotes
    //   FILTER_FLAG_STRIP_LOW        - Remove characters with ASCII value < 32
    //   FILTER_FLAG_STRIP_HIGH       - Remove characters with ASCII value > 127
    //   FILTER_FLAG_ENCODE_LOW       - Encode characters with ASCII value < 32
    //   FILTER_FLAG_ENCODE_HIGH      - Encode characters with ASCII value > 127
    //   FILTER_FLAG_ENCODE_AMP       - Encode the "&" character to &amp;
    //
    //
    // <?php
    //
    // // Variable to check
    // $str = "<h1>Hello WorldÆØÅ!</h1>";
    //
    // // Remove HTML tags and all characters with ASCII value > 127
    // $newstr = filter_var($str, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    // echo $newstr;
    //  -> Hello World!

    foreach ($_GET as $key => $value) {
        $_GET[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_STRING);
    }

    foreach ($_POST as $key => $value) {
        $_POST[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_STRING);
    }

    foreach ($_COOKIE as $key => $value) {
        $_COOKIE[$key] = filter_input(INPUT_COOKIE, $key, FILTER_SANITIZE_STRING);
    }

    foreach ($_SERVER as $key => $value) {
        $_SERVER[$key] = filter_input(INPUT_SERVER, $key, FILTER_SANITIZE_STRING);
    }

    foreach ($_ENV as $key => $value) {
        $_ENV[$key] = filter_input(INPUT_ENV, $key, FILTER_SANITIZE_STRING);
    }

    $_REQUEST = array_merge($_GET, $_POST);
}
