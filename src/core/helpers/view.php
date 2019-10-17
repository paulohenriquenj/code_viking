<?php


function view($viewName, $data = [])
{
    extract($data);

    return require viking\core\config::pathRoot() . '/app/views/' . $viewName . '.view.php';
}