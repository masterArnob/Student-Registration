-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2023 at 04:34 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentform`
--

-- --------------------------------------------------------

--
-- Table structure for table `studentform`
--

CREATE TABLE `studentform` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentform`
--

INSERT INTO `studentform` (`id`, `email`, `name`, `phone`, `subject`, `address`, `picture`, `reg_date`) VALUES
(3, 'sadmanarnob31@gmail.com', 'sadman', '123', 'Math', 'Dhaka', 'd503d93d0d.png', '2023-05-16 00:09:47'),
(4, 'sadmanarnob31@gmail.com', 'sadman', '123', 'Math', 'dhaka', '474c20a259.png', '2023-05-16 02:19:34'),
(5, 'sadmanarnob31@gmail.com', 'sadman', '01780658700', 'Math', 'Dhaka', 'f7828656f5.png', '2023-05-16 02:20:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `studentform`
--
ALTER TABLE `studentform`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `studentform`
--
ALTER TABLE `studentform`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
