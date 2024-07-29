-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 16 2024 г., 16:25
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
-- База данных: `immovables`
--

-- --------------------------------------------------------

--
-- Структура таблицы `apartments`
--

CREATE TABLE `apartments` (
  `id` int(6) UNSIGNED NOT NULL,
  `apartment_number` int(4) NOT NULL,
  `rooms` int(2) NOT NULL,
  `area` float NOT NULL,
  `floor` int(2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` blob DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `building_type` enum('новостройка','пентхаус','студия','лофт','эксклюзивные','бюджетные') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'новостройка',
  `owner_phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `apartments`
--

INSERT INTO `apartments` (`id`, `apartment_number`, `rooms`, `area`, `floor`, `price`, `city`, `address`, `title`, `description`, `image`, `image_url`, `building_type`, `owner_phone`) VALUES
(1, 101, 3, 85.5, 5, '10000000.00', 'Москва', 'ул. Пушкина, д.10', 'Просторная трехкомнатная квартира', 'Элегантная трехкомнатная квартира в центре города', NULL, 'http://akursowai/uploads/1.jpg', 'новостройка', '213213123'),
(2, 202, 2, 65, 15, '8500000.00', 'Москва', 'пр. Ленина, д.15', 'Уютная двухкомнатная квартира', 'Современная квартира с панорамным видом на город', NULL, 'http://akursowai/uploads/5.jpg', 'студия', '123213123123'),
(3, 305, 1, 45, 3, '6000000.00', 'Москва', 'ул. Гагарина, д.5', 'Однокомнатная квартира в новом доме', 'Светлая и уютная квартира рядом с парком', NULL, 'http://akursowai/uploads/9.jpg', 'бюджетные', '123123131');

-- --------------------------------------------------------

--
-- Структура таблицы `apartment_additional_details`
--

CREATE TABLE `apartment_additional_details` (
  `id` int(6) UNSIGNED NOT NULL,
  `apartment_id` int(6) UNSIGNED NOT NULL,
  `additional_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_images` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `apartment_additional_details`
--

INSERT INTO `apartment_additional_details` (`id`, `apartment_id`, `additional_description`, `additional_images`, `additional_info`) VALUES
(1, 1, 'Квартира в новом жилом комплексе', '', 'Близость к метро и развитая инфраструктура'),
(2, 2, 'Студия с оборудованной кухней', '', 'Охраняемый двор и детская площадка'),
(3, 3, 'Удобное местоположение рядом с парком', '', 'Развитая транспортная доступность');

-- --------------------------------------------------------

--
-- Структура таблицы `apartment_images`
--

CREATE TABLE `apartment_images` (
  `id` int(6) UNSIGNED NOT NULL,
  `apartment_id` int(6) UNSIGNED NOT NULL,
  `image_data` mediumblob DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `apartment_images`
--

INSERT INTO `apartment_images` (`id`, `apartment_id`, `image_data`, `image_url`) VALUES
(1, 1, NULL, 'http://akursowai/uploads/2.jpg'),
(2, 1, NULL, 'http://akursowai/uploads/3.jpg'),
(3, 1, NULL, 'http://akursowai/uploads/4.jpg'),
(4, 2, NULL, 'http://akursowai/uploads/6.jpg'),
(5, 2, NULL, 'http://akursowai/uploads/7.jpg'),
(6, 2, NULL, 'http://akursowai/uploads/8.jpg'),
(7, 3, NULL, 'http://akursowai/uploads/10.jpg'),
(8, 3, NULL, 'http://akursowai/uploads/11.jpg'),
(9, 3, NULL, 'http://akursowai/uploads/12.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `payments_log`
--

CREATE TABLE `payments_log` (
  `id` int(6) UNSIGNED NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `payments_log`
--

INSERT INTO `payments_log` (`id`, `transaction_id`, `service_name`, `amount`, `payment_date`) VALUES
(1, '6560d1be51e9f', 'Услуга', '1500.00', '2023-11-24 16:39:26'),
(20, '6560efa78b1fc', 'Услуга', '1500.00', '2023-11-24 18:47:03'),
(21, '6560f7876b5d2', 'Услуга', '1500.00', '2023-11-24 19:20:39'),
(22, '6560fa94ccc48', 'Услуга', '1500.00', '2023-11-24 19:33:40'),
(23, '6560fbc634c7c', 'Услуга', '1500.00', '2023-11-24 19:38:46'),
(24, '6561bf4474f0d', 'Услуга', '1500.00', '2023-11-25 09:32:52'),
(25, '6561bf44e6ad4', 'Услуга', '1500.00', '2023-11-25 09:32:52'),
(26, '6561bf4509344', 'Услуга', '1500.00', '2023-11-25 09:32:53'),
(27, '6561c1648dac2', 'Услуга', '1500.00', '2023-11-25 09:41:56'),
(28, '6561cd5758675', 'Услуга', '1500.00', '2023-11-25 10:32:55'),
(29, '6561e26cebd16', 'Услуга', '1500.00', '2023-11-25 12:02:52'),
(30, '6561f307933e6', 'Услуга', '1500.00', '2023-11-25 13:13:43'),
(31, '6564ade638d7d', 'Покупка и продажа жилой недвижимости', '100000.00', '2023-11-27 14:55:34'),
(32, '6564ae05e0e66', 'Аренда жилой и коммерческой недвижимости', '5000.00', '2023-11-27 14:56:05'),
(33, '65672d892b8df', 'Покупка и продажа жилой недвижимости', '100000.00', '2023-11-29 12:24:41'),
(34, '65e1a054a08e3', 'Покупка и продажа жилой недвижимости', '100000.00', '2024-03-01 09:31:00'),
(35, '6638931acda15', 'Покупка и продажа жилой недвижимости', '100000.00', '2024-05-06 08:21:46'),
(36, '66389327d497e', 'Покупка и продажа жилой недвижимости', '100000.00', '2024-05-06 08:21:59');

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `service_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `services`
--

INSERT INTO `services` (`id`, `service_name`, `amount`) VALUES
(1, 'Покупка и продажа жилой недвижимости', '100000.00'),
(2, 'Аренда жилой и коммерческой недвижимости', '5000.00'),
(3, 'Консультации по ипотеке и кредитованию', '500.00'),
(4, 'Юридическое сопровождение сделок с недвижимостью', '2000.00');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_date` datetime DEFAULT NULL,
  `role` enum('пользователь','администратор','риэлтор') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `email`, `registration_date`, `role`) VALUES
(1, 'admin', '$2y$10$cY3P5rxTzlK0hGQCgSAw5eUBEtHm0WWyWgUrVNLYXtYVYzX2UbgxK', '111@111', '2023-11-23 19:10:03', 'администратор'),
(2, '', '$2y$10$z/hcKqTeX0HQbrR5M3MvN.fCgyP.p1hajf47tzKy7e3LelsvCZnCa', '', NULL, NULL),
(3, '', '$2y$10$Lay.7izOKCvZGYi1GGCgCeTvagmPynRhTqsoxwgt5V6pSn1bbPaqK', '', NULL, NULL),
(6, '12345', '$2y$10$2MalSJdVGf/A5PQg3AepQutj5BcBlN2Ydk5RtMuMVzS0JJRQhzyNm', '111@111', NULL, NULL),
(7, '111', '$2y$10$sKzDwWs.K3DwpJwXHcyDUen./IGQ.eGV9QrzY7WuDO.w9EL7dx6n2', '111@111', NULL, NULL),
(8, 'admin123', '$2y$10$34rZm.i6HI7WUm5o0svp1eLKuqOsvgpL7ehLin6/wQwnC0E/zefLi', '111@111', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL,
  `avatar_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biography` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interests` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nickname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `apartments`
--
ALTER TABLE `apartments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `apartment_additional_details`
--
ALTER TABLE `apartment_additional_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `apartment_id` (`apartment_id`);

--
-- Индексы таблицы `apartment_images`
--
ALTER TABLE `apartment_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `apartment_id` (`apartment_id`);

--
-- Индексы таблицы `payments_log`
--
ALTER TABLE `payments_log`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `apartments`
--
ALTER TABLE `apartments`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT для таблицы `apartment_additional_details`
--
ALTER TABLE `apartment_additional_details`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT для таблицы `apartment_images`
--
ALTER TABLE `apartment_images`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `payments_log`
--
ALTER TABLE `payments_log`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `apartment_additional_details`
--
ALTER TABLE `apartment_additional_details`
  ADD CONSTRAINT `apartment_additional_details_ibfk_1` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`);

--
-- Ограничения внешнего ключа таблицы `apartment_images`
--
ALTER TABLE `apartment_images`
  ADD CONSTRAINT `apartment_images_ibfk_1` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`);

--
-- Ограничения внешнего ключа таблицы `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `FK_user_profile` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
