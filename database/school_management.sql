-- Database Schema for School Management System
-- Version 1.0

-- --------------------------------------------------------
-- Database Creation
-- --------------------------------------------------------
-- CREATE DATABASE IF NOT EXISTS school_management;
-- USE school_management;

CREATE TABLE IF NOT EXISTS `academic_sessions` (
  `session_id` int(11) NOT NULL AUTO_INCREMENT,
  `session_name` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`session_id`),
  UNIQUE KEY `session_name` (`session_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `staff_positions` (
  `position_id` int(11) NOT NULL AUTO_INCREMENT,
  `position_name` varchar(50) NOT NULL,
  PRIMARY KEY (`position_id`),
  UNIQUE KEY `position_name` (`position_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `subjects` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(50) NOT NULL,
  PRIMARY KEY (`subject_id`),
  UNIQUE KEY `subject_name` (`subject_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Demo Data for Positions and Subjects
--
INSERT INTO `staff_positions` (`position_name`) VALUES
('Academic Director'),
('Registra'),
('Staff'),
('Administrator');

INSERT INTO `subjects` (`subject_name`) VALUES
('Mathematics'),
('English'),
('Physics'),
('Chemistry'),
('Biology'),
('Geographic'),
('Economics'),
('Agric Culture'),
('ICT'),
('Accounting'),
('Lit-in-english');

--
-- Demo Sessions
--
INSERT INTO `academic_sessions` (`session_name`) VALUES
('2024-2025'),
('2025-2026'),
('2026-2027');

-- --------------------------------------------------------
-- Table structure for table `admin`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table structure for table `staff`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `staff` (
  `staff_id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `qualification` varchar(100) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`staff_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table structure for table `students`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `students` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `admission_no` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `age` int(3) NOT NULL,
  `parent_guardian` varchar(100) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `session_of_year` varchar(20) NOT NULL,
  `class_name` varchar(10) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`student_id`),
  UNIQUE KEY `admission_no` (`admission_no`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `classes` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(10) NOT NULL,
  PRIMARY KEY (`class_id`),
  UNIQUE KEY `class_name` (`class_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `classes` (`class_name`) VALUES ('SS1'), ('SS2'), ('SS3');

CREATE TABLE IF NOT EXISTS `courses` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `level` varchar(20) DEFAULT 'beginner',
  `class_name` varchar(10) DEFAULT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `schedule` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`course_id`),
  KEY `instructor_id` (`instructor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `course_registrations` (
  `registration_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`registration_id`),
  UNIQUE KEY `student_course` (`student_id`, `course_id`),
  KEY `student_id` (`student_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `student_notes` (
  `note_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `note_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`note_id`),
  KEY `student_id` (`student_id`),
  KEY `staff_id` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Demo Data
-- --------------------------------------------------------

--
-- Demo Admin
-- Username: admin
-- Email: admin@school.com
-- Password: password123 (Hash: $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi)
--
INSERT INTO `admin` (`username`, `email`, `password`, `full_name`) VALUES
('admin', 'admin@school.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Super Administrator');

--
-- Demo Staff
-- Email: teacher@school.com
-- Password: password123
--
INSERT INTO `staff` (`full_name`, `email`, `password`, `qualification`, `subject`, `position`, `phone`) VALUES
('Mr. John Teacher', 'teacher@school.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'B.Ed Mathematics', 'Mathematics', 'Senior Teacher', '1234567890'),
('Ms. Sarah Staff', 'sarah@school.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'M.Sc Physics', 'Physics', 'Lab Assistant', '0987654321');

--
-- Demo Student
-- Admission No: STD001
-- Password: password123
--
INSERT INTO `students` (`full_name`, `admission_no`, `email`, `password`, `age`, `parent_guardian`, `contact_number`, `session_of_year`, `image`) VALUES
('Alice Student', 'STD001', 'alice@student.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 15, 'Robert Student', '1122334455', '2023-2024', 'alice.jpg'),
('Bob Scholar', 'STD002', 'bob@student.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 16, 'Mary Scholar', '5544332211', '2023-2024', 'bob.jpg');
;
