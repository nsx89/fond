-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 22 2025 г., 02:38
-- Версия сервера: 5.7.33
-- Версия PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `fond`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `h1` varchar(500) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `show` int(1) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `image2` varchar(100) DEFAULT NULL,
  `short` varchar(500) DEFAULT NULL,
  `text` longtext,
  `date` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `other` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `name`, `h1`, `url`, `show`, `rate`, `image`, `image2`, `short`, `text`, `date`, `views`, `author`, `other`) VALUES
(1, 'Важность помощи ближнему', 'Гуманитарная помощь участникам военных действий: необходимость, формы и вызовы', 'vazhnost-pomoschi-blizhnemu', 1, 0, '/public/src/images/articles/68ce01806878d.jpg', '/public/src/images/articles/68cf14e4cd5eb.jpg', 'Помощь другим — это одна из основных человеческих ценностей. Она играет ключевую роль в укреплении социальных связей и создании сплоченного общества.', '<p><strong>Военные конфликты оставляют глубокие раны как на теле, так и на душе людей, которые стали их жертвами. Участники военных действий, а также их семьи часто нуждаются в серьезной помощи, чтобы справиться с физическими и психологическими последствиями войны. Гуманитарная помощь в данном контексте становится важным элементом восстановления и реинтеграции в мирную жизнь.</strong></p>\r\n<p>Военные действия приводят не только к непосредственной потере жизней, но и к разнообразным нарушениям прав человека. Участники конфликтов часто сталкиваются с травмами, увечьями,<br />и посттравматическим стрессовым расстройством (ПТСР). Гуманитарная помощь необходима для:</p>\r\n<p>Физического восстановления: Открытая помощь включает медицинские услуги, реабилитацию<br />и предоставление протезов для раненых бойцов.&nbsp; Психологической поддержки: Участники конфликтов зачастую испытывают психоэмоциональные травмы. Психологическая поддержка, терапия и группы поддержки помогают людям справляться с последствиями стресса и травмы.</p>\r\n<p>Социальной реабилитации: Помощь в поиске работы, жильё, профессиональное обучение и другие ресурсы могут сыграть важную роль в возвращении участников военных действий к нормальной жизни.</p>', 1755348300, 1681, 'Ливанов Сергей', '|5|7|9|2|'),
(2, 'Социальная ответственность', NULL, 'social-naya-otvetstvennost', 1, 0, '/public/src/images/articles/68cec7d522483.jpg', NULL, 'Помощь другим способствует развитию чувства социальной ответственности. Когда мы помогаем другим, что заботимся о благополучии нашего общества.', '', 1755205200, NULL, NULL, NULL),
(3, 'Вызовы гуманитарной помощи', NULL, 'vyzovy-gumanitarnoy-pomoschi', 1, 0, '/public/src/images/articles/68cedda66c9cc.jpg', NULL, 'Несмотря на важность гуманитарной помощи, существует множество вызовов, с которыми сталкиваются  государства, предоставляющие такую помощь', '', 1755118800, NULL, NULL, NULL),
(4, 'Гуманитарная помощь участникам военных действий', NULL, 'gumanitarnaya-pomosch-uchastnikam-voennyh-deystviy', 1, 0, '/public/src/images/articles/68cec99945f74.jpg', NULL, 'Эффективная помощь может изменить жизнь людей', '', 1754946000, 1, NULL, NULL),
(5, 'Важность помощи ближнему', NULL, 'vazhnost-pomoschi-blizhnemu-5', 1, 0, '/public/src/images/articles/68cf03124f094.jpg', NULL, 'Помощь другим — это одна из основных человеческих ценностей. Она играет ключевую роль в укреплении социальных связей и создании сплоченного общества.', '', 1754859600, 1, NULL, NULL),
(6, 'Социальная ответственность', NULL, 'social-naya-otvetstvennost-6', 1, 0, '/public/src/images/articles/68cedd5481fe0.jpg', NULL, 'Помощь другим способствует развитию чувства социальной ответственности. Когда мы помогаем другим, что заботимся о благополучии нашего общества.', '', 1754773200, NULL, NULL, NULL),
(7, 'Вызовы гуманитарной помощи', NULL, 'vyzovy-gumanitarnoy-pomoschi-7', 1, 0, '/public/src/images/articles/68cedac212f9a.jpg', NULL, 'Несмотря на важность гуманитарной помощи, существует множество вызовов, с которыми сталкиваются  государства, предоставляющие такую помощь', '', 1754686800, NULL, NULL, NULL),
(8, 'Гуманитарная помощь участникам военных действий', NULL, 'gumanitarnaya-pomosch-uchastnikam-voennyh-deystviy-8', 1, 0, '/public/src/images/articles/68cecb9e7df5b.jpg', NULL, 'Эффективная помощь может изменить жизнь людей', '', 1754600400, NULL, NULL, NULL),
(9, 'Вызовы гуманитарной помощи', NULL, 'vyzovy-gumanitarnoy-pomoschi-9', 1, 0, '/public/src/images/articles/68cf01b05c0e8.jpg', NULL, '', '', 1752958800, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `name2` varchar(255) DEFAULT NULL,
  `show` int(1) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `banners`
--

INSERT INTO `banners` (`id`, `name`, `name2`, `show`, `rate`, `image`) VALUES
(1, 'Помогаем фронту\r\nи заботимся', 'о героях', 1, 0, '/public/src/images/banners/68d05ef1e8f94.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `forms`
--

CREATE TABLE `forms` (
  `id` bigint(20) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `date` int(11) DEFAULT NULL,
  `url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `forms_type`
--

CREATE TABLE `forms_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `forms_type`
--

INSERT INTO `forms_type` (`id`, `name`) VALUES
(1, 'Напишите нам');

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ids` int(11) DEFAULT NULL,
  `idb` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_small` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_origin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `id_1c_photo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `type`, `ids`, `idb`, `image`, `image_small`, `image_origin`, `alt`, `name`, `rate`, `id_1c_photo`) VALUES
(2, 'page', 3, NULL, '/public/src/images/gallery/page/68d06b54e2da4_big.jpg', '/public/src/images/gallery/page/68d06b54e2da4_small.jpg', '/public/src/images/gallery/page/68d06b54e2da4.jpg', NULL, '1', 0, NULL),
(3, 'page', 3, NULL, '/public/src/images/gallery/page/68d06b60257b9_big.jpg', '/public/src/images/gallery/page/68d06b60257b9_small.jpg', '/public/src/images/gallery/page/68d06b60257b9.jpg', NULL, '1', 0, NULL),
(4, 'page', 3, NULL, '/public/src/images/gallery/page/68d06b660fb31_big.jpg', '/public/src/images/gallery/page/68d06b660fb31_small.jpg', '/public/src/images/gallery/page/68d06b660fb31.jpg', NULL, '1', 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `medals`
--

CREATE TABLE `medals` (
  `id` int(11) NOT NULL,
  `show` tinyint(1) DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `medals`
--

INSERT INTO `medals` (`id`, `show`, `name`, `rate`) VALUES
(1, 1, 'Медаль «Участник СВО»', 100),
(3, 1, 'Медаль «За боевое содружество»', 90),
(4, 1, 'Медаль «Волонтёр России»', 70),
(5, 1, 'Медаль «Помощь фронту»', 60);

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `parent` int(11) DEFAULT '0',
  `show` int(1) DEFAULT NULL,
  `menu` tinyint(1) DEFAULT '0',
  `menu_footer` tinyint(1) DEFAULT '0',
  `rate` int(11) DEFAULT NULL,
  `rate_footer` int(11) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `file` varchar(100) DEFAULT NULL,
  `text` longtext,
  `short` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `name`, `url`, `parent`, `show`, `menu`, `menu_footer`, `rate`, `rate_footer`, `image`, `file`, `text`, `short`) VALUES
(1, 'Главная', '/', -1, 1, 0, 0, 0, NULL, NULL, NULL, '', NULL),
(3, 'О проекте', 'o-proekte', 0, 1, 1, 1, 0, 90, NULL, NULL, '', '<p>Фонд был основан для того, чтобы каждый из нас мог внести свою лепту в достижение Победы и спасение жизней наших защитников, которые в данный момент подвергают свои жизни и здоровье большому риску.</p>\r\n<p><strong> Мы являемся мостом между теми, кто хочет оказать помощь, и военнослужащими, нуждающимися в поддержке. </strong></p>\r\n<p>Каждая отправленная на фронт партия гуманитарной помощи, каждый переведенный рубль и каждое поддерживающее слово приближают нас к Победе.</p>'),
(4, 'Оказать помощь', 'okazat-pomosch', 0, 1, 1, 1, 0, 70, NULL, NULL, '', NULL),
(5, 'Документы', 'dokumenty', 0, 1, 1, 1, 0, 50, NULL, NULL, '', NULL),
(6, 'Статьи', 'statii', 0, 1, 1, 1, 0, 80, NULL, NULL, '', NULL),
(7, 'Волонтеры', 'volontery', 0, 1, 1, 1, 0, 40, NULL, NULL, '', NULL),
(8, 'Партнеры', 'partnery', 0, 1, 1, 1, 0, 30, NULL, NULL, '', NULL),
(9, 'Контакты', 'kontakty', 0, 1, 1, 1, 0, 60, NULL, NULL, '', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `seo`
--

CREATE TABLE `seo` (
  `id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `opis` text COLLATE utf8_unicode_ci,
  `title` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `seo`
--

INSERT INTO `seo` (`id`, `url`, `opis`, `title`, `keywords`, `description`) VALUES
(1, '/', '', 'Главная', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_send` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `soc1` varchar(255) DEFAULT NULL,
  `soc2` varchar(255) DEFAULT NULL,
  `soc_name1` varchar(255) DEFAULT NULL,
  `soc_name2` varchar(255) DEFAULT NULL,
  `copy` varchar(255) DEFAULT NULL,
  `copy2` varchar(255) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `link` varchar(500) DEFAULT NULL,
  `head` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `title`, `email`, `email_send`, `phone`, `phone2`, `address`, `logo`, `soc1`, `soc2`, `soc_name1`, `soc_name2`, `copy`, `copy2`, `image`, `link`, `head`) VALUES
(1, 'Фонд поддержки ветеранов боевых действий', 'veec@bk.ru', 'veec@bk.ru', '+7 (911) 136 80 05', NULL, NULL, '/public/src/files/settings/68d06b87171b1.svg', 'https://t.me/volonterspb777', 'https://vk.com/club227952307', '@volonterspb777', 'Фонд «Северный Легион»', 'ООО Фонд поддержки ветеранов боевых действий,', 'Все права защищены.', '/public/src/images/settings/68d05d3524df6.png', '/', 'Благодаря вам они получили помощь');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `hash_forgot` varchar(255) DEFAULT NULL,
  `class` int(11) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `date_visit` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `hash`, `hash_forgot`, `class`, `date`, `date_visit`, `name`, `phone`) VALUES
(1, 'test@test.ru', '$2y$10$XtyDvJE9Hj35l9r2uSDhWOQVg9Ad5HVNa27gTrizl2KSwBM/EiKlq', '1a2d7230e9de1a3de34464cc1bcf12d7', NULL, 1, 1748093726, 1758494358, 'Тест Тестов', '+7 (111) 111-11-39');

-- --------------------------------------------------------

--
-- Структура таблицы `users_class`
--

CREATE TABLE `users_class` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users_class`
--

INSERT INTO `users_class` (`id`, `name`) VALUES
(1, 'Администратор'),
(2, 'Клиент');

-- --------------------------------------------------------

--
-- Структура таблицы `users_ip`
--

CREATE TABLE `users_ip` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users_ip`
--

INSERT INTO `users_ip` (`id`, `name`, `text`) VALUES
(1, '127.0.0.1', 'Локальный'),
(2, '91.234.152.117', 'Наш офисный'),
(3, '*', 'Все IP адреса');

-- --------------------------------------------------------

--
-- Структура таблицы `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `show` int(1) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `video` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `video`
--

INSERT INTO `video` (`id`, `name`, `show`, `rate`, `video`, `image`) VALUES
(1, 'Видео1', 1, 0, '/public/src/files/video/68d07cd9bbfc2.mp4', '/public/src/images/video/68d07a3997c7a.jpg'),
(2, 'Видео2', 1, 0, '/public/src/files/video/68d07e2817d55.mp4', '/public/src/images/video/68d07e1f44329.jpg'),
(3, 'Видео3', 1, 0, '/public/src/files/video/68d07e4f86907.mp4', '/public/src/images/video/68d07e48356cf.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `volunteers`
--

CREATE TABLE `volunteers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `show` int(1) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `short` varchar(500) DEFAULT NULL,
  `medals` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `volunteers`
--

INSERT INTO `volunteers` (`id`, `name`, `url`, `show`, `rate`, `image`, `short`, `medals`) VALUES
(1, 'Литвинов Сергей Павлович', 'litvinov-sergey-pavlovich', 1, 0, '/public/src/images/volunteers/68cf4061b3452.jpg', 'Представитель попечительского совета', '|1|3|'),
(2, 'Заманов Рамин Муслимович', 'zamanov-ramin-muslimovich', 1, 0, '/public/src/images/volunteers/68cf4032c8bc1.jpg', 'Учредитель фонда', '|1|4|5|'),
(3, 'Носков Матвей Александрович', 'noskov-matvey-aleksandrovich', 1, 0, '/public/src/images/volunteers/68cf430545587.jpg', 'Представитель попечительского совета', '|3|1|'),
(4, 'Ефремов Матвей Львович', 'efremov-matvey-l-vovich', 1, 0, '/public/src/images/volunteers/68cf4402b62dd.jpg', 'Представитель попечительского совета', '|1|3|'),
(5, 'Максимов Марк Тимофеевич', 'maksimov-mark-timofeevich', 1, 0, '/public/src/images/volunteers/68cf4455f0526.jpg', 'Учредитель фонда', '|1|4|5|'),
(7, 'Кочергин Давид Русланович', 'kochergin-david-ruslanovich', 1, 0, '/public/src/images/volunteers/68cf48a15d5ab.jpg', 'Представитель попечительского совета', '|1|3|'),
(8, 'Литвинов Сергей Павлович', 'litvinov-sergey-pavlovich2', 1, 0, '/public/src/images/volunteers/68cf4061b34522.jpg', 'Представитель попечительского совета', '|1|3|'),
(9, 'Заманов Рамин Муслимович', 'zamanov-ramin-muslimovich2', 1, 0, '/public/src/images/volunteers/68cf4032c8bc12.jpg', 'Учредитель фонда', '|1|4|5|'),
(10, 'Носков Матвей Александрович', 'noskov-matvey-aleksandrovich2', 1, 0, '/public/src/images/volunteers/68cf4305455872.jpg', 'Представитель попечительского совета', '|3|1|'),
(11, 'Ефремов Матвей Львович', 'efremov-matvey-l-vovich-11', 1, 0, '/public/src/images/volunteers/68cf4402b62dd2.jpg', 'Представитель попечительского совета', '|1|3|4|');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`);

--
-- Индексы таблицы `forms_type`
--
ALTER TABLE `forms_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ids` (`ids`),
  ADD KEY `type` (`type`);

--
-- Индексы таблицы `medals`
--
ALTER TABLE `medals`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu` (`menu`),
  ADD KEY `menu_footer` (`menu_footer`),
  ADD KEY `parent` (`parent`) USING BTREE;

--
-- Индексы таблицы `seo`
--
ALTER TABLE `seo`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `hash` (`hash`),
  ADD KEY `class` (`class`),
  ADD KEY `login` (`login`),
  ADD KEY `phone` (`phone`);

--
-- Индексы таблицы `users_class`
--
ALTER TABLE `users_class`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_ip`
--
ALTER TABLE `users_ip`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `volunteers`
--
ALTER TABLE `volunteers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `forms`
--
ALTER TABLE `forms`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `forms_type`
--
ALTER TABLE `forms_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `medals`
--
ALTER TABLE `medals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `seo`
--
ALTER TABLE `seo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users_class`
--
ALTER TABLE `users_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users_ip`
--
ALTER TABLE `users_ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `volunteers`
--
ALTER TABLE `volunteers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
