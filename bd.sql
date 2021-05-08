-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.3.22-MariaDB - mariadb.org binary distribution
-- Операционная система:         Win64
-- HeidiSQL Версия:              11.0.0.5958
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных bd
CREATE DATABASE IF NOT EXISTS `bd` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `bd`;

-- Дамп структуры для таблица bd.locality
CREATE TABLE IF NOT EXISTS `locality` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `region_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `region_id_foreign` (`region_id`),
  CONSTRAINT `region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы bd.locality: ~7 rows (приблизительно)
/*!40000 ALTER TABLE `locality` DISABLE KEYS */;
INSERT INTO `locality` (`id`, `region_id`, `name`) VALUES
	(1, 1, 'Краснодар'),
	(2, 1, 'Москва'),
	(3, 1, 'Челябинск'),
	(4, 2, 'Нур-Султан'),
	(5, 3, 'Минск'),
	(6, 4, 'Уфа'),
	(10, 13, 'Токио');
/*!40000 ALTER TABLE `locality` ENABLE KEYS */;

-- Дамп структуры для таблица bd.region
CREATE TABLE IF NOT EXISTS `region` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы bd.region: ~17 rows (приблизительно)
/*!40000 ALTER TABLE `region` DISABLE KEYS */;
INSERT INTO `region` (`id`, `name`) VALUES
	(1, 'Россия 000'),
	(2, 'Казахстан 111'),
	(3, 'Белоруссия'),
	(4, 'Башкирия'),
	(13, 'Япония'),
	(19, 'Германия'),
	(20, 'Швеция'),
	(21, 'Канада'),
	(22, 'США'),
	(23, 'Польша'),
	(24, 'Чехия'),
	(25, 'Словения'),
	(30, 'Ирак'),
	(31, 'Иран'),
	(32, 'Судан'),
	(33, 'Боливия'),
	(34, 'Чили');
/*!40000 ALTER TABLE `region` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
