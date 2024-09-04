<?php
require("db.php");
$fraza = isset($_GET['query']) ? $_GET['query'] : '';

$fraza = $conn->real_escape_string($fraza);

$sql = "SELECT forum.id, forum.idUzytkownika, forum.temat, forum.data_utworzenia, uzytkownicy.nick 
        FROM forum 
        JOIN uzytkownicy ON forum.idUzytkownika = uzytkownicy.id";
if ($fraza) {
    $sql .= " WHERE forum.temat LIKE '%$fraza%'";
}

$sql .= " ORDER BY forum.data_utworzenia DESC";

$result = $conn->query($sql);

$results = [];
while ($row = $result->fetch_assoc()) {
    $results[] = $row;
}

header('Content-Type: application/json');
echo json_encode($results);
?>
