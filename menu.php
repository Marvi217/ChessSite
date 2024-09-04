<?php
require("session.php");
require("db.php");
?>
<div class="top-panel">
    <div class="logo_menu">
    <a href="index.php" class="logo_menu_img">
        <img src="obrazki/chess_logo.jpg" alt="logo" width="200px">
    </a>
    </div>
    <div class="dropdown">  
            <a href="ranking.php">Ranking graczy</a>
        </div>
    <div class="dropdown">
        <a href="forum.php">Forum</a>
    </div>
    <div class="dropdown">
        <a href="chess.php">Zagraj</a>  
    </div>
    <div class="dropdown">
        <a href="profil.php">Konto</a>
        <div class="dropdown-content">
            <p>Witaj <?= $_SESSION["login"] ?>!</p>
            <a href="mainProfil.php?id=<?php echo $id = $_SESSION['idUzytkownika']?>">Profil</a>
            <a href="alert.php">Powiadominia</a>
            <a href="friends.php">Znajomi</a>
            <a href="profil.php">Ustawienia</a>
            <?php
                $id = $_SESSION["idUzytkownika"];
                $sql = "SELECT rola FROM uzytkownicy WHERE id = '$id'";
                $r = $conn->query($sql);
                $rola = $r->fetch_object();
                if (isset($_SESSION["login"]) && $rola->rola == "admin") {
                echo "<a href='reportViewer.php'>Panel zgłoszeń</a>";
                }
            ?>
            <a href="logout.php">Wyloguj</a>
        </div>
    </div>  
</div>

