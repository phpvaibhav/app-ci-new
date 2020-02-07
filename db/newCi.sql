-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 07, 2020 at 01:36 PM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `userType` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1:Admin',
  `profileImage` varchar(255) NOT NULL,
  `contactNumber` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1:Active',
  `authToken` text NOT NULL,
  `passToken` text NOT NULL,
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fullName`, `email`, `password`, `userType`, `profileImage`, `contactNumber`, `status`, `authToken`, `passToken`, `crd`, `upd`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$WxJ3MaIi0KH.taEVTnIf8usaC4fv.Gri/GJXZFliekZgP7FDDUiWi', 1, 'jNeI4h92BL7d8FQJ.png', '(01642) 792566', 1, 'e3b8f30b54c59a98f0c1ffe27b9ea736dc6e9310', 'e5309a9e62031ca2acfe429e2930c5a2a90dcf1d', '2019-08-01 13:15:47', '2020-02-06 10:32:16'),
(2, 'Vaibhav', 'vaibhavsharma.otc@gmail.com', '$2y$10$94HB8LW1aF0Ak9Sm5L3PvOZMc4Vu9eVi4WodjHo8bd9sOIw3AI38C', 1, 'dG8hgf6oaIqcwRD5.jpg', '(121) 212-1212', 1, 'c62d4a8735a6b908e4880acde5bcd86ceb89212f', 'f039aff9f58a4ed5150ab364b410681f7f7d23db', '2019-08-01 14:03:16', '2019-11-11 11:57:19');

-- --------------------------------------------------------

--
-- Table structure for table `institute`
--

CREATE TABLE `institute` (
  `instituteId` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1:Active',
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institute`
--

INSERT INTO `institute` (`instituteId`, `userId`, `name`, `logo`, `email`, `phoneNumber`, `description`, `status`, `crd`, `upd`) VALUES
(1, 1, 'ADX', '', 'in@admin.com', '1234567890', '', 1, '2020-02-07 08:36:00', '2020-02-07 08:36:00');

-- --------------------------------------------------------

--
-- Table structure for table `institute_parents`
--

