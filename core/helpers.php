<?php

function config($key) {
    $config = require(CONFIG_PATH . 'app.php');
    if (array_key_exists($key, $config)) {
        return $config[$key];
    }
}

function view($view, $data = []) {
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

function verify_token($csrf_token) {
    if (!empty($csrf_token) && isset($_SESSION['token'])) {
        if (hash_equals($_SESSION['token'], $csrf_token)) {
            // Proceed to process the form data
            return true;
        } else {
            // Log this as a warning and keep an eye on these attempts
            logger('CSRF attempt from ' . $_SERVER['REMOTE_ADDR'] . ' ' . $_SERVER['HTTP_USER_AGENT'], 3);
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
        $_POST[$key] = test_input($_POST[$key]);
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

function set_secure_headers(){
    $headers = require_once CONFIG_PATH . 'headers.php';
    foreach ($headers as $key => $value) {
        header("$key: $value", false);
    }
}

function back() {
    header('Location: ' . $_SESSION['REDIRECT_ROUTE']);
}

function cache_set($key, $expire = null, $val) {
    $path = cache_config('path');
    if (empty($expire)) {
        $expire = cache_config('expire');
    }
    $expire *= 60;
    $val = var_export($val, true);
   // HHVM fails at __set_state, so just use object cast for now
   // $val = str_replace('stdClass::__set_state', '(object)', $val);
   // Write to temp file first to ensure atomicity
    $tmp = $path . $key . uniqid('', true) . '.tmp';
    file_put_contents($tmp, '<?php $val = ' . $val . '; $exp = ' . $expire . ';', LOCK_EX);
    rename($tmp, $path . $key);
    return $val;
}

function cache_remember($key, $expire = null, $val) {
    if (cache_config('enabled')) {
        if (empty($expire)) {
            $expire = cache_config('expire');
        }
        $file = cache_config('path') . $key;
        if (!file_exists($file)) {
            $val = cache_set($key, $expire, $val);
        } else {
            @include $file;
            // Check file create time vs. your expire.
            if (filemtime($file) < (time() - $exp)) {
                $val = cache_set($key, $exp, $val);
            }
        }
    }
    return $val;
}

function cache_forget($key) {
    $file = cache_config('path') . $key;
    if (file_exists($file)) {
        unlink($file);
    }
}

function cache_config($key) {
    $config = require(CONFIG_PATH . 'cache.php');
    $path = $config['path'];
    if (empty($path)) {
        $app = require(CONFIG_PATH . 'app.php');
        $path = sys_get_temp_dir() . '/' . $app['name'];
    }
    if (!is_dir($path)) {
        mkdir($path, 0775, true);
    }
    $config['path'] = $path . '/';
    return $config[$key];
}

function logger($msg, $type) {
    $mode = FILE_APPEND;
    if (!file_exists(LOG_FILE)) {
        $mode = LOCK_EX;
    }
    switch ($type) {
        case 1:
        $type = 'INFO';
        break;
        case 2:
        $type = 'ERROR EXCEPTION';
        break;
        case 3:
        $type = 'WARNING';
        break;
    }
    $log = '[' . date(DATE_FORMAT_LONG) . "] $type: " . $msg . "\n";
    file_put_contents(LOG_FILE, $log, $mode);
}
