-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Nov 29. 10:44
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Importálásnál nézzük hogy van-e allatorokbefogado adatbázis, ha nincs akkor hozzuk létre
CREATE DATABASE IF NOT EXISTS `allatorokbefogado`;
USE `allatorokbefogado`;

--
-- Adatbázis: `allatorokbefogado`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `animals`
--

CREATE TABLE `animals` (
  `id` int(11) NOT NULL,
  `animal_name` varchar(100) NOT NULL,
  `animal_age` int(11) NOT NULL,
  `animal_type` enum('kutya','macska') NOT NULL,
  `animal_gender` enum('hím','nőstény') NOT NULL,
  `animal_size` enum('kicsi','közepes','nagy') NOT NULL,
  `animal_breed` varchar(100) DEFAULT NULL,
  `animal_description` text NOT NULL,
  `animal_image` mediumblob NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `id` int(11) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`id`, `full_name`, `email`, `password`) VALUES
(2, 'admin', 'admin@gmail.com', '$2y$10$xpDksqcmtvSmkmwJbB9lYu4SbnwlHkO/3ufhjBOTdkOna3eK98eZ2'),
(3, 'test', 'test@gmail.com', '$2y$10$vGEuSFOmMfS/LqsGUonLuOc/kF7K6rDtaNa6iahLLqcM8wCZ6HtkG');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
