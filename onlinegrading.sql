-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2019 at 06:51 PM
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
-- Database: `onlinegrading`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(10) NOT NULL,
  `accountType` int(1) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first` varchar(50) NOT NULL,
  `middle` varchar(50) NOT NULL,
  `last` varchar(50) NOT NULL,
  `year` varchar(8) NOT NULL DEFAULT '0',
  `section` varchar(20) NOT NULL DEFAULT '0',
  `schoolYear` int(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `accountType`, `username`, `password`, `first`, `middle`, `last`, `year`, `section`, `schoolYear`) VALUES
(1, 0, 'admin', '$2y$10$.o7E/75Te4D.OiXmzd.eLO3K8C/YaEET0Bifc.zBXQSh28oxVyvbC', 'admin', 'admin', 'admin', '0', '0', 0),
(2, 1, 'SageGonzales', '$2y$10$/d0fCBrFTjXaEumJPKPgfOrBsLwnrWgxXRydUeogOcGIg8dYGZzre', 'Sage', 'A', 'Gonzales', '0', '0', 0),
(16, 1, 'RolandRegacho', '$2y$10$E.ty9hMq.txFaRUOIgtXj.N74ceSeiUzKhqNDEoq8SAskMGM6CZoa', 'Roland', 'Too', 'Regacho', '0', '0', 0),
(17, 1, 'RigorAbargos', '$2y$10$vUBl6I8Tp6.aqUOBXVivEOiWTHHbRol2x9Q4cUuAIo33mQz5jCJSu', 'Rigor', '', 'Abargos', '0', '0', 0),
(21, 2, '20123123', '$2y$10$Tx62tDSYfeInI0VswsvDUOnFJ9/IFk0wISKiSImjynxXUE6XPvOj.', 'sdadasdasdasdsa', 'asd', 'asdadad', 'Grade 2', 'second', 20),
(22, 2, '20123131', '$2y$10$T8DVW6hr9W45dv6KJubIyeAZY/NLdC.pU5KeifR0wBhkKehrGI1JS', 'ojklljl', 'ljljkjl', 'l', 'Grade 3', 'third', 20),
(23, 2, '2012323', '$2y$10$d.ZLR4FyIAnqFNDOtrxvVugdWk0Gnw6Z175TcjXQrXnmRw3JOjMT.', 'uyyioyiu', 'dsd', 'rtrt', 'Grade 2', 'second', 20),
(24, 2, '23421234', '$2y$10$au3ItgZhj00Yp.Sc1DVfKuvg3dFFqmaOaJc7mqIInanMYaeNWte8m', 'sdfdf', 'sdda', 'erte', 'Grade 2', 'second', 20),
(25, 2, '12322323', '$2y$10$y6EF0IKQX6c.EqdC6LQVJusSz9W8agl2sqs6moUtwdYHipQW6Y3Rq', 'hjkhk', 'asd', 'ddg', 'Grade 3', 'third', 20),
(26, 2, '1232323', '$2y$10$5XkBW74q8DgRWg9m62KYSupTYB9u6kDYEWH/wBlawhpTp2plWRyv.', 'sh', 's', 'to', 'Grade 11', 'eleven', 20),
(27, 2, 'Subject Code', '$2y$10$G98bY6R3Ute.Zp70sdQh.ejYQbc6ttNRtRmU.RSlsHcIrIzadYfnK', 'Subject Description', '', '', '', '', 20),
(28, 2, 'Math1', '$2y$10$f10fe38J1AY6uhdr5wy7yOD3vW0UW3q/cx4FfnIUibKIs3DHRy.Xm', 'Mathematics', '', '', '', '', 20);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(10) NOT NULL,
  `studentNumber` varchar(20) NOT NULL,
  `subjCode` varchar(20) NOT NULL,
  `grade` float NOT NULL,
  `section` varchar(20) NOT NULL,
  `period` varchar(11) NOT NULL,
  `schoolYear` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `studentNumber`, `subjCode`, `grade`, `section`, `period`, `schoolYear`) VALUES
(3, '1232323', 'Research101', 25, 'eleven', '1st Sem', 20),
(4, '20123123', 'Fil2', 76, 'second', '1st Grading', 20),
(5, '2012323', 'Fil2', 25, 'second', '1st Grading', 20),
(6, '23421234', 'Fil2', 34, 'second', '1st Grading', 20),
(7, '1232323', 'Research101', 76, 'eleven', '2nd Sem', 20),
(8, '20123123', 'Fil2', 70, 'second', '2nd Grading', 20),
(9, '2012323', 'Fil2', 70, 'second', '2nd Grading', 20),
(10, '23421234', 'Fil2', 70, 'second', '2nd Grading', 20);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `sectionID` int(30) NOT NULL,
  `section` varchar(20) NOT NULL,
  `year` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`sectionID`, `section`, `year`) VALUES
(11, 'second', 'Grade 2'),
(12, 'third', 'Grade 3'),
(13, 'eleven', 'Grade 11');

-- --------------------------------------------------------

--
-- Table structure for table `studentlist`
--

CREATE TABLE `studentlist` (
  `studentNumber` varchar(20) NOT NULL,
  `first` varchar(50) NOT NULL,
  `middle` varchar(50) NOT NULL,
  `last` varchar(50) NOT NULL,
  `year` varchar(20) NOT NULL,
  `section` varchar(20) NOT NULL,
  `schoolYear` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentlist`
--

INSERT INTO `studentlist` (`studentNumber`, `first`, `middle`, `last`, `year`, `section`, `schoolYear`) VALUES
('12322323', 'hjkhk', 'asd', 'ddg', 'Grade 3', 'third', 20),
('1232323', 'sh', 's', 'to', 'Grade 11', 'eleven', 20),
('20123123', 'sdadasdasdasdsa', 'asd', 'asdadad', 'Grade 2', 'second', 20),
('20123131', 'ojklljl', 'ljljkjl', 'l', 'Grade 3', 'third', 20),
('2012323', 'uyyioyiu', 'dsd', 'rtrt', 'Grade 2', 'second', 20),
('23421234', 'sdfdf', 'sdda', 'erte', 'Grade 2', 'second', 20);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subjID` int(10) NOT NULL,
  `subjcode` varchar(20) NOT NULL,
  `subjdesc` varchar(255) NOT NULL,
  `year` varchar(20) NOT NULL,
  `teacher` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subjID`, `subjcode`, `subjdesc`, `year`, `teacher`) VALUES
(4, 'Fil2', 'Filipino', 'Grade 2', 'SageGonzales'),
(5, 'Math2', 'Mathematics', 'Grade 2', 'SageGonzales'),
(7, 'Sci2', 'Science', 'Grade 2', 'SageGonzales'),
(8, 'AP2', 'Makabayan', 'Grade 2', 'SageGonzales'),
(9, 'Eng2', 'English', 'Grade 2', 'SageGonzales'),
(10, 'Eng3', 'English', 'Grade 3', 'RolandRegacho'),
(11, 'Sci3', 'Science', 'Grade 3', 'RigorAbargos'),
(12, 'Research101', 'Research Methodologies', 'Grade 11', 'SageGonzales'),
(16, 'Math1', 'Mathematics', 'Grade 1', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
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
-- Indexes for table `studentlist`
--
ALTER TABLE `studentlist`
  ADD PRIMARY KEY (`studentNumber`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subjID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `sectionID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subjID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
