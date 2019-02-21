-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2019 at 04:25 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ics499`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_ID` int(11) NOT NULL,
  `emp_fname` varchar(45) NOT NULL,
  `emp_lname` varchar(45) NOT NULL,
  `emp_phone` varchar(20) NOT NULL,
  `emp_email` varchar(45) NOT NULL,
  `emp_position` varchar(45) NOT NULL,
  `emp_department` varchar(25) NOT NULL,
  `login_ID_FK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_ID`, `emp_fname`, `emp_lname`, `emp_phone`, `emp_email`, `emp_position`, `emp_department`, `login_ID_FK`) VALUES
(1, 'Alex', 'Timm', '6129176654', 'alex@mail.com', 'software engineer', 'ics', 1),
(2, 'Abdisamad', 'Ugas', '6123456789', 'abdi@mail.com', '6123456789', 'ics', 2),
(3, 'Henok', 'Kida', '6128888888', 'henok@mail.com', 'documents', 'ics', 3),
(4, 'Ismail', 'Bile Hassan', '9529999999', 'ismail@mail.com', 'manager', 'ics', 4),
(5, 'First', 'Last1', '1111111111', 'first@mail.com', 'tester', 'finance', 5);

-- --------------------------------------------------------

--
-- Table structure for table `friday`
--

