<?php


namespace viking\app\controllers;

use viking\app\model\user as modelUser;

use viking\core\auth;
use viking\app\controllers\admin;

class user
{
    public function login()
    {
        if ($this->checkCredential()) {
            return (new admin)->adminView();
        }

        view('login', ['msg' => ['msg' => 'Usuário ou senha inválidos.', 'type' => 'warning' ]]);
    }

    public function checkCredential()
    {
        $user = (new modelUser)->getUser($_POST['login'], $_POST['password']);

        if (!empty($user)) {
            auth::registerLoginSession($user[0]);
            return true;
        }

        return false;
    }

    public function index()
    {
        view('login');
    }

    public function logout()
    {
        auth::clearLoginInfo();
        view(
            [
                'content' => 'wellcome', 
                'header'  => 'header'
            ]
        );
    }
}


