<?php


$router->get('', 'home@index');
$router->get('home', 'controller@home');

$router->get('login', 'user@index');
$router->post('login', 'user@login');
$router->get('user/logout', 'user@logout');

$router->get('admin', 'admin@index');

$router->get('admin/import/xml', 'file@importXml');
$router->post('admin/import/xml', 'file@importXmlFile');
$router->get('admin/import/xls', 'file@importXls');
$router->post('admin/import/xls', 'file@importXlsFile');


$router->get('admin/list/cartorio', 'admin@list');
$router->get('admin/edit/cartorio', 'admin@editCartorio');
$router->post('admin/search/cartorio', 'admin@searchCartorio');
$router->get('admin/edit/cartorio/info', 'admin@editCartorioInfo');
$router->post('admin/edit/cartorio/info', 'admin@updataCartorioInfo');
$router->get('admin/delete/cartorio', 'admin@deleteCartorio');
$router->get('admin/export/cartorio', 'admin@exportCartorio');

$router->get('admin/news/cartorio', 'news@news');
$router->post('admin/edit/news', 'news@editNews');
$router->get('admin/send/cartorio', 'news@newsSend');

