-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 25 2020 г., 11:38
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
  `event_description` varchar(5500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_info` varchar(3000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_id` int(11) NOT NULL,
  `event_date_start` datetime DEFAULT NULL,
  `event_date_end` datetime DEFAULT NULL,
  `event_date_end_vote` datetime DEFAULT NULL,
  `event_is_vote` tinyint(1) NOT NULL,
  `event_vote_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `events`
--

INSERT INTO `events` (`event_id`, `user_id`, `event_name`, `event_short_description`, `event_description`, `event_info`, `photo_id`, `event_date_start`, `event_date_end`, `event_date_end_vote`, `event_is_vote`, `event_vote_type`) VALUES
(1, 1, 'Весенний сбор', 'Тыры пыры', 'ывбаю ыдва дыв адывдадывар иоиал ывдоа дывода ывдт атвыт дывтд ыдт ылтвлдтд тоывао ы', '', 7, '2020-04-28 00:00:00', '2020-05-15 00:00:00', NULL, 0, NULL),
(2, 2, 'Genious', 'qe dsfsdf', 'sdf sdfsd fsdf sd', '', 10, '2020-04-28 00:00:00', '2020-05-03 00:00:00', NULL, 0, NULL),
(4, 1, 'FUN JAM', 'This is a jam about fun and enjoyment. Don&#39;t stress out and have fun in this 72hour jam! With a team or individually.', 'Theme\r\nThe theme is &#34;Negative&#34;\r\n\r\nRules\r\n- The game should be adherent to the theme\r\n- The &#34;game&#34; should be only developed within the time frame\r\n- No NSFW stuff\r\n- Everyone MUST have fun!', '', 15, '2020-05-12 00:00:00', '2020-05-21 00:00:00', NULL, 0, NULL),
(9, 1, 'Community Jam', 'Welcome to the GameDev.tv Community Jam!', 'Q&A\r\n\r\nThere are no prizes as this is not a competitive event. However, users can vote on each other&#39;s submissions in three categories (visuals, gameplay, audio) as well as provide comments and feedback. I encourage everyone to try each other&#39;s games after the event, learn from each other&#39;s source code, and give tips where able.', '', 31, '2020-05-11 00:00:00', '2020-05-26 00:00:00', NULL, 0, NULL),
(10, 1, 'ваваап', 'ываываыв', 'ываываыва', '', 32, '2020-05-13 00:00:00', '2020-05-21 00:00:00', NULL, 0, NULL),
(11, 1, 'May Jam', 'Майский Jam', 'description', 'info', 44, '2020-05-22 00:00:00', '2020-05-22 00:00:00', '2020-05-22 00:00:00', 1, 'all'),
(12, 1, 'May Jam', 'Майский Jam', 'The Creative Theme for this jam is to be determined by our Patreon supporters - you can become a supporter and suggest a theme at Patreon.com/PIGSquad<br />\nJoin us in our Opening stream on August 13th and Closing Showcase Stream at Twitch.tv/PIGSquad!<br />\nThis jam will be fully remote.<br />\nA word on Horror Games:<br />\nMake a horror-themed game! Spooky stories, jump scares, Halloween games, cute games inspired by horror-themed subject matter, classical monsters, and cosmic horror are all on the table!<br />\nmidnightgame, C.U.L.T. Solutions, Nekomancer, Coven Ant, Fever Dreams, Rad Ladds vs The Midnight Man, and The Shadow Over Bridgetown are examples of horror games made by PIGSquad members at past jams.<br />\nJam Schedule:<br />\nWe will be hosting streams and other online activities to support jammers in meeting and sharing. This list will update over time.<br />\n<br />\nFollow PIGSquad on social media channels for consistent updates on events, workshops, and other opportunities.<br />\nIf you&#39;d like to participate in choosing the creative themes for each jam, voting is exclusive to our Patreon members - learn more here!<br />\nAll participants, in person or remote, must follow PIGSquad&#39;s Code of Conduct.<br />\nWe encourage you to jam with new people or on a team, but it is not required. We will be providing resources for team forming at the jam kickoff and throughout the jam timeline.<br />\nYou may use pre-existing tools to make games, but please start your jam at the official jam start date after the Creative Theme is revealed.<br />\nJammers retain full ownership of the games they make during Summer Slow Jams.<br />\nLate submissions or submission updates can be accepted - just get in touch with an organizer.<br />\nExtra special thanks to Marlowe for creating Summer Slow Jams art!<br />\n<br />\n<br />\nSummer Slow Jams:<br />\nEach summer, game makers get together to make a game project with friends and community members in a few weeks! Summer Slow Jams is a collection of game jam events happening once a month this summer, providing structure and networking opportunities for creatives in Portland and remote participants. Participate in a jam to finish a creative project, learn new things, meet new people, and share your work!<br />\n<br />\nCreative themes are delivered during each kick off event then shared online, and developers are able to showcase their game jam projects at each closing event in Portland, OR (online this year). In between the dates of the kick off and closing showcase, you are encouraged to meet up with others using online channels to complete a game over whatever in-jam time period you see fit: take it slow if you need!', 'August 13th, 7pm-10pm: Kickoff Stream - Theme Reveal, Team Forming<br />\nAugust 30th - Submissions Due<br />\nShowcase Stream is TBD<br />\nRules & More Details:<br />\nThese jams, the opening event, and the showcase will be fully remote. Non-Portlanders are welcome to participate.', 61, '2020-05-23 10:00:00', '2020-05-25 12:00:00', '2020-05-27 12:00:00', 1, 'who_in_jam'),
(13, 1, 'One Punch Man', 'One punch man jam, win use one punch.', 'This is a 48 hour game making marathon, focused on design, mechanics, and clever ideas. The jam runs from July 10th, at 8PM UK time, to July 12th, at 8PM UK time.<br />\n<br />\nHere&#39;s what you need to know:<br />\n<br />\nWho can enter? Anyone, from anywhere. You can work alone or in teams. <br />\n<br />\nWhat can I make my game in? Anything, provided you can upload a file that runs on Windows (without the need to install other programs) or browsers, to itch.io. You can also support other platforms too, if you like. So, sorry, but no physical games, Super Mario Maker levels, Dreams (PS4) games, or games that require an emulator to run.<br />\n<br />\nWhat assets can I use? To be announced...<br />\n<br />\nWho will judge the games? To be announced...<br />\n<br />\nWhat will the games be judged on? To be announced...<br />\n<br />\nIs there a Discord I can join? Yes! It will be open to the public on June 26th.', 'More rules:<br />\n<br />\n- You may participate in two jams at once if they happen at the same time and your game will fit both themes.<br />\n- Games submitted to the GMTK Jam must not contain nudity, or hateful language or visuals.<br />\n- You may make a VR game, but consider that few people will have the tech to actually judge your game.', 63, '2020-05-24 12:00:00', '2020-05-25 12:00:00', '2020-05-30 10:00:00', 1, 'who_in_jam');

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
(4, 3, 1),
(5, 10, 1),
(35, 12, 1),
(77, 13, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `games`
--

CREATE TABLE `games` (
  `game_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `game_url` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `game_short_description` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `game_description` varchar(4000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `game_status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `game_file_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `game_genre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `game_instruction` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_id` int(11) NOT NULL,
  `youtube_link` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `game_size` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `games`
--

INSERT INTO `games` (`game_id`, `user_id`, `game_name`, `game_url`, `game_short_description`, `game_description`, `game_status`, `game_file_name`, `game_genre`, `game_instruction`, `photo_id`, `youtube_link`, `game_size`, `event_id`) VALUES
(2, 1, 'Test game', 'test_game', 'This is my short description', 'In a city where the lives of humans are subjected to a time based currency system, you play the role of a hard up detective who goes on the hunt for a seller of fake time.</br></br>\r\n\r\n                                    There are two different modes: Movie and Game Mode.</br></br>\r\n\r\n                                    Change this in the graphic settings.</br>\r\n                                    INSTRUCTIONS (Keyboard | Controllers)</br></br>\r\n\r\n                                    Keyboard</br>\r\n                                    Movement - Arrow Keys | Left Joystick</br>\r\n                                    Interact - E key | A Button</br></br>\r\n\r\n                                    Skip dialogue - Spacebar | A Button</br>\r\n                                    Activate Time Device - R key | L Trigger</br>\r\n                                    Run - Left Shift | R Trigger</br>\r\n                                    Shoot - T key | B Button</br>\r\n                                    Pause - Escape key | Start Button</br></br>\r\n\r\n                                    PLATFORMS:</br></br>\r\n\r\n                                    PC (Recommended: GTX 960 and higher with at least 6GB of RAM)</br>\r\n                                    Mac (Recommended: Macbook Pro 15 and higher)</br>\r\n                                    Linux (Linux users - Please test this for me)</br></br>\r\n\r\n                                    LICENSED SOUNDTRACKS:</br></br>\r\n\r\n                                    Kansas City Flashback - Golden Age Radio (Epidemic Sound)</br>\r\n                                    Feel the Heat - Golden Age Radio (Epidemic Sound)</br>\r\n                                    Nothing left to ask for - Golden Age Radio (Epidemic Sound)</br>\r\n                                    Madison Twist - Macy\'s Voice (Epidemic Sound)</br>\r\n                                    Cinderella Ball Night - Sinfonietta Cinematica (Epidemic Sound)</br></br>\r\n\r\n                                    If you are receiving a claim on YouTube, let me know and i can get them to release for you.</br></br>\r\n\r\n                                    ADDITIONAL SOUNDTRACKS:</br></br>\r\n\r\n                                    Fight for family - Garry Schyman</br>\r\n                                    Dancers on a string - Garry Schyman</br>\r\n                                    Ballroom Waltz - Cliff Eidelman</br></br>\r\n\r\n                                    Follow me:</br></br>\r\n\r\n                                    Twitter: https://twitter.com/Hawaiiboys4life</br>\r\n                                    Instagram: https://www.instagram.com/hawaiiboys4life/</br>\r\n                                    YouTube: https://www.youtube.com/user/ilikecutepeople</br>', 'in_development', 'domains.zip', 'platformer', 'This is instruction to install the game', 37, 'GK26CGvjbkY', '1.90', NULL),
(3, 1, 'Onigiri Adventure', NULL, 'This is indie 2D platformer', 'This game have no description.', 'released', 'Setup.exe', 'platformer', 'Just download, install and have fun)', 39, NULL, '34.56 Mb', 13),
(4, 1, 'Something game', NULL, 'Short description', 'Description', 'released', '171680.zip', 'action', 'instruction', 69, NULL, '0.13 Mb', 13),
(5, 1, 'First jams game', NULL, 'Ufff, boring', 'And another useless description', 'released', 'Grass Assets.zip', 'adventure', 'There is instruction to installing game.', 70, NULL, '0.77 Mb', 13);

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
(14, '../img/arutomu_eb12a1b7da447c7265384f08a6f56681.jpeg'),
(15, '../img/arutomu_e48e8633de178c1b23da32a401508fd8.jpeg'),
(31, '../img/arutomu_557991a9e6d5153d75526bd177f89ad3.jpeg'),
(32, '../img/arutomu_90344c1558c2e3a0ba4deef099cc3184.jpeg'),
(33, 'http://gamedevcommunity/img/uploaded_photo_51016ec3_min.png'),
(37, '../../img/arutomu_d90fbc50ad84776f34f5de954a06df97.jpeg'),
(39, '../../img/arutomu_7fd927afdbe73122451d20a95f57ccf7.jpeg'),
(44, '../img/arutomu_4840680c219ec1b613919857592ab19e.jpeg'),
(61, '../img/arutomu_17659c43f15c6ee98254925dc354d65f.jpeg'),
(63, '../img/arutomu_c3736afa972405077204d7e41b00b504.jpeg'),
(69, '../../img/arutomu_dd7c92ab5c0884d2b49135256840515f.jpeg'),
(70, '../../img/arutomu_9d251f67ed2f50ba92603f6ec1dfae39.jpeg');

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
-- Структура таблицы `rating`
--

CREATE TABLE `rating` (
  `rating_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mark` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `rating`
--

INSERT INTO `rating` (`rating_id`, `event_id`, `game_id`, `user_id`, `mark`) VALUES
(24, 13, 3, 1, 5);

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
(11, 3, 1),
(12, 2, 3),
(13, 1, 3);

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
(2, 'Hideo', 'Kojima', 'kojima', 'eeca350d841ec673ecf3b3bd66f7a4a1', 'kojima@gmail.com', 33, 'Genius'),
(3, 'Иван', 'Иванов', 'ivan', 'eeca350d841ec673ecf3b3bd66f7a4a1', 'ivan@gmail.com', 12, 'Java developer'),
(36, 'Сергей', 'Химера', 'serjio', 'eeca350d841ec673ecf3b3bd66f7a4a1', 'serjio@gmail.com', 1, 'Химерос');

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
  ADD KEY `user_id` (`user_id`),
  ADD KEY `photo_id` (`photo_id`);

--
-- Индексы таблицы `event_members`
--
ALTER TABLE `event_members`
  ADD PRIMARY KEY (`event_members_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`game_id`),
  ADD KEY `games_ibfk_photo` (`photo_id`),
  ADD KEY `games_ibfk_users` (`user_id`);

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
  ADD KEY `user_id_itemsubject_fk` (`user_id`),
  ADD KEY `photo_id_itemsubject_fk` (`photo_id`);

--
-- Индексы таблицы `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `game_id` (`game_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`subscription_id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `event_members`
--
ALTER TABLE `event_members`
  MODIFY `event_members_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT для таблицы `games`
--
ALTER TABLE `games`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `photo`
--
ALTER TABLE `photo`
  MODIFY `photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `rating`
--
ALTER TABLE `rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `subscription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`photo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `event_members`
--
ALTER TABLE `event_members`
  ADD CONSTRAINT `event_members_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_ibfk_photo` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`photo_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `games_ibfk_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `photo_id_itemsubject_fk` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`photo_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id_itemsubject_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rating_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`photo_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
