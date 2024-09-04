<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Strona główna</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <?php
    require("menu.php");
    ?>
    <div class="index-main-panel">
        <div class="main-panel_index">
            <?php
                $id = $_SESSION["idUzytkownika"];
                $sql = "SELECT rola FROM uzytkownicy WHERE id = '$id'";
                $r = $conn->query($sql);
                $rola = $r->fetch_object();
                if (isset($_SESSION["login"]) && $rola->rola == "admin") {
                    echo "<div class='add_button show'>
                            <a href='#' class='toggle-announcement-form'>Dodaj ogłoszenie</a>
                        </div>
                        <div class='back_button hidden'>
                            <a href='#' class='back'>Powrót</a>
                        </div>";
                }
            ?>
            <div class="announcement-panel hidden">
                <form action="insertAnnouncement.php" method="POST" class="announcement-form">
                    <label for="announcement-title">Tytuł:</label>
                    <input type="text" id="announcement-title" name="title" required placeholder="Wprowadź tytuł ogłoszenia">
                    
                    <label for="announcement-content">Treść:</label>
                    <textarea id="announcement-content" name="content" required placeholder="Wprowadź treść ogłoszenia"></textarea>
                    
                    <button type="submit" class="submit-button">Dodaj Ogłoszenie</button>
                </form>
            </div>

            <div class="edit-announcement-panel hidden">
                <form action="editAnnouncement.php" method="POST" class="announcement-edit-form">
                    <input type="hidden" id="edit-announcement-id" name="id">
                    
                    <label for="edit-announcement-title">Tytuł:</label>
                    <input type="text" id="edit-announcement-title" name="title" required placeholder="Wprowadź tytuł ogłoszenia">
                    
                    <label for="edit-announcement-content">Treść:</label>
                    <textarea id="edit-announcement-content" name="content" required placeholder="Wprowadź treść ogłoszenia"></textarea>
                    
                    <button type="submit" class="submit-button">Zapisz zmiany</button>
                </form>
            </div>
            <div class="alerts">
                <?php
                $sql = "SELECT * FROM alerts";
                $wynik = $conn->query($sql);
                while ($dane = $wynik->fetch_object()) {
                    echo "<div id='alerts-$dane->id'>
                            <div class='alerts-title'>$dane->tytul</div>
                            <div class='alerts-tresc'>" .nl2br($dane->tresc) . "</div>
                            <div class='alerts-date'>$dane->data_utworzenia</div>";
                    if ($rola->rola == "admin") {
                        echo "<button class='edit-button' data-id='$dane->id' data-title='$dane->tytul' data-content='$dane->tresc'>Edytuj</button>
                            <button class='delete-button' data-id='$dane->id'>Usuń</button>";
                    }
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
    
    <?php       
    require("footer.php");
    ?>

    <script>
        $(document).ready(function() {
            $('.toggle-announcement-form').on('click', function(event) {
                event.preventDefault();
                $('.add_button').hide();
                $('.back_button').show();
                $('.announcement-panel').show();
                $('.alerts').hide();
            });

            $('.back').on('click', function(event) {
                event.preventDefault();
                $('.add_button').show();
                $('.back_button').hide();
                $('.announcement-panel').hide();
                $('.edit-announcement-panel').hide();
                $('.alerts').show();
            });

            $(document).on('click', '.edit-button', function() {
                const id = $(this).data('id');
                const title = $(this).data('title');
                const content = $(this).data('content');

                $('#edit-announcement-id').val(id);
                $('#edit-announcement-title').val(title);
                $('#edit-announcement-content').val(content);

                $('.edit-announcement-panel').show();
                $('.announcement-form').hide();
                $('.alerts').hide();
                $('.add_button').hide();
                $('.back_button').show();
            });

            $(document).on('click', '.delete-button', function() {
                const id = $(this).data('id');

                if (confirm('Czy napewno chcesz usunąć ogłoszenie?')) {
                    $.post('deleteAnnouncement.php', { id: id }, function(data) {
                        if (data === "success") {
                            $('#alerts-' + id).remove();
                        }
                    });
                }
            });
        });


    </script>
</body>
</html>
