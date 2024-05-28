-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2024 at 07:27 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_221`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `street` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `user_id`, `street`, `barangay`, `city`, `province`) VALUES
(14, 26, 'YEs', 'Dila', 'Bay', 'Region IV-A (CALABARZON)'),
(16, 28, '123', 'San Agustin', 'Ibaan', 'Region IV-A (CALABARZON)'),
(18, 30, '1234', 'San Antonio', 'Bombon', 'Region V (Bicol Region)'),
(19, 31, 'TALADO', 'Taganak Poblacion', 'Turtle Islands', 'Autonomous Region in Muslim Mindanao (ARMM)'),
(20, 32, 'Purok 2 Montealto Comp', 'Bugtong na Pulo', 'Lipa City', 'Region IV-A (CALABARZON)');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `firstname` varchar(225) NOT NULL,
  `lastname` varchar(225) NOT NULL,
  `birthday` date NOT NULL DEFAULT current_timestamp(),
  `gender` varchar(225) NOT NULL,
  `user_profile_picture` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `account_type` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user`, `password`, `firstname`, `lastname`, `birthday`, `gender`, `user_profile_picture`, `email`, `account_type`) VALUES
(26, 'kee', '$2y$10$w4iTQ2zuXQnzFAdoBMnzg.AXD27uuPNk5Z26csd/O6iAuOg0Km6Su', 'Haktog', 'Sandwich', '2003-03-12', 'Male', 'yes.jpg', 'rosaleskeegan@gmail.com', 1),
(28, 'poleng', '$2y$10$/0pVXdrG/wUBGmVmDWsfje3Tokunfrw27dkNAobKIMCmGPXJnT0Mq', 'Ma. Paula', 'De Chavez', '2003-12-27', 'Female', 'uploads/1_1716165456.jpg', 'paudc@gmail.com', 1),
(30, 'Gel', '$2y$10$IALsEdyU7MM8qfOKc/w97eJZCnvHc8ME5Dqq9dHcX2nZJPK.zmy6a', 'Hak', 'Dog', '1503-02-15', 'Female', 'uploads/beru_1716166885.jpg', 'qweqqe@gha.com', 1),
(31, 'talado', '$2y$10$cgbRl.7xwsXqgLI7frcJu.PKzp8d851AU552ZTG0eqQP9VScUqoUu', 'tala', 'DOOO', '1998-12-02', 'Female', 'uploads/talado.jpg', 'talado@gmail.com', 1),
(32, 'Susi', '$2y$10$NDcxullwkfFDh1HlkEq67eUFR.hD3vQitQAze4cwm/AADtPPS5Dxa', 'Susi', 'Rosales', '2003-08-29', 'Male', 'uploads/image.png', 'susi@gmail.com', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
