<?php
    require_once __DIR__ . '/../db/notes.php';
    require_once __DIR__ . '/../utils/session.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Strona domowa</title>
    </head>
    <body>
        <h1>Notatki</h1>

        <a href="/logout">Wyloguj</a>
        <a href="/new">Dodaj notatkę</a>
        <a href="/change-password">Zmień hasło</a>

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
                        <a href='/delete?note_id={$note['id']}'>Usuń</a>
                        <a href='/edit?note_id={$note['id']}'>Edytuj</a>
                    ";
                }
            }
        ?>

    </body>
</html>
