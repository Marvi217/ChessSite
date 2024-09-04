<?php
require("menu.php");

$sqlCountries = "SELECT id, country FROM country ORDER BY country ASC";
$resultCountries = $conn->query($sqlCountries);

$area = isset($_GET['country']) ? $_GET['country'] : '';

if (!empty($area)) {
    $sql = "SELECT id, nick, avatar, wynik, country FROM uzytkownicy WHERE country = $area ORDER BY wynik DESC";
} else {
    $sql = "SELECT id, nick, avatar, wynik, country FROM uzytkownicy ORDER BY wynik DESC";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Ranking Graczy</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/ranking.css">
</head>
<body>
    <div class="ranking_body">
        <div class="ranking_panel">
            <div class="country_ranking">
                <h3>Wybierz obszar</h3>
                <form method="get" action="">
                    <label for="player-country">Wybierz kraj:</label>
                    <select name="country" id="player-country">
                        <option value="">Globalny</option>
                        <?php
                        while ($row = $resultCountries->fetch_assoc()) {
                            $selected = ($row['id'] == $area) ? 'selected' : '';
                            echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['country'] . '</option>';
                        }
                        ?>
                    </select>
                    <input type="submit" value="Zmień kraj">
                </form>
            </div>
            <div class="flex w-60">
                <div class="ranking">
                    <h2>Ranking Graczy - 
                        <?php 
                        if (!empty($area)) {
                            $sql3 = "SELECT country FROM country WHERE id = $area";
                            $result3 = $conn->query($sql3);
                            if ($result3->num_rows > 0) {
                                $countryName = $result3->fetch_object();
                                echo $countryName->country;
                            } else {
                                echo 'Nieznany Kraj';
                            }
                        } else {
                            echo 'Globalny';
                        }
                        ?>
                    </h2>

                    <?php
                    $rank = 1;

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                        <div class="player_panel_content">
                            <div class="player_ranking_number">
                                <?php echo $rank; ?>
                            </div>
                            <div class="player_avatar">
                                <a href="mainProfil.php?id=<?php echo $row['id']; ?>">
                                    <img class="avatar" src="obrazki/avatar/<?php echo $row['avatar']; ?>" alt="Avatar">
                                </a>
                            </div>
                            <div class="player_info">
                                <div class="player_info_content">
                                    <a href="mainProfil.php?id=<?php echo $row['id']; ?>">
                                        <?php echo $row['nick']; ?>
                                    </a>
                                    <div class="flag">
                                        <?php
                                        $userCountry = $row['country'];
                                        $sql2 = "SELECT short FROM country WHERE id = $userCountry";
                                        $result2 = $conn->query($sql2);
                                        $flag = $result2->fetch_object();
                                        ?>
                                        <img src="obrazki/flag/<?php echo $flag->short; ?>.svg" alt="Flag">
                                    </div>
                                </div>
                            </div>
                            <div class="player_score">
                                <?php echo $row['wynik']; ?>
                            </div>
                        </div>
                    <?php
                            $rank++;
                        }
                    } else {
                        echo "<p>Brak wyników</p>";
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
    <?php require("footer.php")?>
</body>
</html

<?php
$conn->close();
?>