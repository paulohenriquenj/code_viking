<?php

require 'config.php';

viking\core\config::loadConfig(__DIR__ . '/../../config.php');


require_once (viking\core\config::get('path'))['root'].'/vendor/autoload.php';


