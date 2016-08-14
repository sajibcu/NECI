-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2016 at 03:45 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `neci`
--

-- --------------------------------------------------------

--
-- Table structure for table `consume_details`
--

CREATE TABLE IF NOT EXISTS `consume_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `district_cd` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `input_date` date NOT NULL,
  `input_time` time NOT NULL,
  `unit` float(10,4) NOT NULL,
  `deleted_at` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `user_id_2` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=94 ;

--
-- Dumping data for table `consume_details`
--

INSERT INTO `consume_details` (`id`, `district_cd`, `user_id`, `input_date`, `input_time`, `unit`, `deleted_at`) VALUES
(27, 9, 'partha', '2016-07-27', '14:09:12', 25.0000, NULL),
(30, 14, 'saiful', '2016-07-27', '17:42:06', 3444.0000, NULL),
(32, 14, 'saiful', '2016-07-28', '17:42:35', 150.0000, NULL),
(35, 9, 'partha', '2016-07-29', '18:55:33', 600.0000, NULL),
(38, 14, 'saiful', '2016-07-29', '10:33:27', 900.0000, NULL),
(47, 14, 'saiful', '2016-07-30', '09:09:12', 1800.0000, NULL),
(49, 9, 'partha', '2016-07-28', '09:09:12', 1500.0000, NULL),
(60, 9, 'partha', '2016-07-30', '09:18:31', 200.0000, NULL),
(61, 9, 'partha', '2016-07-31', '11:04:05', 12000.0000, ''),
(62, 14, 'saiful', '2016-07-31', '12:05:45', 11300.0000, ''),
(64, 8, 'rajan', '2016-07-31', '20:23:12', 4000.0000, NULL),
(65, 5, 'rasel', '2016-07-31', '22:13:18', 34343.0000, NULL),
(66, 9, 'partha', '2016-08-01', '09:02:37', 1500.0000, NULL),
(67, 15, 'sajibcu', '2016-08-01', '10:06:45', 4564.0000, NULL),
(68, 36, 'sajibcu', '2016-08-01', '10:09:23', 4567.0000, NULL),
(69, 1, 'ruman', '2016-08-01', '11:19:59', 5000.0000, NULL),
(70, 2, 'sumon', '2016-08-01', '11:20:29', 4500.0000, NULL),
(71, 3, 'rasu', '2016-08-01', '11:21:01', 450.0000, NULL),
(72, 4, 'rohan', '2016-08-01', '11:21:27', 456.0000, NULL),
(73, 6, 'monir', '2016-08-01', '11:21:49', 453.0000, NULL),
(74, 19, 'raju', '2016-08-01', '11:27:51', 111.0000, NULL),
(75, 63, 'jack', '2016-08-01', '11:31:09', 900.0000, NULL),
(76, 9, 'partha', '2016-01-13', '08:07:34', 5670.0000, NULL),
(77, 9, 'partha', '2016-02-09', '10:07:34', 6750.0000, NULL),
(78, 9, 'partha', '2016-03-08', '09:07:34', 6990.0000, NULL),
(79, 9, 'partha', '2016-04-09', '11:07:34', 15800.0000, NULL),
(80, 9, 'partha', '2016-05-18', '11:33:34', 9000.0000, NULL),
(81, 9, 'partha', '2016-06-14', '08:55:34', 8500.0000, NULL),
(82, 9, 'partha', '2015-01-06', '11:17:34', 12000.0000, NULL),
(83, 9, 'partha', '2015-02-06', '10:07:34', 11000.0000, NULL),
(84, 9, 'partha', '2015-03-06', '11:17:34', 10000.0000, NULL),
(85, 9, 'partha', '2015-04-06', '10:07:34', 9000.0000, NULL),
(86, 9, 'partha', '2015-05-06', '11:17:34', 15000.0000, NULL),
(87, 9, 'partha', '2015-06-06', '10:07:34', 8000.0000, NULL),
(88, 9, 'partha', '2015-07-06', '11:17:34', 12000.0000, NULL),
(89, 9, 'partha', '2015-08-06', '10:07:34', 8000.0000, NULL),
(90, 9, 'partha', '2015-09-06', '11:17:34', 13000.0000, NULL),
(91, 9, 'partha', '2015-10-06', '10:07:34', 7600.0000, NULL),
(92, 9, 'partha', '2015-11-06', '11:17:34', 10000.0000, NULL),
(93, 9, 'partha', '2015-12-06', '10:07:34', 760.0000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `district_info`
--

CREATE TABLE IF NOT EXISTS `district_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `district_cd` int(11) NOT NULL,
  `district_name` varchar(100) NOT NULL,
  `deleted_at` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `district_code` (`district_cd`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=76 ;

--
-- Dumping data for table `district_info`
--

INSERT INTO `district_info` (`id`, `district_cd`, `district_name`, `deleted_at`) VALUES
(7, 1, 'Bagerhat', NULL),
(8, 2, 'Bandarban', NULL),
(9, 3, 'Barguna', NULL),
(10, 4, 'Barisal', NULL),
(11, 5, 'Bhola', NULL),
(12, 6, 'Bogra', NULL),
(13, 7, 'Brahmanbaria', NULL),
(14, 8, 'Chandpur', NULL),
(15, 9, 'Chittagong', NULL),
(16, 10, 'Chuadanga', NULL),
(17, 11, 'Comilla', NULL),
(18, 12, 'Cox&#39;s Bazar', NULL),
(19, 13, 'Chapainababganj', NULL),
(20, 14, 'Dhaka', NULL),
(21, 15, 'Dinajpur', NULL),
(22, 16, 'Faridpur', NULL),
(23, 17, 'Feni', NULL),
(24, 18, 'Gaibandha', NULL),
(25, 19, 'Gazipur', NULL),
(26, 20, 'Gopalganj', NULL),
(27, 21, 'Habiganj', NULL),
(28, 22, 'Jaipurhat', NULL),
(29, 23, 'Jamalpur', NULL),
(30, 24, 'Jessore', NULL),
(31, 25, 'Jhalakati', NULL),
(32, 26, 'Jhenaidah', NULL),
(33, 27, 'Khagrachari', NULL),
(34, 28, 'Khulna', NULL),
(35, 29, 'Kishoreganj', NULL),
(36, 30, 'Kurigram', NULL),
(37, 31, 'Kushtia', NULL),
(38, 32, 'Lakshmipur', NULL),
(39, 33, 'Lalmonirhat', NULL),
(40, 34, 'Madaripur', NULL),
(41, 35, 'Magura', NULL),
(42, 36, 'Manikganj', NULL),
(43, 37, 'Meherpur', NULL),
(44, 38, 'Moulvibazar', NULL),
(45, 39, 'Munshiganj', NULL),
(46, 40, 'Mymensingh', NULL),
(47, 41, 'Naogaon', NULL),
(48, 42, 'Narail', NULL),
(49, 43, 'Narayanganj', NULL),
(50, 44, 'Narsingdi', NULL),
(51, 45, 'Natore', NULL),
(52, 46, 'Netrokona', NULL),
(53, 47, 'Nilphamari', NULL),
(54, 48, 'Noakhali', NULL),
(55, 49, 'Pabna', NULL),
(56, 50, 'Panchagarh', NULL),
(57, 51, 'Patuakhali', NULL),
(58, 52, 'Pirojpur', NULL),
(59, 53, 'Rajbari', NULL),
(60, 54, 'Rajshahi', NULL),
(61, 55, 'Rangamati', NULL),
(62, 56, 'Rangpur', NULL),
(63, 57, 'Satkhira', NULL),
(64, 58, 'Shariatpur', NULL),
(65, 59, 'Sherpur', NULL),
(66, 60, 'Sirajganj', NULL),
(67, 61, 'Sunamganj', NULL),
(68, 62, 'Sylhet', NULL),
(74, 63, 'Tangail', NULL),
(75, 64, 'Thakurgaon', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `input_date` date NOT NULL,
  `district_cd` int(11) NOT NULL,
  `district_name` varchar(100) NOT NULL,
  `visitor_name` varchar(100) NOT NULL,
  `visitor_email` varchar(100) NOT NULL,
  `visitor_phone` varchar(100) NOT NULL,
  `visitor_message` varchar(500) NOT NULL,
  `deleted_at` varchar(250) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `input_date`, `district_cd`, `district_name`, `visitor_name`, `visitor_email`, `visitor_phone`, `visitor_message`, `deleted_at`) VALUES
(1, '2016-07-30', 9, 'Chittagong', 'Shoel', 'shoel1227@gmail.com', '01819614380', 'Area: Mehidibag\r\npls.electricity are not available in our area. pls. take nessary action. ', '0'),
(2, '2016-07-30', 0, '', 'aafdafa', 'partha1227@gmail.com', 'afdfaf', 'afdaffa', '0'),
(3, '2016-07-30', 19, '', 'Partha', 'partha1227@gmail.com', '01819614380', 'adjfhajhfhfjhahfhaljdfhahfhadjfdhafhhajfhjlkhafjjfhjahfjhafh hajfhjdhadfhjahdfjdhjahfhadjfhjkahflkhakfdhlakfa', '1'),
(4, '2016-07-30', 7, '', 'sajib', 'sajib@gmail.com', '01819614380', 'test message', '0'),
(5, '2016-07-30', 8, '', 'sajib222222222222', 'sajib@gmail.com', '01819614380', 'akjfhdajhfdahfjhahfhalfdhjahfjdahaklf', '0'),
(6, '2016-07-30', 17, '', 'Avijit', 'Avijit@gmail.com', '01819614380', 'test message', '0'),
(7, '2016-07-30', 16, '', 'raju', 'raju@gmail.com', '01819614380', 'dafafafdafdaffaf', '0'),
(8, '2016-07-30', 41, '', 'Partha1227', 'partha1227@gmail.com', '01819614380', 'partha parernanfdjanfjnafalfjfjanfaf', '0'),
(9, '2016-07-30', 31, '', 'rana1227', 'partha1227@gmail.com', '01819614380', 'afdafjahfahjfkhajfhjafafhhalshdhjfkaklfa', '0'),
(10, '2016-07-30', 9, '', 'Sajib', 'sajib@gmail.com', '01819614380', 'jhsadjfhjkafddjkahfjkdhakjhfjdhaf\r\ndahfajhfjahfjhadhfjhjakf\r\nafdhfajhajfhjahjhjkahdjfahjfh', '1'),
(11, '2016-07-30', 10, '', 'sajib', 'sajib@gmail.com', '01819614380', 'sajib sajib sajib ', '0'),
(12, '2016-07-30', 36, '', 'sajib', 'sajib@ahfdahfjahfaj', '01819614380', 'dfhjakhfjahfjhahfjafhfha afhdjhafhaf fajafjkfhjahfjhajfhdjahfhahjkfh afhdhfafjhajf', '1'),
(14, '2016-07-31', 14, '', 'ggggggggg', 'Avijit@gmail.com', 'afdfaf', 'sssssssssssssss ssssssssssssssssssssss sssssssssssssssssssss ssssssssssssss', '0'),
(15, '2016-07-31', 14, '', 'rana1227', 'sajib@gmail.com', '01819614380', 'a as asdf asdf adf adf ', '0'),
(16, '2016-07-31', 14, '', 'sajib', 'sajib@gmail.com', 'afdfaf', 'wrg wg g  gg a ', '0'),
(17, '2016-07-31', 14, '', 'rana1227', 'sajib@gmail.com', '01819614380', 'aadf asdfsdf sdfa', '0'),
(18, '2016-07-31', 5, '', 'sajib', '0sajib0@gmail.com', '343353', 'fgfgfgf fffhhg', '1'),
(19, '2016-07-31', 5, '', 'drd', '0sajib0@gmail.com', '45435', 'ccgdfg dgdfd', '1'),
(20, '2016-07-31', 5, '', 'erwer', '0sajib0@gmail.com', '64564', 'ccgdd ssrserser', '0'),
(21, '2016-07-31', 5, '', 'sv sfds', '0sajib0@gmail.com', '4456547', '456 fg fgddd', '0'),
(24, '2016-08-01', 9, '', 'Avijit', 'ifihif@hotmail.com', '018292887565', 'gdygyugwgdguwol\r\ngvdugudgvugvu', '0'),
(26, '2016-08-01', 9, '', 'SFfsFsfS', 'avi@gmail.com', '01819614380', 'adfafafaffa\r\nafadfafadffaffafafafafaf\r\nadafdafafadfa', '0'),
(27, '2016-08-01', 9, '', 'igsvga', 'hxsxk@gmail.com', '86766533422', 'Meter reading problem', '0'),
(28, '2016-08-01', 9, '', 'rahim', 'rahim@yahoo.com', '789992827', 'billing problem ref meter no 7189272', '0'),
(29, '2016-08-01', 36, '', 'Ismail', 'aab@gmail.com', '526788763', 'The line man is not honest', '0'),
(31, '2016-08-01', 36, '', 'md. jack', '0saghsd@gmail.com', '0245754', 'i am victim...', '1');

-- --------------------------------------------------------

--
-- Table structure for table `notice_details`
--

CREATE TABLE IF NOT EXISTS `notice_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notice_title` varchar(50) NOT NULL,
  `notice_content` text NOT NULL,
  `district_cd` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `notice_date` date NOT NULL,
  `notice_time` time NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `deleted_at` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `notice_details`
--

INSERT INTO `notice_details` (`id`, `notice_title`, `notice_content`, `district_cd`, `user_id`, `notice_date`, `notice_time`, `status`, `deleted_at`) VALUES
(1, 'Shutdown', 'Dear User, If  Your Area in Chittagong North Zone, Current Will Shutdown.', '1', 'partha', '2016-07-06', '00:00:00', 1, NULL),
(2, 'Shutdown ass', 'dhafdjahfjdfdhajfjdahjkfajhfkjajfhajjhfaahlhfhjafhlahf afdajfhjahfhlaf afkahfdahfaflalf  afhadfhahflah', '1', '1', '2016-07-31', '16:35:44', 1, NULL),
(4, 'Emargency', 'hi! all...', '14', 'partha', '2016-07-28', '11:00:15', 1, NULL),
(5, 'Emargency', 'This is a test content', '36', 'sajibcu', '2016-07-29', '13:06:10', 1, NULL),
(8, 'Grid Failure', 'adfhajfhhajfhjkahfkjahkjfhajkhfjkhaf\r\nfdkajfakfkafkjhafhajkfhlkjafa\r\nadfafkafkajkfakfajkjfkaljfklajklfjdalkfj\r\nafakdfahhafhafhakhfahfk', '9', 'partha', '2016-07-30', '15:36:09', 1, NULL),
(10, 'dsds', 'srbseer', '5', 'rasel', '2016-06-29', '22:09:38', 1, NULL),
(11, 'Feeder problem', 'Dear sir \r\nwe have a feeder problem in chittagong Bakalia', '9', 'Avijit Das', '2016-08-01', '11:29:28', 1, NULL),
(12, 'Meter', 'resolve meter problem. ', '9', 'Avijit Das', '2016-08-01', '12:52:45', 1, NULL),
(13, 'emargency', 'off your light when you are not home..', '36', 'sajibcu', '2016-08-01', '12:55:31', 1, NULL),
(15, 'Feeder problem', 'Solve it quickly', '1', 'ruman', '2016-08-01', '13:06:26', 1, NULL),
(16, 'Pillar problem', 'Hilly tract area problem', '2', 'sumon', '2016-08-01', '13:08:22', 1, NULL),
(17, 'assd', 'assfffd', '', 'admin', '2016-08-01', '15:08:38', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `designation` varchar(256) DEFAULT NULL,
  `user_id` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `phone_no` varchar(50) NOT NULL,
  `image` varchar(250) NOT NULL,
  `role` int(11) NOT NULL,
  `district_cd` varchar(10) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `signup_date` date NOT NULL,
  `signup_time` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `first_name`, `last_name`, `designation`, `user_id`, `email`, `password`, `phone_no`, `image`, `role`, `district_cd`, `status`, `signup_date`, `signup_time`) VALUES
(1, 'dfdf', 'gfg', NULL, 'admin', 'admin@gmail.com', 'c4851e8e264415c4094e4e85b0baa7cc', '24232', '', 1, '', 1, '0000-00-00', '00:00:00'),
(4, '', '', NULL, 'xyz', 'partha1227@yahoo.com', '1', '01819112233', '', 2, '7', 1, '2016-07-26', '10:00:10'),
(5, '', '', NULL, 'avijit', 'avijit@yahoo.com', '202cb962ac59075b964b07152d234b70', '01712878787', '', 2, '11', 0, '2016-07-26', '17:58:59'),
(6, 'Partha', 'Paul', 'CEO', 'partha', 'partha1227@gmail.com', 'c4851e8e264415c4094e4e85b0baa7cc', '01719002200', '', 2, '9', 1, '2016-07-26', '23:12:58'),
(7, '', '', NULL, 'saiful', 'sisaif121212@gmail.com', 'c4851e8e264415c4094e4e85b0baa7cc', '01853007155', '', 2, '14', 1, '2016-07-26', '23:24:05'),
(8, '', '', NULL, 'freethinker', 'freethinkersaif@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '01675004437', '', 2, '16', 0, '2016-07-27', '13:55:29'),
(10, 'sajib', 'hosen', 'programmer', 'sajibcu', '0sajib0@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '01719614380', '', 2, '36', 1, '2016-07-28', '12:22:54'),
(12, '', '', NULL, 'ruman', 'ruman@gmail.com', 'c4851e8e264415c4094e4e85b0baa7cc', '01919614370', '', 2, '1', 1, '2016-07-29', '16:37:51'),
(13, '', '', NULL, 'sumon', 'sumon@gmail.com', 'c4851e8e264415c4094e4e85b0baa7cc', '01719614350', '', 2, '2', 1, '2016-07-29', '16:38:45'),
(14, '', '', NULL, 'rasu', 'rasu@gmail.com', 'c4851e8e264415c4094e4e85b0baa7cc', '01819614380', '', 2, '3', 1, '2016-07-29', '16:42:21'),
(15, '', '', NULL, 'rohan', 'rohan@gmail.com', 'c4851e8e264415c4094e4e85b0baa7cc', '01819614380', '', 2, '4', 1, '2016-07-29', '16:42:58'),
(17, 'Karim', 'Ullah', 'CEO', 'rasel', 'rasel@gmail.com', 'c4851e8e264415c4094e4e85b0baa7cc', '01919614340', '', 2, '5', 0, '2016-07-29', '16:53:58'),
(18, '', '', NULL, 'rajan', 'ranjan@gmail.com', 'c4851e8e264415c4094e4e85b0baa7cc', '01819614380', '', 2, '8', 0, '2016-07-29', '16:55:07'),
(19, '', '', NULL, 'rakesh', 'rakesh@gmail.com', 'c4851e8e264415c4094e4e85b0baa7cc', '01819614380', '', 2, '10', 0, '2016-07-29', '16:55:34'),
(20, '', '', NULL, 'jashim', 'jashim@gmail.com', 'c4851e8e264415c4094e4e85b0baa7cc', '01819614380', '', 2, '12', 0, '2016-07-29', '16:56:04'),
(22, '', '', NULL, 'Avijit Das', 'eteavijit@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '+8801719214711', '', 2, '9', 1, '2016-07-31', '21:04:24'),
(23, '', '', NULL, 'rox', 'rox@gmail.com', 'c4851e8e264415c4094e4e85b0baa7cc', '090000', '', 1, '14', 1, '2016-08-01', '07:27:20'),
(24, '', '', 'main admin 1', 'admin1', 'admin1@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '4456654', '', 1, '4', 1, '2016-08-01', '10:40:55'),
(25, '', '', NULL, 'raju', 'raju@gmail.com', 'c4851e8e264415c4094e4e85b0baa7cc', '01819614380', '', 2, '19', 1, '2016-08-01', '11:25:59'),
(26, '', '', NULL, 'jack', 'jack@gmail.com', 'c4851e8e264415c4094e4e85b0baa7cc', '4654755', '', 2, '63', 1, '2016-08-01', '11:29:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE IF NOT EXISTS `user_log` (
  `user_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `email` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `login_time` datetime DEFAULT '0000-00-00 00:00:00',
  `log_out_time` datetime DEFAULT '0000-00-00 00:00:00',
  `role` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_log_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=31 ;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`user_log_id`, `user_id`, `email`, `login_time`, `log_out_time`, `role`) VALUES
(29, 0, 'partha1227@gmail.com', '2016-07-26 17:29:32', '2016-08-01 13:10:02', 1),
(30, 0, 'partha1227@yahoo.com', '2016-07-26 17:31:40', '2016-08-01 13:10:02', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE IF NOT EXISTS `user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `image` varchar(250) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_id`, `first_name`, `last_name`, `designation`, `image`) VALUES
(1, 'partha', 'Partha', 'Paul', 'CEO', ''),
(2, 'saiful', 'Saiful', 'Islam', 'Executive', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
