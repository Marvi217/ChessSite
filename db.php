<?php
 $conn = new mysqli("localhost", "root", "", "chess");
 if ($conn->connect_error) {
 exit("Nie udało sie załadować: " . $conn->connect_error);
 }
?>
