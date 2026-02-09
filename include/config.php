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

    // Optional: Log successful connection (for debugging only, remove in production)
    // error_log("Database connected successfully.");

} catch (PDOException $e) {
    // Handle connection errors
    // IN PRODUCTION: Log the error and show a generic message to the user
    // DO NOT echo the specific error message to the user in a live environment
    
    error_log("Connection failed: " . $e->getMessage());
    die("Database connection failed. Please contact the administrator.");
}
?>
