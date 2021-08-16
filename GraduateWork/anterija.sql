-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2021 at 11:17 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anterija`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) UNSIGNED NOT NULL,
  `category_name` varchar(45) NOT NULL,
  `category_type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_type`) VALUES
(1, 'Доручак', 'food'),
(2, 'Роштиљ', 'food'),
(3, 'Салата', 'food'),
(4, 'Чорбе', 'food'),
(5, 'Пиво', 'drink'),
(6, 'Виски', 'drink'),
(7, 'Сок', 'drink');

-- --------------------------------------------------------

--
-- Table structure for table `drinks`
--

CREATE TABLE `drinks` (
  `drinks_id` int(11) UNSIGNED NOT NULL,
  `drinks_name` varchar(50) NOT NULL,
  `drinks_quantity` int(11) NOT NULL,
  `drinks_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `drinks_price` varchar(40) NOT NULL,
  `drinks_category_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drinks`
--

INSERT INTO `drinks` (`drinks_id`, `drinks_name`, `drinks_quantity`, `drinks_time`, `drinks_price`, `drinks_category_id`) VALUES
(1, 'Туборг', 82, '2021-05-07 20:39:48', '200', 5),
(2, 'Лав', 48, '2021-05-07 20:39:48', '200', 5),
(3, 'Корона', 10, '2021-05-13 13:13:57', '200', 5),
(4, 'Јелен', 18, '2021-05-13 13:13:57', '200', 5),
(5, 'Black label', 15, '2021-05-13 13:13:57', '150', 6),
(7, 'Chivas', 13, '2021-05-13 13:13:57', '160', 6),
(8, 'Јабука', 11, '2021-05-13 13:13:57', '120', 7),
(9, 'Кока кола', 20, '2021-05-13 13:13:57', '150', 7),
(10, 'Фанта', 20, '2021-05-13 13:13:57', '150', 7),
(50, 'Никшићко', 42, '2021-05-30 15:29:03', '223', 5),
(53, 'Red label', 10, '2021-05-31 13:38:12', '150', 6),
(54, 'Бресква', 16, '2021-06-04 12:33:31', '120', 7),
(55, 'Зајечарско', 23, '2021-06-20 20:27:15', '180', 5);

-- --------------------------------------------------------

--
-- Table structure for table `employee_users`
--

