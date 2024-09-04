<?php
require("session.php");
require("db.php");

$id = $_SESSION["idUzytkownika"];

if (isset($_POST['points'])) {
    $points = $_POST['points']; 

    $sql = "UPDATE uzytkownicy SET wynik = wynik + $points WHERE id='$id'";
    $sql2 = "INSERT INTO games (player, wynik) VALUES ('$id','$points')";

    if ($conn->query($sql) === TRUE) {
        $conn->query($sql2);
        echo "Punkty dodane";
    } else {
        echo "Błąd przy dodawaniu punktów: " . $conn->error;
    }
} else {
    echo "Błąd z punktami";
}

$conn->close();
?>
