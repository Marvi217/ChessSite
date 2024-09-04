<?php
require("session.php");
require("db.php");

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
                            <a class='friends-actions-action' href='/play/online/new?opponent=".$user->id."' data-tooltip-target='1'>
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
                    if(empty($search)){
                        echo "0";
                    }else {
                        echo $suggestionsResult->num_rows; 
                    }
                ?>
            </span>
        </div>
    </div>
    <div class="friends-list">
        <?php if (!empty($search)) { ?>
            <?php
            if ($suggestionsResult->num_rows > 0) {
                while ($user = $suggestionsResult->fetch_object()) {
                    $userId = intval($user->id);
                    
                    $sql = "SELECT status FROM alert WHERE idUzytkownika = $userId AND temat = 'Zaproszenie'";
                    $result = $conn->query($sql);

                    $imgSrc = ($result && $result->num_rows > 0) ?'obrazki/request.svg' : 'obrazki/add_friend.svg';

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
                                <a href=sendFriendRequest.php' class='friends-actions-action add_friend' data-user-id='".$user->id."' data-tooltip-target='3'>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    $('.add_friend').on('click', function(e) {
        e.preventDefault();
        var userId = $(this).data('user-id');

        $.post('sendFriendRequest.php', { idFriend: userId }, function(data) {
                    $('a[data-user-id="'+userId+'"] .add_friend').attr('src', 'obrazki/request.svg');
                    $('a[data-user-id="'+userId+'"]').off('click');
                });
        });
    });

</script>

<?php
$wynik->free();
$suggestionsResult->free();
$conn->close();
?>