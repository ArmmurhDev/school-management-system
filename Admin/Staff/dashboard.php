<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard - T&T School Management System</title>
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
            border-radius: 12px;
            padding: 30px;
            color: var(--white);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 5px 15px rgba(0, 51, 102, 0.2);
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
        
        .welcome-icon {
            font-size: 3.5rem;
            opacity: 0.8;
        }
        
        /* Stats Cards */
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
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
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-left: 5px solid var(--primary-medium);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 51, 102, 0.15);
        }
        
        .stat-card.classes {
            border-left-color: var(--accent-blue);
        }
        
        .stat-card.students {
            border-left-color: var(--success);
        }
        
        .stat-card.tasks {
            border-left-color: var(--warning);
        }
        
        .stat-card.attendance {
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
        
        .stat-card.classes .stat-icon {
            background-color: rgba(30, 136, 229, 0.1);
            color: var(--accent-blue);
        }
        
        .stat-card.students .stat-icon {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }
        
        .stat-card.tasks .stat-icon {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning);
        }
        
        .stat-card.attendance .stat-icon {
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
        
        /* Today's Schedule */
        .schedule-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 15px var(--shadow);
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
        }
        
        .view-all:hover {
            text-decoration: underline;
        }
        
        .schedule-list {
            list-style: none;
        }
        
        .schedule-item {
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 15px;
            background-color: var(--light-bg);
            border-left: 4px solid var(--primary-medium);
            transition: all 0.3s;
        }
        
        .schedule-item:hover {
            background-color: #e8f4ff;
            transform: translateX(5px);
        }
        
        .schedule-item.current {
            background-color: #fff8e1;
            border-left-color: var(--warning);
        }
        
        .schedule-item.upcoming {
            border-left-color: var(--success);
        }
        
        .schedule-item.past {
            opacity: 0.8;
            border-left-color: #ccc;
        }
        
        .schedule-time {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            color: var(--primary-medium);
            font-weight: 600;
        }
        
        .schedule-time i {
            margin-right: 10px;
        }
        
        .schedule-details h4 {
            font-size: 1.1rem;
            margin-bottom: 8px;
        }
        
        .schedule-details p {
            color: var(--text-light);
            font-size: 0.9rem;
            display: flex;
            align-items: center;
        }
        
        .schedule-details p i {
            margin-right: 8px;
        }
        
        /* Quick Actions */
        .actions-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 15px var(--shadow);
        }
        
        .actions-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
        
        .action-item {
            background-color: var(--light-bg);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            border: 1px solid transparent;
        }
        
        .action-item:hover {
            background-color: #e8f4ff;
            transform: translateY(-5px);
            border-color: var(--primary-light);
            box-shadow: 0 5px 10px rgba(0, 51, 102, 0.1);
        }
        
        .action-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            background-color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 1.5rem;
            color: var(--primary-medium);
            box-shadow: 0 3px 10px rgba(0, 51, 102, 0.1);
        }
        
        .action-item:hover .action-icon {
            background-color: var(--primary-medium);
            color: var(--white);
        }
        
        .action-item h4 {
            font-size: 0.95rem;
            margin-bottom: 5px;
        }
        
        .action-item p {
            color: var(--text-light);
            font-size: 0.85rem;
        }
        
        /* Pending Tasks */
        .tasks-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 15px var(--shadow);
            margin-bottom: 40px;
        }
        
        .tasks-list {
            list-style: none;
        }
        
        .task-item {
            padding: 18px;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
        }
        
        .task-item:last-child {
            border-bottom: none;
        }
        
        .task-checkbox {
            margin-right: 15px;
        }
        
        .task-checkbox input {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }
        
        .task-details {
            flex: 1;
        }
        
        .task-details h4 {
            font-size: 1rem;
            margin-bottom: 5px;
        }
        
        .task-details p {
            color: var(--text-light);
            font-size: 0.85rem;
        }
        
        .task-priority {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 500;
            margin-left: 15px;
        }
        
        .priority-high {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger);
        }
        
        .priority-medium {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning);
        }
        
        .priority-low {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }
        
        /* Recent Announcements */
        .announcements-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 15px var(--shadow);
        }
        
        .announcements-list {
            list-style: none;
        }
        
        .announcement-item {
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 15px;
            background-color: #f9f9f9;
            border-left: 4px solid var(--primary-light);
        }
        
        .announcement-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }
        
        .announcement-title {
            font-weight: 600;
            font-size: 1rem;
            color: var(--primary-dark);
        }
        
        .announcement-date {
            color: var(--text-light);
            font-size: 0.85rem;
        }
        
        .announcement-content {
            color: var(--text-light);
            font-size: 0.9rem;
            line-height: 1.5;
        }
        
        /* Upcoming Events */
        .events-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 15px var(--shadow);
        }
        
        .events-list {
            list-style: none;
        }
        
        .event-item {
            padding: 15px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
        }
        
        .event-item:last-child {
            border-bottom: none;
        }
        
        .event-date {
            background-color: var(--light-bg);
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            min-width: 70px;
            margin-right: 15px;
        }
        
        .event-day {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-medium);
            line-height: 1;
        }
        
        .event-month {
            font-size: 0.8rem;
            color: var(--text-light);
            text-transform: uppercase;
        }
        
        .event-details h4 {
            font-size: 1rem;
            margin-bottom: 5px;
        }
        
        .event-details p {
            color: var(--text-light);
            font-size: 0.85rem;
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
            .stats-cards {
                grid-template-columns: repeat(2, 1fr);
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
            
            .actions-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 768px) {
            .welcome-banner {
                flex-direction: column;
                text-align: center;
                padding: 25px;
            }
            
            .welcome-icon {
                margin-top: 20px;
                font-size: 3rem;
            }
            
            .stats-cards {
                grid-template-columns: 1fr;
            }
            
            .top-header {
                padding: 20px;
            }
            
            .dashboard-content {
                padding: 20px;
            }
            
            .header-action {
                margin-left: 15px;
            }
        }
        
        @media (max-width: 576px) {
            .welcome-text h2 {
                font-size: 1.5rem;
            }
            
            .stat-card {
                padding: 20px;
            }
            
            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .page-title h1 {
                font-size: 1.5rem;
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
                    <p>Staff Portal</p>
                </div>
            </div>
            
            <div class="sidebar-menu">
                <a href="#" class="menu-item active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
                
                <a href="#" class="menu-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span class="menu-text">My Schedule</span>
                </a>
                
                <a href="#" class="menu-item">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span class="menu-text">My Classes</span>
                </a>
                
                <a href="#" class="menu-item">
                    <i class="fas fa-users"></i>
                    <span class="menu-text">My Students</span>
                </a>
                
                <a href="#" class="menu-item">
                    <i class="fas fa-clipboard-check"></i>
                    <span class="menu-text">Attendance</span>
                </a>
                
                <a href="#" class="menu-item">
                    <i class="fas fa-chart-bar"></i>
                    <span class="menu-text">Results & Grades</span>
                </a>
                
                <a href="#" class="menu-item">
                    <i class="fas fa-tasks"></i>
                    <span class="menu-text">Assignments</span>
                </a>
                
                <a href="#" class="menu-item">
                    <i class="fas fa-envelope"></i>
                    <span class="menu-text">Messages</span>
                </a>
                
                <a href="#" class="menu-item">
                    <i class="fas fa-cog"></i>
                    <span class="menu-text">Settings</span>
                </a>
            </div>
            
            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">
                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Staff">
                    </div>
                    <div class="user-details">
                        <h4>Mr. Robert Smith</h4>
                        <p>Mathematics Teacher</p>
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
                        <h1>Staff Dashboard</h1>
                    </div>
                </div>
                
                <div class="header-right">
                    <div class="header-action">
                        <i class="fas fa-search"></i>
                    </div>
                    
                    <div class="header-action">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </div>
                    
                    <div class="header-action">
                        <i class="fas fa-envelope"></i>
                        <span class="notification-badge">5</span>
                    </div>
                    
                    <div class="header-action">
                        <i class="fas fa-user-circle"></i>
                    </div>
                </div>
            </div>
            
            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <!-- Welcome Banner -->
                <div class="welcome-banner">
                    <div class="welcome-text">
                        <h2>Welcome back, Mr. Robert Smith!</h2>
                        <p>You have 3 classes today. Next class: Mathematics for Grade 10 at 10:00 AM in Room 302.</p>
                    </div>
                    <div class="welcome-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                </div>
                
                <!-- Stats Cards -->
                <div class="stats-cards">
                    <div class="stat-card classes">
                        <div class="stat-icon">
                            <i class="fas fa-chalkboard"></i>
                        </div>
                        <div class="stat-info">
                            <h3>5</h3>
                            <p>Active Classes</p>
                        </div>
                    </div>
                    
                    <div class="stat-card students">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <h3>142</h3>
                            <p>Total Students</p>
                        </div>
                    </div>
                    
                    <div class="stat-card tasks">
                        <div class="stat-icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <div class="stat-info">
                            <h3>12</h3>
                            <p>Pending Tasks</p>
                        </div>
                    </div>
                    
                    <div class="stat-card attendance">
                        <div class="stat-icon">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <div class="stat-info">
                            <h3>94%</h3>
                            <p>Class Attendance</p>
                        </div>
                    </div>
                </div>
                
                <!-- Dashboard Grid -->
                <div class="dashboard-grid">
                    <!-- Left Column -->
                    <div>
                        <!-- Today's Schedule -->
                        <div class="schedule-card">
                            <div class="card-header">
                                <h3>Today's Schedule</h3>
                                <a href="#" class="view-all">View Full Schedule</a>
                            </div>
                            <ul class="schedule-list">
                                <li class="schedule-item current">
                                    <div class="schedule-time">
                                        <i class="fas fa-clock"></i>
                                        09:00 AM - 10:00 AM
                                    </div>
                                    <div class="schedule-details">
                                        <h4>Mathematics - Grade 9</h4>
                                        <p><i class="fas fa-door-open"></i> Room 301 | <i class="fas fa-user-friends"></i> 32 Students</p>
                                    </div>
                                </li>
                                
                                <li class="schedule-item upcoming">
                                    <div class="schedule-time">
                                        <i class="fas fa-clock"></i>
                                        10:15 AM - 11:15 AM
                                    </div>
                                    <div class="schedule-details">
                                        <h4>Advanced Mathematics - Grade 10</h4>
                                        <p><i class="fas fa-door-open"></i> Room 302 | <i class="fas fa-user-friends"></i> 28 Students</p>
                                    </div>
                                </li>
                                
                                <li class="schedule-item">
                                    <div class="schedule-time">
                                        <i class="fas fa-clock"></i>
                                        01:00 PM - 02:00 PM
                                    </div>
                                    <div class="schedule-details">
                                        <h4>Mathematics - Grade 11</h4>
                                        <p><i class="fas fa-door-open"></i> Room 305 | <i class="fas fa-user-friends"></i> 30 Students</p>
                                    </div>
                                </li>
                                
                                <li class="schedule-item">
                                    <div class="schedule-time">
                                        <i class="fas fa-clock"></i>
                                        02:15 PM - 03:15 PM
                                    </div>
                                    <div class="schedule-details">
                                        <h4>Faculty Meeting</h4>
                                        <p><i class="fas fa-door-open"></i> Conference Room | <i class="fas fa-user-friends"></i> All Math Faculty</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Pending Tasks -->
                        <div class="tasks-card">
                            <div class="card-header">
                                <h3>Pending Tasks</h3>
                                <a href="#" class="view-all">View All Tasks</a>
                            </div>
                            <ul class="tasks-list">
                                <li class="task-item">
                                    <div class="task-checkbox">
                                        <input type="checkbox" id="task1">
                                    </div>
                                    <div class="task-details">
                                        <h4>Grade Term 1 Assignments</h4>
                                        <p>Mathematics - Grade 10 | Due: Today</p>
                                    </div>
                                    <div class="task-priority priority-high">High</div>
                                </li>
                                
                                <li class="task-item">
                                    <div class="task-checkbox">
                                        <input type="checkbox" id="task2">
                                    </div>
                                    <div class="task-details">
                                        <h4>Prepare Midterm Exam Paper</h4>
                                        <p>Grade 9 Mathematics | Due: Oct 30</p>
                                    </div>
                                    <div class="task-priority priority-medium">Medium</div>
                                </li>
                                
                                <li class="task-item">
                                    <div class="task-checkbox">
                                        <input type="checkbox" id="task3">
                                    </div>
                                    <div class="task-details">
                                        <h4>Update Student Progress Reports</h4>
                                        <p>All Classes | Due: Nov 5</p>
                                    </div>
                                    <div class="task-priority priority-low">Low</div>
                                </li>
                                
                                <li class="task-item">
                                    <div class="task-checkbox">
                                        <input type="checkbox" id="task4">
                                    </div>
                                    <div class="task-details">
                                        <h4>Submit Lesson Plans for November</h4>
                                        <p>Department Head | Due: Oct 28</p>
                                    </div>
                                    <div class="task-priority priority-medium">Medium</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div>
                        <!-- Quick Actions -->
                        <div class="actions-card">
                            <div class="card-header">
                                <h3>Quick Actions</h3>
                            </div>
                            <div class="actions-grid">
                                <div class="action-item" id="takeAttendance">
                                    <div class="action-icon">
                                        <i class="fas fa-clipboard-check"></i>
                                    </div>
                                    <h4>Take Attendance</h4>
                                    <p>Mark today's attendance</p>
                                </div>
                                
                                <div class="action-item" id="uploadResults">
                                    <div class="action-icon">
                                        <i class="fas fa-file-upload"></i>
                                    </div>
                                    <h4>Upload Results</h4>
                                    <p>Submit exam results</p>
                                </div>
                                
                                <div class="action-item" id="createAssignment">
                                    <div class="action-icon">
                                        <i class="fas fa-tasks"></i>
                                    </div>
                                    <h4>Create Assignment</h4>
                                    <p>Assign new homework</p>
                                </div>
                                
                                <div class="action-item" id="sendMessage">
                                    <div class="action-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <h4>Send Message</h4>
                                    <p>Contact students/parents</p>
                                </div>
                                
                                <div class="action-item" id="scheduleClass">
                                    <div class="action-icon">
                                        <i class="fas fa-calendar-plus"></i>
                                    </div>
                                    <h4>Schedule Class</h4>
                                    <p>Add new class to schedule</p>
                                </div>
                                
                                <div class="action-item" id="requestLeave">
                                    <div class="action-icon">
                                        <i class="fas fa-calendar-times"></i>
                                    </div>
                                    <h4>Request Leave</h4>
                                    <p>Submit leave application</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Recent Announcements -->
                        <div class="announcements-card">
                            <div class="card-header">
                                <h3>Recent Announcements</h3>
                                <a href="#" class="view-all">View All</a>
                            </div>
                            <ul class="announcements-list">
                                <li class="announcement-item">
                                    <div class="announcement-header">
                                        <div class="announcement-title">Faculty Development Workshop</div>
                                        <div class="announcement-date">Oct 20, 2023</div>
                                    </div>
                                    <div class="announcement-content">
                                        All teaching staff are invited to attend the "Innovative Teaching Methods" workshop on November 5th at 2:00 PM in the auditorium.
                                    </div>
                                </li>
                                
                                <li class="announcement-item">
                                    <div class="announcement-header">
                                        <div class="announcement-title">Midterm Exam Schedule</div>
                                        <div class="announcement-date">Oct 18, 2023</div>
                                    </div>
                                    <div class="announcement-content">
                                        Midterm examinations will be held from November 15th to 24th. Please submit your exam papers by October 30th.
                                    </div>
                                </li>
                                
                                <li class="announcement-item">
                                    <div class="announcement-header">
                                        <div class="announcement-title">Parent-Teacher Meetings</div>
                                        <div class="announcement-date">Oct 15, 2023</div>
                                    </div>
                                    <div class="announcement-content">
                                        Parent-teacher meetings are scheduled for November 10th. Please prepare progress reports for your students.
                                    </div>
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Upcoming Events -->
                        <div class="events-card">
                            <div class="card-header">
                                <h3>Upcoming Events</h3>
                                <a href="#" class="view-all">View Calendar</a>
                            </div>
                            <ul class="events-list">
                                <li class="event-item">
                                    <div class="event-date">
                                        <div class="event-day">25</div>
                                        <div class="event-month">Oct</div>
                                    </div>
                                    <div class="event-details">
                                        <h4>Mathematics Department Meeting</h4>
                                        <p>3:00 PM | Conference Room</p>
                                    </div>
                                </li>
                                
                                <li class="event-item">
                                    <div class="event-date">
                                        <div class="event-day">30</div>
                                        <div class="event-month">Oct</div>
                                    </div>
                                    <div class="event-details">
                                        <h4>Deadline: Exam Papers Submission</h4>
                                        <p>End of day | Department Head</p>
                                    </div>
                                </li>
                                
                                <li class="event-item">
                                    <div class="event-date">
                                        <div class="event-day">5</div>
                                        <div class="event-month">Nov</div>
                                    </div>
                                    <div class="event-details">
                                        <h4>Faculty Development Workshop</h4>
                                        <p>2:00 PM | School Auditorium</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="dashboard-footer">
                    <p>&copy; 2023 T&T School Management System. All rights reserved. | Staff Portal v2.1</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // DOM Elements
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const menuToggle = document.getElementById('menuToggle');
        const mainContent = document.getElementById('mainContent');
        
        // Quick action buttons
        const takeAttendanceBtn = document.getElementById('takeAttendance');
        const uploadResultsBtn = document.getElementById('uploadResults');
        const createAssignmentBtn = document.getElementById('createAssignment');
        const sendMessageBtn = document.getElementById('sendMessage');
        const scheduleClassBtn = document.getElementById('scheduleClass');
        const requestLeaveBtn = document.getElementById('requestLeave');
        
        // Task checkboxes
        const taskCheckboxes = document.querySelectorAll('.task-checkbox input');
        
        // Mobile sidebar toggle
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });
        
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });
        
        // Close sidebar when clicking on a menu item (for mobile)
        document.querySelectorAll('.sidebar-menu .menu-item').forEach(item => {
            item.addEventListener('click', () => {
                if (window.innerWidth < 992) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                }
            });
        });
        
        // Quick action button handlers
        takeAttendanceBtn.addEventListener('click', () => {
            alert('Take Attendance feature would open here. You would be able to mark attendance for your classes.');
        });
        
        uploadResultsBtn.addEventListener('click', () => {
            alert('Upload Results feature would open here. You can upload exam/assignment results for your students.');
        });
        
        createAssignmentBtn.addEventListener('click', () => {
            alert('Create Assignment feature would open here. You can create and assign new homework or projects.');
        });
        
        sendMessageBtn.addEventListener('click', () => {
            alert('Send Message feature would open here. You can message students, parents, or other staff members.');
        });
        
        scheduleClassBtn.addEventListener('click', () => {
            alert('Schedule Class feature would open here. You can schedule additional classes or make-up sessions.');
        });
        
        requestLeaveBtn.addEventListener('click', () => {
            alert('Request Leave feature would open here. You can submit a leave application to the administration.');
        });
        
        // Task completion handlers
        taskCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const taskItem = this.closest('.task-item');
                const taskTitle = taskItem.querySelector('h4').textContent;
                
                if (this.checked) {
                    // Mark task as completed
                    taskItem.style.opacity = '0.6';
                    taskItem.style.textDecoration = 'line-through';
                    
                    // Update task count
                    updateTaskCount(-1);
                    
                    // Show completion message
                    setTimeout(() => {
                        alert(`Task "${taskTitle}" marked as completed!`);
                    }, 300);
                }
            });
        });
        
        // Update task count
        function updateTaskCount(change) {
            const taskCountElement = document.querySelector('.stat-card.tasks .stat-info h3');
            let currentCount = parseInt(taskCountElement.textContent);
            currentCount += change;
            
            if (currentCount < 0) currentCount = 0;
            
            taskCountElement.textContent = currentCount;
        }
        
        // Update current class indicator
        function updateCurrentClass() {
            const now = new Date();
            const currentHour = now.getHours();
            const currentMinute = now.getMinutes();
            
            // Remove current class from all schedule items
            document.querySelectorAll('.schedule-item').forEach(item => {
                item.classList.remove('current');
            });
            
            // Simple logic to highlight current class based on time
            if (currentHour >= 9 && currentHour < 10) {
                // 9:00 AM - 10:00 AM class
                document.querySelectorAll('.schedule-item')[0].classList.add('current');
            } else if (currentHour >= 10 && currentHour < 11) {
                // 10:15 AM - 11:15 AM class
                document.querySelectorAll('.schedule-item')[1].classList.add('current');
            } else if (currentHour >= 13 && currentHour < 14) {
                // 1:00 PM - 2:00 PM class
                document.querySelectorAll('.schedule-item')[2].classList.add('current');
            } else if (currentHour >= 14 && currentHour < 15) {
                // 2:15 PM - 3:15 PM class
                document.querySelectorAll('.schedule-item')[3].classList.add('current');
            }
        }
        
        // Update time-based indicators on page load
        updateCurrentClass();
        
        // Update every minute
        setInterval(updateCurrentClass, 60000);
        
        // Simulate real-time updates
        function simulateRealTimeUpdates() {
            // Randomly update attendance percentage
            const attendanceElement = document.querySelector('.stat-card.attendance .stat-info h3');
            let attendance = parseInt(attendanceElement.textContent);
            
            // Small random fluctuation
            const change = Math.random() > 0.5 ? 1 : -1;
            attendance += change;
            
            // Keep within reasonable bounds
            if (attendance < 85) attendance = 85;
            if (attendance > 98) attendance = 98;
            
            attendanceElement.textContent = attendance + '%';
            
            // Update student count (occasionally)
            if (Math.random() > 0.8) {
                const studentElement = document.querySelector('.stat-card.students .stat-info h3');
                let students = parseInt(studentElement.textContent);
                
                // Small change
                students += Math.random() > 0.5 ? 1 : -1;
                
                // Keep within reasonable bounds
                if (students < 135) students = 135;
                if (students > 148) students = 148;
                
                studentElement.textContent = students;
            }
        }
        
        // Update stats every 30 seconds
        setInterval(simulateRealTimeUpdates, 30000);
        
        // Notification click handlers
        document.querySelectorAll('.header-action').forEach(action => {
            action.addEventListener('click', function() {
                if (this.querySelector('.notification-badge')) {
                    const badge = this.querySelector('.notification-badge');
                    const currentCount = parseInt(badge.textContent);
                    
                    if (currentCount > 0) {
                        badge.textContent = currentCount - 1;
                        
                        if (currentCount - 1 === 0) {
                            badge.style.display = 'none';
                        }
                    }
                    
                    // Show appropriate content based on icon
                    const icon = this.querySelector('i').className;
                    
                    if (icon.includes('bell')) {
                        alert('Showing notifications...');
                    } else if (icon.includes('envelope')) {
                        alert('Showing messages...');
                    } else if (icon.includes('search')) {
                        alert('Opening search...');
                    } else if (icon.includes('user-circle')) {
                        alert('Opening profile...');
                    }
                }
            });
        });
        
        // Welcome message update based on time of day
        function updateWelcomeMessage() {
            const welcomeElement = document.querySelector('.welcome-text h2');
            const now = new Date();
            const hour = now.getHours();
            
            let greeting = "Good ";
            
            if (hour < 12) {
                greeting += "morning";
            } else if (hour < 18) {
                greeting += "afternoon";
            } else {
                greeting += "evening";
            }
            
            welcomeElement.textContent = `${greeting}, Mr. Robert Smith!`;
        }
        
        // Update welcome message on page load
        updateWelcomeMessage();
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if(window.innerWidth >= 992) {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            }
        });
        
        // Add active class to clicked menu items
        document.querySelectorAll('.sidebar-menu .menu-item').forEach(item => {
            item.addEventListener('click', function(e) {
                // Don't prevent default for anchor tags
                if(this.getAttribute('href') === '#') {
                    e.preventDefault();
                }
                
                // Remove active class from all menu items
                document.querySelectorAll('.sidebar-menu .menu-item').forEach(i => {
                    i.classList.remove('active');
                });
                
                // Add active class to clicked item
                this.classList.add('active');
            });
        });
        
        // Keyboard shortcuts for staff
        document.addEventListener('keydown', function(e) {
            // Ctrl + A for attendance
            if (e.ctrlKey && e.key === 'a') {
                e.preventDefault();
                takeAttendanceBtn.click();
            }
            
            // Ctrl + R for results
            if (e.ctrlKey && e.key === 'r') {
                e.preventDefault();
                uploadResultsBtn.click();
            }
            
            // Ctrl + M for messages
            if (e.ctrlKey && e.key === 'm') {
                e.preventDefault();
                sendMessageBtn.click();
            }
        });
    </script>
</body>
</html>