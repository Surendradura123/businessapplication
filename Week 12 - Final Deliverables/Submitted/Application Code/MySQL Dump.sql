-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2018 at 03:57 PM
-- Server version: 5.5.57-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hybrid`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE IF NOT EXISTS `Admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_type_id` int(11) DEFAULT '3',
  `login` datetime NOT NULL,
  PRIMARY KEY (`admin_id`),
  KEY `user_type_id` (`user_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`admin_id`, `full_name`, `email`, `user_type_id`, `login`) VALUES
(1, 'Admin', 'admin@hybridweb.com', 3, '1970-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE IF NOT EXISTS `Comments` (
  `cid` int(100) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `event_id` int(100) NOT NULL,
  `date` datetime NOT NULL,
  `comments` varchar(255) NOT NULL,
  `ip_add` varchar(255) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=142 ;

--
-- Dumping data for table `Comments`
--

INSERT INTO `Comments` (`cid`, `email`, `event_id`, `date`, `comments`, `ip_add`) VALUES
(138, 'suren.dura@yahoo.com', 11, '2018-07-13 11:31:41', 'Great website!', '193.1.209.155'),
(139, 'suren.dura@yahoo.com', 16, '2018-07-13 14:10:59', 'Love this!', '193.1.209.155'),
(140, 'suren.dura@yahoo.com', 16, '2018-07-13 14:14:45', 'Great!', '193.1.209.155'),
(141, '123company@gmail.com', 17, '2018-07-16 13:36:31', 'So much fun!', '193.1.209.155');

-- --------------------------------------------------------

--
-- Table structure for table `Company`
--

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

--
-- Dumping data for table `Company`
--

INSERT INTO `Company` (`company_id`, `name`, `address1`, `address2`, `city`, `eircode`, `rep_first_name`, `rep_last_name`, `rep_email`, `rep_phone`, `user_type_id`, `password_enc`, `created_on`, `ip_address`) VALUES
(2, 'TestCompanyName', '1 Test Street', 'Dublin', 'Dublin', 'D01AB12', 'Company', 'Test', 'company@test.com', '019876543', 2, 0x544a6c7a465a4f3151617842505869314662385079513d3d, '2018-07-04 11:01:45', '193.1.209.155'),
(4, '123Company', '123Street', '123Road', 'Dublin', 'qweqweq', '123', 'Company', '123company@gmail.com', '0871123123', 2, 0x304e474f3548757675635945716c6d636e4846474b773d3d, '2018-07-05 16:45:38', '193.1.209.155'),
(5, 'Dura123', '62 Adelaide road', '', 'Dublin', 'D02HFEP', 'Surendra2', 'Dura2', 'x15007669@student.ncirl.ie', '089966774', 2, 0x4e6c4e61513536493371716b68314b6d6d3263452f673d3d, '2018-07-09 11:46:08', '193.1.209.155');

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

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

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`customer_id`, `first_name`, `last_name`, `email`, `phone_home`, `phone_mobile`, `user_type_id`, `password_enc`, `created_on`, `ip_address`) VALUES
(3, 'Surendra', 'Dura', 'suren.dura@yahoo.com', '089966774', '0899666774', 1, 0x4e6c4e61513536493371716b68314b6d6d3263452f673d3d, '2018-07-05 08:11:02', '193.1.209.155'),
(4, 'Customer', 'Test', 'customer@test.com', '014785236', '0833333333', 1, 0x544a6c7a465a4f3151617842505869314662385079513d3d, '2018-07-13 11:03:19', '193.1.209.155');

-- --------------------------------------------------------

--
-- Table structure for table `Event`
--

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

--
-- Dumping data for table `Event`
--

