-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 20, 2020 at 05:09 AM
-- Server version: 10.2.10-MariaDB
-- PHP Version: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `academy`
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
  `userType` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Admin',
  `profileImage` varchar(255) NOT NULL,
  `contactNumber` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Active',
  `authToken` text NOT NULL,
  `passToken` text NOT NULL,
  `crd` timestamp NOT NULL DEFAULT current_timestamp(),
  `upd` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fullName`, `email`, `password`, `userType`, `profileImage`, `contactNumber`, `status`, `authToken`, `passToken`, `crd`, `upd`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$WxJ3MaIi0KH.taEVTnIf8usaC4fv.Gri/GJXZFliekZgP7FDDUiWi', 1, 'JSCn72sMpiWx9EHm.png', '(01642) 792566', 1, '2062e7bb255da339d0c8fac5cac3263f5736a432', 'e5309a9e62031ca2acfe429e2930c5a2a90dcf1d', '2019-08-01 13:15:47', '2020-02-17 16:38:32'),
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
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Active',
  `crd` timestamp NOT NULL DEFAULT current_timestamp(),
  `upd` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institute`
--

INSERT INTO `institute` (`instituteId`, `userId`, `name`, `logo`, `email`, `phoneNumber`, `description`, `status`, `crd`, `upd`) VALUES
(1, 1, 'school ', 'Tt3kwlyu2gVXiYsh.jpg', 'test@school.com', '1234567890', '', 1, '2020-02-07 15:06:25', '2020-02-07 15:07:33');

-- --------------------------------------------------------

--
-- Table structure for table `institute_classes`
--

