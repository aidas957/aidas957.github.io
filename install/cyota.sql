-- phpMyAdmin SQL Dump
-- version 3.4.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 11 2016 г., 21:43
-- Версия сервера: 5.2.6
-- Версия PHP: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `cyota`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cy_builds`
--

CREATE TABLE IF NOT EXISTS `cy_builds` (
  `cy_builds_id` int(10) NOT NULL AUTO_INCREMENT,
  `cy_builds_user` int(11) NOT NULL,
  `cy_builds_active` int(11) NOT NULL,
  `cy_builds_device` varchar(255) NOT NULL,
  `cy_builds_incremental` varchar(255) NOT NULL,
  `cy_builds_api_level` varchar(255) NOT NULL,
  `cy_builds_url` varchar(255) NOT NULL,
  `cy_builds_timestamp` varchar(255) NOT NULL,
  `cy_builds_md5sum` varchar(255) NOT NULL,
  `cy_builds_changes` varchar(255) NOT NULL,
  `cy_builds_channel` varchar(255) NOT NULL,
  `cy_builds_filename` varchar(255) NOT NULL,
  PRIMARY KEY (`cy_builds_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `cy_builds`
--

INSERT INTO `cy_builds` (`cy_builds_id`, `cy_builds_user`, `cy_builds_active`, `cy_builds_device`, `cy_builds_incremental`, `cy_builds_api_level`, `cy_builds_url`, `cy_builds_timestamp`, `cy_builds_md5sum`, `cy_builds_changes`, `cy_builds_channel`, `cy_builds_filename`) VALUES
(1, 1, 1, 'logan', '11111111111', '19', 'http://updates.cm-ota.pp.ua/files/builds/ota.zip', '11111111', '11111111111', 'http://updates.cm-ota.pp.ua/files/builds/ota.txt', 'nightly', 'ota.zip');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
