<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Docker <?php echo "Test"; ?></title>
    </head>
    <body>
<?php

try {
    $dsn = 'mysql:host=mysql;dbname=test;charset=utf8;port=3306';
    $pdo = new PDO($dsn, 'dev', 'dev');
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>
        <h1>Docker <?php echo "Test"; ?></h1>
    </body>
</html>
