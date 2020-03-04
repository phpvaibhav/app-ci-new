-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 04, 2020 at 01:38 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newCi`
--

-- --------------------------------------------------------

--
-- Table structure for table `personal_student_assign_teacher`
--

CREATE TABLE `personal_student_assign_teacher` (
  `teacherAssignId` bigint(20) NOT NULL,
  `teacherId` bigint(20) NOT NULL,
  `studentId` bigint(20) NOT NULL,
  `assignStatus` tinyint(4) NOT NULL DEFAULT '1',
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `personal_student_assign_teacher`
--
ALTER TABLE `personal_student_assign_teacher`
  ADD PRIMARY KEY (`teacherAssignId`),
  ADD KEY `teacherId` (`teacherId`),
  ADD KEY `studentId` (`studentId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `personal_student_assign_teacher`
--
ALTER TABLE `personal_student_assign_teacher`
  MODIFY `teacherAssignId` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
