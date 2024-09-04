<?php
require("session.php");
require("db.php");

$id=$_SESSION["idUzytkownika"];
$name = $_POST['player_name'];
$surename = $_POST['player_lastname'];
$country = $_POST['country'];
$aboutMe = $_POST['player_aboutMe'];

$sql = "UPDATE uzytkownicy SET name='$name', lastname='$surename', country='$country', info='$aboutMe' WHERE id='$id'";
if ($conn->query($sql) === TRUE) {
    header("Location: profil.php");
} else {
    echo "Błąd przy wstawianiu do tabeli forum: " . $conn->error;
}
$conn->close();
?>