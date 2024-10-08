-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2024 at 08:44 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trainee`
--

-- --------------------------------------------------------

--
-- Table structure for table `fee_payment`
--

CREATE TABLE `fee_payment` (
  `id` int(11) NOT NULL,
  `trainee_id` varchar(123) NOT NULL,
  `amount` varchar(123) NOT NULL,
  `date` date NOT NULL,
  `status` bit(1) NOT NULL DEFAULT b'0',
  `bill_no` int(11) NOT NULL,
  `due_id` int(11) NOT NULL,
  `gst` int(11) NOT NULL,
  `payment_type` varchar(100) NOT NULL DEFAULT 'due'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `fee_payment`
--

INSERT INTO `fee_payment` (`id`, `trainee_id`, `amount`, `date`, `status`, `bill_no`, `due_id`, `gst`, `payment_type`) VALUES
(2, 'har7860', '10000', '2024-10-01', b'1', 3000, 0, 0, 'initial'),
(3, 'har7860', '5000', '2024-10-04', b'1', 3000, 0, 900, 'initial'),
(4, 'wrw2022', '3000', '2024-10-09', b'0', 3001, 1, 0, 'due'),
(5, 'wrw2022', '5000', '0000-00-00', b'0', 3001, 0, 0, 'initial'),
(6, 'fv8905', '10000', '2024-09-14', b'0', 3002, 1, 0, 'due'),
(8, 'fv8905', '5000', '0000-00-00', b'1', 3002, 0, 0, 'initial'),
(9, 'ref8980', '10000', '2024-10-03', b'0', 3003, 1, 0, 'due'),
(10, 'ref8980', '2000', '0000-00-00', b'0', 3003, 0, 0, 'initial'),
(11, 'ref8980', '3000', '2024-10-02', b'1', 3003, 0, 0, 'initial'),
(12, 'wfr8906', '15000', '0000-00-00', b'0', 3004, 0, 0, 'initial');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `admin_id` varchar(123) NOT NULL,
  `name` varchar(123) NOT NULL,
  `contact` varchar(123) NOT NULL,
  `email` varchar(123) NOT NULL,
  `password` varchar(123) NOT NULL,
  `photo` varchar(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `admin_id`, `name`, `contact`, `email`, `password`, `photo`) VALUES
(17, 'adm3434', 'admin', '3434343434', 'admin@gmail.com', 'afc905b0016006567a68cdf10200ab6b17d6bc80', '3-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_center`
--

