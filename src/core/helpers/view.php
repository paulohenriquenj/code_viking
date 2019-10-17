<?php


function view($viewName, $data = [], $layout="html")
{
    $content = '';
    extract($data);

    $layout = require viking\core\config::pathRoot() . '/src/app/views/layout/' . $layout . '.view.php';

    if (!empty($viewName)) {
        $content = require viking\core\config::pathRoot() . '/src/app/views/' . $viewName . '.view.php';
    }

    echo str_replace('__main_content__', $content, $layout);

    // file_get_contents(viking\core\config::pathRoot() . '/src/app/views/' . $viewName . '.view.php');
    // require viking\core\config::pathRoot() . '/src/app/views/' . $viewName . '.view.php';
}