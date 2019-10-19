<?php


$router->get('', 'home@index');
$router->get('home', 'controller@home');

$router->get('login', 'user@index');
$router->post('login', 'user@login');

$router->get('admin', 'admin@index');
$router->get('admin/import/xml', 'admin@importXml');
$router->post('admin/import/xmlfile', 'admin@importXmlFile');

$router->get('user/logout', 'user@logout');