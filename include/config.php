<?php
/**
 * Database Configuration File
 * 
 * This file handles the database connection using PDO (PHP Data Objects).
 * PDO is recommended for security as it supports prepared statements,
 * which help prevent SQL injection attacks.
 */

// Database Credentials
// Update these values according to your environment
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'school_management');


// Paystack API Keys
define('PAYSTACK_PUBLIC_KEY', 'pk_test_193f896988520fc7c28208ad3bde12332796f586');
define('PAYSTACK_SECRET_KEY', 'sk_test_9a7c19bf727859be993217f470baab8f91f9272e');

// Database Connection
try {
    // Create a new PDO instance
    // The DSN (Data Source Name) string defines the database type, host, and name
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    
    // PDO options for security and error handling
    $options = [
        // Enable exception handling for database errors
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        
        // Set default fetch mode to associative array
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        
        // Disable emulated prepared statements for better security
        // This ensures the database native prepared statements are used
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    // Establish the connection
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);

    // Auto-update academic sessions
    function getAcademicSessions($pdo) {
        // Ensure table exists
        $pdo->exec("CREATE TABLE IF NOT EXISTS `academic_sessions` (
            `session_id` int(11) NOT NULL AUTO_INCREMENT,
            `session_name` varchar(20) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
            PRIMARY KEY (`session_id`),
            UNIQUE KEY `session_name` (`session_name`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

        $currentYear = date('Y');
        $nextYear = $currentYear + 1;
        
        // Define sessions to check/add (current and next)
        $sessionsToCheck = [
            ($currentYear - 1) . "-" . $currentYear,
            $currentYear . "-" . $nextYear,
            $nextYear . "-" . ($nextYear + 1)
        ];

        foreach ($sessionsToCheck as $session) {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM academic_sessions WHERE session_name = ?");
            $stmt->execute([$session]);
            if ($stmt->fetchColumn() == 0) {
                $stmt = $pdo->prepare("INSERT INTO academic_sessions (session_name) VALUES (?)");
                $stmt->execute([$session]);
            }
        }

        $stmt = $pdo->query("SELECT session_name FROM academic_sessions ORDER BY session_name DESC");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    function getStaffPositions($pdo) {
        // Ensure staff table has the necessary columns (migration)
        $migrations = [
            'subject' => "ALTER TABLE staff ADD COLUMN subject VARCHAR(100) DEFAULT NULL AFTER qualification",
            'phone' => "ALTER TABLE staff ADD COLUMN phone VARCHAR(20) DEFAULT NULL AFTER position",
            'image' => "ALTER TABLE staff ADD COLUMN image VARCHAR(255) DEFAULT NULL AFTER phone"
        ];

        foreach ($migrations as $column => $sql) {
            try {
                $pdo->query("SELECT $column FROM staff LIMIT 1");
            } catch (Exception $e) {
                $pdo->exec($sql);
            }
        }

        $pdo->exec("CREATE TABLE IF NOT EXISTS `staff_positions` (
            `position_id` int(11) NOT NULL AUTO_INCREMENT,
            `position_name` varchar(50) NOT NULL,
            PRIMARY KEY (`position_id`),
            UNIQUE KEY `position_name` (`position_name`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

        $positions = ['Academic Director', 'Registra', 'Staff', 'Administrator'];
        foreach ($positions as $pos) {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM staff_positions WHERE position_name = ?");
            $stmt->execute([$pos]);
            if ($stmt->fetchColumn() == 0) {
                $stmt = $pdo->prepare("INSERT INTO staff_positions (position_name) VALUES (?)");
                $stmt->execute([$pos]);
            }
        }

        $stmt = $pdo->query("SELECT position_name FROM staff_positions ORDER BY position_name ASC");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    function getSubjects($pdo) {
        $pdo->exec("CREATE TABLE IF NOT EXISTS `subjects` (
            `subject_id` int(11) NOT NULL AUTO_INCREMENT,
            `subject_name` varchar(50) NOT NULL,
            PRIMARY KEY (`subject_id`),
            UNIQUE KEY `subject_name` (`subject_name`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

        $subjects = ['Mathematics', 'English', 'Physics', 'Chemistry', 'Biology', 'Geographic', 'Economics', 'Agric Culture', 'ICT', 'Accounting', 'Lit-in-english'];
        foreach ($subjects as $sub) {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM subjects WHERE subject_name = ?");
            $stmt->execute([$sub]);
            if ($stmt->fetchColumn() == 0) {
                $stmt = $pdo->prepare("INSERT INTO subjects (subject_name) VALUES (?)");
                $stmt->execute([$sub]);
            }
        }

        $stmt = $pdo->query("SELECT subject_name FROM subjects ORDER BY subject_name ASC");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    function getClasses($pdo) {
        $pdo->exec("CREATE TABLE IF NOT EXISTS `classes` (
            `class_id` int(11) NOT NULL AUTO_INCREMENT,
            `class_name` varchar(10) NOT NULL,
            PRIMARY KEY (`class_id`),
            UNIQUE KEY `class_name` (`class_name`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

        $classes = ['SS1', 'SS2', 'SS3'];
        foreach ($classes as $c) {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM classes WHERE class_name = ?");
            $stmt->execute([$c]);
            if ($stmt->fetchColumn() == 0) {
                $stmt = $pdo->prepare("INSERT INTO classes (class_name) VALUES (?)");
                $stmt->execute([$c]);
            }
        }

        $stmt = $pdo->query("SELECT class_name FROM classes ORDER BY class_name ASC");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    function getAcademicTerms($pdo) {
        $pdo->exec("CREATE TABLE IF NOT EXISTS `academic_terms` (
            `term_id` int(11) NOT NULL AUTO_INCREMENT,
            `term_name` varchar(20) NOT NULL,
            PRIMARY KEY (`term_id`),
            UNIQUE KEY `term_name` (`term_name`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

        $terms = ['First Term', 'Second Term', 'Third Term'];
        foreach ($terms as $t) {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM academic_terms WHERE term_name = ?");
            $stmt->execute([$t]);
            if ($stmt->fetchColumn() == 0) {
                $stmt = $pdo->prepare("INSERT INTO academic_terms (term_name) VALUES (?)");
                $stmt->execute([$t]);
            }
        }

        $stmt = $pdo->query("SELECT term_name FROM academic_terms ORDER BY term_id ASC");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    // Auto-create school_fees table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `school_fees` (
        `fee_id` int(11) NOT NULL AUTO_INCREMENT,
        `fee_amount` decimal(10,2) NOT NULL,
        `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        PRIMARY KEY (`fee_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    // Insert default fee if table is empty
    $stmt = $pdo->query("SELECT COUNT(*) FROM school_fees");
    if ($stmt->fetchColumn() == 0) {
        $pdo->exec("INSERT INTO school_fees (fee_id, fee_amount) VALUES (1, 47000.00)");
    }

    // Auto-create settings table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `settings` (
        `setting_key` varchar(50) NOT NULL,
        `setting_value` varchar(255) NOT NULL,
        PRIMARY KEY (`setting_key`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    // Ensure results_released setting exists
    $pdo->exec("INSERT IGNORE INTO settings (setting_key, setting_value) VALUES ('results_released', '0')");

    // Auto-create payments table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `payments` (
        `payment_id` int(11) NOT NULL AUTO_INCREMENT,
        `student_id` int(11) NOT NULL,
        `amount` decimal(10,2) NOT NULL,
        `reference` varchar(100) NOT NULL,
        `status` varchar(20) NOT NULL DEFAULT 'pending',
        `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`payment_id`),
        UNIQUE KEY `reference` (`reference`),
        KEY `student_id` (`student_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    // Migration for students table columns
    $student_cols = [
        'class_name' => "ALTER TABLE students ADD COLUMN class_name VARCHAR(10) DEFAULT NULL AFTER session_of_year",
        'session_of_year' => "ALTER TABLE students ADD COLUMN session_of_year VARCHAR(20) DEFAULT NULL AFTER contact_number"
    ];

    foreach ($student_cols as $col => $sql) {
        try {
            $pdo->query("SELECT $col FROM students LIMIT 1");
        } catch (Exception $e) {
            $pdo->exec($sql);
        }
    }

    // Migration for admin table columns
    $admin_cols = [
        'phone' => "ALTER TABLE admin ADD COLUMN phone VARCHAR(20) DEFAULT NULL AFTER email",
        'image' => "ALTER TABLE admin ADD COLUMN image VARCHAR(255) DEFAULT NULL AFTER password"
    ];

    foreach ($admin_cols as $col => $sql) {
        try {
            $pdo->query("SELECT $col FROM admin LIMIT 1");
        } catch (Exception $e) {
            $pdo->exec($sql);
        }
    }

    // Auto-create promotions table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `promotions` (
        `promotion_id` int(11) NOT NULL AUTO_INCREMENT,
        `student_id` int(11) NOT NULL,
        `from_class` varchar(10) NOT NULL,
        `to_class` varchar(10) NOT NULL,
        `session` varchar(20) NOT NULL,
        `promotion_date` timestamp NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`promotion_id`),
        KEY `student_id` (`student_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    // Auto-create messages table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `messages` (
        `message_id` int(11) NOT NULL AUTO_INCREMENT,
        `sender_id` int(11) NOT NULL,
        `sender_role` enum('admin', 'staff') NOT NULL,
        `recipient_id` int(11) DEFAULT NULL, -- NULL means 'All Students'
        `message_text` text NOT NULL,
        `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`message_id`),
        KEY `recipient_id` (`recipient_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

} catch (PDOException $e) {
    // Handle connection errors
    error_log("Database connection failed: " . $e->getMessage());
    die("Database connection failed. Please contact the administrator.");
}
?>
