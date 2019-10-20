<?php

namespace viking\core;

use viking\core\middlewares\middleware as interfaceMiddleware;

class middleware{

    protected $middlewares;

    protected $middlewaresChain;

    public function __construct()
    {
        $this->loadDefaultMiddleware();
    }

    public function loadDefaultMiddleware()
    {
        if ($this->hasConfigMiddlewares()) {
            foreach (config::middlewares() as $middlewareName) {
                $middlewareClassName = 'viking\\core\\middlewares\\' . $middlewareName;
                $middlewareClass = new $middlewareClassName;

                if ($this->isMiddleware($middlewareClass)) {
                    $this->middlewares[] = $middlewareClass;

                }
            }
        }
    }

    protected function createChain()
    {
        $middlewaresReverse = array_reverse($this->middlewares, true);
        
        foreach ($middlewaresReverse as $key => $middleware) {
            $keyMinusOne = $key - 1;
            
            if ($keyMinusOne >= 0) {
                $this->middlewares[$keyMinusOne]->setNext($middleware);
            }
        }

        $this->middlewaresChain = $this->middlewares[0];
    }

    protected function hasConfigMiddlewares()
    {
        return !empty(config::middlewares());
    }

    protected function isMiddleware($class)
    {
        return $class instanceof interfaceMiddleware;
    }

    public function register(interfaceMiddleware $middleware)
    {
        $this->middlewares [] = $middleware;

        return $this;
    }

    public function getMiddlewares()
    {
        return $this->middlewares;
    }

    public function handle($request)
    {
        $this->createChain();

        return $this->middlewaresChain->handle($request);

    }

}