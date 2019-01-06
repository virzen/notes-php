<?php
    require_once __DIR__ . '/../db/notes.php';
    require_once __DIR__ . '/../utils/session.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Notes Home</title>
    </head>
    <body>
        <h1>Here will be them notes</h1>

        <a href="/new">Dodaj notatkę</a>

        <?php
            $notes = get_notes_for_user(get_current_user_id());
            if (count($notes) == 0) {
                echo "Brak notatek do wyświetlenia.";
            }

            if (count($notes) > 0) {
                foreach ($notes as $note) {
                    echo "
                        <h2>{$note['title']}</h2>
                        <p>{$note['content']}</p>
                    ";
                }
            }
        ?>

        <a href="/logout">Logout</a>
    </body>
</html>
