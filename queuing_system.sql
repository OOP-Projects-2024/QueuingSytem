-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2025 at 09:43 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `queuing_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts_tbl`
--

CREATE TABLE `accounts_tbl` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts_tbl`
--

INSERT INTO `accounts_tbl` (`id`, `userid`, `username`, `password`, `token`) VALUES
(1, 1, 'johndoe', 'securePassword123', NULL),
(3, 2, 'johndoe123', '$2y$10$MjA2ZTI3Nzg2ZGJjNWM1Z.g9V0CHSIHsjiTOLB6i1FYLRsbtN670q', 'YzA0ODM3ZWE1YTNiOWUxOTc1YmJmMzllYTg0MzcyMjA2MjUyOTA0NTJkYmJiNTRjZjBjOTQ4OTg5NGUyNzAyYg=='),
(9, 4, 'jenishe', '$2y$10$YWM0Yzg0MWE2N2U0OWRlOOgSiZ2bfdT/fDUJELPvCJ/qjRw8tumJS', 'MDA5OTMzOWZjYTBjNTNmZjczNzAzZjFmODljNGFjYTk4ODM4NzlkMjk2MGI5YmUxZDAyOTQzOGExMmM2NzQ2MA==');

-- --------------------------------------------------------

--
-- Table structure for table `queues`
--

CREATE TABLE `queues` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `status` enum('waiting','serving','done') DEFAULT 'waiting',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `isdeleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `queues`
--

INSERT INTO `queues` (`id`, `customer_name`, `status`, `created_at`, `isdeleted`) VALUES
(1, 'Jane Smith', 'waiting', '2024-12-10 12:26:24', 1),
(2, 'Mark Johnson', 'serving', '2024-12-10 12:26:24', 0),
(3, 'Ralph Jaminal', 'serving', '2024-12-10 12:26:24', 0),
(7, 'Jane Smith', 'waiting', '2024-12-10 13:01:19', 0),
(8, 'Mark Johnson', 'serving', '2024-12-10 13:01:19', 0),
(9, 'Emily Davis', 'done', '2024-12-10 13:01:19', 0),
(10, '', 'waiting', '2024-12-10 13:18:10', 0),
(13, 'Ralph Jaminal', 'done', '2024-12-10 13:20:02', 0),
(16, 'Ralph Jaminal', 'done', '2024-12-10 13:25:31', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts_tbl`
--
ALTER TABLE `accounts_tbl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `queues`
--
ALTER TABLE `queues`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts_tbl`
--
ALTER TABLE `accounts_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `queues`
--
ALTER TABLE `queues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
