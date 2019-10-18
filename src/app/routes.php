<?php


$router->get('', 'home@index');
$router->get('home', 'controller@home');
$router->get('login', 'user@index');
$router->post('login', 'user@login');