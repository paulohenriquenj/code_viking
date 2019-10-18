<?php


function view($viewName, $data = [], $layout="html")
{
    $content = '';
    $content_msg = '';
    extract($data);

    $layout = require viking\core\config::pathRoot() . '/src/app/views/layout/' . $layout . '.view.php';

    if (!empty($viewName)) {
        $content = require viking\core\config::pathRoot() . '/src/app/views/' . $viewName . '.view.php';
    }
    
    if (isset($msg)) {
        $content_msg = require viking\core\config::pathRoot() . '/src/app/views/msg.view.php';
    }

    $layout = str_replace('__msg__', $content_msg, $layout);
    echo str_replace('__main_content__', $content, $layout);

}