-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 06, 2020 at 11:41 AM
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
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `blogId` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1:Active',
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `pageId` bigint(20) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `description` text CHARACTER SET utf8mb4 NOT NULL,
  `meta_title` text CHARACTER SET utf8mb4 NOT NULL,
  `meta_keyword` text CHARACTER SET utf8mb4 NOT NULL,
  `meta_description` text CHARACTER SET utf8mb4 NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1:Active',
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`pageId`, `title`, `slug`, `description`, `meta_title`, `meta_keyword`, `meta_description`, `status`, `crd`, `upd`) VALUES
(2, 'gsdsggdsg', 'gsdsggdsg', '<p>fgfdsgggdg</p>', '', '', '', 1, '2020-03-06 09:09:58', '2020-03-06 09:24:09'),
(3, 'test', 'test', '<div class=\"row\" style=\"color: rgb(103, 106, 108); font-family: &quot;Open Sans&quot;, helvetica, arial, sans-serif;\"><div class=\"col-lg-5 col-lg-offset-1 features-text\" style=\"width: 487.5px; margin-left: 97.5px; margin-top: 40px;\"><small style=\"font-size: 11.05px; color: rgb(26, 179, 148);\">INSPINIA</small><h2 style=\"font-family: inherit; margin-top: 5px; font-size: 18px;\">Perfectly designed</h2><span class=\"fa fa-bar-chart big-icon pull-right\" style=\"font-size: 56px !important; color: rgb(26, 179, 148) !important;\"></span><p style=\"color: rgb(174, 174, 174);\">INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with.</p></div><div class=\"col-lg-5 features-text\" style=\"width: 487.5px; margin-top: 40px;\"><small style=\"font-size: 11.05px; color: rgb(26, 179, 148);\">INSPINIA</small><h2 style=\"font-family: inherit; margin-top: 5px; font-size: 18px;\">Perfectly designed</h2><span class=\"fa fa-bolt big-icon pull-right\" style=\"font-size: 56px !important; color: rgb(26, 179, 148) !important;\"></span><p style=\"color: rgb(174, 174, 174);\">INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with.</p></div></div><div class=\"row\" style=\"color: rgb(103, 106, 108); font-family: &quot;Open Sans&quot;, helvetica, arial, sans-serif;\"><div class=\"col-lg-5 col-lg-offset-1 features-text\" style=\"width: 487.5px; margin-left: 97.5px; margin-top: 40px;\"><small style=\"font-size: 11.05px; color: rgb(26, 179, 148);\">INSPINIA</small><h2 style=\"font-family: inherit; margin-top: 5px; font-size: 18px;\">Perfectly designed</h2><span class=\"fa fa-clock-o big-icon pull-right\" style=\"font-size: 56px !important; color: rgb(26, 179, 148) !important;\"></span><p style=\"color: rgb(174, 174, 174);\">INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with.</p></div><div class=\"col-lg-5 features-text\" style=\"width: 487.5px; margin-top: 40px;\"><small style=\"font-size: 11.05px; color: rgb(26, 179, 148);\">INSPINIA</small><h2 style=\"font-family: inherit; margin-top: 5px; font-size: 18px;\">Perfectly designed</h2><span class=\"fa fa-users big-icon pull-right\" style=\"font-size: 56px !important; color: rgb(26, 179, 148) !important;\"></span><p style=\"color: rgb(174, 174, 174);\">INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of</p></div></div>', '', '', '', 1, '2020-03-06 09:55:26', '2020-03-06 09:55:26'),
(4, 'gxdfgdfgdfgdgdh', 'gxdfgdfgdfgdgdh', '<p> <div class=\"row\"></p><p>            <div class=\"col-lg-12 text-center\"></p><p>                <div class=\"navy-line\"></div></p><p>                <h1>More and more extra great feautres</h1></p><p>                <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. </p></p><p>            </div></p><p>        </div></p><p>        <div class=\"row\"></p><p>            <div class=\"col-lg-5 col-lg-offset-1 features-text\"></p><p>                <small>INSPINIA</small></p><p>                <h2>Perfectly designed </h2></p><p>                <i class=\"fa fa-bar-chart big-icon pull-right\"></i></p><p>                <p>INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with.</p></p><p>            </div></p><p>            <div class=\"col-lg-5 features-text\"></p><p>                <small>INSPINIA</small></p><p>                <h2>Perfectly designed </h2></p><p>                <i class=\"fa fa-bolt big-icon pull-right\"></i></p><p>                <p>INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with.</p></p><p>            </div></p><p>        </div></p><p>        <div class=\"row\"></p><p>            <div class=\"col-lg-5 col-lg-offset-1 features-text\"></p><p>                <small>INSPINIA</small></p><p>                <h2>Perfectly designed </h2></p><p>                <i class=\"fa fa-clock-o big-icon pull-right\"></i></p><p>                <p>INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with.</p></p><p>            </div></p><p>            <div class=\"col-lg-5 features-text\"></p><p>                <small>INSPINIA</small></p><p>                <h2>Perfectly designed </h2></p><p>                <i class=\"fa fa-users big-icon pull-right\"></i></p><p>                <p>INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with.</p></p><p>            </div></p><p>        </div></p>', 'dfhdfhdh', 'dhdhdh', 'hdhdhhhdh', 1, '2020-03-06 10:10:27', '2020-03-06 10:33:01'),
(5, 'bdfhd', 'bdfhd', '<p>hdfhdh</p>', 'dfhdhd', 'dfhdhd', 'dfh', 1, '2020-03-06 10:34:10', '2020-03-06 10:34:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blogId`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`pageId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blogId` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `pageId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
