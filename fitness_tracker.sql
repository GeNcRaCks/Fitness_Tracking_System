-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2025 at 08:30 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitness_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(8) DEFAULT NULL,
  `e_mail` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `username`, `password`, `e_mail`) VALUES
(1, 'admin1', 'pass1234', 'admin1@gmail.com'),
(2, 'admin2', 'pass5678', 'admin2@example.com'),
(3, 'admin3', 'pass9101', 'admin2@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `excerciseid` int(11) NOT NULL,
  `ex_name` varchar(20) DEFAULT NULL,
  `sets` int(11) DEFAULT NULL,
  `reps` int(11) DEFAULT NULL,
  `workoutid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`excerciseid`, `ex_name`, `sets`, `reps`, `workoutid`) VALUES
(35, 'Push-ups', 3, 12, 9),
(36, 'Squats', 3, 15, 9),
(37, 'Deadlifts', 1, 5, 9),
(38, 'Bench Press', 3, 8, 10),
(39, 'Overhead Press', 3, 10, 10),
(40, 'Rows', 3, 12, 10),
(41, 'Squats', 3, 12, 11),
(42, 'Leg Press', 3, 12, 11),
(43, 'Hamstring Curls', 3, 12, 11),
(44, 'Burpees', 3, 10, 12),
(45, 'Jumping Jacks', 3, 30, 12),
(46, 'High Knees', 3, 30, 12),
(47, 'Downward Dog', 3, 30, 13),
(48, 'Plank', 3, 30, 13),
(49, 'Cobra Pose', 3, 30, 13),
(50, 'Burpees', 4, 10, 14),
(51, 'Mountain Climbers', 4, 30, 14),
(52, 'Jumping Jacks', 4, 30, 14),
(53, 'Plank', 3, 30, 15),
(54, 'Crunches', 3, 15, 15),
(55, 'Leg Raises', 3, 15, 15),
(56, 'Running', 1, 30, 16),
(57, 'Swimming', 1, 30, 16),
(58, 'Cycling', 1, 30, 16);

-- --------------------------------------------------------

--
-- Table structure for table `progress_report`
--

CREATE TABLE `progress_report` (
  `reportid` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `calories_burned` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `workoutid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `progress_report`
--

INSERT INTO `progress_report` (`reportid`, `start_date`, `end_date`, `calories_burned`, `userid`, `workoutid`) VALUES
(5, '2025-01-23', '2025-01-23', 248, 5, 9),
(6, '2025-01-23', '2025-01-23', 451, 5, 9),
(7, '2025-01-23', '2025-01-23', 290, 5, 9);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `age` int(11) GENERATED ALWAYS AS (timestampdiff(YEAR,`DOB`,curdate())) VIRTUAL,
  `e_mail` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `DOB`, `e_mail`, `password`, `weight`) VALUES
(5, 'AliRaza', '2005-10-14', 'alijafry005@gmail.com', '$2y$10$IZDYTq4Kq1pIvdvczU73e.8UJQ7VKDJXpBViN./qOxuL8SAnyADu.', 51);

-- --------------------------------------------------------

--
-- Table structure for table `user_participation`
--

CREATE TABLE `user_participation` (
  `userid` int(11) DEFAULT NULL,
  `workoutid` int(11) DEFAULT NULL,
  `participation_status` varchar(3) DEFAULT NULL CHECK (`participation_status` in ('YES','NO')),
  `start_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_participation`
--

INSERT INTO `user_participation` (`userid`, `workoutid`, `participation_status`, `start_date`) VALUES
(5, 9, 'NO', '2025-01-23 20:06:53'),
(5, 10, 'NO', '2025-01-23 20:06:56'),
(5, 12, 'NO', '2025-01-23 20:07:00'),
(5, 9, 'NO', '2025-01-23 20:13:43'),
(5, 9, 'NO', '2025-01-23 20:18:54'),
(5, 9, 'NO', '2025-01-23 20:20:29'),
(5, 9, 'NO', '2025-01-23 20:22:38');

-- --------------------------------------------------------

--
-- Table structure for table `workout`
--

CREATE TABLE `workout` (
  `workoutid` int(11) NOT NULL,
  `w_name` varchar(20) DEFAULT NULL,
  `w_time` time DEFAULT NULL,
  `adminid` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `workout`
--

INSERT INTO `workout` (`workoutid`, `w_name`, `w_time`, `adminid`, `status`, `userid`) VALUES
(9, 'Full Body Workout', '01:00:00', 1, NULL, NULL),
(10, 'Upper Body Strength', '01:30:00', 2, NULL, NULL),
(11, 'Lower Body Strength', '01:00:00', 3, NULL, NULL),
(12, 'Cardio Blast', '00:45:00', 1, NULL, NULL),
(13, 'Yoga and Flexibility', '01:00:00', 2, NULL, NULL),
(14, 'HIIT Training', '00:30:00', 3, NULL, NULL),
(15, 'Core Strength', '00:40:00', 1, NULL, NULL),
(16, 'Endurance Training', '01:15:00', 2, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`excerciseid`),
  ADD KEY `workoutid` (`workoutid`);

--
-- Indexes for table `progress_report`
--
ALTER TABLE `progress_report`
  ADD PRIMARY KEY (`reportid`),
  ADD KEY `progress_report_ibfk_1` (`userid`),
  ADD KEY `workoutid` (`workoutid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `user_participation`
--
ALTER TABLE `user_participation`
  ADD KEY `workoutid` (`workoutid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `workout`
--
ALTER TABLE `workout`
  ADD PRIMARY KEY (`workoutid`),
  ADD KEY `adminid` (`adminid`),
  ADD KEY `fk_userid` (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `excerciseid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `progress_report`
--
ALTER TABLE `progress_report`
  MODIFY `reportid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `workout`
--
ALTER TABLE `workout`
  MODIFY `workoutid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exercises`
--
ALTER TABLE `exercises`
  ADD CONSTRAINT `exercises_ibfk_1` FOREIGN KEY (`workoutid`) REFERENCES `workout` (`workoutid`);

--
-- Constraints for table `progress_report`
--
ALTER TABLE `progress_report`
  ADD CONSTRAINT `progress_report_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`),
  ADD CONSTRAINT `progress_report_ibfk_2` FOREIGN KEY (`workoutid`) REFERENCES `workout` (`workoutid`);

--
-- Constraints for table `user_participation`
--
ALTER TABLE `user_participation`
  ADD CONSTRAINT `user_participation_ibfk_1` FOREIGN KEY (`workoutid`) REFERENCES `workout` (`workoutid`);

--
-- Constraints for table `workout`
--
ALTER TABLE `workout`
  ADD CONSTRAINT `fk_userid` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`),
  ADD CONSTRAINT `workout_ibfk_1` FOREIGN KEY (`adminid`) REFERENCES `admin` (`adminid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
