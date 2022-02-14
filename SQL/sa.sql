-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2021 at 07:11 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sa`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(25) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` mediumint(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `email`, `password`, `code`, `status`, `create_time`, `update_time`) VALUES
(1, 'Admin', 'admin@gmail.com', '1234', 123456, 'offline', '2021-04-14 14:30:29', '2021-04-14 10:59:07');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `ans_id` int(25) NOT NULL,
  `que_id` int(25) NOT NULL,
  `answer` mediumtext NOT NULL,
  `admin_id` int(25) DEFAULT NULL,
  `faculty_id` int(25) DEFAULT NULL,
  `stu_id` int(25) DEFAULT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`ans_id`, `que_id`, `answer`, `admin_id`, `faculty_id`, `stu_id`, `create_time`, `update_time`) VALUES
(2, 1, 'demo answer edited', NULL, NULL, 1, '2021-05-15 08:03:21', '2021-05-15 12:51:06'),
(4, 2, 'hey', NULL, NULL, 1, '2021-05-15 12:15:17', NULL),
(6, 6, 'admin', 1, NULL, NULL, '2021-05-15 14:15:07', NULL),
(7, 6, 'two', 1, NULL, NULL, '2021-05-15 14:25:26', NULL),
(8, 14, 'answer edti', 1, NULL, NULL, '2021-05-24 08:18:41', '2021-05-24 08:28:35'),
(13, 13, 'grgrv', NULL, 1, NULL, '2021-05-24 22:39:40', NULL),
(16, 13, 'nord', 1, NULL, NULL, '2021-05-24 22:51:19', '2021-05-24 22:51:56'),
(17, 13, 'oppo', 1, NULL, NULL, '2021-05-24 22:51:24', '2021-05-24 22:51:34'),
(18, 13, 'oppo', 1, NULL, NULL, '2021-05-24 22:51:28', '2021-05-24 22:51:47');

-- --------------------------------------------------------

--
-- Table structure for table `ask_question`
--

