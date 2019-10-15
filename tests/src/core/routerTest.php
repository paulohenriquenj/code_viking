<?php

use viking\core\router;

class routerTest extends PHPUnit\Framework\TestCase{

    public function testIfRoutersWasCreated()
    {
        $routes = file_get_contents(__DIR__.'/../../../src/app/routes.php');

        $this->assertStringContainsString('$router', $routes);
    }

    public function testIfRoutesWasLoaded()
    {
        $router = router::load(__DIR__.'/../../../src/app/routes.php');

        $this->assertNotEquals($router->routes['GET'], $router->routes['POST']);

    }

    public function testIfAnyOfRoutersStartsWithSlash()
    {
        $router = router::load(__DIR__.'/../../../src/app/routes.php');

        foreach ($router->routes as $method => $routes) {
            foreach ($routes as $route => $controller) {
                $this->assertStringStartsNotWith('/', $route);
            }
        }
    }

}