<?php

use viking\core\request;

class requestTest extends PHPUnit\Framework\TestCase{
    
    public function testParseOfUri()
    {
        $mock_uri = '/home';

        $_SERVER['REQUEST_URI'] = $mock_uri;

        $uri = request::getUri();

        $this->assertEquals('home', $uri);
    }

    public function testIfRequestMethodIsFound()
    {

        $mock_method = 'GET';

        $_SERVER['REQUEST_METHOD'] = $mock_method;

        $method = request::getMethod();

        $this->assertEquals($mock_method, $method);

    }

}