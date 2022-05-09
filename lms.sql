-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2022 at 04:32 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `pass` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `pass`) VALUES
(1, 'admin', '1');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `bookpic` varchar(25) NOT NULL,
  `bookname` varchar(25) NOT NULL,
  `bookdetail` varchar(25) NOT NULL,
  `bookauthor` varchar(25) NOT NULL,
  `bookpub` varchar(25) NOT NULL,
  `branch` varchar(25) NOT NULL,
  `bookprice` varchar(25) NOT NULL,
  `bookquantity` varchar(25) NOT NULL,
  `bookava` int(11) NOT NULL,
  `bookrent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `bookpic`, `bookname`, `bookdetail`, `bookauthor`, `bookpub`, `branch`, `bookprice`, `bookquantity`, `bookava`, `bookrent`) VALUES
(4, '', 'Art Of Living', 'Vipassana', 'VRI', 'VRI', 'Other', '50', '5', -2, 12),
(6, 'arrow.jpg', 'Art Of Living', 'Dhamma', 'VRI', 'VRI', 'Other', '50', '10', -2, 12),
(8, 'arrow.png', 'Harry Potter', 'Magical', 'JK Rowling', 'Oxford', 'Other', '400', '10', 4, 6),
(9, 'arrow.jpg', 'Chronicles of Buddha', 'Stories', 'VRI', 'VRI', 'Other', '100', '50', 38, 12),
(10, 'Screenshot 2021-06-22 221', 'Ikigai', 'Goal', 'Wan San', 'Watasiwa', 'Other', '500', '500', 494, 6);

-- --------------------------------------------------------

--
-- Table structure for table `issuebook`
--

CREATE TABLE `issuebook` (
  `id` int(11) NOT NULL,
  `userid` int(25) NOT NULL,
  `issuename` varchar(25) NOT NULL,
  `issuebook` varchar(25) NOT NULL,
  `issuetype` varchar(25) NOT NULL,
  `issuedays` int(11) NOT NULL,
  `issuedate` varchar(25) NOT NULL,
  `issuereturn` varchar(25) NOT NULL,
  `fine` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `issuebook`
--

INSERT INTO `issuebook` (`id`, `userid`, `issuename`, `issuebook`, `issuetype`, `issuedays`, `issuedate`, `issuereturn`, `fine`) VALUES
(15, 1, 'Sujay', 'Art Of Living', 'Student', 20, '05/04/22', '25/04/22', 0),
(16, 2, 'amar', 'Chronicles of Buddha', 'Student', 71, '06/04/22', '16/06/22', 0),
(17, 1, 'Sujay', 'Ikigai', 'Student', 45, '07/05/22', '21/06/22', 0),
(18, 7, 'ankit', 'Art Of Living', 'Student', 23, '07/05/22', '30/05/22', 0),
(19, 7, 'ankit', 'Harry Potter', 'Student', 34, '07/05/22', '10/06/22', 0),
(20, 7, 'ankit', 'Ikigai', 'Student', 50, '07/05/22', '26/06/22', 0),
(21, 7, 'ankit', 'Chronicles of Buddha', 'Student', 43, '07/05/22', '19/06/22', 0),
(22, 8, 'tulika', 'Art Of Living', 'Student', 34, '07/05/22', '10/06/22', 0),
(23, 8, 'tulika', 'Chronicles of Buddha', 'Student', 50, '07/05/22', '26/06/22', 0),
(24, 8, 'tulika', 'Harry Potter', 'Student', 60, '07/05/22', '06/07/22', 0),
(25, 8, 'tulika', 'Ikigai', 'Student', 70, '07/05/22', '16/07/22', 0),
(26, 9, 'sonia', 'Art Of Living', 'Teacher', 30, '07/05/22', '06/06/22', 0),
(27, 9, 'sonia', 'Chronicles of Buddha', 'Teacher', 20, '07/05/22', '27/05/22', 0),
(28, 9, 'sonia', 'Ikigai', 'Teacher', 70, '07/05/22', '16/07/22', 0),
(29, 10, 'Vinay', 'Art Of Living', 'Teacher', 50, '07/05/22', '26/06/22', 0),
(30, 10, 'Vinay', 'Chronicles of Buddha', 'Teacher', 60, '07/05/22', '06/07/22', 0),
(31, 10, 'Vinay', 'Harry Potter', 'Teacher', 70, '07/05/22', '16/07/22', 0),
(32, 10, 'Vinay', 'Ikigai', 'Teacher', 90, '07/05/22', '05/08/22', 0),
(33, 11, 'Nainish', 'Art Of Living', 'Teacher', 60, '07/05/22', '06/07/22', 0),
(34, 11, 'Nainish', 'Harry Potter', 'Teacher', 50, '07/05/22', '26/06/22', 0),
(35, 11, 'Nainish', 'Chronicles of Buddha', 'Teacher', 40, '07/05/22', '16/06/22', 0),
(36, 8, 'tulika', 'Chronicles of Buddha', 'Student', 40, '07/05/22', '16/06/22', 0),
(37, 8, 'tulika', 'Art Of Living', 'Student', 50, '07/05/22', '26/06/22', 0),
(38, 8, 'tulika', 'Chronicles of Buddha', 'Student', 70, '07/05/22', '16/07/22', 0),
(39, 9, 'sonia', 'Chronicles of Buddha', 'Teacher', 90, '07/05/22', '05/08/22', 0),
(40, 7, 'ankit', 'Art Of Living', 'Student', 80, '07/05/22', '26/07/22', 0),
(41, 2, 'amar', 'Art Of Living', 'Student', 20, '07/05/22', '27/05/22', 0),
(42, 1, 'Sujay', 'Chronicles of Buddha', 'Student', 50, '07/05/22', '26/06/22', 0),
(43, 1, 'Sujay', 'Chronicles of Buddha', 'Student', 90, '07/05/22', '05/08/22', 0),
(44, 9, 'sonia', 'Chronicles of Buddha', 'Teacher', 30, '07/05/22', '06/06/22', 0),
(45, 8, 'tulika', 'Art Of Living', 'Student', 50, '07/05/22', '26/06/22', 0),
(46, 8, 'tulika', 'Harry Potter', 'Student', 50, '07/05/22', '26/06/22', 0),
(47, 8, 'tulika', 'Ikigai', 'Student', 90, '07/05/22', '05/08/22', 0),
(49, 1, 'Sujay', 'Art Of Living', 'Student', 30, '08/05/22', '07/06/22', 0),
(50, 1, 'Sujay', 'Harry Potter', 'Student', 40, '08/05/22', '17/06/22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `name` varchar(11) NOT NULL,
  `issuebook` varchar(25) NOT NULL,
  `bookreturn` varchar(11) NOT NULL,
  `returncheck` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `userid`, `name`, `issuebook`, `bookreturn`, `returncheck`) VALUES
(3, 0, 'Sujay', 'Art Of Living', '07/06/22', 0),
(12, 0, 'Sujay', 'Art Of Living', '08/05/22', 1),
(48, 1, 'Sujay', 'Harry Potter', '17/06/22', 0),
(63, 1, 'Sujay', 'Harry Potter', '08/05/22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `requestbook`
--

CREATE TABLE `requestbook` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `bookid` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `usertype` varchar(25) NOT NULL,
  `bookname` varchar(25) NOT NULL,
  `issuedays` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requestbook`
--

INSERT INTO `requestbook` (`id`, `userid`, `bookid`, `username`, `usertype`, `bookname`, `issuedays`) VALUES
(1, 1, 4, 'Sujay', 'Student', 'Art Of Living', '7'),
(2, 7, 8, 'ankit', 'Student', 'Art Of Living', '7');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `pass` varchar(25) NOT NULL,
  `type` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `pass`, `type`) VALUES
(1, 'Sujay', 'sujay@gmail.com', '1', 'Student'),
(2, 'amar', 'amar@gmail.com', '1', 'Student'),
(7, 'ankit', 'ankit@gmail.com', '1', 'Student'),
(8, 'tulika', 'tulika@gmail.com', '1', 'Student'),
(9, 'sonia', 'soni@gmail.com', '1', 'Teacher'),
(10, 'Vinay', 'vinay@vinay.in', '1', 'Teacher'),
(11, 'Nainish', 'k.nainish@gmail.com', '1', 'Teacher');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issuebook`
--
ALTER TABLE `issuebook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requestbook`
--
ALTER TABLE `requestbook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `issuebook`
--
ALTER TABLE `issuebook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `requestbook`
--
ALTER TABLE `requestbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
