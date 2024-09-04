<?php
require("session.php");
require("db.php");
if (isset($_GET['id'])) {
    $topic_id = $_GET['id'];
    $deleteTopicSql = "DELETE FROM forum WHERE id = $topic_id";
    if ($conn->query($deleteTopicSql) === TRUE) {
        header("Location: forum.php");
        exit();
    } else {
        echo "Błąd: " . $conn->error;
    }
} else {
    echo "Brak identyfikatora tematu.";
}
?>
