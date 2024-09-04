-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Wrz 04, 2024 at 09:05 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chess`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `alert`
--

CREATE TABLE `alert` (
  `id` int(10) UNSIGNED NOT NULL,
  `idUzytkownika` int(10) UNSIGNED NOT NULL,
  `idFriend` int(10) UNSIGNED NOT NULL,
  `temat` varchar(50) NOT NULL,
  `tresc` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `data_utworzenia` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `alert`
--

INSERT INTO `alert` (`id`, `idUzytkownika`, `idFriend`, `temat`, `tresc`, `status`, `data_utworzenia`) VALUES
(95, 4, 5, 'Challenge', 'Użytkownik Marvi wysłał zaproszenie do gry', '', '2024-09-04 12:43:31'),
(98, 17, 5, 'Zaproszenie', 'Użytkownik Marvi wysłał ci zaproszenie do grona znajomych', 'accept', '2024-09-04 17:53:16');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `alerts`
--

CREATE TABLE `alerts` (
  `id` int(10) UNSIGNED NOT NULL,
  `tytul` varchar(50) NOT NULL,
  `tresc` text NOT NULL,
  `data_utworzenia` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `alerts`
--

INSERT INTO `alerts` (`id`, `tytul`, `tresc`, `data_utworzenia`) VALUES
(1, 'Ogłoszenie', 'Strona rusza <3\r\nTest enter', '2024-08-22 12:03:26'),
(2, 'ufhdskh', 'hgdskgukfwveukbd', '2024-09-02 07:40:38'),
(3, 'Piotrek!', 'Działa :)', '2024-09-02 07:41:40');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `board`
--

CREATE TABLE `board` (
  `id` int(10) UNSIGNED NOT NULL,
  `game_id` int(10) UNSIGNED NOT NULL,
  `board` text NOT NULL,
  `move_number` int(11) NOT NULL,
  `data_edycji` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `country`
--

CREATE TABLE `country` (
  `id` int(10) UNSIGNED NOT NULL,
  `country` varchar(50) NOT NULL,
  `short` varchar(3) NOT NULL,
  `flag` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country`, `short`, `flag`) VALUES
