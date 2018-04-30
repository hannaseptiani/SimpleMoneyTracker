-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2018 at 03:25 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `money_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `ms_account`
--

CREATE TABLE `ms_account` (
  `id` int(11) NOT NULL,
  `account_number` varchar(10) COLLATE utf8_bin NOT NULL,
  `account_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ms_account`
--

INSERT INTO `ms_account` (`id`, `account_number`, `account_name`, `created_date`) VALUES
(1, '1234567890', 'Kania Purtama', '2018-04-01'),
(2, '9876543219', 'Jo Dhanmari', '2018-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `tr_transaction`
--

CREATE TABLE `tr_transaction` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `description` varchar(100) COLLATE utf8_bin NOT NULL,
  `transaction_type` varchar(2) COLLATE utf8_bin NOT NULL,
  `amount` double NOT NULL,
  `balance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tr_transaction`
--

INSERT INTO `tr_transaction` (`id`, `account_id`, `transaction_date`, `description`, `transaction_type`, `amount`, `balance`) VALUES
(1, 1, '2018-04-01 12:41:00', 'Setoran Awal', 'CR', 500000, 500000),
(2, 1, '2018-04-05 12:32:33', 'Setoran Tunai', 'CR', 1600000, 2100000),
(3, 1, '2018-04-07 01:00:00', 'Tarikan Tunai', 'DB', 200000, 1900000),
(8, 1, '2018-04-28 22:51:27', 'Tarikan Tunai', 'DB', 100000, 1800000),
(9, 1, '2018-04-29 18:16:19', 'Tarikan Tunai', 'DB', 100000, 1700000),
(10, 1, '2018-04-29 18:16:44', 'Tarikan Tunai', 'DB', 100000, 1600000),
(11, 1, '2018-04-29 23:06:29', 'Setoran Tunai', 'CR', 150000, 1750000),
(12, 2, '2018-04-29 23:07:41', 'Setoran Awal', 'CR', 14000000, 14000000),
(13, 2, '2018-04-30 08:00:00', 'Setoran Tunai', 'CR', 2300000, 16300000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ms_account`
--
ALTER TABLE `ms_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_transaction`
--
ALTER TABLE `tr_transaction`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ms_account`
--
ALTER TABLE `ms_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tr_transaction`
--
ALTER TABLE `tr_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
