<?php

$uri = $_SERVER['REQUEST_URI'];

switch ($uri) {
    case '/' :
        require __DIR__ . '/views/index.php';
        break;
    case '' :
        require __DIR__ . '/views/index.php';
        break;
    default:
        require __DIR__ . '/views/404.php';
        break;
}

?>