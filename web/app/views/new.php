<?php
  require __DIR__ . '/../shared.php';
  require_once __DIR__ . '/../utils/session.php';
  require_once __DIR__ . '/../utils/redirections.php';
  require_once __DIR__ . '/../db/notes.php';

  if (!empty($_POST)) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = get_current_user_id();

    create_note_for_user($user_id, $title, $content);
    redirectTo('/');
  }
?>

<?php render_head('Nowa notatka'); ?>

<nav>
  <a href="/">Strona główna</a>
</nav>

<form method="post" action="">
  <label>Tytuł</label>
  <input type="text" name="title" />
  <label>Treść</label>
  <textarea name="content"></textarea>
  <button type="submit">Utwórz</button>
</form>

<?php render_footer(); ?>