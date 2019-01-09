<?php
  require __DIR__ . '/../shared.php';
  require_once __DIR__ . '/../db/notes.php';
  require_once __DIR__ . '/../utils/session.php';
?>

<?php render_head('Strona główna') ?>

<nav>
  <a href="/new">Dodaj notatkę</a>
  <a href="/change-password">Zmień hasło</a>
  <a href="/logout">Wyloguj</a>
</nav>

<?php
  $notes = get_notes_for_user(get_current_user_id());

  if (count($notes) == 0) {
    echo "Brak notatek do wyświetlenia.";
  }

  if (count($notes) > 0) {
    foreach ($notes as $note) {
      echo "
        <h2 class='note-title'><span class='note-title-text'>{$note['title']}</span></h2>
        <time>Last modified at: {$note['last_modification_date']}</time>
        <p class='note-content'>{$note['content']}</p>
        <a href='/delete?note_id={$note['id']}'>Usuń</a>
        <a href='/edit?note_id={$note['id']}'>Edytuj</a>
      ";
    }
  }
?>

<?php render_footer(); ?>
