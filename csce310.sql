-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2023 at 08:33 PM
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
-- Table structure for table `applicant`
--

CREATE TABLE `applicant` (
  `APPLICANT_ID` int(11) NOT NULL,
  `USER_NAME` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicant`
--

INSERT INTO `applicant` (`APPLICANT_ID`, `USER_NAME`) VALUES
(2, 'bob_builder'),
(1, 'john_smith'),
(3, 'spongebob_squarepants');

-- --------------------------------------------------------

--
-- Stand-in structure for view `applicant_time`
-- (See below for the actual view)
--
CREATE TABLE `applicant_time` (
`APPT_TIME` timestamp
,`APPLICANT_ID` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `APPLICATION_ID` int(11) NOT NULL,
  `APPLICANT_ID` int(11) NOT NULL,
  `POST_ID` int(11) DEFAULT NULL,
  `SUBMISSION_DATE` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`APPLICATION_ID`, `APPLICANT_ID`, `POST_ID`, `SUBMISSION_DATE`) VALUES
(1, 1, 7, '2023-05-05 02:12:35'),
(12, 3, 2, '2023-05-02 03:45:44'),
(13, 3, 4, '2023-05-02 03:47:55'),
(14, 2, 2, '2023-05-02 03:48:36'),
(16, 1, 6, '2023-05-03 11:29:53'),
(17, 3, 9, '2023-05-05 12:14:42'),
(18, 1, 2, '2023-05-05 02:11:50');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `APPT_ID` int(11) NOT NULL,
  `APPT_TIME` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `APPLICANT_ID` int(11) DEFAULT NULL,
  `RECRUITER_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`APPT_ID`, `APPT_TIME`, `APPLICANT_ID`, `RECRUITER_ID`) VALUES
(1, '2023-04-26 22:25:02', 1, 1),
(2, '2023-04-26 22:25:09', 2, 2),
(3, '2023-04-26 22:25:21', 3, 3),
(5, '2023-05-04 22:25:02', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `COMMENT_ID` int(11) NOT NULL,
  `APPLICANT_ID` int(11) DEFAULT NULL,
  `POST_ID` int(11) DEFAULT NULL,
  `COMMENT_BODY` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`COMMENT_ID`, `APPLICANT_ID`, `POST_ID`, `COMMENT_BODY`) VALUES
(2, 2, 2, 'Great pay but very hard work'),
(3, 3, 4, 'Doesn\'t pay very well, boss is cheap, no time off allowed'),
(4, NULL, 2, 'hello great job'),
(5, NULL, 2, 'hey');

-- --------------------------------------------------------

--
-- Stand-in structure for view `comment_username`
-- (See below for the actual view)
--
CREATE TABLE `comment_username` (
`COMMENT_ID` int(11)
,`APPLICANT_ID` int(11)
,`POST_ID` int(11)
,`COMMENT_BODY` varchar(255)
,`USER_NAME` varchar(200)
);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `COMPANY_ID` int(11) NOT NULL,
  `COMPANY_NAME` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`COMPANY_ID`, `COMPANY_NAME`) VALUES
(1, 'Texas A&M University'),
(2, 'Apple'),
(3, 'Krusty Krab');

-- --------------------------------------------------------

