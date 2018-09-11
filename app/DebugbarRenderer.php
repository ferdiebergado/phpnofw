<?php
namespace App;

use DebugBar\StandardDebugBar;

class DebugbarRenderer {
    private $debugbar;
    public function __construct(StandardDebugBar $debugbar) {
        $this->debugbar = $debugbar;
    }
    public static function getInstance() {
        // $debugbar = new StandardDebugBar();
        $debugbarRenderer = $this->debugbar->getJavascriptRenderer();
        $debugbarRenderer->setBaseUrl('/debugbar');
        return $debugbarRenderer;
    }
}
