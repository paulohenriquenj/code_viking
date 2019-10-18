<?php

namespace viking\core;

class auth
{
    public static function registerLoginSession($user)
    {
        $_SESSION['user']['logged'] = true;
        self::registerUserInfo($user);
    }
    
    public static function registerUserInfo($user)
    {
        $_SESSION['user']['info'] = $user;
    }

    
}
