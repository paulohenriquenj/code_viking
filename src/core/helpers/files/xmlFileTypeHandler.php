<?php

namespace viking\core\helpers\files;

use viking\core\helpers\files\fileTypeHandler;

class xmlFileTypeHandler implements fileTypeHandler
{
    public function load(string $filePath)
    {
        return (xml2array(
            simplexml_load_file($_FILES['file']['tmp_name'])
        ))['cartorio'];
    }
}

