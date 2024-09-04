<?php
    require("db.php");
    require("session.php");

    $id = $_SESSION['idUzytkownika'];
    $obrazek = basename($_FILES["avatar"]["name"]);
    move_uploaded_file($_FILES["avatar"]["tmp_name"], "obrazki/avatar/$obrazek");

    if (isset($id) && !empty($obrazek)) {
        $sql = "UPDATE uzytkownicy SET avatar='$obrazek' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            header("Location: profil.php");
        } else {
            echo "Błąd przy wstawianiu do tabeli forum: " . $conn->error;
        }
    } else {
        echo "Błąd: Niepoprawne dane wejściowe.";
    }
?>
