-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2023 at 08:10 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinegradingv2`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(10) NOT NULL,
  `accountType` int(1) NOT NULL,
  `record_id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `accountType`, `record_id`, `username`, `password`, `is_deleted`, `date_time`) VALUES
(1, 0, 1, 'admin', '$2y$10$.o7E/75Te4D.OiXmzd.eLO3K8C/YaEET0Bifc.zBXQSh28oxVyvbC', 0, '2023-03-22 06:14:03');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `first_name`, `middle_name`, `last_name`, `is_deleted`, `date_time`) VALUES
(1, 'Admin', '', 'Account', 0, '2023-03-22 06:14:16');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(10) NOT NULL,
  `studentNumber` varchar(20) NOT NULL,
  `subjCode` varchar(20) NOT NULL,
  `first_grading` int(11) DEFAULT NULL,
  `second_grading` int(11) DEFAULT NULL,
  `third_grading` int(11) DEFAULT NULL,
  `fourth_grading` int(11) DEFAULT NULL,
  `final_grade` int(11) DEFAULT NULL,
  `section` varchar(20) NOT NULL,
  `schoolYear` int(4) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `studentNumber`, `subjCode`, `first_grading`, `second_grading`, `third_grading`, `fourth_grading`, `final_grade`, `section`, `schoolYear`, `date_time`) VALUES
(3, '1232323', 'Research101', 25, 76, NULL, NULL, NULL, '13', 2020, '2023-03-21 01:33:48'),
(4, '20123123', 'Fil2', 76, 70, NULL, NULL, NULL, '11', 2020, '2023-03-21 01:33:55'),
(5, '2012323', 'Fil2', 25, 70, NULL, NULL, NULL, '11', 2020, '2023-03-21 01:34:01'),
(6, '23421234', 'Fil2', 34, 70, NULL, NULL, NULL, '11', 2020, '2023-03-21 01:34:03');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `sectionID` int(30) NOT NULL,
  `section` varchar(20) NOT NULL,
  `year` varchar(20) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`sectionID`, `section`, `year`, `is_deleted`, `date_time`) VALUES
(11, 'second', 'Grade 2', 0, '2023-03-06 03:13:09'),
(12, 'third', 'Grade 3', 0, '2023-03-06 03:13:09'),
(13, 'eleven', 'Grade 11', 0, '2023-03-06 03:13:09'),
(14, 'fifth', 'Grade 5', 0, '2023-03-20 03:45:24');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studentNumber` varchar(20) NOT NULL,
  `first` varchar(50) NOT NULL,
  `middle` varchar(50) NOT NULL,
  `last` varchar(50) NOT NULL,
  `year` varchar(20) NOT NULL,
  `section` varchar(20) NOT NULL,
  `schoolYear` int(10) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studentNumber`, `first`, `middle`, `last`, `year`, `section`, `schoolYear`, `is_deleted`, `date_time`) VALUES
('12322323', 'hjkhk', 'asd', 'ddg', 'Grade 3', '12', 2020, 0, '2023-03-22 07:07:51'),
('1232323', 'sh', 's', 'to', 'Grade 11', '13', 2020, 0, '2023-03-22 07:07:54'),
('20123123', 'sdadasdasdasdsa', 'asd', 'asdadad', 'Grade 2', '11', 2020, 0, '2023-03-22 07:07:56'),
('20123131', 'ojklljl', 'ljljkjl', 'l', 'Grade 3', '12', 2020, 0, '2023-03-22 07:08:01'),
('2012323', 'uyyioyiu', 'dsd', 'rtrt', 'Grade 2', '11', 2020, 0, '2023-03-22 07:08:03'),
('23421234', 'sdfdf', 'sdda', 'erte', 'Grade 2', '11', 2020, 0, '2023-03-22 07:08:06');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subjID` int(10) NOT NULL,
  `subjcode` varchar(20) NOT NULL,
  `subjdesc` varchar(255) NOT NULL,
  `year` varchar(20) NOT NULL,
  `teacher` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subjID`, `subjcode`, `subjdesc`, `year`, `teacher`, `is_deleted`, `date_time`) VALUES
(20, 'Fil2', 'Filipino', 'Grade 2', '1', 0, '2023-03-21 07:33:33'),
(21, 'Math2', 'Math', 'Grade 2', '2', 0, '2023-03-21 07:33:36'),
(22, 'Eng2', 'English', 'Grade 2', '1', 0, '2023-03-21 07:33:52');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `first_name`, `middle_name`, `last_name`, `is_deleted`, `date_time`) VALUES
(1, 'Roland', 'Too', 'Regacho', 0, '2023-03-21 07:27:52'),
(2, 'Diana', 'Sorera', 'Torsuela', 0, '2023-03-21 07:30:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`sectionID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studentNumber`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subjID`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `sectionID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subjID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
