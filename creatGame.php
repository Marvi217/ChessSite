<?php
require("db.php");
require("session.php");

$turn = $_POST['turn'];
$gameId = $_POST['gameId'];

$sql = "UPDATE games SET current_turn = '$turn' WHERE id=$gameId";

if ($conn->query($sql) === TRUE) {
    echo "Gra zapisana.";
} else {
    echo "Błąd zapisu gry " . $conn->error;
}
?>
