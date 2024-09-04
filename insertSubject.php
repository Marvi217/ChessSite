<?php
    require("db.php");
    require("session.php");

    $idUzytkownika = $_SESSION['idUzytkownika'];
    $tytul = $_POST['tytul'];
    $tresc = $_POST["tresc"];

    if (isset($idUzytkownika) && !empty($tytul) && !empty($tresc)) {
        $sql = "INSERT INTO forum (idUzytkownika, temat, tresc) VALUES ('$idUzytkownika', '$tytul', '$tresc')";
        if ($conn->query($sql) === TRUE) {
            header("Location: forum.php");
        } else {
            echo "Błąd przy wstawianiu do tabeli forum: " . $conn->error;
        }
    } else {
        echo "Błąd: Niepoprawne dane wejściowe.";
    }
?>
