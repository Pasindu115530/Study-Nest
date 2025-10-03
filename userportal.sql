-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2025 at 11:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `userportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `lecture_notes`
--

CREATE TABLE `lecture_notes` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `module` varchar(100) NOT NULL,
  `filedata` longblob NOT NULL,
  `upload_date` datetime NOT NULL DEFAULT current_timestamp(),
  `year` int(11) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `department` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `semester` enum('1','2') NOT NULL,
  `year` enum('1','2','3','4') NOT NULL,
  `department` varchar(100) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`, `semester`, `year`, `department`, `upload_date`) VALUES
(37, 'Professional English', '1', '1', 'Computer Science', '2025-07-09 05:31:08'),
(38, 'Principles of Management', '1', '1', 'Computer Science', '2025-07-09 05:31:08'),
(39, 'Introductory Statistics', '1', '1', 'Computer Science', '2025-07-09 05:31:08'),
(40, 'Discrete Mathematics', '1', '1', 'Computer Science', '2025-07-09 05:31:08'),
(41, 'Computer System Organization', '1', '1', 'Computer Science', '2025-07-09 05:31:08'),
(42, 'Fundamentals of Programming', '1', '1', 'Computer Science', '2025-07-09 05:31:08'),
(43, 'Introduction to Software Engineering', '1', '1', 'Computer Science', '2025-07-09 05:31:08'),
(44, 'Leadership & Human Skills Development', '1', '1', 'Computer Science', '2025-07-09 05:31:08'),
(45, 'Web Development', '2', '1', 'Computer Science', '2025-07-09 08:25:10'),
(46, 'Mathematics II', '2', '1', 'Computer Science', '2025-07-09 08:25:10'),
(47, 'Object Oriented Programming', '2', '1', 'Computer Science', '2025-07-09 08:25:10'),
(48, 'Database Management Systems', '2', '1', 'Computer Science', '2025-07-09 08:25:10'),
(49, 'Data Structures and Algorithms', '2', '1', 'Computer Science', '2025-07-09 08:25:10'),
(50, 'Object Oriented Analysis and Design', '2', '1', 'Computer Science', '2025-07-09 08:25:10'),
(51, 'Computer System Architecture', '2', '1', 'Computer Science', '2025-07-09 08:25:10'),
(52, 'Rapid Application Development', '2', '1', 'Computer Science', '2025-07-09 08:25:10'),
(53, 'Algebra for Computing', '2', '1', 'Computer Science', '2025-07-09 08:25:10'),
(54, 'Group Project Part 1', '1', '2', 'Computer Science', '2025-07-09 08:26:21'),
(55, 'Data Communication and Networks', '1', '2', 'Computer Science', '2025-07-09 08:26:21'),
(56, 'Operating Systems', '1', '2', 'Computer Science', '2025-07-09 08:26:21'),
(57, 'Web Technologies', '1', '2', 'Computer Science', '2025-07-09 08:26:21'),
(58, 'Statistical Distribution and Inferences', '1', '2', 'Computer Science', '2025-07-09 08:26:21'),
(59, 'Mathematics for Computer Science', '1', '2', 'Computer Science', '2025-07-09 08:26:21'),
(60, 'Artificial Intelligence', '1', '2', 'Computer Science', '2025-07-09 08:26:21'),
(61, 'Group Project Part 2', '2', '2', 'Computer Science', '2025-07-09 08:27:46'),
(62, 'Computer Graphics', '2', '2', 'Computer Science', '2025-07-09 08:27:46'),
(63, 'High Performance Computing', '2', '2', 'Computer Science', '2025-07-09 08:27:46'),
(64, 'Human Computer Interactions', '2', '2', 'Computer Science', '2025-07-09 08:27:46'),
(65, 'Differential Equations', '2', '2', 'Computer Science', '2025-07-09 08:27:46'),
(66, 'Service Oriented Web Applications', '2', '2', 'Computer Science', '2025-07-09 08:27:46'),
(67, 'Industrial Internship', '2', '2', 'Computer Science', '2025-07-09 08:27:46'),
(68, 'Software Architecture and Design Patterns 1', '2', '2', 'Computer Science', '2025-07-09 08:27:46'),
(69, 'Software Architecture and Design Patterns 2', '2', '2', 'Computer Science', '2025-07-09 08:27:46'),
(70, 'Software Architecture and Design Patterns 3', '2', '2', 'Computer Science', '2025-07-09 08:27:46'),
(71, 'Software Architecture and Design Patterns 4', '2', '2', 'Computer Science', '2025-07-09 08:27:46'),
(72, 'Data Analytics', '1', '3', 'Computer Science', '2025-07-09 08:28:04'),
(73, 'Social and Professional Issues in Information Technology', '1', '3', 'Computer Science', '2025-07-09 08:28:04'),
(74, 'Knowledge Representation', '1', '3', 'Computer Science', '2025-07-09 08:28:04'),
(75, 'Theory of Computation', '1', '3', 'Computer Science', '2025-07-09 08:28:04'),
(76, 'Advanced Data Structures and Algorithms', '1', '3', 'Computer Science', '2025-07-09 08:28:04'),
(77, 'Computer Security', '1', '3', 'Computer Science', '2025-07-09 08:28:04'),
(78, 'Introduction to Machine Learning', '1', '3', 'Computer Science', '2025-07-09 08:28:04'),
(79, 'Emerging Trends in Computing', '1', '3', 'Computer Science', '2025-07-09 08:28:04'),
(80, 'Visual Computing', '1', '3', 'Computer Science', '2025-07-09 08:28:04'),
(81, 'IT Project Management', '1', '3', 'Computer Science', '2025-07-09 08:28:04'),
(82, 'Digital Image Processing', '2', '3', 'Computer Science', '2025-07-09 08:28:40'),
(83, 'Software Quality Assurance', '2', '3', 'Computer Science', '2025-07-09 08:28:40'),
(84, 'Advanced Machine Learning', '2', '3', 'Computer Science', '2025-07-09 08:28:40'),
(85, 'Theory of Programming Languages', '2', '3', 'Computer Science', '2025-07-09 08:28:40'),
(86, 'Multimedia Systems', '2', '3', 'Computer Science', '2025-07-09 08:28:40'),
(87, 'Nature Inspired Algorithms', '2', '3', 'Computer Science', '2025-07-09 08:28:40'),
(88, 'Embedded Systems and Internet of Things', '2', '3', 'Computer Science', '2025-07-09 08:28:40'),
(89, 'Game Development', '2', '3', 'Computer Science', '2025-07-09 08:28:40'),
(90, 'Middleware Architecture', '2', '3', 'Computer Science', '2025-07-09 08:28:40'),
(91, 'Mathematical Optimization', '2', '3', 'Computer Science', '2025-07-09 08:28:40'),
(92, 'Research Project Part I', '1', '4', 'Computer Science', '2025-07-09 08:28:58'),
(93, 'Computational Biology', '1', '4', 'Computer Science', '2025-07-09 08:28:58'),
(94, 'Independent Literature Review', '1', '4', 'Computer Science', '2025-07-09 08:28:58'),
(95, 'Computer Vision', '1', '4', 'Computer Science', '2025-07-09 08:28:58'),
(96, 'Cloud Computing', '1', '4', 'Computer Science', '2025-07-09 08:28:58'),
(97, 'Big Data Technologies', '1', '4', 'Computer Science', '2025-07-09 08:28:58'),
(98, 'Robotics', '1', '4', 'Computer Science', '2025-07-09 08:28:58'),
(99, 'Natural Language Processing', '1', '4', 'Computer Science', '2025-07-09 08:28:58'),
(100, 'Advanced Database Systems', '1', '4', 'Computer Science', '2025-07-09 08:28:58'),
(101, 'Mobile Computing', '1', '4', 'Computer Science', '2025-07-09 08:28:58'),
(102, 'Professional English', '1', '1', 'Software Engineering', '2025-07-09 08:31:55'),
(103, 'Principles of Management', '1', '1', 'Software Engineering', '2025-07-09 08:31:55'),
(104, 'Introductory Statistics', '1', '1', 'Software Engineering', '2025-07-09 08:31:55'),
(105, 'Discrete Mathematics', '1', '1', 'Software Engineering', '2025-07-09 08:31:55'),
(106, 'Computer System Organization', '1', '1', 'Software Engineering', '2025-07-09 08:31:55'),
(107, 'Fundamentals of Programming', '1', '1', 'Software Engineering', '2025-07-09 08:31:55'),
(108, 'Introduction to Software Engineering', '1', '1', 'Software Engineering', '2025-07-09 08:31:55'),
(109, 'Leadership & Human Skills Development', '1', '1', 'Software Engineering', '2025-07-09 08:31:55'),
(110, 'Object Oriented Programming', '2', '1', 'Software Engineering', '2025-07-09 08:31:55'),
(111, 'Database Management Systems', '2', '1', 'Software Engineering', '2025-07-09 08:31:55'),
(112, 'Data Structures and Algorithms', '2', '1', 'Software Engineering', '2025-07-09 08:31:55'),
(113, 'Object Oriented Analysis and Design', '2', '1', 'Software Engineering', '2025-07-09 08:31:55'),
(114, 'Operating Systems', '2', '1', 'Software Engineering', '2025-07-09 08:31:55'),
(115, 'Rapid Application Development', '2', '1', 'Software Engineering', '2025-07-09 08:31:55'),
(116, 'Advanced Mathematics', '2', '1', 'Software Engineering', '2025-07-09 08:31:55'),
(117, 'Group Project Part 1', '1', '2', 'Software Engineering', '2025-07-09 08:31:55'),
(118, 'Essentials in Computer Networking', '1', '2', 'Software Engineering', '2025-07-09 08:31:55'),
(119, 'Formal Methods in Software Development', '1', '2', 'Software Engineering', '2025-07-09 08:31:55'),
(120, 'Web Technologies', '1', '2', 'Software Engineering', '2025-07-09 08:31:55'),
(121, 'Software Design and Architecture', '1', '2', 'Software Engineering', '2025-07-09 08:31:55'),
(122, 'Mathematics for Computing', '1', '2', 'Software Engineering', '2025-07-09 08:31:55'),
(123, 'Artificial Intelligence', '1', '2', 'Software Engineering', '2025-07-09 08:31:55'),
(124, 'Essentials of Computer Law', '1', '2', 'Software Engineering', '2025-07-09 08:31:55'),
(125, 'Group Project Part 2', '2', '2', 'Software Engineering', '2025-07-09 08:31:55'),
(126, 'Fundamentals of Software Security', '2', '2', 'Software Engineering', '2025-07-09 08:31:55'),
(127, 'Software Testing and Validation', '2', '2', 'Software Engineering', '2025-07-09 08:31:55'),
(128, 'Human Computer Interaction', '2', '2', 'Software Engineering', '2025-07-09 08:31:55'),
(129, 'Software Project Management', '2', '2', 'Software Engineering', '2025-07-09 08:31:55'),
(130, 'Software Configuration Management', '2', '2', 'Software Engineering', '2025-07-09 08:31:55'),
(131, 'Industrial Inspection', '2', '2', 'Software Engineering', '2025-07-09 08:31:55'),
(132, 'Management Information Systems', '2', '2', 'Software Engineering', '2025-07-09 08:31:55'),
(133, 'Software Safety and Reliability', '1', '3', 'Software Engineering', '2025-07-09 08:31:55'),
(134, 'Social and Professional Issues in Information Technology', '1', '3', 'Software Engineering', '2025-07-09 08:31:55'),
(135, 'Software Process Management', '1', '3', 'Software Engineering', '2025-07-09 08:31:55'),
(136, 'Group Project in Hardware', '1', '3', 'Software Engineering', '2025-07-09 08:31:55'),
(137, 'Software Evolution', '1', '3', 'Software Engineering', '2025-07-09 08:31:55'),
(138, 'Enterprise Information Systems', '1', '3', 'Software Engineering', '2025-07-09 08:31:55'),
(139, 'Human Resource Management', '1', '3', 'Software Engineering', '2025-07-09 08:31:55'),
(140, 'Visual Computing', '1', '3', 'Software Engineering', '2025-07-09 08:31:55'),
(141, 'Introduction to Business Intelligence', '1', '3', 'Software Engineering', '2025-07-09 08:31:55'),
(142, 'High Performance Computing', '1', '3', 'Software Engineering', '2025-07-09 08:31:55'),
(143, 'System Development Project', '2', '3', 'Software Engineering', '2025-07-09 08:31:55'),
(144, 'Introduction to Distributed Computing', '2', '3', 'Software Engineering', '2025-07-09 08:31:55'),
(145, 'Software Quality Assurance', '2', '3', 'Software Engineering', '2025-07-09 08:31:55'),
(146, 'Advanced Database Management Systems', '2', '3', 'Software Engineering', '2025-07-09 08:31:55'),
(147, 'Software Design Patterns', '2', '3', 'Software Engineering', '2025-07-09 08:31:55'),
(148, 'Mobile Computing', '2', '3', 'Software Engineering', '2025-07-09 08:31:55'),
(149, 'Machine Learning', '2', '3', 'Software Engineering', '2025-07-09 08:31:55'),
(150, 'Game Designing and Development', '2', '3', 'Software Engineering', '2025-07-09 08:31:55'),
(151, 'Middleware Architecture', '2', '3', 'Software Engineering', '2025-07-09 08:31:55'),
(152, 'Social Computing', '2', '3', 'Software Engineering', '2025-07-09 08:31:55'),
(153, 'Semantic Web', '2', '3', 'Software Engineering', '2025-07-09 08:31:55'),
(154, 'Research Project Part I', '1', '4', 'Software Engineering', '2025-07-09 08:31:55'),
(155, 'Research Methodologies and Scientific Communication', '1', '4', 'Software Engineering', '2025-07-09 08:31:55'),
(156, 'Service Oriented Architecture', '1', '4', 'Software Engineering', '2025-07-09 08:31:55'),
(157, 'Software Engineering Economics', '1', '4', 'Software Engineering', '2025-07-09 08:31:55'),
(158, 'Cloud Computing', '1', '4', 'Software Engineering', '2025-07-09 08:31:55'),
(159, 'Big Data Technologies', '1', '4', 'Software Engineering', '2025-07-09 08:31:55'),
(160, 'Robotics', '1', '4', 'Software Engineering', '2025-07-09 08:31:55'),
(161, 'Selected Topics in Software Engineering', '1', '4', 'Software Engineering', '2025-07-09 08:31:55'),
(162, 'Natural Language Processing', '1', '4', 'Software Engineering', '2025-07-09 08:31:55'),
(163, 'Refactoring and Design', '1', '4', 'Software Engineering', '2025-07-09 08:31:55'),
(164, 'Emerging Trends in Computing', '1', '4', 'Software Engineering', '2025-07-09 08:31:55'),
(165, 'Industrial Training', '2', '4', 'Software Engineering', '2025-07-09 08:31:55'),
(166, 'Research Project Part II', '2', '4', 'Software Engineering', '2025-07-09 08:31:55'),
(167, 'Introductory Mathematics', '1', '1', 'Information Systems', '2025-07-09 08:32:47'),
(168, 'Fundamentals of Programming', '1', '1', 'Information Systems', '2025-07-09 08:32:47'),
(169, 'Principles of Management', '1', '1', 'Information Systems', '2025-07-09 08:32:47'),
(170, 'Introductory Statistics', '1', '1', 'Information Systems', '2025-07-09 08:32:47'),
(171, 'Fundamentals of Information Systems', '1', '1', 'Information Systems', '2025-07-09 08:32:47'),
(172, 'Introduction to Software Engineering', '1', '1', 'Information Systems', '2025-07-09 08:32:47'),
(173, 'Leadership & Human Skills Development', '1', '1', 'Information Systems', '2025-07-09 08:32:47'),
(174, 'Professional English', '1', '1', 'Information Systems', '2025-07-09 08:32:47'),
(175, 'Object Oriented Programming', '2', '1', 'Information Systems', '2025-07-09 08:32:47'),
(176, 'Database Management System', '2', '1', 'Information Systems', '2025-07-09 08:32:47'),
(177, 'Data Structures and Algorithms', '2', '1', 'Information Systems', '2025-07-09 08:32:47'),
(178, 'Advanced Software Engineering', '2', '1', 'Information Systems', '2025-07-09 08:32:47'),
(179, 'Economics & Accounting', '2', '1', 'Information Systems', '2025-07-09 08:32:47'),
(180, 'Rapid Application Development', '2', '1', 'Information Systems', '2025-07-09 08:32:47'),
(181, 'Business Communication', '2', '1', 'Information Systems', '2025-07-09 08:32:47'),
(182, 'Business Process Management', '1', '2', 'Information Systems', '2025-07-09 08:32:47'),
(183, 'Operations Management', '1', '2', 'Information Systems', '2025-07-09 08:32:47'),
(184, 'Marketing Management', '1', '2', 'Information Systems', '2025-07-09 08:32:47'),
(185, 'Information Systems Security', '1', '2', 'Information Systems', '2025-07-09 08:32:47'),
(186, 'Organizational Behaviour and Society', '1', '2', 'Information Systems', '2025-07-09 08:32:47'),
(187, 'System Administration and Maintenance', '1', '2', 'Information Systems', '2025-07-09 08:32:47'),
(188, 'Statistical Distribution and Inferences', '1', '2', 'Information Systems', '2025-07-09 08:32:47'),
(189, 'Enterprise Applications', '2', '2', 'Information Systems', '2025-07-09 08:32:47'),
(190, 'Information System Risk Management', '2', '2', 'Information Systems', '2025-07-09 08:32:47'),
(191, 'Introduction to Entrepreneurship and SMEs', '2', '2', 'Information Systems', '2025-07-09 08:32:47'),
(192, 'Business Intelligence', '2', '2', 'Information Systems', '2025-07-09 08:32:47'),
(193, 'Operating System Concepts', '2', '2', 'Information Systems', '2025-07-09 08:32:47'),
(194, 'Advanced Database Systems', '2', '2', 'Information Systems', '2025-07-09 08:32:47'),
(195, 'Industrial Inspection', '2', '2', 'Information Systems', '2025-07-09 08:32:47'),
(196, 'Personal Productivity with IS Technology', '2', '2', 'Information Systems', '2025-07-09 08:32:47'),
(197, 'Group Project Part 1', '1', '3', 'Information Systems', '2025-07-09 08:32:47'),
(198, 'Social and Professional Issues in Information Technology', '1', '3', 'Information Systems', '2025-07-09 08:32:47'),
(199, 'Agile Software Development', '1', '3', 'Information Systems', '2025-07-09 08:32:47'),
(200, 'Software Quality Assurance', '1', '3', 'Information Systems', '2025-07-09 08:32:47'),
(201, 'Design Patterns and Applications', '1', '3', 'Information Systems', '2025-07-09 08:32:47'),
(202, 'Research Methodologies', '1', '3', 'Information Systems', '2025-07-09 08:32:47'),
(203, 'Data Communication and Networks', '1', '3', 'Information Systems', '2025-07-09 08:32:47'),
(204, 'Software Engineering Economics', '1', '3', 'Information Systems', '2025-07-09 08:32:47'),
(205, 'Game Designing and Development', '1', '3', 'Information Systems', '2025-07-09 08:32:47'),
(206, 'Artificial Intelligence', '1', '3', 'Information Systems', '2025-07-09 08:32:47'),
(207, 'IT Procurement Management', '2', '3', 'Information Systems', '2025-07-09 08:32:47'),
(208, 'Group Project Part 2', '2', '3', 'Information Systems', '2025-07-09 08:32:47'),
(209, 'Digital Business', '2', '3', 'Information Systems', '2025-07-09 08:32:47'),
(210, 'Web-based Application Development', '2', '3', 'Information Systems', '2025-07-09 08:32:47'),
(211, 'E-Learning and Instructional Design', '2', '3', 'Information Systems', '2025-07-09 08:32:47'),
(212, 'Mobile Computing', '2', '3', 'Information Systems', '2025-07-09 08:32:47'),
(213, 'Machine Learning and Neural Computing', '2', '3', 'Information Systems', '2025-07-09 08:32:47'),
(214, 'Blockchain and Technologies', '2', '3', 'Information Systems', '2025-07-09 08:32:47'),
(215, 'Human Computer Interactions', '2', '3', 'Information Systems', '2025-07-09 08:32:47'),
(216, 'Middleware Architecture', '2', '3', 'Information Systems', '2025-07-09 08:32:47'),
(217, 'Research Project Part I', '1', '4', 'Information Systems', '2025-07-09 08:32:48'),
(218, 'Introduction to Distributed Systems', '1', '4', 'Information Systems', '2025-07-09 08:32:48'),
(219, 'Ethical Issues and Legal Aspects of Information Technology', '1', '4', 'Information Systems', '2025-07-09 08:32:48'),
(220, 'Human Resource Management', '1', '4', 'Information Systems', '2025-07-09 08:32:48'),
(221, 'Cloud Computing', '1', '4', 'Information Systems', '2025-07-09 08:32:48'),
(222, 'Data Mining and Applications', '1', '4', 'Information Systems', '2025-07-09 08:32:48'),
(223, 'Data Analytics', '1', '4', 'Information Systems', '2025-07-09 08:32:48'),
(224, 'Natural Language Processing', '1', '4', 'Information Systems', '2025-07-09 08:32:48'),
(225, 'Refactoring and Design', '1', '4', 'Information Systems', '2025-07-09 08:32:48'),
(226, 'High Performance Computing', '1', '4', 'Information Systems', '2025-07-09 08:32:48'),
(227, 'Industrial Training', '2', '4', 'Information Systems', '2025-07-09 08:32:48'),
(228, 'Research Project Part II', '2', '4', 'Information Systems', '2025-07-09 08:32:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pnumber` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT NULL,
  `year` enum('1st year','2nd year','3rd year','4th year') DEFAULT NULL,
  `signuptime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`fname`, `lname`, `department`, `username`, `email`, `pnumber`, `password`, `role`, `year`, `signuptime`) VALUES
('pasindu', 'Udana', 'Computer Science', 'pasindu1234', 'pasindy@gmai.com', '0719367720', '1234', 'user', NULL, NULL),
('Deshan', 'vikum', '', 'admin1', 'deshan@gmail.com', '0714251603', '1234', 'admin', NULL, NULL),
('Dylan', 'Jeewantha', 'SE', 'dylan123', 'dylan@gmail.com', '071968442', '123456', 'user', NULL, NULL),
('lasal', 'thuduwage', 'SE', 'lasal123', 'lasal@gmail.com', '0718596217', '123456', 'user', NULL, NULL),
('rashmi', 'praboda', 'SE', 'rashmi123', 'rashmi@gmail.com', '07894562', '7890', 'user', NULL, NULL),
('malithi', 'minodya', 'IS', 'malithi123', 'malithi@gmail.com', '0332245955', '1234', 'user', NULL, NULL),
('Gagani', 'Dissanayakla', '', 'admin2', 'g@gmail.com', '0718954632', '$2y$10$3VxVQ7jx6s85ERIrvFnLRew4Oa2pV8utFBmQCkwPvXtksJ8Uf9Rji', 'admin', NULL, NULL),
('Nethmi', 'Tanisha', 'CS', 'tani123', 'fc115530@foc.sjp.ac.lk', '0719367720', '123456', 'user', '', '2025-07-06 19:12:20'),
('rumeth sathidu', 'sdd', 'SE', 'rumeth', 'g@gmail.com', '07894562', '789', 'user', '3rd year', '2025-07-06 19:15:32'),
('tahksila', 'qqs', '', 'admin3', 'ds@gmail.com', '0748596312', '$2y$10$9R7lrurjdlEJcueVaa2VYuhE8u2U27YfG1zQ.WMFgk7c9M4uNT03i', 'admin', '', '2025-07-06 19:28:50'),
('tahksila', 'qqs', '', 'admin3', 'ds@gmail.com', '0748596312', '$2y$10$Ymz813kXpVGSnFc5KOedaeSOBQUeoPqBq3tJdKxTOhtnJ5pAO1FMi', 'admin', '', '2025-07-06 19:29:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lecture_notes`
--
ALTER TABLE `lecture_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lecture_notes`
--
ALTER TABLE `lecture_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