INSERT INTO `Event` (`event_id`, `company_id`, `event_name`, `description`, `event_address1`, `event_address2`, `event_city`, `event_eircode`, `date`, `start_time`, `end_time`) VALUES
(1, 2, 'Park', 'A day out in the Park. Food stand and performances on the day. ', 'Marlay Park', 'Dublin', 'Dublin', 'D123456', '2019-09-09', '09:00:00', '19:00:00'),
(4, 4, 'Swimming', 'Swimming lessons from 10am - 2pm. Free Swim from 2pm - 6pm.', 'Store Street Gym', '', 'Dublin', '', '2018-10-17', '10:00:00', '18:00:00'),
(5, 4, 'Day Trip to Kells', 'Daily Heritage Tours of The Heritage Town of Kells\r\n\r\nThe monastic site in Kells is considered by many historians to be one of the most important monastic sites in Ireland. \r\n\r\nIt is on the tentative list for consideration as a World Heritage Site.\r\n\r\n\r\n', 'The Kells Experience', 'Carlanstown, Kells', 'Meath', '', '2018-08-15', '10:00:00', '20:00:00'),
(6, 4, 'Dublin Bus Tours', 'DoDublin is Dublin''s No.1 Sightseeing Tour since 1988. Our tours are the best value, most comfortable and most enjoyable way to see Dublin city.', 'Pick up from College Green outside Ulster Bank', '', 'Dublin', '', '2019-07-20', '12:00:00', '20:00:00'),
(11, 2, 'Learn Computing', 'Over the summer, we are hosting IT Lessons for people over the age of 50. Classes are from 2pm and 7pm every Wednesday for 10 weeks. ', 'National College of Ireland', 'Mayor Street', 'Dublin', 'D01AB23', '2018-07-24', '14:00:00', '21:00:00'),
(12, 4, 'Tea Mornings', 'At Fusion, we are hosting tea mornings for 2 weeks from 9am to noon. We are raising money for Trocaire.', 'Fusion at the National College of Ireland', 'Mayor Street', 'Dublin', 'D01AB23', '2018-09-12', '09:00:00', '12:00:00'),
(13, 4, 'Arts and Crafts evening', 'Bring out the creative side of you. We will be hosting Arts and Crafts evening where will will paint and make things. The only thing stopping you is your imagination.', 'St. Andrew''s Community School', 'Errigal Street', 'Galway', 'G12QA12', '2018-07-16', '18:30:00', '21:30:00'),
(14, 4, 'Outdoor movies', 'Showing 3 classic movies. Go to outdoormovies.ie/vote to vote for the movies you would like to see and the top 3 will be shown on the night on massive screen. Comfy seating and refreshments provided.', 'Phoenix Park', '', 'Dublin', '', '2018-07-24', '19:00:00', '23:00:00'),
(15, 4, ' Friends of the Elderly Party', 'At Friends of the Elderly we believe that every older member deserves a break from their home, if only for a day out. Every year we organise a series of one day outings for our older members. Our wonderful volunteers look after our their older friends’ ev', '3Arena', '', 'Dublin', '', '2018-07-24', '13:00:00', '22:00:00'),
(16, 4, 'Leprechaun Museum ', 'Folklore made fun, an oral storytelling experience taking you on a trip to the Otherworld, home of leprechauns and other mythical creatures.\r\nIn the heart of Dublin, somewhere between bars and buskers, not far off the tram, there is a small place of fun a', 'National Leprechaun Museum', 'Jervis Street', 'Dublin', '', '2018-07-16', '16:00:00', '18:00:00'),
(17, 4, 'Shopping Trip to London', 'London’s newest shopping and dining destination, St Martin’s Courtyard is a beautiful open-air courtyard located in the heart of Covent Garden. This urban oasis offers an array of unique shops, restaurants and experiences.\r\n\r\nDiscover contemporary boutiqu', 'Pick up from Bank of Ireland, College Green opposite Ulster Bank.', '', 'Dublin', '', '2018-07-31', '06:30:00', '23:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `Save_Event`
--

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

--
-- Dumping data for table `Save_Event`
--

INSERT INTO `Save_Event` (`save_event_id`, `event_id`, `customer_id`, `company_id`, `customer_email`, `date`, `status`) VALUES
(24, 5, 3, 4, 'suren.dura@yahoo.com', '2018-07-11 12:38:26', 'APPROVED'),
(33, 17, 3, 4, 'suren.dura@yahoo.com', '2018-07-16 13:05:10', 'Refused');

-- --------------------------------------------------------

--
-- Table structure for table `Services`
--

CREATE TABLE IF NOT EXISTS `Services` (
  `sid` int(100) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=102 ;

--
-- Dumping data for table `Services`
--

INSERT INTO `Services` (`sid`, `title`, `description`, `date`) VALUES
(100, 'Free Money', 'We are giving free money', '2006-11-12 12:12:12'),
(101, 'Free blanket', 'We Provide free accomodation and blanket to old people', '2009-01-12 12:12:12');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `uid`, `pwd`) VALUES
(1, 'admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `User_Type`
--

CREATE TABLE IF NOT EXISTS `User_Type` (
  `user_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` enum('Customer','Company','Admin') NOT NULL,
  PRIMARY KEY (`user_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `User_Type`
--

INSERT INTO `User_Type` (`user_type_id`, `name`) VALUES
(1, 'Customer'),
(2, 'Company'),
(3, 'Admin');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Admin`
--
ALTER TABLE `Admin`
  ADD CONSTRAINT `Admin_ibfk_1` FOREIGN KEY (`user_type_id`) REFERENCES `User_Type` (`user_type_id`);

--
-- Constraints for table `Company`
--
ALTER TABLE `Company`
  ADD CONSTRAINT `Company_ibfk_1` FOREIGN KEY (`user_type_id`) REFERENCES `User_Type` (`user_type_id`);

--
-- Constraints for table `Customer`
--
ALTER TABLE `Customer`
  ADD CONSTRAINT `Customer_ibfk_1` FOREIGN KEY (`user_type_id`) REFERENCES `User_Type` (`user_type_id`);

--
-- Constraints for table `Event`
--
ALTER TABLE `Event`
  ADD CONSTRAINT `Event_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `Company` (`company_id`);

--
-- Constraints for table `Save_Event`
--
ALTER TABLE `Save_Event`
  ADD CONSTRAINT `Save_Event_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `Event` (`event_id`),
  ADD CONSTRAINT `Save_Event_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `Customer` (`customer_id`),
  ADD CONSTRAINT `Save_Event_ibfk_3` FOREIGN KEY (`company_id`) REFERENCES `Company` (`company_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
