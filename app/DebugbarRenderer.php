<?php
namespace App;

use \DebugBar\StandardDebugBar;

class DebugbarRenderer {
    private $debugbar;
    public function __construct(StandardDebugBar $debugbar) {
        $this->debugbar = $debugbar;
        $this->getRenderer();
    }
    private function getRenderer() {
        $debugbarRenderer = $this->debugbar->getJavascriptRenderer();
        $debugbarRenderer->setBaseUrl('/debugbar');
        return $debugbarRenderer;
    }
}
