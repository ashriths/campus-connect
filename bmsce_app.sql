-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2014 at 08:37 PM
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
-- Table structure for table `deptevent`
--

CREATE TABLE IF NOT EXISTS `deptevent` (
  `id` int(11) NOT NULL,
  `deptId` int(11) NOT NULL,
  KEY `id` (`id`,`deptId`),
  KEY `deptId` (`deptId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('open','dept','club','') NOT NULL,
  `name` varchar(200) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
(3, 15, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fromId` int(11) NOT NULL,
  `toId` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seen` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `content` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fromId` (`fromId`,`toId`),
  KEY `toId` (`toId`),
  KEY `fromId_2` (`fromId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `fromId`, `toId`, `timestamp`, `seen`, `content`) VALUES
(1, 2, 1, '2014-06-16 09:41:26', '0000-00-00 00:00:00', 'THis is a Demo Message.'),
(2, 2, 1, '2014-06-16 09:45:48', '0000-00-00 00:00:00', 'something');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('user','class','college','dept') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `proctormeeting`
--

CREATE TABLE IF NOT EXISTS `proctormeeting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proctorId` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `issue` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `proctorId` (`proctorId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `userId` int(5) NOT NULL,
  `usn` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `classId` int(5) NOT NULL,
  `proctorId` int(5) NOT NULL,
  `cgpa` varchar(5) NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `usn` (`usn`),
  KEY `name` (`name`),
  KEY `proctorId` (`proctorId`),
  KEY `classId` (`classId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`userId`, `usn`, `name`, `classId`, `proctorId`, `cgpa`) VALUES
(1, '1BMXXXXXXX', 'Demo Student', 1, 2, '9.20'),
(3, '1BMXXXXXXY', 'Demo Student 2', 1, 2, '9.30');

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
  `userId` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `deptId` int(11) NOT NULL,
  PRIMARY KEY (`userId`),
  KEY `deptId` (`deptId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`userId`, `name`, `deptId`) VALUES
(2, 'Demo Faculty', 1);

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
  KEY `subjectId` (`subjectId`),
  KEY `classId` (`classId`),
  KEY `classId_2` (`classId`),
  KEY `teacherid` (`teacherid`,`subjectId`,`classId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userId` int(5) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL DEFAULT 's',
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `type`, `email`, `password`) VALUES
(1, 's', 'student@demo.com', '89e495e7941cf9e40e6980d14a16bf023ccd4c91'),
(2, 't', 'faculty@demo.com', '89e495e7941cf9e40e6980d14a16bf023ccd4c91'),
(3, 's', 'student2@demo.com', '89e495e7941cf9e40e6980d14a16bf023ccd4c91');

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
-- Constraints for table `deptevent`
--
ALTER TABLE `deptevent`
  ADD CONSTRAINT `deptevent_ibfk_3` FOREIGN KEY (`deptId`) REFERENCES `dept` (`deptId`),
  ADD CONSTRAINT `deptevent_ibfk_2` FOREIGN KEY (`id`) REFERENCES `event` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `marks_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `student` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `marks_ibfk_3` FOREIGN KEY (`subjectId`) REFERENCES `subject` (`subjectId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `marks_ibfk_4` FOREIGN KEY (`examtypeId`) REFERENCES `examtype` (`examtypeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_3` FOREIGN KEY (`fromId`) REFERENCES `user` (`userId`) ON DELETE NO ACTION,
  ADD CONSTRAINT `message_ibfk_5` FOREIGN KEY (`toId`) REFERENCES `user` (`userId`) ON DELETE CASCADE;

--
-- Constraints for table `oldgrades`
--
ALTER TABLE `oldgrades`
  ADD CONSTRAINT `oldgrades_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `student` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `oldgrades_ibfk_2` FOREIGN KEY (`subjectId`) REFERENCES `subject` (`subjectId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `proctormeeting`
--
ALTER TABLE `proctormeeting`
  ADD CONSTRAINT `proctormeeting_ibfk_2` FOREIGN KEY (`proctorId`) REFERENCES `teacher` (`userId`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`classId`) REFERENCES `class` (`classId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_ibfk_3` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_ibfk_4` FOREIGN KEY (`proctorId`) REFERENCES `teacher` (`userId`);

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
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`deptId`) REFERENCES `dept` (`deptId`),
  ADD CONSTRAINT `teacher_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE;

--
-- Constraints for table `teachersubject`
--
ALTER TABLE `teachersubject`
  ADD CONSTRAINT `teachersubject_ibfk_2` FOREIGN KEY (`subjectId`) REFERENCES `subject` (`subjectId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teachersubject_ibfk_3` FOREIGN KEY (`classId`) REFERENCES `class` (`classId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teachersubject_ibfk_4` FOREIGN KEY (`teacherid`) REFERENCES `teacher` (`userId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
