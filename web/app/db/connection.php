<?php

require_once __DIR__ . '/../utils/error_handling.php';

try {
    // TODO: use dotenv
    $dsn = 'mysql:host=mysql;dbname=notes;charset=utf8;port=3306';
    $connection = new PDO($dsn, 'dev', 'dev');
} catch (PDOException $e) {
    log_error($e->getMessage());
}

?>