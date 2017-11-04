-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 01, 2016 at 06:14 AM
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
(1002, 'Bronze Executive', 16, 63, 5.00, 28000, 0.50, 240000),
(1003, 'Silver Executive', 64, 127, 5.00, 112000, 0.50, 960000),
(1004, 'Gold Executive', 128, 511, 5.00, 450000, 0.50, 1920000),
(1005, 'Platinum', 512, 2047, 1.00, 175000, 0.10, 1536000),
(1006, 'Vice President', 2048, 8191, 0.50, 358400, 0.10, 6144000),
(1007, 'Executive Vice President', 8192, 32767, 0.30, 860160, 0.10, 24576000),
(1008, 'Senior Vice President', 32768, 131072, 0.20, 2293760, 0.10, 98000000),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10000000000 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10000000000 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `PK_users` bigint(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(32) NOT NULL,
  `generatedmd5` varchar(32) NOT NULL,
  `loginattemp` int(1) NOT NULL,
  `lastlogin` datetime NOT NULL,
  `FK_userdata` bigint(11) NOT NULL,
  PRIMARY KEY (`PK_users`),
  KEY `FK_userdata` (`FK_userdata`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10000000000 ;

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
