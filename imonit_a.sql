-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2013 at 05:41 PM
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
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `street` varchar(30) NOT NULL,
  `number` int(11) NOT NULL,
  `city` varchar(30) NOT NULL,
  `p_o_box` int(11) DEFAULT NULL,
  `zip_code` int(11) DEFAULT NULL,
  `free_text` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`address_id`),
  KEY `address_id` (`address_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `middle_name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password_md5` varchar(64) NOT NULL,
  `password_hint` varchar(50) NOT NULL,
  `security_question` bigint(20) DEFAULT NULL,
  `security_answer` varchar(40) DEFAULT NULL,
  `mobile_phone` varchar(20) NOT NULL,
  `home_phone` varchar(20) DEFAULT NULL,
  `business_phone` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `address_1_name` varchar(30) DEFAULT NULL,
  `address_1_id` int(11) NOT NULL,
  `address_2_name` varchar(30) DEFAULT NULL,
  `address_2_id` int(11) DEFAULT NULL,
  `sync_google_calendar` tinyint(1) NOT NULL DEFAULT '0',
  `sync_outlokk_calendar` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`customer_id`),
  KEY `driver_id` (`customer_id`),
  KEY `driver_id_2` (`customer_id`),
  KEY `security_question` (`security_question`),
  KEY `customer_id` (`customer_id`),
  KEY `address_1_id` (`address_1_id`),
  KEY `address_2_id` (`address_2_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `password_md5` varchar(64) NOT NULL,
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
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by_driver` int(11) DEFAULT NULL,
  `created_by_customer` int(11) DEFAULT NULL,
  `state` set('created','cancelled','routed_for_bid','routed_for_approval','approved','pending_execution','done') NOT NULL DEFAULT 'created',
  PRIMARY KEY (`order_id`),
  KEY `created_by` (`created_by_driver`),
  KEY `created_by_customer` (`created_by_customer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `order2passenger`
--

CREATE TABLE IF NOT EXISTS `order2passenger` (
  `order_id` int(11) NOT NULL,
  `passenger_id` int(11) NOT NULL,
  `pickup_time` datetime DEFAULT NULL,
  `pickup_address` int(11) NOT NULL,
  `dropoff_time` datetime DEFAULT NULL,
  `dropoff_address` int(11) NOT NULL,
  `num_of_passengers` int(11) NOT NULL DEFAULT '1',
  KEY `order_id` (`order_id`,`passenger_id`),
  KEY `passenger_id` (`passenger_id`),
  KEY `passenger_id_2` (`passenger_id`),
  KEY `passenger_id_3` (`passenger_id`),
  KEY `pickup_address` (`pickup_address`),
  KEY `dropoff_address` (`dropoff_address`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_event`
--

CREATE TABLE IF NOT EXISTS `order_event` (
  `order_event_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `event_description` varchar(128) NOT NULL,
  `old_value` varchar(128) DEFAULT NULL,
  `new_value` varchar(128) DEFAULT NULL,
  `event_created_by_customer` int(11) DEFAULT NULL,
  `event_created_by_driver` int(11) DEFAULT NULL,
  `event_time` datetime NOT NULL,
  PRIMARY KEY (`order_event_id`),
  KEY `order_id` (`order_id`),
  KEY `event_created_by_customer` (`event_created_by_customer`),
  KEY `event_created_by_driver` (`event_created_by_driver`)
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
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`security_question`) REFERENCES `driver` (`security_question`),
  ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`address_1_id`) REFERENCES `address` (`address_id`),
  ADD CONSTRAINT `customer_ibfk_3` FOREIGN KEY (`address_2_id`) REFERENCES `address` (`address_id`);

--
-- Constraints for table `driver`
--
ALTER TABLE `driver`
  ADD CONSTRAINT `driver_ibfk_1` FOREIGN KEY (`security_question`) REFERENCES `security_question` (`question_id`),
  ADD CONSTRAINT `driver_ibfk_2` FOREIGN KEY (`referral`) REFERENCES `driver` (`driver_id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`created_by_driver`) REFERENCES `driver` (`driver_id`),
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`created_by_customer`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `order2passenger`
--
ALTER TABLE `order2passenger`
  ADD CONSTRAINT `order2passenger_ibfk_4` FOREIGN KEY (`dropoff_address`) REFERENCES `address` (`address_id`),
  ADD CONSTRAINT `order2passenger_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`),
  ADD CONSTRAINT `order2passenger_ibfk_2` FOREIGN KEY (`passenger_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `order2passenger_ibfk_3` FOREIGN KEY (`pickup_address`) REFERENCES `address` (`address_id`);

--
-- Constraints for table `order_event`
--
ALTER TABLE `order_event`
  ADD CONSTRAINT `order_event_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`),
  ADD CONSTRAINT `order_event_ibfk_2` FOREIGN KEY (`event_created_by_customer`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `order_event_ibfk_3` FOREIGN KEY (`event_created_by_driver`) REFERENCES `driver` (`driver_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
