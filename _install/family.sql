-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Jan 03. 13:10
-- Kiszolgáló verziója: 10.4.27-MariaDB
-- PHP verzió: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `family`
--
CREATE DATABASE IF NOT EXISTS `family` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `family`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `contact_name` varchar(45) NOT NULL,
  `phone_number` int(9) NOT NULL,
  `email` varchar(45) NOT NULL,
  `weblink` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `contact`
--

INSERT INTO `contact` (`id`, `contact_name`, `phone_number`, `email`, `weblink`) VALUES
(1, 'Családinyár', 707417810, 'info@csaladinyar.hu', 'www.csaladinyar.hu');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `houses`
--

DROP TABLE IF EXISTS `houses`;
CREATE TABLE `houses` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `postcode` int(4) NOT NULL,
  `city` varchar(100) NOT NULL,
  `street` varchar(100) DEFAULT NULL,
  `street_type` varchar(100) DEFAULT NULL,
  `house_number` int(4) DEFAULT NULL,
  `space` int(11) NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `sale` tinyint(4) DEFAULT 1,
  `deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `houses`
--

INSERT INTO `houses` (`id`, `name`, `postcode`, `city`, `street`, `street_type`, `house_number`, `space`, `owner_id`, `sale`, `deleted`) VALUES
(1, 'Tamama-Lak', 5540, 'Szarvas', 'Maczó-zug', 'Hrsz', 9586, 5, 1, 1, 0),
(3, 'Napsugár Apartman', 5540, 'Szarvas', 'Arborétumi', 'üdülősor', 54, 10, NULL, 1, 0),
(4, 'Gödrök Gyöngye A', 5561, 'Békésszentandrás', 'Siratói ', 'üdülősor', 674, 10, 2, 1, 0),
(5, 'Toscana Vendégház', 5540, 'Szarvas', 'Arborétumi', 'üdülősor', 115, 12, NULL, 1, 0),
(6, 'Levendula', 5561, 'Békésszentandrás', 'Kenderligeti', 'üdülősor', 121, 8, 1, 1, 0),
(7, 'Pipacsos', 5561, 'Békésszentandrás', 'Siratói', 'üdülősor', 41, 6, NULL, 1, 0),
(8, 'Füzeskerti', 5561, 'Békésszentandrás', 'Dinnyelaposi', 'üdülősor', 200, 12, NULL, 1, 1),
(9, 'Kisvakond', 5540, 'Szarvas', 'Kis', 'utca', 8, 4, NULL, 1, 1),
(10, 'Puszta Gyöngye', 5540, 'Szarvas', 'Tanya II.', 'külkerület', 112, 12, 1, 1, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `manager`
--

DROP TABLE IF EXISTS `manager`;
CREATE TABLE `manager` (
  `id` int(11) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `title` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` int(9) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `manager`
--

INSERT INTO `manager` (`id`, `lastname`, `firstname`, `title`, `username`, `password`, `email`, `phone_number`, `status`, `deleted`) VALUES
(1, 'Kovács', 'László', 2, 'pacsu77', 'Nem123', 'pacsu007@gmail.com', 703144573, 1, 0),
(5, 'Fulajtár', 'Mónika', 2, 'mnika9', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'fulajtarmonika@gmail.com', 703110744, 0, 0),
(9, 'Nagy', 'Magdolna', 5, 'magdus', '9484b46d5b4a760acb900627c21621dd94b5c799', 'magdalena@gmail.com', 0, 1, 1),
(11, 'Pljesovszki', 'Roland', 3, 'prooland', '8abcda2dba9a5c5c674e659333828582122c5f56', 'prolika@gmail.com', 306541240, 0, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `owners`
--

DROP TABLE IF EXISTS `owners`;
CREATE TABLE `owners` (
  `id` int(11) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone_number` int(9) NOT NULL,
  `houses` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `owners`
--

INSERT INTO `owners` (`id`, `lastname`, `firstname`, `email`, `password`, `phone_number`, `houses`, `status`, `deleted`) VALUES
(1, 'Pribelszki', 'György', 'gyorgy.pribelszki@freemail.hu', '', 301234567, 'Tamama-Lak', 1, 0),
(2, 'Kovács', 'László', 'pacsu007@gmail.com', '', 703144573, 'Gödrök Gyöngye A', 0, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `page_content`
--

DROP TABLE IF EXISTS `page_content`;
CREATE TABLE `page_content` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `deleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `slider`
--

DROP TABLE IF EXISTS `slider`;
CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `picture_link` varchar(100) DEFAULT NULL,
  `code` varchar(100) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `slider`
--

INSERT INTO `slider` (`id`, `name`, `picture_link`, `code`, `description`, `title`, `status`, `deleted`) VALUES
(8, 'Slider01', '', 'slider', 'Főoldai slider', 'Slider01', 1, 0),
(9, 'Házikó', 'slider01.jpg', 'fooldal', 'fooldal', 'slider01', 1, 1),
(10, 'nemtudom', NULL, 'fooldal', 'az adatbázisban nem jelenik meg az adat', 'Belső_tér', 1, 0),
(11, 'ujramegint', NULL, 'bszta', 'napagyak', 'Napozóágyak', 1, 0),
(12, 'ujraujra', '37.jpg', 'bszta', 'csigalépcső', 'Csigalépcső', 1, 0),
(13, 'Minimagyarország', 'minimagyarorszag.jpg', 'minimagyarorszag', 'Minimagyarország Európa legnagyobb makettparkja', 'miniMagyarország', 1, 0),
(14, 'Nádaházam', 'nadahazam.jpg', 'bszta', 'Nádaházam teteje vendégház', 'Nádaházam', 1, 0),
(15, 'Arborétum', 'arboretum.jpg', 'arboretum', 'Az Arborétum és a “Pepi-kert” története az olasz eredetű Bolza család nevéhez fűződik. Az államosítá', 'Arborétum', 1, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `title`
--

DROP TABLE IF EXISTS `title`;
CREATE TABLE `title` (
  `id` int(11) NOT NULL,
  `title_name` varchar(100) NOT NULL,
  `status` tinyint(4) DEFAULT 1,
  `title_deleted` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `title`
--

INSERT INTO `title` (`id`, `title_name`, `status`, `title_deleted`) VALUES
(1, 'Területfelelős', 1, 0),
(2, 'Manager', 1, 0),
(3, 'Karbantartó', 1, 0),
(4, 'Jakuzzi szerelő', 1, 0),
(5, 'Takarítónő', 0, 1);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `houses`
--
ALTER TABLE `houses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ownerID` (`owner_id`);

--
-- A tábla indexei `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `title_id_idx` (`title`);

--
-- A tábla indexei `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `page_content`
--
ALTER TABLE `page_content`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- A tábla indexei `title`
--
ALTER TABLE `title`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title_name_UNIQUE` (`title_name`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `houses`
--
ALTER TABLE `houses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `manager`
--
ALTER TABLE `manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT a táblához `page_content`
--
ALTER TABLE `page_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT a táblához `title`
--
ALTER TABLE `title`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `houses`
--
ALTER TABLE `houses`
  ADD CONSTRAINT `ownerID` FOREIGN KEY (`owner_id`) REFERENCES `owners` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `title_id` FOREIGN KEY (`title`) REFERENCES `title` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
