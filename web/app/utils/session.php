<?php
  function is_session_active() {
    return isset($_SESSION['user_id']);
  }

  function start_session_for($user_id) {
    session_start();
    $_SESSION['user_id'] = $user_id;
  }

  function get_current_user_id() {
    return $_SESSION['user_id'];
  }
?>