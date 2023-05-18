-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Май 19 2023 г., 01:23
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gallery`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `login` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `login`, `picture`, `comment`) VALUES
(71, 'admin', 'Chrysanthemum.jpg', '19.05.23 01:19: Комментарий Админа'),
(72, 'admin', '1684442402test.jpg', '19.05.23 01:19: Красивая собачка)))'),
(73, 'admin', 'Chrysanthemum.jpg', '19.05.23 01:20: Цветочки))))))'),
(74, 'user', 'Chrysanthemum.jpg', '19.05.23 01:21: Ой, Админ, привет, а почему я не могу твой комментарий удалить?'),
(77, 'user', '1684442402test.jpg', '19.05.23 01:22: Согласен');

-- --------------------------------------------------------

--
-- Структура таблицы `pictures`
--

CREATE TABLE `pictures` (
  `id` int NOT NULL,
  `picture` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Дамп данных таблицы `pictures`
--

INSERT INTO `pictures` (`id`, `picture`) VALUES
(1, 'Chrysanthemum.jpg'),
(3, 'Hydrangeas.jpg'),
(4, 'Koala.jpg'),
(5, 'Lighthouse.jpg'),
(6, 'Penguins.jpg'),
(11, '1684442402test.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`) VALUES
(4, 'admin2', '$2y$10$ID6.AEopgNd9JHnw7mmeG.NdQmH1XXHsE1hcizPincLSdkbQt5/MC', 'administrator2'),
(7, 'user', '$2y$10$O8HnYzbTryzdVBdQ/VissugwLrU2J3SQkCL2Mk5GspKBCIHkFkARG', 'Илья'),
(8, 'admin', '$2y$10$/KBCYxgSVmOlj33dxdDPD.QF8vY4U2AttaqcPXFwBQxk1xHGUvF7W', 'Админ'),
(9, 'adminius', '$2y$10$XFGC89dsLhO1ktiwFr90Yu.Z4eSNrnMzUp/7cz6hVsr4ZN3QmBwhG', 'Админушка');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT для таблицы `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
