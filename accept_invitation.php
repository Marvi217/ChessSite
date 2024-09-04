<?php
require("db.php");
require("session.php");

$id = $_SESSION['idUzytkownika'];
$friendId = $_GET['id'];


if ($id > 0 && $friendId > 0 && $id != $friendId) {
    $sql1 = "INSERT INTO friends (idUzytkownika, idFriend) VALUES ('$id', '$friendId')";
    $sql2 = "INSERT INTO friends (idUzytkownika, idFriend) VALUES ('$friendId', '$id')";
    $sql3 = "UPDATE alert SET status='accept' WHERE idUzytkownika='$id' AND idFriend='$friendId' AND temat='Zaproszenie'";

    $success = true;

    if ($conn->query($sql1) === FALSE) {
        echo "Błąd przy dodawaniu znajomego (pierwsze zapytanie): " . $conn->error;
        $success = false;
    }

    if ($conn->query($sql2) === FALSE) {
        echo "Błąd przy dodawaniu znajomego (drugie zapytanie): " . $conn->error;
        $success = false;
    }

    if ($conn->query($sql3) === FALSE) {
        echo "Błąd przy dodawaniu statusu: " . $conn->error;
        $success = false;
    }

    if ($success) {
        $conn->commit();
        header("Location: alert.php");
        exit();
    } else {
        $conn->rollback();
    }

} else {
    echo "Nieprawidłowe dane wejściowe lub próba dodania siebie samego jako znajomego.";
}

$conn->close();
?>