--
-- Stand-in structure for view `details`
-- (See below for the actual view)
--
CREATE TABLE `details` (
`APPLICATION_ID` int(11)
,`APPLICANT_ID` int(11)
,`POST_ID` int(11)
,`POST_DESC` varchar(255)
,`COMPANY_NAME` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `job_posting`
--

CREATE TABLE `job_posting` (
  `POST_ID` int(11) NOT NULL,
  `COMPANY_ID` int(11) DEFAULT NULL,
  `POST_DESC` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_posting`
--

INSERT INTO `job_posting` (`POST_ID`, `COMPANY_ID`, `POST_DESC`) VALUES
(2, 2, 'Project Manager'),
(4, 3, 'Fry Cook'),
(5, 2, 'Software Engineer'),
(6, 1, 'Student Worker'),
(7, 3, 'Cashier'),
(8, 1, 'Professor'),
(9, 1, 'Computer Science Professor');

-- --------------------------------------------------------

--
-- Table structure for table `recruiter`
--

CREATE TABLE `recruiter` (
  `RECRUITER_ID` int(11) NOT NULL,
  `COMPANY_ID` int(11) DEFAULT NULL,
  `USER_NAME` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recruiter`
--

INSERT INTO `recruiter` (`RECRUITER_ID`, `COMPANY_ID`, `USER_NAME`) VALUES
(1, 1, 'jane_doe'),
(2, 2, 'steve_jobs'),
(3, 3, 'eugene_krabs');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `USER_NAME` varchar(200) NOT NULL,
  `USER_LNAME` varchar(200) DEFAULT NULL,
  `USER_FNAME` varchar(200) DEFAULT NULL,
  `USER_PHONE` varchar(200) DEFAULT NULL,
  `USER_EMAIL` varchar(200) DEFAULT NULL,
  `USER_TYPE` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`USER_NAME`, `USER_LNAME`, `USER_FNAME`, `USER_PHONE`, `USER_EMAIL`, `USER_TYPE`) VALUES
('bob_builder', 'Builder', 'Bob', '0987654321', 'bob_builder@email.com', 'Applicant'),
('eugene_krabs', 'Krabs', 'Eugene', '9999999999', 'eugene_krabs@email.com', 'Recruiter'),
('jane_doe', 'Doe', 'Jane', '1234567890', 'jane_doe@email.com', 'Recruiter'),
('john_smith', 'Smith', 'John', '1234567890', 'john_smith@email.com', 'Applicant'),
('spongebob_squarepants', 'Squarepants', 'BOB', '7777777777', 'spongebob_squarepants@email.com', 'Applicant'),
('steve_jobs', 'Jobs', 'Steve', '1231234567', 'steve_jobs@email.com', 'Recruiter');

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_profile`
-- (See below for the actual view)
--
CREATE TABLE `user_profile` (
`USER_NAME` varchar(200)
,`USER_LNAME` varchar(200)
,`USER_FNAME` varchar(200)
,`USER_PHONE` varchar(200)
,`USER_EMAIL` varchar(200)
);

-- --------------------------------------------------------

--
-- Structure for view `applicant_time`
--
DROP TABLE IF EXISTS `applicant_time`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `applicant_time`  AS SELECT `appointments`.`APPT_TIME` AS `APPT_TIME`, `appointments`.`APPLICANT_ID` AS `APPLICANT_ID` FROM `appointments``appointments`  ;

-- --------------------------------------------------------

--
-- Structure for view `comment_username`
--
DROP TABLE IF EXISTS `comment_username`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `comment_username`  AS SELECT `comments`.`COMMENT_ID` AS `COMMENT_ID`, `comments`.`APPLICANT_ID` AS `APPLICANT_ID`, `comments`.`POST_ID` AS `POST_ID`, `comments`.`COMMENT_BODY` AS `COMMENT_BODY`, `applicant`.`USER_NAME` AS `USER_NAME` FROM (`comments` join `applicant` on(`comments`.`APPLICANT_ID` = `applicant`.`APPLICANT_ID`))  ;

-- --------------------------------------------------------

--
-- Structure for view `details`
--
DROP TABLE IF EXISTS `details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `details`  AS SELECT `applications`.`APPLICATION_ID` AS `APPLICATION_ID`, `applications`.`APPLICANT_ID` AS `APPLICANT_ID`, `applications`.`POST_ID` AS `POST_ID`, `job_posting`.`POST_DESC` AS `POST_DESC`, `company`.`COMPANY_NAME` AS `COMPANY_NAME` FROM ((`applications` join `job_posting`) join `company`) WHERE `applications`.`POST_ID` = `job_posting`.`POST_ID` AND `job_posting`.`COMPANY_ID` = `company`.`COMPANY_ID``COMPANY_ID`  ;

-- --------------------------------------------------------

--
-- Structure for view `user_profile`
--
DROP TABLE IF EXISTS `user_profile`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_profile`  AS SELECT `user`.`USER_NAME` AS `USER_NAME`, `user`.`USER_LNAME` AS `USER_LNAME`, `user`.`USER_FNAME` AS `USER_FNAME`, `user`.`USER_PHONE` AS `USER_PHONE`, `user`.`USER_EMAIL` AS `USER_EMAIL` FROM `user``user`  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicant`
--
ALTER TABLE `applicant`
  ADD PRIMARY KEY (`APPLICANT_ID`),
  ADD KEY `USER_NAME` (`USER_NAME`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`APPLICATION_ID`),
  ADD KEY `POST_ID` (`POST_ID`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`APPT_ID`),
  ADD KEY `APPLICANT_ID` (`APPLICANT_ID`),
  ADD KEY `RECRUITER_ID` (`RECRUITER_ID`),
  ADD KEY `idx_recruiter_id` (`RECRUITER_ID`),
  ADD KEY `RECRUITER_ID_2` (`RECRUITER_ID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`COMMENT_ID`),
  ADD KEY `APPLICANT_ID` (`APPLICANT_ID`),
  ADD KEY `POST_ID` (`POST_ID`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`COMPANY_ID`);

--
-- Indexes for table `job_posting`
--
ALTER TABLE `job_posting`
  ADD PRIMARY KEY (`POST_ID`),
  ADD KEY `COMPANY_ID` (`COMPANY_ID`),
  ADD KEY `POST_DESC` (`POST_DESC`);

--
-- Indexes for table `recruiter`
--
ALTER TABLE `recruiter`
  ADD PRIMARY KEY (`RECRUITER_ID`),
  ADD KEY `COMPANY_ID` (`COMPANY_ID`),
  ADD KEY `USER_NAME` (`USER_NAME`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`USER_NAME`),
  ADD KEY `USER_LNAME` (`USER_LNAME`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicant`
--
ALTER TABLE `applicant`
  MODIFY `APPLICANT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `APPLICATION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `APPT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `COMMENT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `COMPANY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `job_posting`
--
ALTER TABLE `job_posting`
  MODIFY `POST_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `recruiter`
--
ALTER TABLE `recruiter`
  MODIFY `RECRUITER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicant`
--
ALTER TABLE `applicant`
  ADD CONSTRAINT `applicant_ibfk_1` FOREIGN KEY (`USER_NAME`) REFERENCES `user` (`USER_NAME`);

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`APPLICANT_ID`) REFERENCES `applicant` (`APPLICANT_ID`),
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`POST_ID`) REFERENCES `job_posting` (`POST_ID`);

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`APPLICANT_ID`) REFERENCES `applicant` (`APPLICANT_ID`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`RECRUITER_ID`) REFERENCES `recruiter` (`RECRUITER_ID`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`APPLICANT_ID`) REFERENCES `applicant` (`APPLICANT_ID`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`POST_ID`) REFERENCES `job_posting` (`POST_ID`);

--
-- Constraints for table `job_posting`
--
ALTER TABLE `job_posting`
  ADD CONSTRAINT `job_posting_ibfk_1` FOREIGN KEY (`COMPANY_ID`) REFERENCES `company` (`COMPANY_ID`);

--
-- Constraints for table `recruiter`
--
ALTER TABLE `recruiter`
  ADD CONSTRAINT `recruiter_ibfk_1` FOREIGN KEY (`COMPANY_ID`) REFERENCES `company` (`COMPANY_ID`),
  ADD CONSTRAINT `recruiter_ibfk_2` FOREIGN KEY (`USER_NAME`) REFERENCES `user` (`USER_NAME`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
