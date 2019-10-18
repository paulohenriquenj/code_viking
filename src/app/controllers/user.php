<?php


namespace viking\app\controllers;

use viking\app\model\user as modelUser;

use viking\core\auth;

class user
{
    public function login()
    {
        if ($this->checkCredential()) {
            return view('admin');
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
}


