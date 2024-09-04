<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Moje dane</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/settings.css">

</head>
<body>
    <?php
    require("menu.php");
    $id = isset($_GET['id']) ? $_GET['id'] : $_SESSION['idUzytkownika'];
    $hideAvatarChange = isset($_GET['id']) ? 'true' : 'false';
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var hideAvatarChange = '<?php echo $hideAvatarChange; ?>';
            if (hideAvatarChange === 'true') {
                document.getElementById('player_avatar_change').style.display = 'none';
            }
            
        });
    </script>
    <div class="panel">
        <?php
            require("sidePanel.php");
        ?>
        <div class="main_panel">
            <div class="player_panel_info">
                <div class="player_panel_content">
                    <div class="player_avatar">
                        <div class="player_avatar_content">
                            <div class="player_avatar_change" id="player_avatar_change">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" onclick="document.getElementById('avatarFile').click();">
                                    <path d="M11 4H7.2C6.0799 4 5.51984 4 5.09202 4.21799C4.71569 4.40974 4.40973 4.7157 4.21799 5.09202C4 5.51985 4 6.0799 4 7.2V16.8C4 17.9201 4 18.4802 4.21799 18.908C4.40973 19.2843 4.71569 19.5903 5.09202 19.782C5.51984 20 6.0799 20 7.2 20H16.8C17.9201 20 18.4802 20 18.908 19.782C19.2843 19.5903 19.5903 19.2843 19.782 18.908C20 18.4802 20 17.9201 20 16.8V12.5M15.5 5.5L18.3284 8.32843M10.7627 10.2373L17.411 3.58902C18.192 2.80797 19.4584 2.80797 20.2394 3.58902C21.0205 4.37007 21.0205 5.6364 20.2394 6.41745L13.3774 13.2794C12.6158 14.0411 12.235 14.4219 11.8012 14.7247C11.4162 14.9936 11.0009 15.2162 10.564 15.3882C10.0717 15.582 9.54378 15.6885 8.48793 15.9016L8 16L8.04745 15.6678C8.21536 14.4925 8.29932 13.9048 8.49029 13.3561C8.65975 12.8692 8.89125 12.4063 9.17906 11.9786C9.50341 11.4966 9.92319 11.0768 10.7627 10.2373Z" 
                                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                            <div class="player_avatar_content">
                                <?php
                                    $id = isset($_GET['id']) ? $_GET['id'] : $_SESSION['idUzytkownika'];
                                    $sql = "SELECT avatar FROM uzytkownicy WHERE id=$id";
                                    $wynik = $conn->query($sql);
                                    $row = $wynik->fetch_object();
                                    
                                    if ($row) {
                                        echo "<img class='avatar' src='obrazki/avatar/" . $row->avatar. "' alt='Avatar'>";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <form id="uploadForm" action="insertAvatar.php" method="post" enctype="multipart/form-data" style="display:none;">
                        <input type="file" name="avatar" id="avatarFile" accept="image/*" onchange="document.getElementById('uploadForm').submit();">
                    </form>
                    <div class="player_info">
                        <div class="player_info_content">
                            <?php
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
                            ?>
                        </div>
                    </div>
                    </div>
                    <div class="main_panel_info">
                        <div class="formContentProfil" id="updateProfil">
                            <form method="post" action="updateProfil.php">
                                <div class="info-lable">
                                    <div class="info-lable-lable">Nazwa użytkownika</div>
                                    <div class="info-player-data">
                                        <?php
                                            $sql = "SELECT nick FROM uzytkownicy WHERE id = '$id'";
                                            $r = $conn->query($sql);
                                            $nick = $r->fetch_object();
                                            echo $nick->nick;
                                        ?>
                                    </div>
                                </div>
                                <div class="info-lable">
                                    <label for="player-name">Imię</label>
                                    <div class="player_input">
                                        <input type="text" id="name" name="player_name" placeholder 
                                        value="<?php
                                            $sql = "SELECT name FROM uzytkownicy WHERE id = '$id'";
                                            $r = $conn->query($sql);
                                            $name = $r->fetch_object();
                                            echo $name->name;
                                        ?>">
                                    </div>
                                </div>
                                <div class="info-lable">
                                    <label for="player-lastname">Nazwisko</label>
                                    <div class="player_input">
                                        <input type="text" id="lastname" name="player_lastname" placeholder 
                                        value="<?php
                                            $sql = "SELECT lastname FROM uzytkownicy WHERE id = '$id'";
                                            $r = $conn->query($sql);
                                            $lastname = $r->fetch_object();
                                            echo $lastname->lastname;
                                        ?>">
                                    </div>
                                </div>
                                <div class="info-lable">
                                    <label for="player-country">Kraj</label>
                                    <div class="player_input">
                                        <?php
                                            $sql = "SELECT country FROM uzytkownicy WHERE id = '$id'";
                                            $r = $conn->query($sql);
                                            $userCountryId = $r->fetch_object()->country;

                                            $sqlCountries = "SELECT id, country FROM country ORDER BY country ASC";
                                            $resultCountries = $conn->query($sqlCountries);
                                            echo '<select name="country" id="player-country">';
                                            while ($row = $resultCountries->fetch_assoc()) {
                                                $selected = ($row['id'] == $userCountryId) ? 'selected' : '';
                                                echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['country'] . '</option>';
                                            }
                                            echo '</select>';
                                        ?>

                                    </div>
                                </div>
                                <div class="">
                                    <label for="AboutMe">O mnie</label>
                                    <div class="aboutMe_input">
                                        <textarea name="player_aboutMe" id="AboutMe"><?php
                                        $sql = "SELECT info FROM uzytkownicy WHERE id = $id";
                                        $wynikSQL = $conn->query($sql);
                                        $aboutMe = $wynikSQL->fetch_object();
                                        echo htmlspecialchars(trim($aboutMe->info));
                                        ?></textarea>
                                    </div>
                                </div>
                                <div>
                                    <input type='submit' value='Zapisz'>
                                </div>
                            </form>
                        </div>
                        <div class="registrtion_date">
                            <?php
                                $id = isset($_GET['id']) ? $_GET['id'] : $_SESSION['idUzytkownika'];
                                $sql = "SELECT data_utworzenia FROM uzytkownicy WHERE id = '$id'";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $date = $result->fetch_object();
                                    echo "<small>Utworzono: " . $date->data_utworzenia . "</small>";
                                } else {
                                    echo "<small>Data utworzenia nie jest dostępna. $id</small>";
                                }

                                $conn->close();
                            ?>
                        </div>
                    </div>
        <?php require("footer.php");?>              
    </div>
    
</body>
</html>