CREATE TABLE `tbl_center` (
  `id` int(11) NOT NULL,
  `center_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_center`
--

INSERT INTO `tbl_center` (`id`, `center_name`) VALUES
(2, 'wipro gurgaon');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

CREATE TABLE `tbl_course` (
  `id` int(11) NOT NULL,
  `course_name` varchar(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`id`, `course_name`) VALUES
(9, 'testing1'),
(11, 'test123');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_coursetype`
--

CREATE TABLE `tbl_coursetype` (
  `id` int(11) NOT NULL,
  `course_type` varchar(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_coursetype`
--

INSERT INTO `tbl_coursetype` (`id`, `course_type`) VALUES
(2, 'long term courss dsd'),
(3, 'summer training'),
(4, 'internship'),
(5, 'short term course');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_duration`
--

CREATE TABLE `tbl_duration` (
  `id` int(11) NOT NULL,
  `course_duration` varchar(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_duration`
--

INSERT INTO `tbl_duration` (`id`, `course_duration`) VALUES
(2, '3-month'),
(4, '1-year'),
(9, '6-month'),
(10, '6-week');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_enquiry`
--

CREATE TABLE `tbl_enquiry` (
  `id` int(11) NOT NULL,
  `trainee_id` varchar(123) NOT NULL,
  `name` varchar(123) NOT NULL,
  `father_name` varchar(123) NOT NULL,
  `contact` varchar(123) NOT NULL,
  `email` varchar(123) NOT NULL,
  `address` varchar(123) NOT NULL,
  `course` varchar(123) NOT NULL,
  `gender` varchar(123) NOT NULL,
  `doj` date NOT NULL,
  `dob` date NOT NULL,
  `duration` varchar(123) NOT NULL,
  `image` varchar(255) NOT NULL,
  `fee` varchar(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_signup`
--

CREATE TABLE `tbl_signup` (
  `id` int(11) NOT NULL,
  `name` varchar(123) NOT NULL,
  `father_name` varchar(123) NOT NULL,
  `contact` varchar(123) NOT NULL,
  `email` varchar(123) NOT NULL,
  `password` varchar(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trainee`
--

CREATE TABLE `tbl_trainee` (
  `id` int(11) NOT NULL,
  `trainee_id` varchar(123) NOT NULL,
  `name` varchar(123) NOT NULL,
  `father_name` varchar(123) NOT NULL,
  `contact` varchar(123) NOT NULL,
  `email` varchar(123) NOT NULL,
  `address` varchar(123) NOT NULL,
  `course` varchar(123) NOT NULL,
  `gender` varchar(123) NOT NULL,
  `doj` date NOT NULL,
  `dob` date NOT NULL,
  `duration` varchar(123) NOT NULL,
  `image` varchar(123) NOT NULL,
  `fee` varchar(123) NOT NULL,
  `feestatus` bit(1) NOT NULL DEFAULT b'0',
  `initial_amt` int(8) NOT NULL DEFAULT 0,
  `no_dues` int(2) NOT NULL DEFAULT 0,
  `bill_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_trainee`
--

INSERT INTO `tbl_trainee` (`id`, `trainee_id`, `name`, `father_name`, `contact`, `email`, `address`, `course`, `gender`, `doj`, `dob`, `duration`, `image`, `fee`, `feestatus`, `initial_amt`, `no_dues`, `bill_no`) VALUES
(1, 'har7860', 'hari', 'haran', '1234567860', 'param@rockfortglobal.com', '123,palani', 'testing1', 'male', '2024-10-01', '0000-00-00', '', '', '15000', b'0', 0, 0, 3000),
(2, 'wrw2022', 'wrwf', 'erfref', '8870592022', 'jeeva01122000@gmail.com', 'wuegiwey', 'testing1', 'male', '2024-10-01', '0000-00-00', '', '', '15000', b'0', 0, 1, 3001),
(3, 'fv8905', 'fv', 'efve', '1234678905', 'admin@gmail.com33', 'wuegiwey', 'test123', 'male', '2024-10-01', '0000-00-00', '', '', '15000', b'0', 0, 1, 3002),
(4, 'ref8980', 'refref', 'erfrefre', '1234678980', 'jeeva01122000@gmail.com1111', 'fvdf', 'testing1', 'male', '2024-10-02', '0000-00-00', '', '', '15000', b'0', 0, 1, 3003),
(5, 'wfr8906', 'wfref', 'erferf', '1234678906', 'admin@gmail.comeee', 'wuegiwey', 'testing1', 'male', '2024-10-01', '0000-00-00', '', '', '15000', b'0', 0, 0, 3004);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fee_payment`
--
ALTER TABLE `fee_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_center`
--
ALTER TABLE `tbl_center`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_coursetype`
--
ALTER TABLE `tbl_coursetype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_duration`
--
ALTER TABLE `tbl_duration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_enquiry`
--
ALTER TABLE `tbl_enquiry`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contact` (`contact`,`email`);

--
-- Indexes for table `tbl_signup`
--
ALTER TABLE `tbl_signup`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tbl_trainee`
--
ALTER TABLE `tbl_trainee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contact` (`contact`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fee_payment`
--
ALTER TABLE `fee_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_center`
--
ALTER TABLE `tbl_center`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_coursetype`
--
ALTER TABLE `tbl_coursetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_duration`
--
ALTER TABLE `tbl_duration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_enquiry`
--
ALTER TABLE `tbl_enquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_signup`
--
ALTER TABLE `tbl_signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_trainee`
--
ALTER TABLE `tbl_trainee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
