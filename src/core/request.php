<?php

namespace viking\core;

class request{

    public $uri;
    public $method;

    public static function getUri()
    {
        return trim(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'
        );
    }

    public static function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function parseUrl()
    {
        $request = new static;

        $request->uri = self::getUri();

        $request->method = self::getMethod();

        return $request;
    }

}