<?php

namespace viking\core;

use viking\core\middleware;
use viking\core\middlewares\controllerMiddleware;

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

    public function hasRouter($method, $uri)
    {
        return array_key_exists($uri, $this->routes[$method]);
    }

    public function redirect($method, $uri)
    {
        if (in_array($uri, $this->routes[$method])) {
            $this->callController(
                ...explode('@', $this->routes[$method][$uri])
            );
        }

        $this->redirectTo404();

    }

    public function middleware(request $request)
    {
        if ($this->hasRouter($request->method, $request->uri)) {
            return (new middleware)
                ->register(new controllerMiddleware($this))
                ->handle($request);
        }

        $this->redirectTo404();
    }

    public function redirectTo404()
    {
        // *********************************************************************************
        echo '404! <br>';
    }

    public function callController($controller, $action)
    {
        $controller = 'viking\\app\\controllers\\' . $controller;
        $controller = new $controller;

        if (!method_exists($controller, $action)) {
            throw new Exception("Method {$action} undefined in {$controller}");
            
        }

        return $controller->$action();

    }
}