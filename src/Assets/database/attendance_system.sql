-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2023 at 11:31 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` varchar(20) NOT NULL,
  `profilePic` blob DEFAULT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `faculty` varchar(100) NOT NULL,
  `nic` varchar(12) NOT NULL,
  `mobileNum` varchar(10) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `department` varchar(100) NOT NULL,
  `userName` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `profilePic`, `firstName`, `lastName`, `faculty`, `nic`, `mobileNum`, `gender`, `email`, `department`, `userName`) VALUES
('Super Admin', 0x2e2e2f2e2e2f4173736574732f75706c6f6164732f41646d696e2f313639313332353434325f363463663934303237323261645f70726f66696c65302e6a7067, 'Viraj', 'Tharuka', 'Computing', '982831296V', '0715285066', 'male', 'virajtharuka.fb@gmail.com', 'Computing and Information Systems', 'Super Admin');

-- --------------------------------------------------------

--
-- Table structure for table `approve`
--

CREATE TABLE `approve` (
  `id` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `nic` varchar(20) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `batch` varchar(6) NOT NULL,
  `profilePic` longblob NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendanceID` int(11) NOT NULL,
  `present` int(1) NOT NULL DEFAULT 0,
  `regNum` varchar(20) NOT NULL,
  `timeIn` datetime NOT NULL,
  `sessionID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendanceID`, `present`, `regNum`, `timeIn`, `sessionID`) VALUES
