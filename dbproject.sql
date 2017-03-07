-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 08, 2015 at 01:19 PM
-- Server version: 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customers`
--

CREATE TABLE IF NOT EXISTS `tbl_customers` (
  `userid` int(11) NOT NULL,
  `fname` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `lname` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `address1` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `address2` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `city` varchar(32) COLLATE utf8mb4_bin NOT NULL,
  `state` varchar(2) COLLATE utf8mb4_bin NOT NULL,
  `zip` int(10) NOT NULL,
  `email` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `phone` varchar(14) COLLATE utf8mb4_bin NOT NULL,
  `dateadded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastaccess` datetime NOT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `tbl_customers`
--

INSERT INTO `tbl_customers` (`userid`, `fname`, `lname`, `address1`, `address2`, `city`, `state`, `zip`, `email`, `phone`, `dateadded`, `lastaccess`) VALUES
(28, 'Casey', 'Jones', '123 Cricket Circle', '', 'New York', 'Ny', 12312, 'casey.jones@test.com', '1231234455', '2015-12-08 08:14:26', '0000-00-00 00:00:00'),
(33, 'Usagi', 'Yojimbo', '111 Sakura Way', '', 'Tokyo', 'Ja', 11111, 'usagi@yojimbo.com', '123456789', '2015-12-08 08:04:50', '0000-00-00 00:00:00'),
(35, 'Ian', 'Malcom', '467 Isla Nublar Pkwy', '', 'San Diego', 'Ca', 94578, 'ian.malcom@test.com', '8887779999', '2015-12-08 12:55:11', '2015-12-08 12:55:11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE IF NOT EXISTS `tbl_orders` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `customerid` int(4) NOT NULL,
  `serviceid` int(4) NOT NULL,
  `photographerid1` int(4) NOT NULL,
  `photographerid2` int(4) NOT NULL,
  `paymenttype` varchar(16) COLLATE utf8mb4_bin NOT NULL,
  `cinitials` varchar(4) COLLATE utf8mb4_bin NOT NULL,
  `pinitials` varchar(4) COLLATE utf8mb4_bin NOT NULL,
  `status` int(1) NOT NULL,
  `quantity` int(4) NOT NULL,
  `price` float NOT NULL,
  `override` float NOT NULL,
  `comments` text COLLATE utf8mb4_bin NOT NULL,
  `orderdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `duedate` date NOT NULL,
  `lastupdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin COMMENT='contains order information' AUTO_INCREMENT=19 ;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`id`, `customerid`, `serviceid`, `photographerid1`, `photographerid2`, `paymenttype`, `cinitials`, `pinitials`, `status`, `quantity`, `price`, `override`, `comments`, `orderdate`, `duedate`, `lastupdated`) VALUES
(3, 1, 2, 1, 0, '', '', '0', 0, 2, 80, 0, 'Yuletide!', '2015-12-07 04:25:35', '2015-12-25', '0000-00-00 00:00:00'),
(4, 1, 2, 1, 0, '', '', '0', 1, 4, 160, 0, 'Test order 5', '2015-12-07 04:26:28', '2015-12-15', '0000-00-00 00:00:00'),
(5, 1, 2, 1, 0, '', '', '0', 1, 4, 160, 0, 'Test order 5', '2015-12-07 04:28:01', '2015-12-15', '0000-00-00 00:00:00'),
(6, 1, 2, 1, 0, '', '', '0', 1, 4, 160, 0, 'Test order 5', '2015-12-07 04:28:03', '2015-12-15', '0000-00-00 00:00:00'),
(7, 1, 2, 1, 0, '', '', '0', 1, 5, 200, 0, 'Yuletide Pt 2', '2015-12-07 04:28:57', '2015-12-23', '0000-00-00 00:00:00'),
(8, 1, 2, 1, 0, '', '', '0', 1, 8, 320, 0, 'Please work', '2015-12-07 04:31:53', '2015-12-08', '0000-00-00 00:00:00'),
(9, 1, 2, 1, 0, '', '', '0', 1, 6, 240, 0, 'Test order 2 billion', '2015-12-07 04:32:29', '2015-12-22', '0000-00-00 00:00:00'),
(10, 1, 2, 1, 0, '', '', '0', 1, 5, 200, 0, 'For the love of all that is living work', '2015-12-07 04:33:31', '2015-12-17', '0000-00-00 00:00:00'),
(11, 1, 2, 1, 0, '', '', '0', 1, 10, 400, 0, 'For the love of all that is living work', '2015-12-07 04:36:40', '2015-12-17', '0000-00-00 00:00:00'),
(12, 1, 2, 1, 0, '', '', '0', 1, 10, 400, 0, 'Hey this is another test', '2015-12-07 04:59:45', '2015-12-26', '0000-00-00 00:00:00'),
(13, 7, 1, 1, 0, '', '', '0', 1, 1, 25, 0, 'test order from font page', '2015-12-07 08:04:13', '2015-12-15', '0000-00-00 00:00:00'),
(14, 18, 1, 1, 0, '', '', '0', 1, 1, 25, 0, 'another front page order', '2015-12-07 15:03:04', '2015-12-16', '0000-00-00 00:00:00'),
(15, 19, 1, 1, 0, '', '', '0', 0, 1, 25, 0, 'front page order for test cust 8', '2015-12-07 15:05:41', '2015-12-16', '0000-00-00 00:00:00'),
(16, 33, 1, 29, 30, 'cash', 'usyj', 'aon', 2, 1, 25, 0, 'I need photos of my sweet Katana!', '2015-12-08 09:40:09', '2015-12-09', '0000-00-00 00:00:00'),
(17, 34, 1, 0, 0, '', '', '', 1, 2, 25, 0, '', '2015-12-08 13:00:23', '0000-00-00', '0000-00-00 00:00:00'),
(18, 35, 1, 0, 0, '', '', '', 1, 1, 25, 0, 'test', '2015-12-08 13:06:25', '2015-12-31', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_photographers`
--

