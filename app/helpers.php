<?php
function config($key) {
    $config = require_once(CONFIG_PATH . 'app.php');
    if (array_key_exists($key)) {
        return $config[$key];
    }
}