(206, 1, '18APC3561', '2023-08-08 22:43:00', 134),
(207, 1, '18APC3560', '2023-08-08 22:43:04', 134),
(208, 1, '18APC3562', '2023-08-08 22:43:12', 134),
(209, 1, '18APC3528', '2023-08-08 22:43:26', 134),
(210, 1, '18APC3530', '2023-08-08 22:47:48', 134);

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `batch` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`batch`) VALUES
('17/18'),
('18/19'),
('19/20'),
('20/21'),
('21/22'),
('22/23');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `depID` varchar(20) NOT NULL,
  `depName` varchar(100) NOT NULL,
  `facID` varchar(20) DEFAULT NULL,
  `depPic` blob DEFAULT NULL,
  `depURL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`depID`, `depName`, `facID`, `depPic`, `depURL`) VALUES
('AM/AGRI/SUSL', 'Agribusiness Management', 'agri_susl', NULL, NULL),
('CIS/COM/SUSL', 'Computing and Information Systems', 'com_susl', 0x2e2e2f2e2e2f4173736574732f75706c6f6164732f4465706172746d656e742f313638323037363130335f363434323731633739376262395f69732d3130302e6a7067, 'https://www.sab.ac.lk/computing/departments/dcis-about'),
('DS/COM/SUSL', 'Data Science', 'com_susl', NULL, NULL),
('EA/AGRI/SUSL', 'Export Agriculture', 'agri_susl', NULL, NULL),
('LP/AGRI/SUSL', 'Livestock Production', 'agri_susl', NULL, NULL),
('SE/COM/SUSL', 'Software Engineering', 'com_susl', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `facID` varchar(20) NOT NULL,
  `facName` varchar(100) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `email` varchar(255) DEFAULT 'https://www.sab.ac.lk/',
  `facPic` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`facID`, `facName`, `description`, `email`, `facPic`) VALUES
('agri_susl', 'Agricultural sciences', 'The Faculty of Agricultural Sciences of Sabaragamuwa University of Sri Lanka was initially established at Rahangala in 1995 and was shifted to the main premises at Belihuloya in 2001. Faculty offers B.Sc. Agricultural Sciences and Management, a four year degree which provides specializations in Agribusiness Management, Commercial Horticulture, Plantation Management and Livestock Production.', 'https://www.sab.ac.lk/agri/', NULL),
('app_susl', 'Applied Sciences', 'With thirty years on since its humble beginnings, the Faculty of Applied Sciences has been a breeding ground for renowned scientists, academics, scholars, athletes, entrepreneurs and professionals. Join hands with us, as our faculty continues its legacy.', 'https://www.sab.ac.lk/app/', 0x2e2e2f2e2e2f4173736574732f75706c6f6164732f466163756c7479313638313336383437375f363433376135396435346536635f6170706c6965645f736369656e6365732e6a7067),
('com_susl', 'Computing', 'The Faculty of Computing (FoC) was established as the 9th Faculty of the Sabaragamuwa University of Sri Lanka (SUSL) by an Order made under Section 27(1) in the Gazette Extraordinary 2312/14 dated 27th December 2022.\r\n\r\nIn a backdrop where computing has become an essential component in shaping the future for humanity,  the efforts of SUSL to produce graduates with the perfect blend of theoretical and practical knowledge, who cater to the demands of today’s IT/BPM industry, can now be furthered with the establishment of the FoC.\r\nIn a backdrop where computing has become an essential component in shaping the future for humanity,  the efforts of SUSL to produce graduates with the perfect blend of theoretical and practical knowledge, who cater to the demands of today’s IT/BPM industry, can now be furthered w', 'https://www.sab.ac.lk/computing/', NULL),
('geo_susl', 'Geomatics', 'The Faculty of Geomatics offers high quality geomatics related degrees and consists of a well qualified staff and latest technological resources. It delivers highly job oriented courses and the employability of the graduates is well over 99%. The faculty was established in 2004 as the successor of the Department of Surveying Sciences, which introduced the BSc in Surveying Sciences Degree Programme in 1997. Throughout the past decades it is being greatly developed both in infrastructure and human resources. Presently, the faculty has a student population of about 350 with the aim of producing about 100 graduates annually.', 'https://www.sab.ac.lk/geo/', NULL),
('med_susl', 'Medicine', 'The Faculty of Medicine in Sabaragamuwa University of Sri Lanka is the newest arrival to the chain of Medical Faculties in Sri Lanka. It becomes the eighth Faculty in the Sabaragamuwa University of Sri Lanka. The medical profession caters to one of the most crucial needs of the society, therefore, it stands to reason that medical degrees are among the most challenging and competitive paths to embark upon. This Faculty comprises of 15 Departments which are dedicated to achieve all aspects of her academic mission and objectives. The academic elements in the MBBS Degree Program are based on four main disciplinary pillars; theoretical education, clinical care, community engagement and research. The new Faculty buildings and the professorial unit are being constructed at the land adjacent to the Teaching Hospital, Ratnapura, which provides all clinical training facilities for the students.', 'https://www.sab.ac.lk/med/', NULL),
('mgt_susl', 'Management studies', 'The Faculty of Management Studies of Sabaragamuwa University of Sri Lanka, located within the picturesque nature of Pambahinna, Belihuloya, stands sturdy & proud for more than 25 years, enjoying the panoramic view of spectacular mountain range. The faculty foresees and incorporates knowledge & skills required by the dynamic job market, to be able to cater to the most crucial needs of the society in the time to come, therefore, it stands as an esteemed knowledge creation & Dissemination institution, specialized in management disciplines. The faculty comprises of four departments which offers seven degree programs, which all are dedicated to achieve all aspects of the academic mission and objectives.', 'https://www.sab.ac.lk/mgmt/', NULL),
('social_susl', 'Social sciences and languages', 'The only Arts Faculty in Sri Lankan university system that got “A” grades for all its degree programmes in the \"Self Evaluation Report\" by the University Grants Commission', 'https://www.sab.ac.lk/fssl/', NULL),
('tec_susl', 'Technology', 'Faculty of Technology is the seventh faculty of the Sabaragamuwa University of Sri Lanka. It has been established in the main university premises at Pambahinna. The faculty comprises of two academic departments, namely, the Department of Biosystems Technology, and the Department of Engineering Technology. The Faculty of Technology offers two degree programs: Bachelor of Biosystems Technology Honours degree through the Department of Biosystems Technology, and Bachelor of Engineering Technology Honours degree through the Department of Engineering Technology.', 'https://www.sab.ac.lk/tech/', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `lecturerID` varchar(20) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `nic` varchar(12) NOT NULL,
  `department` varchar(100) NOT NULL,
  `faculty` varchar(100) NOT NULL,
  `profilePic` blob DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `mobileNum` varchar(10) NOT NULL,
  `userName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`lecturerID`, `lastName`, `gender`, `firstName`, `nic`, `department`, `faculty`, `profilePic`, `email`, `mobileNum`, `userName`) VALUES
('COM/CIS/1', 'Lekamge', 'female', 'Sugeeswari', '805623697V', 'Computing and Information Systems', 'Computing', 0x2e2e2f2e2e2f4173736574732f75706c6f6164732f4c656374757265722f313639313534383333365f363464326661623062653363615f4c656b616d67652e6a7067, 'slekamge@appsc.sab.ac.lk', '0715285035', 'COM/CIS/1'),
('COM/SE/1', 'Vasanthapriyan', 'male', 'Professor S', '706596775V', 'Software Engineering', 'Computing', NULL, 'priyan@appsc.sab.ac.lk', '0752563438', 'COM/SE/1');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `sessionID` int(11) NOT NULL,
  `timeStart` time NOT NULL,
  `timeEnd` time NOT NULL,
  `faculty` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `semester` varchar(3) NOT NULL,
  `department` varchar(100) NOT NULL,
  `activityType` varchar(10) NOT NULL,
  `batch` varchar(5) DEFAULT NULL,
  `sessionStatus` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`sessionID`, `timeStart`, `timeEnd`, `faculty`, `subject`, `date`, `semester`, `department`, `activityType`, `batch`, `sessionStatus`) VALUES
