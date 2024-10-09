-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 08, 2024 at 11:32 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_bd`
--

-- --------------------------------------------------------

--
-- Table structure for table `busket`
--

CREATE TABLE `busket` (
  `id` int NOT NULL,
  `userId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `busket`
--

INSERT INTO `busket` (`id`, `userId`) VALUES
(1, 1),
(2, 2),
(3, 7),
(4, 8),
(5, 9),
(6, 11),
(7, 12),
(8, 12),
(9, 14);

-- --------------------------------------------------------

--
-- Table structure for table `busketToCloth`
--

CREATE TABLE `busketToCloth` (
  `id` int NOT NULL,
  `busketId` int NOT NULL,
  `clothId` int NOT NULL,
  `count` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `busketToCloth`
--

INSERT INTO `busketToCloth` (`id`, `busketId`, `clothId`, `count`) VALUES
(1, 1, 2, 1),
(20, 2, 3, 1),
(24, 1, 1, 1),
(37, 5, 1, 1),
(39, 5, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cloth`
--

CREATE TABLE `cloth` (
  `id` int NOT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `header` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` int NOT NULL,
  `imgSrc` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'static/default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cloth`
--

INSERT INTO `cloth` (`id`, `type`, `size`, `color`, `brand`, `header`, `description`, `cost`, `imgSrc`) VALUES
(1, 'Футболка', 's', 'white', 'zara', 'Футболка Zara белый цвет, оригинал мамой клянусь', 'Описание футболки Zara белый цвет, оригинал мамой клянусь', 10000, 'static/default.jpg'),
(2, 'Футболка', 'l', 'red', 'gucci', 'Футболка gucci красный цвет, оригинал мамой клянусь', 'Описание Футболки gucci красный цвет, оригинал мамой клянусь', 50000, 'static/default.jpg'),
(3, 'Штаны', 's', 'white', 'zara', 'Штаны Zara белый цвет, оригинал мамой клянусь', 'Описание Штанов Zara белый цвет, оригинал мамой клянусь', 5000, 'static/default.jpg'),
(6, '123', '123', '123', '123', '123', '123', 123, 'static/cat-buisnessman.png');

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `id` int NOT NULL,
  `userId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favorite`
--

INSERT INTO `favorite` (`id`, `userId`) VALUES
(1, 1),
(2, 2),
(3, 7),
(4, 8),
(5, 9),
(6, 11),
(7, 12),
(8, 12),
(9, 14);

-- --------------------------------------------------------

--
-- Table structure for table `favoriteToCloth`
--

CREATE TABLE `favoriteToCloth` (
  `id` int NOT NULL,
  `favoriteId` int NOT NULL,
  `clothId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favoriteToCloth`
--

INSERT INTO `favoriteToCloth` (`id`, `favoriteId`, `clothId`) VALUES
(1, 1, 3),
(2, 1, 1),
(3, 2, 3),
(4, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `userId` int NOT NULL,
  `adress` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payOffline` tinyint(1) NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `userId`, `adress`, `payOffline`, `completed`) VALUES
(22, 9, 'asdfasdf', 1, 1),
(23, 9, '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ordersToCloth`
--

CREATE TABLE `ordersToCloth` (
  `id` int NOT NULL,
  `orderId` int NOT NULL,
  `clothId` int NOT NULL,
  `count` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ordersToCloth`
--

INSERT INTO `ordersToCloth` (`id`, `orderId`, `clothId`, `count`) VALUES
(27, 22, 1, 10),
(28, 22, 3, 14),
(29, 23, 1, 1),
(30, 23, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `pass` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `role`, `pass`, `name`, `phone`, `email`) VALUES
(7, 'asdfasdf', 'admin', 'a95c530a7af5f492a74499e70578d150', 'asdfasdfasdf', 'asdfasdfasdf', 'asdfasdfasdf'),
(8, '123', 'user', '202cb962ac59075b964b07152d234b70', '123', '123', '123'),
(9, 'qwerty', 'admin', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'qwerty', 'qwerty', 'qwerty'),
(10, 'login', 'user', 'password', 'имя', '8800', '1@mail.ru'),
(11, 'asdgasdgaga', 'user', '28f4be5daa2961fdc77625a71cda640b', 'asdgasdgaga', 'asdgasdgaga', 'asdgasdgaga'),
(12, 'asdfasdfasdf', 'user', '6a204bd89f3c8348afd5c77c717a097a', 'asdfasdf', 'asdfasdf', 'asdfasdf'),
(13, 'asdfasdfasdf', 'user', '6a204bd89f3c8348afd5c77c717a097a', 'asdfasdf', 'asdfasdf', 'asdfasdf'),
(14, 'a[p[pwlg[pawerlgap[erlg[paelrg', 'user', '5fd455df27d578f90566139d5d64dd8b', 'a[p[pwlg[pawerlgap[erlg[paelrg', 'a[p[pwlg[pawerlgap[erlg[paelrg', 'a[p[pwlg[pawerlgap[erlg[paelrg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `busket`
--
ALTER TABLE `busket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `busketToCloth`
--
ALTER TABLE `busketToCloth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cloth`
--
ALTER TABLE `cloth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favoriteToCloth`
--
ALTER TABLE `favoriteToCloth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordersToCloth`
--
ALTER TABLE `ordersToCloth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `busket`
--
ALTER TABLE `busket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `busketToCloth`
--
ALTER TABLE `busketToCloth`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `cloth`
--
ALTER TABLE `cloth`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `favoriteToCloth`
--
ALTER TABLE `favoriteToCloth`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `ordersToCloth`
--
ALTER TABLE `ordersToCloth`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
