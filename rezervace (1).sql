-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Sob 12. kvě 2018, 16:56
-- Verze serveru: 5.7.14
-- Verze PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `rezervace`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `cas`
--

CREATE TABLE `cas` (
  `id` int(11) NOT NULL,
  `den_id` int(11) NOT NULL,
  `cas_start` time NOT NULL,
  `cas_konec` time NOT NULL,
  `obsazeno` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `cas`
--

INSERT INTO `cas` (`id`, `den_id`, `cas_start`, `cas_konec`, `obsazeno`) VALUES
(1, 1, '06:30:00', '07:00:00', 1),
(2, 1, '17:00:00', '18:00:00', 0),
(3, 3, '13:00:00', '14:00:00', 0),
(4, 3, '17:00:00', '19:00:00', 0),
(5, 2, '09:00:00', '10:00:00', 0),
(6, 2, '11:00:00', '12:00:00', 0),
(9, 1, '04:00:00', '05:30:00', 0),
(10, 5, '06:00:00', '07:00:00', 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `den`
--

CREATE TABLE `den` (
  `id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `aktivni` tinyint(1) NOT NULL,
  `zdroje_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `den`
--

INSERT INTO `den` (`id`, `datum`, `aktivni`, `zdroje_id`) VALUES
(1, '2018-04-24', 1, 1),
(2, '2018-04-19', 1, 1),
(3, '2018-04-21', 1, 2),
(4, '2018-05-16', 1, 3),
(5, '2018-05-08', 1, 3);

-- --------------------------------------------------------

--
-- Struktura tabulky `zdroje`
--

CREATE TABLE `zdroje` (
  `id` int(11) NOT NULL,
  `nazev` varchar(60) COLLATE utf8mb4_czech_ci NOT NULL,
  `aktivni` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `zdroje`
--

INSERT INTO `zdroje` (`id`, `nazev`, `aktivni`) VALUES
(1, 'tenis', 1),
(2, 'ahiiiiiiiiiiiiii', 1),
(3, 'ae', 1);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `cas`
--
ALTER TABLE `cas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `den-id` (`den_id`);

--
-- Klíče pro tabulku `den`
--
ALTER TABLE `den`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zdroje-id` (`zdroje_id`);

--
-- Klíče pro tabulku `zdroje`
--
ALTER TABLE `zdroje`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `cas`
--
ALTER TABLE `cas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pro tabulku `den`
--
ALTER TABLE `den`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pro tabulku `zdroje`
--
ALTER TABLE `zdroje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `cas`
--
ALTER TABLE `cas`
  ADD CONSTRAINT `blop` FOREIGN KEY (`den_id`) REFERENCES `den` (`id`) ON DELETE CASCADE;

--
-- Omezení pro tabulku `den`
--
ALTER TABLE `den`
  ADD CONSTRAINT `blep` FOREIGN KEY (`zdroje_id`) REFERENCES `zdroje` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
