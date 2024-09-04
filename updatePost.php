<?php
require("session.php");
require("db.php");
ob_start();
$id=$_SESSION["idUzytkownika"];
$forum_id = $_POST['forum_id'];
$subject_id = $_POST['subject_id'];
$content = $_POST['content'];


$sql = "UPDATE subject SET tresc ='$content' WHERE id='$subject_id'";
if ($conn->query($sql) === TRUE) {
    header("Location: subject.php?id=$forum_id");
} else {
    echo "Błąd przy wstawianiu do tabeli forum: " . $conn->error;
}
$conn->close();
?>