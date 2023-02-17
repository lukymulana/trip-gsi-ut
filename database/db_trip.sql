-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2023 at 03:39 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_trip`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_cost`
--

CREATE TABLE `data_cost` (
  `id_cost` int(11) NOT NULL,
  `point_start` char(1) DEFAULT NULL,
  `point_end` char(1) DEFAULT NULL,
  `distance` int(3) DEFAULT NULL,
  `standard_time` int(3) DEFAULT NULL,
  `price_per_km` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_cost`
--

INSERT INTO `data_cost` (`id_cost`, `point_start`, `point_end`, `distance`, `standard_time`, `price_per_km`, `created_at`) VALUES
(1, 'A', 'B', 5, 20, 10000, '2023-02-16 02:35:19'),
(2, 'A', 'C', 8, 22, 11000, '2023-02-16 02:35:19'),
(3, 'A', 'D', 10, 25, 10000, '2023-02-16 02:35:19'),
(4, 'B', 'C', 4, 15, 10000, '2023-02-16 02:36:49'),
(5, 'B', 'D', 15, 30, 13000, '2023-02-16 02:36:49'),
(6, 'C', 'D', 20, 40, 11000, '2023-02-16 02:37:12');

-- --------------------------------------------------------

--
-- Table structure for table `data_driver`
--

CREATE TABLE `data_driver` (
  `id_driver` int(11) NOT NULL,
  `nama_driver` varchar(50) DEFAULT NULL,
  `no_plat` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_driver`
--

INSERT INTO `data_driver` (`id_driver`, `nama_driver`, `no_plat`, `created_at`) VALUES
(1, 'Suparman', 'PA 1234', '2023-02-16 02:32:14'),
(2, 'Kli Won', 'PA 1236', '2023-02-16 02:33:28'),
(3, 'Ice Juice', 'PA 1235', '2023-02-16 02:33:28'),
(4, 'Bram E', 'PA 1237', '2023-02-16 02:33:28');

-- --------------------------------------------------------

--
-- Table structure for table `summary_trip`
--

CREATE TABLE `summary_trip` (
  `id_trip` int(11) NOT NULL,
  `id_driver` int(11) DEFAULT NULL,
  `id_cost` int(11) DEFAULT NULL,
  `date_trip` date DEFAULT NULL,
  `actual_time` int(3) DEFAULT NULL,
  `total_cost` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `summary_trip`
--

INSERT INTO `summary_trip` (`id_trip`, `id_driver`, `id_cost`, `date_trip`, `actual_time`, `total_cost`, `created_at`) VALUES
(1, 1, 1, '2021-01-01', 20, 50000, '2023-02-16 02:41:22'),
(2, 1, 4, '2021-01-01', 16, 40000, '2023-02-16 03:54:34'),
(3, 2, 6, '2021-01-01', 40, 220000, '2023-02-16 04:31:54'),
(4, 2, 2, '2021-01-01', 22, 88000, '2023-02-16 04:46:57'),
(5, 3, 4, '2021-01-01', 15, 40000, '2023-02-16 04:47:02'),
(6, 4, 5, '2021-01-01', 35, 195000, '2023-02-16 04:47:06'),
(7, 3, 2, '2021-01-02', 24, 88000, '2023-02-16 04:47:33'),
(8, 4, 3, '2021-01-02', 25, 100000, '2023-02-16 04:47:48'),
(9, 1, 3, '2021-01-02', 25, 100000, '2023-02-16 04:47:51'),
(10, 4, 4, '2021-01-02', 17, 40000, '2023-02-16 04:47:54'),
(11, 3, 5, '2021-01-02', 32, 195000, '2023-02-16 04:48:00'),
(12, 1, 6, '2021-01-03', 43, 220000, '2023-02-16 04:48:12'),
(13, 3, 1, '2021-01-03', 23, 50000, '2023-02-16 04:48:18'),
(14, 2, 2, '2021-01-03', 27, 88000, '2023-02-16 04:48:22'),
(15, 2, 1, '2021-01-03', 21, 50000, '2023-02-16 04:48:29'),
(16, 4, 3, '2021-01-05', 25, 100000, '2023-02-16 04:48:45'),
(17, 4, 5, '2021-01-05', 30, 195000, '2023-02-16 04:48:49'),
(18, 3, 2, '2021-01-05', 22, 88000, '2023-02-16 04:48:52'),
(19, 2, 3, '2021-01-05', 25, 100000, '2023-02-16 04:48:54'),
(20, 1, 6, '2021-01-05', 42, 220000, '2023-02-16 04:48:57'),
(21, 1, 2, '2021-01-05', 25, 88000, '2023-02-16 04:48:59'),
(22, 3, 1, '2021-01-06', 23, 50000, '2023-02-16 04:49:04'),
(23, 2, 1, '2021-01-06', 22, 50000, '2023-02-16 04:49:14'),
(26, NULL, NULL, NULL, NULL, NULL, '2023-02-16 06:34:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_cost`
--
ALTER TABLE `data_cost`
  ADD PRIMARY KEY (`id_cost`);

--
-- Indexes for table `data_driver`
--
ALTER TABLE `data_driver`
  ADD PRIMARY KEY (`id_driver`);

--
-- Indexes for table `summary_trip`
--
ALTER TABLE `summary_trip`
  ADD PRIMARY KEY (`id_trip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_cost`
--
ALTER TABLE `data_cost`
  MODIFY `id_cost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `data_driver`
--
ALTER TABLE `data_driver`
  MODIFY `id_driver` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `summary_trip`
--
ALTER TABLE `summary_trip`
  MODIFY `id_trip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
