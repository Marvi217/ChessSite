<?php
require("db.php");
require("session.php");

header('Content-Type: text/plain');

$id = $_SESSION['idUzytkownika'];
$old_password = $_POST['old_password'] ?? '';
$new_password = $_POST['new_password'] ?? '';
$confirm_new_password = $_POST['confirm_new_password'] ?? '';

$response = "status=error";

$errors = [];

$sql = "SELECT haslo FROM uzytkownicy WHERE id='$id'";
$w = $conn->query($sql);
$wynik = $w->fetch_object();

if ($wynik) {
    $current_hashed_password = $wynik->haslo;

    if (md5($old_password) !== $current_hashed_password) {
        $errors['old_password'] = "Podane stare hasło jest niepoprawne.";
    }

    if ($new_password !== $confirm_new_password) {
        $errors['new_password'] = "Nowe hasło lub potwierdzenie nowego hasła nie są takie same.";
    }

    if (empty($errors)) {
        $new_hashed_password = md5($new_password);
        $sql = "UPDATE uzytkownicy SET haslo='$new_hashed_password' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            $response = "status=success";
        } else {
            $errors['general'] = "Błąd podczas aktualizacji hasła: " . $conn->error;
        }
    }
} else {
    $errors['general'] = "Błąd: użytkownik nie został znaleziony.";
}

foreach ($errors as $key => $error) {
    $response .= "|{$key}={$error}";
}

echo $response;

$conn->close();
?>
