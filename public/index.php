<?php

require __DIR__ . '/../src/core/core.php';

require __DIR__ . '/../src/core/router.php';

require __DIR__ . '/../src/core/request.php';


viking\core\router::load(
    (viking\core\config::get('path'))['root'] . '/src/app/routes.php'
)->redirect(
    viking\core\request::getMethod(),
    viking\core\request::getUri()
);
