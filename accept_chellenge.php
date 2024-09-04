<?php
require("db.php");
require("session.php");

$id = $_SESSION['idUzytkownika'];
$friendId = $_GET['id'];

$sqlGame = "SELECT id FROM games WHERE white_player = $friendId AND status = 'Request'";
$wynik = $conn->query($sqlGame);
$gameId = $wynik->fetch_object()->id;
$status = "Ongoing";
$sqlJoin = "UPDATE games SET status='$status' WHERE id = $gameId";
if ($conn->query($sqlJoin)) {
    header("Location: chess.php?id=$gameId");
}

$conn->close();
?>
