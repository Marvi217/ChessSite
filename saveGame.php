<?php
require("db.php");
require("session.php");

$gameId = $_POST['gameId'];
$boardState = $_POST['boardState'];
$move_number = $_POST['moveCount'];

$sql = "INSERT INTO board (game_id, board, move_number) VALUES ('$gameId', '$boardState', '$move_number')";

if ($conn->query($sql) === TRUE) {
    echo "Gra zapisana.";
} else {
    echo "Błąd zapisu gry " . $conn->error;
}
?>
