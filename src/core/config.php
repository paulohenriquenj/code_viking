<?php

namespace viking\core;

class config{

    static $config = [];

    public static function loadConfig($pathToConfig)
    {
        $config = new static;

        self::$config = require $pathToConfig;

    }

    public static function get($configName)
    {
        return self::$config[$configName];
    }

    public static function set($configName, $value)
    {
        self::$config[$configName] = $value;
    }

    public static function pathRoot()
    {
        return self::$config['path']['root'];
    }

    public static function middlewares()
    {
        return self::$config['middlewares'];
    }

    public static function database()
    {
        return self::$config['database'];
    }
}