CREATE TABLE `employee_users` (
  `employee_id` int(11) UNSIGNED NOT NULL,
  `employee_name` varchar(30) NOT NULL,
  `employee_lastname` varchar(30) NOT NULL,
  `employee_email` varchar(50) NOT NULL,
  `employee_password` varchar(256) NOT NULL,
  `employee_phone` char(13) NOT NULL,
  `employee_status` enum('Администратор','Конобар','Кувар','Асистент') NOT NULL,
  `employee_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_users`
--

INSERT INTO `employee_users` (`employee_id`, `employee_name`, `employee_lastname`, `employee_email`, `employee_password`, `employee_phone`, `employee_status`, `employee_time`) VALUES
(3, 'Милош', 'Ђорђевић', 'milos@skola.com', '$2y$10$1.XBLyXWV67rYdF./xnpb.hjRpzqk6hA1OGk3Scyul9jXxdam481i', '0638054327', 'Администратор', '2021-05-07 10:32:32'),
(4, 'Неда', 'Костић', 'neda@skola.com', '$2y$10$/G7cjU/VcmpIGRnAwBgOs.HwE4T8wrLb4xD09gZOxMArnM3AK1OgO', '0647853518', 'Асистент', '2021-05-07 10:32:32'),
(5, 'Пера', 'Перић', 'pperic@skola.com', '$2y$10$.VA6WIG2Xiu7Ai5lml5CTOn9GEEEMQMLf2Ubiys/JfN8.uohOc5l.', '24568972145', 'Конобар', '2021-05-25 11:39:41'),
(17, 'Hanibal', 'Lektor', 'lektor@skola.com', '$2y$10$OwrY21c9inUoHgT.QkWyN.psEJMXKLXr1M32zSsGSuNRm3xaR7v3u', '15678955', 'Кувар', '2021-05-27 13:33:33'),
(18, 'Mata', 'Hari', 'matahari@skola.com', '$2y$10$OnRejiaviOfH693TtVSoeuHP31oM1MsZslqBrb7rLZcIufl1nx/t2', '784156', 'Конобар', '2021-05-27 13:34:03'),
(19, 'Gordon ', 'Ramsay', 'gordon@skola.com', '$2y$10$BT5E18qM1hfQ9iwZoxcccugYcfg82oMYtYw6k/VRpyEN.LfO7nQkC', '47456561', 'Кувар', '2021-05-27 13:34:26');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` int(11) UNSIGNED NOT NULL,
  `food_name` varchar(50) NOT NULL,
  `food_quantity` int(11) DEFAULT NULL,
  `food_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `food_price` varchar(40) NOT NULL,
  `food_category_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `food_name`, `food_quantity`, `food_time`, `food_price`, `food_category_id`) VALUES
(1, 'Карађорђева шницла', -6, '2021-05-07 20:43:07', '560', 2),
(2, 'Пуњена пљескавица', 20, '2021-05-07 20:43:07', '650', 2),
(3, 'Пилећи батак', 14, '2021-05-12 10:53:29', '500', 2),
(4, 'Димљена вешалица', 44, '2021-05-12 10:53:29', '600', 2),
(5, 'Јошанички рак', 18, '2021-05-12 10:53:29', '550', 2),
(7, 'Бечка шницла', 29, '2021-05-12 10:53:29', '550', 2),
(8, 'Пуњена димљена вешалица', 15, '2021-05-12 10:53:29', '700', 2),
(10, 'Омлет', 0, '2021-05-12 16:42:59', '150', 1),
(11, 'Омлет са печуркама', 2, '2021-05-12 16:42:59', '200', 1),
(12, 'Пржена јаја', 7, '2021-05-12 16:42:59', '150', 1),
(13, 'Јаја са виршлама', 5, '2021-05-12 16:42:59', '200', 1),
(14, 'Јаја са печуркама и виршлама', 9, '2021-05-12 16:42:59', '250', 1),
(15, 'Прженице', 7, '2021-05-12 16:42:59', '150', 1),
(16, 'Телећа чорба', 6, '2021-05-12 16:47:23', '150', 4),
(17, 'Пилећа супа', 6, '2021-05-12 16:47:23', '150', 4),
(18, 'Рибља чорба', 2, '2021-05-12 16:47:23', '170', 4),
(19, 'Шопска салата', 4, '2021-05-12 16:47:23', '150', 3),
(20, 'Српска салата', 2, '2021-05-12 16:47:23', '150', 3),
(21, 'Купус салата', 22, '2021-05-12 16:47:23', '150', 3),
(22, 'Витаминска салата', 6, '2021-05-12 16:47:23', '160', 3),
(101, 'Роловано бело', 11, '2021-05-30 15:28:18', '546', 2),
(104, 'Ролована џигерица', 24, '2021-05-30 16:56:04', '550', 2),
(105, 'Ћевапи ', NULL, '2021-06-04 12:34:47', '550', 2),
(106, 'Енглески доручак', NULL, '2021-06-20 20:28:46', '230', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `gallery_id` int(11) UNSIGNED NOT NULL,
  `gallery_name` varchar(45) NOT NULL,
  `gallery_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`gallery_id`, `gallery_name`, `gallery_time`) VALUES
