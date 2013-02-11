-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2013 at 09:29 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `imonit_a`
--

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE IF NOT EXISTS `driver` (
  `driver_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `middle_name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password_hint` varchar(50) NOT NULL,
  `security_question` bigint(20) DEFAULT NULL,
  `security_answer` varchar(40) DEFAULT NULL,
  `mobile_phone` varchar(20) NOT NULL,
  `business_phone` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `referral` int(11) NOT NULL,
  `preffered_areas` set('צפון','מרכז','דרום','כל הארץ') CHARACTER SET hebrew NOT NULL DEFAULT 'כל הארץ',
  `sync_google_calendar` tinyint(1) NOT NULL DEFAULT '0',
  `sync_outlokk_calendar` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`driver_id`),
  KEY `driver_id` (`driver_id`),
  KEY `driver_id_2` (`driver_id`),
  KEY `security_question` (`security_question`),
  KEY `referral` (`referral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `security_question`
--

CREATE TABLE IF NOT EXISTS `security_question` (
  `question_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `question` varchar(128) NOT NULL,
  PRIMARY KEY (`question_id`),
  KEY `question_id` (`question_id`),
  KEY `question_id_2` (`question_id`),
  KEY `question_id_3` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `driver`
--
ALTER TABLE `driver`
  ADD CONSTRAINT `driver_ibfk_1` FOREIGN KEY (`security_question`) REFERENCES `security_question` (`question_id`),
  ADD CONSTRAINT `driver_ibfk_2` FOREIGN KEY (`referral`) REFERENCES `driver` (`driver_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
