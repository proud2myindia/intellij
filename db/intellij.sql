-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 15, 2017 at 02:44 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `intellij`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ori_pass` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `restaurent_name` varchar(255) NOT NULL,
  `restaurent_contact_no` varchar(255) NOT NULL,
  `restaurent_email` varchar(255) NOT NULL,
  `restaurent_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `ori_pass`, `user_type`, `restaurent_name`, `restaurent_contact_no`, `restaurent_email`, `restaurent_address`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin', 'KEPS', '9831496974', 'ananda.chakraborty2008@gmail.com', '345B/1 Jessore Road');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `is_delete` enum('0','1') NOT NULL COMMENT '0=Not Delete,1=Delete',
  `task_create_user_id` int(10) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateUpdated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `name`, `description`, `is_delete`, `task_create_user_id`, `dateCreated`, `dateUpdated`) VALUES
(1, 'Demo Task One', 'Hello World', '0', 1, '2017-06-13 13:47:32', '2017-06-13 14:14:22'),
(2, 'Demo Task', 'vbcbvcbghfhfghfhfrtyryxcvxcvxvxvxvxvxxvxvx', '1', 1, '2017-06-13 14:11:08', '0000-00-00 00:00:00'),
(3, 'Task Two', 'Hello Developer', '0', 1, '2017-06-13 14:25:49', '0000-00-00 00:00:00'),
(4, 'Task Three', 'Hello Test For Second developer', '0', 3, '2017-06-13 15:03:02', '0000-00-00 00:00:00'),
(5, 'work By Rini', 'What a irony of fate', '0', 1, '2017-06-15 14:40:54', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `user_fname` varchar(255) NOT NULL,
  `user_lname` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_contact` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_status` enum('1','0') NOT NULL COMMENT '1=Active,0=Block',
  `is_delete` enum('0','1') NOT NULL COMMENT '0=''Not delete'',1=''Deleted''',
  `user_create_date` datetime NOT NULL,
  `user_mod_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_fname`, `user_lname`, `user_name`, `user_password`, `user_contact`, `user_email`, `user_status`, `is_delete`, `user_create_date`, `user_mod_date`) VALUES
(1, 'Ananda', 'Chakraborty', 'ananda', 'b86872751de1e13c142d050acfd09842', '9831496974', 'ananda@gmail.com', '1', '0', '2017-06-13 00:46:47', '2017-06-13 00:47:03'),
(2, 'Akash', 'Chakraboirty', 'akash', '7f363f401f336a7925f28655b6a44447', '9143458056', 'akash@yahoo.com', '0', '1', '2017-06-13 00:52:47', '0000-00-00 00:00:00'),
(3, 'Prithviraaj', 'Chakraborty', 'prithvi', '7f363f401f336a7925f28655b6a44447', '9831496974', 'prithvi@test.com', '1', '0', '2017-06-13 15:02:30', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
