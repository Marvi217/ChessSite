<?php
require("db.php");
require("session.php");

$userId = $_SESSION['idUzytkownika'];
$friendId = $_GET['id'];

$sqlNick = "SELECT nick FROM uzytkownicy WHERE id = $userId";
$resultNick = $conn->query($sqlNick);
$nick = $resultNick->fetch_object()->nick;

$tresc = "Użytkownik $nick wysłał zaproszenie do gry";
$temat = "Challenge";

$sqlAlert = "INSERT INTO alert (idUzytkownika, idFriend, temat, tresc) VALUES ('$friendId', '$userId', '$temat', '$tresc')";
if ($conn->query($sqlAlert) === TRUE) {
    echo "succes";
}
$status = "Request";
$sqlGame = "INSERT INTO games (white_player, black_player, status) VALUES ('$userId', '$friendId', '$status')";
if ($conn->query($sqlGame) === TRUE) {
    echo "succes 2";
}

$sqlStarting = "SELECT id FROM games WHERE white_player = $userId AND status = '$status'";
$wynik = $conn->query($sqlStarting);
if ($wynik->num_rows > 0) {
    $id = $wynik->fetch_object()->id;
    header("Location: chess.php?id=$id");
}
$conn->close();
?>
