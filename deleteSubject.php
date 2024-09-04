<?php
require("session.php");
require("db.php");
if (isset($_GET['id'])) {
    $forum_id = $_GET['forum_id'];
    $subject_id = $_GET['id'];

    $deleteSubjectsSql = "DELETE FROM subject WHERE id = $subject_id";
    if (!$conn->query($deleteSubjectsSql)) {
        die("Błąd przy usuwaniu wpisów: " . $conn->error);
    }else{
        header("Location: subject.php?id=$forum_id");
    }

} else {
    echo "Brak identyfikatora tematu.";
}
?>
