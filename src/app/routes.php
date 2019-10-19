<?php


$router->get('', 'home@index');
$router->get('home', 'controller@home');

$router->get('login', 'user@index');
$router->post('login', 'user@login');

$router->get('admin', 'admin@index');
$router->get('admin/import/xml', 'admin@importXml');
$router->post('admin/import/xml', 'admin@importXmlFile');
$router->get('admin/edit/cartorio', 'admin@editCartorio');
$router->post('admin/search/cartorio', 'admin@searchCartorio');
$router->get('admin/edit/cartorio/info', 'admin@editCartorioInfo');
$router->post('admin/edit/cartorio/info', 'admin@updataCartorioInfo');

$router->get('user/logout', 'user@logout');