(170, '1622215329.6488.jpg', '2021-05-28 15:22:09'),
(171, '1622215333.3176.jpg', '2021-05-28 15:22:13'),
(172, '1622215336.7608.jpg', '2021-05-28 15:22:16'),
(173, '1622215342.2715.jpg', '2021-05-28 15:22:22'),
(174, '1622215346.4545.jpg', '2021-05-28 15:22:26'),
(176, '1622215359.8187.jpg', '2021-05-28 15:22:39'),
(177, '1622215368.2351.jpg', '2021-05-28 15:22:48'),
(178, '1622215373.0337.jpg', '2021-05-28 15:22:53'),
(179, '1622215379.5648.jpg', '2021-05-28 15:22:59'),
(180, '1622215385.0639.jpg', '2021-05-28 15:23:05'),
(181, '1622215392.0927.jpg', '2021-05-28 15:23:12'),
(182, '1622215399.5151.jpg', '2021-05-28 15:23:19'),
(183, '1622215404.8093.jpg', '2021-05-28 15:23:24'),
(184, '1622215483.6013.jpg', '2021-05-28 15:24:43'),
(187, '1622231577.628.jpg', '2021-05-28 19:52:57'),
(188, '1622231580.8944.jpg', '2021-05-28 19:53:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `order_item` varchar(50) NOT NULL,
  `order_price` varchar(50) NOT NULL,
  `order_quantity` int(11) UNSIGNED NOT NULL,
  `order_comment` text DEFAULT NULL,
  `employee_id` int(11) UNSIGNED NOT NULL,
  `section_id` int(3) UNSIGNED NOT NULL,
  `order_active` int(1) UNSIGNED NOT NULL DEFAULT 0,
  `order_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_category` char(4) DEFAULT NULL,
  `order_done` int(1) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_item`, `order_price`, `order_quantity`, `order_comment`, `employee_id`, `section_id`, `order_active`, `order_time`, `order_category`, `order_done`) VALUES
(879, 'Туборг', '200', 3, '', 4, 1, 1, '2021-06-03 20:26:27', 'drin', 0),
(880, 'Карађорђева шницла', '560', 2, '1x bez tatar sosa', 4, 1, 1, '2021-06-03 20:26:41', 'food', 0),
(881, 'Димљена вешалица', '600', 5, '2x dodaj pecurke / ', 4, 1, 1, '2021-06-03 20:26:43', 'food', 0),
(882, 'Chivas', '160', 2, '', 4, 1, 1, '2021-06-03 20:27:01', 'drin', 0),
(883, 'Лав', '200', 3, '', 4, 1, 1, '2021-06-03 20:27:12', 'drin', 0),
(884, 'Корона', '200', 3, '', 4, 1, 1, '2021-06-03 20:27:14', 'drin', 0),
(888, 'Пилећи батак', '500', 5, '1x bez soli / 2x dodaj kajmak', 4, 1, 1, '2021-06-03 20:29:06', 'food', 1),
(889, 'Пилећи батак', '500', 4, '1x normalno / 3x dodaj pecurke', 4, 1, 1, '2021-06-03 20:30:24', 'food', 1),
(890, 'Туборг', '200', 1, '', 4, 1, 1, '2021-06-03 20:31:36', 'drin', 0),
(891, 'Пилећи батак', '500', 2, '2x decija porcija', 4, 1, 1, '2021-06-03 20:53:52', 'food', 1),
(897, 'Карађорђева шницла', '560', 2, '', 4, 3, 1, '2021-06-03 20:57:19', 'food', 0),
(898, 'Лав', '200', 2, '', 4, 3, 1, '2021-06-03 20:57:21', 'drin', 0),
(899, 'Туборг', '200', 1, '', 4, 3, 1, '2021-06-03 20:57:23', 'drin', 0),
(900, 'Никшићко', '223', 4, 'undefined / undefined / undefined / ', 4, 3, 1, '2021-06-03 20:57:26', 'drin', 0),
(901, 'Витаминска салата', '160', 1, 'bez kupusa', 4, 3, 1, '2021-06-03 20:57:39', 'food', 0),
(902, 'Купус салата', '150', 2, '', 4, 3, 1, '2021-06-03 20:57:45', 'food', 1),
(903, 'Телећа чорба', '150', 2, '', 4, 3, 1, '2021-06-03 20:57:47', 'food', 0),
(907, 'Јелен', '200', 3, '', 4, 4, 1, '2021-06-03 21:11:16', 'drin', 0),
(909, 'Ролована џигерица', '550', 5, '3x decija porcija / 1x bez slanine samo dzigerica', 4, 4, 1, '2021-06-03 21:11:32', 'food', 1),
(910, 'Јошанички рак', '550', 2, '', 4, 4, 1, '2021-06-03 21:11:33', 'food', 0),
(913, 'Српска салата', '150', 2, '', 3, 2, 1, '2021-06-16 09:24:37', 'food', 0),
(914, 'Купус салата', '150', 1, '', 3, 2, 1, '2021-06-16 09:24:38', 'food', 0),
(915, 'Витаминска салата', '160', 2, '', 3, 2, 1, '2021-06-16 09:24:39', 'food', 0),
(916, 'Рибља чорба', '170', 1, 'Mala porcija', 3, 2, 1, '2021-06-16 09:24:52', 'food', 0),
(919, 'Туборг', '200', 2, '', 3, 2, 1, '2021-06-16 09:24:58', 'drin', 0),
(921, 'Chivas', '160', 1, '', 3, 2, 1, '2021-06-16 10:17:08', 'drin', 0),
(922, 'Black label', '150', 1, '', 3, 2, 1, '2021-06-16 10:17:09', 'drin', 0),
(923, 'Бечка шницла', '550', 1, '', 3, 2, 1, '2021-06-16 10:17:10', 'food', 0),
(926, 'Туборг', '200', 3, '', 3, 2, 1, '2021-06-16 10:17:16', 'drin', 0),
(927, 'Туборг', '200', 4, '', 3, 3, 1, '2021-06-16 10:17:42', 'drin', 0),
(1020, 'Димљена вешалица', '600', 2, '', 3, 4, 0, '2021-06-24 20:34:35', 'food', 1),
(1021, 'Туборг', '200', 2, '', 3, 4, 0, '2021-06-24 20:34:48', 'drin', 0),
(1022, 'Никшићко', '223', 1, '', 3, 4, 0, '2021-06-24 20:34:48', 'drin', 0),
(1023, 'Бресква', '120', 2, '', 3, 4, 0, '2021-06-24 20:34:50', 'drin', 0),
(1024, 'Бечка шницла', '550', 4, '1x tatar sos sa strane / 1x bez majoneza / 1x bez majoneza', 3, 4, 0, '2021-06-24 20:35:38', 'food', 0),
(1026, 'Јаја са печуркама и виршлама', '250', 2, '', 3, 1, 1, '2021-06-24 20:36:45', 'food', 0),
(1030, 'Никшићко', '223', 3, '', 3, 1, 1, '2021-06-27 19:36:46', 'drin', 0),
(1031, 'Ћевапи ', '550', 2, '1x sa kajmakom', 3, 3, 1, '2021-06-28 14:57:09', 'food', 0),
(1032, 'Роловано бело', '546', 1, '', 3, 3, 1, '2021-06-30 17:52:39', 'food', 0),
(1033, 'Јелен', '200', 2, '', 3, 3, 0, '2021-06-30 17:52:59', 'drin', 0),
(1035, 'Лав', '200', 1, '', 3, 3, 0, '2021-06-30 17:53:11', 'drin', 0),
(1037, 'Роловано бело', '546', 1, '', 3, 3, 0, '2021-06-30 17:53:13', 'food', 0),
(1038, 'Карађорђева шницла', '560', 2, '1xbez majoneza / ', 3, 3, 0, '2021-06-30 17:53:15', 'food', 0),
(1039, 'Ћевапи ', '550', 2, '', 3, 2, 1, '2021-07-01 08:22:03', 'food', 0),
(1043, 'Карађорђева шницла', '560', 2, '2x bez pomfrita / ', 3, 1, 1, '2021-07-14 11:40:19', 'food', 0),
(1044, 'Ролована џигерица', '550', 3, '', 3, 1, 1, '2021-07-14 11:42:16', 'food', 0),
(1055, 'Никшићко', '223', 3, '', 3, 1, 1, '2021-07-14 11:57:54', 'drin', 0),
(1056, 'Зајечарско', '180', 2, '', 3, 1, 1, '2021-07-14 11:57:55', 'drin', 0),
(1057, 'Пуњена димљена вешалица', '700', 1, '', 3, 1, 1, '2021-07-14 11:57:56', 'food', 0),
(1059, 'Јелен', '200', 4, '', 3, 1, 1, '2021-07-14 11:58:31', 'drin', 0),
(1060, 'Корона', '200', 2, '', 3, 1, 1, '2021-07-14 11:58:31', 'drin', 0),
(1061, 'Пуњена димљена вешалица', '700', 1, '', 3, 2, 1, '2021-07-14 11:59:08', 'food', 0),
(1062, 'Лав', '200', 2, '', 3, 2, 1, '2021-07-14 11:59:10', 'drin', 0),
(1064, 'Black label', '150', 2, '', 3, 2, 1, '2021-07-14 11:59:29', 'drin', 0),
(1066, 'Карађорђева шницла', '560', 2, '1x limun sa strane', 3, 4, 0, '2021-07-14 12:04:49', 'food', 0),
(1067, 'Карађорђева шницла', '560', 4, '', 3, 1, 1, '2021-07-14 12:07:55', 'food', 0),
(1075, 'Туборг', '200', 3, '', 3, 2, 1, '2021-07-14 12:20:42', 'drin', 0),
(1076, 'Зајечарско', '180', 1, '', 3, 2, 1, '2021-07-14 12:20:44', 'drin', 0),
(1077, 'Пуњена димљена вешалица', '700', 1, '', 3, 1, 1, '2021-07-19 12:02:13', 'food', 0),
(1078, 'Ћевапи ', '550', 5, '', 3, 1, 1, '2021-07-19 12:02:14', 'food', 0),
(1079, 'Никшићко', '223', 3, '', 3, 1, 1, '2021-07-19 12:02:15', 'drin', 0),
(1080, 'Туборг', '200', 5, '', 3, 1, 1, '2021-07-19 12:02:25', 'drin', 0),
(1087, 'Пуњена димљена вешалица', '700', 2, '', 3, 1, 1, '2021-07-19 12:57:25', 'food', 0),
(1090, 'Ћевапи ', '550', 2, '', 3, 1, 1, '2021-07-19 12:58:31', 'food', 0),
(1097, 'Туборг', '200', 1, '', 3, 2, 1, '2021-07-19 13:01:04', 'drin', 0),
(1098, 'Никшићко', '223', 1, '', 3, 2, 1, '2021-07-19 13:01:05', 'drin', 0),
(1099, 'Пуњена димљена вешалица', '700', 3, '', 3, 2, 1, '2021-07-19 13:01:18', 'food', 0),
(1102, 'Никшићко', '223', 3, '', 3, 2, 1, '2021-07-19 13:01:35', 'drin', 0),
(1103, 'Туборг', '200', 1, '', 3, 2, 1, '2021-07-19 13:01:37', 'drin', 0),
(1104, 'Пуњена димљена вешалица', '700', 1, '', 3, 2, 1, '2021-07-19 13:01:39', 'food', 0),
(1108, 'Никшићко', '223', 2, '', 3, 2, 0, '2021-07-19 13:06:30', 'drin', 0),
(1109, 'Карађорђева шницла', '560', 1, '', 3, 2, 0, '2021-07-19 13:06:35', 'food', 0),
(1110, 'Бечка шницла', '550', 1, '', 3, 2, 0, '2021-07-19 13:06:36', 'food', 0),
(1111, 'Black label', '150', 2, '', 3, 2, 0, '2021-07-19 13:06:37', 'drin', 0),
(1112, 'Туборг', '200', 3, '', 3, 2, 0, '2021-07-19 13:06:42', 'drin', 0),
(1217, 'Пуњена димљена вешалица', '700', 1, '', 3, 1, 1, '2021-07-19 14:14:41', 'food', 0),
(1226, 'Ћевапи ', '550', 1, 'sa lukom 1x', 3, 1, 1, '2021-07-19 16:30:20', 'food', 1),
(1227, 'Никшићко', '223', 1, '', 3, 1, 1, '2021-07-19 16:30:22', 'drin', 0),
(1228, 'Шопска салата', '150', 1, '', 3, 1, 1, '2021-07-19 16:30:35', 'food', 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `orders_view`
-- (See below for the actual view)
--
CREATE TABLE `orders_view` (
`order_id` int(10) unsigned
,`order_item` varchar(50)
,`order_price` varchar(50)
,`order_quantity` int(11) unsigned
,`order_comment` text
,`order_active` int(1) unsigned
,`order_time` timestamp
,`order_category` char(4)
,`order_done` int(1) unsigned
,`employee_id` int(11) unsigned
,`section_id` int(3) unsigned
,`employee_name` varchar(30)
,`section_name` varchar(30)
);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` int(11) UNSIGNED NOT NULL,
  `reservation_name` varchar(30) NOT NULL,
  `reservation_lastname` varchar(30) NOT NULL,
  `reservation_email` varchar(30) NOT NULL,
  `reservation_phone` char(11) NOT NULL,
  `reservation_num_customer` int(3) UNSIGNED NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_time` time NOT NULL,
  `reservation_note` varchar(255) DEFAULT NULL,
  `reservation_confirm` int(1) NOT NULL DEFAULT 0,
  `reservation_delete` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `reservation_name`, `reservation_lastname`, `reservation_email`, `reservation_phone`, `reservation_num_customer`, `reservation_date`, `reservation_time`, `reservation_note`, `reservation_confirm`, `reservation_delete`) VALUES
(4, 'Pera', 'Peric', 'pperic@skola.com', '4554879', 1, '2021-06-02', '12:34:00', 'Perkan dolazi sve da bude spremno', 1, 0),
(5, 'Luis ', 'Figo', 'figo@portugal.com', '4875', 3, '2021-06-18', '14:00:00', 'Donosi loptu', 0, 0),
(6, 'Kemal', 'Ataturk', 'kemal@turska.com', '78754', 4, '2021-06-25', '12:03:00', '', 0, 0),
(7, 'Цар Душан Силни', 'Немањић', 'dusan@silni.skola.com', '011025468', 45, '2021-06-21', '17:00:00', 'Доводим своје витезове!!!', 0, 0),
(8, 'Marija', 'Marijanovic', 'marija@skola.com', '01135647872', 9, '2021-08-29', '12:30:00', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `section_id` int(3) UNSIGNED NOT NULL,
  `section_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `section_name`) VALUES