CREATE TABLE `institute_parents` (
  `joinId` bigint(20) NOT NULL,
  `instituteId` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `joinStatus` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1:Approved',
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institute_parents`
--

INSERT INTO `institute_parents` (`joinId`, `instituteId`, `userId`, `joinStatus`, `crd`, `upd`) VALUES
(1, 1, 7, 1, '2020-02-07 12:22:43', '2020-02-07 12:22:43');

-- --------------------------------------------------------

--
-- Table structure for table `institute_staff`
--

CREATE TABLE `institute_staff` (
  `joinId` bigint(20) NOT NULL,
  `instituteId` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `joinStatus` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1:Approved',
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institute_staff`
--

INSERT INTO `institute_staff` (`joinId`, `instituteId`, `userId`, `joinStatus`, `crd`, `upd`) VALUES
(1, 1, 5, 1, '2020-02-07 12:14:25', '2020-02-07 12:14:25');

-- --------------------------------------------------------

--
-- Table structure for table `institute_student`
--

CREATE TABLE `institute_student` (
  `joinId` bigint(20) NOT NULL,
  `instituteId` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `classId` varchar(255) NOT NULL,
  `joinStatus` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1:Approved',
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institute_student`
--

INSERT INTO `institute_student` (`joinId`, `instituteId`, `userId`, `classId`, `joinStatus`, `crd`, `upd`) VALUES
(1, 1, 6, '', 1, '2020-02-07 12:22:09', '2020-02-07 12:22:09');

-- --------------------------------------------------------

--
-- Table structure for table `institute_teacher`
--

CREATE TABLE `institute_teacher` (
  `joinId` bigint(20) NOT NULL,
  `instituteId` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `joinStatus` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1:Approved',
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institute_teacher`
--

INSERT INTO `institute_teacher` (`joinId`, `instituteId`, `userId`, `joinStatus`, `crd`, `upd`) VALUES
(2, 1, 3, 1, '2020-02-07 08:38:24', '2020-02-07 08:38:24'),
(3, 1, 4, 1, '2020-02-07 12:11:46', '2020-02-07 12:11:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `roleId` bigint(20) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `profileImage` text NOT NULL,
  `contactNumber` varchar(255) NOT NULL,
  `bio` text NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1:Active ,0:Inactive',
  `authToken` text NOT NULL,
  `passToken` text NOT NULL,
  `deviceType` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0:Web,1:Android,2:IOS',
  `deviceToken` text NOT NULL,
  `verifyEmail` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1:Verify',
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `roleId`, `firstName`, `lastName`, `fullName`, `email`, `password`, `profileImage`, `contactNumber`, `bio`, `latitude`, `longitude`, `status`, `authToken`, `passToken`, `deviceType`, `deviceToken`, `verifyEmail`, `crd`, `upd`) VALUES
(1, 1, 'abc', 'cd', 'abc cd', 'in@admin.com', '$2y$10$ytQaL4qDw0774c6pqNfSCuehs.sRV7r2OcCXdV0gg8biVLgkyOu4O', '', '1234567890', '', '0.00000000', '0.00000000', 1, 'dcea21fe133f4ebdf44b1f866fd6e0814688b0e1', '6e0df0dd06c2ca0dd88ac9c282a486fd5547ff82', 0, '', 0, '2020-02-07 08:36:00', '2020-02-07 08:36:00'),
(2, 2, 'tC', 'cc', 'tC cc', 't@gmail.com', '$2y$10$m2a.jVqUf9GDPaXP3fvxHO1zsO0P8K0Yn3k00ZaK8ZK6LvxTaFdYm', '', '9876543210', '', '0.00000000', '0.00000000', 1, '8a5b0a17e16edf3cc180f865d3e29a963f44de5e', '4d6f23fb8397d0bd4b4fe4855169580b1a1a31c2', 0, '', 0, '2020-02-07 08:36:51', '2020-02-07 08:36:51'),
(3, 2, 'ADvdfg', 'dsfsggs', 'ADvdfg dsfsggs', 'tc@gmail.com', '$2y$10$owsefil45n72MjrMb1.E9eMWXP7gRR/8xfj0qGVobCQurdiRMEPy.', '', '0987665343211', '', '0.00000000', '0.00000000', 1, '26f4ff9d32d4c99c09a5fcf95d24648b03ad01b5', 'b62d7b40d97e015ea77722e226b8b81f5d6d148d', 0, '', 0, '2020-02-07 08:38:24', '2020-02-07 10:38:07'),
(4, 2, 'staff', 'name', 'staff name', 's@gmail.com', '$2y$10$eipk6HprdnSerYWYUsb/B.UQe2fmqNJLPQnA/NZOf9fiLqBkjtK6a', '', '1223456789', '', '0.00000000', '0.00000000', 1, '025b4109ec28f4d448727e25b3f0bec17fe7297c', 'ae26b0c066f9f89aa3d66e5d32a4f7793fdd142f', 0, '', 0, '2020-02-07 12:11:46', '2020-02-07 12:11:46'),
(5, 3, 'test', 'rewar', 'test rewar', 's@test.com', '$2y$10$fcDWsXGEGzuOJXoZCPNZYug/fs6pKzSIL7sbBFqMB27oxvbl1VXpy', '', '1234567890', '', '0.00000000', '0.00000000', 1, 'd248d03de3932878baa7e5dbad9ca881e45b4d57', '1e8d04293c8f5842a70360da7ff2be58bb0b345c', 0, '', 0, '2020-02-07 12:14:25', '2020-02-07 12:14:25'),
(6, 4, 'Student', 'class', 'Student class', 'st@gmail.com', '$2y$10$U0Wm9wCqNYkuK/K5PiEJm.oARjwfEoNgvyNkxev2XbI77XyqejJ/.', '', '98766542343', '', '0.00000000', '0.00000000', 1, '0625fe03483080454ead99b8615398fb001a43f3', 'd22e6c01cdb4db5751c7de35d3acdce1c0de864b', 0, '', 0, '2020-02-07 12:22:09', '2020-02-07 12:22:09'),
(7, 5, 'Pa', 'ma', 'Pa ma', 'pa@gmail.com', '$2y$10$QXJfK5XrSdpLeSEWlpW2b.6QezV8mM2m/BgSeTUKnfszJABipJaai', '', '1234567890', '', '0.00000000', '0.00000000', 1, '188311dca4072e9c74b94e18474390f1c12a8d25', '7cdce417ff75734526be97deabeb95443f7f0f37', 0, '', 0, '2020-02-07 12:22:43', '2020-02-07 12:22:43');

-- --------------------------------------------------------

--
-- Table structure for table `user_meta`
--

CREATE TABLE `user_meta` (
  `userMetaId` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `classId` varchar(255) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `joiningDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `roleId` bigint(20) NOT NULL,
  `role` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1:Active',
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`roleId`, `role`, `status`, `crd`, `upd`) VALUES
(1, 'Super Admin', 1, '2020-02-04 12:00:29', '2020-02-04 12:00:53'),
(2, 'Teacher', 1, '2020-02-04 12:00:29', '2020-02-04 12:01:04'),
(3, 'Staff', 1, '2020-02-07 11:49:43', '2020-02-07 11:49:43'),
(4, 'Student', 1, '2020-02-07 11:49:43', '2020-02-07 11:49:43'),
(5, 'Parents', 1, '2020-02-07 11:50:17', '2020-02-07 11:50:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institute`
--
ALTER TABLE `institute`
  ADD PRIMARY KEY (`instituteId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `institute_parents`
--
ALTER TABLE `institute_parents`
  ADD PRIMARY KEY (`joinId`),
  ADD KEY `instituteId` (`instituteId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `institute_staff`
--
ALTER TABLE `institute_staff`
  ADD PRIMARY KEY (`joinId`),
  ADD KEY `instituteId` (`instituteId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `institute_student`
--
ALTER TABLE `institute_student`
  ADD PRIMARY KEY (`joinId`),
  ADD KEY `instituteId` (`instituteId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `institute_teacher`
--
ALTER TABLE `institute_teacher`
  ADD PRIMARY KEY (`joinId`),
  ADD KEY `instituteId` (`instituteId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roleId` (`roleId`);

--
-- Indexes for table `user_meta`
--
ALTER TABLE `user_meta`
  ADD PRIMARY KEY (`userMetaId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`roleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `institute`
--
ALTER TABLE `institute`
  MODIFY `instituteId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `institute_parents`
--
ALTER TABLE `institute_parents`
  MODIFY `joinId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `institute_staff`
--
ALTER TABLE `institute_staff`
  MODIFY `joinId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `institute_student`
--
ALTER TABLE `institute_student`
  MODIFY `joinId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `institute_teacher`
--
ALTER TABLE `institute_teacher`
  MODIFY `joinId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_meta`
--
ALTER TABLE `user_meta`
  MODIFY `userMetaId` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `roleId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `institute_parents`
--
ALTER TABLE `institute_parents`
  ADD CONSTRAINT `institute_parents_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `institute_parents_ibfk_2` FOREIGN KEY (`instituteId`) REFERENCES `institute` (`instituteId`) ON DELETE CASCADE;

--
-- Constraints for table `institute_staff`
--
ALTER TABLE `institute_staff`
  ADD CONSTRAINT `institute_staff_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `institute_staff_ibfk_2` FOREIGN KEY (`instituteId`) REFERENCES `institute` (`instituteId`) ON DELETE CASCADE;

--
-- Constraints for table `institute_student`
--
ALTER TABLE `institute_student`
  ADD CONSTRAINT `institute_student_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `institute_student_ibfk_2` FOREIGN KEY (`instituteId`) REFERENCES `institute` (`instituteId`) ON DELETE CASCADE;

--
-- Constraints for table `institute_teacher`
--
ALTER TABLE `institute_teacher`
  ADD CONSTRAINT `institute_teacher_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `institute_teacher_ibfk_2` FOREIGN KEY (`instituteId`) REFERENCES `institute` (`instituteId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
