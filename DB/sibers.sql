-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Апр 21 2022 г., 02:45
-- Версия сервера: 8.0.18
-- Версия PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `sibers`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `DOB` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `surname`, `gender`, `DOB`) VALUES
(14, 'Ivannnn', '$2y$10$vsR.p1tPrZEikJkrXHqwSeY3BcXlz16v/q5kUxBXX3V2fCKVP/LhW', 'Ivan', 'Ivanov', 'male', '1999-10-01'),
(16, 'Vladimirrr', '$2y$10$Z8Twl7ZwKLL9N9UK6Ko.1uqpM0IgefXORc8gsVs.L9Nh3FrtXzyem', 'Vladimir', 'Petrov', 'male', '2000-03-18'),
(17, 'Elenaaaa', '$2y$10$yEvzNlVEAEkgADJRSMRMFOPZAoxbWx0n.Wu8uoqaEXuH.dlkIlDaK', 'Elena', 'Popova', 'female', '2001-04-12'),
(18, 'Katiaaaa', '$2y$10$k3iSoHnJqLOaZyzkhgt8Wew3pf1Dwd3JychOeM8888/hjiaW3TK5G', 'Ekaterina', 'Voloshina', 'female', '1991-03-30'),
(19, 'Dimaaaa', '$2y$10$IUwhyUFckXKurFrN5r7JY.QZvkNxC2Qs3HgMMDCddGIXBKyCEkYJK', 'Dmitriy', 'Zuev', 'male', '1995-11-09'),
(20, 'Olgaaaaaa', '$2y$10$7PXokKbJZxfFE8eVVS41tOXK3R3eBx3LJkolmMilR/mlgz4b2F0J.', 'Olga', 'Ivanovna', 'female', '1999-10-18'),
(21, 'Romannnn', '$2y$10$j.d/YLtD1X5g01mS3FKmiuuqEM9lQ.R0uLO5IxK.Yqc2I8uxu2GHC', 'Roman', 'Frolov', 'male', '1993-01-01'),
(22, 'Grigoriyy', '$2y$10$BS9rcF/rtkFoNYys6KDSEOfFjchvurZ7CEteGycQ8hR0uJ.q/qnae', 'Grigoriy', 'Smolov', 'male', '2005-02-20'),
(23, 'Julyyyyyy', '$2y$10$W0NUnwKiZn.g/49fAXdeReaMa7BlmWuPtdXGYBt6ARbURhe3SycHS', 'Julia', 'Plotkina', 'female', '2002-03-22'),
(24, 'Sergeyyy', '$2y$10$3/Bwa84OemnG/TLCBOY8teiV6Z8PjTV1xWuDoiBs7UpllK55k6QCK', 'Sergey', 'Fedorov', 'male', '1990-01-20');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
