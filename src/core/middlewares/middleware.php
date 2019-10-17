<?php

namespace viking\core\middlewares;

use viking\core\request;

interface middleware{
    
    public function setNext(middleware $middleware);

    public function handle(request $request);

}