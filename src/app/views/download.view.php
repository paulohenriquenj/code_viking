<?php

foreach ($headers as $header) {
    header($header);
}


readfile($filePath);

exit;