(134, '06:00:00', '08:00:00', 'Computing', 'Fundamentals of Information Systems', '2023-08-08', 'I', 'Computing and Information Systems', 'Theory', '18/19', 'closed');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `RegNum` varchar(20) NOT NULL,
  `department` varchar(100) NOT NULL,
  `faculty` varchar(100) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `batch` varchar(5) NOT NULL,
  `profilePic` longblob DEFAULT NULL,
  `firstName` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `nic` varchar(12) NOT NULL,
  `mobileNum` varchar(10) NOT NULL,
  `userName` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`RegNum`, `department`, `faculty`, `lastName`, `email`, `batch`, `profilePic`, `firstName`, `gender`, `nic`, `mobileNum`, `userName`) VALUES
('18APC3528', 'Computing and Information Systems', 'Computing', 'Ananda', 'ireshanannda@gmail.com', '18/19', 0x2e2e2f2e2e2f4173736574732f75706c6f6164732f53747564656e742f313639313531333938345f363464323734383033333239335f70726f66696c65332e6a7067, 'Ireshan', 'male', '956591675V', '0715319599', '18APC3528'),
('18APC3529', 'Computing and Information Systems', 'Computing', 'Anushka', 'prageethanushka@gmail.com', '18/19', 0x2e2e2f2e2e2f4173736574732f75706c6f6164732f53747564656e742f313639313531343037345f363464323734646138356636375f70726f66696c65302e6a7067, 'Prageeth', 'male', '956599365V', '0752563737', '18APC3529'),
('18APC3530', 'Computing and Information Systems', 'Computing', 'Pamodya', 'hemakapamodya@gmail.com', '18/19', NULL, 'Hemaka', 'male', '998596325V', '0752500777', '18APC3530'),
('18APC3560', 'Computing and Information Systems', 'Computing', 'Kasun', 'dushmanthakasun@gmail.com', '18/19', 0x2e2e2f2e2e2f4173736574732f75706c6f6164732f53747564656e742f313639313531333734365f363464323733393238643663615f70726f66696c65332e6a7067, 'Dushmantha', 'male', '992831296V', '0752563999', '18APC3560'),
('18APC3561', 'Computing and Information Systems', 'Computing', 'Tharuka', 'vtranathunga@std.appsc.sab.ac.lk', '18/19', 0x2e2e2f2e2e2f4173736574732f75706c6f6164732f53747564656e742f313639313531333634345f363464323733326365396336375f647564693930365f776f6d616e5f73686f72745f736b6972745f626f686f5f7374796c655f39303832373632362d663832352d346633312d613833372d3963663039316232343561652e706e67, 'Viraj', 'male', '982831296V', '0715285066', '18APC3561'),
('18APC3562', 'Computing and Information Systems', 'Computing', 'Randika', 'ishanrandika@gmail.com', '18/19', 0x2e2e2f2e2e2f4173736574732f75706c6f6164732f53747564656e742f313639313531333830355f363464323733636465646663395f70726f66696c65302e6a7067, 'Ishan', 'male', '956545995V', '0715288379', '18APC3562');

-- --------------------------------------------------------

--
-- Table structure for table `studentattendance`
--

