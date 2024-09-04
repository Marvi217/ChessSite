<?php
require("session.php");
require("db.php");
$game_id = $_POST['id'];
$color = $_POST['color'];
if($color == "white"){
   $sql = "SELECT white_player FROM games WHERE id=$game_id";
    $wynik = $conn->query($sql);
    $id = $wynik->fetch_object()->white_player;
}else {
    $sql = "SELECT black_player FROM games WHERE id=$game_id";
    $wynik = $conn->query($sql);
    $id = $wynik->fetch_object()->black_player;
}
echo $id;
$conn->close();
?>