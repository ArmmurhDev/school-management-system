<?php
/**
 * Session Management & Access Control
 * 
 * This file handles session initialization and provides helper functions
 * to enforce access control based on user roles.
 */

// Set secure session parameters BEFORE starting the session
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_samesite', 'Lax');
// ini_set('session.cookie_secure', 1); // Enable this if using HTTPS

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Check if user is logged in and has the required role.
 * Redirects to login page if unauthorized.
 * 
 * @param string|array $required_roles The role(s) allowed to access the page.
 * @param string $login_path Path to the login page relative to the calling script.
 */
function checkAccess($required_roles, $login_path = '../auth/login.php') {
    // 1. Check if user is logged in
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
        header("Location: $login_path");
        exit;
    }

    // 2. Check if user role matches requirements
    if (is_array($required_roles)) {
        if (!in_array($_SESSION['role'], $required_roles)) {
            handleUnauthorized();
        }
    } else {
        if ($_SESSION['role'] !== $required_roles) {
            handleUnauthorized();
        }
    }
}

/**
 * Handle unauthorized access attempts.
 */
function handleUnauthorized() {
    // Redirect to home or show an error
    echo "<div style='text-align:center; margin-top:50px; font-family:sans-serif;'>
            <h1>403 Forbidden</h1>
            <p>You do not have permission to access this page.</p>
            <a href='../index.php'>Return to Home</a>
          </div>";
    exit;
}

/**
 * Helper to check if a user is already logged in (used on login/register pages).
 */
function redirectIfLoggedIn() {
    if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
        switch ($_SESSION['role']) {
            case 'admin':
                header("Location: ../admin/dashboard.php");
                break;
            case 'staff':
                header("Location: ../staff/dashboard.php");
                break;
            case 'student':
                header("Location: ../Student/dashboard.php");
                break;
        }
        exit;
    }
}
?>
