<?php

namespace viking\core;

class router{

    public $routes = [
         'GET'  => [],
         'POST' => []
    ];

    public function get($url, $controller )
    {
        $this->routes['GET'][$url] = $controller;
    }

    public function post($url, $controller)
    {
        $this->routes['POST'][$url] = $controller;
    }

    public static function load($filePath)
    {
        $router = new static;

        require $filePath;

        return $router;
    }
}