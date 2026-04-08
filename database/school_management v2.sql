-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2026 at 07:05 PM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `admission_no` (`admission_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
