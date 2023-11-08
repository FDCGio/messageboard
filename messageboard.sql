-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 08, 2023 at 07:47 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `messageboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified_ip` varbinary(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `user1`, `user2`, `created`, `modified_ip`) VALUES
(1, 2, 1, '2023-11-08 13:18:51', NULL),
(2, 3, 1, '2023-11-08 13:19:05', NULL),
(3, 4, 1, '2023-11-08 13:19:17', NULL),
(4, 5, 1, '2023-11-08 13:19:29', NULL),
(5, 6, 1, '2023-11-08 13:19:45', NULL),
(6, 7, 1, '2023-11-08 13:20:00', NULL),
(7, 8, 1, '2023-11-08 13:20:36', 0x3a3a31),
(8, 9, 1, '2023-11-08 13:20:49', 0x3a3a31);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `message_text` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL,
  `created_ip` varbinary(255) NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `conversation_id`, `message_text`, `created`, `updated`, `created_ip`, `is_read`) VALUES
(1, 2, 1, 1, 'aadsfas', '2023-11-08 13:18:51', '2023-11-08 13:18:51', 0x3a3a31, 0),
(2, 3, 1, 2, 'qwewqe', '2023-11-08 13:19:05', '2023-11-08 13:19:05', 0x3a3a31, 0),
(3, 4, 1, 3, 'qqqq', '2023-11-08 13:19:17', '2023-11-08 13:19:17', 0x3a3a31, 0),
(4, 5, 1, 4, 'aa', '2023-11-08 13:19:29', '2023-11-08 13:19:29', 0x3a3a31, 0),
(5, 6, 1, 5, 'aaa', '2023-11-08 13:19:45', '2023-11-08 13:19:45', 0x3a3a31, 0),
(6, 7, 1, 6, 'qweqwe', '2023-11-08 13:20:00', '2023-11-08 13:20:00', 0x3a3a31, 0),
(7, 8, 1, 7, 'asdfasdf', '2023-11-08 13:20:36', '2023-11-08 13:20:36', 0x3a3a31, 0),
(8, 9, 1, 8, 'qqqq', '2023-11-08 13:20:49', '2023-11-08 13:20:49', 0x3a3a31, 0),
(9, 1, 9, 8, 'asdsad', '2023-11-08 13:56:18', '2023-11-08 13:56:18', 0x3a3a31, 0),
(10, 1, 9, 8, 'asd', '2023-11-08 13:56:18', '2023-11-08 13:56:18', 0x3a3a31, 0),
(11, 1, 9, 8, 'asd', '2023-11-08 13:56:19', '2023-11-08 13:56:19', 0x3a3a31, 0),
(12, 1, 9, 8, 'ads', '2023-11-08 13:56:19', '2023-11-08 13:56:19', 0x3a3a31, 0),
(13, 1, 9, 8, 'asdfadsf', '2023-11-08 14:02:05', '2023-11-08 14:02:05', 0x3a3a31, 0),
(14, 1, 8, 7, 'asdf', '2023-11-08 14:04:16', '2023-11-08 14:04:16', 0x3a3a31, 0),
(15, 1, 8, 7, 'sadfads', '2023-11-08 14:04:46', '2023-11-08 14:04:46', 0x3a3a31, 0),
(16, 1, 9, 8, 'asdfasdf', '2023-11-08 14:05:25', '2023-11-08 14:05:25', 0x3a3a31, 0),
(17, 1, 8, 7, '', '2023-11-08 14:05:34', '2023-11-08 14:05:34', 0x3a3a31, 0),
(18, 1, 8, 7, 'asdf', '2023-11-08 14:09:32', '2023-11-08 14:09:32', 0x3a3a31, 0),
(19, 1, 8, 7, 'fadfdassd', '2023-11-08 14:11:26', '2023-11-08 14:11:26', 0x3a3a31, 0),
(20, 1, 8, 7, '', '2023-11-08 14:11:28', '2023-11-08 14:11:28', 0x3a3a31, 0),
(21, 1, 8, 7, '', '2023-11-08 14:11:29', '2023-11-08 14:11:29', 0x3a3a31, 0),
(22, 1, 8, 7, 'adfaf', '2023-11-08 14:11:54', '2023-11-08 14:11:54', 0x3a3a31, 0),
(23, 1, 8, 7, 'ff', '2023-11-08 14:11:56', '2023-11-08 14:11:56', 0x3a3a31, 0),
(24, 1, 8, 7, 'asdf', '2023-11-08 14:14:24', '2023-11-08 14:14:24', 0x3a3a31, 0),
(25, 1, 8, 7, '', '2023-11-08 14:14:26', '2023-11-08 14:14:26', 0x3a3a31, 0),
(26, 1, 8, 7, 'asdfasdf', '2023-11-08 14:14:40', '2023-11-08 14:14:40', 0x3a3a31, 0),
(27, 1, 8, 7, '', '2023-11-08 14:14:41', '2023-11-08 14:14:41', 0x3a3a31, 0),
(28, 1, 8, 7, 'aaasdf', '2023-11-08 14:16:08', '2023-11-08 14:16:08', 0x3a3a31, 0),
(29, 1, 8, 7, 'f', '2023-11-08 14:16:10', '2023-11-08 14:16:10', 0x3a3a31, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `last_login_time` datetime DEFAULT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `hobby` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created`, `last_login_time`, `profile_img`, `gender`, `birth`, `hobby`) VALUES
(1, 'Gio Ernest', 'gio@gmail.com', '$2a$10$cFwUgotnyKZ2wZ9fkCGrcOhq.03WMFRkBCKjFSpGx8pXAuF1OM.Ai', '2023-11-07 17:11:12', '2023-11-08 13:37:43', '1_cat.jpg', 'Male', '1998-04-18', 'Mag lu2 og canton\r\n'),
(2, 'Tests', 'test@gmail.com', '$2a$10$A6L0kTE0enmSQC6qHY4ng.85trsjPkvvAfjXN2E5R9lhV4Hb2j68G', '2023-11-07 17:11:46', '2023-11-08 13:37:31', '2_kana.jpeg', 'Female', '1997-07-08', 'O hahaha'),
(3, 'Sumemasensya', 'sorry@gmail.com', '$2a$10$QzJ4Y2.hp.3kQ0y/PxSPNufS/7r1lqm7zSnQR.bN9kZHrWBabu1mu', '2023-11-07 17:12:21', '2023-11-08 13:18:58', '3_sorry.jpeg', 'Male', '2005-11-03', 'afdasfadf'),
(4, 'isdaa', 'isda@gmail.com', '$2a$10$HZckxHHEM8SuFW8QdATgzO2ORt0QQ20dk5vkrVh1xp8u.Gt3oXYFq', '2023-11-08 09:42:35', '2023-11-08 13:19:12', '4_isdaka.jpeg', 'Male', '2000-11-15', 'hehehe'),
(5, 'Ohaha', 'ohaha@gmail.com', '$2a$10$wtqOEqmyH/b3aIwInwtfpePA3ukB1VjZ8DJQHjs7JBn1A34RCVSPG', '2023-11-08 09:43:05', '2023-11-08 13:19:23', '5_ohaha.jpeg', 'Male', '1998-11-12', 'hahahaha'),
(6, 'Taylor', 'swifties@gmail.com', '$2a$10$Qa7UsYl7yJnrthyxe4UHle82fTb72wALO.fCJYJEDLXbDl6LU3Vbq', '2023-11-08 09:44:15', '2023-11-08 13:19:37', '6_ohoy.jpg', 'Female', '2000-11-14', 'aaaaaaa'),
(7, 'Sheesh', 'shesh@gmail.com', '$2a$10$V7XVQ6kOZ1ra8xMMd8J4QuHD8T5iQqHwnnaUcBN8OUuzz4fspEWly', '2023-11-08 09:48:43', '2023-11-08 13:19:53', '7_sheshable.jpg', 'Male', '1998-11-13', 'damn'),
(8, 'Sakit kaayu akong', 'heart@gmail.com', '$2a$10$95XUfibSVHkuBYEL0VEj3.6UZlefxl0lOC6Wn3zeykby9/uKUDQiS', '2023-11-08 10:52:14', '2023-11-08 13:20:30', '8_sorry.jpeg', 'Male', '2001-11-01', 'sadfadfa'),
(9, 'hmmmm', 'hm@gmail.com', '$2a$10$PRlPpLseUVbMH9YzlqNJqO4BKTrrRJmbUqF5EqGl943XHbLz3Le.e', '2023-11-08 11:41:10', '2023-11-08 13:20:44', '9_ohaha.jpeg', 'Female', '1996-11-14', 'hhhmmm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
