-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 03, 2022 at 03:34 PM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webtech`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
CREATE TABLE IF NOT EXISTS `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(256) DEFAULT NULL,
  `lastname` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `firstname`, `lastname`) VALUES
(1, 'julian', 'assange'),
(2, 'yo mom', 'truly'),
(3, 'your\'s', 'truly'),
(4, 'your\'s', 'truly'),
(5, 'your\'s', 'truly'),
(6, 'your\'s', 'truly');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(400) NOT NULL,
  `title` varchar(300) NOT NULL,
  `publisher` varchar(500) DEFAULT NULL,
  `isbn` varchar(50) DEFAULT NULL,
  `category` varchar(500) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `currency` varchar(4) DEFAULT NULL,
  `stock_count` int(11) DEFAULT NULL,
  `description` varchar(999) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Book_Id_uindex` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `author`, `title`, `publisher`, `isbn`, `category`, `price`, `currency`, `stock_count`, `description`) VALUES
(23, 'some guys', 'some holy shite', 'some religious orgnisation', 'not 666', '8', 12.99, 'gbp', 1, NULL),
(24, 'some guys', 'some holy shite', 'some religious orgnisation', 'not 666', '8', 12.99, 'gbp', 1, NULL),
(25, 'some guys', 'some holy shite', 'some religious orgnisation', 'not 666', '8', 12.99, 'gbp', 1, NULL),
(26, 'some guys', 'some holy shite', 'some religious orgnisation', 'not 666', '8', 12.99, 'gbp', 1, NULL),
(27, 'some guys', 'some holy shite', 'some religious orgnisation', 'not 666', '8', 12.99, 'gbp', 1, NULL),
(28, 'some guys', 'some holy shite', 'some religious orgnisation', 'not 666', '1', 12.99, 'gbp', 1, NULL),
(29, 'some guys', 'some holy shite', 'some religious orgnisation', 'not 666', '3', 12.99, 'gbp', 1, NULL),
(30, '', '', '', '', '', 0, '', 3, NULL),
(31, 'some guys', 'some holy shite', 'some religious orgnisation', 'not 666', '1', 12.99, 'gbp', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) NOT NULL,
  `parent` varchar(256) DEFAULT NULL,
  `display_homepage` tinyint(1) NOT NULL DEFAULT '0',
  `placeholder` varchar(999) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_id_uindex` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `parent`, `display_homepage`, `placeholder`, `created_at`, `updated_at`) VALUES
(8, 'school books', 'null', 1, 'https://images.pexels.com/photos/374918/pexels-photo-374918.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', NULL, '2022-05-01'),
(9, 'english', '8', 0, '', NULL, '2022-05-01'),
(10, 'maths', '8', 0, NULL, NULL, '2022-05-01'),
(11, 'psychology', '', 0, NULL, NULL, NULL),
(12, 'business', '', 0, NULL, NULL, NULL),
(13, 'Fiction', NULL, 1, 'https://images.pexels.com/photos/1314584/pexels-photo-1314584.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', '2022-05-03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(34) DEFAULT NULL,
  `items` varchar(999) DEFAULT NULL,
  `shipping_address` varchar(999) DEFAULT NULL,
  `total` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `phone` varchar(256) NOT NULL,
  `country_code` varchar(4) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `password` varchar(256) NOT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`phone`),
  UNIQUE KEY `user_email_uindex` (`phone`),
  UNIQUE KEY `user_email_uindex_2` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
