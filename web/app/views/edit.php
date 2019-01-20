<?php
  require __DIR__ . '/../shared.php'; 
  require_once __DIR__ . '/../utils/session.php';
  require_once __DIR__ . '/../utils/redirections.php';
  require_once __DIR__ . '/../db/notes.php';

  $note_id = $_GET['note_id'];

  if (!empty($_POST)) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    update_note($note_id, $title, $content);
    redirectTo('/');
  }
  else {
    $note = get_note_of_user($note_id, get_current_user_id());
    $title = $note['title'];
    $content = $note['content'];
  }
?>

<?php render_head('Edycja notatki') ?>

<nav>
  <a href="/">Strona główna</a>
</nav>

<form method="post" action="">
  <label>Tytuł</label>
  <input type="text" name="title" value="<?php echo $title ?>" />
  <label>Treść</label>
  <textarea name="content"><?php echo $content ?></textarea>
  <button type="submit">Zaktualizuj</button>
</form>

<?php render_footer(); ?>