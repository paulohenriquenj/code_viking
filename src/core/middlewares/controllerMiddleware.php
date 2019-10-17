<?php

namespace viking\core\middlewares;

use viking\core\middlewares\middleware;
use viking\core\request;

class controllerMiddleware implements middleware
{

    

    private $nextMiddleware;

    public function setNext(middleware $middleware)
    {
        $this->nextMiddleware = $middleware;
    }

    public function handle(request $request) 
    {
        
    }
}
