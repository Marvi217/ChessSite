<?php
    require("menu.php");
    $id = isset($_GET['id']) ? $_GET['id'] : $_SESSION['idUzytkownika'];
    $hideAvatarChange = isset($_GET['id']) ? 'true' : 'false';
    $id_session = $_SESSION['idUzytkownika'];
    $sql = "SELECT nick FROM uzytkownicy WHERE id = $id";
    $result = $conn->query($sql);
    $result = $result->fetch_object();
    $nick = $result->nick;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $nick; ?></title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/mainProfil.css">
</head>
<body>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var hideAvatarChange = '<?php echo $hideAvatarChange; ?>';
            if (hideAvatarChange === 'true') {
                var avatarChangeElement = document.getElementById('player_avatar_change');
                if (avatarChangeElement) {
                    avatarChangeElement.style.display = 'none';
                }
            }

            var showAllFriendsButton = document.getElementById('showAllFriends');
            if (showAllFriendsButton) {
                showAllFriendsButton.addEventListener('click', function() {
                    var fullFriendsList = document.getElementById('fullFriendsList');
                    var limitedFriendsList = document.getElementById('limitedFriendsList');
                    if (fullFriendsList && limitedFriendsList) {
                        fullFriendsList.style.display = 'block';
                        limitedFriendsList.style.display = 'none';
                        this.style.display = 'none';
                    }
                });
            }
        });
    </script>
    <div class="container">
        <div class="main_panel">
            <div class="player_panel_info">
                <div class="player_mainPanel_info_content">
                    <div class="player_avatar">
                        <div class="player_avatar_change" id="player_avatar_change">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" onclick="document.getElementById('avatarFile').click();">
                                <path d="M11 4H7.2C6.0799 4 5.51984 4 5.09202 4.21799C4.71569 4.40974 4.40973 4.7157 4.21799 5.09202C4 5.51985 4 6.0799 4 7.2V16.8C4 17.9201 4 18.4802 4.21799 18.908C4.40973 19.2843 4.71569 19.5903 5.09202 19.782C5.51984 20 6.0799 20 7.2 20H16.8C17.9201 20 18.4802 20 18.908 19.782C19.2843 19.5903 19.5903 19.2843 19.782 18.908C20 18.4802 20 17.9201 20 16.8V12.5M15.5 5.5L18.3284 8.32843M10.7627 10.2373L17.411 3.58902C18.192 2.80797 19.4584 2.80797 20.2394 3.58902C21.0205 4.37007 21.0205 5.6364 20.2394 6.41745L13.3774 13.2794C12.6158 14.0411 12.235 14.4219 11.8012 14.7247C11.4162 14.9936 11.0009 15.2162 10.564 15.3882C10.0717 15.582 9.54378 15.6885 8.48793 15.9016L8 16L8.04745 15.6678C8.21536 14.4925 8.29932 13.9048 8.49029 13.3561C8.65975 12.8692 8.89125 12.4063 9.17906 11.9786C9.50341 11.4966 9.92319 11.0768 10.7627 10.2373Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                        <div class="player_avatar_content">
                            <?php
                            if ($conn) {
                                $sql = "SELECT avatar FROM uzytkownicy WHERE id=$id";
                                $wynik = $conn->query($sql);
                                $row = $wynik->fetch_object();
                                
                                if ($row) {
                                    echo "<img class='avatar' src='obrazki/avatar/" . $row->avatar . "' alt='Avatar'>";
                                }
                            } else {
                                echo "Błąd połączenia z bazą danych.";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="player_info">
                        <div class="player_info_content">
                            <?php
                            if ($conn) {
                                $sql = "SELECT nick, country FROM uzytkownicy WHERE id = $id";
                                $result = $conn->query($sql);
                                
                                if ($result && $user = $result->fetch_object()) {
                                    echo $user->nick;
                                    
                                    $countryId = $user->country;
                                    $sql2 = "SELECT flag FROM country WHERE id = $countryId";
                                    $result2 = $conn->query($sql2);
                                    
                                    if ($result2 && $country = $result2->fetch_object()) {
                                        echo "<img src='obrazki/flag/" . $country->flag . "' alt='Flag' />";
                                    }
                                } else {
                                    echo "Użytkownik nie znaleziony.";
                                }
                            } else {
                                echo "Błąd połączenia z bazą danych.";
                            }
                            ?>
                        </div>
                        <div class="registrtion_date">
                            <?php
                            if ($conn) {
                                $sql = "SELECT data_utworzenia FROM uzytkownicy WHERE id = '$id'";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $date = $result->fetch_object();
                                    echo "<small>Utworzono: " . $date->data_utworzenia . "</small>";
                                } else {
                                    echo "<small>Data utworzenia nie jest dostępna.</small>";
                                }
                            } else {
                                echo "Błąd połączenia z bazą danych.";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="rank">
                        <?php
                        if ($conn) {
                            $sql = "SELECT wynik FROM uzytkownicy WHERE id = $id";
                            $result = $conn->query($sql);
                            
                            if ($result && $wynik = $result->fetch_object()) {
                                echo "Punkty: " . $wynik->wynik;
                            }
                        } else {
                            echo "Błąd połączenia z bazą danych.";
                        }
                        ?>
                    </div>
                </div>
                <div class="profile_description">
                    <p>O mnie: </p>
                    <?php
                    if ($conn) {
                        $sql_description = "SELECT info FROM uzytkownicy WHERE id = $id";
                        $result_description = $conn->query($sql_description);
                        
                        if ($result_description && $description = $result_description->fetch_object()) {
                            echo "<p>" . $description->info . "</p>";
                        } else {
                            echo "<p>Brak opisu profilu.</p>";
                        }
                    } else {
                        echo "Błąd połączenia z bazą danych.";
                    }
                    ?>
                </div>
            </div>
            <div class="right_panel">
                <div class="game_panel">
                    <div class="historia">
                        <h3>Historia gier: </h3>
                        <?php
                        if ($conn) {
                            $sql_historia = "SELECT * FROM games2 WHERE player = $id ORDER BY id DESC LIMIT 5";
                            $result_historia = $conn->query($sql_historia);

                            if ($result_historia && $result_historia->num_rows > 0) {
                                echo "<ul>";
                                while ($row = $result_historia->fetch_assoc()) {
                                    echo "<li>Id gry: " . $row['id'] . " - Wynik: " . $row['wynik'] . "</li>";
                                }
                                echo "</ul>";
                            } else {
                                echo "Brak historii gier.";
                            }
                        } else {
                            echo "Błąd połączenia z bazą danych.";
                        }
                        ?>
                    </div>
                    <div class="comments_panel">
                        <h3>Komentarze</h3>
                        <?php
                        if ($id_session != $id) {
                            echo "<form action='add_comment.php' method='POST'>
                                    <textarea id='comentArea' name='comment' placeholder='Dodaj komentarz...'></textarea>
                                    <br>
                                    <input type='hidden' name='profile_id' value='" . $id . "'>
                                    <button type='submit'>Dodaj komentarz</button>
                                </form>";
                        }
                        if ($conn) {
                            $sql_comments = "
                            SELECT c.idComent, c.tresc, c.data_utworzenia, u.nick, u.avatar 
                            FROM profilcoments c
                            JOIN uzytkownicy u ON c.idComent = u.id 
                            WHERE c.idUzytkownika = $id 
                            ORDER BY c.data_utworzenia DESC";
                            $result_comments = $conn->query($sql_comments);

                            if ($result_comments && $result_comments->num_rows > 0) {
                                while ($comment = $result_comments->fetch_object()) {
                                    echo "<div class='comment'>
                                            <div class='comment_avatar'>
                                                <a href='mainProfil.php?id=$comment->idComent'>
                                                <img src='obrazki/avatar/" . $comment->avatar . "' alt='Avatar' />
                                                </a>
                                                </div>
                                            <div class='comment_content'>
                                                <a href='mainProfil.php?id=$comment->idComent'>
                                                    <strong>" . $comment->nick . "</strong>
                                                </a>
                                                <small>" . $comment->data_utworzenia . "</small>
                                                <p>" . $comment->tresc . "</p>
                                            </div>
                                        </div>";
                                }
                            } else {
                                echo "Brak komentarzy.";
                            }
                        } else {
                            echo "Błąd połączenia z bazą danych.";
                        }
                        ?>
                    </div>

                </div>
                <div class="friends_list">
                    <h3>Znajomi</h3>
                    <ul id="limitedFriendsList">
                        <?php
                        if ($conn) {
                            $sql = "
                            SELECT f.idFriend, u2.nick 
                            FROM friends f 
                            JOIN uzytkownicy u2 ON f.idFriend = u2.id 
                            WHERE f.idUzytkownika = $id";
                        
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($friend = $result->fetch_object()) {
                                    echo "<li><a href='mainProfil.php?id=" . $friend->idFriend . "'>" . $friend->nick . "</a></li>";
                                }
                            } else {
                                echo "<li>Brak znajomych</li>";
                            }
                        } else {
                            echo "Błąd połączenia z bazą danych.";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php require("footer.php"); ?>
</body>
</html>
