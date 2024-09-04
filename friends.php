<?php
require("menu.php");
$id = $_SESSION['idUzytkownika'];
$search = isset($_POST['friend_search']) ? $_POST['friend_search'] : '';

$search = str_replace(array('\\', '(', ')', "'", '"', ';'), '', $search);

$sql = "
    SELECT u.id, u.nick, u.avatar
    FROM friends f 
    JOIN uzytkownicy u ON u.id = f.idFriend 
    WHERE f.idUzytkownika = $id AND u.nick LIKE '%$search%'
";

$wynik = $conn->query($sql);

$suggestionsQuery = "
    SELECT id, nick, avatar
    FROM uzytkownicy
    WHERE id != $id AND nick LIKE '%$search%'
    AND id NOT IN (
        SELECT idFriend 
        FROM friends 
        WHERE idUzytkownika = $id
    )
";
$suggestionsResult = $conn->query($suggestionsQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Friends</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/friends.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.add_friend').on('click', function(e) {
                e.preventDefault();
                var userId = $(this).data('user-id');

                $.post('sendFriendRequest.php', { idFriend: userId }, function(data) {
                    if(data = "succes"){
                        $('a[data-user-id="'+userId+'"] .add_friend').attr('src', 'obrazki/request.svg');
                        $('a[data-user-id="'+userId+'"]').off('click');
                    }
                });
            });
        });

        function searchFriends() {
            let query = $('#friend_search').val();
            $.post('friendSearch.php', { friend_search: query }, function(data) {
                $('#search-results').html(data);
            });
        }
    </script>
</head>
<body>
    <div class="window">
        <div class="v5-section">
            <div class="v5-section-content">
                <div class="friend_header">
                    <div class="friend_icon">
                        <img class="friend_icon" src="obrazki/friends.svg" alt="Znajomi">
                    </div>
                    <span>Znajomi</span>
                </div>
                <div class="friends-section-search">
                    <form id="friend_search_form" method="post">
                        <span class="friends-search-icon">
                            <img class="friends-search-icon" src="obrazki/glass.svg" alt="Szukaj">
                        </span>
                        <div class="search-input">
                            <input class="friends-search-input"  
                            aria-label="Szukaj"
                            maxlength="64" 
                            name="friend_search" 
                            id="friend_search" 
                            placeholder="Wyszukaj po nicku" 
                            onkeyup="searchFriends()">
                        </div>
                    </form>
                </div>
                
                <div class="friends-search-results" id="search-results">
                    <div class="friends-section-header">
                        <div class="friends-section-title">
                            Znajomi <span class="friends-section-count"><?php echo $wynik->num_rows; ?></span>
                        </div>
                    </div>
                    <div class="friends-list">
                        <?php
                        if ($wynik->num_rows > 0) {
                            while ($user = $wynik->fetch_object()) {
                                echo "<div class='users-list-item'>
                                        <a class='user-avatar-component users-list-avatar' href='mainProfil.php?id=".$user->id."' style='height: 8.8rem; width: 8.8rem;'>
                                            <img class='user-avatar-image' height='88' src='obrazki/avatar/".$user->avatar."' width='88'>
                                        </a>
                                        <div class='users-list-details'>
                                            <a class='cc-text-medium-bold cc-user-username-component cc-user-username-default' href='mainProfil.php?id=".$user->id."'>".$user->nick."</a>
                                        </div>
                                        <div class='friends-actions-component'>
                                            <a class='friends-actions-action' href='challenge.php?id=".$user->id."' data-tooltip-target='1'>
                                                <span class='friends-actions-icon chess-board-plus icon-font-chess'>
                                                    <img src='obrazki/challenge.svg'>
                                                </span> 
                                            </a>
                                        </div>
                                      </div>";
                            }
                        } else {
                            echo "<div class='friends-section-empty'>Nie znaleziono żadnych wyników.</div>";
                        }
                        ?>
                    </div>

                    <div class="friends-section-header">
                        <div class="friends-section-title">
                            Sugestie 
                            <span class="friends-section-count">
                                <?php
                                    echo empty($search) ? "0" : $suggestionsResult->num_rows;
                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="friends-list">
                        <?php if (!empty($search)) { ?>
                            <?php
                            if ($suggestionsResult->num_rows > 0) {
                                while ($user = $suggestionsResult->fetch_object()) {
                                    $userId = $user->id;
                                    
                                    $sql = "SELECT status FROM alert WHERE idUzytkownika = $userId AND temat = 'Zaproszenie'";
                                    $result = $conn->query($sql);

                                    $imgSrc = ($result && $result->num_rows > 0) ? 'obrazki/request.svg' : 'obrazki/add_friend.svg';

                                    echo "<div class='users-list-item'>
                                            <a class='user-avatar-component users-list-avatar' href='mainProfil.php?id=".$user->id."' style='height: 8.8rem; width: 8.8rem;'>
                                                <img class='user-avatar-image' height='88' src='obrazki/avatar/".$user->avatar."' width='88'>
                                            </a>
                                            <div class='users-list-details'>
                                                <a class='cc-text-medium-bold cc-user-username-component cc-user-username-default' href='mainProfil.php?id=".$user->id."'>".$user->nick."</a>
                                            </div>
                                            <div class='friends-actions-component'>
                                                <a class='friends-actions-action' href='/play/online/new?opponent=".$user->id."' data-tooltip-target='1'>
                                                    <span class='friends-actions-icon chess-board-plus icon-font-chess'>
                                                        <img src='obrazki/challenge.svg'>
                                                    </span> 
                                                </a>
                                                <a href='sendFriendRequest.php' class='friends-actions-action add_friend' data-user-id='".$user->id."' data-tooltip-target='3'>
                                                    <span class='friends-actions-icon user-plus icon-font-chess add_friend'>
                                                        <img class='add_friend' src='".$imgSrc."'>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>";
                                }
                            } else {
                                echo "<div class='friends-section-empty'>Brak sugestii do wyświetlenia.</div>";
                            }
                            ?>
                        <?php 
                        } else {
                            echo "<div class='friends-section-empty'>Wypełnij pole wyszukiwania.</div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require("footer.php"); ?>
</body>
</html>

<?php
$wynik->free();
$suggestionsResult->free();
$conn->close();
?>
