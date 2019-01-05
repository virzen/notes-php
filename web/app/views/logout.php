<?php
  require __DIR__ . '/../utils/redirections.php';

  session_destroy();
  redirectTo('/login')
?>