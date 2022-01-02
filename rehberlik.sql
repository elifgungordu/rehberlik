-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 02 Oca 2022, 17:45:19
-- Sunucu sürümü: 5.7.36
-- PHP Sürümü: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `rehberlik`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `deneme_analiz`
--

DROP TABLE IF EXISTS `deneme_analiz`;
CREATE TABLE IF NOT EXISTS `deneme_analiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(75) COLLATE utf8mb4_turkish_ci NOT NULL,
  `deneme_adi` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL,
  `ders_adi` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL,
  `toplam_soru` int(11) NOT NULL,
  `dogru` int(11) NOT NULL,
  `yanlis` int(11) NOT NULL,
  `bos` int(11) NOT NULL,
  `net` varchar(10) COLLATE utf8mb4_turkish_ci NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `deneme_analiz`
--

INSERT INTO `deneme_analiz` (`id`, `mail`, `deneme_adi`, `ders_adi`, `toplam_soru`, `dogru`, `yanlis`, `bos`, `net`, `tarih`) VALUES
(1, 'samet@gmail.com', 'deneme1', 'matematik', 30, 7, 13, 10, '3.75', '2021-06-12 23:34:12'),
(2, 'samet@gmail.com', 'deneme1', 'türkçe', 30, 18, 9, 3, '15.75', '2021-06-12 23:34:12'),
(3, 'samet@gmail.com', 'denemeOkul', 'müzik', 15, 5, 5, 5, '3.75', '2021-06-12 23:49:47'),
(4, 'samet@gmail.com', 'denemeOkul', 'fizik', 18, 6, 6, 6, '4.5', '2021-06-12 23:49:47'),
(5, 'samet@gmail.com', 'denemeOkul', 'kimya', 21, 7, 7, 7, '5.25', '2021-06-12 23:49:47'),
(6, 'samet@gmail.com', 'deneme3', 'pc', 3, 1, 1, 1, '0.75', '2021-06-12 23:51:08'),
(7, 'samet@gmail.com', 'deneme4', 'matematik', 135, 45, 45, 45, '33.75', '2021-06-12 23:51:32'),
(8, 'samet@gmail.com', 'deneme5', 'beden', 69, 23, 23, 23, '17.25', '2021-06-12 23:52:00'),
(9, 'samet@gmail.com', 'deneme6', 'resim', 9, 3, 3, 3, '2.25', '2021-06-12 23:52:19'),
(10, 'samet@gmail.com', 'deneme7', 'tyt', 36, 12, 12, 12, '9', '2021-06-12 23:52:45'),
(11, 'samet@gmail.com', 'deneme8', 'organik', 58, 12, 23, 23, '6.25', '2021-06-12 23:53:26'),
(12, 'samet@gmail.com', 'deneme8', 'organik', 36, 12, 12, 12, '9', '2021-06-12 23:55:51');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `deneme_toplam`
--

DROP TABLE IF EXISTS `deneme_toplam`;
CREATE TABLE IF NOT EXISTS `deneme_toplam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `deneme_adi` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL,
  `toplam_net` varchar(10) COLLATE utf8mb4_turkish_ci NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `deneme_toplam`
--

INSERT INTO `deneme_toplam` (`id`, `mail`, `deneme_adi`, `toplam_net`, `tarih`) VALUES
(1, 'samet@gmail.com', 'deneme1', '19.5', '2021-06-12 23:34:12'),
(2, 'samet@gmail.com', 'denemeOkul', '13.5', '2021-06-12 23:49:47'),
(3, 'samet@gmail.com', 'deneme3', '0.75', '2021-06-12 23:51:08'),
(4, 'samet@gmail.com', 'deneme4', '33.75', '2021-06-12 23:51:32'),
(5, 'samet@gmail.com', 'deneme5', '17.25', '2021-06-12 23:52:00'),
(6, 'samet@gmail.com', 'deneme6', '2.25', '2021-06-12 23:52:19'),
(7, 'samet@gmail.com', 'deneme7', '9', '2021-06-12 23:52:45'),
(8, 'samet@gmail.com', 'deneme8', '6.25', '2021-06-12 23:53:26'),
(9, 'samet@gmail.com', 'deneme8', '9', '2021-06-12 23:55:51');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dersler`
--

DROP TABLE IF EXISTS `dersler`;
CREATE TABLE IF NOT EXISTS `dersler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sinif` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `ders` varchar(1000) COLLATE utf8mb4_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `dersler`
--

INSERT INTO `dersler` (`id`, `sinif`, `ders`) VALUES
(21, '10', 'Matematik'),
(20, '10', 'Fizik'),
(27, '10', 'Felsefe'),
(26, '10', 'Kimya'),
(25, '8', 'Türkçe'),
(24, '5', 'Matematik'),
(28, '10', 'Biyoloji'),
(29, '10', 'Geometri'),
(30, '5', 'Türkçe'),
(31, 'Mezun', 'Mat-2'),
(32, '9', 'Müzik');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ders_calisma`
--

