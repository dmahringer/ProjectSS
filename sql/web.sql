-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2024 at 01:09 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web`
--

-- --------------------------------------------------------

--
-- Table structure for table `coin`
--

CREATE TABLE `coin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coin`
--

INSERT INTO `coin` (`id`, `name`, `description`) VALUES
(1, 'Bitcoin', 'Bitcoin is a decentralized digital currency that operates without a central authority or single administrator. It was created in 2009 by an anonymous person or group of people using the pseudonym Satoshi Nakamoto. Bitcoin transactions are verified by network nodes through cryptography and recorded in a public distributed ledger called a blockchain.'),
(2, 'Ethereum', 'Ethereum is a decentralized, open-source blockchain platform that enables developers to build and deploy smart contracts and decentralized applications (dApps). It was proposed in late 2013 by programmer Vitalik Buterin and development was crowdfunded in 2014, with the network going live on July 30, 2015.'),
(3, 'Litecoin', 'Litecoin is a peer-to-peer cryptocurrency that enables instant, near-zero cost payments to anyone in the world. It was created by Charlie Lee, a former Google engineer, and launched on October 13, 2011. Litecoin is often referred to as the silver to Bitcoin’s gold due to its similarities with Bitcoin, but with several key differences and enhancements.');

-- --------------------------------------------------------

--
-- Table structure for table `price_history`
--

CREATE TABLE `price_history` (
  `coin_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `price_history`
--

INSERT INTO `price_history` (`coin_id`, `timestamp`, `price`) VALUES
(1, '2024-06-09 20:54:19', 69742),
(1, '2024-06-09 21:34:03', 69788.2),
(1, '2024-06-09 21:34:09', 69788.2),
(1, '2024-06-09 22:11:06', 69655),
(1, '2024-06-09 22:38:45', 69623.1),
(2, '2024-06-09 22:38:45', 3697.25),
(3, '2024-06-09 22:38:46', 80.4),
(1, '2024-06-09 22:38:51', 69623.1),
(2, '2024-06-09 22:38:52', 3697.26),
(3, '2024-06-09 22:38:52', 80.39),
(1, '2024-06-09 22:38:57', 69623.1),
(2, '2024-06-09 22:38:58', 3697.25),
(3, '2024-06-09 22:38:58', 80.4),
(1, '2024-06-09 22:42:07', 69616.1),
(2, '2024-06-09 22:42:07', 3697.99),
(3, '2024-06-09 22:42:08', 80.39),
(1, '2024-06-09 22:43:08', 69628.8),
(2, '2024-06-09 22:43:08', 3698.5),
(3, '2024-06-09 22:43:09', 80.41),
(1, '2024-06-09 22:44:09', 69620.8),
(2, '2024-06-09 22:44:09', 3698.74),
(3, '2024-06-09 22:44:10', 80.4),
(1, '2024-06-09 23:47:31', 69688),
(2, '2024-06-09 23:47:31', 3699.01),
(3, '2024-06-09 23:47:31', 80.44),
(1, '2024-06-10 16:52:17', 69550.8),
(2, '2024-06-10 16:52:18', 3675.74),
(3, '2024-06-10 16:52:18', 79.57),
(1, '2024-06-10 16:53:18', 69582.7),
(2, '2024-06-10 16:53:19', 3677.36),
(3, '2024-06-10 16:53:19', 79.59),
(1, '2024-06-10 16:54:23', 69624),
(2, '2024-06-10 16:54:23', 3679.08),
(3, '2024-06-10 16:54:23', 79.65),
(1, '2024-06-10 17:01:50', 69612.3),
(2, '2024-06-10 17:01:51', 3677.34),
(3, '2024-06-10 17:01:51', 79.63),
(1, '2024-06-10 17:03:04', 69633.5),
(2, '2024-06-10 17:03:04', 3679.63),
(3, '2024-06-10 17:03:05', 79.66),
(1, '2024-06-10 17:08:29', 69700.3),
(2, '2024-06-10 17:08:29', 3683.61),
(3, '2024-06-10 17:08:30', 79.78),
(1, '2024-06-10 22:18:26', 69482),
(2, '2024-06-10 22:18:26', 3659.44),
(3, '2024-06-10 22:18:27', 79.64),
(1, '2024-06-10 22:25:10', 69482),
(1, '2024-06-10 22:25:41', 69490.1),
(2, '2024-06-10 22:25:41', 3659.79),
(3, '2024-06-10 22:25:41', 79.63),
(1, '2024-06-10 22:25:58', 69490.1),
(1, '2024-06-10 22:29:07', 69580),
(2, '2024-06-10 22:29:07', 3665.57),
(3, '2024-06-10 22:29:07', 79.79),
(2, '2024-06-10 22:52:16', 3665.57),
(1, '2024-06-10 22:52:27', 69650),
(2, '2024-06-10 22:52:27', 3671.51),
(3, '2024-06-10 22:52:28', 79.86),
(1, '2024-06-10 22:53:28', 69634.2),
(2, '2024-06-10 22:53:28', 3671.46),
(3, '2024-06-10 22:53:29', 79.84),
(1, '2024-06-10 22:54:29', 69625.8),
(2, '2024-06-10 22:54:29', 3671),
(3, '2024-06-10 22:54:30', 79.83),
(1, '2024-06-10 22:55:30', 69599.7),
(2, '2024-06-10 22:55:31', 3669.87),
(3, '2024-06-10 22:55:31', 79.81),
(1, '2024-06-10 22:56:31', 69589.3),
(2, '2024-06-10 22:56:32', 3668.5),
(3, '2024-06-10 22:56:32', 79.78),
(1, '2024-06-10 22:57:32', 69653.3),
(2, '2024-06-10 22:57:33', 3670.7),
(3, '2024-06-10 22:57:33', 79.77),
(1, '2024-06-10 22:58:34', 69680.6),
(2, '2024-06-10 22:58:34', 3672.32),
(3, '2024-06-10 22:58:34', 79.8),
(1, '2024-06-10 22:59:35', 69646.5),
(2, '2024-06-10 22:59:35', 3672.58),
(3, '2024-06-10 22:59:35', 79.8),
(1, '2024-06-10 23:00:36', 69633.4),
(2, '2024-06-10 23:00:36', 3672.77),
(3, '2024-06-10 23:00:36', 79.84),
(1, '2024-06-10 23:01:37', 69644.4),
(2, '2024-06-10 23:01:37', 3672.77),
(3, '2024-06-10 23:01:37', 79.85),
(2, '2024-06-10 23:54:26', 3672.77),
(1, '2024-06-10 23:56:13', 69644.4),
(1, '2024-06-11 00:10:26', 69644.4),
(1, '2024-06-11 00:13:43', 69560),
(2, '2024-06-11 00:13:43', 3671.94),
(3, '2024-06-11 00:13:43', 79.42),
(1, '2024-06-11 00:13:55', 69560),
(1, '2024-06-11 00:14:44', 69547.5),
(2, '2024-06-11 00:14:44', 3671.36),
(3, '2024-06-11 00:14:45', 79.42),
(3, '2024-06-11 00:15:30', 79.42),
(1, '2024-06-11 00:15:45', 69540),
(2, '2024-06-11 00:15:45', 3671.36),
(3, '2024-06-11 00:15:46', 79.42),
(1, '2024-06-11 00:16:46', 69520.3),
(2, '2024-06-11 00:16:46', 3670.21),
(3, '2024-06-11 00:16:47', 79.39),
(1, '2024-06-11 00:17:47', 69511.8),
(2, '2024-06-11 00:17:47', 3670.64),
(3, '2024-06-11 00:17:48', 79.38),
(1, '2024-06-11 00:19:17', 69504.3),
(2, '2024-06-11 00:19:17', 3669.97),
(3, '2024-06-11 00:19:17', 79.32),
(2, '2024-06-11 00:19:59', 3669.97),
(1, '2024-06-11 00:20:18', 69491.4),
(2, '2024-06-11 00:20:18', 3670.4),
(3, '2024-06-11 00:20:18', 79.31),
(1, '2024-06-11 00:21:19', 69510),
(2, '2024-06-11 00:21:19', 3671.68),
(3, '2024-06-11 00:21:20', 79.34),
(1, '2024-06-11 00:22:20', 69524.4),
(2, '2024-06-11 00:22:21', 3672.33),
(3, '2024-06-11 00:22:21', 79.36),
(1, '2024-06-11 00:23:22', 69532),
(2, '2024-06-11 00:23:22', 3672.86),
(3, '2024-06-11 00:23:22', 79.37),
(1, '2024-06-11 00:24:23', 69525),
(2, '2024-06-11 00:24:23', 3673.14),
(3, '2024-06-11 00:24:24', 79.4);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `user_id` int(11) NOT NULL,
  `coin_id` int(11) NOT NULL,
  `amount` double(10,6) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `date_purchased` datetime NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`user_id`, `coin_id`, `amount`, `id`, `date_purchased`, `price`) VALUES
