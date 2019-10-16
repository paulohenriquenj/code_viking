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
        $router = $this->routerLoad();

        $this->assertNotEquals($router->routes['GET'], $router->routes['POST']);

    }

    public function testIfAnyOfRoutersStartsWithSlash()
    {
        $router = $this->routerLoad();

        foreach ($router->routes as $method => $routes) {
            foreach ($routes as $route => $controller) {
                $this->assertStringStartsNotWith('/', $route);
            }
        }
    }

    private function routerLoad()
    {
        return router::load(__DIR__.'/../../../src/app/routes.php');
    }

    public function testIf404IsCalledWhenControllerDontExists()
    {
        $router = $this->routerLoad();

        $router->get('dontExistPath', 'dontExistController');

        ob_start();
        $router->redirect('GET', 'dontExistPath');
        $output = ob_get_clean();

        $this->assertStringContainsString('404', $output);

    }

}