DROP TABLE IF EXISTS `ders_calisma`;
CREATE TABLE IF NOT EXISTS `ders_calisma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL,
  `sure` int(11) NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `ders_calisma`
--

INSERT INTO `ders_calisma` (`id`, `mail`, `sure`, `tarih`) VALUES
(1, 'samet@gmail.com', 123, '2021-05-01 13:29:30'),
(2, 'samet@gmail.com', 68, '2021-06-01 13:29:49'),
(3, 'mevlana@gmail.com', 50, '2021-06-01 15:36:07'),
(4, 'mevlana@gmail.com', 60, '2021-05-01 15:36:27'),
(7, 'mevlana@gmail.com', 43, '2021-06-01 17:27:35'),
(6, 'samet@gmail.com', 34, '2021-05-01 16:07:22'),
(8, 'samet@gmail.com', 25, '2021-06-10 16:51:09'),
(9, 'samet@gmail.com', 30, '2022-01-02 15:44:08');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `haftalik_program`
--

DROP TABLE IF EXISTS `haftalik_program`;
CREATE TABLE IF NOT EXISTS `haftalik_program` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL,
  `bas_tarih` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `bit_tarih` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `program_adi` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategorik_sorucozme`
--

DROP TABLE IF EXISTS `kategorik_sorucozme`;
CREATE TABLE IF NOT EXISTS `kategorik_sorucozme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL,
  `ders` varchar(250) COLLATE utf8mb4_turkish_ci NOT NULL,
  `konu` varchar(250) COLLATE utf8mb4_turkish_ci NOT NULL,
  `soru_sayisi` int(11) NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `kategorik_sorucozme`
--

INSERT INTO `kategorik_sorucozme` (`id`, `mail`, `ders`, `konu`, `soru_sayisi`, `tarih`) VALUES
(1, 'samet@gmail.com', 'Fizik', 'Newton Kanunları', 100, '2021-06-05 23:13:22'),
(2, 'samet@gmail.com', 'Matematik', 'İntegral', 50, '2021-06-05 23:14:45'),
(3, 'samet@gmail.com', 'Kimya', 'Organik Kimya', 52, '2021-06-06 17:43:53'),
(4, 'samet@gmail.com', 'Felsefe', 'Din Felsefesi', 25, '2021-06-06 17:44:00'),
(5, 'samet@gmail.com', 'Biyoloji', 'Bitkiler', 31, '2021-06-06 17:44:07'),
(6, 'samet@gmail.com', 'Geometri', 'Üçgenler', 12, '2021-06-06 17:44:13'),
(7, 'samet@gmail.com', 'Matematik', 'Türev', 23, '2021-06-06 18:19:31'),
(8, 'samet@gmail.com', 'Geometri', 'Üçgenler', 100, '2021-06-07 09:44:33');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kaynaklar`
--

