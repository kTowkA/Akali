-- phpMyAdmin SQL Dump
-- version 3.4.3
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Фев 19 2012 г., 19:00
-- Версия сервера: 5.5.20
-- Версия PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `id_author` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `surname` varchar(22) NOT NULL,
  `name` varchar(22) NOT NULL,
  `patronymic` varchar(22) NOT NULL,
  PRIMARY KEY (`id_author`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `author`
--

INSERT INTO `author` (`id_author`, `surname`, `name`, `patronymic`) VALUES
(1, 'Иванов', 'Иван', 'Иванович'),
(2, 'Петров', 'Петр', 'Петрович'),
(3, 'Алексеев', 'Алексей', 'Алексеевич');

-- --------------------------------------------------------

--
-- Структура таблицы `author_books`
--

CREATE TABLE IF NOT EXISTS `author_books` (
  `id_author` int(11) unsigned NOT NULL,
  `id_book` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_author`,`id_book`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `author_books`
--

INSERT INTO `author_books` (`id_author`, `id_book`) VALUES
(1, 1),
(1, 3),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(2, 2),
(2, 4),
(2, 7),
(2, 12),
(2, 18),
(2, 19),
(2, 20),
(2, 21),
(3, 1),
(3, 4),
(3, 19),
(3, 20);

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id_book` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(22) NOT NULL,
  `id_publishing_house` int(11) NOT NULL,
  PRIMARY KEY (`id_book`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id_book`, `name`, `id_publishing_house`) VALUES
(1, 'Шелдон', 2),
(2, 'Пенни', 2),
(3, 'Леонард', 3),
(4, 'Радж', 4),
(7, 'Эмми2', 4),
(8, 'Говард', 3),
(12, 'asfasf', 3),
(18, 'www', 2),
(19, 'пам', 4),
(20, 'Триумф', 3),
(21, 'ух', 4),
(22, 'ТБВ', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `publishing_house`
--

CREATE TABLE IF NOT EXISTS `publishing_house` (
  `id_publishing_house` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(22) NOT NULL,
  PRIMARY KEY (`id_publishing_house`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `publishing_house`
--

INSERT INTO `publishing_house` (`id_publishing_house`, `name`) VALUES
(1, 'Какой-то'),
(2, 'Что-то'),
(3, 'Бдыщ'),
(4, 'Bazzinga');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
