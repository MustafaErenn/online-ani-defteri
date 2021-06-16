-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 16 Haz 2021, 19:29:12
-- Sunucu sürümü: 10.3.22-MariaDB-log
-- PHP Sürümü: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `284295`
--
CREATE DATABASE IF NOT EXISTS `284295` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `284295`;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hatiralar`
--

CREATE TABLE `hatiralar` (
  `ID` int(11) NOT NULL,
  `UyeId` int(11) NOT NULL,
  `HatiraIcerik` varchar(3000) NOT NULL,
  `Tarih` date NOT NULL,
  `Baslik` varchar(100) NOT NULL,
  `DuyguDurumu` varchar(50) NOT NULL,
  `DuyguEmoji` varchar(15) NOT NULL,
  `DuyguRenk` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `hatiralar`
--

INSERT INTO `hatiralar` (`ID`, `UyeId`, `HatiraIcerik`, `Tarih`, `Baslik`, `DuyguDurumu`, `DuyguEmoji`, `DuyguRenk`) VALUES
(62, 12, 'Otobüsü kaçırdığım için 1 saat fazla bekledim.', '2021-06-15', 'Otobüsü kaçırdım', 'Öfkeli', '&#x1F620;', 'danger'),
(63, 12, 'Kötü bir rüya gördüm.', '2021-06-15', 'Kabus', 'Korkmuş', '&#x1F628;', 'dark'),
(65, 14, 'Nötr->korkmuş->üzgün-> öfkeli->mutlu', '2021-06-16', 'Nötrden korkmuşa -> üzgün->kızgın-> mutlu', 'Mutlu', '&#x1F600;', 'success'),
(66, 14, '01->şaşkın', '1111-01-01', 'deneme', 'Şaşkın', '&#x1F62E;', 'info');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

CREATE TABLE `uyeler` (
  `ID` int(11) NOT NULL,
  `Ad` varchar(100) NOT NULL,
  `Soyad` varchar(100) NOT NULL,
  `Eposta` varchar(100) NOT NULL,
  `Sifre` varchar(100) NOT NULL,
  `Telefon` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `uyeler`
--

INSERT INTO `uyeler` (`ID`, `Ad`, `Soyad`, `Eposta`, `Sifre`, `Telefon`) VALUES
(12, 'Mustafa', 'Eren', 'mustafa@gmail.com', 'b573d9fc398361f3d4698998c17bb48496ced48ecfcf2e82497b4681460ae45f', '05079747815'),
(13, 'ahmert', 'ahmert', 'ahmert@gmail.com', 'a1fb4f7d7dc571f4883f96fc86275aa35727fcf3c37e163f0054ce2220f41d05', '5385385356'),
(14, 'Levent', 'Eren', 'levent@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '0505 505 50 50');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `hatiralar`
--
ALTER TABLE `hatiralar`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UyeId` (`UyeId`);

--
-- Tablo için indeksler `uyeler`
--
ALTER TABLE `uyeler`
  ADD PRIMARY KEY (`ID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `hatiralar`
--
ALTER TABLE `hatiralar`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- Tablo için AUTO_INCREMENT değeri `uyeler`
--
ALTER TABLE `uyeler`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `hatiralar`
--
ALTER TABLE `hatiralar`
  ADD CONSTRAINT `hatiralar_ibfk_1` FOREIGN KEY (`UyeId`) REFERENCES `uyeler` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
