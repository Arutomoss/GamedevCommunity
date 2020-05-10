-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 10 2020 г., 16:48
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gamedc`
--

-- --------------------------------------------------------

--
-- Структура таблицы `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `event_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_short_description` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_id` int(11) NOT NULL,
  `event_date_start` datetime DEFAULT NULL,
  `event_date_end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `events`
--

INSERT INTO `events` (`event_id`, `user_id`, `event_name`, `event_short_description`, `event_description`, `photo_id`, `event_date_start`, `event_date_end`) VALUES
(1, 1, 'Весенний сбор', 'Тыры пыры', 'ывбаю ыдва дыв адывдадывар иоиал ывдоа дывода ывдт атвыт дывтд ыдт ылтвлдтд тоывао ы', 7, '2020-04-28 00:00:00', '2020-05-15 00:00:00'),
(2, 2, 'Genious', 'qe dsfsdf', 'sdf sdfsd fsdf sd', 10, '2020-04-28 00:00:00', '2020-05-03 00:00:00'),
(3, 1, 'dfsdfs', 'sdfsdf', 'fsdfsdfsdf', 14, '2020-05-05 00:00:00', '2020-05-27 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `events_photo`
--

CREATE TABLE `events_photo` (
  `photo_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `link_photo` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `event_members`
--

CREATE TABLE `event_members` (
  `event_members_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `event_members`
--

INSERT INTO `event_members` (`event_members_id`, `event_id`, `user_id`) VALUES
(2, 1, 2),
(3, 2, 2),
(4, 3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message_text` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `photo`
--

CREATE TABLE `photo` (
  `photo_id` int(11) NOT NULL,
  `link_photo` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `photo`
--

INSERT INTO `photo` (`photo_id`, `link_photo`) VALUES
(1, 'http://gamedevcommunity/img/default_photo.png'),
(2, 'http://gamedevcommunity/img/uploaded_photo_9448e4ca_min.png'),
(3, 'http://gamedevcommunity/img/uploaded_photo_316d8efd_min.png'),
(4, '../img/arutomu_d9adf92f3399c4fc341dc499b312ac40.jpeg'),
(5, '../img/arutomu_9d75feba332d6c69835a7d26aa6a3483.jpeg'),
(6, '../img/arutomu_326723b39e0696324783542cb9a07aa9.jpeg'),
(7, '../img/arutomu_981fc96e59c33555cceca37e7fd563a7.jpeg'),
(8, 'http://gamedevcommunity/img/uploaded_photo_f281af92_min.png'),
(9, '../img/kojima_3f129ba56069758075b69d505911ece7.jpeg'),
(10, '../img/kojima_ad58438405cfd0c45e3479277cd88259.jpeg'),
(11, '../img/kojima_349cc6cda7c3798b783107245aff4103.jpeg'),
(12, 'http://gamedevcommunity/img/uploaded_photo_d20f2c25_min.png'),
(13, '../img/arutomu_a9a6bad7a7941d1dc8285132ec45dfa0.jpeg'),
(14, '../img/arutomu_eb12a1b7da447c7265384f08a6f56681.jpeg');

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_text` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_id` int(11) DEFAULT NULL,
  `date_create` datetime NOT NULL,
  `amount_likes` int(11) NOT NULL,
  `amount_reposts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_text`, `photo_id`, `date_create`, `amount_likes`, `amount_reposts`) VALUES
(1, 1, 'Тестируем, проверяем.', 4, '2020-04-28 12:18:01', 0, 0),
(2, 1, 'asdasda', 6, '2020-04-28 13:01:09', 0, 0),
(3, 1, 'hello!', NULL, '2020-04-28 13:46:56', 0, 0),
(4, 2, 'Konnichiwa my favourite fans!', 11, '2020-04-28 14:06:45', 0, 0),
(5, 3, 'Первый пост Ивана Иванова, что же будет?', NULL, '2020-05-04 10:30:47', 0, 0),
(6, 1, 'kshfksh lfh lisf', 13, '2020-05-05 18:28:13', 0, 0),
(7, 2, 'My another genious post!', NULL, '2020-05-10 12:51:53', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `subscriptions`
--

CREATE TABLE `subscriptions` (
  `subscription_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `subscriptions`
--

INSERT INTO `subscriptions` (`subscription_id`, `user_id`, `follower_id`) VALUES
(1, 1, 2),
(6, 2, 3),
(7, 1, 3),
(11, 3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_login` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_pass` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_mail` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_id` int(11) NOT NULL DEFAULT 1,
  `short_description` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `user_login`, `user_pass`, `user_mail`, `photo_id`, `short_description`) VALUES
(1, 'Артем', 'Кошарнов', 'arutomu', 'eeca350d841ec673ecf3b3bd66f7a4a1', 'artem@gmail.com', 3, 'Suppa'),
(2, 'Hideo', 'Kojima', 'kojima', 'eeca350d841ec673ecf3b3bd66f7a4a1', 'kojima@gmail.com', 8, 'Genius'),
(3, 'Иван', 'Иванов', 'ivan', 'eeca350d841ec673ecf3b3bd66f7a4a1', 'ivan@gmail.com', 12, 'Java developer');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `message_id` (`message_id`);

--
-- Индексы таблицы `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `events_photo`
--
ALTER TABLE `events_photo`
  ADD PRIMARY KEY (`photo_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Индексы таблицы `event_members`
--
ALTER TABLE `event_members`
  ADD PRIMARY KEY (`event_members_id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`photo_id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `photo_id` (`photo_id`);

--
-- Индексы таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`subscription_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `photo_id` (`photo_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `events_photo`
--
ALTER TABLE `events_photo`
  MODIFY `photo_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `event_members`
--
ALTER TABLE `event_members`
  MODIFY `event_members_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `photo`
--
ALTER TABLE `photo`
  MODIFY `photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `subscription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`message_id`) REFERENCES `messages` (`message_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `events_photo`
--
ALTER TABLE `events_photo`
  ADD CONSTRAINT `events_photo_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `posts` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
