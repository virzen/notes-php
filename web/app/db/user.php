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

  function is_password_correct_for_user($user_id, $password) {
    global $connection;

    $statement = $connection->prepare("
      SELECT *
      FROM users
      WHERE id = :id;
    ");
    $params = array(':id' => $user_id);
    $statement->execute($params);
    $user = $statement->fetch();

    return password_verify($password, $user['password']);
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

  function update_password_for_user($user_id, $new_password) {
    global $connection;

    $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

    $statement = $connection->prepare("
      UPDATE users
      SET password = :new_password
      WHERE id = :user_id;
    ");
    $params = array(':new_password' => $hashed_new_password, ':user_id' => $user_id);
    $success = $statement->execute($params);

    if (!$success) {
      redirectTo('/error');
    }
  }
?>