CREATE TABLE `institute_classes` (
  `classId` bigint(20) NOT NULL,
  `instituteId` bigint(20) NOT NULL,
  `className` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `crd` timestamp NOT NULL DEFAULT current_timestamp(),
  `upd` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `institute_classes`
--

INSERT INTO `institute_classes` (`classId`, `instituteId`, `className`, `status`, `crd`, `upd`) VALUES
(1, 1, 'Class A', 1, '2020-02-16 17:54:54', '2020-02-16 17:54:54'),
(2, 1, 'Class B', 1, '2020-02-16 17:55:06', '2020-02-16 19:17:44'),
(3, 1, 'C', 1, '2020-02-16 19:18:41', '2020-02-16 19:18:41');

-- --------------------------------------------------------

--
-- Table structure for table `institute_parents`
--

CREATE TABLE `institute_parents` (
  `joinId` bigint(20) NOT NULL,
  `instituteId` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `joinStatus` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Approved',
  `crd` timestamp NOT NULL DEFAULT current_timestamp(),
  `upd` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `institute_staff`
--

CREATE TABLE `institute_staff` (
  `joinId` bigint(20) NOT NULL,
  `instituteId` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `joinStatus` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Approved',
  `crd` timestamp NOT NULL DEFAULT current_timestamp(),
  `upd` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institute_staff`
--

INSERT INTO `institute_staff` (`joinId`, `instituteId`, `userId`, `joinStatus`, `crd`, `upd`) VALUES
(1, 1, 7, 1, '2020-02-16 19:16:55', '2020-02-16 19:16:55');

-- --------------------------------------------------------

--
-- Table structure for table `institute_student`
--

CREATE TABLE `institute_student` (
  `joinId` bigint(20) NOT NULL,
  `instituteId` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `classId` varchar(255) NOT NULL,
  `joinStatus` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Approved',
  `crd` timestamp NOT NULL DEFAULT current_timestamp(),
  `upd` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institute_student`
--

INSERT INTO `institute_student` (`joinId`, `instituteId`, `userId`, `classId`, `joinStatus`, `crd`, `upd`) VALUES
(3, 1, 6, '2', 1, '2020-02-16 18:20:01', '2020-02-16 18:20:01');

-- --------------------------------------------------------

--
-- Table structure for table `institute_teacher`
--

CREATE TABLE `institute_teacher` (
  `joinId` bigint(20) NOT NULL,
  `instituteId` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `joinStatus` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Approved',
  `crd` timestamp NOT NULL DEFAULT current_timestamp(),
  `upd` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institute_teacher`
--

INSERT INTO `institute_teacher` (`joinId`, `instituteId`, `userId`, `joinStatus`, `crd`, `upd`) VALUES
(1, 1, 2, 1, '2020-02-07 15:28:24', '2020-02-07 15:28:24'),
(2, 1, 3, 1, '2020-02-07 17:52:25', '2020-02-07 17:52:25');

-- --------------------------------------------------------

--
-- Table structure for table `student_assign_teacher`
--

CREATE TABLE `student_assign_teacher` (
  `teacherAssignId` bigint(20) NOT NULL,
  `instituteId` bigint(20) NOT NULL,
  `teacherId` bigint(20) NOT NULL,
  `studentId` bigint(20) NOT NULL,
  `assignStatus` tinyint(4) NOT NULL DEFAULT 1,
  `crd` timestamp NOT NULL DEFAULT current_timestamp(),
  `upd` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_assign_teacher`
--

INSERT INTO `student_assign_teacher` (`teacherAssignId`, `instituteId`, `teacherId`, `studentId`, `assignStatus`, `crd`, `upd`) VALUES
(1, 1, 2, 6, 1, '2020-02-16 18:20:01', '2020-02-16 18:20:01');

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
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `profileImage` text NOT NULL,
  `contactNumber` varchar(255) NOT NULL,
  `bio` text NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Active ,0:Inactive',
  `authToken` text NOT NULL,
  `passToken` text NOT NULL,
  `deviceType` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:Web,1:Android,2:IOS',
  `deviceToken` text NOT NULL,
  `verifyEmail` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1:Verify',
  `crd` timestamp NOT NULL DEFAULT current_timestamp(),
  `upd` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `roleId`, `firstName`, `lastName`, `fullName`, `username`, `email`, `password`, `profileImage`, `contactNumber`, `bio`, `latitude`, `longitude`, `status`, `authToken`, `passToken`, `deviceType`, `deviceToken`, `verifyEmail`, `crd`, `upd`) VALUES
(1, 1, 'test', 'demo', 'test demo', '', 'test@school.com', '$2y$10$./BKMtwp6dKN5.JWHNvTje0W.h2iM27rGsnHT82cvLyE1FwT8dVcC', 'QkDYdRBFpJPqby6i.jpg', '1234567890', '', '0.00000000', '0.00000000', 1, '72b82c5ab5a301bc3b43d980358b090afc13b348', '9c7617943601b3ef20746b374886025f777adb16', 0, '', 0, '2020-02-07 15:06:25', '2020-02-18 02:32:40'),
(2, 2, 'Ved', 'Sharma', 'Ved Sharma', '', 'ved.sharma0203@gmail.com', '$2y$10$tNBv.i0oDIwQ/ndkQfCY3egSw13eHbjo3mBAjGb63MBf9bdC6kAyK', '', '1234567890', '', '0.00000000', '0.00000000', 1, '6c22367ff6f03514485645fdfbb59711f498c58c', '5e43868821103fd4950836e5db46737fb2394d5a', 0, '', 0, '2020-02-07 15:28:24', '2020-02-07 15:28:58'),
(3, 2, 'Vaibhav', 'Sharma', 'Vaibhav Sharma', '', 'v@gmail.com', '$2y$10$zNEpnVfs9SD6F0EQ5DjBUuhRSH0oCqPEnq0Niq6GDCcUKyXomBca.', '', '1234567890', '', '0.00000000', '0.00000000', 1, '44041845722c329f8c657feca2ef3de5f145b3f9', '9015e486537bc1b1752d53b087a9619284f10bf0', 0, '', 0, '2020-02-07 17:52:25', '2020-02-07 17:52:25'),
(4, 4, 'ABC', 'cd', 'ABC cd', '', 'aa@admin.com', '$2y$10$zImPi3KfGZ.wBIH6CutYj.5S16om4OFah02OYRNgfxOeD/89gyaWu', '', '12345654321', '', '0.00000000', '0.00000000', 1, 'fc71b7809fcdde7398036420055415468a34ff24', '1b12d17ac89046762810926e7914d5a75d5c9658', 0, '', 0, '2020-02-16 17:56:04', '2020-02-16 17:56:04'),
(5, 4, 'test', 'test', 'test test', '', 'vv@test.com', '$2y$10$EzmIb5KVDN5LSuZG8.9HOeACetjCm6fEGB4zNpr2TM8iTMMcsjbFe', '', '12345654321', '', '0.00000000', '0.00000000', 1, '7d53f299c130fb6bc6925f01228a765f539302ed', 'f75a995de2b98eeec8c3668c39b17483aad84468', 0, '', 0, '2020-02-16 17:57:32', '2020-02-16 17:57:32'),
(6, 4, 'student', 'ssf', 'student ssf', '', 'ss@gmail.com', '$2y$10$riXm0MeuL4inB5y9wg41h.9eynIfExy19r4PULPBa7SjVhVhxjkEi', '', '12345644322', '', '0.00000000', '0.00000000', 1, '23bf25f40c4cb1b867452418904358fb6b8b787b', 'a9bee16e8b4da44ba9d43486fb39d61e50c36256', 0, '', 0, '2020-02-16 18:20:01', '2020-02-16 18:20:01'),
(7, 3, 'Test', 'test', 'Test test', '', 'test@gmail.com', '$2y$10$1nMC32iqa.2YIc2Jt2nBiuA55aNqkAFBVDTTUkctG7vqYlSmNh80C', '', '1234567890', '', '0.00000000', '0.00000000', 1, '6870f7a186692586ca966eceb994bfdb983414e3', 'c81a124c7c6b75ab9ecd359c31c773ed6ce1b6d5', 0, '', 0, '2020-02-16 19:16:55', '2020-02-16 19:19:52');

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
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Active',
  `crd` timestamp NOT NULL DEFAULT current_timestamp(),
  `upd` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
-- Indexes for table `institute_classes`
--
ALTER TABLE `institute_classes`
  ADD PRIMARY KEY (`classId`),
  ADD KEY `instituteId` (`instituteId`);

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
-- Indexes for table `student_assign_teacher`
--
ALTER TABLE `student_assign_teacher`
  ADD PRIMARY KEY (`teacherAssignId`),
  ADD KEY `instituteId` (`instituteId`),
  ADD KEY `teacherId` (`teacherId`),
  ADD KEY `studentId` (`studentId`);

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
-- AUTO_INCREMENT for table `institute_classes`
--
ALTER TABLE `institute_classes`
  MODIFY `classId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `institute_parents`
--
ALTER TABLE `institute_parents`
  MODIFY `joinId` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institute_staff`
--
ALTER TABLE `institute_staff`
  MODIFY `joinId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `institute_student`
--
ALTER TABLE `institute_student`
  MODIFY `joinId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `institute_teacher`
--
ALTER TABLE `institute_teacher`
  MODIFY `joinId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_assign_teacher`
--
ALTER TABLE `student_assign_teacher`
  MODIFY `teacherAssignId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
