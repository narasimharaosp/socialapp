-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 26, 2019 at 02:54 PM
-- Server version: 5.7.24-0ubuntu0.16.04.1
-- PHP Version: 7.0.33-10+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socialappdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `logintype` int(1) DEFAULT NULL COMMENT '1-email, 2-google, 3-facebook',
  `logincount` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Authentication information';

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`id`, `uid`, `logintype`, `logincount`, `created`, `updated`) VALUES
(1, 1, 1, 1, '2019-08-26 14:27:16', '2019-08-26 14:27:16'),
(2, 2, 1, 1, '2019-08-26 14:52:44', '2019-08-26 14:52:44');

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `logintype` varchar(20) DEFAULT NULL,
  `logindate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`id`, `uid`, `logintype`, `logindate`) VALUES
(1, 1, 'Email', '2019-08-26 14:27:16'),
(2, 2, 'Email', '2019-08-26 14:52:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL COMMENT 'unique id',
  `userid` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `gender` int(1) DEFAULT NULL COMMENT '0-Male, 1-Female',
  `email` varchar(255) DEFAULT NULL,
  `role` int(1) DEFAULT NULL COMMENT '1-admin, 2-auth user',
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `status` int(1) DEFAULT NULL COMMENT '1-active, 0-deleted',
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='user information';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `userid`, `name`, `pass`, `age`, `gender`, `email`, `role`, `latitude`, `longitude`, `status`, `created`, `updated`, `deleted`) VALUES
(1, 'admin', 'admin', '25d55ad283aa400af464c76d713c07ad', 100, 0, 'simha.sp@yopmail.com', 1, 12.972442, 77.580643, 1, '2019-08-24 00:07:28', NULL, '2019-08-25 15:17:39'),
(2, 'user15d63a4e254f67', 'user1', '25d55ad283aa400af464c76d713c07ad', 123, 0, 'user1@yopmail.com', 2, 0, 0, 1, '2019-08-26 14:52:42', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `User id` (`uid`);

--
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'unique id', AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `login_details`
--
ALTER TABLE `login_details`
  ADD CONSTRAINT `User id` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
