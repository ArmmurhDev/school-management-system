-- Database Schema for School Management System
-- Version 1.0

-- --------------------------------------------------------
-- Database Creation
-- --------------------------------------------------------
-- CREATE DATABASE IF NOT EXISTS school_management;
-- USE school_management;

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
  `position` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
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
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`student_id`),
  UNIQUE KEY `admission_no` (`admission_no`),
  UNIQUE KEY `email` (`email`)
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
INSERT INTO `staff` (`full_name`, `email`, `password`, `qualification`, `position`, `phone`) VALUES
('Mr. John Teacher', 'teacher@school.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'B.Ed Mathematics', 'Senior Teacher', '1234567890'),
('Ms. Sarah Staff', 'sarah@school.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'M.Sc Physics', 'Lab Assistant', '0987654321');

--
-- Demo Student
-- Admission No: STD001
-- Password: password123
--
INSERT INTO `students` (`full_name`, `admission_no`, `email`, `password`, `age`, `parent_guardian`, `contact_number`, `session_of_year`, `image`) VALUES
('Alice Student', 'STD001', 'alice@student.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 15, 'Robert Student', '1122334455', '2023-2024', 'alice.jpg'),
('Bob Scholar', 'STD002', 'bob@student.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 16, 'Mary Scholar', '5544332211', '2023-2024', 'bob.jpg');
