<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/registration.css">
    
</head>
<body>
    <?php
    require("db.php");
    if (isset($_POST["login"])) {
        $nick = $_POST["nick"];
        $login = $_POST["login"];
        $haslo = $_POST["haslo"];
        $email = $_POST["email"];
        $country = $_POST['country'];

        $sql = "INSERT INTO uzytkownicy (login, haslo, nick, email, country, avatar) VALUES ('$login', '" . md5($haslo) . "','$nick' , '$email', '$country', 'obrazki/avatar_2.avif')";
        $result = $conn->query($sql);
        if ($result) {
            echo "<div class='form'>
            <h3>Zostałeś pomyślnie zarejestrowany.</h3><br/>
            <p class='link'>Kliknij tutaj, aby się <a href='login.php'>zalogować</a></p>
            </div>";
        } else {
            echo "<div class='form'>
            <h3>Nie wypełniłeś wymaganych pól.</h3><br/>
            <p class='link'>Kliknij tutaj, aby ponowić próbę <a href='registration.php'>rejestracji</a>.</p>
            </div>";
        }
    } else {
    ?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Rejestracja</h1>
        <input type="text" class="nick-input" name="nick" placeholder="Nick" required />
        <input type="text" class="login-input" name="login" placeholder="Login" required />
        <input type="password" class="login-input" name="haslo" placeholder="Hasło" required />
        <input type="text" class="login-input" name="email" placeholder="Adres email" required />
        <label for="player-country">Kraj</label>
        <div class=" ">
            <?php
                $countries = [
                    1 => "Afganistan",
                    2 => "Albania",
                    3 => "Algieria",
                    4 => "Andora",
                    5 => "Angola",
                    6 => "Antigua i Barbuda",
                    7 => "Arabia Saudyjska",
                    8 => "Argentyna",
                    9 => "Armenia",
                    10 => "Australia",
                    11 => "Austria",
                    12 => "Azerbejdżan",
                    13 => "Bahamy",
                    14 => "Bahrajn",
                    15 => "Bangladesz",
                    16 => "Barbados",
                    17 => "Belgia",
                    18 => "Belize",
                    19 => "Benin",
                    20 => "Bhutan",
                    21 => "Białoruś",
                    22 => "Boliwia",
                    23 => "Bośnia i Hercegowina",
                    24 => "Botswana",
                    25 => "Brazylia",
                    26 => "Brunei",
                    27 => "Bułgaria",
                    28 => "Burkina Faso",
                    29 => "Burundi",
                    30 => "Chile",
                    31 => "Chiny",
                    32 => "Chorwacja",
                    33 => "Cypr",
                    34 => "Czarnogóra",
                    35 => "Czechy",
                    36 => "Dania",
                    37 => "Demokratyczna Republika Konga",
                    38 => "Dominika",
                    39 => "Dominikana",
                    40 => "Dżibuti",
                    41 => "Egipt",
                    42 => "Ekwador",
                    43 => "Erytrea",
                    44 => "Estonia",
                    45 => "Eswatini",
                    46 => "Etiopia",
                    47 => "Fidżi",
                    48 => "Filipiny",
                    49 => "Finlandia",
                    50 => "Francja",
                    51 => "Gabon",
                    52 => "Gambia",
                    53 => "Ghana",
                    54 => "Grecja",
                    55 => "Grenada",
                    56 => "Gruzja",
                    57 => "Gujana",
                    58 => "Gwatemala",
                    59 => "Gwinea",
                    60 => "Gwinea Bissau",
                    61 => "Gwinea Równikowa",
                    62 => "Haiti",
                    63 => "Hiszpania",
                    64 => "Holandia",
                    65 => "Honduras",
                    66 => "Indie",
                    67 => "Indonezja",
                    68 => "Irak",
                    69 => "Iran",
                    70 => "Irlandia",
                    71 => "Islandia",
                    72 => "Izrael",
                    73 => "Jamajka",
                    74 => "Japonia",
                    75 => "Jemen",
                    76 => "Jordania",
                    77 => "Kambodża",
                    78 => "Kamerun",
                    79 => "Kanada",
                    80 => "Katar",
                    81 => "Kazachstan",
                    82 => "Kenia",
                    83 => "Kirgistan",
                    84 => "Kiribati",
                    85 => "Kolumbia",
                    86 => "Komory",
                    87 => "Kongo",
                    88 => "Korea Południowa",
                    89 => "Korea Północna",
                    90 => "Kosowo",
                    91 => "Kostaryka",
                    92 => "Kuba",
                    93 => "Kuwejt",
                    94 => "Laos",
                    95 => "Lesotho",
                    96 => "Liban",
                    97 => "Liberia",
                    98 => "Libia",
                    99 => "Liechtenstein",
                    100 => "Litwa",
                    101 => "Luksemburg",
                    102 => "Łotwa",
                    103 => "Macedonia Północna",
                    104 => "Madagaskar",
                    105 => "Malawi",
                    106 => "Malediwy",
                    107 => "Malezja",
                    108 => "Mali",
                    109 => "Malta",
                    110 => "Maroko",
                    111 => "Mauretania",
                    112 => "Mauritius",
                    113 => "Meksyk",
                    114 => "Mikronezja",
                    115 => "Mołdawia",
                    116 => "Monako",
                    117 => "Mongolia",
                    118 => "Mozambik",
                    119 => "Myanmar",
                    120 => "Namibia",
                    121 => "Nauru",
                    122 => "Nepal",
                    123 => "Niemcy",
                    124 => "Niger",
                    125 => "Nigeria",
                    126 => "Nikaragua",
                    127 => "Norwegia",
                    128 => "Nowa Zelandia",
                    129 => "Oman",
                    130 => "Pakistan",
                    131 => "Palau",
                    132 => "Palestyna",
                    133 => "Panama",
                    134 => "Papua-Nowa Gwinea",
                    135 => "Paragwaj",
                    136 => "Peru",
                    137 => "Polska",
                    138 => "Portugalia",
                    139 => "Republika Południowej Afryki",
                    140 => "Republika Środkowoafrykańska",
                    141 => "Republika Zielonego Przylądka",
                    142 => "Rosja",
                    143 => "Rumunia",
                    144 => "Rwanda",
                    145 => "Saint Kitts i Nevis",
                    146 => "Saint Lucia",
                    147 => "Saint Vincent i Grenadyny",
                    148 => "Salwador",
                    149 => "Samoa",
                    150 => "San Marino",
                    151 => "Senegal",
                    152 => "Serbia",
                    153 => "Seszele",
                    154 => "Sierra Leone",
                    155 => "Singapur",
                    156 => "Słowacja",
                    157 => "Słowenia",
                    158 => "Somalia",
                    159 => "Sri Lanka",
                    160 => "Stany Zjednoczone",
                    161 => "Sudan",
                    162 => "Sudan Południowy",
                    163 => "Surinam",
                    164 => "Syria",
                    165 => "Szwajcaria",
                    166 => "Szwecja",
                    167 => "Tadżykistan",
                    168 => "Tanzania",
                    169 => "Tajlandia",
                    170 => "Timor Wschodni",
                    171 => "Togo",
                    172 => "Tonga",
                    173 => "Trynidad i Tobago",
                    174 => "Tunezja",
                    175 => "Turcja",
                    176 => "Turkmenistan",
                    177 => "Tuvalu",
                    178 => "Uganda",
                    179 => "Ukraina",
                    180 => "Urugwaj",
                    181 => "Uzbekistan",
                    182 => "Vanuatu",
                    183 => "Watykan",
                    184 => "Wenezuela",
                    185 => "Węgry",
                    186 => "Wielka Brytania",
                    187 => "Wietnam",
                    188 => "Włochy",
                    189 => "Wybrzeże Kości Słoniowej",
                    190 => "Wyspy Marshalla",
                    191 => "Wyspy Salomona",
                    192 => "Wyspy Świętego Tomasza i Książęca",
                    193 => "Zambia",
                    194 => "Zimbabwe",
                    195 => "Zjednoczone Emiraty Arabskie"
                ];
                echo '<select name="country" id="player-country">';
                foreach ($countries as $id => $country) {
                    echo '<option value="' . $id . '">' . $country . '</option>';
                }
                echo '</select>';
            ?>
        </div>
        <input type="submit" name="submit" value="Zarejestruj się" class="login-button">
        <p class="link"><a href="login.php">Zaloguj się</a></p>
    </form>
    <?php
    }
    ?>
</body>
</html>
