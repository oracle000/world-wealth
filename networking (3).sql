-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 01, 2017 at 04:43 AM
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
-- Table structure for table `bankaccounts`
--

CREATE TABLE IF NOT EXISTS `bankaccounts` (
  `PK_bankaccounts` bigint(11) NOT NULL AUTO_INCREMENT,
  `FK_users` bigint(11) NOT NULL,
  `accountname` varchar(255) NOT NULL,
  `accountno` varchar(255) NOT NULL,
  PRIMARY KEY (`PK_bankaccounts`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `bankaccounts`
--

INSERT INTO `bankaccounts` (`PK_bankaccounts`, `FK_users`, `accountname`, `accountno`) VALUES
(1, 10000000000, 'Banko De Oro', '123456789'),
(2, 10000000000, 'UCPB', '987654321');

-- --------------------------------------------------------

--
-- Table structure for table `encashments`
--

CREATE TABLE IF NOT EXISTS `encashments` (
  `PK_encashments` bigint(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `FK_users` bigint(11) NOT NULL,
  `FK_encashtype` int(4) NOT NULL,
  `FK_encashstatus` int(4) NOT NULL,
  `FK_forexcode` varchar(5) NOT NULL,
  `amount` float(11,2) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`PK_encashments`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `encashments`
--

INSERT INTO `encashments` (`PK_encashments`, `timestamp`, `FK_users`, `FK_encashtype`, `FK_encashstatus`, `FK_forexcode`, `amount`, `datetime`) VALUES
(1, '2016-09-12 10:08:09', 10001, 1000, 1000, 'PHP', 10000.00, '2016-09-12 06:08:09');

-- --------------------------------------------------------

--
-- Table structure for table `encashstatus`
--

CREATE TABLE IF NOT EXISTS `encashstatus` (
  `PK_encashstatus` int(4) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` varchar(255) NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`PK_encashstatus`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1004 ;

--
-- Dumping data for table `encashstatus`
--

INSERT INTO `encashstatus` (`PK_encashstatus`, `timestamp`, `description`, `active`) VALUES
(1000, '2016-09-08 05:17:57', 'Pending', '1'),
(1002, '2016-09-08 05:18:00', 'On-process', '1'),
(1003, '2016-09-08 05:18:03', 'Done', '1');

-- --------------------------------------------------------

--
-- Table structure for table `encashtype`
--

CREATE TABLE IF NOT EXISTS `encashtype` (
  `PK_encashtype` int(4) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` varchar(255) NOT NULL,
  `active` enum('0','1') NOT NULL,
  PRIMARY KEY (`PK_encashtype`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1002 ;

--
-- Dumping data for table `encashtype`
--

INSERT INTO `encashtype` (`PK_encashtype`, `timestamp`, `description`, `active`) VALUES
(1000, '2016-09-08 05:15:13', 'Cash', '1'),
(1001, '2016-09-08 05:15:13', 'Check', '1');

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
(1000, 'Member', 0, 3, 0.00, 0, 0.02, 60000, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 60000.00, 24000.00, 18000.00, 18000.00),
(1001, 'Executive', 4, 15, 25.00, 35000, 0.50, 60000, 15000.00, 20000.00, 0.00, 0.00, 0.00, 0.00, 35000.00, 60000.00, 24000.00, 18000.00, 18000.00),
(1002, 'Bronze Executive', 16, 63, 5.00, 28000, 0.50, 240000, 15000.00, 12000.00, 6000.00, 0.00, 0.00, 600.00, 33600.00, 240000.00, 96000.00, 72000.00, 72000.00),
(1003, 'Silver Executive', 64, 127, 5.00, 112000, 0.50, 960000, 60000.00, 24000.00, 15000.00, 5000.00, 0.00, 8000.00, 112000.00, 960000.00, 384000.00, 288000.00, 288000.00),
(1004, 'Gold Executive', 128, 511, 5.00, 450000, 0.50, 1920000, 100000.00, 60000.00, 30000.00, 9000.00, 120000.00, 39400.00, 358400.00, 3840000.00, 1536000.00, 1152000.00, 1152000.00),
(1005, 'Platinum', 512, 2047, 1.00, 175000, 0.10, 1536000, 100000.00, 84000.00, 45000.00, 10000.00, 120000.00, -600.00, 358400.00, 12288000.00, 4915200.00, 3686400.00, 3686400.00),
(1006, 'Vice President', 2048, 8191, 0.50, 358400, 0.10, 6144000, 250000.00, 180000.00, 70000.00, 12000.00, 180000.00, 24800.00, 716800.00, 24576000.00, 9830400.00, 7372800.00, 7372800.00),
(1007, 'Executive Vice President', 8192, 32767, 0.30, 860160, 0.10, 24576000, 500000.00, 450000.00, 150000.00, 25000.00, 300000.00, 295320.00, 1720320.00, 49152000.00, 19660800.00, 14745600.00, 14745600.00),
(1008, 'Senior Vice President', 32768, 131072, 0.20, 2293760, 0.10, 98000000, 1000000.00, 1200000.00, 250000.00, 50000.00, 600000.00, 1487520.00, 4587520.00, 196608000.00, 78643200.00, 58982400.00, 58982400.00),
(1009, 'Director', 131072, 2147483647, 0.10, 4587520, 0.10, 393000000, 3000000.00, 3000000.00, 500000.00, 100000.00, 1000000.00, 1575040.00, 9175040.00, 393216000.00, 157286400.00, 117964800.00, 117964800.00);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `oldpass`
--

INSERT INTO `oldpass` (`PK_oldpass`, `FK_users`, `password`, `token`, `datetime`) VALUES
(1, 10000000003, 'a16f90b8ae826a3d1b751c609042a8a1', NULL, '2016-02-28 12:09:05'),
(2, 10000000003, 'cb849a1ea46b98b208480f22c4b53076', NULL, '2016-02-28 12:11:02'),
(3, 10000000000, 'a16f90b8ae826a3d1b751c609042a8a1', NULL, '2016-02-28 12:52:55'),
(4, 10001, 'a16f90b8ae826a3d1b751c609042a8a1', NULL, '2016-09-11 11:33:46');

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
  PRIMARY KEY (`PK_regdetails`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10010 ;

--
-- Dumping data for table `regdetails`
--

INSERT INTO `regdetails` (`PK_regdetails`, `FK_users`, `sponsorid`, `uplineid`, `datetime`) VALUES
(10000, 10000, 0, 0, '2016-02-27 00:00:00'),
(10001, 10001, 10000, 10000, '2016-03-29 03:35:45'),
(10002, 10002, 10000, 10001, '2016-03-29 03:38:50'),
(10003, 10003, 10000, 10001, '2016-03-29 03:45:37'),
(10004, 10004, 10000, 10001, '2016-03-29 03:47:45'),
(10005, 10005, 10000, 10003, '2016-03-29 03:48:45'),
(10006, 10006, 10001, 10004, '2016-03-29 04:06:39'),
(10007, 10007, 10000, 10000, '2016-09-13 06:42:50'),
(10008, 10008, 10002, 10002, '2016-09-13 06:47:21'),
(10009, 10009, 10001, 10001, '2016-09-13 07:13:11');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10010 ;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`PK_userdata`, `firstname`, `lastname`, `email`, `contactno`, `address`, `bdate`, `gender`) VALUES
(10000, 'Business', 'Founder', 'businessfounder@worldwealth.com', '09175340308', 'Tondo, Manila', '1994-01-13', 'M'),
(10001, 'Juan', 'Dela Cruz', 'Juandelacruz10311986@gmail.com', '', '', '1986-10-31', 'M'),
(10002, 'Peter', 'Panlilio', 'peterpan10311986@gmail.com', '', '', '1986-10-31', 'M'),
(10003, 'Christian', 'Asbestos', 'xtianasbestos@gmail.com', '', '', '1986-10-31', 'M'),
(10004, 'Adrian', 'Buhangin', 'adrianbuhangin@GMAIL.COM', '', '', '1986-10-31', 'M'),
(10005, 'Cherry', 'Politics', 'cherrypolitics@gmail.com', '', '', '1986-10-31', 'F'),
(10006, 'Jessibel', 'Adarna', 'emmanarrazola13-ww1@yahoo.com', '', '', '1986-10-31', 'F'),
(10007, 'Emman', 'Arrazola', 'esarrazola1@manilamed.com.ph', '', '', '1994-01-13', 'M'),
(10008, 'Emman', 'Arrazola', 'esarrazola2@manilamed.com.ph', '', '', '1994-01-13', 'M'),
(10009, 'Emman', 'Arrazola', 'esarrazola@manilamed.com.ph', '', '', '1994-01-13', 'M');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10010 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`PK_users`, `password`, `generatedmd5`, `loginattemp`, `lastlogin`, `FK_userdata`) VALUES
(10000, 'a16f90b8ae826a3d1b751c609042a8a1', '0', 0, '2016-09-02 20:25:27', 10000),
(10001, 'e10adc3949ba59abbe56e057f20f883e', '', 0, '2016-09-13 19:53:55', 10001),
(10002, 'df6f58808ebfd3e609c234cf2283a989', '', 0, '2016-03-29 16:41:13', 10002),
(10003, '00de69b66c07ef5fa49b125a59b0bdbe', '', 0, '0000-00-00 00:00:00', 10003),
(10004, '5b99a47891aade09810dbfd65391cf95', '', 0, '0000-00-00 00:00:00', 10004),
(10005, 'd2f8e350bfd7484cecfd9d295b9ccb44', '', 0, '0000-00-00 00:00:00', 10005),
(10006, '3207d2788974a3594d4472410d69c47d', '', 0, '2016-03-29 17:28:57', 10006),
(10007, '855a56e66f7a486b241bf1f52d092588', '', 0, '0000-00-00 00:00:00', 10007),
(10008, '7c6d6ec787c2ee93a870f31280ddaa6d', '', 0, '0000-00-00 00:00:00', 10008),
(10009, '7bcaebfa1d925e0200e40dc2ca0160b8', '', 0, '0000-00-00 00:00:00', 10009);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
