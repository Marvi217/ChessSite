<?php
require("db.php");
require("session.php");

$gameId = $_POST['gameId'];

$sql = "SELECT curent_turn FROM games WHERE game_id = '$gameId'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $gameData = $result->fetch_assoc();
    echo $gameData['curent_turn'];
} else {
    echo 'Error: Game not found.';
}

$conn->close();
?>
