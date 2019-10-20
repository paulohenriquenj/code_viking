<?php


namespace viking\app\controllers;

use viking\app\controllers\admin;


class news
{
    public function news()
    {
        return (new  admin)->adminView('admin_editNews');
    }
    
    public function editNews()
    {
        view('', ['bodyContent' => $_POST['news']], 'news');
    }
}
