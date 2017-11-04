-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 27, 2016 at 01:11 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `networking`
--

-- --------------------------------------------------------

--
-- Table structure for table `matrix`
--

CREATE TABLE IF NOT EXISTS `matrix` (
  `PK_matrix` int(4) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  `min` int(6) NOT NULL,
  `max` int(6) NOT NULL,
  `memberpercent` float(5,2) NOT NULL,
  `equivamount` bigint(11) NOT NULL,
  `serviceincome` float(5,2) NOT NULL,
  `equivamount1` bigint(11) NOT NULL,
  PRIMARY KEY (`PK_matrix`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1010 ;

--
-- Dumping data for table `matrix`
--

INSERT INTO `matrix` (`PK_matrix`, `description`, `min`, `max`, `memberpercent`, `equivamount`, `serviceincome`, `equivamount1`) VALUES
(1000, 'Member', 0, 3, 0.00, 0, 0.02, 60000),
(1001, 'Executive', 4, 15, 25.00, 35000, 0.50, 60000),
(1002, 'Bronze Exc', 16, 63, 5.00, 28000, 0.50, 240000),
(1003, 'Silver Exc.', 64, 127, 5.00, 112000, 0.50, 960000),
(1004, 'Gold Exc.', 128, 511, 5.00, 450000, 0.50, 1920000),
(1005, 'Platinum', 512, 2047, 1.00, 175000, 0.10, 1536000),
(1006, 'Vice Pres', 2048, 8191, 0.50, 358400, 0.10, 6144000),
(1007, 'Exec. VP', 8192, 32767, 0.30, 860160, 0.10, 24576000),
(1008, 'Senior VP', 32768, 131072, 0.20, 2293760, 0.10, 98000000),
(1009, 'Director', 131072, 2147483647, 0.10, 4587520, 0.10, 393000000);

-- --------------------------------------------------------

--
-- Table structure for table `oldpass`
--

CREATE TABLE IF NOT EXISTS `oldpass` (
  `PK_oldpass` bigint(11) NOT NULL AUTO_INCREMENT,
  `FK_users` bigint(11) NOT NULL,
  `password` varchar(32) NOT NULL,
  `token` varchar(32) DEFAULT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`PK_oldpass`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `regdetails`
--

CREATE TABLE IF NOT EXISTS `regdetails` (
  `PK_regdetails` bigint(11) NOT NULL AUTO_INCREMENT,
  `FK_users` bigint(11) NOT NULL,
  `sponsorid` bigint(11) NOT NULL,
  `uplineid` bigint(11) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`PK_regdetails`),
  KEY `FK_users` (`FK_users`),
  KEY `FK_users_2` (`FK_users`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=129 ;

--
-- Dumping data for table `regdetails`
--

INSERT INTO `regdetails` (`PK_regdetails`, `FK_users`, `sponsorid`, `uplineid`, `datetime`) VALUES
(1, 10000000000, 0, 0, '2016-02-27 00:00:00'),
(2, 10000000001, 10000000000, 10000000000, '2016-02-27 00:00:00'),
(3, 10000000002, 10000000000, 10000000000, '2016-02-27 00:00:00'),
(4, 10000000003, 10000000000, 10000000000, '2016-02-27 00:00:00'),
(5, 10000000004, 10000000000, 10000000000, '2016-02-27 00:00:00'),
(6, 10000000005, 10000000001, 10000000001, '2016-02-27 00:00:00'),
(7, 10000000006, 10000000001, 10000000001, '2016-02-27 00:00:00'),
(8, 10000000007, 10000000001, 10000000001, '2016-02-27 00:00:00'),
(9, 10000000008, 10000000001, 10000000001, '2016-02-27 00:00:00'),
(10, 10000000009, 10000000002, 10000000002, '2016-02-27 00:00:00'),
(11, 10000000010, 10000000002, 10000000002, '2016-02-27 00:00:00'),
(12, 10000000011, 10000000002, 10000000002, '2016-02-27 00:00:00'),
(13, 10000000012, 10000000002, 10000000002, '2016-02-27 00:00:00'),
(14, 10000000013, 10000000003, 10000000003, '2016-02-27 00:00:00'),
(15, 10000000014, 10000000003, 10000000003, '2016-02-27 00:00:00'),
(16, 10000000015, 10000000003, 10000000003, '2016-02-27 00:00:00'),
(17, 10000000016, 10000000003, 10000000003, '2016-02-27 00:00:00'),
(18, 10000000017, 10000000004, 10000000004, '2016-02-27 00:00:00'),
(19, 10000000018, 10000000004, 10000000004, '2016-02-27 00:00:00'),
(20, 10000000019, 10000000004, 10000000004, '2016-02-27 00:00:00'),
(21, 10000000020, 10000000004, 10000000004, '2016-02-27 00:00:00'),
(22, 10000000021, 10000000005, 10000000005, '2016-02-27 00:00:00'),
(23, 10000000022, 10000000005, 10000000005, '2016-02-27 00:00:00'),
(24, 10000000023, 10000000005, 10000000005, '2016-02-27 00:00:00'),
(25, 10000000024, 10000000005, 10000000005, '2016-02-27 00:00:00'),
(26, 10000000025, 10000000006, 10000000006, '2016-02-27 00:00:00'),
(27, 10000000026, 10000000006, 10000000006, '2016-02-27 00:00:00'),
(28, 10000000027, 10000000006, 10000000006, '2016-02-27 00:00:00'),
(29, 10000000028, 10000000006, 10000000006, '2016-02-27 00:00:00'),
(30, 10000000029, 10000000007, 10000000007, '2016-02-27 00:00:00'),
(31, 10000000030, 10000000007, 10000000007, '2016-02-27 00:00:00'),
(32, 10000000031, 10000000007, 10000000007, '2016-02-27 00:00:00'),
(33, 10000000032, 10000000007, 10000000007, '2016-02-27 00:00:00'),
(34, 10000000033, 10000000008, 10000000008, '2016-02-27 00:00:00'),
(35, 10000000034, 10000000008, 10000000008, '2016-02-27 00:00:00'),
(36, 10000000035, 10000000008, 10000000008, '2016-02-27 00:00:00'),
(37, 10000000036, 10000000008, 10000000008, '2016-02-27 00:00:00'),
(38, 10000000037, 10000000009, 10000000009, '2016-02-27 00:00:00'),
(39, 10000000038, 10000000009, 10000000009, '2016-02-27 00:00:00'),
(40, 10000000039, 10000000009, 10000000009, '2016-02-27 00:00:00'),
(41, 10000000040, 10000000009, 10000000009, '2016-02-27 00:00:00'),
(42, 10000000041, 10000000010, 10000000010, '2016-02-27 00:00:00'),
(43, 10000000042, 10000000010, 10000000010, '2016-02-27 00:00:00'),
(44, 10000000043, 10000000010, 10000000010, '2016-02-27 00:00:00'),
(45, 10000000044, 10000000010, 10000000010, '2016-02-27 00:00:00'),
(46, 10000000045, 10000000011, 10000000011, '2016-02-27 00:00:00'),
(47, 10000000046, 10000000011, 10000000011, '2016-02-27 00:00:00'),
(48, 10000000047, 10000000011, 10000000011, '2016-02-27 00:00:00'),
(49, 10000000048, 10000000011, 10000000011, '2016-02-27 00:00:00'),
(50, 10000000049, 10000000012, 10000000012, '2016-02-27 00:00:00'),
(51, 10000000050, 10000000012, 10000000012, '2016-02-27 00:00:00'),
(52, 10000000051, 10000000012, 10000000012, '2016-02-27 00:00:00'),
(53, 10000000052, 10000000012, 10000000012, '2016-02-27 00:00:00'),
(54, 10000000053, 10000000013, 10000000013, '2016-02-27 00:00:00'),
(55, 10000000054, 10000000013, 10000000013, '2016-02-27 00:00:00'),
(56, 10000000055, 10000000013, 10000000013, '2016-02-27 00:00:00'),
(57, 10000000056, 10000000014, 10000000014, '2016-02-27 00:00:00'),
(58, 10000000057, 10000000014, 10000000014, '2016-02-27 00:00:00'),
(59, 10000000058, 10000000014, 10000000014, '2016-02-27 00:00:00'),
(60, 10000000059, 10000000014, 10000000014, '2016-02-27 00:00:00'),
(61, 10000000060, 10000000015, 10000000015, '2016-02-27 00:00:00'),
(62, 10000000061, 10000000015, 10000000015, '2016-02-27 00:00:00'),
(63, 10000000062, 10000000015, 10000000015, '2016-02-27 00:00:00'),
(64, 10000000063, 10000000015, 10000000015, '2016-02-27 00:00:00'),
(65, 10000000064, 10000000016, 10000000016, '2016-02-27 00:00:00'),
(66, 10000000065, 10000000016, 10000000016, '2016-02-27 00:00:00'),
(67, 10000000066, 10000000016, 10000000016, '2016-02-27 00:00:00'),
(68, 10000000067, 10000000016, 10000000016, '2016-02-27 00:00:00'),
(69, 10000000068, 10000000017, 10000000017, '2016-02-27 00:00:00'),
(70, 10000000069, 10000000017, 10000000017, '2016-02-27 00:00:00'),
(71, 10000000070, 10000000017, 10000000017, '2016-02-27 00:00:00'),
(72, 10000000071, 10000000017, 10000000017, '2016-02-27 00:00:00'),
(73, 10000000072, 10000000018, 10000000018, '2016-02-27 00:00:00'),
(74, 10000000073, 10000000018, 10000000018, '2016-02-27 00:00:00'),
(75, 10000000074, 10000000018, 10000000018, '2016-02-27 00:00:00'),
(76, 10000000075, 10000000018, 10000000018, '2016-02-27 00:00:00'),
(77, 10000000076, 10000000019, 10000000019, '2016-02-27 00:00:00'),
(78, 10000000077, 10000000019, 10000000019, '2016-02-27 00:00:00'),
(79, 10000000078, 10000000019, 10000000019, '2016-02-27 00:00:00'),
(80, 10000000079, 10000000019, 10000000019, '2016-02-27 00:00:00'),
(81, 10000000080, 10000000020, 10000000020, '2016-02-27 00:00:00'),
(82, 10000000081, 10000000020, 10000000020, '2016-02-27 00:00:00'),
(83, 10000000082, 10000000020, 10000000020, '2016-02-27 00:00:00'),
(84, 10000000083, 10000000020, 10000000020, '2016-02-27 00:00:00'),
(85, 10000000084, 10000000021, 10000000021, '2016-02-27 00:00:00'),
(86, 10000000085, 10000000021, 10000000021, '2016-02-27 00:00:00'),
(87, 10000000086, 10000000021, 10000000021, '2016-02-27 00:00:00'),
(88, 10000000087, 10000000021, 10000000021, '2016-02-27 00:00:00'),
(89, 10000000088, 10000000022, 10000000022, '2016-02-27 00:00:00'),
(90, 10000000089, 10000000022, 10000000022, '2016-02-27 00:00:00'),
(91, 10000000090, 10000000022, 10000000022, '2016-02-27 00:00:00'),
(92, 10000000091, 10000000022, 10000000022, '2016-02-27 00:00:00'),
(93, 10000000092, 10000000023, 10000000023, '2016-02-27 00:00:00'),
(94, 10000000093, 10000000023, 10000000023, '2016-02-27 00:00:00'),
(95, 10000000094, 10000000023, 10000000023, '2016-02-27 00:00:00'),
(96, 10000000095, 10000000023, 10000000023, '2016-02-27 00:00:00'),
(97, 10000000096, 10000000024, 10000000024, '2016-02-27 00:00:00'),
(98, 10000000097, 10000000024, 10000000024, '2016-02-27 00:00:00'),
(99, 10000000098, 10000000024, 10000000024, '2016-02-27 00:00:00'),
(100, 10000000099, 10000000024, 10000000024, '2016-02-27 00:00:00'),
(101, 10000000100, 10000000025, 10000000025, '2016-02-27 00:00:00'),
(102, 10000000101, 10000000025, 10000000025, '2016-02-27 00:00:00'),
(103, 10000000102, 10000000025, 10000000025, '2016-02-27 00:00:00'),
(104, 10000000103, 10000000025, 10000000025, '2016-02-27 00:00:00'),
(105, 10000000104, 10000000026, 10000000026, '2016-02-27 00:00:00'),
(106, 10000000105, 10000000026, 10000000026, '2016-02-27 00:00:00'),
(107, 10000000106, 10000000026, 10000000026, '2016-02-27 00:00:00'),
(108, 10000000107, 10000000026, 10000000026, '2016-02-27 00:00:00'),
(109, 10000000108, 10000000027, 10000000027, '2016-02-27 00:00:00'),
(110, 10000000109, 10000000027, 10000000027, '2016-02-27 00:00:00'),
(111, 10000000110, 10000000027, 10000000027, '2016-02-27 00:00:00'),
(112, 10000000111, 10000000027, 10000000027, '2016-02-27 00:00:00'),
(113, 10000000112, 10000000028, 10000000028, '2016-02-27 00:00:00'),
(114, 10000000113, 10000000028, 10000000028, '2016-02-27 00:00:00'),
(115, 10000000114, 10000000028, 10000000028, '2016-02-27 00:00:00'),
(116, 10000000115, 10000000028, 10000000028, '2016-02-27 00:00:00'),
(117, 10000000116, 10000000029, 10000000029, '2016-02-27 00:00:00'),
(118, 10000000117, 10000000029, 10000000029, '2016-02-27 00:00:00'),
(119, 10000000118, 10000000029, 10000000029, '2016-02-27 00:00:00'),
(120, 10000000119, 10000000029, 10000000029, '2016-02-27 00:00:00'),
(121, 10000000120, 10000000030, 10000000030, '2016-02-27 00:00:00'),
(122, 10000000121, 10000000030, 10000000030, '2016-02-27 00:00:00'),
(123, 10000000122, 10000000030, 10000000030, '2016-02-27 00:00:00'),
(124, 10000000123, 10000000030, 10000000030, '2016-02-27 00:00:00'),
(125, 10000000124, 10000000031, 10000000031, '2016-02-27 00:00:00'),
(126, 10000000125, 10000000031, 10000000031, '2016-02-27 00:00:00'),
(127, 10000000126, 10000000031, 10000000031, '2016-02-27 00:00:00'),
(128, 10000000127, 10000000031, 10000000031, '2016-02-27 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `reqresetpass`
--

CREATE TABLE IF NOT EXISTS `reqresetpass` (
  `PK_reqresetpass` bigint(11) NOT NULL AUTO_INCREMENT,
  `FK_users` bigint(11) NOT NULL,
  `newpass` varchar(32) NOT NULL,
  `datetime` datetime NOT NULL,
  `publicip` varchar(32) NOT NULL,
  `isconfirm` enum('0','1') NOT NULL,
  PRIMARY KEY (`PK_reqresetpass`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `PK_status` int(4) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`PK_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1003 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`PK_status`, `timestamp`, `description`) VALUES
(1000, '2015-12-06 14:21:49', 'For Email Verfication'),
(1001, '2015-12-04 06:00:00', 'On Hold'),
(1002, '2015-12-04 06:00:00', 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE IF NOT EXISTS `userdata` (
  `PK_userdata` bigint(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `contactno` varchar(32) NOT NULL,
  `address` varchar(255) NOT NULL,
  `bdate` date NOT NULL,
  `gender` enum('M','F') NOT NULL,
  PRIMARY KEY (`PK_userdata`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10000000128 ;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`PK_userdata`, `firstname`, `lastname`, `email`, `contactno`, `address`, `bdate`, `gender`) VALUES
(10000000000, 'Emman', 'Arrazola', 'emmanarrazola1@gmail.com', '09175340308', 'Tondo, Manila', '1994-01-13', 'M'),
(10000000001, 'Emman', 'Arrazola', 'emmanarrazola2@gmail.com', '09175340308', 'Tondo, Manila', '1994-01-14', 'M'),
(10000000002, 'Emman', 'Arrazola', 'emmanarrazola3@gmail.com', '09175340308', 'Tondo, Manila', '1994-01-15', 'M'),
(10000000003, 'Emman', 'Arrazola', 'emmanarrazola4@gmail.com', '09175340308', 'Tondo, Manila', '1994-01-16', 'M'),
(10000000004, 'Emman', 'Arrazola', 'emmanarrazola5@gmail.com', '09175340308', 'Tondo, Manila', '1994-01-17', 'M'),
(10000000005, 'Emman', 'Arrazola', 'emmanarrazola6@gmail.com', '09175340308', 'Tondo, Manila', '1994-01-18', 'M'),
(10000000006, 'Emman', 'Arrazola', 'emmanarrazola7@gmail.com', '09175340308', 'Tondo, Manila', '1994-01-19', 'M'),
(10000000007, 'Emman', 'Arrazola', 'emmanarrazola8@gmail.com', '09175340308', 'Tondo, Manila', '1994-01-20', 'M'),
(10000000008, 'Emman', 'Arrazola', 'emmanarrazola9@gmail.com', '09175340308', 'Tondo, Manila', '1994-01-21', 'M'),
(10000000009, 'Emman', 'Arrazola', 'emmanarrazola10@gmail.com', '09175340308', 'Tondo, Manila', '1994-01-22', 'M'),
(10000000010, 'Emman', 'Arrazola', 'emmanarrazola11@gmail.com', '09175340308', 'Tondo, Manila', '1994-01-23', 'M'),
(10000000011, 'Emman', 'Arrazola', 'emmanarrazola12@gmail.com', '09175340308', 'Tondo, Manila', '1994-01-24', 'M'),
(10000000012, 'Emman', 'Arrazola', 'emmanarrazola13@gmail.com', '09175340308', 'Tondo, Manila', '1994-01-25', 'M'),
(10000000013, 'Emman', 'Arrazola', 'emmanarrazola14@gmail.com', '09175340308', 'Tondo, Manila', '1994-01-26', 'M'),
(10000000014, 'Emman', 'Arrazola', 'emmanarrazola15@gmail.com', '09175340308', 'Tondo, Manila', '1994-01-27', 'M'),
(10000000015, 'Emman', 'Arrazola', 'emmanarrazola16@gmail.com', '09175340308', 'Tondo, Manila', '1994-01-28', 'M'),
(10000000016, 'Emman', 'Arrazola', 'emmanarrazola17@gmail.com', '09175340308', 'Tondo, Manila', '1994-01-29', 'M'),
(10000000017, 'Emman', 'Arrazola', 'emmanarrazola18@gmail.com', '09175340308', 'Tondo, Manila', '1994-01-30', 'M'),
(10000000018, 'Emman', 'Arrazola', 'emmanarrazola19@gmail.com', '09175340308', 'Tondo, Manila', '1994-01-31', 'M'),
(10000000019, 'Emman', 'Arrazola', 'emmanarrazola20@gmail.com', '09175340308', 'Tondo, Manila', '1994-02-01', 'M'),
(10000000020, 'Emman', 'Arrazola', 'emmanarrazola21@gmail.com', '09175340308', 'Tondo, Manila', '1994-02-02', 'M'),
(10000000021, 'Emman', 'Arrazola', 'emmanarrazola22@gmail.com', '09175340308', 'Tondo, Manila', '1994-02-03', 'M'),
(10000000022, 'Emman', 'Arrazola', 'emmanarrazola23@gmail.com', '09175340308', 'Tondo, Manila', '1994-02-04', 'M'),
(10000000023, 'Emman', 'Arrazola', 'emmanarrazola24@gmail.com', '09175340308', 'Tondo, Manila', '1994-02-05', 'M'),
(10000000024, 'Emman', 'Arrazola', 'emmanarrazola25@gmail.com', '09175340308', 'Tondo, Manila', '1994-02-06', 'M'),
(10000000025, 'Emman', 'Arrazola', 'emmanarrazola26@gmail.com', '09175340308', 'Tondo, Manila', '1994-02-07', 'M'),
(10000000026, 'Emman', 'Arrazola', 'emmanarrazola27@gmail.com', '09175340308', 'Tondo, Manila', '1994-02-08', 'M'),
(10000000027, 'Emman', 'Arrazola', 'emmanarrazola28@gmail.com', '09175340308', 'Tondo, Manila', '1994-02-09', 'M'),
(10000000028, 'Emman', 'Arrazola', 'emmanarrazola29@gmail.com', '09175340308', 'Tondo, Manila', '1994-02-10', 'M'),
(10000000029, 'Emman', 'Arrazola', 'emmanarrazola30@gmail.com', '09175340308', 'Tondo, Manila', '1994-02-11', 'M'),
(10000000030, 'Emman', 'Arrazola', 'emmanarrazola31@gmail.com', '09175340308', 'Tondo, Manila', '1994-02-12', 'M'),
(10000000031, 'Emman', 'Arrazola', 'emmanarrazola32@gmail.com', '09175340308', 'Tondo, Manila', '1994-02-13', 'M'),
(10000000032, 'Emman', 'Arrazola', 'emmanarrazola33@gmail.com', '09175340308', 'Tondo, Manila', '1994-02-14', 'M'),
(10000000033, 'Emman', 'Arrazola', 'emmanarrazola34@gmail.com', '09175340308', 'Tondo, Manila', '1994-02-15', 'M'),
(10000000034, 'Emman', 'Arrazola', 'emmanarrazola35@gmail.com', '09175340308', 'Tondo, Manila', '1994-02-16', 'M'),
(10000000035, 'Emman', 'Arrazola', 'emmanarrazola36@gmail.com', '09175340308', 'Tondo, Manila', '1994-02-17', 'M'),
(10000000036, 'Emman', 'Arrazola', 'emmanarrazola37@gmail.com', '09175340308', 'Tondo, Manila', '1994-02-18', 'M'),
(10000000037, 'Emman', 'Arrazola', 'emmanarrazola38@gmail.com', '09175340308', 'Tondo, Manila', '1994-02-19', 'M'),
(10000000038, 'Emman', 'Arrazola', 'emmanarrazola39@gmail.com', '09175340308', 'Tondo, Manila', '1994-02-20', 'M'),
(10000000039, 'Emman', 'Arrazola', 'emmanarrazola40@gmail.com', '09175340308', 'Tondo, Manila', '1994-02-21', 'M'),
(10000000040, 'Emman', 'Arrazola', 'emmanarrazola41@gmail.com', '09175340308', 'Tondo, Manila', '1994-02-22', 'M'),
(10000000041, 'Emman', 'Arrazola', 'emmanarrazola42@gmail.com', '09175340308', 'Tondo, Manila', '1994-02-23', 'M'),
(10000000042, 'Emman', 'Arrazola', 'emmanarrazola43@gmail.com', '09175340308', 'Tondo, Manila', '1994-02-24', 'M'),
(10000000043, 'Emman', 'Arrazola', 'emmanarrazola44@gmail.com', '09175340308', 'Tondo, Manila', '1994-02-25', 'M'),
(10000000044, 'Emman', 'Arrazola', 'emmanarrazola45@gmail.com', '09175340308', 'Tondo, Manila', '1994-02-26', 'M'),
(10000000045, 'Emman', 'Arrazola', 'emmanarrazola46@gmail.com', '09175340308', 'Tondo, Manila', '1994-02-27', 'M'),
(10000000046, 'Emman', 'Arrazola', 'emmanarrazola47@gmail.com', '09175340308', 'Tondo, Manila', '1994-02-28', 'M'),
(10000000047, 'Emman', 'Arrazola', 'emmanarrazola48@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-01', 'M'),
(10000000048, 'Emman', 'Arrazola', 'emmanarrazola49@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-02', 'M'),
(10000000049, 'Emman', 'Arrazola', 'emmanarrazola50@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-03', 'M'),
(10000000050, 'Emman', 'Arrazola', 'emmanarrazola51@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-04', 'M'),
(10000000051, 'Emman', 'Arrazola', 'emmanarrazola52@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-05', 'M'),
(10000000052, 'Emman', 'Arrazola', 'emmanarrazola53@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-06', 'M'),
(10000000053, 'Emman', 'Arrazola', 'emmanarrazola54@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-07', 'M'),
(10000000054, 'Emman', 'Arrazola', 'emmanarrazola55@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-08', 'M'),
(10000000055, 'Emman', 'Arrazola', 'emmanarrazola56@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-09', 'M'),
(10000000056, 'Emman', 'Arrazola', 'emmanarrazola57@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-10', 'M'),
(10000000057, 'Emman', 'Arrazola', 'emmanarrazola58@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-11', 'M'),
(10000000058, 'Emman', 'Arrazola', 'emmanarrazola59@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-12', 'M'),
(10000000059, 'Emman', 'Arrazola', 'emmanarrazola60@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-13', 'M'),
(10000000060, 'Emman', 'Arrazola', 'emmanarrazola61@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-14', 'M'),
(10000000061, 'Emman', 'Arrazola', 'emmanarrazola62@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-15', 'M'),
(10000000062, 'Emman', 'Arrazola', 'emmanarrazola63@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-16', 'M'),
(10000000063, 'Emman', 'Arrazola', 'emmanarrazola64@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-17', 'M'),
(10000000064, 'Emman', 'Arrazola', 'emmanarrazola65@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-18', 'M'),
(10000000065, 'Emman', 'Arrazola', 'emmanarrazola66@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-19', 'M'),
(10000000066, 'Emman', 'Arrazola', 'emmanarrazola67@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-20', 'M'),
(10000000067, 'Emman', 'Arrazola', 'emmanarrazola68@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-21', 'M'),
(10000000068, 'Emman', 'Arrazola', 'emmanarrazola69@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-22', 'M'),
(10000000069, 'Emman', 'Arrazola', 'emmanarrazola70@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-23', 'M'),
(10000000070, 'Emman', 'Arrazola', 'emmanarrazola71@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-24', 'M'),
(10000000071, 'Emman', 'Arrazola', 'emmanarrazola72@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-25', 'M'),
(10000000072, 'Emman', 'Arrazola', 'emmanarrazola73@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-26', 'M'),
(10000000073, 'Emman', 'Arrazola', 'emmanarrazola74@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-27', 'M'),
(10000000074, 'Emman', 'Arrazola', 'emmanarrazola75@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-28', 'M'),
(10000000075, 'Emman', 'Arrazola', 'emmanarrazola76@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-29', 'M'),
(10000000076, 'Emman', 'Arrazola', 'emmanarrazola77@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-30', 'M'),
(10000000077, 'Emman', 'Arrazola', 'emmanarrazola78@gmail.com', '09175340308', 'Tondo, Manila', '1994-03-31', 'M'),
(10000000078, 'Emman', 'Arrazola', 'emmanarrazola79@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-01', 'M'),
(10000000079, 'Emman', 'Arrazola', 'emmanarrazola80@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-02', 'M'),
(10000000080, 'Emman', 'Arrazola', 'emmanarrazola81@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-03', 'M'),
(10000000081, 'Emman', 'Arrazola', 'emmanarrazola82@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-04', 'M'),
(10000000082, 'Emman', 'Arrazola', 'emmanarrazola83@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-05', 'M'),
(10000000083, 'Emman', 'Arrazola', 'emmanarrazola84@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-06', 'M'),
(10000000084, 'Emman', 'Arrazola', 'emmanarrazola85@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-07', 'M'),
(10000000085, 'Emman', 'Arrazola', 'emmanarrazola86@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-08', 'M'),
(10000000086, 'Emman', 'Arrazola', 'emmanarrazola87@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-09', 'M'),
(10000000087, 'Emman', 'Arrazola', 'emmanarrazola88@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-10', 'M'),
(10000000088, 'Emman', 'Arrazola', 'emmanarrazola89@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-11', 'M'),
(10000000089, 'Emman', 'Arrazola', 'emmanarrazola90@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-12', 'M'),
(10000000090, 'Emman', 'Arrazola', 'emmanarrazola91@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-13', 'M'),
(10000000091, 'Emman', 'Arrazola', 'emmanarrazola92@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-14', 'M'),
(10000000092, 'Emman', 'Arrazola', 'emmanarrazola93@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-15', 'M'),
(10000000093, 'Emman', 'Arrazola', 'emmanarrazola94@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-16', 'M'),
(10000000094, 'Emman', 'Arrazola', 'emmanarrazola95@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-17', 'M'),
(10000000095, 'Emman', 'Arrazola', 'emmanarrazola96@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-18', 'M'),
(10000000096, 'Emman', 'Arrazola', 'emmanarrazola97@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-19', 'M'),
(10000000097, 'Emman', 'Arrazola', 'emmanarrazola98@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-20', 'M'),
(10000000098, 'Emman', 'Arrazola', 'emmanarrazola99@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-21', 'M'),
(10000000099, 'Emman', 'Arrazola', 'emmanarrazola100@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-22', 'M'),
(10000000100, 'Emman', 'Arrazola', 'emmanarrazola101@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-23', 'M'),
(10000000101, 'Emman', 'Arrazola', 'emmanarrazola102@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-24', 'M'),
(10000000102, 'Emman', 'Arrazola', 'emmanarrazola103@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-25', 'M'),
(10000000103, 'Emman', 'Arrazola', 'emmanarrazola104@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-26', 'M'),
(10000000104, 'Emman', 'Arrazola', 'emmanarrazola105@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-27', 'M'),
(10000000105, 'Emman', 'Arrazola', 'emmanarrazola106@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-28', 'M'),
(10000000106, 'Emman', 'Arrazola', 'emmanarrazola107@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-29', 'M'),
(10000000107, 'Emman', 'Arrazola', 'emmanarrazola108@gmail.com', '09175340308', 'Tondo, Manila', '1994-04-30', 'M'),
(10000000108, 'Emman', 'Arrazola', 'emmanarrazola109@gmail.com', '09175340308', 'Tondo, Manila', '1994-05-01', 'M'),
(10000000109, 'Emman', 'Arrazola', 'emmanarrazola110@gmail.com', '09175340308', 'Tondo, Manila', '1994-05-02', 'M'),
(10000000110, 'Emman', 'Arrazola', 'emmanarrazola111@gmail.com', '09175340308', 'Tondo, Manila', '1994-05-03', 'M'),
(10000000111, 'Emman', 'Arrazola', 'emmanarrazola112@gmail.com', '09175340308', 'Tondo, Manila', '1994-05-04', 'M'),
(10000000112, 'Emman', 'Arrazola', 'emmanarrazola113@gmail.com', '09175340308', 'Tondo, Manila', '1994-05-05', 'M'),
(10000000113, 'Emman', 'Arrazola', 'emmanarrazola114@gmail.com', '09175340308', 'Tondo, Manila', '1994-05-06', 'M'),
(10000000114, 'Emman', 'Arrazola', 'emmanarrazola115@gmail.com', '09175340308', 'Tondo, Manila', '1994-05-07', 'M'),
(10000000115, 'Emman', 'Arrazola', 'emmanarrazola116@gmail.com', '09175340308', 'Tondo, Manila', '1994-05-08', 'M'),
(10000000116, 'Emman', 'Arrazola', 'emmanarrazola117@gmail.com', '09175340308', 'Tondo, Manila', '1994-05-09', 'M'),
(10000000117, 'Emman', 'Arrazola', 'emmanarrazola118@gmail.com', '09175340308', 'Tondo, Manila', '1994-05-10', 'M'),
(10000000118, 'Emman', 'Arrazola', 'emmanarrazola119@gmail.com', '09175340308', 'Tondo, Manila', '1994-05-11', 'M'),
(10000000119, 'Emman', 'Arrazola', 'emmanarrazola120@gmail.com', '09175340308', 'Tondo, Manila', '1994-05-12', 'M'),
(10000000120, 'Emman', 'Arrazola', 'emmanarrazola121@gmail.com', '09175340308', 'Tondo, Manila', '1994-05-13', 'M'),
(10000000121, 'Emman', 'Arrazola', 'emmanarrazola122@gmail.com', '09175340308', 'Tondo, Manila', '1994-05-14', 'M'),
(10000000122, 'Emman', 'Arrazola', 'emmanarrazola123@gmail.com', '09175340308', 'Tondo, Manila', '1994-05-15', 'M'),
(10000000123, 'Emman', 'Arrazola', 'emmanarrazola124@gmail.com', '09175340308', 'Tondo, Manila', '1994-05-16', 'M'),
(10000000124, 'Emman', 'Arrazola', 'emmanarrazola125@gmail.com', '09175340308', 'Tondo, Manila', '1994-05-17', 'M'),
(10000000125, 'Emman', 'Arrazola', 'emmanarrazola126@gmail.com', '09175340308', 'Tondo, Manila', '1994-05-18', 'M'),
(10000000126, 'Emman', 'Arrazola', 'emmanarrazola127@gmail.com', '09175340308', 'Tondo, Manila', '1994-05-19', 'M'),
(10000000127, 'Emman', 'Arrazola', 'emmanarrazola128@gmail.com', '09175340308', 'Tondo, Manila', '1994-05-20', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `PK_users` bigint(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(32) NOT NULL,
  `generatedmd5` varchar(32) NOT NULL,
  `loginattemp` int(1) NOT NULL,
  `FK_userdata` bigint(11) NOT NULL,
  PRIMARY KEY (`PK_users`),
  KEY `FK_userdata` (`FK_userdata`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10000000128 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`PK_users`, `password`, `generatedmd5`, `loginattemp`, `FK_userdata`) VALUES
(10000000000, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000000),
(10000000001, 'a16f90b8ae826a3d1b751c609042a8a2', '0', 0, 10000000001),
(10000000002, 'a16f90b8ae826a3d1b751c609042a8a3', '0', 0, 10000000002),
(10000000003, 'a16f90b8ae826a3d1b751c609042a8a4', '0', 0, 10000000003),
(10000000004, 'a16f90b8ae826a3d1b751c609042a8a5', '0', 0, 10000000004),
(10000000005, 'a16f90b8ae826a3d1b751c609042a8a6', '0', 0, 10000000005),
(10000000006, 'a16f90b8ae826a3d1b751c609042a8a7', '0', 0, 10000000006),
(10000000007, 'a16f90b8ae826a3d1b751c609042a8a8', '0', 0, 10000000007),
(10000000008, 'a16f90b8ae826a3d1b751c609042a8a9', '0', 0, 10000000008),
(10000000009, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000009),
(10000000010, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000010),
(10000000011, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000011),
(10000000012, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000012),
(10000000013, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000013),
(10000000014, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000014),
(10000000015, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000015),
(10000000016, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000016),
(10000000017, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000017),
(10000000018, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000018),
(10000000019, 'a16f90b8ae826a3d1b751c609042a8a2', '0', 0, 10000000019),
(10000000020, 'a16f90b8ae826a3d1b751c609042a8a2', '0', 0, 10000000020),
(10000000021, 'a16f90b8ae826a3d1b751c609042a8a2', '0', 0, 10000000021),
(10000000022, 'a16f90b8ae826a3d1b751c609042a8a2', '0', 0, 10000000022),
(10000000023, 'a16f90b8ae826a3d1b751c609042a8a2', '0', 0, 10000000023),
(10000000024, 'a16f90b8ae826a3d1b751c609042a8a2', '0', 0, 10000000024),
(10000000025, 'a16f90b8ae826a3d1b751c609042a8a2', '0', 0, 10000000025),
(10000000026, 'a16f90b8ae826a3d1b751c609042a8a2', '0', 0, 10000000026),
(10000000027, 'a16f90b8ae826a3d1b751c609042a8a2', '0', 0, 10000000027),
(10000000028, 'a16f90b8ae826a3d1b751c609042a8a2', '0', 0, 10000000028),
(10000000029, 'a16f90b8ae826a3d1b751c609042a8a3', '0', 0, 10000000029),
(10000000030, 'a16f90b8ae826a3d1b751c609042a8a3', '0', 0, 10000000030),
(10000000031, 'a16f90b8ae826a3d1b751c609042a8a3', '0', 0, 10000000031),
(10000000032, 'a16f90b8ae826a3d1b751c609042a8a3', '0', 0, 10000000032),
(10000000033, 'a16f90b8ae826a3d1b751c609042a8a3', '0', 0, 10000000033),
(10000000034, 'a16f90b8ae826a3d1b751c609042a8a3', '0', 0, 10000000034),
(10000000035, 'a16f90b8ae826a3d1b751c609042a8a3', '0', 0, 10000000035),
(10000000036, 'a16f90b8ae826a3d1b751c609042a8a3', '0', 0, 10000000036),
(10000000037, 'a16f90b8ae826a3d1b751c609042a8a3', '0', 0, 10000000037),
(10000000038, 'a16f90b8ae826a3d1b751c609042a8a3', '0', 0, 10000000038),
(10000000039, 'a16f90b8ae826a3d1b751c609042a8a4', '0', 0, 10000000039),
(10000000040, 'a16f90b8ae826a3d1b751c609042a8a4', '0', 0, 10000000040),
(10000000041, 'a16f90b8ae826a3d1b751c609042a8a4', '0', 0, 10000000041),
(10000000042, 'a16f90b8ae826a3d1b751c609042a8a4', '0', 0, 10000000042),
(10000000043, 'a16f90b8ae826a3d1b751c609042a8a4', '0', 0, 10000000043),
(10000000044, 'a16f90b8ae826a3d1b751c609042a8a4', '0', 0, 10000000044),
(10000000045, 'a16f90b8ae826a3d1b751c609042a8a4', '0', 0, 10000000045),
(10000000046, 'a16f90b8ae826a3d1b751c609042a8a4', '0', 0, 10000000046),
(10000000047, 'a16f90b8ae826a3d1b751c609042a8a4', '0', 0, 10000000047),
(10000000048, 'a16f90b8ae826a3d1b751c609042a8a4', '0', 0, 10000000048),
(10000000049, 'a16f90b8ae826a3d1b751c609042a8a5', '0', 0, 10000000049),
(10000000050, 'a16f90b8ae826a3d1b751c609042a8a5', '0', 0, 10000000050),
(10000000051, 'a16f90b8ae826a3d1b751c609042a8a5', '0', 0, 10000000051),
(10000000052, 'a16f90b8ae826a3d1b751c609042a8a5', '0', 0, 10000000052),
(10000000053, 'a16f90b8ae826a3d1b751c609042a8a5', '0', 0, 10000000053),
(10000000054, 'a16f90b8ae826a3d1b751c609042a8a5', '0', 0, 10000000054),
(10000000055, 'a16f90b8ae826a3d1b751c609042a8a5', '0', 0, 10000000055),
(10000000056, 'a16f90b8ae826a3d1b751c609042a8a5', '0', 0, 10000000056),
(10000000057, 'a16f90b8ae826a3d1b751c609042a8a5', '0', 0, 10000000057),
(10000000058, 'a16f90b8ae826a3d1b751c609042a8a5', '0', 0, 10000000058),
(10000000059, 'a16f90b8ae826a3d1b751c609042a8a6', '0', 0, 10000000059),
(10000000060, 'a16f90b8ae826a3d1b751c609042a8a6', '0', 0, 10000000060),
(10000000061, 'a16f90b8ae826a3d1b751c609042a8a6', '0', 0, 10000000061),
(10000000062, 'a16f90b8ae826a3d1b751c609042a8a6', '0', 0, 10000000062),
(10000000063, 'a16f90b8ae826a3d1b751c609042a8a6', '0', 0, 10000000063),
(10000000064, 'a16f90b8ae826a3d1b751c609042a8a6', '0', 0, 10000000064),
(10000000065, 'a16f90b8ae826a3d1b751c609042a8a6', '0', 0, 10000000065),
(10000000066, 'a16f90b8ae826a3d1b751c609042a8a6', '0', 0, 10000000066),
(10000000067, 'a16f90b8ae826a3d1b751c609042a8a6', '0', 0, 10000000067),
(10000000068, 'a16f90b8ae826a3d1b751c609042a8a6', '0', 0, 10000000068),
(10000000069, 'a16f90b8ae826a3d1b751c609042a8a7', '0', 0, 10000000069),
(10000000070, 'a16f90b8ae826a3d1b751c609042a8a7', '0', 0, 10000000070),
(10000000071, 'a16f90b8ae826a3d1b751c609042a8a7', '0', 0, 10000000071),
(10000000072, 'a16f90b8ae826a3d1b751c609042a8a7', '0', 0, 10000000072),
(10000000073, 'a16f90b8ae826a3d1b751c609042a8a7', '0', 0, 10000000073),
(10000000074, 'a16f90b8ae826a3d1b751c609042a8a7', '0', 0, 10000000074),
(10000000075, 'a16f90b8ae826a3d1b751c609042a8a7', '0', 0, 10000000075),
(10000000076, 'a16f90b8ae826a3d1b751c609042a8a7', '0', 0, 10000000076),
(10000000077, 'a16f90b8ae826a3d1b751c609042a8a7', '0', 0, 10000000077),
(10000000078, 'a16f90b8ae826a3d1b751c609042a8a7', '0', 0, 10000000078),
(10000000079, 'a16f90b8ae826a3d1b751c609042a8a8', '0', 0, 10000000079),
(10000000080, 'a16f90b8ae826a3d1b751c609042a8a8', '0', 0, 10000000080),
(10000000081, 'a16f90b8ae826a3d1b751c609042a8a8', '0', 0, 10000000081),
(10000000082, 'a16f90b8ae826a3d1b751c609042a8a8', '0', 0, 10000000082),
(10000000083, 'a16f90b8ae826a3d1b751c609042a8a8', '0', 0, 10000000083),
(10000000084, 'a16f90b8ae826a3d1b751c609042a8a8', '0', 0, 10000000084),
(10000000085, 'a16f90b8ae826a3d1b751c609042a8a8', '0', 0, 10000000085),
(10000000086, 'a16f90b8ae826a3d1b751c609042a8a8', '0', 0, 10000000086),
(10000000087, 'a16f90b8ae826a3d1b751c609042a8a8', '0', 0, 10000000087),
(10000000088, 'a16f90b8ae826a3d1b751c609042a8a8', '0', 0, 10000000088),
(10000000089, 'a16f90b8ae826a3d1b751c609042a8a9', '0', 0, 10000000089),
(10000000090, 'a16f90b8ae826a3d1b751c609042a8a9', '0', 0, 10000000090),
(10000000091, 'a16f90b8ae826a3d1b751c609042a8a9', '0', 0, 10000000091),
(10000000092, 'a16f90b8ae826a3d1b751c609042a8a9', '0', 0, 10000000092),
(10000000093, 'a16f90b8ae826a3d1b751c609042a8a9', '0', 0, 10000000093),
(10000000094, 'a16f90b8ae826a3d1b751c609042a8a9', '0', 0, 10000000094),
(10000000095, 'a16f90b8ae826a3d1b751c609042a8a9', '0', 0, 10000000095),
(10000000096, 'a16f90b8ae826a3d1b751c609042a8a9', '0', 0, 10000000096),
(10000000097, 'a16f90b8ae826a3d1b751c609042a8a9', '0', 0, 10000000097),
(10000000098, 'a16f90b8ae826a3d1b751c609042a8a9', '0', 0, 10000000098),
(10000000099, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000099),
(10000000100, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000100),
(10000000101, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000101),
(10000000102, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000102),
(10000000103, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000103),
(10000000104, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000104),
(10000000105, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000105),
(10000000106, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000106),
(10000000107, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000107),
(10000000108, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000108),
(10000000109, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000109),
(10000000110, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000110),
(10000000111, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000111),
(10000000112, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000112),
(10000000113, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000113),
(10000000114, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000114),
(10000000115, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000115),
(10000000116, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000116),
(10000000117, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000117),
(10000000118, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000118),
(10000000119, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000119),
(10000000120, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000120),
(10000000121, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000121),
(10000000122, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000122),
(10000000123, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000123),
(10000000124, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000124),
(10000000125, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000125),
(10000000126, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000126),
(10000000127, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, 10000000127);

-- --------------------------------------------------------

--
-- Table structure for table `visitaudit`
--

CREATE TABLE IF NOT EXISTS `visitaudit` (
  `PK_visitaudit` bigint(11) NOT NULL AUTO_INCREMENT,
  `description` longtext NOT NULL,
  `publicip` varchar(32) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`PK_visitaudit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `regdetails`
--
ALTER TABLE `regdetails`
  ADD CONSTRAINT `regdetails_ibfk_1` FOREIGN KEY (`FK_users`) REFERENCES `users` (`PK_users`);

--
-- Constraints for table `userdata`
--
ALTER TABLE `userdata`
  ADD CONSTRAINT `userdata_ibfk_1` FOREIGN KEY (`PK_userdata`) REFERENCES `users` (`FK_userdata`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
