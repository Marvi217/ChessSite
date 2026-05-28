# ChessSite

Webowa platforma szachowa napisana w PHP z bazą danych MySQL. Umożliwia rozgrywkę online, prowadzenie kont użytkowników, komunikację na forum oraz śledzenie rankingów. Projekt zrealizowany bez użycia frameworka — czysty PHP.

## Technologie

![PHP](https://img.shields.io/badge/PHP-75.7%25-777BB4?style=flat&logo=php&logoColor=white)
![CSS](https://img.shields.io/badge/CSS-21.3%25-1572B6?style=flat&logo=css3&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=flat&logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-0.2%25-F7DF1E?style=flat&logo=javascript&logoColor=black)

## Funkcjonalności

- Rejestracja i logowanie użytkowników
- Rozgrywka szachowa online
- Forum dyskusyjne
- System znajomych
- Profile użytkowników
- Tablica rankingowa (leaderboard)

## Struktura projektu

```
ChessSite/
├── chess.php             # Główna logika gry
├── Player.php            # Klasa gracza
├── login.php             # Logowanie
├── registration.php      # Rejestracja
├── forum.php             # Forum
├── friends.php           # System znajomych
├── profil.php            # Profil użytkownika
├── ranking.php           # Ranking
├── chess.sql             # Schemat bazy danych
├── css/                  # Arkusze stylów
└── obrazki/              # Grafiki figur i zasoby
```

## Uruchomienie

### Wymagania
- PHP 7.4+
- MySQL / MariaDB
- Serwer Apache lub Nginx (np. XAMPP / WAMP)

### Kroki

```bash
git clone https://github.com/Marvi217/ChessSite.git
```

1. Skopiuj pliki do katalogu serwera (np. `htdocs/` w XAMPP).
2. Zaimportuj schemat bazy danych:
   ```sql
   CREATE DATABASE chesssite;
   USE chesssite;
   SOURCE chess.sql;
   ```
3. Skonfiguruj dane połączenia z bazą danych.
4. Otwórz `http://localhost/ChessSite` w przeglądarce.
