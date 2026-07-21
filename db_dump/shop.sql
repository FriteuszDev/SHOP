-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lip 21, 2026 at 02:52 PM
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
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategorie`
--

INSERT INTO `kategorie` (`id`, `nazwa`) VALUES
(1, 'biurowe'),
(2, 'ergonomiczne'),
(3, 'obrotowe'),
(4, 'dla dzieci'),
(5, 'młodzieżowe'),
(6, 'gabinetowe'),
(7, 'konferencyjne'),
(8, 'drewniane'),
(9, 'tapicerowane'),
(10, 'skórzane'),
(11, 'siatkowe'),
(12, 'składane'),
(13, 'stymulujące postawę'),
(14, 'z podnóżkiem'),
(15, 'kuchenne'),
(16, 'gamingowe'),
(17, 'Akcesoria i Peryferia'),
(18, 'Audio i Wideo'),
(19, 'Sieci i Łączność'),
(20, 'Meble Biurowe'),
(21, 'Komponenty PC'),
(22, 'Zabawki');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `koszyk`
--

CREATE TABLE `koszyk` (
  `koszyk_id` int(11) NOT NULL,
  `uzytkownik_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `koszyk`
--

INSERT INTO `koszyk` (`koszyk_id`, `uzytkownik_id`) VALUES
(1, 2),
(2, 3),
(3, 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `koszyk_produkty`
--

CREATE TABLE `koszyk_produkty` (
  `pozycja_id` int(11) NOT NULL,
  `koszyk_id` int(11) NOT NULL,
  `produkt_id` int(11) NOT NULL,
  `ilosc` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `koszyk_produkty`
--

INSERT INTO `koszyk_produkty` (`pozycja_id`, `koszyk_id`, `produkt_id`, `ilosc`) VALUES
(1, 2, 5, 5),
(2, 2, 12, 1),
(5, 2, 19, 1),
(6, 2, 8, 3),
(7, 2, 30, 2),
(8, 2, 14, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `opis` varchar(500) DEFAULT NULL,
  `cena` decimal(10,2) NOT NULL,
  `kategoria_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produkty`
--

INSERT INTO `produkty` (`id`, `nazwa`, `opis`, `cena`, `kategoria_id`) VALUES
(1, 'klawiatura', 'szybka, gamingowa, RGB', 129.99, 16),
(2, 'myszka', 'ergonomiczna, bezprzewodowa, precyzyjna', 89.99, 2),
(3, 'monitor', 'zakrzywiony, 144Hz, bezramkowy', 899.00, 16),
(4, 'słuchawki', 'nauszne, wygłuszające, bezprzewodowe', 249.50, 18),
(5, 'podkładka', 'duża, wodoodporna, antypoślizgowa', 45.00, 17),
(6, 'głośniki', 'stereofoniczne, drewniane, mocne', 199.99, 18),
(7, 'mikrofon', 'pojemnościowy, studyjny, USB', 319.00, 18),
(8, 'kamera internetowa', 'szerokokątna, FullHD, autofokus', 159.99, 18),
(9, 'pendrive', 'szybki, pojemny, metalowy', 69.00, 17),
(10, 'dysk zewnętrzny', 'przenośny, SSD, odporny', 349.99, 17),
(11, 'router', 'dwupasmowy, gigabitowy, stabilny', 189.00, 19),
(12, 'fotel gamingowy', 'regulowany, kubełkowy, wygodny', 649.00, 16),
(13, 'biurko', 'narożne, stabilne, nowoczesne', 420.00, 1),
(14, 'kabel HDMI', 'pozłacany, elastyczny, długi', 29.99, 17),
(15, 'hub USB', 'aktywny, aluminiowy, wieloportowy', 79.50, 17),
(16, 'powerbank', 'pojemny, kompaktowy, szybki', 119.99, 17),
(17, 'podstawka pod laptopa', 'chłodząca, aluminiowa, cicha', 85.00, 17),
(18, 'karta sieciowa', 'zewnętrzna, WiFi, wydajna', 54.99, 19),
(19, 'ramię na monitor', 'regulowane, gazowe, wytrzymałe', 179.00, 1),
(20, 'taśma LED', 'inteligentna, kolorowa, samoprzylepna', 65.00, 17),
(21, 'ładowarka indukcyjna', 'szybka, pionowa, bezpieczna', 99.00, 17),
(22, 'torba na laptopa', 'wodoodporna, pojemna, elegancka', 139.99, 1),
(23, 'czytnik kart', 'uniwersalny, szybki, mały', 39.99, 17),
(24, 'chłodzenie procesora', 'wodne, ciche, wydajne', 299.00, 21),
(25, 'zasilacz', 'modularny, certyfikowany, cichy', 389.99, 21),
(26, 'obudowa PC', 'przewiewna, przeszklona, przestronna', 279.00, 21),
(27, 'pasta termoprzewodząca', 'wydajna, trwała, gęsta', 25.00, 21),
(28, 'wentylator komputerowy', 'cichy, podświetlany, wydajny', 49.99, 21),
(29, 'klucz sprzętowy Bluetooth', 'miniaturowy, nowoczesny, szybki', 34.50, 19),
(30, 'organizer do kabli', 'elastyczny, długi, czarny', 19.99, 1),
(31, 'Zabawka', 'Zabawka', 21.99, 22),
(32, 'Zabawka dla Tiarki', 'Zabawka dla Tiarki', 22.99, 22);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(20) NOT NULL,
  `haslo` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `nazwa`, `haslo`) VALUES
(2, 'zaq1@WSX', '$2y$10$oZJVZ2QjN8l3vrx84EbQpe3VdimbyYbujy89vquihng97mA1omol6'),
(3, 'qwerty123', '$2y$10$wGN74T2EmrozLXqHLBxINefNuuvFx89EV2YdoC58XYQyAWsM6gwny'),
(4, '123', '$2y$10$fWPtlYpBDQC2e3rXuwKQxumWDmaYv9lxGxULEGPdlC59M0pIbox0a');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
  ADD PRIMARY KEY (`koszyk_id`),
  ADD KEY `fk_koszyk_uzytkownicy` (`uzytkownik_id`);

--
-- Indeksy dla tabeli `koszyk_produkty`
--
ALTER TABLE `koszyk_produkty`
  ADD PRIMARY KEY (`pozycja_id`),
  ADD KEY `fk_produkty_koszyk` (`koszyk_id`),
  ADD KEY `fk_koszyk_produkty_relacja` (`produkt_id`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `koszyk`
--
ALTER TABLE `koszyk`
  MODIFY `koszyk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `koszyk_produkty`
--
ALTER TABLE `koszyk_produkty`
  MODIFY `pozycja_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `koszyk`
--
ALTER TABLE `koszyk`
  ADD CONSTRAINT `fk_koszyk_uzytkownicy` FOREIGN KEY (`uzytkownik_id`) REFERENCES `uzytkownicy` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `koszyk_produkty`
--
ALTER TABLE `koszyk_produkty`
  ADD CONSTRAINT `fk_koszyk_produkty_relacja` FOREIGN KEY (`produkt_id`) REFERENCES `produkty` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_produkty_koszyk` FOREIGN KEY (`koszyk_id`) REFERENCES `koszyk` (`koszyk_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
