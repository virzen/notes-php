<?php
  if (!empty($_POST)) {
    require_once __DIR__ . '/../db/user.php';
    require_once __DIR__ . '/../utils/session.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $user_id = try_login($username, $password);

    if ($user_id) {
      start_session_for($user_id);

      redirectTo('/');
    }

    if (!does_user_exist($username)) {
      $new_user_id = create_user($username, $password);

      start_session_for($new_user_id);

      redirectTo('/');
    }

    $invalid_credentials_error = true;
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login - Notes</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <h1>Login</h1>

  <form method="post" action="">
    <p>
      <?php
        if ($invalid_credentials_error) {
          echo "Nieprawidłowa kombinacja nazwy użytkownika i hasła.";
        }
      ?>
    </p>
    <label>Nazwa użytkownika</label>
    <input type="text" name="username" />
    <label>Hasło</label>
    <input type="password" name="password" />
    <button type="submit">Zaloguj</button>
  </form>
</body>
</html>