<?php
  require_once __DIR__ . '/../utils/redirections.php';
  require_once __DIR__ . '/../utils/session.php';

  if (is_session_active()) {
    session_destroy();
  }
  redirectTo('/login')
?>