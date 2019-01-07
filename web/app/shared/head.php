<?php
  function render_head($title) {
    echo "
      <head>
        <meta charset='UTF-8'>
        <meta name='viewport' conten:='width=device-width, initial-scale=1.0'>
        <meta http-equiv='X-UA-Compatible' content='ie=edge'>
        <title>{$title}</title>
      </head>
    ";
  }
?>