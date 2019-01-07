<?php

require_once 'connection.php';

function get_notes_for_user($user_id) {
  global $connection;

  $statement = $connection->prepare("
    SELECT *
    FROM notes
    WHERE user_id = :user_id;
  ");
  $params = array(':user_id' => $user_id);
  $success = $statement->execute($params);

  // TODO: handle error

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

  // TODO: handle error

  $note_id = $connection->lastInsertId();

  return $note_id;
}

function delete_note($note_id) {
  global $connection;

  $statement = $connection->prepare("
    DELETE FROM notes
    WHERE id = :note_id;
  ");
  $params = array(':note_id' => $note_id);
  $success = $statement->execute($params);

  // TODO: handle error

  return $success;
}

?>