DROP TABLE IF EXISTS `kaynaklar`;
CREATE TABLE IF NOT EXISTS `kaynaklar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `yayinevi` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `kaynak_turu` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `kaynak_adi` varchar(150) COLLATE utf8mb4_turkish_ci NOT NULL,
  `sayfa_sayisi` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `kaynaklar`
--

INSERT INTO `kaynaklar` (`id`, `mail`, `yayinevi`, `kaynak_turu`, `kaynak_adi`, `sayfa_sayisi`) VALUES
(33, 'samet@gmail.com', 'Nasrettin HOCA', 'Okuma Kitabı', 'Kazan Doğurdu', 300),
(30, 'samet@gmail.com', 'rusya', 'Okuma Kitabı', 'aşkı memnu', 300),
(31, 'samet@gmail.com', 'klasik', 'Okuma Kitabı', 'Cimri', 120),
(32, 'samet@gmail.com', 'Güvender', 'Soru Bankası', 'Matematik', 250),
(24, 'mevlana@gmail.com', 'Güvender', 'Soru Bankası', 'Hikaye Kitabı', 250),
(25, 'mevlana@gmail.com', 'Baskil', 'Fasikül', 'Baskil hikayeleri', 300),
(34, 'samet@gmail.com', 'mahmut', 'Okuma Kitabı', 'sanane', 52),
(35, 'samet@gmail.com', 'Deliler', 'Okuma Kitabı', 'Manyaklar', 563),
(36, 'samet@gmail.com', 'Salaklar', 'Okuma Kitabı', 'Salak Abidin', 456),
(37, 'samet@gmail.com', 'Angutlar', 'Soru Bankası', 'Angut', 56);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kod_havuzu`
--

DROP TABLE IF EXISTS `kod_havuzu`;
CREATE TABLE IF NOT EXISTS `kod_havuzu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kod` varchar(10) COLLATE utf8mb4_turkish_ci NOT NULL,
  `kullanim` int(11) NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `kod_havuzu`
--

INSERT INTO `kod_havuzu` (`id`, `kod`, `kullanim`, `tarih`) VALUES
(5, 'CT44JM', 1, '2021-06-11 01:42:44');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `konular`
--

DROP TABLE IF EXISTS `konular`;
CREATE TABLE IF NOT EXISTS `konular` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sinif` varchar(20) COLLATE utf8mb4_turkish_ci NOT NULL,
  `ders` varchar(200) COLLATE utf8mb4_turkish_ci NOT NULL,
  `konu` varchar(1000) COLLATE utf8mb4_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `konular`
--

INSERT INTO `konular` (`id`, `sinif`, `ders`, `konu`) VALUES
(15, '5', 'Matematik', 'Kümeler'),
(11, '10', 'Matematik', 'Türev'),
(12, '10', 'Fizik', 'Elektrik'),
(13, '10', 'Matematik', 'İntegral'),
(14, '10', 'Fizik', 'Newton Kanunları'),
(16, '8', 'Türkçe', 'Anlatım Bozukluğu'),
(17, '10', 'Felsefe', 'Din Felsefesi'),
(18, '10', 'Kimya', 'Organik Kimya'),
(19, '10', 'Biyoloji', 'Bitkiler'),
(20, '10', 'Geometri', 'Üçgenler'),
(21, '5', 'Türkçe', 'Okuma'),
(22, '5', 'Matematik', 'Köklü Sayılar');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `paragraf_problem`
--

DROP TABLE IF EXISTS `paragraf_problem`;
CREATE TABLE IF NOT EXISTS `paragraf_problem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL,
  `cozulen` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL,
  `soru` int(11) NOT NULL,
  `sure` int(11) NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `paragraf_problem`
--

INSERT INTO `paragraf_problem` (`id`, `mail`, `cozulen`, `soru`, `sure`, `tarih`) VALUES
(4, 'samet@gmail.com', 'Paragraf', 123, 321, '2021-05-01 13:11:31'),
(2, 'samet@gmail.com', 'Problem', 6, 2, '2021-06-01 12:57:24'),
(5, 'samet@gmail.com', 'Paragraf', 23, 23, '2021-06-01 16:03:55'),
(6, 'samet@gmail.com', 'Problem', 100, 122, '2021-06-06 21:36:20'),
(7, 'samet@gmail.com', 'Paragraf', 23, 12, '2021-06-10 17:07:07');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `serbest_okuma`
--

DROP TABLE IF EXISTS `serbest_okuma`;
CREATE TABLE IF NOT EXISTS `serbest_okuma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL,
  `okunan_kitap` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL,
  `okunan_sayfa` int(11) NOT NULL,
  `okunan_sure` int(11) NOT NULL,
  `okunan_tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `serbest_okuma`
