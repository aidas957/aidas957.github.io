-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 25 2015 г., 17:55
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `ota`
--

-- --------------------------------------------------------

--
-- Структура таблицы `builds`
--

CREATE TABLE IF NOT EXISTS `builds` (
  `builds_id` int(10) NOT NULL AUTO_INCREMENT,
  `builds_device` varchar(255) NOT NULL,
  `builds_type` varchar(255) NOT NULL,
  `builds_incremental` varchar(255) NOT NULL,
  `builds_api_level` varchar(255) NOT NULL,
  `builds_url` varchar(255) NOT NULL,
  `builds_timestamp` varchar(255) NOT NULL,
  `builds_md5sum` varchar(255) NOT NULL,
  `builds_changes` varchar(255) NOT NULL,
  `builds_channel` varchar(255) NOT NULL,
  `builds_filename` varchar(255) NOT NULL,
  PRIMARY KEY (`builds_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `builds`
--

INSERT INTO `builds` (`builds_id`, `builds_device`, `builds_type`, `builds_incremental`, `builds_api_level`, `builds_url`, `builds_timestamp`, `builds_md5sum`, `builds_changes`, `builds_channel`, `builds_filename`) VALUES
(1, 'logands', 'relize', 'QQQQQQQQ', '19', 'http://QQQQQQQ.zip', '1391086037', '4e0a335b378035d12cb6626b6623072b', 'http://ace3.tk/CHANGES.txt', 'nightly', 'QQQQQQQ.zip');

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `types` varchar(255) NOT NULL,
  `vars` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `name`, `types`, `vars`) VALUES
(1, 'Главная', 'lnk', '/index.php'),
(2, 'Статистика', 'cat', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `stats`
--

CREATE TABLE IF NOT EXISTS `stats` (
  `stats_id` int(11) NOT NULL AUTO_INCREMENT,
  `stats_time` int(11) NOT NULL,
  `stats_ip` varchar(255) NOT NULL,
  `stats_device` varchar(255) NOT NULL,
  `stats_build` varchar(255) NOT NULL,
  `stats_work` varchar(255) NOT NULL,
  PRIMARY KEY (`stats_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `stats`
--

INSERT INTO `stats` (`stats_id`, `stats_time`, `stats_ip`, `stats_device`, `stats_build`, `stats_work`) VALUES
(1, 0, '127.0.0.1', 'logands', '00000000', 'chek');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
