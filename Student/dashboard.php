<?php
require_once '../auth/session.php';
require_once '../include/config.php';
checkAccess('student');

$student_id = $_SESSION['user_id'];

// Check if results are released
$stmt = $pdo->query("SELECT setting_value FROM settings WHERE setting_key = 'results_released'");
$isReleased = $stmt->fetchColumn() == '1';

// Fetch average if released
$average = 0;
if ($isReleased) {
    $stmt = $pdo->prepare("SELECT score FROM student_results WHERE student_id = ?");
    $stmt->execute([$student_id]);
    $results = $stmt->fetchAll(PDO::FETCH_COLUMN);
    $count = count($results);
    if ($count > 0) {
        $average = round(array_sum($results) / $count, 1);
    }
}

// Fetch message count from staff (last 3 days only)
$stmt = $pdo->prepare("SELECT COUNT(*) FROM messages WHERE sender_role = 'staff' AND (recipient_id = ? OR recipient_id IS NULL) AND created_at >= NOW() - INTERVAL 3 DAY");
$stmt->execute([$student_id]);
$messageCount = $stmt->fetchColumn();

// Fetch student current class
$stmt = $pdo->prepare("SELECT class_name FROM students WHERE student_id = ?");
$stmt->execute([$student_id]);
$studentClass = $stmt->fetchColumn() ?: 'N/A';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - T&T School Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/student-dashboard.css">
    <style>
        /* Dashboard Content */
        .dashboard-content {
            padding: 30px;
        }
        
        /* Welcome Banner */
        .welcome-banner {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-medium));
            border-radius: 15px;
            padding: 30px;
            color: var(--white);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 10px 20px rgba(0, 51, 102, 0.2);
        }
        
        .welcome-text h2 {
            color: var(--white);
            font-size: 1.8rem;
            margin-bottom: 10px;
        }
        
        .welcome-text p {
            opacity: 0.9;
            max-width: 600px;
        }
        
        .welcome-stats {
            display: flex;
            gap: 30px;
            text-align: center;
        }
        
        .stat-item h3 {
            color: var(--white);
            font-size: 2rem;
            margin-bottom: 5px;
        }
        
        .stat-item p {
            font-size: 0.9rem;
            opacity: 0.8;
        }
        
        /* Quick Stats */
        .quick-stats {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 15px var(--shadow);
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            border-left: 5px solid var(--primary-medium);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 51, 102, 0.15);
        }
        
        .stat-card.grades {
            border-left-color: var(--accent-blue);
        }
        
        .stat-card.attendance {
            border-left-color: var(--success);
        }

        .stat-card.class {
            border-left-color: var(--primary-medium);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            font-size: 1.8rem;
        }
        
        .stat-card.grades .stat-icon {
            background-color: rgba(30, 136, 229, 0.1);
            color: var(--accent-blue);
        }
        
        .stat-card.attendance .stat-icon {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }

        .stat-card.class .stat-icon {
            background-color: rgba(0, 51, 102, 0.1);
            color: var(--primary-medium);
        }
        
        .stat-info h3 {
            font-size: 2rem;
            margin-bottom: 5px;
        }
        
        .stat-info p {
            color: var(--text-light);
            font-size: 0.95rem;
        }
        
        /* Dashboard Card Base */
        .dashboard-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 15px var(--shadow);
            margin-bottom: 30px;
            height: auto;
        }
        
        /* Quick Links */
        .quick-links {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .link-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 5px 15px var(--shadow);
            transition: all 0.3s ease;
            text-decoration: none;
            color: var(--text-dark);
        }
        
        .link-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 51, 102, 0.15);
            background-color: var(--light-bg);
        }
        
        .link-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: var(--light-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 1.5rem;
            color: var(--primary-medium);
        }
        
        .link-card:hover .link-icon {
            background-color: var(--primary-medium);
            color: var(--white);
        }
        
        .link-card h4 {
            font-size: 1.1rem;
            margin-bottom: 8px;
        }
        
        .link-card p {
            font-size: 0.9rem;
            color: var(--text-light);
        }
        
        /* Footer */
        .dashboard-footer {
            padding: 20px 30px;
            text-align: center;
            color: var(--text-light);
            font-size: 0.9rem;
            border-top: 1px solid #eee;
            background-color: var(--white);
        }
        
        /* Responsive Styles */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .menu-toggle {
                display: block;
            }
            
            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 99;
                display: none;
            }
            
            .overlay.active {
                display: block;
            }
            
            .quick-stats {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .quick-links {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .quick-stats {
                grid-template-columns: 1fr;
            }
            
            .top-header {
                padding: 20px;
            }
            
            .dashboard-content {
                padding: 20px;
            }
            
            .welcome-banner {
                padding: 25px;
            }
            
            .welcome-text h2 {
                font-size: 1.5rem;
            }
            
            .quick-links {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 576px) {
            .header-right {
                display: none;
            }
            
            .stat-card {
                padding: 20px;
            }
            
            .stat-icon {
                width: 50px;
                height: 50px;
                font-size: 1.5rem;
                margin-right: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <?php include '../include/student-sidebar.php'; ?>
        
        <!-- Overlay for mobile -->
        <div class="overlay" id="overlay"></div>
        
        <!-- Main Content -->
        <div class="main-content" id="mainContent">
            <!-- Top Header -->
            <div class="top-header">
                <div class="header-left">
                    <button class="menu-toggle" id="menuToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="page-title">
                        <h1>Student Dashboard</h1>
                    </div>
                </div>
                
                <div class="header-right">
                    <div class="header-action" id="searchBtn">
                        <i class="fas fa-search"></i>
                    </div>
                    
                    <div class="header-action" id="notificationBtn">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </div>
                    
                    <div class="header-action" id="messagesBtn" onclick="window.location.href='student-messages.php'" style="cursor: pointer;">
                        <i class="fas fa-envelope"></i>
                        <span class="notification-badge"><?php echo $messageCount; ?></span>
                    </div>
                    
                    <div class="header-action" id="profileBtn">
                        <i class="fas fa-user-circle"></i>
                    </div>
                </div>
            </div>
            
            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <?php
                // Set the default timezone
                date_default_timezone_set('Africa/Lagos');
                
                $hour = date('H');
                if ($hour >= 0 && $hour < 12) {
                    $greeting = "Good morning";
                } elseif ($hour >= 12 && $hour < 16) {
                    $greeting = "Good Afternoon";
                } else {
                    $greeting = "Good Evening";
                }
                ?>
                <!-- Welcome Banner -->
                <div class="welcome-banner">
                    <div class="welcome-text">
                        <h2><?php echo $greeting . ", " . htmlspecialchars($_SESSION['full_name']); ?>!</h2>
                    </div>
                    <div class="welcome-stats">
                        <div class="stat-item">
                            <h3><?php echo $average; ?>%</h3>
                            <p>Current Average</p>
                        </div>
                        <div class="stat-item">
                            <h3><?php echo htmlspecialchars($studentClass); ?></h3>
                            <p>Current Class</p>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Stats -->
                <div class="quick-stats">
                    <div class="stat-card class">
                        <div class="stat-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo htmlspecialchars($studentClass); ?></h3>
                            <p>Current Class</p>
                        </div>
                    </div>

                    <div class="stat-card grades">
                        <div class="stat-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo $average; ?>%</h3>
                            <p>Current Average</p>
                        </div>
                    </div>
                    
                    <div class="stat-card attendance">
                        <div class="stat-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo $messageCount; ?></h3>
                            <p>Messages</p>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="quick-links">
                    <a href="course_registration.php" class="link-card">
                        <div class="link-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <h4>Course Registration</h4>
                        <p>Register for your courses online</p>
                    </a>
                    
                    <a href="report_card.php" class="link-card">
                        <div class="link-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <h4>Grade Report</h4>
                        <p>View detailed grade reports and feedback</p>
                    </a>
                    
                    <a href="student-attendance.php" class="link-card">
                        <div class="link-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <h4>Attendance</h4>
                        <p>Check your attendance record and history</p>
                    </a>
                    
                    <a href="student-schedule.php" class="link-card">
                        <div class="link-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h4>Class Schedule</h4>
                        <p>View your weekly class schedule</p>
                    </a>
                    
                    <a href="student-messages.php" class="link-card">
                        <div class="link-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <h4>Messages</h4>
                        <p>Communicate with teachers and classmates</p>
                    </a>
                </div>
                
                <!-- Footer -->
                <div class="dashboard-footer">
                    <p>&copy; <?php echo date('Y'); ?> T&T School Management System. All rights reserved. | Student Portal v2.2</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // DOM Elements
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const menuToggle = document.getElementById('menuToggle');
        
        // Setup event listeners
        document.addEventListener('DOMContentLoaded', function() {
            if (menuToggle) {
                menuToggle.addEventListener('click', () => {
                    sidebar.classList.toggle('active');
                    overlay.classList.toggle('active');
                });
            }
            
            if (overlay) {
                overlay.addEventListener('click', () => {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                });
            }
        });
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if(window.innerWidth >= 992) {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            }
            
            // Update responsive elements
            const welcomeStats = document.querySelector('.welcome-stats');
            if (welcomeStats) {
                if (window.innerWidth < 1200) {
                    welcomeStats.style.display = 'none';
                } else {
                    welcomeStats.style.display = 'flex';
                }
            }
        });
    </script>
</body>
</html>