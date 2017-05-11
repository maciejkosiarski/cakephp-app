-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 04 Lis 2016, 14:46
-- Wersja serwera: 10.1.13-MariaDB
-- Wersja PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `menu`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `components`
--

CREATE TABLE `components` (
  `id` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `components`
--

INSERT INTO `components` (`id`, `dish_id`, `ingredient_id`) VALUES
(17, 21, 20),
(19, 23, 20),
(20, 24, 22),
(21, 24, 26),
(22, 25, 21),
(23, 25, 22),
(24, 25, 23),
(25, 26, 27),
(26, 27, 20),
(27, 27, 21),
(28, 27, 22);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `days`
--

CREATE TABLE `days` (
  `id` int(11) NOT NULL,
  `week_id` int(11) NOT NULL,
  `daytime_id` int(1) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `days`
--

INSERT INTO `days` (`id`, `week_id`, `daytime_id`, `created`) VALUES
(46, 7, 1, '2016-09-29 12:05:14'),
(49, 6, 2, '2016-09-30 11:25:02'),
(50, 6, 3, '2016-09-30 11:25:12'),
(51, 6, 4, '2016-11-03 14:23:13'),
(52, 6, 5, '2016-11-03 14:42:12'),
(54, 6, 1, '2016-11-03 14:49:24');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `daytimes`
--

CREATE TABLE `daytimes` (
  `id` int(1) NOT NULL,
  `name` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `daytimes`
--

INSERT INTO `daytimes` (`id`, `name`) VALUES
(1, 'Monday'),
(2, 'Tuesday'),
(3, 'Wednsday'),
(4, 'Thursday'),
(5, 'Friday'),
(6, 'Saturday'),
(7, 'Sunday');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dishes`
--

CREATE TABLE `dishes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `notes` text NOT NULL,
  `type` int(1) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dishes_types`
--

CREATE TABLE `dishes_types` (
  `id` int(1) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `dishes_types`
--

INSERT INTO `dishes_types` (`id`, `name`) VALUES
(1, 'snack'),
(2, 'soup'),
(3, 'main dish'),
(4, 'salad'),
(5, 'desert');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ingredients_types`
--

CREATE TABLE `ingredients_types` (
  `id` int(1) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `ingredients_types`
--

INSERT INTO `ingredients_types` (`id`, `name`) VALUES
(1, 'cereal products'),
(2, 'milk product'),
(3, 'meat'),
(4, 'fish'),
(5, 'vegetables'),
(6, 'fruits'),
(7, 'grain legumes'),
(8, 'sweets');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `meals`
--

CREATE TABLE `meals` (
  `id` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `meals_types`
--

CREATE TABLE `meals_types` (
  `id` int(1) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `meals_types`
--

INSERT INTO `meals_types` (`id`, `name`) VALUES
(1, 'breakfast'),
(2, 'second breakfast'),
(3, 'dinner'),
(4, '4th meal'),
(5, 'supper');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `roles_types`
--

CREATE TABLE `roles_types` (
  `id` int(1) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `roles_types`
--

INSERT INTO `roles_types` (`id`, `name`) VALUES
(1, 'user'),
(2, 'admin'),
(3, 'superadmin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sessions`
--

CREATE TABLE `sessions` (
  `id` char(40) NOT NULL,
  `data` text,
  `expires` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(80) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `hash` varchar(32) NOT NULL,
  `role` int(1) NOT NULL DEFAULT '1',
  `verify` tinyint(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `email`, `first_name`, `last_name`, `password`, `hash`, `role`, `verify`, `created`, `modified`) VALUES
(1, 'superadmin@email.com', NULL, NULL, '$2y$10$oKIjp6ZHDUWchyobjRbuWOj3a/uoovoaCcbxx6YlDZsFA02yxZ8t2', '$2y$10$L8f9oMdfv9FJGSpfDd.YJOwtq', 3, NULL, NULL, NULL),
(2, 'admin@email.com', NULL, NULL, '$2y$10$oKIjp6ZHDUWchyobjRbuWOj3a/uoovoaCcbxx6YlDZsFA02yxZ8t2', '$2y$10$4b391zYfx2TA3TrjRVeSxug7y', 2, NULL, NULL, NULL),
(3, 'user@email.com', NULL, NULL, '$2y$10$oKIjp6ZHDUWchyobjRbuWOj3a/uoovoaCcbxx6YlDZsFA02yxZ8t2', '9212568d7115a4cedeb67365fb1c284e', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `weeks`
--

CREATE TABLE `weeks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `thumbnail` tinyint(30) NOT NULL DEFAULT '1',
  `active` tinyint(1) DEFAULT '1',
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `components`
--
ALTER TABLE `components`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daytimes`
--
ALTER TABLE `daytimes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `dishes_types`
--
ALTER TABLE `dishes_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingredients_types`
--
ALTER TABLE `ingredients_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `meals_types`
--
ALTER TABLE `meals_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_types`
--
ALTER TABLE `roles_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weeks`
--
ALTER TABLE `weeks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `components`
--
ALTER TABLE `components`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT dla tabeli `days`
--
ALTER TABLE `days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT dla tabeli `daytimes`
--
ALTER TABLE `daytimes`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT dla tabeli `dishes`
--
ALTER TABLE `dishes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT dla tabeli `dishes_types`
--
ALTER TABLE `dishes_types`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT dla tabeli `ingredients_types`
--
ALTER TABLE `ingredients_types`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `meals`
--
ALTER TABLE `meals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT dla tabeli `meals_types`
--
ALTER TABLE `meals_types`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `roles_types`
--
ALTER TABLE `roles_types`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `weeks`
--
ALTER TABLE `weeks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
