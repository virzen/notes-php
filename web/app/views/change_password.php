<?php
  require __DIR__ . '/../shared.php'; 

  if (!empty($_POST)) {
    require_once __DIR__ . '/../utils/session.php';
    require_once __DIR__ . '/../db/user.php';

    $current_password = $_POST['current-password'];
    $new_password = $_POST['new-password'];

    $current_user_id = get_current_user_id();

    if (is_password_correct_for_user($current_user_id, $current_password)) {
      update_password_for_user($current_user_id, $new_password);
      $password_update_success = true;
    }
    else {
      $incorrect_password_error = true;
    }
  }
?>

<?php render_head('Zmiana hasła') ?>

<nav>
  <a href="/">Strona główna</a>
</nav>

<p>
  <?php
    if ($password_update_success) {
      echo 'Hasło zmienione.';
    }
  ?>
</p>
<p>
  <?php
    if ($incorrect_password_error) {
      echo "Podane niepoprawne aktualne hasło.";
    }
  ?>
</p>
<form action="" method="post">
  <label>Aktualne hasło</label>
  <input type="password" name="current-password" />
  <label>Nowe hasło</label>
  <input type="password" name="new-password" />
  <button type="submit">Zmień hasło</button>
</form>

<?php render_footer(); ?>