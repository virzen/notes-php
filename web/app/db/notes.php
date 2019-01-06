<?php

require_once 'connection.php';
require_once __DIR__ . '/../utils/error_handling.php';

function get_notes_for_user($user_id) {
  global $connection;

  $statement = $connection->prepare("
    SELECT *
    FROM notes
    WHERE user_id = :user_id;
  ");
  $params = array(':user_id' => $user_id);
  $success = $statement->execute($params);

  if (!$success) {
    log_error("Reading user's notes failed. user_id was: " . $user_id . ", error was: " . $statement.errorInfo());
  }

  $results = $statement->fetchAll();

  return $results;
}

function create_note_for_user($user_id, $title, $content) {
  global $connection;

  $statement = $connection->prepare("
    INSERT INTO notes(title, content, user_id)
    VALUES (:title, :content, :user_id);
  ");
  $params = array(':title' => $title, ':content' => $content, ':user_id' => $user_id);
  $success = $statement->execute($params);

  if (!$success) {
    log_error("Adding a note failed. Error was: " . $statement.errorInfo());
  }

  $note_id = $connection->lastInsertId();

  return $note_id;
}

?>