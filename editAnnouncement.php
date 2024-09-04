<?php
require("session.php");
require("db.php");
$id = $_POST['id'];
$tytul = $_POST["title"];
$tresc = $_POST["content"];

$sql = "UPDATE alerts SET tytul='$tytul', tresc='$tresc' WHERE id=$id";
$conn->query($sql);
header("Location: index.php");
$conn->close();
?>