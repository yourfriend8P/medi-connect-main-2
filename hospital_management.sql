-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2024 at 12:08 PM
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
-- Database: `hospital_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `user_username` varchar(50) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `day_of_week` varchar(10) NOT NULL,
  `problem` text NOT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `doctor_comment` text DEFAULT NULL,
  `report` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_username`, `doctor_id`, `day_of_week`, `problem`, `status`, `doctor_comment`, `report`, `date`) VALUES
(1, 'shreejan', 1, 'Thursday', 'regular general checkup', 'Rejected', 'i won\'t be available that day so sry', NULL, NULL),
(2, 'shreejan', 1, 'Monday', 'regular checkup\r\n', 'Accepted', 'ok lets meet up', 'there is no need to worry just continue our previous prescription\r\n', NULL),
(3, 'shreejan', 3, 'Thursday', 'heart check up', 'Accepted', 'ok i will be there', 'there is no issue with you heart', '2024-05-23'),
(4, 'shreejan', 1, 'Wednesday', 'regular checkup', 'Accepted', 'ok fine be there at 5 pm', NULL, '2024-05-22');

-- --------------------------------------------------------

--
-- Table structure for table `dept`
--

CREATE TABLE `dept` (
  `ID` int(3) NOT NULL,
  `depart` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dept`
--

INSERT INTO `dept` (`ID`, `depart`) VALUES
(1, 'Allergy and immunology'),
(2, 'Anesthesiology'),
(3, 'Dermatology'),
(4, 'Diagnostic radiology'),
(5, 'Emergency medicine'),
(6, 'Family medicine'),
(7, 'Internal medicine'),
(8, 'Medical genetics'),
(9, 'Neurology'),
(10, 'Nuclear medicine'),
(11, 'Obstetrics and gynecology'),
(12, 'Ophthalmology'),
(13, 'Pathology'),
(14, 'Pediatrics'),
(15, 'Physical medicine and rehabilitation'),
(16, 'Preventive medicine'),
(17, 'Psychiatry'),
(18, 'Radiation oncology'),
(19, 'Surgery'),
(20, 'Urology');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `specialty` varchar(100) NOT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `username`, `password`, `name`, `gender`, `email`, `phone`, `specialty`, `status`) VALUES
(1, 'hemhms23', '$2y$10$fAa67rUY4YotXGuCvc5puOxxNMhJ.4RgJMtHzlNOsVO5bYhxk5nfW', 'Dr Hem Sharma', 'Male', 'dr.hem.mediconnect@gmail.com', '9876543210', 'General Medicin', 1),
(3, 'nehahms35', '$2y$10$BNU1lB9.gWgTpKNvxC.FQeYf6hrkoHTyQBx6gvVGFYr53JmVlglR.', 'Dr Neha Gupta', 'Female', 'dr.neha.medicoonect@gmail.com', '9856763421', 'Cardiology', 1),
(4, 'ramhms34', '$2y$10$PFcKWWXIQ1IZuawh9rHIqObMN9StyFow3HjI/vSKiF/pHP5ZUQWbe', 'Dr Ram Shrestha', 'Male', 'dr.ram.mediconnect@gmail.com', '9812345678', 'Cardiology', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `blood_type` varchar(3) DEFAULT NULL,
  `medical_problem` text DEFAULT NULL,
  `profile_picture` varchar(255) NOT NULL COMMENT 'Profile Picture Path'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `username`, `password`, `email`, `first_name`, `last_name`, `date_of_birth`, `address`, `phone`, `blood_type`, `medical_problem`, `profile_picture`) VALUES
(5, 'shreejan', '$2y$10$cs/SnsCH1ce52O3Gr.iAR.k7UGfVc4UNz.Gvfa4gSFhSYEOvi6dJK', 'karmacharya.0327@gmail.com', 'Shreejan', 'Karmacharya', '2000-01-16', 'dhulikhel', '9847889900', 'o-', 'high bp and low glucose', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_username` (`user_username`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `dept`
--
ALTER TABLE `dept`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dept`
--
ALTER TABLE `dept`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_username`) REFERENCES `patients` (`username`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
