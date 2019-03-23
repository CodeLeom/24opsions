-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2018 at 12:44 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Ijuisnwb_opsions`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `email` varchar(123) NOT NULL,
  `phone` varchar(114) NOT NULL,
  `currency` varchar(116) NOT NULL,
  `balance` varchar(112) DEFAULT NULL,
  `country` char(115) DEFAULT NULL,
  `date` datetime NOT NULL,
  `doc_name` varchar(115) DEFAULT NULL,
  `doc` varchar(122) DEFAULT NULL,
  `postal` int(11) DEFAULT NULL,
  `upload` varchar(122) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `status`, `username`, `password`, `email`, `phone`, `currency`, `balance`, `country`, `date`, `doc_name`, `doc`, `postal`, `upload`) VALUES
(1, 'admin', 'Admin', '$2y$10$TnmuusqR8Ms5rH8O4VCYIODyMxBHhToWI1x9clFOKaVc7aDD0C/yO', 'info@24opsions.com', '15012058076', 'US Dollar (USD)', '0', '1', '2005-09-28 01:47:25', NULL, NULL, NULL, 'null');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
