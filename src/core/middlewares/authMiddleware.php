<?php

namespace viking\core\middlewares;

use viking\core\middlewares\middleware;
use viking\core\request;
use viking\core\auth;


class authMiddleware implements middleware
{
    private $nextMiddleware;

    public function setNext(middleware $middleware)
    {
        $this->nextMiddleware = $middleware;
    }

    public function handle(request $request)
    {
        if ($this->userLogged($request)) {
            return $this->nextMiddleware->handle($request);
        }

        $this->redirecToLogin();

    }

    public function userLogged($request)
    {
        return (auth::isLogged() || $this->isLoginAttempt($request->uri));
    }

    private function isLoginAttempt($uri)
    {
        return $uri == 'login';
    }

    public function redirecToLogin()
    {
        auth::clearLoginInfo();

        view('login');
    }
}