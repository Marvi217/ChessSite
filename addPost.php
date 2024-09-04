<?php
    require("db.php");
    require("session.php");

    $idUzytkownika = $_SESSION['idUzytkownika'];
    $forum_id = $_POST['forum_id'];
    $tresc = $_POST["tresc"];

    if (isset($idUzytkownika) && !empty($tresc)) {
        $sql = "INSERT INTO subject (forum_id, idUzytkownika, tresc) VALUES ('$forum_id', '$idUzytkownika', '$tresc')";
        if ($conn->query($sql) === TRUE) {
            header("Location: subject.php?id=$forum_id");
        } else {
            echo "Błąd przy wstawianiu do tabeli forum: " . $conn->error;
        }
    } else {
        echo "Błąd: Niepoprawne dane wejściowe.";
    }
?>
