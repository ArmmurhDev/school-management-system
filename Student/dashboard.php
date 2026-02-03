<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - T&T School Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-dark: #003366;
            --primary-medium: #00509E;
            --primary-light: #4D8FCC;
            --accent-blue: #1E88E5;
            --light-bg: #F0F8FF;
            --sidebar-bg: #002147;
            --text-dark: #333333;
            --text-light: #666666;
            --white: #FFFFFF;
            --shadow: rgba(0, 51, 102, 0.1);
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
            --info: #17a2b8;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Open Sans', sans-serif;
            color: var(--text-dark);
            line-height: 1.6;
            background-color: #f5f7fb;
            overflow-x: hidden;
        }
        
        h1, h2, h3, h4, h5 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: var(--primary-dark);
        }
        
        .container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: var(--sidebar-bg);
            color: var(--white);
            transition: all 0.3s ease;
            position: fixed;
            height: 100vh;
            z-index: 100;
            overflow-y: auto;
            box-shadow: 3px 0 15px rgba(0, 0, 0, 0.1);
        }
        
        .sidebar-header {
            padding: 25px 20px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .logo-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--accent-blue), var(--primary-light));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }
        
        .logo-icon i {
            font-size: 22px;
            color: var(--white);
        }
        
        .logo-text h2 {
            font-size: 1.5rem;
            color: var(--white);
            margin-bottom: 3px;
        }
        
        .logo-text p {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.7);
        }
        
        .sidebar-menu {
            padding: 20px 0;
        }
        
        .menu-item {
            padding: 15px 20px;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.8);
            border-left: 3px solid transparent;
        }
        
        .menu-item:hover, .menu-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--white);
            border-left-color: var(--accent-blue);
        }
        
        .menu-item i {
            width: 25px;
            margin-right: 15px;
            font-size: 1.1rem;
        }
        
        .menu-text {
            font-size: 0.95rem;
            font-weight: 500;
        }
        
        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            position: absolute;
            bottom: 0;
            width: 100%;
        }
        
        .user-info {
            display: flex;
            align-items: center;
        }
        
        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 15px;
            border: 2px solid var(--primary-light);
        }
        
        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .user-details h4 {
            color: var(--white);
            font-size: 0.95rem;
            margin-bottom: 3px;
        }
        
        .user-details p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.8rem;
        }
        
        /* Main Content Area */
        .main-content {
            flex: 1;
            margin-left: 250px;
            transition: margin-left 0.3s ease;
            min-height: 100vh;
        }
        
        /* Top Header */
        .top-header {
            background-color: var(--white);
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px var(--shadow);
            position: sticky;
            top: 0;
            z-index: 99;
        }
        
        .header-left {
            display: flex;
            align-items: center;
        }
        
        .menu-toggle {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--primary-dark);
            cursor: pointer;
            margin-right: 20px;
            display: none;
        }
        
        .page-title h1 {
            font-size: 1.8rem;
            color: var(--primary-dark);
        }
        
        .header-right {
            display: flex;
            align-items: center;
        }
        
        .header-action {
            margin-left: 25px;
            position: relative;
            cursor: pointer;
        }
        
        .notification-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: var(--danger);
            color: white;
            font-size: 0.7rem;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .header-action i {
            font-size: 1.3rem;
            color: var(--primary-medium);
            transition: color 0.3s;
        }
        
        .header-action:hover i {
            color: var(--accent-blue);
        }
        
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
        
        .stat-card.assignments {
            border-left-color: var(--warning);
        }
        
        .stat-card.events {
            border-left-color: var(--danger);
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
        
        .stat-card.assignments .stat-icon {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning);
        }
        
        .stat-card.events .stat-icon {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger);
        }
        
        .stat-info h3 {
            font-size: 2rem;
            margin-bottom: 5px;
        }
        
        .stat-info p {
            color: var(--text-light);
            font-size: 0.95rem;
        }
        
        /* Dashboard Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }
        
        @media (max-width: 1200px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }
        
        /* Recent Grades */
        .grades-card, .schedule-card, .announcements-card, .upcoming-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 15px var(--shadow);
            height: 100%;
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .card-header h3 {
            font-size: 1.3rem;
        }
        
        .view-all {
            color: var(--primary-medium);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .view-all:hover {
            color: var(--accent-blue);
            text-decoration: underline;
        }
        
        /* Grades Table */
        .grades-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .grades-table thead {
            background-color: var(--light-bg);
        }
        
        .grades-table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: var(--primary-dark);
            border-bottom: 2px solid #eee;
        }
        
        .grades-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .grades-table tbody tr:hover {
            background-color: #f9f9f9;
        }
        
        .course-info {
            display: flex;
            align-items: center;
        }
        
        .course-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background-color: var(--light-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: var(--primary-medium);
        }
        
        .course-name {
            font-weight: 500;
            margin-bottom: 3px;
        }
        
        .course-teacher {
            font-size: 0.85rem;
            color: var(--text-light);
        }
        
        .grade-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .grade-a {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }
        
        .grade-b {
            background-color: rgba(23, 162, 184, 0.1);
            color: var(--info);
        }
        
        .grade-c {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning);
        }
        
        .grade-d {
            background-color: rgba(253, 126, 20, 0.1);
            color: #fd7e14;
        }
        
        .grade-f {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger);
        }
        
        /* Schedule List */
        .schedule-list {
            list-style: none;
        }
        
        .schedule-item {
            padding: 20px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
        }
        
        .schedule-item:last-child {
            border-bottom: none;
        }
        
        .schedule-time {
            width: 80px;
            flex-shrink: 0;
        }
        
        .schedule-time .time {
            font-weight: 600;
            color: var(--primary-dark);
            font-size: 1rem;
        }
        
        .schedule-time .duration {
            font-size: 0.85rem;
            color: var(--text-light);
        }
        
        .schedule-details {
            flex: 1;
            padding-left: 20px;
            border-left: 3px solid var(--primary-light);
        }
        
        .schedule-details h4 {
            font-size: 1rem;
            margin-bottom: 5px;
        }
        
        .schedule-details p {
            font-size: 0.9rem;
            color: var(--text-light);
        }
        
        .schedule-room {
            display: inline-block;
            padding: 3px 10px;
            background-color: var(--light-bg);
            border-radius: 12px;
            font-size: 0.85rem;
            margin-top: 8px;
        }
        
        /* Announcements List */
        .announcements-list {
            list-style: none;
        }
        
        .announcement-item {
            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }
        
        .announcement-item:last-child {
            border-bottom: none;
        }
        
        .announcement-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        
        .announcement-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--light-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: var(--primary-medium);
        }
        
        .announcement-title {
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 5px;
        }
        
        .announcement-meta {
            display: flex;
            font-size: 0.85rem;
            color: var(--text-light);
        }
        
        .announcement-meta span {
            margin-right: 15px;
        }
        
        .announcement-content {
            color: var(--text-dark);
            font-size: 0.95rem;
            line-height: 1.6;
        }
        
        /* Upcoming Assignments */
        .assignments-list {
            list-style: none;
        }
        
        .assignment-item {
            padding: 20px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: flex-start;
        }
        
        .assignment-item:last-child {
            border-bottom: none;
        }
        
        .assignment-due {
            width: 70px;
            flex-shrink: 0;
            text-align: center;
            margin-right: 20px;
        }
        
        .assignment-day {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-dark);
            line-height: 1;
        }
        
        .assignment-month {
            font-size: 0.85rem;
            color: var(--text-light);
            text-transform: uppercase;
        }
        
        .assignment-details {
            flex: 1;
        }
        
        .assignment-details h4 {
            font-size: 1rem;
            margin-bottom: 8px;
        }
        
        .assignment-details p {
            font-size: 0.9rem;
            color: var(--text-light);
            margin-bottom: 10px;
        }
        
        .assignment-course {
            display: inline-block;
            padding: 3px 10px;
            background-color: var(--light-bg);
            border-radius: 12px;
            font-size: 0.85rem;
            margin-right: 10px;
        }
        
        .assignment-status {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .status-pending {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning);
        }
        
        .status-submitted {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }
        
        /* Progress Chart */
        .progress-chart {
            background-color: var(--white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 15px var(--shadow);
            margin-bottom: 40px;
        }
        
        .chart-container {
            height: 300px;
            position: relative;
            margin-top: 20px;
        }
        
        .chart-placeholder {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f9f9f9;
            border-radius: 8px;
            color: #888;
            flex-direction: column;
        }
        
        .chart-placeholder i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: var(--primary-light);
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
        @media (max-width: 1200px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
            
            .welcome-stats {
                display: none;
            }
        }
        
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
            
            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .view-all {
                align-self: flex-end;
            }
            
            .grades-table th, 
            .grades-table td {
                padding: 12px 8px;
                font-size: 0.85rem;
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
            
            .schedule-item {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .schedule-time {
                width: 100%;
                margin-bottom: 10px;
            }
            
            .schedule-details {
                padding-left: 0;
                border-left: none;
                padding-top: 10px;
                border-top: 2px solid var(--light-bg);
            }
            
            .announcement-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .announcement-icon {
                margin-bottom: 10px;
            }
            
            .assignment-item {
                flex-direction: column;
            }
            
            .assignment-due {
                width: 100%;
                text-align: left;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="logo-text">
                    <h2>T&T School</h2>
                    <p>Student Portal</p>
                </div>
            </div>
            
            <div class="sidebar-menu">
                <a href="student-dashboard.html" class="menu-item active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
                
                <a href="student-courses.html" class="menu-item">
                    <i class="fas fa-book"></i>
                    <span class="menu-text">My Courses</span>
                </a>
                
                <a href="student-grades.html" class="menu-item">
                    <i class="fas fa-chart-line"></i>
                    <span class="menu-text">Grades</span>
                </a>
                
                <a href="student-assignments.html" class="menu-item">
                    <i class="fas fa-tasks"></i>
                    <span class="menu-text">Assignments</span>
                </a>
                
                <a href="student-schedule.html" class="menu-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span class="menu-text">Schedule</span>
                </a>
                
                <a href="student-attendance.html" class="menu-item">
                    <i class="fas fa-calendar-check"></i>
                    <span class="menu-text">Attendance</span>
                </a>
                
                <a href="student-messages.html" class="menu-item">
                    <i class="fas fa-envelope"></i>
                    <span class="menu-text">Messages</span>
                </a>
            </div>
            
            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">
                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Student">
                    </div>
                    <div class="user-details">
                        <h4>Michael Johnson</h4>
                        <p>Grade 10 | Section A</p>
                    </div>
                </div>
            </div>
        </div>
        
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
                    
                    <div class="header-action" id="messagesBtn">
                        <i class="fas fa-envelope"></i>
                        <span class="notification-badge">2</span>
                    </div>
                    
                    <div class="header-action" id="profileBtn">
                        <i class="fas fa-user-circle"></i>
                    </div>
                </div>
            </div>
            
            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <!-- Welcome Banner -->
                <div class="welcome-banner">
                    <div class="welcome-text">
                        <h2>Welcome back, Michael!</h2>
                        <p>You have 3 assignments due this week. Next class: Mathematics at 10:00 AM in Room 205.</p>
                    </div>
                    <div class="welcome-stats">
                        <div class="stat-item">
                            <h3>3.75</h3>
                            <p>Current GPA</p>
                        </div>
                        <div class="stat-item">
                            <h3>96%</h3>
                            <p>Attendance</p>
                        </div>
                        <div class="stat-item">
                            <h3>#8</h3>
                            <p>Class Rank</p>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Stats -->
                <div class="quick-stats">
                    <div class="stat-card grades">
                        <div class="stat-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="stat-info">
                            <h3>3.75</h3>
                            <p>Current GPA</p>
                            <p style="font-size: 0.85rem; color: var(--success);">↑ 0.15 from last term</p>
                        </div>
                    </div>
                    
                    <div class="stat-card attendance">
                        <div class="stat-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="stat-info">
                            <h3>96%</h3>
                            <p>Attendance Rate</p>
                            <p style="font-size: 0.85rem; color: var(--success);">Only 3 absences this term</p>
                        </div>
                    </div>
                    
                    <div class="stat-card assignments">
                        <div class="stat-icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <div class="stat-info">
                            <h3>5</h3>
                            <p>Pending Assignments</p>
                            <p style="font-size: 0.85rem; color: var(--warning);">2 due this week</p>
                        </div>
                    </div>
                    
                    <div class="stat-card events">
                        <div class="stat-icon">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <div class="stat-info">
                            <h3>3</h3>
                            <p>Upcoming Events</p>
                            <p style="font-size: 0.85rem; color: var(--info);">Science Fair next week</p>
                        </div>
                    </div>
                </div>
                
                <!-- Dashboard Grid -->
                <div class="dashboard-grid">
                    <!-- Left Column -->
                    <div>
                        <!-- Recent Grades -->
                        <div class="grades-card">
                            <div class="card-header">
                                <h3>Recent Grades</h3>
                                <a href="student-grades.html" class="view-all">View All Grades</a>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="grades-table">
                                    <thead>
                                        <tr>
                                            <th>Course</th>
                                            <th>Assignment</th>
                                            <th>Grade</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="course-info">
                                                    <div class="course-icon">
                                                        <i class="fas fa-calculator"></i>
                                                    </div>
                                                    <div>
                                                        <div class="course-name">Mathematics</div>
                                                        <div class="course-teacher">Dr. Smith</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Algebra Test 3</td>
                                            <td><span class="grade-badge grade-a">A (95%)</span></td>
                                            <td>Oct 15, 2023</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="course-info">
                                                    <div class="course-icon">
                                                        <i class="fas fa-atom"></i>
                                                    </div>
                                                    <div>
                                                        <div class="course-name">Physics</div>
                                                        <div class="course-teacher">Ms. Johnson</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Lab Report 2</td>
                                            <td><span class="grade-badge grade-b">B+ (88%)</span></td>
                                            <td>Oct 12, 2023</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="course-info">
                                                    <div class="course-icon">
                                                        <i class="fas fa-code"></i>
                                                    </div>
                                                    <div>
                                                        <div class="course-name">Computer Science</div>
                                                        <div class="course-teacher">Mr. Chen</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Programming Project</td>
                                            <td><span class="grade-badge grade-a">A- (92%)</span></td>
                                            <td>Oct 10, 2023</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="course-info">
                                                    <div class="course-icon">
                                                        <i class="fas fa-book"></i>
                                                    </div>
                                                    <div>
                                                        <div class="course-name">English</div>
                                                        <div class="course-teacher">Ms. Davis</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Essay - Literature</td>
                                            <td><span class="grade-badge grade-b">B (85%)</span></td>
                                            <td>Oct 8, 2023</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="course-info">
                                                    <div class="course-icon">
                                                        <i class="fas fa-flask"></i>
                                                    </div>
                                                    <div>
                                                        <div class="course-name">Chemistry</div>
                                                        <div class="course-teacher">Dr. Williams</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Chapter 4 Quiz</td>
                                            <td><span class="grade-badge grade-a">A (96%)</span></td>
                                            <td>Oct 5, 2023</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Progress Chart -->
                        <div class="progress-chart">
                            <div class="card-header">
                                <h3>Academic Progress</h3>
                                <a href="student-grades.html" class="view-all">View Details</a>
                            </div>
                            
                            <div class="chart-container">
                                <div class="chart-placeholder">
                                    <i class="fas fa-chart-bar"></i>
                                    <p>Academic Progress Chart</p>
                                    <p style="font-size: 0.9rem;">(Chart.js would be implemented here)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div>
                        <!-- Today's Schedule -->
                        <div class="schedule-card">
                            <div class="card-header">
                                <h3>Today's Schedule</h3>
                                <a href="student-schedule.html" class="view-all">Full Schedule</a>
                            </div>
                            
                            <ul class="schedule-list">
                                <li class="schedule-item">
                                    <div class="schedule-time">
                                        <div class="time">8:30 AM</div>
                                        <div class="duration">45 min</div>
                                    </div>
                                    <div class="schedule-details">
                                        <h4>Mathematics</h4>
                                        <p>Dr. Robert Smith</p>
                                        <span class="schedule-room">Room 205</span>
                                    </div>
                                </li>
                                
                                <li class="schedule-item">
                                    <div class="schedule-time">
                                        <div class="time">9:30 AM</div>
                                        <div class="duration">45 min</div>
                                    </div>
                                    <div class="schedule-details">
                                        <h4>Physics</h4>
                                        <p>Ms. Emily Johnson</p>
                                        <span class="schedule-room">Lab 102</span>
                                    </div>
                                </li>
                                
                                <li class="schedule-item">
                                    <div class="schedule-time">
                                        <div class="time">10:30 AM</div>
                                        <div class="duration">45 min</div>
                                    </div>
                                    <div class="schedule-details">
                                        <h4>English Literature</h4>
                                        <p>Mr. David Chen</p>
                                        <span class="schedule-room">Room 312</span>
                                    </div>
                                </li>
                                
                                <li class="schedule-item">
                                    <div class="schedule-time">
                                        <div class="time">11:30 AM</div>
                                        <div class="duration">45 min</div>
                                    </div>
                                    <div class="schedule-details">
                                        <h4>Computer Science</h4>
                                        <p>Ms. Patricia Miller</p>
                                        <span class="schedule-room">Lab 208</span>
                                    </div>
                                </li>
                                
                                <li class="schedule-item">
                                    <div class="schedule-time">
                                        <div class="time">1:00 PM</div>
                                        <div class="duration">60 min</div>
                                    </div>
                                    <div class="schedule-details">
                                        <h4>Study Hall</h4>
                                        <p>Library - Quiet Study Area</p>
                                        <span class="schedule-room">Library</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Announcements -->
                        <div class="announcements-card">
                            <div class="card-header">
                                <h3>Recent Announcements</h3>
                                <a href="#" class="view-all">View All</a>
                            </div>
                            
                            <ul class="announcements-list">
                                <li class="announcement-item">
                                    <div class="announcement-header">
                                        <div class="announcement-icon">
                                            <i class="fas fa-bullhorn"></i>
                                        </div>
                                        <div>
                                            <div class="announcement-title">Science Fair Registration</div>
                                            <div class="announcement-meta">
                                                <span><i class="far fa-calendar"></i> Oct 20, 2023</span>
                                                <span><i class="fas fa-user"></i> Principal's Office</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="announcement-content">
                                        Registration for the Annual Science Fair is now open. Submit your project proposals by November 5th.
                                    </div>
                                </li>
                                
                                <li class="announcement-item">
                                    <div class="announcement-header">
                                        <div class="announcement-icon">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </div>
                                        <div>
                                            <div class="announcement-title">Library Closure</div>
                                            <div class="announcement-meta">
                                                <span><i class="far fa-calendar"></i> Oct 18, 2023</span>
                                                <span><i class="fas fa-user"></i> Library Department</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="announcement-content">
                                        The main library will be closed this Friday for maintenance. Please plan your studies accordingly.
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Upcoming Assignments -->
                <div class="progress-chart">
                    <div class="card-header">
                        <h3>Upcoming Assignments</h3>
                        <a href="student-assignments.html" class="view-all">View All Assignments</a>
                    </div>
                    
                    <ul class="assignments-list">
                        <li class="assignment-item">
                            <div class="assignment-due">
                                <div class="assignment-day">24</div>
                                <div class="assignment-month">Oct</div>
                            </div>
                            <div class="assignment-details">
                                <h4>Physics Lab Report</h4>
                                <p>Complete lab report for experiment on Newton's Laws. Include data analysis and conclusions.</p>
                                <span class="assignment-course">Physics</span>
                                <span class="assignment-status status-pending">Pending</span>
                            </div>
                        </li>
                        
                        <li class="assignment-item">
                            <div class="assignment-due">
                                <div class="assignment-day">26</div>
                                <div class="assignment-month">Oct</div>
                            </div>
                            <div class="assignment-details">
                                <h4>Mathematics Problem Set</h4>
                                <p>Chapter 5 exercises: Quadratic Equations and Functions. Problems 1-25 odd.</p>
                                <span class="assignment-course">Mathematics</span>
                                <span class="assignment-status status-pending">Pending</span>
                            </div>
                        </li>
                        
                        <li class="assignment-item">
                            <div class="assignment-due">
                                <div class="assignment-day">28</div>
                                <div class="assignment-month">Oct</div>
                            </div>
                            <div class="assignment-details">
                                <h4>English Essay</h4>
                                <p>Compare and contrast essay on two literary works studied this term. 1500 words minimum.</p>
                                <span class="assignment-course">English</span>
                                <span class="assignment-status status-submitted">Submitted</span>
                            </div>
                        </li>
                        
                        <li class="assignment-item">
                            <div class="assignment-due">
                                <div class="assignment-day">30</div>
                                <div class="assignment-month">Oct</div>
                            </div>
                            <div class="assignment-details">
                                <h4>Computer Science Project</h4>
                                <p>Final submission for the web development project. Include source code and documentation.</p>
                                <span class="assignment-course">Computer Science</span>
                                <span class="assignment-status status-pending">Pending</span>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <!-- Quick Links -->
                <div class="quick-links">
                    <a href="student-courses.html" class="link-card">
                        <div class="link-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <h4>Course Materials</h4>
                        <p>Access lecture notes, slides, and resources</p>
                    </a>
                    
                    <a href="student-assignments.html" class="link-card">
                        <div class="link-icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <h4>Submit Assignment</h4>
                        <p>Upload and submit your assignments online</p>
                    </a>
                    
                    <a href="student-grades.html" class="link-card">
                        <div class="link-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <h4>Grade Report</h4>
                        <p>View detailed grade reports and feedback</p>
                    </a>
                    
                    <a href="student-attendance.html" class="link-card">
                        <div class="link-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <h4>Attendance</h4>
                        <p>Check your attendance record and history</p>
                    </a>
                    
                    <a href="student-schedule.html" class="link-card">
                        <div class="link-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h4>Class Schedule</h4>
                        <p>View your weekly class schedule</p>
                    </a>
                    
                    <a href="student-messages.html" class="link-card">
                        <div class="link-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <h4>Messages</h4>
                        <p>Communicate with teachers and classmates</p>
                    </a>
                </div>
                
                <!-- Footer -->
                <div class="dashboard-footer">
                    <p>&copy; 2023 T&T School Management System. All rights reserved. | Student Portal v2.2</p>
                    <p style="margin-top: 10px; font-size: 0.85rem;">Academic Year: 2023-2024 | Term 2 | Last Login: Today, 9:15 AM</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // DOM Elements
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const menuToggle = document.getElementById('menuToggle');
        const searchBtn = document.getElementById('searchBtn');
        const notificationBtn = document.getElementById('notificationBtn');
        const messagesBtn = document.getElementById('messagesBtn');
        const profileBtn = document.getElementById('profileBtn');
        
        // Student data
        const studentData = {
            name: "Michael Johnson",
            grade: "10",
            section: "A",
            gpa: 3.75,
            attendance: 96,
            rank: 8,
            pendingAssignments: 5,
            upcomingEvents: 3
        };
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            setupEventListeners();
            updateWelcomeMessage();
            simulateLiveUpdates();
        });
        
        // Setup event listeners
        function setupEventListeners() {
            // Mobile sidebar toggle
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            });
            
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });
            
            // Header actions
            searchBtn.addEventListener('click', () => {
                alert('Search functionality would open here');
            });
            
            notificationBtn.addEventListener('click', () => {
                const badge = notificationBtn.querySelector('.notification-badge');
                const count = parseInt(badge.textContent);
                if (count > 0) {
                    badge.textContent = '0';
                    badge.style.display = 'none';
                    alert('You have ' + count + ' new notifications');
                }
            });
            
            messagesBtn.addEventListener('click', () => {
                const badge = messagesBtn.querySelector('.notification-badge');
                const count = parseInt(badge.textContent);
                if (count > 0) {
                    badge.textContent = '0';
                    badge.style.display = 'none';
                    alert('You have ' + count + ' new messages');
                }
            });
            
            profileBtn.addEventListener('click', () => {
                window.location.href = 'student-profile.html';
            });
            
            // Update welcome message based on time of day
            updateWelcomeMessage();
            
            // Close sidebar when clicking on a menu item (for mobile)
            document.querySelectorAll('.sidebar-menu .menu-item').forEach(item => {
                item.addEventListener('click', () => {
                    if (window.innerWidth < 992) {
                        sidebar.classList.remove('active');
                        overlay.classList.remove('active');
                    }
                });
            });
            
            // Handle quick link clicks
            document.querySelectorAll('.link-card').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const linkText = this.querySelector('h4').textContent;
                    console.log(`Navigating to: ${linkText}`);
                    // In a real app, this would navigate to the actual page
                });
            });
        }
        
        // Update welcome message based on time of day
        function updateWelcomeMessage() {
            const hour = new Date().getHours();
            let greeting = "Hello";
            
            if (hour < 12) {
                greeting = "Good morning";
            } else if (hour < 18) {
                greeting = "Good afternoon";
            } else {
                greeting = "Good evening";
            }
            
            document.querySelector('.welcome-text h2').textContent = `${greeting}, ${studentData.name.split(' ')[0]}!`;
        }
        
        // Simulate live updates
        function simulateLiveUpdates() {
            // Update time in schedule
            setInterval(() => {
                const scheduleItems = document.querySelectorAll('.schedule-time .time');
                const now = new Date();
                const currentHour = now.getHours();
                const currentMinute = now.getMinutes();
                
                scheduleItems.forEach(item => {
                    const timeText = item.textContent;
                    const [hour, minute] = timeText.replace(' AM', '').replace(' PM', '').split(':').map(Number);
                    
                    // Add AM/PM indicator
                    let displayHour = hour;
                    let ampm = 'AM';
                    
                    if (hour >= 12) {
                        ampm = 'PM';
                        if (hour > 12) displayHour = hour - 12;
                    }
                    
                    item.textContent = `${displayHour}:${minute.toString().padStart(2, '0')} ${ampm}`;
                    
                    // Highlight current/upcoming class
                    const scheduleItem = item.closest('.schedule-item');
                    const scheduleHour = hour < 8 ? hour + 12 : hour; // Convert to 24-hour format
                    
                    if (scheduleHour === currentHour && Math.abs(minute - currentMinute) <= 5) {
                        scheduleItem.style.backgroundColor = 'rgba(30, 136, 229, 0.05)';
                        scheduleItem.style.borderLeft = '3px solid var(--accent-blue)';
                    } else {
                        scheduleItem.style.backgroundColor = '';
                        scheduleItem.style.borderLeft = '';
                    }
                });
            }, 60000); // Update every minute
            
            // Update pending assignments count
            setInterval(() => {
                const assignmentsCard = document.querySelector('.stat-card.assignments .stat-info h3');
                const currentCount = parseInt(assignmentsCard.textContent);
                
                // Occasionally add or remove an assignment
                if (Math.random() > 0.9) {
                    const newCount = Math.max(0, currentCount + (Math.random() > 0.5 ? 1 : -1));
                    assignmentsCard.textContent = newCount;
                    
                    // Update the subtitle
                    const subtitle = assignmentsCard.nextElementSibling.nextElementSibling;
                    if (newCount > 0) {
                        const dueThisWeek = Math.min(newCount, Math.floor(Math.random() * 3) + 1);
                        subtitle.textContent = `${dueThisWeek} due this week`;
                        subtitle.style.color = 'var(--warning)';
                    } else {
                        subtitle.textContent = 'All caught up!';
                        subtitle.style.color = 'var(--success)';
                    }
                }
            }, 30000); // Update every 30 seconds
        }
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if(window.innerWidth >= 992) {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            }
            
            // Update responsive elements
            const welcomeStats = document.querySelector('.welcome-stats');
            if (window.innerWidth < 1200) {
                welcomeStats.style.display = 'none';
            } else {
                welcomeStats.style.display = 'flex';
            }
        });
        
        // Add a simple notification system
        function showNotification(title, message, type = 'info') {
            // Create notification element
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 100px;
                right: 30px;
                background-color: var(--white);
                border-radius: 8px;
                padding: 15px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.2);
                z-index: 1000;
                max-width: 300px;
                border-left: 4px solid var(--primary-medium);
                animation: slideIn 0.3s ease;
            `;
            
            if (type === 'success') {
                notification.style.borderLeftColor = 'var(--success)';
            } else if (type === 'warning') {
                notification.style.borderLeftColor = 'var(--warning)';
            } else if (type === 'error') {
                notification.style.borderLeftColor = 'var(--danger)';
            }
            
            notification.innerHTML = `
                <h4 style="margin-bottom: 8px; font-size: 1rem;">${title}</h4>
                <p style="font-size: 0.9rem; color: var(--text-light); margin-bottom: 10px;">${message}</p>
                <button style="background: none; border: none; color: var(--primary-medium); font-size: 0.8rem; cursor: pointer;">Dismiss</button>
            `;
            
            document.body.appendChild(notification);
            
            // Add dismiss button functionality
            const dismissBtn = notification.querySelector('button');
            dismissBtn.addEventListener('click', () => {
                notification.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => {
                    notification.remove();
                }, 300);
            });
            
            // Auto-dismiss after 5 seconds
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.style.animation = 'slideOut 0.3s ease';
                    setTimeout(() => {
                        if (notification.parentNode) {
                            notification.remove();
                        }
                    }, 300);
                }
            }, 5000);
        }
        
        // Add CSS for animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            
            @keyframes slideOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
        `;
        document.head.appendChild(style);
        
        // Show a sample notification after 3 seconds
        setTimeout(() => {
            showNotification('New Assignment Posted', 'Physics Lab Report due on October 24th', 'info');
        }, 3000);
        
        // Show another notification after 8 seconds
        setTimeout(() => {
            showNotification('Grade Updated', 'Your Mathematics test grade has been posted', 'success');
        }, 8000);
    </script>
</body>
</html>