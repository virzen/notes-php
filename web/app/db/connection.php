<?php

try {
    // TODO: use dotenv
    $dsn = 'mysql:host=mysql;dbname=notes;charset=utf8;port=3306';
    $connection = new PDO($dsn, 'dev', 'dev');
} catch (PDOException $e) {
    redirectTo('/error');
}

?>