<?php
namespace Core;

use DebugBar\StandardDebugBar;
use DebugBar\DataCollector\PDO\PDOCollector;

class DebugbarRenderer {
    private static $debugbar, $collector, $renderer;
    public function __construct(StandardDebugBar $debugbar, PDOCollector $collector) {
        self::$debugbar = $debugbar;
        self::$collector = $collector;
        self::setRenderer();
    }
    private static function setRenderer() {
        self::$debugbar->addCollector(self::$collector);
        $debugbarRenderer = self::$debugbar->getJavascriptRenderer();
        $debugbarRenderer->setBaseUrl('/debugbar');
        self::$renderer = $debugbarRenderer;
    }
    private static function getRenderer() {
        return self::$renderer;
    }
    public static function renderHead() {
        return self::getRenderer()->renderHead();
    }
    public static function render() {
        return self::getRenderer()->render();
    }
}
