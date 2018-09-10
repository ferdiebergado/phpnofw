<?php
namespace App;

use DebugBar\StandardDebugBar;

class DebugbarRenderer {
    public static function getInstance() {
        $debugbar = new StandardDebugBar();
        $debugbarRenderer = $debugbar->getJavascriptRenderer();
        return $debugbarRenderer;
    }
}
