DROP SCHEMA IF EXISTS hybrid;
CREATE SCHEMA hybrid;
USE hybrid;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `Admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_type_id` int(11) DEFAULT '3',
  `login` datetime NOT NULL,
  PRIMARY KEY (`admin_id`),
  KEY `user_type_id` (`user_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `Comments` (
  `cid` int(100) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `event_id` int(100) NOT NULL,
  `date` datetime NOT NULL,
  `comments` varchar(255) NOT NULL,
  `ip_add` varchar(255) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=142 ;


CREATE TABLE IF NOT EXISTS `Company` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `eircode` varchar(7) DEFAULT NULL,
  `rep_first_name` varchar(100) NOT NULL,
  `rep_last_name` varchar(100) NOT NULL,
  `rep_email` varchar(100) NOT NULL,
  `rep_phone` varchar(100) DEFAULT NULL,
  `user_type_id` int(11) DEFAULT '2',
  `password_enc` blob NOT NULL,
  `created_on` datetime NOT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`company_id`),
  KEY `user_type_id` (`user_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;


CREATE TABLE IF NOT EXISTS `Customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_home` varchar(50) DEFAULT NULL,
  `phone_mobile` varchar(50) DEFAULT NULL,
  `user_type_id` int(11) DEFAULT '1',
  `password_enc` blob NOT NULL,
  `created_on` datetime NOT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`customer_id`),
  KEY `user_type_id` (`user_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;


CREATE TABLE IF NOT EXISTS `Event` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `event_name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `event_address1` varchar(255) NOT NULL,
  `event_address2` varchar(255) DEFAULT NULL,
  `event_city` varchar(50) DEFAULT NULL,
  `event_eircode` varchar(50) DEFAULT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time DEFAULT NULL,
  PRIMARY KEY (`event_id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;


CREATE TABLE IF NOT EXISTS `Save_Event` (
  `save_event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`save_event_id`),
  KEY `event_id` (`event_id`),
  KEY `customer_id` (`customer_id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;


CREATE TABLE IF NOT EXISTS `Services` (
  `sid` int(100) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=102 ;

INSERT INTO `Services` (`sid`, `title`, `description`, `date`) VALUES
(100, 'Free Money', 'We are giving free money', '2006-11-12 12:12:12'),
(101, 'Free blanket', 'We Provide free accomodation and blanket to old people', '2009-01-12 12:12:12');


CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`id`, `uid`, `pwd`) VALUES
(1, 'admin', '123');

CREATE TABLE IF NOT EXISTS `User_Type` (
  `user_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` enum('Customer','Company','Admin') NOT NULL,
  PRIMARY KEY (`user_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;


INSERT INTO `User_Type` (`user_type_id`, `name`) VALUES
(1, 'Customer'),
(2, 'Company'),
(3, 'Admin');

ALTER TABLE `Admin`
  ADD CONSTRAINT `Admin_ibfk_1` FOREIGN KEY (`user_type_id`) REFERENCES `User_Type` (`user_type_id`);

ALTER TABLE `Company`
  ADD CONSTRAINT `Company_ibfk_1` FOREIGN KEY (`user_type_id`) REFERENCES `User_Type` (`user_type_id`);

ALTER TABLE `Customer`
  ADD CONSTRAINT `Customer_ibfk_1` FOREIGN KEY (`user_type_id`) REFERENCES `User_Type` (`user_type_id`);

ALTER TABLE `Event`
  ADD CONSTRAINT `Event_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `Company` (`company_id`);

ALTER TABLE `Save_Event`
  ADD CONSTRAINT `Save_Event_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `Event` (`event_id`),
  ADD CONSTRAINT `Save_Event_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `Customer` (`customer_id`),
  ADD CONSTRAINT `Save_Event_ibfk_3` FOREIGN KEY (`company_id`) REFERENCES `Company` (`company_id`);
