<?php


namespace viking\app\controllers;

class home 
{

    public function index()
    {

        view(
            [
            'content' => 'wellcome', 
            'header'  => 'header'
            ]
        );

    }

}

