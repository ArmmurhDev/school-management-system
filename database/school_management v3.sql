-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2026 at 12:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_sessions`
--

CREATE TABLE `academic_sessions` (
  `session_id` int(11) NOT NULL,
  `session_name` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_sessions`
--

INSERT INTO `academic_sessions` (`session_id`, `session_name`, `created_at`) VALUES
(1, '2025-2026', '2026-04-02 18:06:02'),
(2, '2026-2027', '2026-04-02 18:06:02'),
(3, '2027-2028', '2026-04-02 18:06:02');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `email`, `password`, `full_name`, `created_at`) VALUES
(1, 'admin', 'admin@school.com', '$2y$10$6cEEL1eNtoliFZL7BVKlLeTlBjADhegOG3LyQzRWTX3eLCQf9bm.C', 'Super Administrator', '2026-02-09 22:58:07');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `class_name`) VALUES
(1, 'SS1'),
(2, 'SS2'),
(3, 'SS3');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `level` varchar(20) DEFAULT 'beginner',
  `class_name` varchar(10) DEFAULT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `schedule` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `description`, `level`, `class_name`, `instructor_id`, `schedule`, `created_at`) VALUES
(1, 'Mathematics', 'Mathematics builds a solid foundation using algebra, geometry, and logic to solve complex real-world problems.\r\n', 'beginner', 'SS1', 3, 'Mon & Wed 10am - 12pm', '2026-04-08 02:59:23');

-- --------------------------------------------------------

--
-- Table structure for table `course_registrations`
--

CREATE TABLE `course_registrations` (
  `registration_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `qualification` varchar(100) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `full_name`, `email`, `password`, `qualification`, `subject`, `position`, `phone`, `image`, `created_at`) VALUES
(1, 'Mr. John Teacher', 'teacher@school.com', '$2y$10$MYonqxeZIOp11tfHxjB9ReN66V.H8AOLJh.bJhYbUEkyP1xz/E2Oi', 'B.Ed Mathematics', 'Lit-in-english', 'Staff', '1234567890', NULL, '2026-02-09 22:58:10'),
(2, 'Ms. Sarah Staff', 'sarah@school.com', '$2y$10$MYonqxeZIOp11tfHxjB9ReN66V.H8AOLJh.bJhYbUEkyP1xz/E2Oi', 'M.Sc Physics', '', 'Registra', '0987654321', NULL, '2026-02-09 22:58:10'),
(3, 'Abdulrauf musa', 'abdulraufmusa276@gmail.com', '$2y$10$MpBppCCbTFvOLL9WmYcsi.ouWvBWb6ga4pOG8UhqEVMqs24QfhqJm', 'B.sc Biology', 'Biology', 'Staff', '8027827037', 'staff_1775426306_69d2db027cfc9.png', '2026-04-05 21:58:26'),
(4, 'musa musa', 'mm@school.com', '$2y$10$ecygG43Ge5d90qJ5iRfYO.DmXx1QCb09b7KKPNjFj/QlZSDevztm6', 'M.Sc Physics', 'Physics', 'Staff', '08023561545', 'staff_1775685646_69d6d00e896fd.png', '2026-04-08 22:00:46');

-- --------------------------------------------------------

--
-- Table structure for table `staff_positions`
--

CREATE TABLE `staff_positions` (
  `position_id` int(11) NOT NULL,
  `position_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_positions`
--

INSERT INTO `staff_positions` (`position_id`, `position_name`) VALUES
(1, 'Academic Director'),
(4, 'Administrator'),
(2, 'Registra'),
(3, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `admission_no` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `age` int(3) NOT NULL,
  `parent_guardian` varchar(100) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `session_of_year` varchar(20) NOT NULL,
  `class_name` varchar(10) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `full_name`, `admission_no`, `email`, `password`, `age`, `parent_guardian`, `contact_number`, `session_of_year`, `class_name`, `image`, `created_at`) VALUES
(1, 'Alice Student', 'TT/23/001', 'student@school.com', '$2y$10$zUt9Ei5euIj5XVmo3Dp0vOMyF4dSbgeAZooiwo0hZZONf0FGc./Q.', 15, 'Robert Student', '1122334455', '2026-2027', 'SS2', 'alice.jpg', '2026-03-31 12:53:25'),
(2, 'Bob Scholar', 'STD002', 'bob@student.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 16, 'Mary Scholar', '5544332211', '2026-2027', 'SS3', 'bob.jpg', '2026-03-31 12:53:25'),
(3, 'Ummu-salma Musa', 'TT/26/006', 'abdulraufmusa276@gmail.com', '$2y$10$vb8z.mL7DKP/.vsbKUbcCu.P42yCWLj1Lq8mXECjA.SEBHjtA861K', 16, 'Musa Hassan', '89876543218', '2026-2027', 'SS1', 'std_1775183777_69cf27a1ec919.png', '2026-04-03 02:36:18');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_name`) VALUES
(10, 'Accounting'),
(8, 'Agric Culture'),
(5, 'Biology'),
(4, 'Chemistry'),
(7, 'Economics'),
(2, 'English'),
(6, 'Geographic'),
(9, 'ICT'),
(11, 'Lit-in-english'),
(1, 'Mathematics'),
(3, 'Physics');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_sessions`
--
ALTER TABLE `academic_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD UNIQUE KEY `session_name` (`session_name`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`),
  ADD UNIQUE KEY `class_name` (`class_name`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `instructor_id` (`instructor_id`);

--
-- Indexes for table `course_registrations`
--
ALTER TABLE `course_registrations`
  ADD PRIMARY KEY (`registration_id`),
  ADD UNIQUE KEY `student_course` (`student_id`,`course_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `staff_positions`
--
ALTER TABLE `staff_positions`
  ADD PRIMARY KEY (`position_id`),
  ADD UNIQUE KEY `position_name` (`position_name`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `admission_no` (`admission_no`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`),
  ADD UNIQUE KEY `subject_name` (`subject_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_sessions`
--
ALTER TABLE `academic_sessions`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_registrations`
--
ALTER TABLE `course_registrations`
  MODIFY `registration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff_positions`
--
ALTER TABLE `staff_positions`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
