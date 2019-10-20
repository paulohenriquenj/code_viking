<?php

use viking\core\database\connection;
use viking\core\config;
use PDO;

class connectionTest extends PHPUnit\Framework\TestCase{

    public function testIfPDOWasCreated()
    {
        $shouldByPdo = connection::getConnetion(config::database());

        $this->assertInstanceOf(PDO::class, $shouldByPdo);

    }
}
