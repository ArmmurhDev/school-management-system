<?php
require_once '../auth/session.php';
checkAccess('student');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages - T&T School Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/student-dashboard.css">
    <style>
        .messages-container {
            background: white;
            border-radius: 15px;
            box-shadow: var(--shadow);
            padding: 30px;
            text-align: center;
            margin-top: 50px;
        }
        .messages-container i {
            font-size: 4rem;
            color: var(--primary-light);
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include '../include/student-sidebar.php'; ?>
        <div class="overlay" id="overlay"></div>
        <div class="main-content" id="mainContent">
            <div class="top-header">
                <div class="header-left">
                    <button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
                    <div class="page-title"><h1>Messages</h1></div>
                </div>
            </div>
            <div class="dashboard-content">
                <div class="messages-container">
                    <i class="fas fa-envelope-open-text"></i>
                    <h2>Messages coming soon!</h2>
                    <p>The messaging system is currently under maintenance. Please check back later.</p>
                </div>
                <div class="dashboard-footer">
                    <p>&copy; 2023 T&T School Management System. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const menuToggle = document.getElementById('menuToggle');
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });
    </script>
</body>
</html>
