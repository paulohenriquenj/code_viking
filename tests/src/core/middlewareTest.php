<?php

use viking\core\middleware;

use viking\core\middlewares\controllerMiddleware;
use viking\core\router;
use viking\core\config;

class middlewareTest extends PHPUnit\Framework\TestCase{

    public function testIfAMiddlewareIsCorrectlyRegistered()
    {
        $this->initMiddleware();

        $this->middleware->register(new controllerMiddleware(new router));

        $middlewares = $this->middleware->getMiddlewares(); 

        $this->assertInstanceOf(
            controllerMiddleware::class, 
            array_pop($middlewares)
        );

    }

    private function initMiddleware()
    {
        $this->middleware = new middleware();
    }

    public function testIfRegistedMiddlewaresInConfigWasLoaded()
    {
        $this->initMiddleware();

        $middlewares = $this->middleware->getMiddlewares(); 

        $this->assertSameSize($middlewares, config::middlewares());
    }

}