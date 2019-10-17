<?php

require __DIR__ . '/../src/core/core.php';

use viking\core\router;
use viking\core\request;
use viking\core\config;


router::load(
    config::pathRoot() . '/src/app/routes.php'
)->middleware(
    request::parseUrl()
);