(1, 'Сто бр. 1'),
(2, 'Сто бр. 2'),
(3, 'Сто бр. 3'),
(4, 'Сто бр. 4');

-- --------------------------------------------------------

--
-- Structure for view `orders_view`
--
DROP TABLE IF EXISTS `orders_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `orders_view`  AS SELECT `orders`.`order_id` AS `order_id`, `orders`.`order_item` AS `order_item`, `orders`.`order_price` AS `order_price`, `orders`.`order_quantity` AS `order_quantity`, `orders`.`order_comment` AS `order_comment`, `orders`.`order_active` AS `order_active`, `orders`.`order_time` AS `order_time`, `orders`.`order_category` AS `order_category`, `orders`.`order_done` AS `order_done`, `orders`.`employee_id` AS `employee_id`, `orders`.`section_id` AS `section_id`, `employee_users`.`employee_name` AS `employee_name`, `section`.`section_name` AS `section_name` FROM ((`orders` join `employee_users` on(`orders`.`employee_id` = `employee_users`.`employee_id`)) join `section` on(`orders`.`section_id` = `section`.`section_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `drinks`
--
ALTER TABLE `drinks`
  ADD PRIMARY KEY (`drinks_id`);

--
-- Indexes for table `employee_users`
--
ALTER TABLE `employee_users`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `employe_email` (`employee_email`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`gallery_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`section_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `drinks`
--
ALTER TABLE `drinks`
  MODIFY `drinks_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `employee_users`
--
ALTER TABLE `employee_users`
  MODIFY `employee_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `gallery_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1229;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `section_id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
