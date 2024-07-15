-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2024 at 07:17 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
  `approveForDirOfStuService` varchar(255) NOT NULL,
  `approved1_at` varchar(255) NOT NULL,
  `cForHoD` varchar(255) NOT NULL,
  `approveForHoD` varchar(255) NOT NULL,
  `approved2_at` varchar(255) NOT NULL,
  `cForDeanOfSchl` varchar(255) NOT NULL,
  `approveForDeanOfSchl` varchar(100) NOT NULL,
  `approved3_at` varchar(255) NOT NULL,
  `dateOfreturned` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permission_tbl`
--

INSERT INTO `permission_tbl` (`id`, `fullName`, `regNo`, `yearOfStudy`, `Course`, `Dept`, `School`, `days`, `departingOn`, `returningOn`, `reasonFor`, `signature`, `phoneNumber`, `date`, `cForDirOfStuService`, `approveForDirOfStuService`, `approved1_at`, `cForHoD`, `approveForHoD`, `approved2_at`, `cForDeanOfSchl`, `approveForDeanOfSchl`, `approved3_at`, `dateOfreturned`, `created_at`) VALUES
(10, 'Permissionv1', '26787/T.2023', 'Year-two', 'CSN', 'Business Studies', 'SACEM', '4', '2024-03-03 00:00:00.000', '2024-03-03 00:00:00.000', 'RHFEFIIIIIIIIIIIIII', '', '0786754636662', '2024-03-03 00:00:00.000', '', '', '', '', '', '', '', '', '', '', '2024-03-04 09:10:22'),
(11, 'Permissionv5', '26789/T.2023', 'Year-two', 'LMV', 'Land Management and Valuation', 'SSPSS', '12', '2024-02-08 00:00:00.000', '2024-02-09 00:00:00.000', 'RHFEFIIIIIIIIIIIIII56557RR', '', '078675463', '2024-03-03 00:00:00.000', '', '', '', '', '', '', '', '', '', '', '2024-03-03 12:49:36'),
(12, 'SEES', '2455/T.2022', 'Year-one', 'MISE', 'Interior Design', 'SEES', '5', '2024-03-03 00:00:00.000', '2024-03-03 00:00:00.000', 'Seremony', '', '0776744373', '2024-03-03 00:00:00.000', '', '', '', '', '', '', '', '', '', '', '2024-03-03 14:21:02'),
(13, 'yturrr', '677/T.2002', 'Year-one', 'LMV', 'Environmental Science and Management', 'SSPSS', '43', '2024-03-03 00:00:00.000', '2024-03-03 00:00:00.000', 'FDFDDDD', '', '0997685544', '2024-03-03 00:00:00.000', '', '', '', '', '', '', '', '', '', '', '2024-03-04 10:51:41'),
(14, 'studentv2', '26889/T.2022', 'Year-one', 'LMV', 'Civil and Environmental Engineering', 'SSPSS', '5', '2024-03-05', '2024-03-13', 'HELLO TEST PERMISSION', '', '0682131140', '2024-03-20', '', '', '', '', '', '', '', '', '', '', '2024-03-04 12:47:34'),
(19, 'anyewisi nyelu', '26945/T.2021', 'Year-three', 'CSN', 'Computer Systems and Mathematics', 'SERBI', '8', '2024-07-05', '2024-06-13', 'i need permission to be out of the college for the funeral of my parents', '', '0614455904', '2024-06-06', 'in this case, he should be given permission quickly to attend his parent\'s funeral', 'already_forwarded', '2024-06-06', '', '', '', '', '', '', '', '2024-06-20 19:18:08'),
(20, 'Flora julius', '27004/T.2021', 'Year-one', 'ism', 'Computer Systems and Mathematics', 'SERBI', '7', '2024-06-06', '2024-06-12', 'Asking for permission to be out of the university for more treatment of foot', '', '0678755904', '2024-06-08', 'according to the doctor\'s consent she deserves to get permission for his further treatment', 'already_forwarded', '2024-06-10', '', '', '', '', '', '', '', '2024-06-20 19:33:30'),
(21, 'Victor varelian', '26999/T.2021', 'Year-two', 'ism', 'Computer Systems and Mathematics', 'SERBI', '7', '2024-06-07', '2024-06-10', 'i need approval to be out of the university for some days due to the car accident i had on 21 of june for treatment', '', '0753600313', '2024-06-21', '', '', '', '', '', '', '', '', '', '', '2024-06-20 19:42:48'),
(22, 'Yasinta ngalya', '26945/T.2021', 'Year-three', 'CSN', 'Computer Systems and Mathematics', 'SERBI', '5', '2024-06-07', '2024-06-12', 'TTTTTTTTTTTTTTTTTTR', '', '0678755904', '2024-06-08', 'TTTTTTTTXCCX', 'already_forwarded', '2024-06-11', 'HHXXZZZZZZWW', 'already_forwarded', '2024-06-12', 'ggggggggggggggggggggggggggggggggggggggggggg', 'Permission_granted', '2024-06-06', '', '2024-06-26 17:09:51'),
(23, 'Yasinta ngalya', '26945/T.2021', 'Year-two', 'ISM', 'Computer Systems and Mathematics', 'SERBI', '5', '2024-06-05', '2024-06-08', 'NOTHING', '', '0678755904', '2024-06-09', 'fffffffffffffffffffffffffffffffffffffffff', 'already_forwarded', '2024-06-08', 'yyyyyyyyyyyyyyyyyyyyyyyyyyywwwwwwwww', 'already_forwarded', '2024-06-08', '', '', '', '', '2024-06-26 16:49:04');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role` int(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `School` varchar(100) NOT NULL,
  `Dept` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullName`, `School`, `Dept`, `role`, `email`, `password`, `created_at`) VALUES
(4, 'administrator', '', '', 'administrator', 'administrator@gmail.com', '9e9bd9de0cca9dea7ed72c56b4dc957b', '2024-03-02 23:06:54'),
(16, 'fullname', '', '', '', 'studentpermission@gmail.com', '27c61308fbd4f48ebe078e6e4c2c6e81', '2024-03-02 23:56:50'),
(17, 'HOD', 'SACEM', 'Land-Management and Valuation', 'directorOfstuService', 'hod123@gmail.com', '19135dfe6897d7f3409cac152092b71a', '2024-03-03 12:03:59'),
(18, 'SSPSS', 'SSPSS', 'Civil and Environmental-Engineering', 'directorOfstuService', 'sspss123@gmail.com', '783391e7dbc6d140f6f1a316ae8b190c', '2024-03-03 12:48:11'),
(20, 'SERBI', 'SERBI', 'Computer-Systems and Mathematics', 'directorOfstuService', 'serb123@gmail.com', '6d36083665e46b7a62f6d2455f2b0178', '2024-03-03 12:58:11'),
(21, 'studentv2', '', '', '', 'studentv2@gmail.com', 'b3478d15705d44bec7a3319bb36d2536', '2024-05-12 12:02:12'),
(22, 'HOD', 'SERBI', 'Computer-Systems and Mathematics', 'HOD', 'hodv2@gmail.com', '948a5ac2a79f594ce37ab636a5cc64f0', '2024-03-04 08:14:46'),
(23, 'hod1', 'SACEM', 'Environmental-Science and Management', 'HOD', 'hod1v1@gmail.com', '0402198b3ed978737d61819d93157152', '2024-03-04 09:04:34'),
(25, 'Dean of school', 'SERBI', 'Geospatial-Sciences and Technology', 'DeanOfSchl', 'deanofschlv1@gmail.com', 'a60a3cbe536458b65d769fd9997d21c6', '2024-03-04 09:17:02'),
(27, 'lucy', '', '', '', 'lucy@gmail.com', '251dfed835efb1b954a7228b37a3cb81', '2024-06-18 14:30:20'),
(30, 'Yasinta ngalya', '', '', '', 'Yasintangalya34@gmail.com', '1eef6ce0f966ef487ecb3b2dcc6065f1', '2024-06-19 17:06:22'),
(31, 'Rose mwanjalila', '', '', '', 'Rosemwanjalila45@gmail.com', '94c49d91d5199e76d9fd311c1560e95a', '2024-06-19 17:07:18'),
(32, 'Lucia ngalya', '', '', '', 'saingongalya@gmail.com', 'e1266aa9b1400010ea4b87deda5cac52', '2024-06-19 19:07:10'),
(33, 'john mussa', '', '', '', 'john@gmail.com', 'a5391e96f8d48a62e8c85381df108e98', '2024-06-19 19:16:34'),
(34, 'john mussa', '', '', '', 'mussa@gmail.com', 'e1266aa9b1400010ea4b87deda5cac52', '2024-06-19 19:18:21'),
(35, 'may june', '', '', '', 'may@gmail.com', 'ec0c028a42b8633bd12d0f420fefaa77', '2024-06-19 19:20:41'),
(36, 'june may', '', '', '', 'june@gmail.com', 'd048219fef4be2bdfdb6a243697b6c93', '2024-06-20 15:44:50'),
(37, 'june may', '', '', '', 'june@gmail.com', 'd048219fef4be2bdfdb6a243697b6c93', '2024-06-20 15:46:10'),
(38, 'june may', '', '', '', 'june@gmail.com', 'd048219fef4be2bdfdb6a243697b6c93', '2024-06-20 15:46:19'),
(39, 'anyewisi nyelu', '', '', '', 'Anyewisi34@gmail.com', 'cfdbc116ced53eee6739a87dca95a9f1', '2024-06-20 15:47:10'),
(40, 'Flora julius', '', '', '', 'Flora12julius@gmail.com', '21ae33bdf71c2eae4651520dfe04e4d0', '2024-06-20 19:20:00'),
(41, 'Victor varelian', '', '', '', 'Victor43varelian@gmail.com', 'd6b888a8ba1dde0e6fe7cede10e7abba', '2024-06-20 19:35:42'),
(42, 'juma john ', '', '', '', 'Juma34@gmail.com', '71cda556b47ec5bc22042d86ad9dc1b5', '2024-06-21 08:27:22'),
(43, 'juma john ', '', '', '', 'Juma34@gmail.com', '71cda556b47ec5bc22042d86ad9dc1b5', '2024-06-21 08:27:32'),
(44, 'juma john ', '', '', '', 'Juma34@gmail.com', '71cda556b47ec5bc22042d86ad9dc1b5', '2024-06-21 08:27:38'),
(45, 'ISAACK MWAMNKYUSA', '', '', '', 'Isaackmwa45@gmail.com', 'd3512ea1448e7f1f142571c2b26e0d21', '2024-06-21 08:28:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permission_tbl`
--
ALTER TABLE `permission_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `permission_tbl`
--
ALTER TABLE `permission_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
