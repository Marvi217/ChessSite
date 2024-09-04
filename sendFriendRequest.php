<?php
require("db.php");
require("session.php");

$userId = $_SESSION['idUzytkownika'];
$friendId = $_POST['idFriend'];

$sqlNick = "SELECT nick FROM uzytkownicy WHERE id = $userId";
$resultNick = $conn->query($sqlNick);
$nick = $resultNick->fetch_object()->nick;

$tresc = "Użytkownik $nick wysłał ci zaproszenie do grona znajomych";
$temat = "Zaproszenie";

$sqlAlert = "INSERT INTO alert (idUzytkownika, idFriend, temat, tresc) VALUES ('$friendId', '$userId', '$temat', '$tresc')";
if ($conn->query($sqlAlert) === TRUE) {
    echo "succes";
}
$conn->close();
?>
