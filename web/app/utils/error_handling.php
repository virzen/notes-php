<?php
  require_once 'redirections.php';

  function log_error($message) {
    error_log($message);
    redirectTo('/error');
  }
?>