CREATE TABLE `ask_question` (
  `que_id` int(25) NOT NULL,
  `admin_id` int(25) DEFAULT NULL,
  `faculty_id` int(25) DEFAULT NULL,
  `stu_id` int(25) DEFAULT NULL,
  `sub_id` int(25) NOT NULL,
  `unit_id` int(25) NOT NULL,
  `question` text NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ask_question`
--

INSERT INTO `ask_question` (`que_id`, `admin_id`, `faculty_id`, `stu_id`, `sub_id`, `unit_id`, `question`, `create_time`, `update_time`) VALUES
(1, NULL, NULL, 1, 1, 17, 'demo questinsfwufwui duedhidhihddqfff4', '2021-05-14 21:05:53', '2021-05-15 12:32:02'),
(2, NULL, NULL, 1, 1, 17, 'hey testiing agoan with unit id', '2021-05-14 22:04:33', NULL),
(4, NULL, NULL, 1, 1, 18, 'unit 2 questions', '2021-05-15 12:18:12', NULL),
(6, 1, NULL, NULL, 1, 18, 'admin is in unit now in  edit also', '2021-05-15 14:11:04', '2021-05-15 14:30:46'),
(7, NULL, 1, NULL, 1, 17, 'faculty is ready', '2021-05-15 14:38:17', NULL),
(8, NULL, 1, NULL, 1, 17, 'helllo teachers', '2021-05-15 14:39:12', NULL),
(9, 1, NULL, NULL, 1, 17, 'hey no erreo', '2021-05-15 14:40:58', NULL),
(13, 1, NULL, NULL, 1, 17, 'no unit id erroe', '2021-05-15 14:48:59', NULL),
(14, 1, NULL, NULL, 53, 41, 'questions', '2021-05-24 08:18:19', NULL),
(15, 1, NULL, NULL, 53, 41, 'cdce', '2021-05-24 08:29:32', NULL),
(17, 1, NULL, NULL, 3, 40, 'bj', '2021-05-24 22:50:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(25) NOT NULL,
  `lec_id` int(25) NOT NULL,
  `admin_id` int(25) DEFAULT NULL,
  `faculty_id` int(25) DEFAULT NULL,
  `stu_id` int(25) DEFAULT NULL,
  `comment` text NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `lec_id`, `admin_id`, `faculty_id`, `stu_id`, `comment`, `create_time`, `update_time`) VALUES
(1, 1, NULL, NULL, 1, 'edit student comment', '2021-05-02 13:00:18', NULL),
(3, 2, NULL, NULL, 1, 'edit student comment', '2021-05-02 13:24:51', NULL),
(4, 1, NULL, NULL, 1, 'edit student comment', '2021-05-02 13:27:59', NULL),
(5, 1, NULL, NULL, 1, 'edit student comment', '2021-05-02 13:28:43', NULL),
(6, 1, NULL, NULL, 1, 'edit student comment', '2021-05-02 19:41:43', NULL),
(7, 1, NULL, NULL, 1, 'edit student comment', '2021-05-03 17:52:24', NULL),
(8, 1, NULL, NULL, 1, 'edit student comment', '2021-05-03 17:52:31', NULL),
(9, 1, NULL, NULL, 1, 'edit student comment', '2021-05-03 18:07:08', NULL),
(10, 1, 1, NULL, NULL, 'edit student comment', '2021-05-03 18:09:18', NULL),
(11, 1, 1, NULL, NULL, 'edit student comment', '2021-05-03 18:09:39', NULL),
(12, 1, NULL, NULL, 1, 'edit student comment', '2021-05-03 18:33:39', NULL),
(13, 1, 1, NULL, NULL, 'edit student comment', '2021-05-03 18:34:31', NULL),
(14, 1, NULL, 1, NULL, 'edit student comment', '2021-05-05 15:34:15', NULL),
(15, 1, NULL, NULL, 1, 'edit student comment', '2021-05-06 14:22:56', NULL),
(16, 1, 1, NULL, NULL, 'edit student comment', '2021-05-06 14:23:32', NULL),
(17, 1, NULL, 1, NULL, 'edit student comment', '2021-05-06 14:25:15', NULL),
(18, 24, 1, NULL, NULL, 'edit student comment', '2021-05-09 09:42:49', NULL),
(32, 24, NULL, 1, NULL, 'fayclt comment hbbwbu nnwuuuhshw', '2021-05-11 09:46:57', NULL),
(34, 24, NULL, NULL, 1, 'student comment', '2021-05-11 17:26:05', '2021-05-11 17:30:27');

-- --------------------------------------------------------

--
-- Table structure for table `connect_group`
--

CREATE TABLE `connect_group` (
  `cg_id` int(25) NOT NULL,
  `group_id` int(25) NOT NULL,
  `stu_id` int(25) NOT NULL,
  `group_token` varchar(255) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `connect_group`
--

INSERT INTO `connect_group` (`cg_id`, `group_id`, `stu_id`, `group_token`, `create_time`) VALUES
(7, 1, 1, 'abcdef', '2021-05-07 15:28:27'),
(8, 1, 2, 'abcdef', '2021-05-08 10:40:58'),
(9, 10, 1, '1557e64db3', '2021-07-06 13:15:35'),
(10, 10, 2, '1557e64db3', '2021-07-06 13:29:38'),
(11, 10, 4, '1557e64db3', '2021-07-06 13:34:12');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `d_id` int(25) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`d_id`, `department`) VALUES
(1, 'Civil Engineering'),
(2, 'Computer Engineering'),
(3, 'Electrical Engineering'),
(4, 'Mechanical Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `exam_id` int(25) NOT NULL,
  `group_id` int(25) NOT NULL,
  `que_no` int(5) NOT NULL,
  `question` varchar(255) NOT NULL,
  `option_1` varchar(255) NOT NULL,
  `option_2` varchar(255) NOT NULL,
  `option_3` varchar(255) NOT NULL,
  `option_4` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`exam_id`, `group_id`, `que_no`, `question`, `option_1`, `option_2`, `option_3`, `option_4`, `answer`, `create_time`, `update_time`) VALUES
(21, 1, 1, 'Full form of AI', 'Adobe illustrator ', 'Alibaba Intelligence ', 'Artificial Intelligence ', 'None of the Above', 'option_3', '2021-04-15 14:12:59', NULL),
(22, 1, 2, 'What is Artificial intelligence?', 'Making a Machine intelligent', 'Putting your intelligence into Computer', 'Programming with your own intelligence', 'putting more memory into Computer', 'option_1', '2021-04-21 14:08:36', NULL),
(23, 1, 3, 'What was originally called the “imitation game” by its creator?', 'The Turing Test', 'LISP', 'The Logic Theorist', 'Cybernetics', 'option_1', '2021-04-21 14:14:17', NULL),
(24, 1, 4, 'What is Machine learning?', 'The autonomous acquisition of knowledge through the use of computer programs', 'The autonomous acquisition of knowledge through the use of manual programs', 'The selective acquisition of knowledge through the use of computer programs', 'The selective acquisition of knowledge through the use of manual programs', 'option_1', '2021-04-21 14:17:58', NULL),
(25, 1, 5, 'Which of the following are comprised within AI?', 'Machine Learning', 'Deep Learning', 'Both (A) and (B)', 'None of the above', 'option_3', '2021-04-21 14:18:50', NULL),
(26, 1, 6, 'Which of the mentioned human behavior does the AI aim to mimic?', 'Thinking', 'Eating', 'Sleeping', 'None of the above', 'option_1', '2021-04-21 14:55:27', NULL),
(27, 1, 7, 'Which of the following is not a goal of AI?', 'Thinking humanly', 'Adapting to the environment and situations', 'To rule over humans', 'Real Life Problem Solving', 'option_3', '2021-04-21 15:08:25', NULL),
(28, 1, 8, 'Weak AI is', 'the embodiment of human intellectual capabilities within a computer.', 'a set of computer programs that produce output that would be considered to reflect intelligence if it were generated by humans.', 'the study of mental faculties through the use of mental models implemented on a computer.', 'All of the above', 'option_3', '2021-04-21 15:10:10', NULL),
(29, 1, 9, 'What is the name of the computer program that simulates the thought processes of human beings?', 'Human logic', 'Expert reason', 'Expert system', 'Personal information', 'option_3', '2021-04-21 15:13:44', NULL),
(30, 1, 10, 'Important AI Techniques are', 'Search', 'Use of knowledge', 'Abstraction', 'All of the above', 'option_4', '2021-04-21 15:14:21', NULL),
(31, 10, 1, 'Full form of AI', 'Adobe illustrator ', 'Alibaba Intelligence ', 'Artificial Intelligence ', 'None of the Above', 'option_3', '2021-04-15 14:12:59', NULL),
(32, 10, 2, 'What is Artificial intelligence?', 'Making a Machine intelligent', 'Putting your intelligence into Computer', 'Programming with your own intelligence', 'putting more memory into Computer', 'option_1', '2021-04-21 14:08:36', NULL),
(33, 10, 3, 'What was originally called the “imitation game” by its creator?', 'The Turing Test', 'LISP', 'The Logic Theorist', 'Cybernetics', 'option_1', '2021-04-21 14:14:17', NULL),
(34, 10, 4, 'What is Machine learning?', 'The autonomous acquisition of knowledge through the use of computer programs', 'The autonomous acquisition of knowledge through the use of manual programs', 'The selective acquisition of knowledge through the use of computer programs', 'The selective acquisition of knowledge through the use of manual programs', 'option_1', '2021-04-21 14:17:58', NULL),
(35, 10, 5, 'Which of the following are comprised within AI?', 'Machine Learning', 'Deep Learning', 'Both (A) and (B)', 'None of the above', 'option_3', '2021-04-21 14:18:50', NULL),
(36, 10, 6, 'Which of the mentioned human behavior does the AI aim to mimic?', 'Thinking', 'Eating', 'Sleeping', 'None of the above', 'option_1', '2021-04-21 14:55:27', NULL),
(37, 10, 7, 'Which of the following is not a goal of AI?', 'Thinking humanly', 'Adapting to the environment and situations', 'To rule over humans', 'Real Life Problem Solving', 'option_3', '2021-04-21 15:08:25', NULL),
(38, 10, 8, 'Weak AI is', 'the embodiment of human intellectual capabilities within a computer.', 'a set of computer programs that produce output that would be considered to reflect intelligence if it were generated by humans.', 'the study of mental faculties through the use of mental models implemented on a computer.', 'All of the above', 'option_3', '2021-04-21 15:10:10', NULL),
(39, 10, 9, 'What is the name of the computer program that simulates the thought processes of human beings?', 'Human logic', 'Expert reason', 'Expert system', 'Personal information', 'option_3', '2021-04-21 15:13:44', NULL),
(40, 10, 10, 'Important AI Techniques are', 'Search', 'Use of knowledge', 'Abstraction', 'All of the above', 'option_4', '2021-04-21 15:14:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam_group`
--

CREATE TABLE `exam_group` (
  `group_id` int(25) NOT NULL,
  `d_id` int(25) NOT NULL,
  `semester` int(2) NOT NULL,
  `sub_id` int(25) NOT NULL,
  `total_questions` varchar(255) NOT NULL,
  `total_time_minutes` int(5) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `group_token` varchar(255) NOT NULL,
  `admin_id` int(25) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_group`
--

INSERT INTO `exam_group` (`group_id`, `d_id`, `semester`, `sub_id`, `total_questions`, `total_time_minutes`, `date`, `time`, `group_token`, `admin_id`, `create_time`, `update_time`) VALUES
(1, 2, 8, 1, '10', 1, '2021-05-07', '17:22:30', 'abcdef', 1, '2021-05-07 13:09:02', '2021-05-07 09:37:34'),
(10, 2, 8, 1, '10', 20, '2021-07-06', '13:20:00', '1557e64db3', 1, '2021-07-06 13:07:04', '2021-07-06 13:12:53');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` int(25) NOT NULL,
  `username` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `d_id` int(25) NOT NULL,
  `password` varchar(250) NOT NULL,
  `code` mediumint(50) NOT NULL,
  `status` varchar(250) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `username`, `email`, `mobile`, `d_id`, `password`, `code`, `status`, `create_time`, `update_time`) VALUES
(1, 'Faculty', 'faculty@gmail.com', 1234567890, 2, '1234', 123456, 'offline', '2021-04-14 14:37:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lectures`
--

CREATE TABLE `lectures` (
  `lec_id` int(25) NOT NULL,
  `admin_id` int(25) DEFAULT NULL,
  `faculty_id` int(25) DEFAULT NULL,
  `d_id` int(25) NOT NULL,
  `semester` int(10) NOT NULL,
  `sub_id` int(25) NOT NULL,
  `unit_id` int(25) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `lecture_link` varchar(255) DEFAULT NULL,
  `lecture_path` text DEFAULT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lectures`
--

INSERT INTO `lectures` (`lec_id`, `admin_id`, `faculty_id`, `d_id`, `semester`, `sub_id`, `unit_id`, `topic`, `lecture_link`, `lecture_path`, `create_time`, `update_time`) VALUES
(4, 1, NULL, 2, 7, 3, 40, '1', 'https://www.youtube.com/watch?v=ssYIXxcdctQ', NULL, '2021-05-13 16:19:23', '2021-05-14 19:04:54'),
(5, 1, NULL, 2, 7, 3, 40, '2', 'https://www.youtube.com/watch?v=wkSA9bfCmKU&amp;list=PL0b6OzIxLPbz1cgxiH5KCBsyQij1HsPtG&amp;index=1', NULL, '2021-05-13 17:29:28', '2021-05-14 19:05:09'),
(6, 1, NULL, 2, 7, 3, 40, '3', 'https://youtu.be/ssYIXxcdctQ', NULL, '2021-05-13 17:29:48', '2021-05-14 19:05:17'),
(11, 1, NULL, 2, 7, 3, 40, '4', 'https://youtu.be/wkSA9bfCmKU', NULL, '2021-05-13 18:15:05', '2021-05-14 19:05:26'),
(16, 1, NULL, 2, 7, 3, 40, 'test agian admin', 'https://youtu.be/wkSA9bfCmKU', NULL, '2021-05-14 13:56:02', '2021-05-14 19:07:48'),
(17, NULL, 1, 2, 8, 1, 17, 'faculty test id', 'https://youtu.be/wkSA9bfCmKU', NULL, '2021-05-14 13:56:17', '2021-05-14 14:07:24'),
(18, NULL, 1, 2, 8, 1, 17, 'faculty test id', 'https://youtu.be/wkSA9bfCmKU', NULL, '2021-05-14 13:57:00', '2021-05-14 14:07:40'),
(19, NULL, 1, 2, 8, 1, 17, 'faculty test id', 'https://youtu.be/wkSA9bfCmKU', NULL, '2021-05-14 13:57:15', NULL),
(20, NULL, 1, 2, 8, 1, 17, 'https://youtu.be/ssYIXxcdctQ', 'https://youtu.be/ssYIXxcdctQ', NULL, '2021-05-14 14:14:02', NULL),
(21, NULL, 1, 2, 8, 1, 17, 'https://youtu.be/ssYIXxcdctQ', 'https://youtu.be/ssYIXxcdctQ', NULL, '2021-05-14 14:14:07', NULL),
(22, NULL, 1, 2, 8, 1, 17, 'https://youtu.be/ssYIXxcdctQ', 'https://youtu.be/ssYIXxcdctQ', NULL, '2021-05-14 14:14:11', NULL),
(23, NULL, 1, 2, 8, 1, 17, 'https://youtu.be/ssYIXxcdctQ', 'https://youtu.be/ssYIXxcdctQ', NULL, '2021-05-14 14:14:16', NULL),
(24, NULL, 1, 2, 8, 1, 17, 'https://youtu.be/ssYIXxcdctQ', 'https://youtu.be/ssYIXxcdctQ', NULL, '2021-05-14 14:14:22', NULL),
(25, NULL, 1, 2, 8, 1, 17, 'https://youtu.be/ssYIXxcdctQ', 'https://youtu.be/ssYIXxcdctQ', NULL, '2021-05-14 14:14:28', NULL),
(26, NULL, 1, 2, 8, 1, 17, 'https://youtu.be/ssYIXxcdctQ', 'https://youtu.be/ssYIXxcdctQ', NULL, '2021-05-14 14:14:33', NULL),
(27, NULL, 1, 2, 8, 1, 17, 'https://youtu.be/ssYIXxcdctQ', 'https://youtu.be/wkSA9bfCmKU', NULL, '2021-05-14 14:14:54', '2021-05-14 14:15:54'),
(28, NULL, 1, 2, 8, 1, 17, 'https://youtu.be/ssYIXxcdctQ', 'https://youtu.be/ssYIXxcdctQ', NULL, '2021-05-14 14:15:00', NULL),
(29, NULL, 1, 2, 8, 1, 17, 'https://youtu.be/ssYIXxcdctQ', 'https://youtu.be/ssYIXxcdctQ', NULL, '2021-05-14 14:15:06', NULL),
(30, NULL, 1, 2, 8, 1, 17, 'https://youtu.be/ssYIXxcdctQ', 'https://youtu.be/ssYIXxcdctQ', NULL, '2021-05-14 14:15:10', NULL),
(31, NULL, 1, 2, 8, 1, 17, 'https://youtu.be/ssYIXxcdctQ', 'https://youtu.be/ssYIXxcdctQ', NULL, '2021-05-14 14:15:15', NULL),
(32, NULL, 1, 2, 8, 1, 17, 'https://youtu.be/ssYIXxcdctQ', 'https://youtu.be/ssYIXxcdctQ', NULL, '2021-05-14 14:15:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mcqs`
--

CREATE TABLE `mcqs` (
  `mcq_id` int(25) NOT NULL,
  `sub_id` int(25) NOT NULL,
  `unit_id` int(25) NOT NULL,
  `mcq_no` int(25) NOT NULL,
  `question` text NOT NULL,
  `option_1` varchar(255) NOT NULL,
  `option_2` varchar(255) NOT NULL,
  `option_3` varchar(255) NOT NULL,
  `option_4` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mcqs`
--

INSERT INTO `mcqs` (`mcq_id`, `sub_id`, `unit_id`, `mcq_no`, `question`, `option_1`, `option_2`, `option_3`, `option_4`, `answer`, `create_time`, `update_time`) VALUES
(2, 1, 18, 1, 'Full form of AI', 'Adobe illustrator', 'Alibaba Intelligence', 'Artificial Intelligence', 'None of the Above', 'option_3', '2021-05-24 17:39:18', NULL),
(3, 1, 18, 2, 'Weak AI is', 'a set of computer programs that produce output that would be considered to reflect intelligence if it were generated by humans.', 'the study of mental faculties through the use of mental models implemented on a computer.', 'the embodiment of human intellectual capabilities within a computer.', 'All of the above', 'option_2', '2021-05-24 17:41:29', NULL),
(4, 3, 40, 1, 'What was originally called the “imitation game” by its creator?', 'The Turing Test', 'LISP', 'The Logic Theorist', 'Cybernetics', 'option_1', '2021-05-24 18:03:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `notice_id` int(25) NOT NULL,
  `admin_id` int(25) NOT NULL,
  `d_id` int(25) NOT NULL,
  `notice` text NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`notice_id`, `admin_id`, `d_id`, `notice`, `create_time`, `update_time`) VALUES
(1, 1, 2, 'Exam of <i><b>Web Databse Management</b></i> on <i>10:00 AM to 10:30 AM on Friday, May 07,2021</i>. Group Token of exam is <b>&#8216;b3ef804e8a&#8217;</b>.<br>', '2021-05-06 21:56:33', NULL),
(4, 1, 2, 'Exam of <i><b>Artificial Intelligence</b></i> on <i>01:15 PM to 01:35 PM on Tuesday, July 06,2021</i>. Group Token of exam is <b>&#8216;1557e64db3&#8217;</b>.', '2021-07-06 13:09:27', NULL),
(5, 1, 2, 'Exam of <i><b>Artificial Intelligence</b></i> on <i>01:20 PM to 01:40 PM on Tuesday, July 06,2021</i>. Group Token of exam is <b>&#8216;1557e64db3&#8217;</b>.', '2021-07-06 13:12:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `response`
--

CREATE TABLE `response` (
  `response_id` int(25) NOT NULL,
  `exam_id` int(25) NOT NULL,
  `stu_id` int(25) NOT NULL,
  `response` varchar(255) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `response`
--

INSERT INTO `response` (`response_id`, `exam_id`, `stu_id`, `response`, `create_time`) VALUES
(14, 31, 1, 'option_3', '2021-07-06 13:28:34'),
(15, 32, 1, 'option_1', '2021-07-06 13:28:34'),
(16, 33, 1, 'option_1', '2021-07-06 13:28:34'),
(17, 34, 1, 'option_1', '2021-07-06 13:28:34'),
(18, 35, 1, 'option_3', '2021-07-06 13:28:34'),
(19, 36, 1, 'option_1', '2021-07-06 13:28:34'),
(20, 37, 1, 'option_3', '2021-07-06 13:28:34'),
(21, 38, 1, 'option_3', '2021-07-06 13:28:34'),
(22, 39, 1, 'option_3', '2021-07-06 13:28:34'),
(23, 31, 2, 'option_3', '2021-07-06 13:31:56'),
(24, 36, 2, 'option_1', '2021-07-06 13:31:56'),
(25, 34, 2, 'option_1', '2021-07-06 13:31:56'),
(26, 39, 2, 'option_3', '2021-07-06 13:31:56'),
(27, 37, 2, 'option_1', '2021-07-06 13:31:56'),
(28, 40, 2, 'option_3', '2021-07-06 13:31:56'),
(29, 33, 2, 'option_1', '2021-07-06 13:31:56'),
(30, 32, 2, 'option_1', '2021-07-06 13:31:56'),
(31, 35, 2, 'option_3', '2021-07-06 13:31:56'),
(32, 38, 2, 'option_1', '2021-07-06 13:31:56'),
(33, 31, 1, 'option_3', '2021-07-06 13:45:32'),
(34, 32, 1, 'option_1', '2021-07-06 13:45:32'),
(35, 33, 1, 'option_1', '2021-07-06 13:45:32'),
(36, 34, 1, 'option_1', '2021-07-06 13:45:32'),
(37, 35, 1, 'option_3', '2021-07-06 13:45:32'),
(38, 36, 1, 'option_1', '2021-07-06 13:45:32'),
(39, 37, 1, 'option_1', '2021-07-06 13:45:32'),
(40, 38, 1, 'option_2', '2021-07-06 13:45:32'),
(41, 39, 1, 'option_3', '2021-07-06 13:45:32'),
(42, 40, 1, 'option_1', '2021-07-06 13:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `result_id` int(25) NOT NULL,
  `group_id` int(25) NOT NULL,
  `stu_id` int(25) NOT NULL,
  `right_ans` varchar(255) NOT NULL,
  `wrong_ans` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`result_id`, `group_id`, `stu_id`, `right_ans`, `wrong_ans`, `total`, `create_time`) VALUES
(1, 1, 1, '9', '1', '10', '2021-05-07 17:23:28'),
(2, 10, 1, '9', '1', '10', '2021-07-06 13:28:34'),
(3, 10, 2, '7', '3', '10', '2021-07-06 13:31:56'),
(4, 10, 1, '16', '-6', '10', '2021-07-06 13:45:33');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stu_id` int(25) NOT NULL,
  `enrollment` bigint(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `d_id` int(25) NOT NULL,
  `semester` int(2) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` mediumint(50) NOT NULL,
  `status` varchar(50) CHARACTER SET utf8 NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stu_id`, `enrollment`, `username`, `email`, `mobile`, `d_id`, `semester`, `password`, `code`, `status`, `create_time`, `update_time`) VALUES
(1, 1234567, 'student', 'student@gmail.com', 1234657890, 2, 8, '1234', 123456, 'offline', '2021-04-14 11:09:19', '2021-06-22 19:13:39'),
(2, 123456, 'User2', 'User2@gmail.com', 1234567891, 2, 8, '1234', 123456, 'offline', '2021-05-02 10:07:37', '2021-05-03 15:46:26'),
(4, 12345, 'User3', 'User3@gmail.com', 1234567891, 2, 8, '1234', 0, '', '2021-07-06 10:02:57', '2021-07-06 10:02:57');

-- --------------------------------------------------------

--
-- Table structure for table `study_materials`
--

CREATE TABLE `study_materials` (
  `material_id` int(255) NOT NULL,
  `admin_id` int(25) DEFAULT NULL,
  `faculty_id` int(25) DEFAULT NULL,
  `d_id` int(25) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `sub_id` int(25) NOT NULL,
  `unit_id` int(25) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `study_materials`
--

INSERT INTO `study_materials` (`material_id`, `admin_id`, `faculty_id`, `d_id`, `semester`, `sub_id`, `unit_id`, `topic`, `file`, `create_time`, `update_time`) VALUES
(14, NULL, NULL, 2, '8', 1, 17, 't', '../materials/609f353483d606.61139057.pdf', '2021-05-15 08:10:29', '2021-05-15 08:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sub_id` int(25) NOT NULL,
  `short_name` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `d_id` int(25) NOT NULL,
  `semester` int(10) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sub_id`, `short_name`, `subject`, `d_id`, `semester`, `create_time`, `update_time`) VALUES
(1, 'AI', 'Artificial Intelligence', 2, 8, '2021-04-16 14:58:33', NULL),
(2, 'WDM', 'Web Databse Management', 2, 8, '2021-04-16 14:58:33', NULL),
(3, 'INS', 'INS', 2, 7, '2021-04-16 19:11:00', NULL),
(7, 'AJAVA', 'Advance JAVA', 2, 6, '2021-04-16 19:16:11', NULL),
(8, 'TOC', 'TOC', 2, 6, '2021-04-16 19:17:28', NULL),
(9, 'WT', 'Web Tchology', 2, 6, '2021-04-16 19:18:12', NULL),
(20, 'SE', 'SE', 2, 6, '2021-04-17 11:55:58', NULL),
(21, '.Net', '.NET FRAMEWORK', 2, 6, '2021-04-17 11:58:08', NULL),
(26, 'EEE', 'EEE', 2, 1, '2021-04-17 13:10:13', NULL),
(48, NULL, 'ES', 2, 1, '2021-05-06 16:19:59', NULL),
(49, NULL, 'CINEMA', 2, 1, '2021-05-12 20:14:45', NULL),
(50, NULL, 'EG', 1, 1, '2021-05-13 08:49:38', NULL),
(51, NULL, 'ES', 1, 1, '2021-05-13 08:50:04', NULL),
(53, NULL, 'MCWC', 2, 7, '2021-05-13 13:13:07', NULL),
(54, NULL, 'DDBMS', 2, 7, '2021-05-13 13:13:24', NULL),
(55, NULL, 'CD', 2, 7, '2021-05-13 13:13:36', NULL),
(57, NULL, 'EEE', 3, 1, '2021-05-13 13:14:49', NULL),
(58, NULL, 'EME', 4, 1, '2021-05-13 13:15:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unit_id` int(25) NOT NULL,
  `sub_id` int(25) NOT NULL,
  `unit_number` int(25) NOT NULL,
  `unit_name` varchar(255) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_id`, `sub_id`, `unit_number`, `unit_name`, `create_time`, `update_time`) VALUES
(1, 50, 1, 'unit 1', '2021-05-13 06:47:16', NULL),
(17, 1, 1, 'What is AI?', '0000-00-00 00:00:00', NULL),
(18, 1, 2, 'Problems, State Space Search &amp; Heuristic Search Techniques', '0000-00-00 00:00:00', NULL),
(19, 1, 3, 'Knowledge Representation Issues', '0000-00-00 00:00:00', NULL),
(20, 1, 4, 'Using Predicate Logic', '0000-00-00 00:00:00', NULL),
(21, 1, 5, 'Representing Knowledge Using Rules', '0000-00-00 00:00:00', NULL),
(22, 1, 6, 'Symbolic Reasoning Under Uncertainty', '0000-00-00 00:00:00', NULL),
(23, 1, 7, 'Statistical Reasoning', '0000-00-00 00:00:00', NULL),
(24, 1, 8, 'Weak Slot-and-Filler Structures', '0000-00-00 00:00:00', NULL),
(25, 1, 9, 'Strong Slot-and-Filler Structures', '0000-00-00 00:00:00', NULL),
(26, 1, 10, 'Game Playing: Overview, And Example Domain', '0000-00-00 00:00:00', NULL),
(27, 1, 11, 'Understanding', '0000-00-00 00:00:00', NULL),
(28, 1, 12, 'Natural Language Processing', '0000-00-00 00:00:00', NULL),
(30, 1, 13, 'Connectionist Models', '0000-00-00 00:00:00', NULL),
(31, 1, 14, 'Introduction to Prolog', '0000-00-00 00:00:00', NULL),
(32, 2, 1, 'Data Model', '0000-00-00 00:00:00', NULL),
(33, 2, 2, 'XPath and XQuery', '0000-00-00 00:00:00', NULL),
(34, 2, 3, 'Typing', '0000-00-00 00:00:00', NULL),
(35, 2, 4, 'XML Query Evaluation', '0000-00-00 00:00:00', NULL),
(36, 2, 5, 'Ontologies, RDF, and OWL', '0000-00-00 00:00:00', NULL),
(37, 2, 6, 'Querying Data through Ontologies', '0000-00-00 00:00:00', NULL),
(38, 2, 7, 'Data Integration', '0000-00-00 00:00:00', NULL),
(39, 2, 8, 'Building Web scale applications', '0000-00-00 00:00:00', NULL),
(40, 3, 1, 'Cryptography', '0000-00-00 00:00:00', NULL),
(41, 53, 1, 'INtroduction to mcwc', '0000-00-00 00:00:00', NULL),
(42, 50, 2, 'EG', '0000-00-00 00:00:00', NULL),
(43, 57, 1, 'Introduction to EEE', '0000-00-00 00:00:00', NULL),
(44, 58, 1, 'Introduction to EME', '0000-00-00 00:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`ans_id`),
  ADD KEY `answers_ibfk_1` (`que_id`),
  ADD KEY `answers_ibfk_2` (`stu_id`),
  ADD KEY `answers_ibfk_3` (`faculty_id`);

--
-- Indexes for table `ask_question`
--
ALTER TABLE `ask_question`
  ADD PRIMARY KEY (`que_id`),
  ADD KEY `ask_question_ibfk_1` (`sub_id`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `faculty_id` (`faculty_id`),
  ADD KEY `stu_id` (`stu_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `connect_group`
--
ALTER TABLE `connect_group`
  ADD PRIMARY KEY (`cg_id`),
  ADD KEY `connect_group_ibfk_1` (`group_id`),
  ADD KEY `connect_group_ibfk_2` (`stu_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`exam_id`),
  ADD KEY `exam_ibfk_1` (`group_id`);

--
-- Indexes for table `exam_group`
--
ALTER TABLE `exam_group`
  ADD PRIMARY KEY (`group_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `d_id` (`d_id`),
  ADD KEY `sub_id` (`sub_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`),
  ADD KEY `d_id` (`d_id`);

--
-- Indexes for table `lectures`
--
ALTER TABLE `lectures`
  ADD PRIMARY KEY (`lec_id`),
  ADD KEY `d_id` (`d_id`),
  ADD KEY `sub_id` (`sub_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `mcqs`
--
ALTER TABLE `mcqs`
  ADD PRIMARY KEY (`mcq_id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`notice_id`),
  ADD KEY `notice_ibfk_1` (`admin_id`),
  ADD KEY `d_id` (`d_id`);

--
-- Indexes for table `response`
--
ALTER TABLE `response`
  ADD PRIMARY KEY (`response_id`),
  ADD KEY `stu_id` (`stu_id`),
  ADD KEY `response_ibfk_1` (`exam_id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `stu_id` (`stu_id`),
  ADD KEY `result_ibfk_3` (`group_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stu_id`),
  ADD UNIQUE KEY `enrollment` (`enrollment`),
  ADD KEY `d_id` (`d_id`);

--
-- Indexes for table `study_materials`
--
ALTER TABLE `study_materials`
  ADD PRIMARY KEY (`material_id`),
  ADD KEY `d_id` (`d_id`),
  ADD KEY `study_materials_ibfk_2` (`sub_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `d_id` (`d_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_id`),
  ADD KEY `sub_id` (`sub_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7002;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `ans_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `ask_question`
--
ALTER TABLE `ask_question`
  MODIFY `que_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `connect_group`
--
ALTER TABLE `connect_group`
  MODIFY `cg_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `d_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `exam_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `exam_group`
--
ALTER TABLE `exam_group`
  MODIFY `group_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `faculty_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lectures`
--
ALTER TABLE `lectures`
  MODIFY `lec_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `mcqs`
--
ALTER TABLE `mcqs`
  MODIFY `mcq_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `notice_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `response`
--
ALTER TABLE `response`
  MODIFY `response_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `result_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `stu_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `study_materials`
--
ALTER TABLE `study_materials`
  MODIFY `material_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `sub_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`que_id`) REFERENCES `ask_question` (`que_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`stu_id`) REFERENCES `student` (`stu_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `answers_ibfk_3` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ask_question`
--
ALTER TABLE `ask_question`
  ADD CONSTRAINT `ask_question_ibfk_1` FOREIGN KEY (`sub_id`) REFERENCES `subject` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ask_question_ibfk_3` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`unit_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ask_question_ibfk_4` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ask_question_ibfk_5` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ask_question_ibfk_6` FOREIGN KEY (`stu_id`) REFERENCES `student` (`stu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `connect_group`
--
ALTER TABLE `connect_group`
  ADD CONSTRAINT `connect_group_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `exam_group` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `connect_group_ibfk_2` FOREIGN KEY (`stu_id`) REFERENCES `student` (`stu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `exam_group` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_group`
--
ALTER TABLE `exam_group`
  ADD CONSTRAINT `exam_group_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`),
  ADD CONSTRAINT `exam_group_ibfk_2` FOREIGN KEY (`d_id`) REFERENCES `department` (`d_id`),
  ADD CONSTRAINT `exam_group_ibfk_3` FOREIGN KEY (`sub_id`) REFERENCES `subject` (`sub_id`);

--
-- Constraints for table `faculty`
--
ALTER TABLE `faculty`
  ADD CONSTRAINT `faculty_ibfk_1` FOREIGN KEY (`d_id`) REFERENCES `department` (`d_id`);

--
-- Constraints for table `lectures`
--
ALTER TABLE `lectures`
  ADD CONSTRAINT `lectures_ibfk_1` FOREIGN KEY (`d_id`) REFERENCES `department` (`d_id`),
  ADD CONSTRAINT `lectures_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `subject` (`sub_id`),
  ADD CONSTRAINT `lectures_ibfk_3` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`unit_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notice`
--
ALTER TABLE `notice`
  ADD CONSTRAINT `notice_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notice_ibfk_2` FOREIGN KEY (`d_id`) REFERENCES `department` (`d_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `response`
--
ALTER TABLE `response`
  ADD CONSTRAINT `response_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`exam_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `response_ibfk_2` FOREIGN KEY (`stu_id`) REFERENCES `student` (`stu_id`);

--
-- Constraints for table `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `result_ibfk_2` FOREIGN KEY (`stu_id`) REFERENCES `student` (`stu_id`),
  ADD CONSTRAINT `result_ibfk_3` FOREIGN KEY (`group_id`) REFERENCES `exam_group` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`d_id`) REFERENCES `department` (`d_id`);

--
-- Constraints for table `study_materials`
--
ALTER TABLE `study_materials`
  ADD CONSTRAINT `study_materials_ibfk_1` FOREIGN KEY (`d_id`) REFERENCES `department` (`d_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `study_materials_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `subject` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `study_materials_ibfk_3` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`unit_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`d_id`) REFERENCES `department` (`d_id`);

--
-- Constraints for table `unit`
--
ALTER TABLE `unit`
  ADD CONSTRAINT `unit_ibfk_1` FOREIGN KEY (`sub_id`) REFERENCES `subject` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
