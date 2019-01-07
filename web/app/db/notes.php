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

function get_note($note_id) {
  global $connection;

  $statement = $connection->prepare("
    SELECT *
    FROM notes
    where id = :note_id
  ");
  $params = array(':note_id' => $note_id);
  $statement->execute($params);

  // TODO: handle error

  $note = $statement->fetch();

  return $note;
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

function update_note($note_id, $new_title, $new_content) {
  global $connection;

  $statement = $connection->prepare("
    UPDATE notes
    SET title = :title, content = :content
    WHERE id = :note_id;
  ");
  $params = array(':title' => $new_title, ':content' => $new_content, ':note_id' => $note_id);
  $success = $statement->execute($params);

  // TODO: handle error

  return $success;
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