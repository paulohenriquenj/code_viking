<?php

use viking\core\helpers\files\factoryFileTypeHandler;
use viking\core\helpers\files\xmlFileTypeHandler;
use viking\core\helpers\files\xlsFileTypeHandler;

class factoryFileTypeHandlerTest extends PHPUnit\Framework\TestCase{


    public function testIfInstanceOfXmlFileHandlerIsCreatedWhenFileIsXml()
    {
        $this->mockFileType('/xml');

        $shouldByXmlFileTypeHandler = factoryFileTypeHandler::getFileHandler();

        $this->assertInstanceOf(xmlFileTypeHandler::class, $shouldByXmlFileTypeHandler);
    }

    public function testIfInstanceOfXlsFileHandlerIsCreatedWhenFileIsXls()
    {
        $this->mockFileType('/spreadsheetml');

        $shouldByXlsFileTypeHandler = factoryFileTypeHandler::getFileHandler();

        $this->assertInstanceOf(xlsFileTypeHandler::class, $shouldByXlsFileTypeHandler);
    }

    private function mockFileType($type)
    {
        $_FILES['file']['type'] = $type;
    }

}