CREATE TABLE `studentattendance` (
  `RegNum` varchar(20) NOT NULL,
  `attendanceID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subCode` varchar(20) NOT NULL,
  `subName` varchar(100) NOT NULL,
  `semester` varchar(3) NOT NULL,
  `depID` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subCode`, `subName`, `semester`, `depID`) VALUES
('IS11201', 'Fundamentals of Information Systems', 'I', 'CIS/COM/SUSL'),
('IS11203 ', 'Information Systems and Practice', 'I', 'CIS/COM/SUSL'),
('IS11204', 'Information System Infrastructure', 'I', 'CIS/COM/SUSL'),
('IS11205 ', 'Fundamentals of Mathematics', 'I', 'CIS/COM/SUSL'),
('IS11206', 'Statistics and Probability Theory', 'I', 'CIS/COM/SUSL'),
('IS11302', 'Structured Programming Techniques', 'I', 'CIS/COM/SUSL'),
('IS12209 ', 'Emerging Technologies for Information Systems', 'II', 'CIS/COM/SUSL'),
('IS12210 ', 'Advanced Mathematics', 'II', 'CIS/COM/SUSL'),
('IS12212 ', 'Human Computer Interaction', 'II', 'CIS/COM/SUSL'),
('IS12307', 'Object Oriented Programming', 'II', 'CIS/COM/SUSL'),
('IS12308', 'Database Systems', 'II', 'CIS/COM/SUSL'),
('IS12311', 'Analysis of Algorithms', 'II', 'CIS/COM/SUSL');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userName` varchar(20) NOT NULL,
  `password` varchar(500) NOT NULL DEFAULT '$2y$10$bNJ7jY2huxyju8uRkWRNZeUSMjhpI6X/wEPTCJcvyTFC6NKBCfZsC',
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userName`, `password`, `role`) VALUES
('18APC3528', '$2y$10$eecLggyhmSDT2j9tCvFppuDpEcBN.N2rfqVy0IKphcQMA86yW2UMu', 'Student'),
('18APC3529', '$2y$10$zymMtpwB1buKNaHUpsyqQuFoLv1rgVvstEmyAn.gEchxbQI88TGqO', 'Student'),
('18APC3530', '$2y$10$l4zjOUBDM7v1jloApJVoDeZO5BdVoRd5nVtpWmqdry85EjBpb55ei', 'Student'),
('18APC3560', '$2y$10$HSOnogceCg4yb50ZSf0IROym2KRIWUJmzaHX9wbRmSSow34L9j1x2', 'Student'),
('18APC3561', '$2y$10$tzmIio4t0cLHDU.oyzn7qeBHTRkW8P9Afq7pGa2EISlsqkScrDLiK', 'Student'),
('18APC3562', '$2y$10$JirCxFgJAwm039z006lJ9usv50x9qlIN5yBCSyrlc8SaYnCJW8692', 'Student'),
('COM/CIS/1', '$2y$10$4zmrXNH7NsvebK3XJXdvceCQcOlLJ.QVNUTy.mMynWfrGiLLMnHa6', 'Lecturer'),
('COM/SE/1', '$2y$10$THlQ2coxkljvDF1FQWqDHO.pS91YcbAKeMnfjhoV.owOud5gvhycq', 'Lecturer'),
('Super Admin', '$2y$10$imbKQI9iDrYowVVEpBXi/.ylIeGC0LoRnACRfqBIRwD8lr4212dUS', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`),
  ADD UNIQUE KEY `nic` (`nic`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobileNum` (`mobileNum`),
  ADD KEY `admin_ibfk_1` (`userName`);

--
-- Indexes for table `approve`
--
ALTER TABLE `approve`
  ADD PRIMARY KEY (`nic`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendanceID`),
  ADD KEY `attendance_ibfk_1` (`sessionID`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`batch`),
  ADD UNIQUE KEY `batch` (`batch`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`depID`),
  ADD UNIQUE KEY `depName` (`depName`),
  ADD KEY `department_ibfk_1` (`facID`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`facID`),
  ADD UNIQUE KEY `depName` (`facName`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`lecturerID`),
  ADD UNIQUE KEY `nic` (`nic`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobileNum` (`mobileNum`),
  ADD KEY `lecturer_ibfk_1` (`userName`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`sessionID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`RegNum`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nic` (`nic`),
  ADD UNIQUE KEY `mobileNum` (`mobileNum`),
  ADD KEY `student_ibfk_1` (`userName`);

--
-- Indexes for table `studentattendance`
--
ALTER TABLE `studentattendance`
  ADD PRIMARY KEY (`RegNum`,`attendanceID`),
  ADD KEY `attendanceID` (`attendanceID`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subCode`),
  ADD KEY `subject_ibfk_1` (`depID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `sessionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`userName`) REFERENCES `user` (`userName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`sessionID`) REFERENCES `session` (`sessionID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`facID`) REFERENCES `faculty` (`facID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD CONSTRAINT `lecturer_ibfk_1` FOREIGN KEY (`userName`) REFERENCES `user` (`userName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`userName`) REFERENCES `user` (`userName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `studentattendance`
--
ALTER TABLE `studentattendance`
  ADD CONSTRAINT `studentattendance_ibfk_1` FOREIGN KEY (`RegNum`) REFERENCES `student` (`RegNum`),
  ADD CONSTRAINT `studentattendance_ibfk_2` FOREIGN KEY (`attendanceID`) REFERENCES `attendance` (`attendanceID`);

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`depID`) REFERENCES `department` (`depID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