CREATE TABLE `friday` (
  `day_ID` int(11) NOT NULL,
  `emp_ID` int(11) NOT NULL,
  `in_out` varchar(11) NOT NULL,
  `timeIN_OUT` time DEFAULT NULL,
  `week_number` int(100) NOT NULL,
  `total_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friday`
--

INSERT INTO `friday` (`day_ID`, `emp_ID`, `in_out`, `timeIN_OUT`, `week_number`, `total_time`) VALUES
(1, 1, 'in', '09:24:06', 5, 3),
(2, 1, 'out', '09:24:09', 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `monday`
--

CREATE TABLE `monday` (
  `day_ID` int(11) NOT NULL,
  `emp_ID` int(11) NOT NULL,
  `in_out` varchar(11) NOT NULL,
  `timeIN_OUT` time DEFAULT NULL,
  `week_number` int(100) NOT NULL,
  `total_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pto_request`
--

CREATE TABLE `pto_request` (
  `pto_ID` int(11) NOT NULL,
  `emp_ID` int(11) NOT NULL,
  `month_start` varchar(45) NOT NULL,
  `day_start` varchar(45) NOT NULL,
  `year_start` varchar(45) NOT NULL,
  `time_start` varchar(45) NOT NULL,
  `ampm_start` varchar(45) NOT NULL,
  `month_end` varchar(45) NOT NULL,
  `day_end` varchar(45) NOT NULL,
  `year_end` varchar(45) NOT NULL,
  `time_end` varchar(45) NOT NULL,
  `ampm_end` varchar(45) NOT NULL,
  `pto_notes` text NOT NULL,
  `pto_status` varchar(11) NOT NULL DEFAULT 'In progress'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pto_request`
--

INSERT INTO `pto_request` (`pto_ID`, `emp_ID`, `month_start`, `day_start`, `year_start`, `time_start`, `ampm_start`, `month_end`, `day_end`, `year_end`, `time_end`, `ampm_end`, `pto_notes`, `pto_status`) VALUES
(1, 1, 'January', 'Monday', '2018', '12:00', 'AM', 'February', 'Wednesday', '2016', '03:00', 'PM', 'Alex Off					', 'in progress'),
(2, 2, 'March', 'Wednesday', '2016', '02:00', 'PM', 'January', 'Monday', '2018', '01:00', 'AM', 'Abdi Off					', 'in progress'),
(3, 3, 'January', 'Monday', '2018', '12:00', 'AM', 'January', 'Monday', '2018', '01:00', 'AM', 'Henok Off					', 'approved'),
(4, 1, 'January', 'Monday', '2018', '12:00', 'AM', 'January', 'Monday', '2018', '01:00', 'AM', 'Alex Two					', 'denied'),
(5, 5, 'January', 'Monday', '2018', '12:00', 'AM', 'January', 'Monday', '2018', '01:00', 'AM', 'First Off					', 'denied'),
(6, 1, 'January', 'Monday', '2018', '12:00', 'AM', 'January', 'Monday', '2018', '01:00', 'AM', 'Alex pto					', 'approved'),
(7, 3, 'April', 'Friday', '2018', '12:00', 'AM', 'July', 'Monday', '2018', '01:00', 'AM', 'Time off					', 'denied'),
(8, 1, 'January', 'Monday', '2018', '12:00', 'AM', 'January', 'Monday', '2018', '01:00', 'AM', 'Request					', 'approved'),
(9, 1, 'July', 'Thursday', '2018', '04:00', 'PM', 'January', 'Monday', '2018', '01:00', 'AM', '						Enter text here...\r\n					', 'approved'),
(10, 1, 'January', 'Monday', '2018', '12:00', 'AM', 'January', 'Monday', '2018', '01:00', 'AM', 'Just Test		', 'In progress'),
(11, 1, 'November', 'Saturday', '2018', '06:00', 'PM', 'November', 'Monday', '2018', '03:00', 'PM', 'I would like to request a day off', 'In progress');

-- --------------------------------------------------------

--
-- Table structure for table `saturday`
--

CREATE TABLE `saturday` (
  `day_ID` int(11) NOT NULL,
  `emp_ID` int(11) NOT NULL,
  `in_out` varchar(11) NOT NULL,
  `timeIN_OUT` time DEFAULT NULL,
  `week_number` int(100) NOT NULL,
  `total_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sunday`
--

CREATE TABLE `sunday` (
  `day_ID` int(11) NOT NULL,
  `emp_ID` int(11) NOT NULL,
  `in_out` varchar(11) DEFAULT NULL,
  `timeIN_OUT` time DEFAULT NULL,
  `week_number` int(100) NOT NULL,
  `total_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `thursday`
--

CREATE TABLE `thursday` (
  `day_ID` int(11) NOT NULL,
  `emp_ID` int(11) NOT NULL,
  `in_out` varchar(11) NOT NULL,
  `timeIN_OUT` time DEFAULT NULL,
  `week_number` int(100) NOT NULL,
  `total_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tuesday`
--

CREATE TABLE `tuesday` (
  `day_ID` int(11) NOT NULL,
  `emp_ID` int(11) NOT NULL,
  `in_out` varchar(11) NOT NULL,
  `timeIN_OUT` time DEFAULT NULL,
  `week_number` int(100) NOT NULL,
  `total_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `login_ID` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `user_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`login_ID`, `username`, `password`, `user_type`) VALUES
(1, 'alexu', 'alexp', 2),
(2, 'abdiu', 'abdip', 2),
(3, 'kidau', 'kidap', 2),
(4, 'professoru', 'professorp', 1),
(5, 'firstu', 'firstp', 2);

-- --------------------------------------------------------

--
-- Table structure for table `wednesday`
--

CREATE TABLE `wednesday` (
  `day_ID` int(11) NOT NULL,
  `emp_ID` int(11) NOT NULL,
  `in_out` varchar(11) NOT NULL,
  `timeIN_OUT` time DEFAULT NULL,
  `week_number` int(100) NOT NULL,
  `total_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `weeklytotal`
--

CREATE TABLE `weeklytotal` (
  `weekTotal_ID` int(11) NOT NULL,
  `emp_ID` int(11) DEFAULT NULL,
  `weekTotalTime` int(255) DEFAULT '0',
  `week_number` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `weeklytotal`
--

INSERT INTO `weeklytotal` (`weekTotal_ID`, `emp_ID`, `weekTotalTime`, `week_number`) VALUES
(1, 1, 3, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_ID`),
  ADD KEY `login_ID_FK` (`login_ID_FK`);

--
-- Indexes for table `friday`
--
ALTER TABLE `friday`
  ADD PRIMARY KEY (`day_ID`),
  ADD KEY `empID` (`emp_ID`);

--
-- Indexes for table `monday`
--
ALTER TABLE `monday`
  ADD PRIMARY KEY (`day_ID`),
  ADD KEY `empID` (`emp_ID`);

--
-- Indexes for table `pto_request`
--
ALTER TABLE `pto_request`
  ADD PRIMARY KEY (`pto_ID`),
  ADD KEY `emp_ID` (`emp_ID`);

--
-- Indexes for table `saturday`
--
ALTER TABLE `saturday`
  ADD PRIMARY KEY (`day_ID`),
  ADD KEY `empID` (`emp_ID`);

--
-- Indexes for table `sunday`
--
ALTER TABLE `sunday`
  ADD PRIMARY KEY (`day_ID`),
  ADD KEY `empID` (`emp_ID`);

--
-- Indexes for table `thursday`
--
ALTER TABLE `thursday`
  ADD PRIMARY KEY (`day_ID`),
  ADD KEY `empID` (`emp_ID`);

--
-- Indexes for table `tuesday`
--
ALTER TABLE `tuesday`
  ADD PRIMARY KEY (`day_ID`),
  ADD KEY `empID` (`emp_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`login_ID`);

--
-- Indexes for table `wednesday`
--
ALTER TABLE `wednesday`
  ADD PRIMARY KEY (`day_ID`),
  ADD KEY `empID` (`emp_ID`);

--
-- Indexes for table `weeklytotal`
--
ALTER TABLE `weeklytotal`
  ADD PRIMARY KEY (`weekTotal_ID`),
  ADD KEY `emp_ID` (`emp_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `friday`
--
ALTER TABLE `friday`
  MODIFY `day_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `monday`
--
ALTER TABLE `monday`
  MODIFY `day_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pto_request`
--
ALTER TABLE `pto_request`
  MODIFY `pto_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `saturday`
--
ALTER TABLE `saturday`
  MODIFY `day_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sunday`
--
ALTER TABLE `sunday`
  MODIFY `day_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thursday`
--
ALTER TABLE `thursday`
  MODIFY `day_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tuesday`
--
ALTER TABLE `tuesday`
  MODIFY `day_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `login_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wednesday`
--
ALTER TABLE `wednesday`
  MODIFY `day_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `weeklytotal`
--
ALTER TABLE `weeklytotal`
  MODIFY `weekTotal_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`login_ID_FK`) REFERENCES `user` (`login_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `friday`
--
ALTER TABLE `friday`
  ADD CONSTRAINT `friday_ibfk_1` FOREIGN KEY (`emp_ID`) REFERENCES `employee` (`emp_ID`);

--
-- Constraints for table `monday`
--
ALTER TABLE `monday`
  ADD CONSTRAINT `monday_ibfk_1` FOREIGN KEY (`emp_ID`) REFERENCES `employee` (`emp_ID`);

--
-- Constraints for table `pto_request`
--
ALTER TABLE `pto_request`
  ADD CONSTRAINT `pto_request_ibfk_1` FOREIGN KEY (`emp_ID`) REFERENCES `employee` (`emp_ID`);

--
-- Constraints for table `saturday`
--
ALTER TABLE `saturday`
  ADD CONSTRAINT `saturday_ibfk_1` FOREIGN KEY (`emp_ID`) REFERENCES `employee` (`emp_ID`);

--
-- Constraints for table `sunday`
--
ALTER TABLE `sunday`
  ADD CONSTRAINT `sunday_ibfk_1` FOREIGN KEY (`emp_ID`) REFERENCES `employee` (`emp_ID`);

--
-- Constraints for table `thursday`
--
ALTER TABLE `thursday`
  ADD CONSTRAINT `thursday_ibfk_1` FOREIGN KEY (`emp_ID`) REFERENCES `employee` (`emp_ID`);

--
-- Constraints for table `tuesday`
--
ALTER TABLE `tuesday`
  ADD CONSTRAINT `tuesday_ibfk_1` FOREIGN KEY (`emp_ID`) REFERENCES `employee` (`emp_ID`);

--
-- Constraints for table `wednesday`
--
ALTER TABLE `wednesday`
  ADD CONSTRAINT `wednesday_ibfk_1` FOREIGN KEY (`emp_ID`) REFERENCES `employee` (`emp_ID`);

--
-- Constraints for table `weeklytotal`
--
ALTER TABLE `weeklytotal`
  ADD CONSTRAINT `weeklytotal_ibfk_1` FOREIGN KEY (`emp_ID`) REFERENCES `employee` (`emp_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
