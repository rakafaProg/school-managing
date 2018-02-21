-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2018 at 07:25 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `theschool`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `id` int(11) NOT NULL,
  `name` varchar(25) COLLATE utf8_bin NOT NULL,
  `role` int(11) NOT NULL,
  `phone` varchar(14) COLLATE utf8_bin NOT NULL,
  `email` varchar(30) COLLATE utf8_bin NOT NULL,
  `password` varchar(250) COLLATE utf8_bin NOT NULL,
  `image` varchar(250) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`id`, `name`, `role`, `phone`, `email`, `password`, `image`) VALUES
(1, 'Shinigami Sama', 1, '42-42-564', 'shinigami@shibusen.com', 'e19d5cd5af0378da05f63f891c7467af', '1.png'),
(2, 'Franken Stein Hakase', 2, '72-727-272', 'stein@shibusen.com', 'e19d5cd5af0378da05f63f891c7467af', '2.png'),
(3, 'Mary Sensei', 2, '13-13-13-13', 'mary@shibusen.com', 'e19d5cd5af0378da05f63f891c7467af', '3.png'),
(4, 'Spirit Albarn (Death Scyt', 3, '00-0000-0000', 'spirito@shibusen.com', 'e19d5cd5af0378da05f63f891c7467af', '4.jpg'),
(5, 'Shido Sensei', 3, '123-456-789', 'shido@shibusen.com', 'e19d5cd5af0378da05f63f891c7467af', '5.png');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` varchar(250) COLLATE utf8_bin NOT NULL,
  `image` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `description`, `image`) VALUES
(1, 'Swording', 'In this course you will learn how to use real swords. \r\nYou will have to be very carefull, since this is the most dangerus course ever. \r\nPlease be aware.', '1.png'),
(2, 'Sports', 'You will train on evry type of sport every, \r\nIncludes joging, jumping, soccer, streches and so on...', '2.png'),
(3, 'Operations', 'Learn how to operate on animals, pepole, yourself, and basicly, everything.', '3.gif');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(10) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Owner'),
(2, 'Manager'),
(3, 'Sales');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `phone` varchar(25) COLLATE utf8_bin NOT NULL,
  `email` varchar(25) COLLATE utf8_bin NOT NULL,
  `image` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `phone`, `email`, `image`) VALUES
(1, 'Maka Albran', '42-42-564', 'maka@gmail.com', '1.jpg'),
(2, 'Death The Kid', '888-8888-88', 'kid@gmail.com', '2.png'),
(3, 'Black Star', '11-111-111', 'black.star@gmail.com', '3.png');

-- --------------------------------------------------------

--
-- Table structure for table `students-courses`
--

CREATE TABLE `students-courses` (
  `course-id` int(11) NOT NULL,
  `student-id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `managing-roles` (`role`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `students-courses`
--
ALTER TABLE `students-courses`
  ADD PRIMARY KEY (`course-id`,`student-id`),
  ADD KEY `student-id-constrain` (`student-id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administrators`
--
ALTER TABLE `administrators`
  ADD CONSTRAINT `managing-roles` FOREIGN KEY (`role`) REFERENCES `roles` (`id`);

--
-- Constraints for table `students-courses`
--
ALTER TABLE `students-courses`
  ADD CONSTRAINT `course-id-constrain` FOREIGN KEY (`course-id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `student-id-constrain` FOREIGN KEY (`student-id`) REFERENCES `students` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