(2, 1, 0.003593, 25, '2024-06-11 00:13:55', 69560),
(2, 3, 125.912868, 26, '2024-06-11 00:15:30', 79.42),
(2, 2, 0.272482, 27, '2024-06-11 00:19:59', 3669.97);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(500) NOT NULL,
  `join_date` date NOT NULL DEFAULT current_timestamp(),
  `date_of_birth` date NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `join_date`, `date_of_birth`, `profile_pic`) VALUES
(2, 'User1', '$2y$10$k.D7p6R2Xi7ulIM7j9Jm0O2To50x10RUxzelXHQE7zWwcAuNyMtP2', '2024-06-09', '2005-05-19', 'uploads/Admin_1717947912.jpg'),
(3, 'Daniel', '$2y$10$eHcorMRkjQjAwW4fBHOjWeYVoi0lLgCsQv/2CGd8vxXuainkRQotS', '2024-06-10', '1995-08-05', 'uploads/Daniel_1718052712.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coin`
--
ALTER TABLE `coin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price_history`
--
ALTER TABLE `price_history`
  ADD KEY `fk_history_coin_id` (`coin_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_coin_id` (`coin_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coin`
--
ALTER TABLE `coin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `price_history`
--
ALTER TABLE `price_history`
  ADD CONSTRAINT `fk_history_coin_id` FOREIGN KEY (`coin_id`) REFERENCES `coin` (`id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `fk_coin_id` FOREIGN KEY (`coin_id`) REFERENCES `coin` (`id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `delete_old_price_history` ON SCHEDULE EVERY 1 HOUR STARTS '2024-06-11 00:17:44' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM price_history WHERE timestamp < DATE_SUB(NOW(), INTERVAL 24 HOUR)$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
