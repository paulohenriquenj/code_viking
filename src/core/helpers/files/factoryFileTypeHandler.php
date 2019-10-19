<?php


namespace viking\core\helpers\files;

use viking\core\helpers\files\xlsFileTypeHandler;
use viking\core\helpers\files\xmlFileTypeHandler;

class factoryFileTypeHandler
{
    public static function getFileHandler()
    {
        $factory = new static;
        if ($factory->isXml()) {
            return new xmlFileTypeHandler();
        }

        if ($factory->isXls()) {
            return new xlsFileTypeHandler();
        }
    }

    public function isXml()
    {
        return stripos($_FILES['file']['type'], '/xml') !== false;
    }

    public function isXls()
    {
        return stripos($_FILES['file']['type'], 'spreadsheetml') !== false;
    }

}

