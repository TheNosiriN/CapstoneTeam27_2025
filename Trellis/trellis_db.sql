-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 21, 2025 at 12:07 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trellis_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `departure_station` varchar(100) NOT NULL,
  `destination_station` varchar(100) NOT NULL,
  `travel_date` date NOT NULL,
  `status` enum('Pending','Confirmed','Scheduled','Cancelled','Waiting','Accepted','Boarded') DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `travel_time` time NOT NULL,
  `arrival_time` int(32) NOT NULL DEFAULT 0,
  PRIMARY KEY (`booking_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `departure_station`, `destination_station`, `travel_date`, `status`, `created_at`, `travel_time`, `arrival_time`) VALUES
(1, 2, 'Station1', 'Station3', '2025-02-10', 'Confirmed', '2025-03-09 05:27:20', '00:00:00', 0),
(2, 1, 'Station2', 'Station3', '2025-03-27', 'Confirmed', '2025-03-09 17:32:02', '00:00:00', 0),
(3, 1, 'Station2', 'Station4', '2025-03-10', 'Confirmed', '2025-03-09 21:51:32', '00:00:00', 0),
(4, 1, 'Station3', 'Station5', '2025-03-13', 'Confirmed', '2025-03-09 23:13:02', '00:00:00', 0),
(5, 1, 'Station3', 'Station8', '2025-03-21', 'Confirmed', '2025-03-12 19:30:46', '00:00:00', 0),
(6, 1, 'Station4', 'Station6', '2025-03-13', 'Confirmed', '2025-03-12 20:17:43', '00:00:00', 0),
(7, 1, 'Station1', 'Station5', '2025-03-10', 'Confirmed', '2025-03-20 23:41:45', '12:00:00', 0),
(8, 1, 'Station3', 'Station5', '2025-03-02', 'Confirmed', '2025-03-20 23:45:24', '11:45:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `birthday` date NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone_number`, `birthday`, `created_at`, `is_admin`) VALUES
(1, 'Kris', 'Biswa', 'kris@example.com', '$2y$10$NmDnzg55ixD0znTlqeGBkuM.6hOHj7DrhVWyjsVtm5u0X6bEr0mrq', '1234567890', '2002-06-20', '2025-02-09 23:10:28', 0),
(2, 'Admin', 'User', 'trellisAdmin@gmail.com', '$2y$10$n0pl./aZH9Q5dlQHbEL/Fe/zE9JvCS1ynJOkOXvqR6cTCrJtZSB1W', '1234567890', '1990-01-01', '2025-02-10 00:44:51', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
