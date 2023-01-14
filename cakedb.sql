-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 08, 2023 at 06:04 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cakedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(512) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `password` varchar(512) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniqueUserName` (`userName`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `userName`, `password`) VALUES
(1, 'Baraa Nairat', 'baraa@gmail.com', 'test123');

-- --------------------------------------------------------

--
-- Table structure for table `decors`
--

DROP TABLE IF EXISTS `decors`;
CREATE TABLE IF NOT EXISTS `decors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `decorName` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `decors`
--

INSERT INTO `decors` (`id`, `decorName`) VALUES
(1, 'Image'),
(2, 'Sample');

-- --------------------------------------------------------

--
-- Table structure for table `flavor`
--

DROP TABLE IF EXISTS `flavor`;
CREATE TABLE IF NOT EXISTS `flavor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `flavorName` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `flavor`
--

INSERT INTO `flavor` (`id`, `flavorName`) VALUES
(1, 'Choclate'),
(2, 'Vanilla');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerName` varchar(512) NOT NULL,
  `customerPhone` varchar(15) NOT NULL,
  `deliveryDate` datetime NOT NULL,
  `numberOfPieces` int(11) NOT NULL,
  `flavorId` int(11) NOT NULL,
  `decorId` int(11) NOT NULL,
  `price` float NOT NULL,
  `statusId` int(11) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `orders_flafor_flavorId_index` (`flavorId`),
  KEY `orders_decors_decorId_index` (`decorId`),
  KEY `orders_statuses_statusId_index` (`statusId`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customerName`, `customerPhone`, `deliveryDate`, `numberOfPieces`, `flavorId`, `decorId`, `price`, `statusId`, `createdDate`) VALUES
(1, 'Baraa', '0595976431', '2023-01-03 17:42:58', 7, 1, 1, 50, 1, '2023-01-03 19:43:16'),
(5, 'Aseel', '0597649731', '2023-01-03 17:43:18', 5, 2, 2, 40, 1, '2023-01-03 19:43:33'),
(6, 'Haya', '0597827193', '2023-01-03 17:44:02', 6, 2, 1, 50, 3, '2023-01-03 19:44:47'),
(7, 'Ayat', '0597396220', '2023-01-03 17:44:02', 3, 1, 2, 38, 3, '2023-01-03 19:44:47'),
(8, 'Ahmad', '0568586947', '2023-01-03 17:44:57', 8, 1, 1, 40, 4, '2023-01-03 19:46:13'),
(9, 'Yousef', '0599140150', '2023-01-03 17:44:57', 4, 2, 1, 40, 4, '2023-01-03 19:46:13'),
(10, 'Sham', '0599123456', '2023-01-03 17:46:32', 5, 1, 1, 20, 2, '2023-01-03 19:47:36'),
(11, 'Ibrahem', '0598768721', '2023-01-03 17:46:32', 6, 1, 2, 60, 2, '2023-01-03 19:47:36'),
(12, 'Nezar', '0597120120', '2023-01-03 17:47:48', 10, 1, 1, 75, 5, '2023-01-03 19:49:32'),
(13, 'Mohammad', '0568160160', '2023-01-03 17:47:48', 8, 1, 2, 55, 5, '2023-01-03 19:49:32'),
(14, 'Haya Kareem', '0597160160', '2023-01-03 23:53:00', 3, 1, 2, 15.22, 2, '2023-01-03 23:54:01'),
(15, 'Mera', '0568909090', '2023-01-05 12:20:00', 4, 2, 2, 13.64, 1, '2023-01-04 00:17:11'),
(16, 'Majed', '0594180180', '2023-01-06 12:21:00', 6, 2, 1, 23.12, 3, '2023-01-04 00:22:06'),
(17, 'Zena', '0599123456', '2023-01-24 12:43:00', 8, 2, 1, 22.5, 1, '2023-01-04 00:40:36'),
(18, 'Baraa', '0599123457', '2023-01-06 11:56:00', 14, 1, 1, 20, 2, '2023-01-04 23:54:33'),
(19, 'Zanzon', '0599123456', '2023-01-24 12:43:00', 8, 2, 1, 22.5, 1, '2023-01-05 02:30:45');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

DROP TABLE IF EXISTS `statuses`;
CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statusName` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `statusName`) VALUES
(1, 'Waiting'),
(2, 'Cooking'),
(3, 'Done'),
(4, 'Delivered'),
(5, 'Canceled');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`flavorId`) REFERENCES `flavor` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`decorId`) REFERENCES `decors` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`statusId`) REFERENCES `statuses` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
