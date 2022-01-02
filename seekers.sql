-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2022 at 10:18 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seekers`
--

-- --------------------------------------------------------

--
-- Table structure for table `apprequests`
--

CREATE TABLE `apprequests` (
  `apprequest_id` int(11) NOT NULL,
  `jobseeker_id` int(11) NOT NULL,
  `vacancy_id` int(11) NOT NULL,
  `cover_letter` text NOT NULL,
  `employer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `apprequests`
--

INSERT INTO `apprequests` (`apprequest_id`, `jobseeker_id`, `vacancy_id`, `cover_letter`, `employer_id`) VALUES
(6, 1, 10, 'saddsadlkmsalkdmslkdamklsdmasddsad\r\nwdawwwwwwwwwwwwwwwwwwwwwwwwwwddddddddd', 4);

-- --------------------------------------------------------

--
-- Table structure for table `employers`
--

CREATE TABLE `employers` (
  `user_id` int(40) NOT NULL,
  `user_name` char(40) NOT NULL,
  `email` char(40) NOT NULL,
  `name` char(40) NOT NULL,
  `age` int(70) NOT NULL,
  `address` char(40) NOT NULL,
  `wcompany` char(40) NOT NULL,
  `application_requests` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT '[]',
  `vacancies_made` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employers`
--

INSERT INTO `employers` (`user_id`, `user_name`, `email`, `name`, `age`, `address`, `wcompany`, `application_requests`, `vacancies_made`) VALUES
(4, 'gadalla565', 'lakdmasd@das.com', 'saldkmlaskdm', 22, 'london uk', 'working company', '[6]', '[7,9,10]');

-- --------------------------------------------------------

--
-- Table structure for table `jobseekers`
--

CREATE TABLE `jobseekers` (
  `user_id` int(40) NOT NULL,
  `user_name` char(40) NOT NULL,
  `email` char(40) NOT NULL,
  `name` char(40) NOT NULL,
  `age` int(70) NOT NULL,
  `address` char(40) NOT NULL,
  `wcompany` char(40) NOT NULL,
  `industry` char(40) NOT NULL,
  `explevel` char(40) NOT NULL,
  `application_requests` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT '[]',
  `saved_vacancies` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT '[]',
  `skills` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`skills`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobseekers`
--

INSERT INTO `jobseekers` (`user_id`, `user_name`, `email`, `name`, `age`, `address`, `wcompany`, `industry`, `explevel`, `application_requests`, `saved_vacancies`, `skills`) VALUES
(1, 'shehabgad', 'shehabgad2@gmail.com', 'shehab gadssss', 20, 'cairo elwaraalkm', 'bonjorno', 'elbalalaaaa', 'sjsjsj', '[6]', '[]', '[\"front end\",\"back end\",\"java programming\",\"asdasd\",\"python\",\"aasdsad\"]');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(40) NOT NULL,
  `password` char(40) NOT NULL,
  `user_name` char(40) NOT NULL,
  `email` char(40) NOT NULL,
  `user_type` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `password`, `user_name`, `email`, `user_type`) VALUES
(1, 'test1234', 'shehabgad', 'shehabgad2@gmail.com', 'JOB_SEEKER'),
(4, 'test1234', 'gadalla565', 'lakdmasd@das.com', 'EMPLOYER');

-- --------------------------------------------------------

--
-- Table structure for table `vacancies`
--

CREATE TABLE `vacancies` (
  `vacancy_id` int(40) NOT NULL,
  `title` char(40) NOT NULL,
  `description` text NOT NULL,
  `location` char(40) NOT NULL,
  `job_type` char(40) NOT NULL,
  `exp_level` char(40) NOT NULL,
  `company_name` char(40) NOT NULL,
  `company_link` char(40) NOT NULL,
  `employer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vacancies`
--

INSERT INTO `vacancies` (`vacancy_id`, `title`, `description`, `location`, `job_type`, `exp_level`, `company_name`, `company_link`, `employer_id`) VALUES
(7, 'oooooooooooooa', '        oooooooooooooooooooooooo  a      loooping w                ', 'ooooooooooooooa', 'oooooooooooooooa', 'oooooooooooooa', 'ooooooooooooa', 'ooooooooooooa', 4),
(9, 'LOCAL HOSTsqw', 'dsadasdsadddd', 'sdlaksdmxxxxxxxxxxxxx', 'lksadm', 'lkmdsalkm', 'lkmdlksma', 'lkmdsad', 4),
(10, 'Softwaree', 'asdsadas', 'asdsaldkm', 'lkdsqmlksdamlk', 'mdslkmlskdamlk', 'mlksamlksadm', 'alskdmsalkd', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apprequests`
--
ALTER TABLE `apprequests`
  ADD PRIMARY KEY (`apprequest_id`);

--
-- Indexes for table `employers`
--
ALTER TABLE `employers`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `jobseekers`
--
ALTER TABLE `jobseekers`
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vacancies`
--
ALTER TABLE `vacancies`
  ADD PRIMARY KEY (`vacancy_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apprequests`
--
ALTER TABLE `apprequests`
  MODIFY `apprequest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vacancies`
--
ALTER TABLE `vacancies`
  MODIFY `vacancy_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
