<?php

namespace viking\core\middlewares;

use viking\core\middlewares\middleware;
use viking\core\request;


class authMiddleware implements middleware
{
    private $nextMiddleware;

    public function setNext(middleware $middleware)
    {
        $this->nextMiddleware = $middleware;
    }

    public function handle(request $request)
    {
        if ($this->userLogged()) {
            $this->nextMiddleware->handle($request);
        }

    }

    public function userLogged()
    {
        return true;
        return !empty($_SESSION['user']['logged']);
    }
}