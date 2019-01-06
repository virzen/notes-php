<?php
  require_once __DIR__ . '/../db/notes.php';
  require_once __DIR__ . '/../utils/redirections.php';

  $note_id = $_GET['note_id'];

  delete_note($note_id );
  redirectTo('/');
?>