-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2024 at 11:51 PM
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
(1, 'Bitcoin', 'blablablablablablbalbalba'),
(2, 'Ethereum', 'supadupabuba'),
(3, 'Litecoin', 'jo jo scho so voi supa coin ka');

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
(1, '0000-00-00 00:00:00', 69708),
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
(3, '2024-06-09 23:47:31', 80.44);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `user_id` int(11) NOT NULL,
  `coin_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `id` int(11) NOT NULL,
  `date_purchased` datetime NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`user_id`, `coin_id`, `amount`, `id`, `date_purchased`, `price`) VALUES
(2, 1, 500, 1, '2024-06-09 23:32:48', 69620.8),
(2, 2, 3000, 2, '2024-06-09 23:42:33', 3698.74);

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
(2, 'Admin', '$2y$10$k.D7p6R2Xi7ulIM7j9Jm0O2To50x10RUxzelXHQE7zWwcAuNyMtP2', '2024-06-09', '2005-05-19', 'uploads/Admin_1717947912.jpg');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
