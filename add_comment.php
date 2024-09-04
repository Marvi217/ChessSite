<?php
    require("db.php");
    require("session.php");

    $id = $_SESSION['idUzytkownika'];
    $profil_id = $_POST['profile_id'];
    $comment = $_POST["comment"];

    if (isset($id) && !empty($comment)) {
        $sql = "INSERT INTO profilcoments (idComent, idUzytkownika, tresc) VALUES ('$id', '$profil_id', '$comment')";
        if ($conn->query($sql) === TRUE) {
            header("Location: mainProfil.php?id=$profil_id");
        } else {
            echo "Błąd przy wstawianiu do tabeli forum: " . $conn->error;
        }
    } else {
        echo "Błąd: Niepoprawne dane wejściowe.";
    }
?>
