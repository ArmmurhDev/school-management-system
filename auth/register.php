<?php
require_once 'session.php';
redirectIfLoggedIn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - School Management System</title>
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
            <i class="fas fa-user-plus" style="font-size: 4rem; margin-bottom: 20px;"></i>
            <h2>Join Us Today!</h2>
            <p>Create your account to start your journey. Unlock a world of learning and management tools.</p>
        </div>

        <!-- Right Side: Registration Form -->
        <div class="auth-form-container">
            <div class="auth-header">
                <h1>Create Account</h1>
                <p>Fill in the details below to register.</p>
            </div>

            <form action="" method="POST">
                <!-- Example PHP error/success display can go here -->

                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input type="text" id="fullname" name="fullname" class="form-control" placeholder="John Doe" required>
                    <i class="fas fa-user input-icon"></i>
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="example@email.com" required>
                    <i class="fas fa-envelope input-icon"></i>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Create a password" required>
                    <i class="fas fa-lock input-icon"></i>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm your password" required>
                    <i class="fas fa-lock input-icon"></i>
                </div>

                <button type="submit" name="register" class="btn-auth">Register</button>
            </form>

            <div class="auth-links">
                <p>Already have an account? <a href="login.php">Sign In</a></p>
                <p style="margin-top: 10px;"><a href="../index.php"><i class="fas fa-arrow-left"></i> Back to Home</a></p>
            </div>
        </div>
    </div>

</body>
</html>
