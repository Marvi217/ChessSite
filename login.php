<?php
session_start();
require('db.php');

if (isset($_POST["login"])) {
    $login = $_POST["login"];
    $haslo = $_POST["haslo"];
    $sql = "SELECT * FROM uzytkownicy WHERE login='$login' AND haslo='" . md5($haslo) . "'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $user = $result->fetch_object();
        $_SESSION["login"] = $user->login;
        $_SESSION["idUzytkownika"] = $user->id;
        header("Location: index.php");
    } else {
        echo "<div class='form'>
            <h3>Nieprawidłowy login lub hasło.</h3><br/>
            <p class='link'>Ponów próbę <a href='login.php'>logowania</a>.</p>
            </div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="login_form">
        <div class="login">
            <form class="form flex" method="post" name="login">
                <h1 class="login-title">Logowanie</h1>
                <input type="login" class="login-input" name="login" placeholder="Login" autofocus="true" />
                <br><br>
                <input type="password" class="login-input" name="haslo" placeholder="Hasło" />
                <br><br>
                <input type="submit" value="Zaloguj" name="submit" class="login-button" />
                <br>
                <p class="link"><a href="registration.php">Zarejestruj się</a></p>
            </form>
        </div>
    </div>
</body>
</html>
