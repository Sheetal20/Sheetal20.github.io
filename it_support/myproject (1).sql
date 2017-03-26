-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2017 at 02:16 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_complain`
--

CREATE TABLE `add_complain` (
  `complain_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `type_id` int(11) NOT NULL,
  `desc_id` int(11) NOT NULL,
  `it_id` int(11) NOT NULL,
  `complain_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `complain_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `resolve_date` date DEFAULT NULL,
  `resolve_time` datetime DEFAULT NULL,
  `complain_status` varchar(50) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_complain`
--

INSERT INTO `add_complain` (`complain_id`, `dept_id`, `emp_id`, `email`, `type_id`, `desc_id`, `it_id`, `complain_date`, `complain_time`, `resolve_date`, `resolve_time`, `complain_status`) VALUES
(3, 6, 5, 'kabita20@gmail.com', 1, 5, 1, '2016-06-05 10:40:31', '2016-06-05 10:40:31', '2016-06-06', '2016-06-06 20:08:11', 'Resolved'),
(6, 6, 10, 'saileja56@gmail.com', 6, 2, 4, '2016-06-05 18:09:35', '2016-06-05 18:09:35', '2016-06-25', '2016-06-25 19:36:54', 'Resolved'),
(7, 5, 1, 'sheetalswain12@gmail.com', 6, 2, 4, '2016-07-14 17:58:48', '2016-07-14 17:58:48', '2016-08-06', '2016-08-06 19:07:51', 'Resolved');

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `userid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`userid`, `username`, `password`) VALUES
(101, 'admin', 'byte@123');

-- --------------------------------------------------------

--
-- Table structure for table `complain_desc`
--

CREATE TABLE `complain_desc` (
  `desc_id` int(11) NOT NULL,
  `desc_name` varchar(50) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complain_desc`
--

INSERT INTO `complain_desc` (`desc_id`, `desc_name`, `type_id`) VALUES
(1, 'Not Connect', 1),
(2, 'Not Working', 6),
(4, 'Not Printing', 2),
(5, 'Very Slow', 1),
(8, 'Not Working', 7);

-- --------------------------------------------------------

--
-- Table structure for table `complain_type`
--

CREATE TABLE `complain_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complain_type`
--

INSERT INTO `complain_type` (`type_id`, `type_name`) VALUES
(1, 'Internet'),
(6, 'Keyboard'),
(2, 'Printer'),
(7, 'UPS');

-- --------------------------------------------------------

--
-- Table structure for table `dept_details`
--

CREATE TABLE `dept_details` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dept_details`
--

INSERT INTO `dept_details` (`dept_id`, `dept_name`) VALUES
(6, 'Customer Relation'),
(5, 'Finance'),
(4, 'Marketing'),
(8, 'R & D'),
(7, 'Sales');

-- --------------------------------------------------------

--
-- Table structure for table `emp_details`
--

CREATE TABLE `emp_details` (
  `emp_id` int(11) NOT NULL,
  `emp_name` varchar(50) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `system_ip` varchar(50) NOT NULL,
  `system_name` varchar(50) NOT NULL,
  `mob_no` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_details`
--

INSERT INTO `emp_details` (`emp_id`, `emp_name`, `dept_id`, `system_ip`, `system_name`, `mob_no`, `email`, `reg_date`) VALUES
(1, 'Sheetal Swain', 5, 'System.abc', 'System5', '9175674583', 'sheetalswain12@gmail.com', '2016-06-01 17:04:33'),
(4, 'Komal Swain', 4, 'System.z22', 'System12', '9045687910', 'komal12@gmail.com', '2016-06-01 19:51:27'),
(5, 'Kabita Agarwal', 6, 'System.k22', 'System14', '8967532415', 'kabita20@gmail.com', '2016-06-03 15:51:14'),
(8, 'Krishna Pradhan', 7, 'System.r32', 'System15', '7890889090', 'kpradhan111@gmail.com', '2016-06-03 15:57:49'),
(10, 'Saileja Dash', 6, 'System.h34', 'System78', '7346287129', 'saileja56@gmail.com', '2016-06-05 11:24:18');

-- --------------------------------------------------------

--
-- Table structure for table `it_details`
--

CREATE TABLE `it_details` (
  `it_id` int(11) NOT NULL,
  `it_name` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `mob_no` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `it_details`
--

INSERT INTO `it_details` (`it_id`, `it_name`, `user_name`, `mob_no`, `email`, `password`, `reg_date`) VALUES
(1, 'Reema Dash', 'Reema25', '9090524533', 'reema25dash@gmail.com', 'reema@25', '2016-06-02 09:23:23'),
(4, 'Devashree Rao', 'Devashree33', '9876543218', 'devashree33@gmail.com', 'devashree@33', '2016-06-02 10:37:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_complain`
--
ALTER TABLE `add_complain`
  ADD PRIMARY KEY (`complain_id`),
  ADD KEY `complain_id` (`complain_id`),
  ADD KEY `dept_id` (`dept_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `desc_id` (`desc_id`),
  ADD KEY `it_id` (`it_id`);

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `complain_desc`
--
ALTER TABLE `complain_desc`
  ADD PRIMARY KEY (`desc_id`),
  ADD KEY `desc_id` (`desc_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `complain_type`
--
ALTER TABLE `complain_type`
  ADD PRIMARY KEY (`type_id`),
  ADD UNIQUE KEY `type_name` (`type_name`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `dept_details`
--
ALTER TABLE `dept_details`
  ADD PRIMARY KEY (`dept_id`),
  ADD UNIQUE KEY `dept_name` (`dept_name`),
  ADD UNIQUE KEY `dept_name_2` (`dept_name`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `emp_details`
--
ALTER TABLE `emp_details`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `dept_id` (`dept_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `it_details`
--
ALTER TABLE `it_details`
  ADD PRIMARY KEY (`it_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD KEY `it_id` (`it_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_complain`
--
ALTER TABLE `add_complain`
  MODIFY `complain_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `complain_desc`
--
ALTER TABLE `complain_desc`
  MODIFY `desc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `complain_type`
--
ALTER TABLE `complain_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `dept_details`
--
ALTER TABLE `dept_details`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `emp_details`
--
ALTER TABLE `emp_details`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `it_details`
--
ALTER TABLE `it_details`
  MODIFY `it_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `add_complain`
--
ALTER TABLE `add_complain`
  ADD CONSTRAINT `add_complain_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `dept_details` (`dept_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `add_complain_ibfk_2` FOREIGN KEY (`emp_id`) REFERENCES `emp_details` (`emp_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `add_complain_ibfk_3` FOREIGN KEY (`type_id`) REFERENCES `complain_type` (`type_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `add_complain_ibfk_4` FOREIGN KEY (`desc_id`) REFERENCES `complain_desc` (`desc_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `add_complain_ibfk_5` FOREIGN KEY (`it_id`) REFERENCES `it_details` (`it_id`) ON DELETE CASCADE;

--
-- Constraints for table `complain_desc`
--
ALTER TABLE `complain_desc`
  ADD CONSTRAINT `complain_desc_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `complain_type` (`type_id`) ON DELETE CASCADE;

--
-- Constraints for table `emp_details`
--
ALTER TABLE `emp_details`
  ADD CONSTRAINT `emp_details_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `dept_details` (`dept_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
