<?php


function view($viewName, $data = [], $layout="html")
{
    $content = [
        'content' => '',
        'header'  => '',
        'aside'   => '',
        'footer'  => '',
        'msg'     => '',
    ];

    extract($data);

    $layout = require viking\core\config::pathRoot() . '/src/app/views/layout/' . $layout . '.view.php';

    if (!empty($viewName)) {
        foreach ((array) $viewName as $key => $viewItem) {

            if (is_int($key)) {
                $key ='content';
            }

            $content[$key] = require viking\core\config::pathRoot() . '/src/app/views/' . $viewItem . '.view.php';
        }
    }
    
    if (!empty($msg)) {
        $content['msg'] = require viking\core\config::pathRoot() . '/src/app/views/msg.view.php';
    }

    $layout = str_replace('__header__', $content['header'], $layout);
    $layout = str_replace('__aside__', $content['aside'], $layout);
    $layout = str_replace('__footer__', $content['footer'], $layout);
    $layout = str_replace('__msg__', $content['msg'], $layout);
    echo str_replace('__main_content__', $content['content'], $layout);

}