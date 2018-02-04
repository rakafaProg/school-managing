-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2018 at 07:14 PM
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
(1, 'Rakkefet', 1, '050-50-50-50', 'rakkafa.prog@gmail.com', 'e19d5cd5af0378da05f63f891c7467af', 'rakkafa_prog_gmail_com.jpg'),
(2, 'Rambo', 2, '055-555-5555', 'zotus2@gmail.com', 'e19d5cd5af0378da05f63f891c7467af', 'zotus2_gmail_com.jpg'),
(3, 'Michal', 2, '*2800', 'michal@school.com', 'e19d5cd5af0378da05f63f891c7467af', 'michal_school_com.jpg'),
(16, 'Death The Kid', 3, '42-42-564', 'death@the.kido', 'e19d5cd5af0378da05f63f891c7467af', 'death_the_kido.png'),
(21, 'Black Star', 2, '111-111-1111', 'black.star@gmail.com', 'e19d5cd5af0378da05f63f891c7467af', 'black_star_gmail_com.png');

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
(1, 'English', 'Learn English from the best teachers ever.', 'default.jpg'),
(2, 'Ninja', 'Learn how to hide your prsence', 'ninja.jpg');

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
(1, 'Sakura', '0055500055', 'sakura@gmail.com', 'sakura.png'),
(2, 'Naruto Uzumaki', '111000222', 'naruto@gmail.com', 'default.png'),
(3, 'Kakashi', '1545875', 'kakashi@gmail.com', 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `students-courses`
--

CREATE TABLE `students-courses` (
  `course-id` int(11) NOT NULL,
  `student-id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `students-courses`
--

INSERT INTO `students-courses` (`course-id`, `student-id`) VALUES
(1, 1),
(1, 3),
(2, 1),
(2, 2),
(2, 3);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
