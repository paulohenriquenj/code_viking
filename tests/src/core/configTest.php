<?php

use viking\core\config;

class configTest extends PHPUnit\Framework\TestCase{
    
    public function testIfIsLogingConfigurationFile()
    {
        $config = config::loadConfig(__DIR__ .'/../../../config.php');
        $this->assertNotEmpty(config::$config);
    }

    public function testIfRootPathIsNotEmpty()
    {
        $this->assertNotEmpty(config::pathRoot());
    }

    public function testIfConfigDatabaseIsNotEmpty()
    {
        $this->assertNotEmpty(config::database());
    }

    public function testIfMiddlewaresWasRegistered()
    {
        $this->assertNotEmpty(config::middlewares());
    }

    public function testIfConfigTestGetAndSetIsWorking()
    {
        config::set('configTest', 'testing');

        $this->assertNotEmpty(config::get('configTest'));
    }

}