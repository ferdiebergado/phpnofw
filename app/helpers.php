<?php
function config($key) {
    $config = require(CONFIG_PATH . 'app.php');
    if (array_key_exists($key, $config)) {
        return $config[$key];
    }
}

function view($view) {
    if (config('env') === 'dev') {
        $debugbar = new \DebugBar\StandardDebugBar;
        $debugbarRenderer = $debugbar->getJavascriptRenderer();
        $debugbarRenderer->setBaseUrl('debugbar');
    }
    require VIEW_PATH . 'sections/header.php';
    require VIEW_PATH . $view . '.php';
    require VIEW_PATH . 'sections/footer.php';
}