(1, 'Afganistan', 'af', 'af.svg'),
(2, 'Albania', 'al', 'al.svg'),
(3, 'Algieria', 'dz', 'dz.svg'),
(4, 'Andora', 'ad', 'ad.svg'),
(5, 'Angola', 'ao', 'ao.svg'),
(6, 'Antigua i Barbuda', 'ag', 'ag.svg'),
(7, 'Arabia Saudyjska', 'sa', 'sa.svg'),
(8, 'Argentyna', 'ar', 'ar.svg'),
(9, 'Armenia', 'am', 'am.svg'),
(10, 'Australia', 'au', 'au.svg'),
(11, 'Austria', 'at', 'at.svg'),
(12, 'Azerbejdżan', 'az', 'az.svg'),
(13, 'Bahamy', 'bs', 'bs.svg'),
(14, 'Bahrajn', 'bh', 'bh.svg'),
(15, 'Bangladesz', 'bd', 'bd.svg'),
(16, 'Barbados', 'bb', 'bb.svg'),
(17, 'Belgia', 'be', 'be.svg'),
(18, 'Belize', 'bz', 'bz.svg'),
(19, 'Benin', 'bj', 'bj.svg'),
(20, 'Bhutan', 'bt', 'bt.svg'),
(21, 'Białoruś', 'by', 'by.svg'),
(22, 'Boliwia', 'bo', 'bo.svg'),
(23, 'Bośnia i Hercegowina', 'ba', 'ba.svg'),
(24, 'Botswana', 'bw', 'bw.svg'),
(25, 'Brazylia', 'br', 'br.svg'),
(26, 'Brunei', 'bn', 'bn.svg'),
(27, 'Bułgaria', 'bg', 'bg.svg'),
(28, 'Burkina Faso', 'bf', 'bf.svg'),
(29, 'Ceuta', 'xc', 'xc.svg'),
(30, 'Chile', 'cl', 'cl.svg'),
(31, 'Chiny', 'cn', 'cn.svg'),
(32, 'Chorwacja', 'hr', 'hr.svg'),
(33, 'Cypr', 'cy', 'cy.svg'),
(34, 'Czarnogóra', 'me', 'me.svg'),
(35, 'Czechy', 'cz', 'cz.svg'),
(36, 'Dania', 'dk', 'dk.svg'),
(37, 'Demokratyczna Republika Konga', '', ''),
(38, 'Dominika', 'dm', 'dm.svg'),
(39, 'Dominikana', 'do', 'do.svg'),
(40, 'Dżibuti', 'dj', 'dj.svg'),
(41, 'Egipt', 'eg', 'eg.svg'),
(42, 'Ekwador', 'ec', 'ec.svg'),
(43, 'Erytrea', 'er', 'er.svg'),
(44, 'Estonia', 'ee', 'ee.svg'),
(45, 'Eswatini', '', ''),
(46, 'Etiopia', 'et', 'et.svg'),
(47, 'Fidżi', 'fj', 'fj.svg'),
(48, 'Filipiny', 'ph', 'ph.svg'),
(49, 'Finlandia', 'fi', 'fi.svg'),
(50, 'Francja', 'fr', 'fr.svg'),
(51, 'Gabon', 'ga', 'ga.svg'),
(52, 'Gambia', 'gm', 'gm.svg'),
(53, 'Ghana', 'gh', 'gh.svg'),
(54, 'Grecja', 'gr', 'gr.svg'),
(55, 'Grenada', 'gd', 'gd.svg'),
(56, 'Gruzja', 'ge', 'ge.svg'),
(57, 'Gujana', 'gy', 'gy.svg'),
(58, 'Gwatemala', 'gt', 'gt.svg'),
(59, 'Gwinea', 'gn', 'gn.svg60'),
(60, 'Gwinea Bissau', 'gw', 'gw.svg'),
(61, 'Gwinea Równikowa', 'gq', 'gq.svg'),
(62, 'Haiti', 'ht', 'ht.svg'),
(63, 'Hiszpania', 'es', 'es.svg'),
(64, 'Holandia', '', ''),
(65, 'Honduras', 'hn', 'hn.svg'),
(66, 'Indie', 'in', 'in.svg'),
(67, 'Indonezja', 'id', 'id,svg'),
(68, 'Irak', 'iq', 'iq.svg'),
(69, 'Iran', 'ir', 'ir.svg'),
(70, 'Irlandia', 'ie', 'ie.svg'),
(71, 'Islandia', 'is', 'is,svg'),
(72, 'Izrael', 'il', 'il.svg'),
(73, 'Jamajka', 'jm', 'jm.svg'),
(74, 'Japonia', 'jp', 'jp.svg'),
(75, 'Jemen', 'ye', 'ye.svg'),
(76, 'Jordania', 'jo', 'jo,svg'),
(77, 'Kambodża', 'kh', 'kh.svg'),
(78, 'Kamerun', 'cm', 'cm.svg'),
(79, 'Kanada', 'ca', 'ca.svg'),
(80, 'Katar', 'qa', 'qa.svg'),
(81, 'Kazachstan', 'kz', 'kz.svg'),
(82, 'Kenia', 'ke', 'ke.svg'),
(83, 'Kirgistan', 'kg', 'kg.svg'),
(84, 'Kiribati', 'ki', 'ki.svg'),
(85, 'Kolumbia', 'co', 'co.svg'),
(86, 'Komory', 'km', 'km.svg'),
(87, 'Kongo', 'cg', 'cg.svg'),
(88, 'Korea Południowa', '', ''),
(89, 'Korea Północna', '', ''),
(90, 'Kosowo', 'xk', 'xk.svg'),
(91, 'Kostaryka', 'cr', 'cr.svg'),
(92, 'Kuba', 'cu', 'cu.svg'),
(93, 'Kuwejt', 'kw', 'kw.svg'),
(94, 'Laos', 'la', 'la.svg'),
(95, 'Lesotho', 'ls', 'ls.svg'),
(96, 'Liban', 'lb', 'lb.svg'),
(97, 'Liberia', 'lr', 'lr.svg'),
(98, 'Libia', 'ly', 'ly.svg'),
(99, 'Liechtenstein', 'li', 'li.svg'),
(100, 'Litwa', 'lt', 'lt.svg'),
(101, 'Luksemburg', 'lu', 'lu.svg'),
(102, 'Łotwa', 'lv', 'lv.svg'),
(103, 'Macedonia Północna', 'mk', 'mk.svg'),
(104, 'Madagaskar', 'mg', 'mg.svg'),
(105, 'Malawi', 'mw', 'mw.svg'),
(106, 'Malediwy', 'mv', 'mv.svg'),
(107, 'Malezja', 'my', 'my.svg'),
(108, 'Mali', 'ml', 'ml.svg'),
(109, 'Malta', 'mt', 'mt.svg'),
(110, 'Maroko', 'ma', 'ma.svg'),
(111, 'Mauretania', 'mr', 'mr.svg'),
(112, 'Mauritius', 'mu', 'mu.svg'),
(113, 'Meksyk', 'mx', 'mx.svg'),
(114, 'Mikronezja', 'fm', 'fm.svg'),
(115, 'Mołdawia', 'md', 'md.svg'),
(116, 'Monako', '', ''),
(117, 'Mongolia', 'mn', 'mn.svg'),
(118, 'Mozambik', 'mz', 'mz.svg'),
(119, 'Myanmar', 'mm', 'mm.svg'),
(120, 'Namibia', 'na', 'na.svg'),
(121, 'Nauru', 'nr ', 'nr.svg'),
(122, 'Nepal', 'np', 'np.svg'),
(123, 'Niemcy', 'de', 'de.svg'),
(124, 'Niger', 'ne', 'ne.svg'),
(125, 'Nigeria', 'ng', 'ng.svg'),
(126, 'Nikaragua', 'ni ', 'ni.svg'),
(127, 'Norwegia', 'no', 'no.svg'),
(128, 'Nowa Zelandia', 'nz', 'nz.svg12'),
(129, 'Oman', 'om', 'om.svg'),
(130, 'Pakistan', 'pk', 'pk.svg'),
(131, 'Palau', 'pw', 'pw.svg'),
(132, 'Palestyna', '', ''),
(133, 'Panama', 'pa', 'pa.svg'),
(134, 'Papua-Nowa Gwinea', 'pg', 'pg.svg'),
(135, 'Paragwaj', 'py', 'py.svg'),
(136, 'Peru', 'pe', 'pe.svg'),
(137, 'Polska', 'pl', 'pl.svg'),
(138, 'Portugalia', 'pt', 'pt.svg'),
(139, 'Republika Środkowoafrykańska', 'cf', 'cf.svg'),
(140, 'Republika Południowej Afryki', 'za', 'za.svg'),
(141, 'Republika Zielonego Przylądka', '', ''),
(142, 'Rosja', 'ru', 'ru.svg'),
(143, 'Rumunia', 'ro', 'ro.svg'),
(144, 'Rwanda', 'rw', 'rw.svg'),
(145, 'Saint Kittsand i Nevis', 'kn', 'kn.svg'),
(146, 'Saint Lucia', 'lc', 'lc.svg'),
(147, 'Saint Vincent i Grenadyny', 'vc', 'vc.svg'),
(148, 'Salwador', 'sv', 'sv.svg'),
(149, 'Samoa', 'ws', 'ws.svg'),
(150, 'San Marino', 'sm', 'sm.svg'),
(151, 'Senegal', 'sn', 'sn.svg'),
(152, 'Serbia', 'xs', 'xs.svg'),
(153, 'Seszele', 'sc', 'sc.svg'),
(154, 'Sierra Leone', 'sl', 'sl.svg'),
(155, 'Singapur', 'sg', 'sg.svg'),
(156, 'Słowacja', 'sk', 'sk.svg'),
(157, 'Słowenia', 'si', 'si.svg'),
(158, 'Somalia', 'so', 'so.svg'),
(159, 'Sri Lanka', 'lk', 'lk.svg'),
(160, 'USA', 'us', 'us.svg'),
(161, 'Sudan', 'sd', 'sd.svg'),
(162, 'Sudan Południowy', 'ss', 'ss.svg'),
(163, 'Surinam', 'sr', 'sr.svg'),
(164, 'Syria', 'sy', 'sy.svg'),
(165, 'Szwajcaria', 'ch', 'ch.svg'),
(166, 'Szwecja', 'se', 'se.svg'),
(167, 'Tadżykistan', 'tj', 'tj.svg'),
(168, 'Tanzania', 'tz', 'tz.svg'),
(169, 'Tajlandia', 'th', 'th.svg'),
(170, 'Timor Wschodni', '', ''),
(171, 'Togo', 'tg', 'tg.svg'),
(172, 'Tonga', 'to', 'to.svg'),
(173, 'Trynidad i Tobago', 'tt', 'tt.svg'),
(174, 'Tunezja', 'tn', 'tn.svg'),
(175, 'Turcja', 'tr', 'tr.svg'),
(176, 'Turkmenistan', 'tm', 'tm.svg'),
(177, 'Tuvalu', 'tv', 'tv.svg'),
(178, 'Uganda', 'ug', 'ug.svg'),
(179, 'Ukraina', 'ua', 'ua.svg'),
(180, 'Urugwaj', 'uy', 'uy.svg'),
(181, 'Uzbekistan', 'uz', 'uz.svg'),
(182, 'Vanuatu', 'vu', 'vu.svg'),
(183, 'Watykan', 'va', 'va.svg'),
(184, 'Wenezuela', 've', 've.svg'),
(185, 'Węgry', 'hu', 'hu.svg'),
(186, 'Wielka Brytania', 'gb', 'gb.svg'),
(187, 'Wietnam', 'vn', 'vn.svg'),
(188, 'Włochy', 'it', 'it.svg'),
(189, 'Wybrzeże Kości Słoniowej', 'ci', 'ci.svg'),
(190, 'Wyspy Marshalla', 'mh', 'mh.svg'),
(191, 'Wyspy Salomona', 'sb', 'sb.svg'),
(192, 'Wyspy Św.Tomasza i Książęca', 'st', 'st.svg'),
(194, 'Zimbabwe', 'zw', 'zw.svg'),
(195, 'Zjednoczone Emiraty Arabskie', 'ae', 'ae.svg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `forum`
--

CREATE TABLE `forum` (
  `id` int(10) UNSIGNED NOT NULL,
  `idUzytkownika` int(10) UNSIGNED NOT NULL,
  `temat` varchar(50) NOT NULL,
  `tresc` text NOT NULL,
  `data_utworzenia` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id`, `idUzytkownika`, `temat`, `tresc`, `data_utworzenia`) VALUES
(6, 5, 'fcgfcfgcgf', 'fgvckhgvkjg', '2024-08-16 08:05:01'),
(7, 5, 'szachy', 'hgbkjhbbh', '2024-08-21 17:23:03'),
(17, 5, 'temat', 'ygcfjhbfixcuhbxiufd', '2024-09-03 09:49:15');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `friends`
--

CREATE TABLE `friends` (
  `idUzytkownika` int(10) UNSIGNED NOT NULL,
  `idFriend` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`idUzytkownika`, `idFriend`) VALUES
(5, 4),
(5, 6),
(13, 5),
(5, 13),
(18, 5),
(5, 18),
(20, 5),
(5, 20),
(4, 5),
(5, 22),
(22, 5),
(21, 5),
(5, 21),
(23, 5),
(5, 23),
(30, 5),
(5, 30),
(17, 5),
(5, 17);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `games`
--

CREATE TABLE `games` (
  `id` int(10) UNSIGNED NOT NULL,
  `white_player` int(10) UNSIGNED NOT NULL,
  `black_player` int(10) UNSIGNED NOT NULL,
  `current_turn` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `data_utworzenia` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `white_player`, `black_player`, `current_turn`, `status`, `data_utworzenia`) VALUES
(82, 5, 4, '', 'Ongoing', '2024-09-04 12:43:31');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `games2`
--

CREATE TABLE `games2` (
  `id` int(10) UNSIGNED NOT NULL,
  `player` int(10) UNSIGNED NOT NULL,
  `wynik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `games2`
--

INSERT INTO `games2` (`id`, `player`, `wynik`) VALUES
(1, 5, 906);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `profilcoments`
--

CREATE TABLE `profilcoments` (
  `id` int(10) UNSIGNED NOT NULL,
  `idUzytkownika` int(10) UNSIGNED NOT NULL,
  `idComent` int(10) UNSIGNED NOT NULL,
  `tresc` text NOT NULL,
  `data_utworzenia` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `profilcoments`
--

INSERT INTO `profilcoments` (`id`, `idUzytkownika`, `idComent`, `tresc`, `data_utworzenia`) VALUES
(1, 5, 5, 'gfhjfhvj', '2024-09-02 11:43:48'),
(2, 4, 5, 'Piotr to jest gość, grać i grać. Pozdrawiam.', '2024-09-02 12:10:57'),
(3, 4, 5, 'Piotr to jest gość, grać i grać. Pozdrawiam.\r\n', '2024-09-02 12:13:08'),
(4, 5, 5, 'Piotr to jest gość, grać i grać. Pozdrawiam.', '2024-09-02 12:13:21'),
(5, 4, 5, 'Piotr to jest gość, grać i grać. Pozdrawiam.', '2024-09-02 12:14:19');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `subject`
--

CREATE TABLE `subject` (
  `id` int(10) UNSIGNED NOT NULL,
  `forum_id` int(10) UNSIGNED NOT NULL,
  `idUzytkownika` int(10) UNSIGNED NOT NULL,
  `tresc` text NOT NULL,
  `data_utworzenia` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `forum_id`, `idUzytkownika`, `tresc`, `data_utworzenia`) VALUES
(1, 6, 5, 'gvkhgvhgvjhvbkh     <3', '2024-08-16 09:04:00'),
(2, 6, 5, 'bjhdsbjhbsdjbjfnsi', '2024-08-16 09:06:28'),
(3, 6, 5, 'gbrberbgdsfverwgwfdvcwegbvefwvcdcfe', '2024-08-21 16:48:46'),
(4, 6, 13, 'Nie wiem co mam napisać ale sądzę, że jak tak będę pisał to na pewno wypełnię tekstarea to końca. Temat nie ma znaczenia, piszę to by sprawdzić jak wygląda strona z większą ilością tekstu. Po czym wkleję jakiś wiersz lub fragment książki.', '2024-08-23 08:33:42'),
(5, 6, 13, 'Brzechwa Jan\r\n\r\nWłos\r\n\r\nPan starosta jadł przy stole,\r\nNaraz patrzy - włos w rosole.\r\nKrzyknął więc na cały głos:\r\n\"Chciałbym wiedzieć, czyj to włos!\r\n\r\nCo to jest za zwyczaj taki,\r\nŻeby w zupie były kłaki?\r\nStarościno, co chcesz, rób,\r\nJa nie jadam takich zup!\"\r\n\r\nStarościna aż pobladła,\r\nZ przerażenia z krzesła spadła,\r\nPatrzy w talerz: marny los,\r\nRzeczywiście - w zupie włos.\r\n\r\nWpadła z krzykiem na kucharza:\r\n\"Że też taka rzecz się zdarza,\r\nWłos w rosole, ładna rzecz -\r\nNiech pan sobie idzie precz!\"\r\n\r\nKucharz zgubił okulary,\r\nWłożył buty nie do pary,\r\nDo talerza wetknął nos:\r\nRzeczywiście - w zupie włos.\r\n\r\nWstyd okropnie starościnie,\r\nDowiedziano się w rodzinie,\r\nŻe starosta nie chce jeść,\r\nPrzybiegł wuj i stryj, i teść.\r\n\r\nTeść przybliżył się do misy\r\nI powiada: \"Jestem łysy,\r\nWłos na pewno nie jest mój.\r\nMoże wie coś o tym wuj?\"\r\n\r\nWuj z kieszeni wyjął lupę\r\nI przez lupę bada zupę:\r\n\"Widzę włos, lecz nie wiem czyj,\r\nMoże zna się na tym stryj.\"\r\n\r\nStryj przybliżył się do stołu,\r\nZajrzał bacznie do rosołu,\r\nPo czym gwizdnął niby kos:\r\n\"Znam się na tym - to jest włos.\"\r\n\r\nSprowadzono geometrę,\r\nŻeby zmierzył centymetrem\r\nI powiedział wszystkim wprost,\r\nCo to w zupie jest za włos.\r\n\r\nGeometra siadł za stołem,\r\nMierzył, liczył coś z mozołem,\r\nZużył kartek cały stos\r\nI powiedział: \"To jest włos!\r\n\r\nJa się na tym nie znam, lecz czy\r\nNie pomoże sędzia śledczy?\r\nWęszę tutaj zbrodni ślad,\r\nSkoro włos do zupy wpadł.\"\r\n\r\nSędzia śledczy sprawę zbadał\r\nI powiada: \"Trudna rada,\r\nMuszę w sprawie zabrać głos,\r\nProszę państwa, to jest włos.\"\r\n\r\nWtem ktoś myśl wysunął nową:\r\n\"Trzeba wezwać straż ogniową.\"\r\nPan starosta zmarszczył twarz:\r\n\"Może być ognowa straż.\"\r\n\r\nPrzyjechali wnet strażacy,\r\nRaźnie wzięli się do pracy\r\nI wyjęli z zupy włos:\r\nTaki to był włosa los!', '2024-08-23 08:37:45');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(50) NOT NULL,
  `haslo` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `rola` varchar(50) NOT NULL DEFAULT 'user',
  `wynik` int(100) NOT NULL,
  `avatar` text NOT NULL,
  `nick` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `country` int(10) UNSIGNED NOT NULL,
  `info` text NOT NULL,
  `data_utworzenia` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `login`, `haslo`, `email`, `rola`, `wynik`, `avatar`, `nick`, `name`, `lastname`, `country`, `info`, `data_utworzenia`) VALUES
(4, 'Piotr', '3ad23a007ddf1d4f26249cc1c18562e1', 'piotr@gmail.com', 'user', 165837, 'avatar_2.avif', 'Piotr', 'Piotr', 'Piotrkowski', 160, '', '2024-08-27 11:19:36'),
(5, 'Marvi', '56a0f0d54178c437c2eda5271452e66f', 'marvi@gmail.com', 'admin', 218692, 'avatar.jpg', 'Marvi', 'Marvi', 'Marvelous', 137, 'Siema, co tam? Jestem Marvi. <3', '2024-09-04 17:51:02'),
(6, 'User', '8f9bfe9d1345237cb3b2b205864da075', 'user@gmail.com', 'user', 1863812, 'avatar_2.avif\r\n', 'User', '', '', 137, '0', '2024-08-27 11:19:36'),
(13, 'Seba', '5e3b80f20760e9d8c89beeeeb513d9af', 'seba@gmail.com', 'user', 376487200, 'avatar.jpg', 'Seba', 'Sebastian', 'Sebastianowicz', 137, '', '2024-08-31 15:27:33'),
(17, 'Paweł', '1f7a7bf58268d503f9d6e5e92caa90be', 'paweł@gmail.com', 'user', 53214, 'avatar.jpg', 'Paweł', 'Paweł', 'Pawełkowski', 1, 'jcbxzkljhbvjkza', '2024-08-27 11:19:37'),
(18, 'Marta', '83f9c4eb242966cdcada1d01be5d9b15', 'marta@gmail.com', 'user', 8713298, 'avatar.jpg', 'Marta', 'Marta', 'Marta', 2, 'dbhsaagbkjfguyksaj', '2024-08-27 11:19:37'),
(19, 'Julian', '60659cfda992013e610f285c46692d28', 'julian@gmail.com', 'user', 36521, 'avatar.jpg', 'Julian', '', '', 3, 'dlasjkhihaslriudbcm zdmndv,asbkj', '2024-08-27 11:19:37'),
(20, 'Jan', 'e68564f23e0e939acea76dc3d2bc01bf', 'jan@gmail.com', 'user', 22584, 'avatar.jpg', 'Jan', '', '', 4, 'd;kjbacbhsaj bhc,sadbs', '2024-09-02 17:42:16'),
(21, 'Ksawery', 'ddc38ee1dda674c9249e5d58c8d8eb74', 'ksawery@gmail.com', 'user', 176289, 'avatar.jpg', 'Ksawery', '', '', 83, 'jbdcbsahkjb,acs', '2024-09-02 19:12:50'),
(22, 'Adam', '7efd721c8bfff2937c66235f2d0dbac1', 'adam@gmail.com', 'user', 18278, 'avatar.jpg', 'Adam', '', '', 102, 'cdnaskjbs nm ckads', '2024-08-27 11:19:37'),
(23, 'Michał', '916b5e380e76f7b10977c62242c6ff47', 'michał@gmail.com', 'user', 12867, 'avatar.jpg', 'Michał', '', '', 107, 'adshncbajskcjb asdm,n c', '2024-08-27 11:19:37'),
(24, 'Kasia', '514026db4aee3f99dd7125b7074d8135', 'kasia@gmail.com', 'user', 0, 'avatar_2.avif', 'Kasia', '', '', 137, '', '2024-09-02 20:43:06'),
(30, 'Rafał', '667c7954e8467cc375fa35c0376be8fe', 'rafał@gmail.com', 'user', 0, 'avatar_2.avif', 'Rafał', '', '', 179, '', '2024-09-02 20:43:06'),
(31, 'Pan', 'f6d4a17b27da35c2d90ce13801f36782', 'pan@gmail.com', 'user', 0, 'avatar_2.avif', 'Pan', '', '', 65, '', '2024-09-02 20:43:06');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zgloszenia`
--

CREATE TABLE `zgloszenia` (
  `id` int(10) UNSIGNED NOT NULL,
  `idUzytkownika` int(10) UNSIGNED NOT NULL,
  `tresc` text NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `zgloszenia`
--

INSERT INTO `zgloszenia` (`id`, `idUzytkownika`, `tresc`, `data`) VALUES
(2, 5, 'hbbjkbvjkhmb ', '2024-09-02 06:19:40');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `alert`
--
ALTER TABLE `alert`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUzytkownika` (`idUzytkownika`),
  ADD KEY `idFriend` (`idFriend`);

--
-- Indeksy dla tabeli `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indeksy dla tabeli `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUzytkownika` (`idUzytkownika`);

--
-- Indeksy dla tabeli `friends`
--
ALTER TABLE `friends`
  ADD KEY `idUzytkownika` (`idUzytkownika`),
  ADD KEY `idFriend` (`idFriend`);

--
-- Indeksy dla tabeli `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `black_player` (`black_player`),
  ADD KEY `white_player` (`white_player`);

--
-- Indeksy dla tabeli `games2`
--
ALTER TABLE `games2`
  ADD PRIMARY KEY (`id`),
  ADD KEY `player` (`player`);

--
-- Indeksy dla tabeli `profilcoments`
--
ALTER TABLE `profilcoments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idComent` (`idComent`),
  ADD KEY `idUzytkownika` (`idUzytkownika`);

--
-- Indeksy dla tabeli `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUzytkownika` (`idUzytkownika`),
  ADD KEY `forum_id` (`forum_id`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `countryU` (`country`),
  ADD KEY `nick` (`nick`);

--
-- Indeksy dla tabeli `zgloszenia`
--
ALTER TABLE `zgloszenia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUzytkownika` (`idUzytkownika`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alert`
--
ALTER TABLE `alert`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `alerts`
--
ALTER TABLE `alerts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `board`
--
ALTER TABLE `board`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `games2`
--
ALTER TABLE `games2`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profilcoments`
--
ALTER TABLE `profilcoments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `zgloszenia`
--
ALTER TABLE `zgloszenia`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alert`
--
ALTER TABLE `alert`
  ADD CONSTRAINT `alert_ibfk_1` FOREIGN KEY (`idUzytkownika`) REFERENCES `uzytkownicy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alert_ibfk_2` FOREIGN KEY (`idFriend`) REFERENCES `uzytkownicy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `board`
--
ALTER TABLE `board`
  ADD CONSTRAINT `board_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `forum`
--
ALTER TABLE `forum`
  ADD CONSTRAINT `forum_ibfk_4` FOREIGN KEY (`idUzytkownika`) REFERENCES `uzytkownicy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`idUzytkownika`) REFERENCES `uzytkownicy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`idFriend`) REFERENCES `uzytkownicy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_ibfk_1` FOREIGN KEY (`black_player`) REFERENCES `uzytkownicy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `games_ibfk_2` FOREIGN KEY (`white_player`) REFERENCES `uzytkownicy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `games2`
--
ALTER TABLE `games2`
  ADD CONSTRAINT `games2_ibfk_1` FOREIGN KEY (`player`) REFERENCES `uzytkownicy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profilcoments`
--
ALTER TABLE `profilcoments`
  ADD CONSTRAINT `profilcoments_ibfk_1` FOREIGN KEY (`idComent`) REFERENCES `uzytkownicy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profilcoments_ibfk_2` FOREIGN KEY (`idUzytkownika`) REFERENCES `uzytkownicy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`idUzytkownika`) REFERENCES `uzytkownicy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subject_ibfk_2` FOREIGN KEY (`forum_id`) REFERENCES `forum` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD CONSTRAINT `uzytkownicy_ibfk_1` FOREIGN KEY (`country`) REFERENCES `country` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `zgloszenia`
--
ALTER TABLE `zgloszenia`
  ADD CONSTRAINT `zgloszenia_ibfk_1` FOREIGN KEY (`idUzytkownika`) REFERENCES `uzytkownicy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
