<?php
  require 'connection.php';

  function try_login($username, $password) {
    global $connection;

    $statement = $connection->prepare("
      SELECT *
      FROM users
      WHERE username = :username;
    ");
    $params = array(':username' => $username);
    $statement->execute($params);
    $user = $statement->fetch();

    $is_password_valid = password_verify($password, $user['password']);

    if ($user && $is_password_valid) {
      return $user['id'];
    }

    return NULL;
  }

  function does_user_exist($username) {
    global $connection;

    $statement = $connection->prepare("
      SELECT *
      FROM users
      WHERE username = :username;
    ");
    $params = array(':username' => $username);
    $statement->execute($params);
    $user = $statement->fetch();

    return $user ? true : false;
  }

  function create_user($username, $password) {
    global $connection;

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $statement = $connection->prepare("
      INSERT INTO users(username, password)
      VALUES (:username, :password);
    ");
    $params = array(':username' => $username, ':password' => $hashed_password);
    $success = $statement->execute($params);

    return $success ? $connection->lastInsertId() : NULL;
  }
?>