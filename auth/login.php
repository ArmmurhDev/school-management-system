<?php
/**
 * Login Script
 * 
 * This script handles user authentication for Admin, Staff, and Students.
 * It uses a secure PDO connection and password hashing (bcrypt).
 */

// Start the session to manage user login state
require_once 'session.php';

// If user is already logged in, redirect to their dashboard
redirectIfLoggedIn();

// Include the secure database configuration
require_once '../include/config.php';

// ... (previous HTTPS check comment)

$error = '';

// Check if the form is submitted
if (isset($_POST['login'])) {
    
    // Sanitize input
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password']; 

    if (empty($email) || empty($password)) {
        $error = "Please enter both email and password.";
    } else {
        try {
            // 1. Check Admin Table
            $stmt = $pdo->prepare("SELECT * FROM admin WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $admin = $stmt->fetch();

            if ($admin && password_verify($password, $admin['password'])) {
                // Regenerate session ID to prevent fixation
                session_regenerate_id(true);
                
                // Login Success: Admin
                $_SESSION['user_id'] = $admin['admin_id'];
                $_SESSION['role'] = 'admin';
                $_SESSION['full_name'] = $admin['full_name'];
                
                header("Location: ../admin/dashboard.php");
                exit;
            }

            // 2. Check Staff Table
            $stmt = $pdo->prepare("SELECT * FROM staff WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $staff = $stmt->fetch();

            if ($staff && password_verify($password, $staff['password'])) {
                // Regenerate session ID
                session_regenerate_id(true);

                // Login Success: Staff
                $_SESSION['user_id'] = $staff['staff_id'];
                $_SESSION['role'] = 'staff';
                $_SESSION['full_name'] = $staff['full_name'];

                header("Location: ../staff/dashboard.php");
                exit;
            }

            // 3. Check Students Table
            $stmt = $pdo->prepare("SELECT * FROM students WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $student = $stmt->fetch();

            if ($student && password_verify($password, $student['password'])) {
                // Regenerate session ID
                session_regenerate_id(true);

                // Login Success: Student
                $_SESSION['user_id'] = $student['student_id'];
                $_SESSION['role'] = 'student';
                $_SESSION['full_name'] = $student['full_name'];

                header("Location: ../Student/dashboard.php");
                exit;
            }

            // If we reach here, no user was found or password was incorrect
            $error = "Invalid email or password.";

        } catch (PDOException $e) {
            // Log the error securely
            error_log("Login Error: " . $e->getMessage());
            $error = "An system error occurred. Please try again later.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - School Management System</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>

    <div class="auth-container">
        <!-- Left Side: Banner -->
        <div class="auth-banner">
            <i class="fas fa-graduation-cap" style="font-size: 4rem; margin-bottom: 20px;"></i>
            <h2>Welcome Back!</h2>
            <p>Access your dashboard to manage students, attendances, and more. Education is the passport to the future.</p>
        </div>

        <!-- Right Side: Login Form -->
        <div class="auth-form-container">
            <div class="auth-header">
                <h1>Login</h1>
                <p>Please enter your details to sign in.</p>
            </div>

            <form action="" method="POST">
                <!-- Display Error Message -->
                <?php if (!empty($error)): ?>
                    <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px; border: 1px solid #f5c6cb;">
                        <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    <i class="fas fa-envelope input-icon"></i>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                    <i class="fas fa-lock input-icon"></i>
                </div>

                <div class="forgot-password">
                    <a href="forgot-password.php">Forgot Password?</a>
                </div>

                <button type="submit" name="login" class="btn-auth">Sign In</button>
            </form>

            <div class="auth-links">
                <p>Don't have an account? <a href="register.php">Create Account</a></p>
                <p style="margin-top: 10px;"><a href="../index.php"><i class="fas fa-arrow-left"></i> Back to Home</a></p>
            </div>
        </div>
    </div>

</body>
</html>
