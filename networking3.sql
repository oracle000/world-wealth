-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 29, 2016 at 02:39 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `networking3`
--

-- --------------------------------------------------------

--
-- Table structure for table `bankaccounts`
--

CREATE TABLE IF NOT EXISTS `bankaccounts` (
  `PK_bankaccounts` bigint(11) NOT NULL AUTO_INCREMENT,
  `FK_users` bigint(11) NOT NULL,
  `accountname` varchar(255) NOT NULL,
  `accountno` varchar(255) NOT NULL,
  PRIMARY KEY (`PK_bankaccounts`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1011 ;

--
-- Dumping data for table `bankaccounts`
--

INSERT INTO `bankaccounts` (`PK_bankaccounts`, `FK_users`, `accountname`, `accountno`) VALUES
(1001, 10000000000, 'Banko De Oro', '20-21896297-1'),
(1010, 10000000000, 'UCPB', '12-09123412-9');

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE IF NOT EXISTS `cms` (
  `PK_cms` bigint(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `style` varchar(255) NOT NULL,
  `src` varchar(255) NOT NULL,
  `lastedit` datetime NOT NULL,
  `FK_usersedit` bigint(11) NOT NULL,
  PRIMARY KEY (`PK_cms`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1001 ;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`PK_cms`, `id`, `description`, `type`, `value`, `style`, `src`, `lastedit`, `FK_usersedit`) VALUES
(1000, 'tagline', 'Home Page Tag Line', 'Label', 'We empower visionaries to lead meaningful brands.', '', '', '0000-00-00 00:00:00', 0);

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
  `equivamount` float(11,2) NOT NULL,
  `serviceincome` float(5,2) NOT NULL,
  `equivamount1` float(11,2) NOT NULL,
  `property` float(11,2) NOT NULL,
  `cash` float(11,2) NOT NULL,
  `holiday` float(11,2) NOT NULL,
  `charity` float(11,2) NOT NULL,
  `car` float(11,2) NOT NULL,
  `others` float(11,2) NOT NULL,
  `total` float(11,2) NOT NULL,
  `percent1` float(11,2) NOT NULL,
  `percent2` float(11,2) NOT NULL,
  `percent3` float(11,2) NOT NULL,
  `investment` float(11,2) NOT NULL,
  PRIMARY KEY (`PK_matrix`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1010 ;

--
-- Dumping data for table `matrix`
--

INSERT INTO `matrix` (`PK_matrix`, `description`, `min`, `max`, `memberpercent`, `equivamount`, `serviceincome`, `equivamount1`, `property`, `cash`, `holiday`, `charity`, `car`, `others`, `total`, `percent1`, `percent2`, `percent3`, `investment`) VALUES
(1000, 'Member', 0, 3, 0.00, 0.00, 0.02, 60000.00, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 60000.00, 24000.00, 18000.00, 18000.00),
(1001, 'Executive', 4, 15, 25.00, 35000.00, 0.50, 60000.00, 15000.00, 20000.00, 0.00, 0.00, 0.00, 0.00, 35000.00, 60000.00, 24000.00, 18000.00, 18000.00),
(1002, 'Bronze Executive', 16, 63, 5.00, 28000.00, 0.50, 240000.00, 15000.00, 12000.00, 6000.00, 0.00, 0.00, 600.00, 33600.00, 240000.00, 96000.00, 72000.00, 72000.00),
(1003, 'Silver Executive', 64, 127, 5.00, 112000.00, 0.50, 960000.00, 60000.00, 24000.00, 15000.00, 5000.00, 0.00, 8000.00, 112000.00, 960000.00, 384000.00, 288000.00, 288000.00),
(1004, 'Gold Executive', 128, 511, 5.00, 450000.00, 0.50, 1920000.00, 100000.00, 60000.00, 30000.00, 9000.00, 120000.00, 39400.00, 358400.00, 3840000.00, 1536000.00, 1152000.00, 1152000.00),
(1005, 'Platinum', 512, 2047, 1.00, 175000.00, 0.10, 1536000.00, 100000.00, 84000.00, 45000.00, 10000.00, 120000.00, -600.00, 358400.00, 12288000.00, 4915200.00, 3686400.00, 3686400.00),
(1006, 'Vice President', 2048, 8191, 0.50, 358400.00, 0.10, 6144000.00, 250000.00, 180000.00, 70000.00, 12000.00, 180000.00, 24800.00, 716800.00, 24576000.00, 9830400.00, 7372800.00, 7372800.00),
(1007, 'Executive Vice President', 8192, 32767, 0.30, 860160.00, 0.10, 24576000.00, 500000.00, 450000.00, 150000.00, 25000.00, 300000.00, 295320.00, 1720320.00, 49152000.00, 19660800.00, 14745600.00, 14745600.00),
(1008, 'Senior Vice President', 32768, 131072, 0.20, 2293760.00, 0.10, 98000000.00, 1000000.00, 1200000.00, 250000.00, 50000.00, 600000.00, 1487520.00, 4587520.00, 196608000.00, 78643200.00, 58982400.00, 58982400.00),
(1009, 'Director', 131072, 2147483647, 0.10, 4587520.00, 0.10, 393000000.00, 3000000.00, 3000000.00, 500000.00, 100000.00, 1000000.00, 1575040.00, 9175040.00, 393216000.00, 157286400.00, 117964800.00, 117964800.00);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `oldpass`
--

INSERT INTO `oldpass` (`PK_oldpass`, `FK_users`, `password`, `token`, `datetime`) VALUES
(1, 10000000003, 'a16f90b8ae826a3d1b751c609042a8a1', NULL, '2016-02-28 12:09:05'),
(2, 10000000003, 'cb849a1ea46b98b208480f22c4b53076', NULL, '2016-02-28 12:11:02'),
(3, 10000000000, 'a16f90b8ae826a3d1b751c609042a8a1', NULL, '2016-02-28 12:52:55'),
(4, 10000000001, 'a16f90b8ae826a3d1b751c609042a8a1', NULL, '2016-04-03 14:59:28'),
(5, 10000000001, '04103408de1071e7f8a165ad0d04487a', NULL, '2016-04-03 15:12:12'),
(6, 10000000000, 'a16f90b8ae826a3d1b751c609042a8a1', NULL, '2016-08-29 18:50:11'),
(7, 10000000000, 'cb849a1ea46b98b208480f22c4b53076', NULL, '2016-08-29 19:00:23');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10000000007 ;

--
-- Dumping data for table `regdetails`
--

INSERT INTO `regdetails` (`PK_regdetails`, `FK_users`, `sponsorid`, `uplineid`, `datetime`) VALUES
(10000000000, 10000000000, 0, 0, '2016-02-27 00:00:00'),
(10000000001, 10000000001, 10000000000, 10000000000, '2016-03-29 03:35:45'),
(10000000002, 10000000002, 10000000000, 10000000001, '2016-03-29 03:38:50'),
(10000000003, 10000000003, 10000000000, 10000000001, '2016-03-29 03:45:37'),
(10000000004, 10000000004, 10000000000, 10000000001, '2016-03-29 03:47:45'),
(10000000005, 10000000005, 10000000000, 10000000001, '2016-03-29 03:48:45'),
(10000000006, 10000000006, 10000000001, 10000000002, '2016-03-29 04:06:39');

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
-- Table structure for table `systemusers`
--

CREATE TABLE IF NOT EXISTS `systemusers` (
  `PK_systemusers` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(2) NOT NULL,
  `FK_usergroups` int(4) NOT NULL,
  `lastlogon` datetime NOT NULL,
  `isactive` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`PK_systemusers`)
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10000000007 ;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`PK_userdata`, `firstname`, `lastname`, `email`, `contactno`, `address`, `bdate`, `gender`) VALUES
(10000000000, 'Business', 'Founder', 'businessfounder@worldwealth.com', '09175340308', 'Tondo, Manila', '1994-01-13', 'M'),
(10000000001, 'Juan', 'Dela Cruz', 'Juandelacruz10311986@gmail.com', '2520157', '', '1986-10-31', 'M'),
(10000000002, 'Peter', 'Panlilio', 'peterpan10311986@gmail.com', '', '', '1986-10-31', 'M'),
(10000000003, 'Christian', 'Asbestos', 'xtianasbestos@gmail.com', '', '', '1986-10-31', 'M'),
(10000000004, 'Adrian', 'Buhangin', 'adrianbuhangin@GMAIL.COM', '', '', '1986-10-31', 'M'),
(10000000005, 'Cherry', 'Politics', 'cherrypolitics@gmail.com', '', '', '1986-10-31', 'F'),
(10000000006, 'Jessibel', 'Adarna', 'emmanarrazola13-ww1@yahoo.com', '', '', '1986-10-31', 'F');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10000000007 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`PK_users`, `password`, `generatedmd5`, `loginattemp`, `lastlogin`, `FK_userdata`) VALUES
(10000000000, 'e10adc3949ba59abbe56e057f20f883e', '0', 0, '2016-08-29 17:26:49', 10000000000),
(10000000001, 'a16f90b8ae826a3d1b751c609042a8a1', '', 0, '2016-08-29 17:27:02', 10000000001),
(10000000002, 'df6f58808ebfd3e609c234cf2283a989', '', 0, '2016-03-29 16:41:13', 10000000002),
(10000000003, '00de69b66c07ef5fa49b125a59b0bdbe', '', 0, '0000-00-00 00:00:00', 10000000003),
(10000000004, '5b99a47891aade09810dbfd65391cf95', '', 0, '0000-00-00 00:00:00', 10000000004),
(10000000005, 'd2f8e350bfd7484cecfd9d295b9ccb44', '', 0, '0000-00-00 00:00:00', 10000000005),
(10000000006, '3207d2788974a3594d4472410d69c47d', '', 0, '2016-03-29 17:28:57', 10000000006);

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
