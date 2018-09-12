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
        $debugbarRenderer->setBaseUrl('/debugbar');
    }
    $content = require(VIEW_PATH . 'sections/header.php');
    $content .= require(VIEW_PATH . $view . '.php');
    $content .= require(VIEW_PATH . 'sections/footer.php');
    $response = new \Symfony\Component\HttpFoundation\Response($content);
    $response->send();
}
