-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2020 at 04:17 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newci`
--

-- --------------------------------------------------------

--
-- Table structure for table `membership_plan`
--

CREATE TABLE `membership_plan` (
  `planId` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `discount` float(10,2) NOT NULL,
  `description` text NOT NULL,
  `planType` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1:Monthly,2:Quarterly,3:Half Yearly,4:Yearly',
  `planFor` enum('Institute','Teacher') NOT NULL,
  `studentCount` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Active',
  `sort_by` int(11) NOT NULL DEFAULT 0,
  `crd` timestamp NOT NULL DEFAULT current_timestamp(),
  `upd` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `membership_plan`
--

INSERT INTO `membership_plan` (`planId`, `title`, `price`, `discount`, `description`, `planType`, `planFor`, `studentCount`, `status`, `sort_by`, `crd`, `upd`) VALUES
(1, 'test A', 300.00, 10.00, '<p>test</p>', 1, 'Institute', 23, 1, 2, '2020-03-17 14:21:49', '2020-03-17 14:46:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `membership_plan`
--
ALTER TABLE `membership_plan`
  ADD PRIMARY KEY (`planId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `membership_plan`
--
ALTER TABLE `membership_plan`
  MODIFY `planId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
