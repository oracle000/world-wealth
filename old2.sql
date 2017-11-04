-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2015 at 10:54 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10000000004 ;

--
-- Dumping data for table `regdetails`
--

INSERT INTO `regdetails` (`PK_regdetails`, `FK_users`, `sponsorid`, `uplineid`, `datetime`) VALUES
(10000000000, 10000000000, 0, 0, '2015-12-04 00:00:00'),
(10000000001, 10000000001, 10000000000, 10000000000, '2015-12-05 00:00:00'),
(10000000002, 10000000002, 10000000001, 10000000001, '2015-12-05 08:14:20'),
(10000000003, 10000000003, 10000000002, 10000000002, '2015-12-05 08:21:03');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `PK_status` int(4) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`PK_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1003 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`PK_status`, `description`) VALUES
(1000, 'For Email Confirmation'),
(1001, 'On Hold'),
(1002, 'Member');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10000000004 ;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`PK_userdata`, `firstname`, `lastname`, `email`, `contactno`, `address`, `bdate`, `gender`) VALUES
(10000000000, 'System', 'Administrator', 'harrymanadmin@gmail.com', '09175310308', 'Tondo, Manila', '1994-01-13', 'M'),
(10000000001, 'System', 'Developer', 'sysdev@gmail.com', '09175340308', 'Bldg 22 Unit 101 Vitas, Katuparan, Tondo, Manila', '1994-01-13', 'M'),
(10000000002, 'Emman', 'Arrazola', 'emmanarrazola@gmail.com', '09175340308', 'Bldg. 22 Unit 101 Vitas, Katuparan, Tondo, Manila', '1994-01-13', 'M'),
(10000000003, 'Emman', 'Arrazola', 'esarrazola@manilamed.com.ph', '09175340308', 'Bldg 22 Unit 101, Vitas, Katuparan, Tondo, Manila', '1994-01-13', 'M');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10000000004 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`PK_users`, `password`, `generatedmd5`, `loginattemp`, `FK_userdata`) VALUES
(10000000000, '90f2c9c53f66540e67349e0ab83d8cd0', '', 0, 10000000000),
(10000000001, '90f2c9c53f66540e67349e0ab83d8cd0', '', 0, 10000000001),
(10000000002, 'd7c56cfdfe6f8a0b8680813ff5682949', '', 0, 10000000002),
(10000000003, '5eb04891769467feb4377f51e72d751e', '', 0, 10000000003);

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
