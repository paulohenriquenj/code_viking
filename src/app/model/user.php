<?php

namespace viking\app\model;

use viking\core\database\model;

class user extends model
{
    public function __construct() 
    {
        parent::__construct();
    }

    public function getUser($email, $password)
    {
        return $this->fetch(
            'user',
            ['id', 'email', 'active'],
            ' email = "'.addslashes($email).'" and password = "'.addslashes(md5($password)).'"'
        );
    }
}


