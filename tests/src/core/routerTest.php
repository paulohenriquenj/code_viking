<?php

use viking\core\router;

class routerTest extends PHPUnit\Framework\TestCase{

    public function testIfRoutersWasCreated()
    {
        $routes = file_get_contents(__DIR__.'/../../../src/routes.php');

        $this->assertStringContainsString('$router', $routes);
    }

    public function testIfRoutesWasLoaded()
    {
        $router = router::load(__DIR__.'/../../../src/routes.php');

        $this->assertNotEquals($router->routes['GET'], $router->routes['POST']);

    }

}