<?php

require 'utils/session.php';
require 'utils/redirections.php';

session_start();

$url = explode('?', $_SERVER['REQUEST_URI'])[0];

if (!is_session_active() && $url != '/login') {
    redirectTo('/login');
}

if (is_session_active() && $url == '/login') {
    redirectTo('/');
}

switch ($url) {
    case '/' :
        require __DIR__ . '/views/index.php';
        break;
    case '' :
        require __DIR__ . '/views/index.php';
        break;
    case '/new':
        require __DIR__ . '/views/new.php';
        break;
    case '/delete':
        require __DIR__ . '/views/delete.php';
        break;
    case '/edit':
        require __DIR__ . '/views/edit.php';
        break;
    case '/change-password':
        require __DIR__ . '/views/change_password.php';
        break;
    case '/login':
        require __DIR__ . '/views/login.php';
        break;
    case '/logout':
        require __DIR__ . '/views/logout.php';
        break;
    default:
        require __DIR__ . '/views/404.php';
        break;
}

?>