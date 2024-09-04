<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel zgłoszeń</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/raport.css">
</head>
<body>
    <?php require("menu.php");?>
    <div class="raport_main_panel">
        <div class="titlePanel">
            <h1>Panel zgłoszeń</h1>
        </div>
        <div class="reports">
            <?php
            $id = $_SESSION["idUzytkownika"];
            $nick = $_SESSION["login"];
            $sql = "SELECT rola FROM uzytkownicy WHERE id = '$id'";
            $r = $conn->query($sql);
            $rola = $r->fetch_object();
            if (isset($_SESSION["login"]) && $rola->rola == "admin") {
                $sql = "SELECT idUzytkownika, tresc, data FROM zgloszenia";
                $result=$conn->query($sql);
                while($row=$result->fetch_object()){
                    echo "<div id='a'><p>data: {$row->data}</p> <p>id użytkownika: {$row->idUzytkownika} </p><p>Nick: {$nick}</p><p>treść zgloszenia: {$row->tresc}</p></div>";
                }
            }
            else{
                echo "<div id='b'>NIE MASZ UPRAWNIEŃ DO PRZEGLĄDANIA TEJ STRONY</dib>";
            }
            ?>
        </div>
    </div>
    <?php
    require("footer.php")
    ?>
</body>
</html>