CREATE TABLE IF NOT EXISTS `tbl_photographers` (
  `userid` int(4) NOT NULL,
  `fname` varchar(32) COLLATE utf8mb4_bin NOT NULL,
  `lname` varchar(32) COLLATE utf8mb4_bin NOT NULL,
  `address1` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `address2` varchar(32) COLLATE utf8mb4_bin NOT NULL,
  `city` varchar(32) COLLATE utf8mb4_bin NOT NULL,
  `state` varchar(2) COLLATE utf8mb4_bin NOT NULL,
  `zip` int(10) NOT NULL,
  `email` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `phone` varchar(14) COLLATE utf8mb4_bin NOT NULL,
  `datehired` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `freelance` int(1) NOT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin COMMENT='table that contains photographers and their personal information';

--
-- Dumping data for table `tbl_photographers`
--

INSERT INTO `tbl_photographers` (`userid`, `fname`, `lname`, `address1`, `address2`, `city`, `state`, `zip`, `email`, `phone`, `datehired`, `freelance`) VALUES
(29, 'April', 'O''Neil', '123 Turtle Street', '', 'New York', 'Ny', 11234, 'april.oneil@test.com', '8888888889', '2015-12-08 08:13:33', 0),
(30, 'Eddie', 'Brock', '112 Revenge Dr.', '', 'New York', 'NY', 15432, 'eddie.brock@test.com', '123456789', '2015-12-08 08:09:16', 0),
(34, 'Eboshi', 'Gozen', '123 Forest Path', '', 'Hokkaido', 'Ja', 22222, 'eboshi.gozen@ghibli.net', '987654321', '2015-12-08 08:05:32', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule`
--

CREATE TABLE IF NOT EXISTS `tbl_schedule` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `photographerid` int(4) NOT NULL,
  `eventdate` date DEFAULT NULL,
  `timestart` time DEFAULT NULL,
  `timeend` time DEFAULT NULL,
  `eventdescription` varchar(120) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin COMMENT='contains each photographer''s schedule for the week' AUTO_INCREMENT=20 ;

--
-- Dumping data for table `tbl_schedule`
--

INSERT INTO `tbl_schedule` (`id`, `photographerid`, `eventdate`, `timestart`, `timeend`, `eventdescription`) VALUES
(16, 29, '2015-12-31', '15:00:00', '16:00:00', 'Ug '),
(17, 30, '2015-12-09', '10:00:00', '12:00:00', 'Wedding'),
(19, 34, '2015-12-14', '20:00:00', '22:00:00', 'Shower');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_services`
--

CREATE TABLE IF NOT EXISTS `tbl_services` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin COMMENT='Contains service ids, names, descriptions, and prices' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_services`
--

INSERT INTO `tbl_services` (`id`, `name`, `description`, `price`) VALUES
(1, 'Basic', 'Basic photo package containing: (3)3x5', 25),
(2, 'Standard', 'A photo package containing: (5) 3x5 and (2) 8x10', 40);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `accesslevel` int(11) NOT NULL DEFAULT '1',
  `lastaccess` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `userid` (`userid`),
  UNIQUE KEY `username` (`email`),
  KEY `userid_2` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=36 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userid`, `email`, `password`, `name`, `accesslevel`, `lastaccess`) VALUES
(1, 'test@test.com', '$2y$10$tqv5cMCXwS7niggS.D5SVuEdWnJdaYYMn/.N9U4ZEtZUHh.eI7IMm', 'Jimmy', 3, '2015-12-08 01:17:33'),
(2, 'test2@test.com', '$2y$10$7RwxOK0Pz0yc4YZo33mluexFuPUtdKY9BaYz2MSD8vcEQeL9NwpBS', 'Test2', 2, '0000-00-00 00:00:00'),
(5, 'matt@matt.com', '$2y$10$QX8n7aDBzpHmQSRr304jg.y3msPKakJUUJ0UD50sD9BE65VY8MQpe', 'Matthew', 2, '2015-12-08 02:28:30'),
(7, 'customer@customer.com', '$2y$10$rBuP0B0YcqO9X8bStPmjQOSfq2DZED8sDc331pXjsJhL8BLbZaVHm', 'Customer', 3, '2015-12-07 17:21:26'),
(8, 'ilovedatabases@test.com', '$2y$10$K8BX9JtxZyR968yPTLwp4uETdACXdN4VMrgiM8zYUY7T2tQ6Z5ARG', 'Andrew', 2, '2015-12-08 08:39:03'),
(9, 'admin@admin.com', '$2y$10$CIzsaYgxmNHvhjqnMDoeIOfSHZBmvw.oMeDLaDl.W4tVK1x/HuKDu', 'Admin', 1, '2015-12-08 13:15:15'),
(10, 'test1@test.com', '$2y$10$UoG/0wHedXpa24mmXAckKOtigDD49R7JJcMxu/2uRrjBZDPxF5DJW', 'test@test.', 1, '0000-00-00 00:00:00'),
(28, 'casey.jones@test.com', '$2y$10$eQ1Ja2sxvlVzWSIQ3rMlougGJrkfhNS0OYX/Uq55LP0NGs/PN0qrm', 'Casey', 3, '2015-12-08 08:14:26'),
(29, 'april.oneil@test.com', '$2y$10$99xVmF8xaPomF5O7kEnVJOwKWlX86aPds/alOY6DzgXI/TxG4h4mm', 'April', 2, '2015-12-08 09:31:56'),
(30, 'eddie.brock@test.com', '$2y$10$U8fmR5YuDDOLqWknFXesNeG19ag92t8Fl5c4mjKYR0IF5ADnJVUIi', 'Eddie', 2, '2015-12-08 08:09:16'),
(33, 'usagi@yojimbo.com', '$2y$10$0/g2wuYKj7ZAtgAmxB0cbeVL8A866l0rlrBsN5vC3NLnBzMAjRPly', 'Usagi', 3, '2015-12-08 09:45:22'),
(34, 'eboshi.gozen@ghibli.net', '$2y$10$OlBdwiiVwKzxmtWtLzJNiuMgQCEW98.gpjUyrJ.cGVDrEZpyxIzQ6', 'Eboshi', 2, '2015-12-08 13:10:58'),
(35, 'ian.malcom@test.com', '$2y$10$YsXG2M0Pf/M.d/XE2YQMl.81PaV/4s47FblCP2V6NMz88LFOfYDam', 'Ian', 3, '2015-12-08 12:56:05');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
