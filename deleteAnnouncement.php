<?php
require("session.php");
require("db.php");
$id = $_POST["id"];
$sql = "DELETE FROM alerts WHERE id=$id";
$conn->query($sql);
header("Location: index.php");
$conn->close();
?>