--

INSERT INTO `serbest_okuma` (`id`, `mail`, `okunan_kitap`, `okunan_sayfa`, `okunan_sure`, `okunan_tarih`) VALUES
(1, 'samet@gmail.com', 'aşkı memnu', 23, 23, '2021-05-29 15:33:40'),
(2, 'samet@gmail.com', 'Kazan Doğurdu', 34, 34, '2021-05-05 15:34:56'),
(3, 'samet@gmail.com', 'Kazan Doğurdu', 23, 60, '2021-05-31 14:09:27'),
(7, 'samet@gmail.com', 'Kazan Doğurdu', 234, 32, '2021-06-07 15:57:55'),
(8, 'samet@gmail.com', 'aşkı memnu', 323, 23, '2021-06-06 14:56:32'),
(9, 'samet@gmail.com', 'aşkı memnu', 45, 23, '2021-05-10 14:56:32'),
(10, 'samet@gmail.com', 'aşkı memnu', 2, 40, '2021-04-15 14:56:32'),
(11, 'samet@gmail.com', 'Cimri', 250, 60, '2021-06-07 09:43:38'),
(12, 'samet@gmail.com', 'aşkı memnu', 44, 23, '2021-06-10 15:49:23'),
(13, 'samet@gmail.com', 'aşkı memnu', 500, 500, '2021-06-11 01:33:23'),
(14, 'samet@gmail.com', 'Kazan Doğurdu', 23, 23, '2022-01-02 17:28:50');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `soyisim` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `tcno` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `d_tarihi` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `ogrenci_mail` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `sinif` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `ogrenci_cepno` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `veli_isim` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `veli_soyisim` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `veli_cepno` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `veli_mail` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `veli_sifre` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `ogrenci_sifre` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `danisman_kod` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `uyelik_durum` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `student`
--

INSERT INTO `student` (`id`, `isim`, `soyisim`, `tcno`, `d_tarihi`, `ogrenci_mail`, `sinif`, `ogrenci_cepno`, `veli_isim`, `veli_soyisim`, `veli_cepno`, `veli_mail`, `veli_sifre`, `ogrenci_sifre`, `danisman_kod`, `uyelik_durum`) VALUES
(23, 'Samet', 'Yıldırım', '35173348284', '2021-05-20', 'samet@gmail.com', '10', '5387922403', 'Mevlana', 'Akçin', '5369893116', 'saim@gmail.com', 'e88d038c4d313d9863a243d180913601cb0f2eef', 'e88d038c4d313d9863a243d180913601cb0f2eef', '2323', 1),
(22, 'Mevlana', 'Akçin', '35173348284', '2021-04-30', 'mevlana@gmail.com', '8', '5387922403', 'Mevlana', 'Akçin', '5369893116', 'saim@gmail.com', 'e88d038c4d313d9863a243d180913601cb0f2eef', 'e88d038c4d313d9863a243d180913601cb0f2eef', '2323', 1),
(27, 'Burak', 'Güldaş', '35173348284', '2021-07-02', 'burak@gmail.com', 'Mezun', '05451789365', 'Maksut', 'Güldaş', '05444444444', 'maksut@gmail.com', 'v1bwODng', 'e88d038c4d313d9863a243d180913601cb0f2eef', 'CT44JM', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yonetim`
--

DROP TABLE IF EXISTS `yonetim`;
CREATE TABLE IF NOT EXISTS `yonetim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` varchar(20) COLLATE utf8mb4_turkish_ci NOT NULL,
  `soyisim` varchar(20) COLLATE utf8mb4_turkish_ci NOT NULL,
  `mail` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL,
  `cepno` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `sifre` text COLLATE utf8mb4_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `yonetim`
--

INSERT INTO `yonetim` (`id`, `isim`, `soyisim`, `mail`, `cepno`, `sifre`) VALUES
(1, 'Elif', 'GÜNGÖRDÜ', 'elif@gmail.com', '05358236452', 'e88d038c4d313d9863a243d180913601cb0f2eef');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
