-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 19, 2023 at 11:32 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csce310`
--

-- --------------------------------------------------------

--
-- Table structure for table `APPLICANT`
--

CREATE TABLE `APPLICANT` (
  `APPLICANT_ID` int(11) NOT NULL,
  `USER_NAME` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `APPLICATIONS`
--

CREATE TABLE `APPLICATIONS` (
  `APPLICANT_ID` int(11) NOT NULL,
  `POST_ID` int(11) DEFAULT NULL,
  `SUBMISSION_DATE` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `APPOINTMENTS`
--

CREATE TABLE `APPOINTMENTS` (
  `APPT_ID` int(11) NOT NULL,
  `APPT_TIME` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `APPLICANT_ID` int(11) DEFAULT NULL,
  `RECRUITER_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `COMMENTS`
--

CREATE TABLE `COMMENTS` (
  `COMMENT_ID` int(11) NOT NULL,
  `APPLICANT_ID` int(11) DEFAULT NULL,
  `POST_ID` int(11) DEFAULT NULL,
  `COMMENT_BODY` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `COMPANY`
--

CREATE TABLE `COMPANY` (
  `COMPANY_ID` int(11) NOT NULL,
  `COMPANY_NAME` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `JOB_POSTING`
--

CREATE TABLE `JOB_POSTING` (
  `POST_ID` int(11) NOT NULL,
  `COMPANY_ID` int(11) DEFAULT NULL,
  `POST_DESC` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `RECRUITER`
--

CREATE TABLE `RECRUITER` (
  `RECRUITER_ID` int(11) NOT NULL,
  `COMPANY_ID` int(11) DEFAULT NULL,
  `USER_NAME` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `USER`
--

CREATE TABLE `USER` (
  `USER_NAME` varchar(200) NOT NULL,
  `USER_LNAME` varchar(200) DEFAULT NULL,
  `USER_FNAME` varchar(200) DEFAULT NULL,
  `USER_PHONE` varchar(200) DEFAULT NULL,
  `USER_EMAIL` varchar(200) DEFAULT NULL,
  `USER_TYPE` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `APPLICANT`
--
ALTER TABLE `APPLICANT`
  ADD PRIMARY KEY (`APPLICANT_ID`),
  ADD KEY `USER_NAME` (`USER_NAME`);

--
-- Indexes for table `APPLICATIONS`
--
ALTER TABLE `APPLICATIONS`
  ADD PRIMARY KEY (`APPLICANT_ID`),
  ADD KEY `POST_ID` (`POST_ID`);

--
-- Indexes for table `APPOINTMENTS`
--
ALTER TABLE `APPOINTMENTS`
  ADD PRIMARY KEY (`APPT_ID`),
  ADD KEY `APPLICANT_ID` (`APPLICANT_ID`),
  ADD KEY `RECRUITER_ID` (`RECRUITER_ID`);

--
-- Indexes for table `COMMENTS`
--
ALTER TABLE `COMMENTS`
  ADD PRIMARY KEY (`COMMENT_ID`),
  ADD KEY `APPLICANT_ID` (`APPLICANT_ID`);

--
-- Indexes for table `COMPANY`
--
ALTER TABLE `COMPANY`
  ADD PRIMARY KEY (`COMPANY_ID`);

--
-- Indexes for table `JOB_POSTING`
--
ALTER TABLE `JOB_POSTING`
  ADD PRIMARY KEY (`POST_ID`),
  ADD KEY `COMPANY_ID` (`COMPANY_ID`);

--
-- Indexes for table `RECRUITER`
--
ALTER TABLE `RECRUITER`
  ADD PRIMARY KEY (`RECRUITER_ID`),
  ADD KEY `COMPANY_ID` (`COMPANY_ID`),
  ADD KEY `USER_NAME` (`USER_NAME`);

--
-- Indexes for table `USER`
--
ALTER TABLE `USER`
  ADD PRIMARY KEY (`USER_NAME`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `APPLICANT`
--
ALTER TABLE `APPLICANT`
  MODIFY `APPLICANT_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `APPLICATIONS`
--
ALTER TABLE `APPLICATIONS`
  MODIFY `APPLICANT_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `APPOINTMENTS`
--
ALTER TABLE `APPOINTMENTS`
  MODIFY `APPT_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `COMMENTS`
--
ALTER TABLE `COMMENTS`
  MODIFY `COMMENT_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `COMPANY`
--
ALTER TABLE `COMPANY`
  MODIFY `COMPANY_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `JOB_POSTING`
--
ALTER TABLE `JOB_POSTING`
  MODIFY `POST_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `RECRUITER`
--
ALTER TABLE `RECRUITER`
  MODIFY `RECRUITER_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `APPLICANT`
--
ALTER TABLE `APPLICANT`
  ADD CONSTRAINT `applicant_ibfk_1` FOREIGN KEY (`USER_NAME`) REFERENCES `USER` (`USER_NAME`);

--
-- Constraints for table `APPLICATIONS`
--
ALTER TABLE `APPLICATIONS`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`APPLICANT_ID`) REFERENCES `APPLICANT` (`APPLICANT_ID`),
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`POST_ID`) REFERENCES `JOB_POSTING` (`POST_ID`);

--
-- Constraints for table `APPOINTMENTS`
--
ALTER TABLE `APPOINTMENTS`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`APPLICANT_ID`) REFERENCES `APPLICANT` (`APPLICANT_ID`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`RECRUITER_ID`) REFERENCES `RECRUITER` (`RECRUITER_ID`);

--
-- Constraints for table `COMMENTS`
--
ALTER TABLE `COMMENTS`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`APPLICANT_ID`) REFERENCES `APPLICANT` (`APPLICANT_ID`);

--
-- Constraints for table `JOB_POSTING`
--
ALTER TABLE `JOB_POSTING`
  ADD CONSTRAINT `job_posting_ibfk_1` FOREIGN KEY (`COMPANY_ID`) REFERENCES `COMPANY` (`COMPANY_ID`);

--
-- Constraints for table `RECRUITER`
--
ALTER TABLE `RECRUITER`
  ADD CONSTRAINT `recruiter_ibfk_1` FOREIGN KEY (`COMPANY_ID`) REFERENCES `COMPANY` (`COMPANY_ID`),
  ADD CONSTRAINT `recruiter_ibfk_2` FOREIGN KEY (`USER_NAME`) REFERENCES `USER` (`USER_NAME`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
