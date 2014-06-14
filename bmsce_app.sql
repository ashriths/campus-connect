-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2014 at 04:39 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bmsce_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `subjectId` int(5) NOT NULL,
  `userId` int(5) NOT NULL,
  `classesAttended` int(2) NOT NULL,
  PRIMARY KEY (`subjectId`,`userId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`subjectId`, `userId`, `classesAttended`) VALUES
(13, 3, 30),
(13, 4, 23),
(15, 4, 19),
(16, 3, 30),
(17, 3, 40);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `classId` int(5) NOT NULL AUTO_INCREMENT,
  `sem` int(2) NOT NULL,
  `deptId` int(5) NOT NULL,
  `section` varchar(1) NOT NULL,
  PRIMARY KEY (`classId`),
  UNIQUE KEY `unq` (`sem`,`section`),
  UNIQUE KEY `sem` (`sem`,`deptId`,`section`),
  KEY `deptId` (`deptId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=86 ;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`classId`, `sem`, `deptId`, `section`) VALUES
(68, 1, 1, 'A'),
(75, 1, 1, 'B'),
(85, 3, 1, 'A'),
(59, 3, 1, 'B'),
(7, 5, 1, 'A'),
(1, 6, 1, 'A'),
(2, 6, 1, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `classnotification`
--

CREATE TABLE IF NOT EXISTS `classnotification` (
  `classId` int(5) NOT NULL,
  `calssNoId` int(5) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` varchar(15) NOT NULL,
  `message` varchar(200) NOT NULL,
  PRIMARY KEY (`calssNoId`,`classId`),
  KEY `userId` (`calssNoId`,`type`),
  KEY `type` (`type`),
  KEY `classId` (`classId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `classnotification`
--

INSERT INTO `classnotification` (`classId`, `calssNoId`, `timestamp`, `type`, `message`) VALUES
(1, 1, '2014-05-19 15:52:14', 'none', 'todays class is cancelled '),
(1, 2, '2014-05-19 15:53:02', 'fromTeacher', 'extra class CN friday 12/6/14 1pm rm.5001');

-- --------------------------------------------------------

--
-- Table structure for table `collegeevents`
--

CREATE TABLE IF NOT EXISTS `collegeevents` (
  `eventName` varchar(50) NOT NULL,
  `message` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `venue` varchar(50) NOT NULL,
  `timestampValue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `collegenotification`
--

CREATE TABLE IF NOT EXISTS `collegenotification` (
  `collegeNoId` int(5) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(15) NOT NULL,
  `message` varchar(200) NOT NULL,
  PRIMARY KEY (`collegeNoId`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `collegenotification`
--

INSERT INTO `collegenotification` (`collegeNoId`, `timestamp`, `type`, `message`) VALUES
(1, '2014-05-19 16:29:54', 'fromAdmin', 'hellooo'),
(2, '2014-05-19 16:29:54', 'fromClassmates', 'hi classmate sennt u notification'),
(3, '2014-05-19 16:30:25', 'fromProctor', 'this is from proctor too college'),
(4, '2014-05-19 16:30:25', 'fromTeacher', 'hi i want to resign...');

-- --------------------------------------------------------

--
-- Table structure for table `dept`
--

CREATE TABLE IF NOT EXISTS `dept` (
  `deptId` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  UNIQUE KEY `deptId` (`deptId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `dept`
--

INSERT INTO `dept` (`deptId`, `name`) VALUES
(1, 'CSE'),
(2, ''),
(3, ''),
(9, ''),
(10, '');

-- --------------------------------------------------------

--
-- Table structure for table `deptevents`
--

CREATE TABLE IF NOT EXISTS `deptevents` (
  `eventName` varchar(50) NOT NULL,
  `message` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `venue` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `deptnotification`
--

CREATE TABLE IF NOT EXISTS `deptnotification` (
  `deptId` int(5) NOT NULL,
  `deptNoId` int(5) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` varchar(15) NOT NULL,
  `message` varchar(200) NOT NULL,
  PRIMARY KEY (`deptNoId`,`deptId`),
  KEY `type` (`type`),
  KEY `type_2` (`type`),
  KEY `deptId` (`deptId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `deptnotification`
--

INSERT INTO `deptnotification` (`deptId`, `deptNoId`, `timestamp`, `type`, `message`) VALUES
(1, 1, '2014-05-19 15:55:13', 'fromProctor', 'Student !bm11cs000 of your dept id a thief'),
(1, 2, '2014-05-19 15:55:13', 'fromAdmin', '1bm11cs000 registration complete on portal'),
(1, 3, '2014-05-19 16:36:52', 'none', 'another notification\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `examtype`
--

CREATE TABLE IF NOT EXISTS `examtype` (
  `examtypeId` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `maxMarks` int(3) NOT NULL,
  PRIMARY KEY (`examtypeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `examtype`
--

INSERT INTO `examtype` (`examtypeId`, `name`, `maxMarks`) VALUES
(1, 'test1', 20),
(2, 'test2', 20),
(3, 'test3', 20),
(4, 'quiz1', 5),
(5, 'quiz2', 5),
(6, 'lab1', 10),
(7, 'lab2', 15);

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE IF NOT EXISTS `marks` (
  `userId` int(5) NOT NULL,
  `subjectId` int(5) NOT NULL,
  `score` int(3) NOT NULL,
  `examtypeId` int(2) NOT NULL,
  PRIMARY KEY (`userId`,`subjectId`,`examtypeId`),
  KEY `userId` (`userId`,`subjectId`),
  KEY `subjectId` (`subjectId`),
  KEY `subjectId_2` (`subjectId`),
  KEY `score` (`score`),
  KEY `examTypeId` (`examtypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`userId`, `subjectId`, `score`, `examtypeId`) VALUES
(4, 15, 5, 1),
(4, 15, 5, 2),
(4, 17, 10, 3),
(4, 13, 13, 3);

-- --------------------------------------------------------

--
-- Table structure for table `notificationtype`
--

CREATE TABLE IF NOT EXISTS `notificationtype` (
  `type` varchar(15) NOT NULL,
  PRIMARY KEY (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notificationtype`
--

INSERT INTO `notificationtype` (`type`) VALUES
('fromAdmin'),
('fromClassmates'),
('fromProctor'),
('fromTeacher'),
('none');

-- --------------------------------------------------------

--
-- Table structure for table `oldgrades`
--

CREATE TABLE IF NOT EXISTS `oldgrades` (
  `userId` int(5) NOT NULL,
  `subjectId` int(5) NOT NULL,
  `sem` int(2) NOT NULL,
  `grade` varchar(1) NOT NULL,
  PRIMARY KEY (`userId`,`subjectId`),
  KEY `userId` (`userId`,`subjectId`),
  KEY `subjectId` (`subjectId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oldgrades`
--

INSERT INTO `oldgrades` (`userId`, `subjectId`, `sem`, `grade`) VALUES
(3, 13, 6, 'A'),
(3, 14, 5, 'B'),
(3, 15, 6, 'A'),
(3, 16, 6, 'A'),
(3, 17, 6, 'A'),
(4, 16, 5, 'A'),
(5, 16, 6, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `userId` int(5) NOT NULL AUTO_INCREMENT,
  `usn` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `classId` int(5) NOT NULL,
  `proctorId` int(5) NOT NULL,
  `cgpa` varchar(5) NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `usn` (`usn`),
  KEY `name` (`name`),
  KEY `proctorId` (`proctorId`),
  KEY `classId` (`classId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`userId`, `usn`, `name`, `password`, `email`, `classId`, `proctorId`, `cgpa`) VALUES
(3, '1BM11CS018', 'ashish rawat', '428b6da53085b8fd7b37e9fb259c0c609bd09984', 'ashish@yahoo.com', 1, 33, ''),
(4, '1BM11CS019', 'ashrith s', '8cb2237d0679ca88db6464eac60da96345513964', 'ashrith@yahoo.com', 1, 22, '9.20'),
(5, '1BM11CS012', 'alta soni', '475b5952739c62bfcd2ba9592a04848e68ad2f87', 'alta@yahoo.co.in', 1, 23, ''),
(6, '1BM11CS016', 'anuj raghuram', 'fa446f551bf5f1cf7a1f58d532fcbf89a120a3d1', 'anuj@yahoo.com', 1, 12, ''),
(7, '1BM11CS001', 'kavya reddy', '47de38fbdece0d484472919c37c107cfadb2ad00', 'kavya@yahoo.com', 1, 67, ''),
(8, '1BM11CS002', 'nagambika', 'eea5dca9d5171e8a512df767a5eae70faf5f6e24', 'nag@yahoo.com', 1, 12, '');

-- --------------------------------------------------------

--
-- Table structure for table `studentsem`
--

CREATE TABLE IF NOT EXISTS `studentsem` (
  `userId` int(11) NOT NULL,
  `sem` int(11) NOT NULL,
  `sgpa` varchar(5) NOT NULL,
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `studentsem`
--

INSERT INTO `studentsem` (`userId`, `sem`, `sgpa`) VALUES
(4, 4, '9.20');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `subjectId` int(5) NOT NULL AUTO_INCREMENT,
  `subjectName` varchar(50) NOT NULL,
  `subjectCode` varchar(10) NOT NULL,
  `sem` int(2) NOT NULL,
  `credits` int(11) NOT NULL,
  `deptId` int(5) NOT NULL,
  PRIMARY KEY (`subjectId`),
  KEY `deptId` (`deptId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subjectId`, `subjectName`, `subjectCode`, `sem`, `credits`, `deptId`) VALUES
(13, 'Web Programming', '10CI5GCWEP', 6, 6, 1),
(14, 'Java', '10CI5GCJAV', 5, 6, 1),
(15, 'OOMD', '10CI5GCOOM', 6, 4, 1),
(16, 'Software Engineering', '10CI5GCSWE', 6, 3, 1),
(17, 'Computer Networks', '10CI5GCCON', 6, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `teacherId` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`teacherId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacherId`, `name`, `password`, `email`) VALUES
(2, 'selva kumar', '540e358b3aa75a12b2777237550599a1529af60d', 'selva@bmsce.in'),
(3, 'ljj', 'df7e3bf86f4495807cf5a6e368526de34a77eb41', 'ljj@bmsce.in'),
(4, 'seema afreen', 'ce960f25b09c7330590a6266dd1f655cca4cb359', 'seema@bmsce.in'),
(5, 'Syed Akram', '1212', 'syedakram@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `teachersubject`
--

CREATE TABLE IF NOT EXISTS `teachersubject` (
  `teacherid` int(5) NOT NULL,
  `subjectId` int(5) NOT NULL,
  `classId` int(5) NOT NULL,
  `totalClasses` int(2) NOT NULL,
  PRIMARY KEY (`teacherid`,`subjectId`,`classId`),
  KEY `teacherid` (`teacherid`,`subjectId`,`classId`),
  KEY `subjectId` (`subjectId`),
  KEY `classId` (`classId`),
  KEY `classId_2` (`classId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachersubject`
--

INSERT INTO `teachersubject` (`teacherid`, `subjectId`, `classId`, `totalClasses`) VALUES
(2, 17, 1, 20),
(3, 13, 1, 25),
(4, 16, 1, 25),
(5, 15, 1, 25);

-- --------------------------------------------------------

--
-- Table structure for table `usernotification`
--

CREATE TABLE IF NOT EXISTS `usernotification` (
  `userId` int(5) NOT NULL,
  `userNoId` int(5) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` varchar(15) NOT NULL,
  `message` varchar(200) NOT NULL,
  PRIMARY KEY (`userId`,`userNoId`),
  KEY `userId` (`userNoId`,`type`),
  KEY `type` (`type`),
  KEY `type_2` (`type`),
  KEY `userId_2` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `usernotification`
--

INSERT INTO `usernotification` (`userId`, `userNoId`, `timestamp`, `type`, `message`) VALUES
(3, 1, '2014-05-19 15:09:59', 'fromAdmin', 'dis notification is from admin'),
(3, 2, '2014-05-19 15:11:50', 'fromAdmin', 'this msg is from admin in user Notification talble'),
(3, 3, '2014-05-19 15:12:09', 'fromAdmin', 'this msg is from admin in user Notification talble');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`subjectId`) REFERENCES `subject` (`subjectId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `student` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`deptId`) REFERENCES `dept` (`deptId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `classnotification`
--
ALTER TABLE `classnotification`
  ADD CONSTRAINT `classnotification_ibfk_2` FOREIGN KEY (`type`) REFERENCES `notificationtype` (`type`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `classnotification_ibfk_3` FOREIGN KEY (`classId`) REFERENCES `class` (`classId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `collegenotification`
--
ALTER TABLE `collegenotification`
  ADD CONSTRAINT `collegenotification_ibfk_1` FOREIGN KEY (`type`) REFERENCES `notificationtype` (`type`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `deptnotification`
--
ALTER TABLE `deptnotification`
  ADD CONSTRAINT `deptnotification_ibfk_1` FOREIGN KEY (`type`) REFERENCES `notificationtype` (`type`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `deptnotification_ibfk_2` FOREIGN KEY (`deptId`) REFERENCES `dept` (`deptId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `marks_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `student` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `marks_ibfk_3` FOREIGN KEY (`subjectId`) REFERENCES `subject` (`subjectId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `marks_ibfk_4` FOREIGN KEY (`examtypeId`) REFERENCES `examtype` (`examtypeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `oldgrades`
--
ALTER TABLE `oldgrades`
  ADD CONSTRAINT `oldgrades_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `student` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `oldgrades_ibfk_2` FOREIGN KEY (`subjectId`) REFERENCES `subject` (`subjectId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`classId`) REFERENCES `class` (`classId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `studentsem`
--
ALTER TABLE `studentsem`
  ADD CONSTRAINT `studentsem_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `student` (`userId`) ON DELETE CASCADE;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`deptId`) REFERENCES `dept` (`deptId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teachersubject`
--
ALTER TABLE `teachersubject`
  ADD CONSTRAINT `teachersubject_ibfk_1` FOREIGN KEY (`teacherid`) REFERENCES `teacher` (`teacherId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teachersubject_ibfk_2` FOREIGN KEY (`subjectId`) REFERENCES `subject` (`subjectId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teachersubject_ibfk_3` FOREIGN KEY (`classId`) REFERENCES `class` (`classId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usernotification`
--
ALTER TABLE `usernotification`
  ADD CONSTRAINT `usernotification_ibfk_2` FOREIGN KEY (`type`) REFERENCES `notificationtype` (`type`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usernotification_ibfk_3` FOREIGN KEY (`userId`) REFERENCES `student` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
