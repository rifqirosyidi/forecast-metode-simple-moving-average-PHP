-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 24, 2020 at 02:20 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_peramalan`
--

-- --------------------------------------------------------

--
-- Table structure for table `simple_moving`
--

CREATE TABLE `simple_moving` (
  `id` int(11) NOT NULL,
  `fore_3` double DEFAULT NULL,
  `fore_6` double DEFAULT NULL,
  `mad_3` double DEFAULT NULL,
  `mad_6` double DEFAULT NULL,
  `mse_3` double DEFAULT NULL,
  `mse_6` double DEFAULT NULL,
  `mape_3` double DEFAULT NULL,
  `mape_6` double DEFAULT NULL,
  `perolehan` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simple_moving`
--

INSERT INTO `simple_moving` (`id`, `fore_3`, `fore_6`, `mad_3`, `mad_6`, `mse_3`, `mse_6`, `mape_3`, `mape_6`, `perolehan`) VALUES
(28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 90),
(29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 87),
(30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 65),
(31, 80.67, NULL, 8.33, NULL, 69.39, NULL, 9.36, NULL, 89),
(32, 80.33, NULL, 0.33, NULL, 0.11, NULL, 0.41, NULL, 80),
(33, 78, NULL, 2, NULL, 4, NULL, 2.63, NULL, 76),
(34, 81.67, 81.17, 8.33, 8.83, 69.39, 77.97, 9.26, 9.81, 90);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `simple_moving`
--
ALTER TABLE `simple_moving`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `simple_moving`
--
ALTER TABLE `simple_moving`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
