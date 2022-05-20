-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2022 at 10:50 AM
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
(6, 'arrow.jpg', 'Art Of Living', 'Dhamma', 'VRI', 'VRI', 'Other', '50', '100', 97, 3),
(8, 'arrow.png', 'Harry Potter', 'Magical', 'JK Rowling', 'Oxford', 'Other', '400', '100', 99, 1),
(9, 'arrow.jpg', 'Chronicles of Buddha', 'Stories', 'VRI', 'VRI', 'Other', '100', '50', 48, 2),
(10, 'Screenshot 2021-06-22 221', 'Ikigai', 'Goal', 'Wan San', 'Watasiwa', 'Other', '500', '500', 500, 0),
(11, 'logo.png', 'Parami', 'Perfections', 'Bhikkhu Bodhi', 'BPS', 'Other', '200', '300', 300, 0);

-- --------------------------------------------------------

--
-- Table structure for table `issuebook`
--

CREATE TABLE `issuebook` (
  `id` int(11) NOT NULL,
  `userid` int(25) NOT NULL,
  `bookid` int(11) NOT NULL,
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

INSERT INTO `issuebook` (`id`, `userid`, `bookid`, `issuename`, `issuebook`, `issuetype`, `issuedays`, `issuedate`, `issuereturn`, `fine`) VALUES
(98, 2, 6, 'amar', 'Art Of Living', 'Student', 76, '13/05/22', '28/07/22', 0),
(99, 1, 8, 'Sujay', 'Harry Potter', 'Student', 76, '13/05/22', '28/07/22', 0),
(100, 8, 6, 'tulika', 'Art Of Living', 'Student', 65, '13/05/22', '17/07/22', 0),
(101, 1, 9, 'Sujay', 'Chronicles of Buddha', 'Student', 55, '13/05/22', '07/07/22', 0),
(102, 8, 9, 'tulika', 'Chronicles of Buddha', 'Student', 56, '13/05/22', '08/07/22', 0),
(104, 7, 6, 'ankit', 'Art Of Living', 'Student', 70, '15/05/22', '24/07/22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `bookid` int(11) NOT NULL,
  `bookissue` varchar(11) NOT NULL,
  `issuebook` varchar(25) NOT NULL,
  `bookreturn` varchar(11) NOT NULL,
  `returncheck` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `userid`, `bookid`, `bookissue`, `issuebook`, `bookreturn`, `returncheck`) VALUES
(504, 1, 6, '13/05/22', 'Art Of Living', '10/08/22', 0),
(505, 2, 6, '13/05/22', 'Art Of Living', '28/07/22', 0),
(506, 1, 8, '13/05/22', 'Harry Potter', '28/07/22', 0),
(507, 8, 6, '13/05/22', 'Art Of Living', '17/07/22', 0),
(508, 1, 6, '13/05/22', 'Art Of Living', '13/05/22', 1),
(509, 1, 9, '13/05/22', 'Chronicles of Buddha', '07/07/22', 0),
(510, 8, 9, '13/05/22', 'Chronicles of Buddha', '08/07/22', 0),
(511, 10, 9, '13/05/22', 'Chronicles of Buddha', '07/06/22', 0),
(512, 10, 9, '13/05/22', 'Chronicles of Buddha', '13/05/22', 1),
(513, 7, 6, '15/05/22', 'Art Of Living', '24/07/22', 0);

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
(11, 'Nainish', 'k.nainish@gmail.com', '1', 'Teacher'),
(12, 'nancy', 'nancy@gmail.com', '1', 'Student');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `issuebook`
--
ALTER TABLE `issuebook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=514;

--
-- AUTO_INCREMENT for table `requestbook`
--
ALTER TABLE `requestbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
