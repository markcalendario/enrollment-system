-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2021 at 06:50 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `enrollment_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `logid` int(11) NOT NULL,
  `logtext` text NOT NULL,
  `log_time` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`logid`, `logtext`, `log_time`) VALUES
(77, 'Aileene D. Cruz  has logged out.', '2021-03-20 05:22:23'),
(78, ' [ENROLLMENT] mark salinas calendario  has enrolled.', '2021-03-20 05:22:23'),
(79, 'mark salinas calendario   has logged in', '2021-03-20 05:22:23'),
(80, 'mark salinas calendario   has logged out.', '2021-03-20 05:22:23'),
(81, 'mark salinas calendario   has logged in', '2021-03-20 05:22:23'),
(82, 'mark salinas calendario   has logged out.', '2021-03-20 05:22:23'),
(83, ' [ENROLLMENT] Danilo Antonio Calendario  has enrolled.', '2021-03-20 05:22:23'),
(84, 'Aileene D. Cruz  has logged in', '2021-03-20 05:22:23'),
(85, 'Aileene D. Cruz declined a student.', '2021-03-20 05:22:23'),
(86, 'Aileene D. Cruz accepted a student.', '2021-03-20 05:22:23'),
(87, 'Aileene D. Cruz  has logged out.', '2021-03-20 05:22:23'),
(88, 'Aileene D. Cruz  has logged in', '2021-03-20 05:22:23'),
(89, 'Aileene D. Cruz  has logged out.', '2021-03-20 05:22:23'),
(90, 'Aileene D. Cruz  has logged in', '2021-03-20 05:22:23'),
(91, 'Aileene D. Cruz accepted a student.', '2021-03-20 05:22:23'),
(92, 'Aileene D. Cruz  transferred a student to another section.', '2021-03-20 05:33:40'),
(93, 'Aileene D. Cruz  has logged out.', '2021-03-20 05:50:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`id`, `username`, `password`, `status`) VALUES
(46, 'ai19', '123', 1),
(84, '1234567489jrc', 'Calendario', 1),
(85, '123456789jrc', 'Calendario', 1),
(86, '3434r3qw', '34343', 1),
(87, '1234165487jrc', 'Calendario', 1),
(88, '123456jrc', 'calendario', 1),
(89, '463463jrc', 'Calendario', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `fullname` text DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `sex` text DEFAULT NULL,
  `contact` text DEFAULT NULL,
  `lrn` bigint(11) DEFAULT NULL,
  `mname` text DEFAULT NULL,
  `mcontact` bigint(15) DEFAULT NULL,
  `fname` text DEFAULT NULL,
  `fcontact` bigint(15) DEFAULT NULL,
  `gwa` int(11) DEFAULT NULL,
  `birthcert_id` bigint(15) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `fb` text DEFAULT NULL,
  `strand` text DEFAULT NULL,
  `section` text DEFAULT NULL,
  `status_enroll` int(11) NOT NULL DEFAULT 1,
  `utype` int(11) NOT NULL DEFAULT 0,
  `birthday` date DEFAULT NULL,
  `birthplace` text DEFAULT NULL,
  `religion` text DEFAULT NULL,
  `mother_tongue` text DEFAULT NULL,
  `home_address` text DEFAULT NULL,
  `malumni` text NOT NULL,
  `falumni` text NOT NULL,
  `last_school` text DEFAULT NULL,
  `school_type` text DEFAULT NULL,
  `listahan_benef` text DEFAULT NULL,
  `four_p` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `fullname`, `age`, `sex`, `contact`, `lrn`, `mname`, `mcontact`, `fname`, `fcontact`, `gwa`, `birthcert_id`, `email`, `fb`, `strand`, `section`, `status_enroll`, `utype`, `birthday`, `birthplace`, `religion`, `mother_tongue`, `home_address`, `malumni`, `falumni`, `last_school`, `school_type`, `listahan_benef`, `four_p`) VALUES
(46, 'Aileene D. Cruz', 18, 'Female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(84, 'Mark Kenneth Salinas Calendario ', 23, 'Male', '34343', 1234567489, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(85, 'Mark Kenneth Salinas Calendario ', 19, 'Male', '123456', 123456789, 'awfawfawafwfawawfawf', 3434, 'safdas', 235235, 99, 3535353, '33@aujrc.com', 'saffsaas', 'HE1', 'ICT 2A', 3, 0, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(86, 'Mark', 43, 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(87, 'Mark Kenneth Salinas Calendario ', 19, 'Male', '90634721', 1234165487, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(88, 'mark salinas calendario ', 18, 'Male', '9063472116', 123456, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Warfre', 2, 0, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(89, 'Danilo Antonio Calendario ', 25, 'Male', '643ty', 463463, 'j', 3, 'kjh', 1085451, 75, 5325, 'aujoserizal.shs@arellano.edu.ph', '2356rrf', 'HE1', 'ABM 6A', 2, 2, '2002-10-19', 'hl;kjh', 'lkjhlk', 'ffg', '172 Julian Felipe Street, Sangandaan, Caloocan City', 'yes', 'no', '34634', 'Public', 'Yes', 'Yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`logid`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `logid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
