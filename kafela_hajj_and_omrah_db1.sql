-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2024 at 06:46 AM
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
-- Database: `kafela_hajj_and_omrah_db1`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `post_code` decimal(4,0) NOT NULL,
  `post_area` varchar(20) DEFAULT NULL,
  `upazila` varchar(20) DEFAULT NULL,
  `zila` varchar(20) DEFAULT NULL,
  `bivag` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`post_code`, `post_area`, `upazila`, `zila`, `bivag`) VALUES
(1000, 'Dhaka', 'Dhaka', 'Dhaka', 'Dhaka'),
(2200, 'Mymensingh Sadar', 'Mymensingh Sadar', 'Mymensingh', 'Mymensingh'),
(2400, 'Netrokona', 'Netrokona Sadar', 'Netrokona', 'Mymensingh'),
(3100, 'Sylhet Sadar', 'Sylhet Sadar', 'Sylhet', 'Sylhet'),
(5400, 'Rangpur Sadar', 'Rangpur Sadar', 'Rangpur', 'Rangpur'),
(6000, 'Rajshahi Sadar', 'Rajshahi Sadar', 'Rajshahi', 'Rajshahi'),
(6400, 'natore', 'natore sadar', 'natore', 'Rajshahi'),
(8200, 'Borisal Sadar', 'Borisal Sadar', 'Borisal', 'Borisal'),
(9000, 'Khulna Sadar', 'Khulna Sadar', 'Khulna', 'Khulna');

-- --------------------------------------------------------

--
-- Table structure for table `agency`
--

