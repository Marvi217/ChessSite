<?php
require("session.php");
require("db.php");
$game_id = $_POST['id'];

$sql = "SELECT status FROM games WHERE id=$game_id";
$wynik = $conn->query($sql);
$status = $wynik->fetch_object()->status;
if($status == "Starting"){
    echo "succes";
}else{
    echo "error"
}
$conn->close();
?>