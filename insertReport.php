<?php
require("session.php");
require("db.php");
$idUzytkownika=$_SESSION["idUzytkownika"];
$tresc = $_REQUEST["tresc"];
$sql = "INSERT INTO zgloszenia (idUzytkownika, tresc) VALUES ('$idUzytkownika', '$tresc')";
$conn->query($sql);
$conn->close();
?>