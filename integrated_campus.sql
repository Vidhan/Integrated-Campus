-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2013 at 03:24 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `integrated_campus`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `Uid` int(11) NOT NULL,
  PRIMARY KEY (`Uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Uid`) VALUES
(200000000);

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `Option_Id` int(11) NOT NULL,
  `Responses` int(11) NOT NULL,
  `Options_Data` varchar(100) NOT NULL,
  `Poll_Id` int(11) NOT NULL,
  PRIMARY KEY (`Poll_Id`,`Option_Id`),
  KEY `Poll_Id` (`Poll_Id`),
  KEY `Poll_Id_2` (`Poll_Id`),
  KEY `Poll_Id_3` (`Poll_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`Option_Id`, `Responses`, `Options_Data`, `Poll_Id`) VALUES
(0, 1, 'Requirement', 2),
(1, 1, 'Design', 2),
(2, 0, 'Coding', 2),
(3, 0, 'Testing', 2),
(0, 0, 'Very Easy', 3),
(1, 0, 'Easy', 3),
(2, 0, 'Average', 3),
(3, 1, 'Hard', 3),
(4, 1, 'Very Hard', 3);

-- --------------------------------------------------------

--
-- Table structure for table `attends`
--

CREATE TABLE IF NOT EXISTS `attends` (
  `Course_Id` varchar(6) NOT NULL,
  `Year` year(4) NOT NULL,
  `Sem_Type` varchar(6) NOT NULL,
  `Uid` int(11) NOT NULL,
  `StudentId` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Present` int(11) NOT NULL,
  `Type` varchar(15) NOT NULL,
  PRIMARY KEY (`Course_Id`,`Year`,`Sem_Type`,`Uid`,`Date`,`StudentId`,`Type`),
  KEY `Uid` (`Uid`),
  KEY `Course_Id` (`Course_Id`,`Uid`,`Date`),
  KEY `Date` (`Date`),
  KEY `Type` (`Type`),
  KEY `Type_2` (`Type`),
  KEY `StudentId` (`StudentId`),
  KEY `Course_Id_2` (`Course_Id`),
  KEY `Uid_2` (`Uid`),
  KEY `Date_2` (`Date`),
  KEY `Course_Id_3` (`Course_Id`),
  KEY `Year` (`Year`),
  KEY `Sem_Type` (`Sem_Type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attends`
--

INSERT INTO `attends` (`Course_Id`, `Year`, `Sem_Type`, `Uid`, `StudentId`, `Date`, `Present`, `Type`) VALUES
('IT308', 2013, 'winter', 201002005, 201001049, '2013-04-04', 1, 'Lecture'),
('IT314', 2013, 'winter', 201002006, 201001036, '2013-03-30', 0, 'Lecture'),
('IT314', 2013, 'winter', 201002006, 201001045, '2013-03-30', 0, 'Lecture'),
('IT314', 2013, 'winter', 201002006, 201001049, '2013-03-30', 1, 'Lecture'),
('IT314', 2013, 'winter', 201002006, 201001036, '2013-03-31', 1, 'Lecture'),
('IT314', 2013, 'winter', 201002006, 201001045, '2013-03-31', 1, 'Lecture'),
('IT314', 2013, 'winter', 201002006, 201001049, '2013-03-31', 1, 'Lecture'),
('IT314', 2013, 'winter', 201002006, 201001036, '2013-04-01', 1, 'Lab'),
('IT314', 2013, 'winter', 201002006, 201001036, '2013-04-01', 1, 'Lecture'),
('IT314', 2013, 'winter', 201002006, 201001045, '2013-04-01', 1, 'Lab'),
('IT314', 2013, 'winter', 201002006, 201001045, '2013-04-01', 0, 'Lecture'),
('IT314', 2013, 'winter', 201002006, 201001049, '2013-04-01', 1, 'Lab'),
('IT314', 2013, 'winter', 201002006, 201001049, '2013-04-01', 1, 'Lecture'),
('IT314', 2013, 'winter', 201002006, 201001036, '2013-04-02', 1, 'Lecture'),
('IT314', 2013, 'winter', 201002006, 201001036, '2013-04-02', 0, 'Tutorial'),
('IT314', 2013, 'winter', 201002006, 201001045, '2013-04-02', 1, 'Lecture'),
('IT314', 2013, 'winter', 201002006, 201001045, '2013-04-02', 1, 'Tutorial'),
('IT314', 2013, 'winter', 201002006, 201001049, '2013-04-02', 1, 'Lecture'),
('IT314', 2013, 'winter', 201002006, 201001049, '2013-04-02', 1, 'Tutorial'),
('IT314', 2013, 'winter', 201103006, 201001011, '2013-04-10', 1, 'Lecture'),
('IT314', 2013, 'winter', 201103006, 201001036, '2013-04-10', 0, 'Lecture'),
('IT314', 2013, 'winter', 201103006, 201001045, '2013-04-10', 1, 'Lecture'),
('IT314', 2013, 'winter', 201103006, 201001049, '2013-04-10', 1, 'Lecture'),
('IT342', 2013, 'winter', 201002001, 201001036, '2013-03-25', 0, 'Lecture'),
('IT342', 2013, 'winter', 201002001, 201001045, '2013-03-25', 1, 'Lecture'),
('IT342', 2013, 'winter', 201002001, 201001049, '2013-03-25', 1, 'Lecture'),
('IT342', 2013, 'winter', 201002001, 201001036, '2013-04-01', 1, 'Lecture'),
('IT342', 2013, 'winter', 201002001, 201001045, '2013-04-01', 0, 'Lecture'),
('IT342', 2013, 'winter', 201002001, 201001049, '2013-04-01', 1, 'Lecture'),
('IT342', 2013, 'winter', 201002001, 201001036, '2013-04-07', 0, 'Lecture'),
('IT342', 2013, 'winter', 201002001, 201001045, '2013-04-07', 1, 'Lecture'),
('IT342', 2013, 'winter', 201002001, 201001049, '2013-04-07', 1, 'Lecture');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `Course_Id` varchar(6) NOT NULL,
  `Course_Name` varchar(30) NOT NULL,
  `Course_Type` varchar(10) NOT NULL,
  `Course_Credit` varchar(20) NOT NULL,
  PRIMARY KEY (`Course_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`Course_Id`, `Course_Name`, `Course_Type`, `Course_Credit`) VALUES
('IT308', 'Operating Systems', 'Elective', '4.00(3.00+0.00+2.00)'),
('IT314', 'Software Engineering', 'Core', '4.50(3.00+0.00+3.00)'),
('IT325', 'Introduction to Cryptography', 'Elective', '3.00(3.00+0.00+0.00)'),
('IT342', 'Web Programming', 'Elective', '4.00(3.00+0.00+2.00)'),
('IT518', 'Fuzzy-Neural Systems', 'Elective', '3.00(3.00+0.00+0.00)'),
('IT550', 'Infromation Retrieval', 'Elective', '3.00(3.00+0.00+0.00)'),
('PC105', 'Introduction to ICT', 'Core', '3.00(3.00+0.00+0.00)');

-- --------------------------------------------------------

--
-- Table structure for table `course_activity`
--

CREATE TABLE IF NOT EXISTS `course_activity` (
  `Date` date NOT NULL,
  `Uid` int(11) NOT NULL,
  `Sem_Type` varchar(15) NOT NULL,
  `Course_Id` varchar(20) NOT NULL,
  `year` year(4) NOT NULL,
  `Type` varchar(15) NOT NULL,
  PRIMARY KEY (`Date`,`Sem_Type`,`Course_Id`,`year`,`Type`,`Uid`),
  KEY `Uid` (`Uid`,`Sem_Type`,`Course_Id`,`year`),
  KEY `Sem_Type` (`Sem_Type`),
  KEY `Course_Id` (`Course_Id`),
  KEY `year` (`year`),
  KEY `Type` (`Type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_activity`
--

INSERT INTO `course_activity` (`Date`, `Uid`, `Sem_Type`, `Course_Id`, `year`, `Type`) VALUES
('2013-03-25', 201002001, 'winter', 'IT342', 2013, 'Lecture'),
('2013-03-30', 201002006, 'winter', 'IT314', 2013, 'Lecture'),
('2013-03-31', 201002006, 'winter', 'IT314', 2013, 'Lecture'),
('2013-04-01', 201002006, 'winter', 'IT314', 2013, 'Lab'),
('2013-04-01', 201002006, 'winter', 'IT314', 2013, 'Lecture'),
('2013-04-01', 201002001, 'winter', 'IT342', 2013, 'Lecture'),
('2013-04-02', 201002006, 'winter', 'IT314', 2013, 'Lecture'),
('2013-04-02', 201002006, 'winter', 'IT314', 2013, 'Tutorial'),
('2013-04-04', 201002005, 'winter', 'IT308', 2013, 'Lecture'),
('2013-04-07', 201002001, 'winter', 'IT342', 2013, 'Lecture'),
('2013-04-10', 201103006, 'winter', 'IT314', 2013, 'Lecture');

-- --------------------------------------------------------

--
-- Table structure for table `course_authority`
--

CREATE TABLE IF NOT EXISTS `course_authority` (
  `UID` int(11) NOT NULL,
  `Year` year(4) NOT NULL,
  `Sem_Type` varchar(15) NOT NULL,
  `Course_Id` varchar(20) NOT NULL,
  PRIMARY KEY (`UID`,`Year`,`Sem_Type`,`Course_Id`),
  KEY `Course_Id` (`Course_Id`),
  KEY `Sem_Type` (`Sem_Type`),
  KEY `Year` (`Year`),
  KEY `UID` (`UID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_authority`
--

INSERT INTO `course_authority` (`UID`, `Year`, `Sem_Type`, `Course_Id`) VALUES
(201002001, 2013, 'winter', 'IT342'),
(201002002, 2013, 'winter', 'IT550'),
(201002003, 2013, 'winter', 'IT518'),
(201002004, 2013, 'winter', 'IT325'),
(201002005, 2013, 'winter', 'IT308'),
(201002006, 2013, 'winter', 'IT314'),
(201103006, 2013, 'winter', 'IT314');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `Uid` int(11) NOT NULL,
  `FB_Room_No` varchar(5) NOT NULL,
  PRIMARY KEY (`Uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`Uid`, `FB_Room_No`) VALUES
(201002001, 'none'),
(201002002, '4209'),
(201002003, '41--'),
(201002004, '----'),
(201002005, '----'),
(201002006, '11--');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `File_Id` int(11) NOT NULL AUTO_INCREMENT,
  `File_Path` varchar(150) NOT NULL,
  `Time` datetime NOT NULL,
  `Uid` int(11) NOT NULL,
  `Course_Id` varchar(20) NOT NULL,
  `Year` year(4) NOT NULL,
  `Sem_Type` varchar(15) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Display_name` varchar(60) NOT NULL,
  PRIMARY KEY (`File_Id`),
  KEY `Uid` (`Uid`),
  KEY `Course_Id` (`Course_Id`),
  KEY `Year` (`Year`,`Sem_Type`),
  KEY `Sem_Type` (`Sem_Type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`File_Id`, `File_Path`, `Time`, `Uid`, `Course_Id`, `Year`, `Sem_Type`, `Name`, `Display_name`) VALUES
(38, 'files/IT314-Software Engineering/winter-2013/IT314 - Software Engineering-full.pdf', '2013-04-06 04:58:47', 201002006, 'IT314', 2013, 'winter', 'IT314 - Software Engineering-full.pdf', 'Lecture'),
(41, 'files/IT308-Operating Systems/winter-2013/Computer_System_Overview.pdf', '2013-04-07 17:16:41', 201002005, 'IT308', 2013, 'winter', 'Computer_System_Overview.pdf', 'Overview'),
(42, 'files/IT342-Web Programming/winter-2013/HTML.pdf', '2013-04-07 22:31:32', 201002001, 'IT342', 2013, 'winter', 'HTML.pdf', 'Tutorial'),
(43, 'files/IT314-Software Engineering/winter-2013/Threads_SMP_and_Microkernels.pdf', '2013-04-08 13:49:59', 201002006, 'IT314', 2013, 'winter', 'Threads_SMP_and_Microkernels.pdf', 'test'),
(44, 'files/IT314-Software Engineering/winter-2013/A2D_Holi_Ticket.pdf', '2013-04-09 17:08:26', 201002006, 'IT314', 2013, 'winter', 'A2D_Holi_Ticket.pdf', 'tet');

--
-- Triggers `file`
--
DROP TRIGGER IF EXISTS `file_noticeboard`;
DELIMITER //
CREATE TRIGGER `file_noticeboard` AFTER INSERT ON `file`
 FOR EACH ROW begin
insert into noticeboard (Course_Id, Type, Id) values (New.Course_Id, 'File', New.File_Path);
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `noticeboard`
--

CREATE TABLE IF NOT EXISTS `noticeboard` (
  `NoticeId` int(11) NOT NULL AUTO_INCREMENT,
  `Course_Id` varchar(15) NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Type` varchar(15) NOT NULL,
  `Id` varchar(50) NOT NULL,
  PRIMARY KEY (`NoticeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `noticeboard`
--

INSERT INTO `noticeboard` (`NoticeId`, `Course_Id`, `TimeStamp`, `Type`, `Id`) VALUES
(1, 'IT342', '2013-04-01 13:27:19', 'File', 'home/Sen'),
(2, 'IT342', '2013-04-01 13:34:27', 'Poll', '1'),
(3, 'IT342', '2013-04-01 13:39:57', 'Topic', '4'),
(4, 'IT342', '2013-04-01 13:43:10', 'Response', '8'),
(5, 'IT342', '2013-04-01 14:05:18', 'Response', '2013-04-02'),
(22, 'IT342', '2013-04-05 10:03:34', 'File', 'files/IT342-Web Programming/winter-2013/HTML.pdf'),
(23, 'IT342', '2013-04-05 10:04:17', 'File', 'files/IT342-Web Programming/winter-2013/IMG_201303'),
(24, 'IT314', '2013-04-05 11:04:50', 'File', 'files/IT314-Software Engineering/winter-2013/getPD'),
(25, 'IT342', '2013-04-05 14:33:07', 'File', 'files/IT342-Web Programming/winter-2013/Lecture ti'),
(26, 'IT342', '2013-04-05 14:37:40', 'File', 'files/IT342-Web Programming/winter-2013/Slot_Winte'),
(27, 'IT342', '2013-04-05 14:39:30', 'File', 'files/IT342-Web Programming/winter-2013/FirstInSem'),
(28, 'IT342', '2013-04-05 14:46:06', 'File', 'files/IT342-Web Programming/winter-2013/jason_svm_'),
(29, 'IT308', '2013-04-05 15:02:59', 'File', 'files/IT308-Operating Systems/winter-2013/Computer'),
(30, 'IT308', '2013-04-05 15:03:28', 'File', 'files/IT308-Operating Systems/winter-2013/Computer'),
(31, 'IT308', '2013-04-05 15:10:52', 'File', 'files/IT308-Operating Systems/winter-2013/Concurre'),
(32, 'IT308', '2013-04-05 15:12:29', 'File', 'files/IT308-Operating Systems/winter-2013/Concurre'),
(33, 'IT308', '2013-04-05 15:14:15', 'File', 'files/IT308-Operating Systems/winter-2013/Introduc'),
(34, 'IT314', '2013-04-05 16:46:07', 'File', 'files/IT314-Software Engineering/winter-2013/IT314'),
(35, 'IT314', '2013-04-05 16:48:34', 'File', 'files/IT314-Software Engineering/winter-2013/IT314'),
(36, 'IT325', '2013-04-05 18:16:35', 'File', 'files/IT325-Introduction to Cryptography/winter-20'),
(37, 'IT325', '2013-04-05 18:17:32', 'File', 'files/IT325-Introduction to Cryptography/winter-20'),
(38, 'IT325', '2013-04-05 18:17:55', 'File', 'files/IT325-Introduction to Cryptography/winter-20'),
(39, 'IT325', '2013-04-05 18:20:16', 'File', 'files/IT325-Introduction to Cryptography/winter-20'),
(40, 'IT342', '2013-04-05 20:17:42', 'File', 'files/IT342-Web Programming/winter-2013/HTML.pdf'),
(41, 'IT342', '2013-04-05 20:18:34', 'File', 'files/IT342-Web Programming/winter-2013/Lecture ti'),
(42, 'IT342', '2013-04-05 23:04:12', 'File', 'files/IT342-Web Programming/winter-2013/Lecture ti'),
(43, 'IT314', '2013-04-05 23:28:47', 'File', 'files/IT314-Software Engineering/winter-2013/IT314'),
(44, 'IT342', '2013-04-06 11:14:52', 'File', 'files/IT342-Web Programming/winter-2013/HTML.pdf'),
(45, 'IT342', '2013-04-06 11:15:13', 'File', 'files/IT342-Web Programming/winter-2013/Lecture ti'),
(46, 'IT308', '2013-04-07 11:46:41', 'File', 'files/IT308-Operating Systems/winter-2013/Computer'),
(47, 'IT342', '2013-04-07 17:01:32', 'File', 'files/IT342-Web Programming/winter-2013/HTML.pdf'),
(48, 'IT314', '2013-04-08 08:19:59', 'File', 'files/IT314-Software Engineering/winter-2013/Threa'),
(49, 'IT314', '2013-04-08 08:20:12', 'File', 'files/IT314-Software Engineering/winter-2013/Memor'),
(50, 'IT314', '2013-04-09 07:17:54', 'Poll', '2'),
(51, 'IT314', '2013-04-09 07:37:58', 'Poll', '3'),
(52, 'IT314', '2013-04-09 11:38:26', 'File', 'files/IT314-Software Engineering/winter-2013/A2D_H'),
(53, 'IT314', '2013-04-10 07:36:28', 'Topic', '5'),
(54, 'IT314', '2013-04-10 07:36:57', 'Response', '9'),
(55, 'IT314', '2013-04-10 07:42:32', 'Response', '10'),
(56, 'IT314', '2013-04-10 07:42:57', 'Response', '11'),
(57, 'IT314', '2013-04-10 07:53:37', 'Response', '14');

-- --------------------------------------------------------

--
-- Table structure for table `permtimetable`
--

CREATE TABLE IF NOT EXISTS `permtimetable` (
  `Course_Id` varchar(15) NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL,
  `Day` varchar(15) NOT NULL,
  `Type` varchar(15) NOT NULL,
  PRIMARY KEY (`Course_Id`,`Day`,`Type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permtimetable`
--

INSERT INTO `permtimetable` (`Course_Id`, `StartTime`, `EndTime`, `Day`, `Type`) VALUES
('IT308', '09:30:00', '10:25:00', 'Monday', 'Lecture'),
('IT308', '09:30:00', '10:25:00', 'Thursday', 'Lecture'),
('IT308', '09:30:00', '10:25:00', 'Tuesday', 'Lecture'),
('IT314', '12:00:00', '12:55:00', 'Friday', 'Lecture'),
('IT314', '08:30:00', '09:25:00', 'Monday', 'Lecture'),
('IT314', '08:30:00', '09:25:00', 'Thursday', 'Lecture'),
('IT325', '09:30:00', '10:25:00', 'Friday', 'Lecture'),
('IT325', '11:00:00', '11:55:00', 'Tuesday', 'Lecture'),
('IT325', '09:30:00', '10:25:00', 'Wednesday', 'Lecture'),
('IT342', '08:30:00', '09:25:00', 'Friday', 'Lecture'),
('IT342', '08:30:00', '09:25:00', 'Tuesday', 'Lecture'),
('IT342', '08:30:00', '09:25:00', 'Wednesday', 'Lecture'),
('IT518', '12:00:00', '12:55:00', 'Monday', 'Lecture'),
('IT518', '12:00:00', '12:55:00', 'Thursday', 'Lecture'),
('IT518', '12:00:00', '12:55:00', 'Wednesday', 'Lecture'),
('IT550', '11:00:00', '11:55:00', 'Friday', 'Lecture'),
('IT550', '11:00:00', '11:55:00', 'Monday', 'Lecture'),
('IT550', '11:00:00', '11:55:00', 'Wednesday', 'Lecture');

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE IF NOT EXISTS `poll` (
  `Poll_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Uid` int(11) NOT NULL,
  `Course_Id` varchar(20) NOT NULL,
  `Year` year(4) NOT NULL,
  `Sem_Type` varchar(15) NOT NULL,
  `Questions` varchar(100) NOT NULL,
  `Is_Active` int(11) NOT NULL,
  PRIMARY KEY (`Poll_Id`),
  KEY `Uid` (`Uid`,`Course_Id`,`Year`,`Sem_Type`),
  KEY `Course_Id` (`Course_Id`),
  KEY `Year` (`Year`),
  KEY `Sem_Type` (`Sem_Type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `poll`
--

INSERT INTO `poll` (`Poll_Id`, `Uid`, `Course_Id`, `Year`, `Sem_Type`, `Questions`, `Is_Active`) VALUES
(1, 201002002, 'IT342', 2013, 'winter', 'How is this Course', 1),
(2, 201002006, 'IT314', 2013, 'Winter', 'Which is the toughest Phase in SEN Process according to you?', 1),
(3, 201002006, 'IT314', 2013, 'Winter', 'How was first In-sem Question Paper?', 1);

--
-- Triggers `poll`
--
DROP TRIGGER IF EXISTS `poll_noticeboard`;
DELIMITER //
CREATE TRIGGER `poll_noticeboard` AFTER INSERT ON `poll`
 FOR EACH ROW begin
insert into noticeboard (Course_Id, Type, Id) values (New.Course_Id, 'Poll', New.Poll_Id);
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `registered_in`
--

CREATE TABLE IF NOT EXISTS `registered_in` (
  `Uid` int(11) NOT NULL,
  `Course_Id` varchar(20) NOT NULL,
  `Year` year(4) NOT NULL,
  `Sem_Type` varchar(15) NOT NULL,
  PRIMARY KEY (`Uid`,`Course_Id`,`Year`,`Sem_Type`),
  KEY `Course_Id` (`Course_Id`),
  KEY `Year` (`Year`),
  KEY `Sem_Type` (`Sem_Type`),
  KEY `Uid` (`Uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registered_in`
--

INSERT INTO `registered_in` (`Uid`, `Course_Id`, `Year`, `Sem_Type`) VALUES
(201001011, 'IT314', 2013, 'Winter'),
(201001036, 'IT314', 2013, 'winter'),
(201001036, 'IT325', 2013, 'winter'),
(201001036, 'IT342', 2013, 'winter'),
(201001045, 'IT314', 2013, 'winter'),
(201001045, 'IT342', 2013, 'winter'),
(201001049, 'IT308', 2013, 'winter'),
(201001049, 'IT314', 2013, 'winter'),
(201001049, 'IT325', 2013, 'winter'),
(201001049, 'IT342', 2013, 'winter'),
(201001049, 'IT518', 2013, 'winter'),
(201001049, 'IT550', 2013, 'winter'),
(201103006, 'IT550', 2013, 'winter');

--
-- Triggers `registered_in`
--
DROP TRIGGER IF EXISTS `rep_authority_reg`;
DELIMITER //
CREATE TRIGGER `rep_authority_reg` AFTER INSERT ON `registered_in`
 FOR EACH ROW BEGIN 
INSERT INTO reply_authority (Uid,Sem_Type,Year,Course_Id) values (NEW.Uid,NEW.Sem_Type,NEW.Year,NEW.Course_Id); 
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `reply_authority`
--

CREATE TABLE IF NOT EXISTS `reply_authority` (
  `Uid` int(11) NOT NULL,
  `Year` year(4) NOT NULL,
  `Sem_Type` varchar(15) NOT NULL,
  `Course_Id` varchar(20) NOT NULL,
  PRIMARY KEY (`Uid`,`Year`,`Sem_Type`,`Course_Id`),
  KEY `Year` (`Year`),
  KEY `Sem_Type` (`Sem_Type`),
  KEY `Course_Id` (`Course_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reply_authority`
--

INSERT INTO `reply_authority` (`Uid`, `Year`, `Sem_Type`, `Course_Id`) VALUES
(201002002, 2012, 'winter', 'IT342'),
(201001011, 2013, 'Winter', 'IT314'),
(201001036, 2013, 'winter', 'IT325'),
(201001036, 2013, 'winter', 'IT342'),
(201001045, 2013, 'winter', 'IT314'),
(201001049, 2013, 'winter', 'IT342'),
(201002001, 2013, 'winter', 'IT342'),
(201002006, 2013, 'winter', 'IT314'),
(201103006, 2013, 'winter', 'IT550');

-- --------------------------------------------------------

--
-- Table structure for table `responds`
--

CREATE TABLE IF NOT EXISTS `responds` (
  `UID` int(11) NOT NULL,
  `Course_Id` varchar(20) NOT NULL,
  `Sem_Type` varchar(15) NOT NULL,
  `year` year(4) NOT NULL,
  `Poll_Id` int(11) NOT NULL,
  PRIMARY KEY (`UID`,`Course_Id`,`Sem_Type`,`year`,`Poll_Id`),
  KEY `Course_Id` (`Course_Id`),
  KEY `Sem_Type` (`Sem_Type`),
  KEY `year` (`year`),
  KEY `Poll_Id` (`Poll_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `responds`
--

INSERT INTO `responds` (`UID`, `Course_Id`, `Sem_Type`, `year`, `Poll_Id`) VALUES
(201001036, 'IT314', 'Winter', 2013, 2),
(201001036, 'IT314', 'Winter', 2013, 3),
(201001049, 'IT314', 'Winter', 2013, 2),
(201001049, 'IT314', 'Winter', 2013, 3);

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE IF NOT EXISTS `responses` (
  `Resp_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Resp_Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Resp_Content` varchar(100) NOT NULL,
  `Uid` int(11) NOT NULL,
  `Sem_Type` varchar(15) NOT NULL,
  `year` year(4) NOT NULL,
  `Course_Id` varchar(20) NOT NULL,
  `Topic_Id` int(11) NOT NULL,
  PRIMARY KEY (`Resp_Id`),
  KEY `Uid` (`Uid`),
  KEY `year` (`year`),
  KEY `Sem_Type` (`Sem_Type`),
  KEY `Course_Id` (`Course_Id`),
  KEY `Topic_Id` (`Topic_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `responses`
--

INSERT INTO `responses` (`Resp_Id`, `Resp_Date`, `Resp_Content`, `Uid`, `Sem_Type`, `year`, `Course_Id`, `Topic_Id`) VALUES
(4, '2013-04-01 11:48:51', 'I am fine', 201001036, 'winter', 2013, 'IT342', 3),
(5, '2013-04-01 11:50:11', 'I am good', 201001036, 'winter', 2013, 'IT342', 3),
(7, '2013-04-01 11:51:32', 'I am good', 201002002, 'winter', 2013, 'IT342', 3),
(8, '2013-04-01 13:43:10', 'i am in gandhinagar', 201002002, 'winter', 2013, 'IT342', 4),
(9, '2013-04-10 07:36:57', 'Sombody Answer....', 201001049, 'winter', 2013, 'IT314', 5),
(10, '2013-04-10 07:42:32', 'Which traceability are you talking abt??', 201001036, 'winter', 2013, 'IT314', 5),
(14, '2013-04-10 07:53:37', 'Meet me in my cabin', 201002006, 'winter', 2013, 'IT314', 5);

--
-- Triggers `responses`
--
DROP TRIGGER IF EXISTS `response_noticeboard`;
DELIMITER //
CREATE TRIGGER `response_noticeboard` AFTER INSERT ON `responses`
 FOR EACH ROW begin
insert into noticeboard (Course_Id, Type, Id) values (New.Course_Id, 'Response', New.Resp_Id);
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `Uid` int(11) NOT NULL,
  `Parent_Contact_No` varchar(14) NOT NULL,
  `Batch` int(11) NOT NULL,
  `Program_Id` varchar(6) NOT NULL,
  `Is_Ta` int(11) NOT NULL,
  PRIMARY KEY (`Uid`),
  KEY `Program_Id` (`Program_Id`),
  KEY `Program_Id_2` (`Program_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Uid`, `Parent_Contact_No`, `Batch`, `Program_Id`, `Is_Ta`) VALUES
(201001011, '0000000000', 2010, 'B-Tech', 0),
(201001036, '8888888881', 2010, 'B-Tech', 0),
(201001045, '8888888882', 2010, 'B-Tech', 0),
(201001049, '8888888881', 2010, 'B-Tech', 0),
(201001100, '8569863548', 2010, 'B-Tech', 0),
(201103006, '0000000000', 2011, 'M-Tech', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ta_of`
--

CREATE TABLE IF NOT EXISTS `ta_of` (
  `Course_Id` varchar(6) NOT NULL,
  `Uid` int(11) NOT NULL,
  `Year` year(4) NOT NULL,
  `Sem_Type` varchar(6) NOT NULL,
  PRIMARY KEY (`Course_Id`,`Uid`,`Year`,`Sem_Type`),
  KEY `Uid` (`Uid`),
  KEY `Year` (`Year`),
  KEY `Sem_Type` (`Sem_Type`),
  KEY `Course_Id` (`Course_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ta_of`
--

INSERT INTO `ta_of` (`Course_Id`, `Uid`, `Year`, `Sem_Type`) VALUES
('IT314', 201103006, 2013, 'winter');

--
-- Triggers `ta_of`
--
DROP TRIGGER IF EXISTS `ta_of_trigger`;
DELIMITER //
CREATE TRIGGER `ta_of_trigger` AFTER INSERT ON `ta_of`
 FOR EACH ROW BEGIN 
INSERT INTO Course_authority (Uid,Sem_Type,Year,Course_Id) values (NEW.Uid,NEW.Sem_Type,NEW.Year,NEW.Course_Id); 
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `teaches`
--

CREATE TABLE IF NOT EXISTS `teaches` (
  `Uid` int(11) NOT NULL,
  `Course_Id` varchar(20) NOT NULL,
  `Year` year(4) NOT NULL,
  `Sem_Type` varchar(15) NOT NULL,
  `Course_Description` varchar(1000) NOT NULL,
  PRIMARY KEY (`Uid`,`Course_Id`,`Year`,`Sem_Type`),
  KEY `Uid` (`Uid`,`Course_Id`,`Year`,`Sem_Type`),
  KEY `Course_Id` (`Course_Id`),
  KEY `Year` (`Year`),
  KEY `Sem_Type` (`Sem_Type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teaches`
--

INSERT INTO `teaches` (`Uid`, `Course_Id`, `Year`, `Sem_Type`, `Course_Description`) VALUES
(201002001, 'IT342', 2013, 'winter', 'This course will expose students to the techniques used in programming web pages for interactive content. In particular, the course builds on the power of AJAX (Asynchronous Javascript and XML) to design web pages that dynamically interact with databases that reside on a server. The course begins by reviewing basic web technologies (HTML, CSS stylesheets) and exploring the use of event-driven programming in Javascript to add interactive elements such as buttons and text fields to web pages. Next, students will use AJAX tools to build web pages that connect to servers like Google to dynamically access data (maps, search results, videos, images, etc). Finally, the course will show students how to write their own server-side code to provide access to a custom database. The course ends with a two-week group project.'),
(201002002, 'IT342', 2012, 'winter', 'This course will expose students to the techniques used in programming web pages for interactive content. In particular, the course builds on the power of AJAX (Asynchronous Javascript and XML) to design web pages that dynamically interact with databases that reside on a server. The course begins by reviewing basic web technologies (HTML, CSS stylesheets) and exploring the use of event-driven programming in Javascript to add interactive elements such as buttons and text fields to web pages. Next, students will use AJAX tools to build web pages that connect to servers like Google to dynamically access data (maps, search results, videos, images, etc). Finally, the course will show students how to write their own server-side code to provide access to a custom database. The course ends with a two-week group project.'),
(201002002, 'IT550', 2013, 'winter', 'This course studies the theory, design, and implementation of text-based information systems. The Information Retrieval core components of the course include statistical characteristics of text, representation of information needs and documents, several important retrieval models (Boolean, vector space, probabilistic, inference net, language modeling, link analysis), clustering algorithms, collaborative filtering, automatic text categorization, and experimental evaluation. The software architecture components include design and implementation of high-capacity text retrieval and text filtering systems. '),
(201002003, 'IT518', 2013, 'winter', 'The course aims to equip students with the theory and usage of artificial neural network, fuzzy systems and Neuro fuzzy systems. Its main aim is to discuss information processing in Neuro fuzzy environment. As an application study it will discuss application in classification based problems and autonomous robot navigation. The course will be self contained and will cover the necessary foundational prerequisites.'),
(201002004, 'IT325', 2013, 'winter', 'Cryptography is concerned with the mathematical, algorithmic, and implementation aspects of information and network security. It is one of the core technologies for securing applications ranging from "border security" to "consumer electronics". After completion of this course, students will display a breadth of knowledge in applied cryptography and be able to build secure systems for real-world problems.'),
(201002005, 'IT308', 2013, 'winter', 'The course aims to introduce the fundamental concepts of operating system. The course relates these fundamentals with the design issues related to the development of modern operating systems. Understanding of concepts will be visualized and realized using simulation. Topics include Process Scheduling, Concurrency, Memory Management, Virtual Memory, I/O Management and Disk Scheduling, Security, Distributed Systems, Virtualization, and Operating Systems for Mobile Devices'),
(201002006, 'IT314', 2013, 'winter', 'To understand the philosophy & justification for software engineering approach to software development. To provide knowledge in software process improvement in general, and into the personal software development process in particular. Appreciate that software development is an engineering discipline and is highly process focused.');

--
-- Triggers `teaches`
--
DROP TRIGGER IF EXISTS `teaches_trigger`;
DELIMITER //
CREATE TRIGGER `teaches_trigger` AFTER INSERT ON `teaches`
 FOR EACH ROW BEGIN 
INSERT INTO course_authority (Uid,Sem_Type,Year,Course_Id) values (NEW.Uid,NEW.Sem_Type,NEW.Year,NEW.Course_Id); 
INSERT INTO reply_authority (Uid,Sem_Type,Year,Course_Id) values (NEW.Uid,NEW.Sem_Type,NEW.Year,NEW.Course_Id); 

END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `temptimetable`
--

CREATE TABLE IF NOT EXISTS `temptimetable` (
  `Course_Id` varchar(15) NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL,
  `Date` date NOT NULL,
  `Type` varchar(15) NOT NULL,
  `Flag` int(5) NOT NULL,
  PRIMARY KEY (`Course_Id`,`Date`,`Type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `temptimetable`
--
DROP TRIGGER IF EXISTS `timetable_noticeboard`;
DELIMITER //
CREATE TRIGGER `timetable_noticeboard` AFTER INSERT ON `temptimetable`
 FOR EACH ROW begin
insert into noticeboard (Course_Id, Type, Id) values (New.Course_Id, 'Response', New.Date);
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE IF NOT EXISTS `topic` (
  `Topic_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Topic_Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Topic_Subject` varchar(50) NOT NULL,
  `Uid` int(11) NOT NULL,
  `Course_Id` varchar(20) NOT NULL,
  `Sem_Type` varchar(15) NOT NULL,
  `Year` year(4) NOT NULL,
  PRIMARY KEY (`Topic_Id`),
  KEY `Uid` (`Uid`),
  KEY `course_id` (`Course_Id`),
  KEY `sem_type` (`Sem_Type`),
  KEY `year` (`Year`),
  KEY `Topic_Date` (`Topic_Date`),
  KEY `Topic_Date_2` (`Topic_Date`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`Topic_Id`, `Topic_Date`, `Topic_Subject`, `Uid`, `Course_Id`, `Sem_Type`, `Year`) VALUES
(3, '2013-04-01 11:48:17', 'How are u ?', 201001036, 'IT342', 'winter', 2013),
(4, '2013-04-01 13:39:57', 'where are you', 201001036, 'IT342', 'winter', 2013),
(5, '2013-04-10 07:36:28', 'What is traceability Matrix?', 201001049, 'IT314', 'winter', 2013);

--
-- Triggers `topic`
--
DROP TRIGGER IF EXISTS `topic_noticeboard`;
DELIMITER //
CREATE TRIGGER `topic_noticeboard` AFTER INSERT ON `topic`
 FOR EACH ROW begin
insert into noticeboard (Course_Id, Type, Id) values (New.Course_Id, 'Topic', New.Topic_Id);
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `Uid` int(11) NOT NULL AUTO_INCREMENT,
  `U_Name` varchar(25) NOT NULL,
  `Email_Id` varchar(25) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Contact_No` varchar(14) DEFAULT NULL,
  `Gender` varchar(6) NOT NULL,
  `Last_Access` datetime DEFAULT NULL,
  `DOB` date NOT NULL,
  `Role` int(11) NOT NULL,
  PRIMARY KEY (`Uid`),
  UNIQUE KEY `Email_Id` (`Email_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=201103007 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Uid`, `U_Name`, `Email_Id`, `Password`, `Contact_No`, `Gender`, `Last_Access`, `DOB`, `Role`) VALUES
(200000000, 'Admin', 'admin@daiict.ac.in', '1a1dc91c907325c69271ddf0c944bc72', '8000000001', 'M', NULL, '2011-11-07', 3),
(201001011, 'Nalin Patidar', 'nalin3491@gmail.com', '1a1dc91c907325c69271ddf0c944bc72', '8866569767', 'M', '0000-00-00 00:00:00', '1991-04-03', 1),
(201001036, 'Ayush Jain', 'ayushjain30393@gmail.com', '1a1dc91c907325c69271ddf0c944bc72', '9737913311', 'M', NULL, '1993-03-30', 1),
(201001045, 'Jayesh Hathila', 'sharma.jayesh52@gmail.com', '1a1dc91c907325c69271ddf0c944bc72', '8460163287', 'M', NULL, '1991-11-23', 1),
(201001049, 'Vipul Garg', 'vipul261@gmail.com', '1a1dc91c907325c69271ddf0c944bc72', '7878779783', 'M', NULL, '1991-01-26', 1),
(201001100, 'Ishan Jain', '201001100@daiict.ac.in', '1a1dc91c907325c69271ddf0c944bc72', '7878779803', 'M', '2013-03-30 00:00:00', '1990-02-10', 1),
(201002001, 'M.T. Savaliya', 'mt@daiict.ac.in', '1a1dc91c907325c69271ddf0c944bc72', '', 'M', NULL, '1960-01-01', 2),
(201002002, 'Prasanjeet Majumdar', 'pm@daiict.ac.in', '1a1dc91c907325c69271ddf0c944bc72', '', 'M', NULL, '1972-01-01', 2),
(201002003, 'Mehul Raval', 'mr@daiict.ac.in', '1a1dc91c907325c69271ddf0c944bc72', '', 'M', NULL, '1970-01-01', 2),
(201002004, 'Manik Lal Das', 'mld@daiict.ac.in', '1a1dc91c907325c69271ddf0c944bc72', '', 'M', NULL, '1975-01-01', 2),
(201002005, 'Sanjay Choudhry', 'sc@daiict.ac.in', '1a1dc91c907325c69271ddf0c944bc72', '', 'M', NULL, '1960-01-01', 2),
(201002006, 'Asim Benarjee', 'ab@daiict.ac.in', '1a1dc91c907325c69271ddf0c944bc72', '', 'M', NULL, '1965-01-01', 2),
(201012056, 'Abhi', '201002056@daiict.ac.in', '1a1dc91c907325c69271ddf0c944bc72', '8547896524', 'M', NULL, '2013-03-10', 1),
(201103006, 'Bhupendra Rajput', 'bhupi1598@gmail.com', '1a1dc91c907325c69271ddf0c944bc72', '7567158146', 'M', '0000-00-00 00:00:00', '1988-01-01', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`Uid`) REFERENCES `users` (`Uid`);

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`Poll_Id`) REFERENCES `poll` (`Poll_Id`);

--
-- Constraints for table `attends`
--
ALTER TABLE `attends`
  ADD CONSTRAINT `attends_ibfk_10` FOREIGN KEY (`Course_Id`) REFERENCES `course_activity` (`Course_Id`),
  ADD CONSTRAINT `attends_ibfk_11` FOREIGN KEY (`Year`) REFERENCES `course_activity` (`year`),
  ADD CONSTRAINT `attends_ibfk_12` FOREIGN KEY (`Sem_Type`) REFERENCES `course_activity` (`Sem_Type`),
  ADD CONSTRAINT `attends_ibfk_13` FOREIGN KEY (`Uid`) REFERENCES `course_activity` (`Uid`),
  ADD CONSTRAINT `attends_ibfk_14` FOREIGN KEY (`Date`) REFERENCES `course_activity` (`Date`),
  ADD CONSTRAINT `attends_ibfk_15` FOREIGN KEY (`Type`) REFERENCES `course_activity` (`Type`),
  ADD CONSTRAINT `attends_ibfk_9` FOREIGN KEY (`StudentId`) REFERENCES `registered_in` (`Uid`);

--
-- Constraints for table `course_activity`
--
ALTER TABLE `course_activity`
  ADD CONSTRAINT `course_activity_ibfk_1` FOREIGN KEY (`Uid`) REFERENCES `course_authority` (`UID`),
  ADD CONSTRAINT `course_activity_ibfk_2` FOREIGN KEY (`Sem_Type`) REFERENCES `course_authority` (`Sem_Type`),
  ADD CONSTRAINT `course_activity_ibfk_3` FOREIGN KEY (`year`) REFERENCES `course_authority` (`Year`),
  ADD CONSTRAINT `course_activity_ibfk_4` FOREIGN KEY (`Course_Id`) REFERENCES `course_authority` (`Course_Id`);

--
-- Constraints for table `faculty`
--
ALTER TABLE `faculty`
  ADD CONSTRAINT `faculty_ibfk_1` FOREIGN KEY (`Uid`) REFERENCES `users` (`Uid`);

--
-- Constraints for table `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `file_ibfk_1` FOREIGN KEY (`Uid`) REFERENCES `teaches` (`Uid`),
  ADD CONSTRAINT `file_ibfk_2` FOREIGN KEY (`Course_Id`) REFERENCES `teaches` (`Course_Id`),
  ADD CONSTRAINT `file_ibfk_3` FOREIGN KEY (`Year`) REFERENCES `teaches` (`Year`),
  ADD CONSTRAINT `file_ibfk_4` FOREIGN KEY (`Sem_Type`) REFERENCES `teaches` (`Sem_Type`);

--
-- Constraints for table `poll`
--
ALTER TABLE `poll`
  ADD CONSTRAINT `poll_ibfk_1` FOREIGN KEY (`Uid`) REFERENCES `teaches` (`Uid`),
  ADD CONSTRAINT `poll_ibfk_2` FOREIGN KEY (`Course_Id`) REFERENCES `teaches` (`Course_Id`),
  ADD CONSTRAINT `poll_ibfk_3` FOREIGN KEY (`Year`) REFERENCES `teaches` (`Year`),
  ADD CONSTRAINT `poll_ibfk_4` FOREIGN KEY (`Sem_Type`) REFERENCES `teaches` (`Sem_Type`);

--
-- Constraints for table `registered_in`
--
ALTER TABLE `registered_in`
  ADD CONSTRAINT `registered_in_ibfk_1` FOREIGN KEY (`Uid`) REFERENCES `student` (`Uid`),
  ADD CONSTRAINT `registered_in_ibfk_2` FOREIGN KEY (`Course_Id`) REFERENCES `course` (`Course_Id`);

--
-- Constraints for table `responds`
--
ALTER TABLE `responds`
  ADD CONSTRAINT `responds_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `registered_in` (`Uid`),
  ADD CONSTRAINT `responds_ibfk_2` FOREIGN KEY (`Course_Id`) REFERENCES `registered_in` (`Course_Id`),
  ADD CONSTRAINT `responds_ibfk_3` FOREIGN KEY (`Sem_Type`) REFERENCES `registered_in` (`Sem_Type`),
  ADD CONSTRAINT `responds_ibfk_4` FOREIGN KEY (`year`) REFERENCES `registered_in` (`Year`),
  ADD CONSTRAINT `responds_ibfk_5` FOREIGN KEY (`Poll_Id`) REFERENCES `poll` (`Poll_Id`);

--
-- Constraints for table `responses`
--
ALTER TABLE `responses`
  ADD CONSTRAINT `responses_ibfk_1` FOREIGN KEY (`Uid`) REFERENCES `reply_authority` (`Uid`),
  ADD CONSTRAINT `responses_ibfk_2` FOREIGN KEY (`Sem_Type`) REFERENCES `registered_in` (`Sem_Type`),
  ADD CONSTRAINT `responses_ibfk_3` FOREIGN KEY (`year`) REFERENCES `reply_authority` (`Year`),
  ADD CONSTRAINT `responses_ibfk_4` FOREIGN KEY (`Course_Id`) REFERENCES `reply_authority` (`Course_Id`),
  ADD CONSTRAINT `responses_ibfk_5` FOREIGN KEY (`Topic_Id`) REFERENCES `topic` (`Topic_Id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`Uid`) REFERENCES `users` (`Uid`);

--
-- Constraints for table `ta_of`
--
ALTER TABLE `ta_of`
  ADD CONSTRAINT `ta_of_ibfk_1` FOREIGN KEY (`Course_Id`) REFERENCES `course` (`Course_Id`),
  ADD CONSTRAINT `ta_of_ibfk_2` FOREIGN KEY (`Uid`) REFERENCES `student` (`Uid`);

--
-- Constraints for table `teaches`
--
ALTER TABLE `teaches`
  ADD CONSTRAINT `teaches_ibfk_1` FOREIGN KEY (`Uid`) REFERENCES `faculty` (`Uid`),
  ADD CONSTRAINT `teaches_ibfk_2` FOREIGN KEY (`Course_Id`) REFERENCES `course` (`Course_Id`);

--
-- Constraints for table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`Uid`) REFERENCES `registered_in` (`Uid`),
  ADD CONSTRAINT `topic_ibfk_2` FOREIGN KEY (`Course_Id`) REFERENCES `registered_in` (`Course_Id`),
  ADD CONSTRAINT `topic_ibfk_3` FOREIGN KEY (`Sem_Type`) REFERENCES `registered_in` (`Sem_Type`),
  ADD CONSTRAINT `topic_ibfk_4` FOREIGN KEY (`Year`) REFERENCES `registered_in` (`Year`),
  ADD CONSTRAINT `topic_ibfk_5` FOREIGN KEY (`Course_Id`) REFERENCES `registered_in` (`Course_Id`),
  ADD CONSTRAINT `topic_ibfk_6` FOREIGN KEY (`Sem_Type`) REFERENCES `registered_in` (`Sem_Type`),
  ADD CONSTRAINT `topic_ibfk_7` FOREIGN KEY (`Year`) REFERENCES `registered_in` (`Year`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`1165188_ic`@`fdb3.awardspace.com` EVENT `temptimetable` ON SCHEDULE EVERY 24 HOUR STARTS '2013-04-04 21:25:14' ON COMPLETION NOT PRESERVE ENABLE DO delete from temptimetable where Date < CURDATE()$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
