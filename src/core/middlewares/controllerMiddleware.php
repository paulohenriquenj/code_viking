<?php

namespace viking\core\middlewares;

use viking\core\middlewares\middleware;
use viking\core\request;
use viking\core\router;

class controllerMiddleware implements middleware
{
    private $nextMiddleware;

    public function __construct(router $router)
    {
        $this->router = $router;
    }


    public function setNext(middleware $middleware)
    {
        $this->nextMiddleware = $middleware;
    }

    public function handle(request $request) 
    {
        return $this->router->callController(
            ...explode(
                '@', 
                $this->router->routes[$request->method][$request->uri]
            )
        );
    }
}
