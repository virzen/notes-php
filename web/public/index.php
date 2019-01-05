<?php

require './utils/session.php';
require './utils/redirections.php';

$uri = $_SERVER['REQUEST_URI'];

if (!$is_session_active && $uri != '/login') {
    redirectTo('/login');
}

if ($is_session_active && $uri == '/login') {
    redirectTo('/');
}

switch ($uri) {
    case '/' :
        require __DIR__ . '/views/index.php';
        break;
    case '' :
        require __DIR__ . '/views/index.php';
        break;
    case '/login' :
        require __DIR__ . '/views/login.php';
        break;
    default:
        require __DIR__ . '/views/404.php';
        break;
}

?>