-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2024 at 08:00 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `permission_tbl`
--

CREATE TABLE `permission_tbl` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `regNo` varchar(255) NOT NULL,
  `yearOfStudy` varchar(255) NOT NULL,
  `Course` varchar(255) NOT NULL,
  `Dept` varchar(255) NOT NULL,
  `School` varchar(255) NOT NULL,
  `days` varchar(255) NOT NULL,
  `departingOn` varchar(255) NOT NULL,
  `returningOn` varchar(255) NOT NULL,
  `reasonFor` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `cForDirOfStuService` varchar(255) NOT NULL,
  `sForDirOfStuService` varchar(255) NOT NULL,
  `approved1_at` varchar(255) NOT NULL,
  `cForHoD` varchar(255) NOT NULL,
  `sForHoD` varchar(255) NOT NULL,
  `approved2_at` varchar(255) NOT NULL,
  `cForDeanOfSchl` varchar(255) NOT NULL,
  `approved3_at` varchar(255) NOT NULL,
  `dateOfreturned` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permission_tbl`
--
ALTER TABLE `permission_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `permission_tbl`
--
ALTER TABLE `permission_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