CREATE TABLE `agency` (
  `agency_name` varchar(255) DEFAULT NULL,
  `agency_regi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agency`
--

INSERT INTO `agency` (`agency_name`, `agency_regi`) VALUES
('Test Air Connection', 'X0000'),
('Test2 Air Connection', 'X0001'),
('Test3 Air Connection', 'X0002'),
('Test4 Air Connection', 'X0003'),
('Test5 Air Connection', 'X0004');

-- --------------------------------------------------------

--
-- Table structure for table `hajjee`
--

CREATE TABLE `hajjee` (
  `hj_user_name` varchar(20) DEFAULT NULL,
  `hj_email` varchar(255) NOT NULL,
  `hj_pass` varchar(255) NOT NULL,
  `hj_post_code` decimal(4,0) DEFAULT NULL,
  `hj_mobile` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hajjee`
--

INSERT INTO `hajjee` (`hj_user_name`, `hj_email`, `hj_pass`, `hj_post_code`, `hj_mobile`) VALUES
('test1hj', 'test1hj@gmail.com', '123', 6400, '01xxxxxxxxx'),
('test2hj', 'test2hj@gmail.com', '123', 1000, '01xxxxxxxx1');

-- --------------------------------------------------------

--
-- Table structure for table `muallim`
--

CREATE TABLE `muallim` (
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `mobile` varchar(14) DEFAULT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) DEFAULT NULL,
  `post_code` decimal(4,0) NOT NULL,
  `agency_regi` varchar(10) DEFAULT NULL,
  `experience` decimal(4,0) DEFAULT 0,
  `user_rating` decimal(3,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `muallim`
--

INSERT INTO `muallim` (`email`, `pass`, `mobile`, `fname`, `lname`, `post_code`, `agency_regi`, `experience`, `user_rating`) VALUES
('test1@gmail.com', '123', '01XXXXXXXXX', 'test1', 'test1lastname', 6000, 'X0000', 0, 0.00),
('test2@gmail.com', '123', '01XXXXXXXX1', 'test2', 'test2lastname', 1000, 'X0001', 0, 0.00),
('test3@gmail.com', '123', '01XXXXXXXX2', 'test3', 'test3lastname', 2200, 'X0002', 0, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `trip_hajjee`
--

CREATE TABLE `trip_hajjee` (
  `email` varchar(255) NOT NULL,
  `hj_email` varchar(255) NOT NULL,
  `trip_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trip_hajjee`
--

INSERT INTO `trip_hajjee` (`email`, `hj_email`, `trip_date`) VALUES
('test1@gmail.com', 'test1hj@gmail.com', '2024-02-15'),
('test1@gmail.com', 'test1hj@gmail.com', '2024-03-15'),
('test1@gmail.com', 'test2hj@gmail.com', '2024-03-15');

-- --------------------------------------------------------

--
-- Table structure for table `trip_muallim`
--

CREATE TABLE `trip_muallim` (
  `email` varchar(255) NOT NULL,
  `trip_cost` decimal(10,0) DEFAULT NULL,
  `trip_date` date NOT NULL,
  `trip_status` varchar(20) DEFAULT NULL,
  `trip_type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trip_muallim`
--

INSERT INTO `trip_muallim` (`email`, `trip_cost`, `trip_date`, `trip_status`, `trip_type`) VALUES
('test1@gmail.com', 120000, '2024-02-15', 'Past', 'Omrah'),
('test1@gmail.com', 125000, '2024-03-15', 'Upcoming', 'Omrah'),
('test2@gmail.com', 115000, '2024-02-16', 'Past', 'Omrah'),
('test2@gmail.com', 120000, '2024-03-20', 'Upcoming', 'Omrah'),
('test2@gmail.com', 125000, '2024-04-15', 'Upcoming', 'Omrah'),
('test3@gmail.com', 100000, '2024-02-20', 'Past', 'Omrah'),
('test3@gmail.com', 100000, '2024-03-17', 'Upcoming', 'Omrah'),
('test3@gmail.com', 165000, '2024-04-15', 'Upcoming', 'Omrah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`post_code`);

--
-- Indexes for table `agency`
--
ALTER TABLE `agency`
  ADD PRIMARY KEY (`agency_regi`);

--
-- Indexes for table `hajjee`
--
ALTER TABLE `hajjee`
  ADD PRIMARY KEY (`hj_email`),
  ADD KEY `hj_post_code` (`hj_post_code`);

--
-- Indexes for table `muallim`
--
ALTER TABLE `muallim`
  ADD PRIMARY KEY (`email`),
  ADD KEY `post_code` (`post_code`),
  ADD KEY `agency_regi` (`agency_regi`);

--
-- Indexes for table `trip_hajjee`
--
ALTER TABLE `trip_hajjee`
  ADD PRIMARY KEY (`email`,`hj_email`,`trip_date`),
  ADD KEY `trip_hajjee_ibfk_2` (`hj_email`);

--
-- Indexes for table `trip_muallim`
--
ALTER TABLE `trip_muallim`
  ADD PRIMARY KEY (`email`,`trip_date`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hajjee`
--
ALTER TABLE `hajjee`
  ADD CONSTRAINT `hajjee_ibfk_1` FOREIGN KEY (`hj_post_code`) REFERENCES `addresses` (`post_code`);

--
-- Constraints for table `muallim`
--
ALTER TABLE `muallim`
  ADD CONSTRAINT `muallim_ibfk_1` FOREIGN KEY (`agency_regi`) REFERENCES `agency` (`agency_regi`),
  ADD CONSTRAINT `muallim_ibfk_2` FOREIGN KEY (`post_code`) REFERENCES `addresses` (`post_code`),
  ADD CONSTRAINT `muallim_ibfk_3` FOREIGN KEY (`agency_regi`) REFERENCES `agency` (`agency_regi`) ON DELETE SET NULL;

--
-- Constraints for table `trip_hajjee`
--
ALTER TABLE `trip_hajjee`
  ADD CONSTRAINT `trip_hajjee_ibfk_1` FOREIGN KEY (`email`) REFERENCES `muallim` (`email`),
  ADD CONSTRAINT `trip_hajjee_ibfk_2` FOREIGN KEY (`hj_email`) REFERENCES `hajjee` (`hj_email`);

--
-- Constraints for table `trip_muallim`
--
ALTER TABLE `trip_muallim`
  ADD CONSTRAINT `trip_muallim_ibfk_1` FOREIGN KEY (`email`) REFERENCES `muallim` (`email`),
  ADD CONSTRAINT `trip_muallim_ibfk_2` FOREIGN KEY (`email`) REFERENCES `muallim` (`email`),
  ADD CONSTRAINT `trip_muallim_ibfk_3` FOREIGN KEY (`email`) REFERENCES `muallim` (`email`),
  ADD CONSTRAINT `trip_muallim_ibfk_4` FOREIGN KEY (`email`) REFERENCES `muallim` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
