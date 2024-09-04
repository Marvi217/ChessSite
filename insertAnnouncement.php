<?php
require("session.php");
require("db.php");
$tytul = $_POST["title"];
$tresc = $_POST["content"];

$sql = "INSERT INTO alerts (tytul, tresc) VALUES ('$tytul', '$tresc')";
$conn->query($sql);
header("Location: index.php");
$conn->close();
?>