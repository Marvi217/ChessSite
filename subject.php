<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Temat</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/forum.css">
</head>
<body>
    <?php
    require("menu.php");

    $forum_id = $_GET['id'];
    $sql = "SELECT id, idUzytkownika, temat, tresc, data_utworzenia FROM forum WHERE id = $forum_id";
    $result = $conn->query($sql);

    $idUzytkownika = $_SESSION['idUzytkownika'];
    $sqlAdmin = "SELECT rola FROM uzytkownicy WHERE id=$idUzytkownika";
    $admin = $conn->query($sqlAdmin);
    $admin = $admin->fetch_object();
    $rola = $admin->rola;
    ?>
    <div class="subject_autor">
        <?php
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $id = $row['id'];
                $idUzytkownika = $row['idUzytkownika'];
                $temat = $row['temat'];
                $tresc = $row['tresc'];
                $data_utworzenia = $row['data_utworzenia'];

                echo "<h1 style='margin-top: 0px'>Temat: " . $temat . "</h1>";
                echo "<p>Utworzono: " . $data_utworzenia . "</p>";

                $sqlNick = "SELECT nick FROM uzytkownicy WHERE id = $idUzytkownika";
                $resultNick = $conn->query($sqlNick);
                $nick = $resultNick->fetch_assoc();
                echo "<p>Autor: " . $nick['nick'] . "</p>";
                echo "<div class='wpis_tresc'><div class='wpis_tresc_content'><span>Treść: </span></div><div class='wpis_tresc_tresc'><span>". nl2br($tresc) ."</span></div></div>";
                echo "<div class='buttons'>";
                echo "<div id='showPostForm'><button onclick='showPostForm()'>Dodaj wpis</button></div>";
                echo "<div id='hidePostForm' class='hidden'><button onclick='hidePostForm()'>Powrót</button></div>";
                if ($rola == 'admin' || $id == $idUzytkownika) {
                    echo "<div id='deleteTopic'><a href='deleteTopic.php?id=$id' onclick='return confirm(\"Jesteś pewien, że chcesz usunąć ten temat?\")'>Usuń temat</a></div>";
                }
                echo "</div>";
            }
        ?>
    </div>
    <div class="flex">
        <?php
            $sqlSubjects = "SELECT id, idUzytkownika, tresc, data_utworzenia FROM subject WHERE forum_id = $forum_id ORDER BY data_utworzenia ASC";
            $resultSubjects = $conn->query($sqlSubjects);
            echo "<div id='posts'>";
                if ($resultSubjects->num_rows > 0) {
                    echo "<h2>Wpisy:</h2>";
                    echo "<ul>";
                    while ($subject = $resultSubjects->fetch_assoc()) {
                        $subject_id = $subject['id'];
                        $subject_content = $subject['tresc'];
                        $subject_date = $subject['data_utworzenia'];
                        $subject_user_id = $subject['idUzytkownika'];

                        $sqlSubjectNick = "SELECT nick FROM uzytkownicy WHERE id = $subject_user_id";
                        $resultSubjectNick = $conn->query($sqlSubjectNick);
                        $subject_nick = $resultSubjectNick->fetch_assoc();

                        echo "<li>";
                        echo "<p><strong>" . $subject_nick['nick'] . "</strong>:</p>";
                        echo "<p>" . nl2br($subject_content) . "</p>";
                        echo "<small>Dodano: " . $subject_date . "</small>";
                        
                        if ($_SESSION['idUzytkownika'] == $subject_user_id || $rola == 'admin') {
                            echo "<div class='post-buttons'>";
                            echo "<a href='#' class='edit-button' onclick='showEditForm($subject_id, \"" . $subject_content . "\")'>Edytuj</a>";
                            echo "<a href='deleteSubject.php?id=$subject_id&forum_id=$forum_id' class='delete-button' onclick='return confirm(\"Czy na pewno chcesz usunąć ten wpis?\");'>Usuń</a>";
                            echo "</div>";
                        }

                        echo "</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>Brak wpisów do tego tematu.</p>";
                }
            echo "</div>";
        ?>
    </div>

    <div id="editFormContainer" class="hidden">
        <form id="postFormElement" action="updatePost.php" method="post">
            <h2>Edytuj wpis:</h2>
            <input type="hidden" id="editSubjectId" name="subject_id" value="">
            <input type="hidden" id="editForumId" name="forum_id" value="<?php echo $forum_id?>">
            <label for="editSubjectContent">Treść:</label>
            <textarea id="editSubjectContent" name="content" rows="4" cols="50" required></textarea>
            <input type="submit" value="Zapisz zmiany">
        </form>
    </div>

    <div id="postForm" class="hidden">
        <h2>Dodaj nowy wpis:</h2>
        <form id="postFormElement" action="addPost.php" method="post">
            <input type="hidden" name="forum_id" value="<?php echo $id; ?>">
            <label for="tresc">Treść:</label>
            <textarea id="tresc" name="tresc" rows="4" cols="50" required></textarea>
            <input type="submit" value="Dodaj wpis">
        </form>
    </div>

    <script>
        function showPostForm() {
            document.getElementById('posts').style.display = 'none';
            document.getElementById('postForm').style.display = 'block';
            document.getElementById('showPostForm').style.display = 'none';
            document.getElementById('hidePostForm').style.display = 'block';
            document.getElementById('editFormContainer').style.display = 'none';
            
        }

        function hidePostForm() {
            document.getElementById('postForm').style.display = 'none';
            document.getElementById('posts').style.display = 'block';
            document.getElementById('showPostForm').style.display = 'block';
            document.getElementById('hidePostForm').style.display = 'none';
            document.getElementById('editFormContainer').style.display = 'none';
        }

        function showEditForm(subjectId, content) {
            document.getElementById('editSubjectId').value = subjectId;
            document.getElementById('editSubjectContent').value = content;

            document.getElementById('posts').style.display = 'none';
            document.getElementById('editFormContainer').style.display = 'block';
            document.getElementById('showPostForm').style.display = 'none';
            document.getElementById('hidePostForm').style.display = 'block';
        }
    </script>

    <?php
    require("footer.php");
    ?>
</body>
</html>
