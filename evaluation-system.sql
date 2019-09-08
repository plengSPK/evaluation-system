-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2019 at 06:11 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evaluation-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `approves`
--

CREATE TABLE `approves` (
  `approve_id` int(11) NOT NULL,
  `approve_user_id` int(11) NOT NULL,
  `reason` text DEFAULT NULL,
  `request_id` int(11) NOT NULL,
  `last_update` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `approves`
--

INSERT INTO `approves` (`approve_id`, `approve_user_id`, `reason`, `request_id`, `last_update`) VALUES
(1, 5, NULL, 1, '2019-09-08');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`) VALUES
(1, 'Marketing'),
(2, 'Human Resource Management'),
(3, 'Accounting and Finance'),
(4, 'Developer');

-- --------------------------------------------------------

--
-- Table structure for table `evaluates`
--

CREATE TABLE `evaluates` (
  `evaluate_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `evaluator_user_id` int(11) NOT NULL,
  `target_user_id` int(11) NOT NULL,
  `last_update` date NOT NULL,
  `time_mange_score` int(11) NOT NULL,
  `quality_score` int(11) NOT NULL,
  `creativity_score` int(11) NOT NULL,
  `teamwork_score` int(11) NOT NULL,
  `discipline_score` int(11) NOT NULL,
  `quarter` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `evaluates`
--

INSERT INTO `evaluates` (`evaluate_id`, `department_id`, `evaluator_user_id`, `target_user_id`, `last_update`, `time_mange_score`, `quality_score`, `creativity_score`, `teamwork_score`, `discipline_score`, `quarter`, `year`) VALUES
(1, 4, 1, 2, '2019-09-07', 2, 2, 2, 2, 2, 3, 2019),
(2, 4, 1, 6, '2019-09-07', 2, 3, 1, 1, 1, 3, 2019),
(3, 4, 1, 3, '2019-09-07', 4, 4, 4, 4, 4, 3, 2019),
(4, 4, 2, 1, '2019-09-07', 4, 3, 3, 4, 4, 3, 2019),
(5, 4, 3, 1, '2019-09-07', 3, 3, 4, 4, 4, 3, 2019),
(6, 4, 6, 1, '2019-09-07', 4, 4, 3, 4, 3, 3, 2019),
(7, 4, 2, 1, '2019-05-05', 2, 2, 2, 2, 2, 2, 2019),
(8, 4, 3, 1, '2019-05-05', 3, 3, 3, 3, 2, 2, 2019),
(9, 4, 6, 1, '2019-05-05', 3, 2, 3, 2, 3, 2, 2019);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `request_id` int(11) NOT NULL,
  `detail` text NOT NULL,
  `salary_target` int(11) NOT NULL,
  `target_user_id` int(11) NOT NULL,
  `by_user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `last_update` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`request_id`, `detail`, `salary_target`, `target_user_id`, `by_user_id`, `department_id`, `status`, `last_update`) VALUES
(1, 'She has a lot of improvement and discipline.\r\n', 37000, 1, 4, 4, 1, '2019-09-08'),
(2, 'He has a lot of potentials and very creative.\r\n', 35000, 3, 4, 4, 0, '2019-09-08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `salary` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `name`, `password`, `department_id`, `level`, `salary`) VALUES
(1, 'nicole@mail.com', 'Nicole', '781e5e245d69b566979b86e28d23f2c7', 4, 1, 35000),
(2, 'sara@mail.com', 'Sara', '781e5e245d69b566979b86e28d23f2c7', 4, 1, 25000),
(3, 'nate@mail.com', 'Nate', '781e5e245d69b566979b86e28d23f2c7', 4, 1, 29000),
(4, 'ava@mail.com', 'Ava', '781e5e245d69b566979b86e28d23f2c7', 4, 2, 0),
(5, 'ren@mail.com', 'Ren', '781e5e245d69b566979b86e28d23f2c7', 4, 3, 0),
(6, 'gary@mail.com', 'Gary', '781e5e245d69b566979b86e28d23f2c7', 4, 1, 22000),
(7, 'harper@mail.com', 'Harper', '781e5e245d69b566979b86e28d23f2c7', 1, 1, 22000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approves`
--
ALTER TABLE `approves`
  ADD PRIMARY KEY (`approve_id`),
  ADD KEY `FK_approve` (`approve_user_id`),
  ADD KEY `FK_approve2` (`request_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `evaluates`
--
ALTER TABLE `evaluates`
  ADD PRIMARY KEY (`evaluate_id`),
  ADD KEY `FK1` (`evaluator_user_id`),
  ADD KEY `FK2` (`target_user_id`),
  ADD KEY `FK3` (`department_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `FK_request` (`target_user_id`),
  ADD KEY `FK_request2` (`by_user_id`),
  ADD KEY `FK_request3` (`department_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE,
  ADD KEY `FK` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approves`
--
ALTER TABLE `approves`
  MODIFY `approve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `evaluates`
--
ALTER TABLE `evaluates`
  MODIFY `evaluate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `approves`
--
ALTER TABLE `approves`
  ADD CONSTRAINT `FK_approve` FOREIGN KEY (`approve_user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_approve2` FOREIGN KEY (`request_id`) REFERENCES `requests` (`request_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `evaluates`
--
ALTER TABLE `evaluates`
  ADD CONSTRAINT `FK1` FOREIGN KEY (`evaluator_user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK2` FOREIGN KEY (`target_user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK3` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `FK_request` FOREIGN KEY (`target_user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_request2` FOREIGN KEY (`by_user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_request3` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
