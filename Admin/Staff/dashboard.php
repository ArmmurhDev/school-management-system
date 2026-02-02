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
        
        /* Welcome Section */
        .welcome-section {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-medium));
            border-radius: 15px;
            padding: 30px;
            color: var(--white);
            margin-bottom: 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 10px 30px rgba(0, 51, 102, 0.2);
        }
        
        .welcome-text h2 {
            font-size: 1.8rem;
            color: var(--white);
            margin-bottom: 10px;
        }
        
        .welcome-text p {
            opacity: 0.9;
            max-width: 600px;
        }
        
        .welcome-date {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 15px 25px;
            border-radius: 10px;
            text-align: center;
        }
        
        .welcome-date .day {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .welcome-date .date {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        /* Stats Cards */
        .stats-cards {
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
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-left: 5px solid var(--primary-medium);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 51, 102, 0.15);
        }
        
        .stat-card.students {
            border-left-color: var(--accent-blue);
        }
        
        .stat-card.classes {
            border-left-color: var(--success);
        }
        
        .stat-card.tasks {
            border-left-color: var(--warning);
        }
        
        .stat-card.announcements {
            border-left-color: var(--info);
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
        
        .stat-card.students .stat-icon {
            background-color: rgba(30, 136, 229, 0.1);
            color: var(--accent-blue);
        }
        
        .stat-card.classes .stat-icon {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }
        
        .stat-card.tasks .stat-icon {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning);
        }
        
        .stat-card.announcements .stat-icon {
            background-color: rgba(23, 162, 184, 0.1);
            color: var(--info);
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
            padding: 30px;
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
            border-left: 4px solid var(--primary-light);
            background-color: #f9f9f9;
            transition: all 0.3s;
        }
        
        .schedule-item:hover {
            background-color: var(--light-bg);
            transform: translateX(5px);
        }
        
        .schedule-item.active {
            border-left-color: var(--accent-blue);
            background-color: rgba(30, 136, 229, 0.05);
        }
        
        .schedule-item.completed {
            border-left-color: var(--success);
            opacity: 0.8;
        }
        
        .schedule-time {
            font-weight: 600;
            color: var(--primary-medium);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }
        
        .schedule-time i {
            margin-right: 10px;
        }
        
        .schedule-details h4 {
            font-size: 1rem;
            margin-bottom: 5px;
        }
        
        .schedule-details p {
            color: var(--text-light);
            font-size: 0.9rem;
        }
        
        /* Quick Actions */
        .actions-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 15px var(--shadow);
        }
        
        .actions-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        
        @media (max-width: 768px) {
            .actions-grid {
                grid-template-columns: 1fr;
            }
        }
        
        .action-item {
            background-color: var(--light-bg);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            border: 1px solid rgba(77, 143, 204, 0.2);
        }
        
        .action-item:hover {
            background-color: #e3f2fd;
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 51, 102, 0.1);
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
            color: var(--primary-medium);
            font-size: 1.3rem;
        }
        
        .action-item h4 {
            font-size: 1rem;
            margin-bottom: 5px;
        }
        
        .action-item p {
            color: var(--text-light);
            font-size: 0.85rem;
        }
        
        /* Recent Students */
        .recent-students-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 15px var(--shadow);
            margin-bottom: 40px;
        }
        
        .table-responsive {
            overflow-x: auto;
        }
        
        .students-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .students-table thead {
            background-color: var(--light-bg);
        }
        
        .students-table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: var(--primary-dark);
            border-bottom: 2px solid #eee;
            white-space: nowrap;
        }
        
        .students-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }
        
        .students-table tbody tr {
            transition: all 0.3s;
        }
        
        .students-table tbody tr:hover {
            background-color: #f9f9f9;
        }
        
        .student-info {
            display: flex;
            align-items: center;
        }
        
        .student-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 15px;
        }
        
        .student-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .student-name {
            font-weight: 500;
            margin-bottom: 3px;
        }
        
        .student-id {
            font-size: 0.85rem;
            color: var(--text-light);
        }
        
        .grade-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
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
        
        /* Upcoming Events */
        .events-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 15px var(--shadow);
        }
        
        .events-list {
            list-style: none;
        }
        
        .event-item {
            padding: 20px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: flex-start;
        }
        
        .event-item:last-child {
            border-bottom: none;
        }
        
        .event-date {
            min-width: 60px;
            text-align: center;
            margin-right: 20px;
        }
        
        .event-day {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-medium);
            line-height: 1;
        }
        
        .event-month {
            font-size: 0.9rem;
            color: var(--text-light);
            text-transform: uppercase;
        }
        
        .event-details h4 {
            font-size: 1rem;
            margin-bottom: 8px;
        }
        
        .event-details p {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 10px;
        }
        
        .event-time {
            display: flex;
            align-items: center;
            color: var(--primary-medium);
            font-size: 0.85rem;
        }
        
        .event-time i {
            margin-right: 8px;
        }
        
        /* Announcements */
        .announcements-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 15px var(--shadow);
            margin-bottom: 40px;
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
        
        .announcement-item.important {
            border-left-color: var(--warning);
            background-color: rgba(255, 193, 7, 0.05);
        }
        
        .announcement-item.urgent {
            border-left-color: var(--danger);
            background-color: rgba(220, 53, 69, 0.05);
        }
        
        .announcement-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }
        
        .announcement-title {
            font-weight: 600;
            color: var(--primary-dark);
        }
        
        .announcement-time {
            font-size: 0.85rem;
            color: var(--text-light);
        }
        
        .announcement-content {
            color: var(--text-light);
            font-size: 0.95rem;
            line-height: 1.6;
        }
        
        .announcement-sender {
            display: flex;
            align-items: center;
            margin-top: 15px;
            font-size: 0.9rem;
            color: var(--primary-medium);
        }
        
        .announcement-sender i {
            margin-right: 8px;
        }
        
        /* Performance Chart */
        .performance-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 15px var(--shadow);
        }
        
        .chart-container {
            height: 300px;
            position: relative;
            margin-top: 20px;
        }
        
        .chart-placeholder {
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #f9f9f9;
            border-radius: 8px;
            color: #888;
        }
        
        .chart-placeholder i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: var(--primary-light);
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
            
            .welcome-section {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }
            
            .welcome-date {
                align-self: stretch;
                text-align: left;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }
        }
        
        @media (max-width: 768px) {
            .top-header {
                padding: 20px;
            }
            
            .dashboard-content {
                padding: 20px;
            }
            
            .stats-cards {
                grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            }
            
            .welcome-text h2 {
                font-size: 1.5rem;
            }
            
            .students-table th,
            .students-table td {
                padding: 10px 5px;
                font-size: 0.85rem;
            }
        }
        
        @media (max-width: 576px) {
            .stats-cards {
                grid-template-columns: 1fr;
            }
            
            .stat-card {
                padding: 20px;
            }
            
            .welcome-section {
                padding: 20px;
            }
            
            .event-item {
                flex-direction: column;
            }
            
            .event-date {
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
                    <p>Staff Portal</p>
                </div>
            </div>
            
            <div class="sidebar-menu">
                <a href="staff-dashboard.html" class="menu-item active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
                
                <a href="my-classes.html" class="menu-item">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span class="menu-text">My Classes</span>
                </a>
                
                <a href="my-students.html" class="menu-item">
                    <i class="fas fa-users"></i>
                    <span class="menu-text">My Students</span>
                </a>
                
                <a href="attendance.html" class="menu-item">
                    <i class="fas fa-calendar-check"></i>
                    <span class="menu-text">Attendance</span>
                </a>
                
                <a href="grades.html" class="menu-item">
                    <i class="fas fa-chart-bar"></i>
                    <span class="menu-text">Grades & Results</span>
                </a>
                
                <a href="timetable.html" class="menu-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span class="menu-text">Timetable</span>
                </a>
                
                <a href="messages.html" class="menu-item">
                    <i class="fas fa-envelope"></i>
                    <span class="menu-text">Messages</span>
                </a>
            </div>
            
            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">
                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Teacher">
                    </div>
                    <div class="user-details">
                        <h4>Mr. David Chen</h4>
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
                <!-- Welcome Section -->
                <div class="welcome-section">
                    <div class="welcome-text">
                        <h2>Welcome back, Mr. David Chen!</h2>
                        <p>Here's what's happening with your classes today. You have 3 classes scheduled and 2 pending tasks to complete.</p>
                    </div>
                    
                    <div class="welcome-date">
                        <div class="day">Tuesday</div>
                        <div class="date">October 17, 2023</div>
                    </div>
                </div>
                
                <!-- Stats Cards -->
                <div class="stats-cards">
                    <div class="stat-card students">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <h3>142</h3>
                            <p>Total Students</p>
                        </div>
                    </div>
                    
                    <div class="stat-card classes">
                        <div class="stat-icon">
                            <i class="fas fa-chalkboard"></i>
                        </div>
                        <div class="stat-info">
                            <h3>6</h3>
                            <p>Active Classes</p>
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
                    
                    <div class="stat-card announcements">
                        <div class="stat-icon">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <div class="stat-info">
                            <h3>5</h3>
                            <p>New Announcements</p>
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
                                <a href="timetable.html" class="view-all">View Full Timetable</a>
                            </div>
                            
                            <ul class="schedule-list">
                                <li class="schedule-item active">
                                    <div class="schedule-time">
                                        <i class="far fa-clock"></i> 8:00 AM - 9:30 AM
                                    </div>
                                    <div class="schedule-details">
                                        <h4>Mathematics - Grade 10A</h4>
                                        <p>Room 205 | Topic: Calculus Fundamentals</p>
                                    </div>
                                </li>
                                
                                <li class="schedule-item">
                                    <div class="schedule-time">
                                        <i class="far fa-clock"></i> 10:00 AM - 11:30 AM
                                    </div>
                                    <div class="schedule-details">
                                        <h4>Mathematics - Grade 9B</h4>
                                        <p>Room 210 | Topic: Algebraic Equations</p>
                                    </div>
                                </li>
                                
                                <li class="schedule-item">
                                    <div class="schedule-time">
                                        <i class="far fa-clock"></i> 1:00 PM - 2:30 PM
                                    </div>
                                    <div class="schedule-details">
                                        <h4>Advanced Mathematics - Grade 11</h4>
                                        <p>Room 305 | Topic: Trigonometry Applications</p>
                                    </div>
                                </li>
                                
                                <li class="schedule-item completed">
                                    <div class="schedule-time">
                                        <i class="far fa-clock"></i> 3:00 PM - 4:30 PM
                                    </div>
                                    <div class="schedule-details">
                                        <h4>Mathematics Club Meeting</h4>
                                        <p>Library | Preparing for Math Olympiad</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Recent Students -->
                        <div class="recent-students-card">
                            <div class="card-header">
                                <h3>Recent Student Performance</h3>
                                <a href="my-students.html" class="view-all">View All Students</a>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="students-table">
                                    <thead>
                                        <tr>
                                            <th>Student</th>
                                            <th>Class</th>
                                            <th>Recent Test</th>
                                            <th>Grade</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="student-info">
                                                    <div class="student-avatar">
                                                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Student">
                                                    </div>
                                                    <div>
                                                        <div class="student-name">Michael Johnson</div>
                                                        <div class="student-id">ID: STU-2023-045</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Grade 10A</td>
                                            <td>Calculus Test</td>
                                            <td><span class="grade-badge grade-a">92%</span></td>
                                            <td>Excellent</td>
                                        </tr>
                                        
                                        <tr>
                                            <td>
                                                <div class="student-info">
                                                    <div class="student-avatar">
                                                        <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Student">
                                                    </div>
                                                    <div>
                                                        <div class="student-name">Sarah Williams</div>
                                                        <div class="student-id">ID: STU-2023-046</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Grade 9B</td>
                                            <td>Algebra Test</td>
                                            <td><span class="grade-badge grade-b">85%</span></td>
                                            <td>Good</td>
                                        </tr>
                                        
                                        <tr>
                                            <td>
                                                <div class="student-info">
                                                    <div class="student-avatar">
                                                        <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Student">
                                                    </div>
                                                    <div>
                                                        <div class="student-name">James Wilson</div>
                                                        <div class="student-id">ID: STU-2023-047</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Grade 11</td>
                                            <td>Trigonometry Test</td>
                                            <td><span class="grade-badge grade-c">72%</span></td>
                                            <td>Needs Improvement</td>
                                        </tr>
                                        
                                        <tr>
                                            <td>
                                                <div class="student-info">
                                                    <div class="student-avatar">
                                                        <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Student">
                                                    </div>
                                                    <div>
                                                        <div class="student-name">Emily Davis</div>
                                                        <div class="student-id">ID: STU-2023-048</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Grade 10A</td>
                                            <td>Calculus Test</td>
                                            <td><span class="grade-badge grade-a">95%</span></td>
                                            <td>Excellent</td>
                                        </tr>
                                        
                                        <tr>
                                            <td>
                                                <div class="student-info">
                                                    <div class="student-avatar">
                                                        <img src="https://randomuser.me/api/portraits/men/55.jpg" alt="Student">
                                                    </div>
                                                    <div>
                                                        <div class="student-name">Robert Chen</div>
                                                        <div class="student-id">ID: STU-2023-049</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Grade 9B</td>
                                            <td>Algebra Test</td>
                                            <td><span class="grade-badge grade-b">88%</span></td>
                                            <td>Good</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
                                <div class="action-item" data-action="attendance">
                                    <div class="action-icon">
                                        <i class="fas fa-clipboard-check"></i>
                                    </div>
                                    <h4>Take Attendance</h4>
                                    <p>Mark today's attendance</p>
                                </div>
                                
                                <div class="action-item" data-action="grades">
                                    <div class="action-icon">
                                        <i class="fas fa-edit"></i>
                                    </div>
                                    <h4>Enter Grades</h4>
                                    <p>Update student scores</p>
                                </div>
                                
                                <div class="action-item" data-action="lesson">
                                    <div class="action-icon">
                                        <i class="fas fa-book-open"></i>
                                    </div>
                                    <h4>Plan Lesson</h4>
                                    <p>Create new lesson plan</p>
                                </div>
                                
                                <div class="action-item" data-action="assignment">
                                    <div class="action-icon">
                                        <i class="fas fa-tasks"></i>
                                    </div>
                                    <h4>Create Assignment</h4>
                                    <p>Set new homework</p>
                                </div>
                                
                                <div class="action-item" data-action="message">
                                    <div class="action-icon">
                                        <i class="fas fa-comments"></i>
                                    </div>
                                    <h4>Message Parents</h4>
                                    <p>Send updates to parents</p>
                                </div>
                                
                                <div class="action-item" data-action="report">
                                    <div class="action-icon">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                    <h4>Generate Report</h4>
                                    <p>Create class performance report</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Upcoming Events -->
                        <div class="events-card">
                            <div class="card-header">
                                <h3>Upcoming Events</h3>
                                <a href="events.html" class="view-all">View Calendar</a>
                            </div>
                            
                            <ul class="events-list">
                                <li class="event-item">
                                    <div class="event-date">
                                        <div class="event-day">20</div>
                                        <div class="event-month">OCT</div>
                                    </div>
                                    <div class="event-details">
                                        <h4>Parent-Teacher Conference</h4>
                                        <p>Meeting with parents to discuss student progress</p>
                                        <div class="event-time">
                                            <i class="far fa-clock"></i> 2:00 PM - 5:00 PM
                                        </div>
                                    </div>
                                </li>
                                
                                <li class="event-item">
                                    <div class="event-date">
                                        <div class="event-day">25</div>
                                        <div class="event-month">OCT</div>
                                    </div>
                                    <div class="event-details">
                                        <h4>Math Olympiad Practice</h4>
                                        <p>Extra practice session for competition team</p>
                                        <div class="event-time">
                                            <i class="far fa-clock"></i> 3:30 PM - 5:30 PM
                                        </div>
                                    </div>
                                </li>
                                
                                <li class="event-item">
                                    <div class="event-date">
                                        <div class="event-day">28</div>
                                        <div class="event-month">OCT</div>
                                    </div>
                                    <div class="event-details">
                                        <h4>Quarterly Exam</h4>
                                        <p>Grade 10 Mathematics quarterly examination</p>
                                        <div class="event-time">
                                            <i class="far fa-clock"></i> 9:00 AM - 11:00 AM
                                        </div>
                                    </div>
                                </li>
                                
                                <li class="event-item">
                                    <div class="event-date">
                                        <div class="event-day">02</div>
                                        <div class="event-month">NOV</div>
                                    </div>
                                    <div class="event-details">
                                        <h4>Staff Development Workshop</h4>
                                        <p>Innovative teaching methodologies session</p>
                                        <div class="event-time">
                                            <i class="far fa-clock"></i> 10:00 AM - 1:00 PM
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Announcements -->
                        <div class="announcements-card">
                            <div class="card-header">
                                <h3>Recent Announcements</h3>
                                <a href="announcements.html" class="view-all">View All</a>
                            </div>
                            
                            <ul class="announcements-list">
                                <li class="announcement-item important">
                                    <div class="announcement-header">
                                        <div class="announcement-title">Quarterly Exam Schedule</div>
                                        <div class="announcement-time">2 hours ago</div>
                                    </div>
                                    <div class="announcement-content">
                                        The quarterly examination schedule has been published. Please check the timetable and prepare your students accordingly.
                                    </div>
                                    <div class="announcement-sender">
                                        <i class="fas fa-user"></i> From: Academic Office
                                    </div>
                                </li>
                                
                                <li class="announcement-item">
                                    <div class="announcement-header">
                                        <div class="announcement-title">New Teaching Resources</div>
                                        <div class="announcement-time">1 day ago</div>
                                    </div>
                                    <div class="announcement-content">
                                        New digital teaching resources have been added to the staff portal. These include interactive lesson plans and assessment tools.
                                    </div>
                                    <div class="announcement-sender">
                                        <i class="fas fa-user"></i> From: IT Department
                                    </div>
                                </li>
                                
                                <li class="announcement-item urgent">
                                    <div class="announcement-header">
                                        <div class="announcement-title">Staff Meeting - Tomorrow</div>
                                        <div class="announcement-time">2 days ago</div>
                                    </div>
                                    <div class="announcement-content">
                                        Mandatory staff meeting tomorrow at 3:00 PM in the conference room. Agenda includes curriculum updates and student performance review.
                                    </div>
                                    <div class="announcement-sender">
                                        <i class="fas fa-user"></i> From: Principal's Office
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Performance Chart -->
                <div class="performance-card">
                    <div class="card-header">
                        <h3>Class Performance Overview</h3>
                        <div>
                            <select id="performancePeriod" style="padding: 8px 15px; border-radius: 6px; border: 1px solid #ddd;">
                                <option>Last 30 Days</option>
                                <option>Last 3 Months</option>
                                <option selected>Current Term</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="chart-container">
                        <!-- Chart placeholder (in real app, would use Chart.js) -->
                        <div class="chart-placeholder">
                            <i class="fas fa-chart-line"></i>
                            <p>Class Performance Chart</p>
                            <p style="font-size: 0.9rem;">(Chart.js would be implemented here)</p>
                        </div>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="dashboard-footer">
                    <p>&copy; 2023 T&T School Management System. All rights reserved. | Staff Dashboard v2.0</p>
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
        const actionItems = document.querySelectorAll('.action-item');
        const notificationBadges = document.querySelectorAll('.notification-badge');
        const performancePeriod = document.getElementById('performancePeriod');
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            setupEventListeners();
            updateWelcomeMessage();
            simulateRealTimeUpdates();
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
            
            // Quick action items
            actionItems.forEach(item => {
                item.addEventListener('click', function() {
                    const action = this.dataset.action;
                    handleQuickAction(action);
                });
            });
            
            // Notification badges click
            notificationBadges.forEach(badge => {
                badge.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const currentCount = parseInt(this.textContent);
                    if (currentCount > 0) {
                        this.textContent = currentCount - 1;
                        
                        if (currentCount - 1 === 0) {
                            this.style.display = 'none';
                        }
                    }
                });
            });
            
            // Header action buttons
            document.querySelectorAll('.header-action').forEach(action => {
                action.addEventListener('click', function() {
                    const icon = this.querySelector('i').className;
                    
                    if (icon.includes('fa-search')) {
                        // Search functionality
                        const searchQuery = prompt('Search for students, classes, or resources:');
                        if (searchQuery) {
                            alert(`Searching for: "${searchQuery}"`);
                        }
                    } else if (icon.includes('fa-bell')) {
                        // Notifications
                        alert('Showing notifications panel');
                    } else if (icon.includes('fa-envelope')) {
                        // Messages
                        alert('Opening messages');
                    } else if (icon.includes('fa-user-circle')) {
                        // User profile
                        alert('Opening user profile');
                    }
                });
            });
            
            // Performance period change
            if (performancePeriod) {
                performancePeriod.addEventListener('change', function() {
                    const period = this.value;
                    alert(`Updating performance chart for: ${period}`);
                });
            }
            
            // View all links
            document.querySelectorAll('.view-all').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = this.getAttribute('href');
                    alert(`Navigating to: ${target}`);
                });
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
        }
        
        // Handle quick actions
        function handleQuickAction(action) {
            switch(action) {
                case 'attendance':
                    alert('Opening attendance marking interface...');
                    break;
                case 'grades':
                    alert('Opening grade entry interface...');
                    break;
                case 'lesson':
                    alert('Opening lesson planner...');
                    break;
                case 'assignment':
                    alert('Creating new assignment...');
                    break;
                case 'message':
                    alert('Opening parent messaging interface...');
                    break;
                case 'report':
                    alert('Generating class performance report...');
                    break;
                default:
                    alert(`Action: ${action}`);
            }
        }
        
        // Update welcome message based on time of day
        function updateWelcomeMessage() {
            const hour = new Date().getHours();
            let greeting = '';
            
            if (hour < 12) {
                greeting = 'Good morning';
            } else if (hour < 18) {
                greeting = 'Good afternoon';
            } else {
                greeting = 'Good evening';
            }
            
            const welcomeHeading = document.querySelector('.welcome-text h2');
            if (welcomeHeading) {
                welcomeHeading.textContent = `${greeting}, Mr. David Chen!`;
            }
        }
        
        // Simulate real-time updates
        function simulateRealTimeUpdates() {
            // Update stats every 30 seconds with small random variations
            setInterval(() => {
                const statCards = document.querySelectorAll('.stat-info h3');
                
                // Update student count
                let studentCount = parseInt(statCards[0].textContent.replace(/,/g, ''));
                studentCount += Math.floor(Math.random() * 2); // Small random increase
                statCards[0].textContent = studentCount.toLocaleString();
                
                // Update task count (more dynamic)
                let taskCount = parseInt(statCards[2].textContent.replace(/,/g, ''));
                taskCount += Math.floor(Math.random() * 3) - 1; // Random change between -1 and +1
                if (taskCount < 0) taskCount = 0;
                statCards[2].textContent = taskCount;
                
                // Update announcement count
                let announcementCount = parseInt(statCards[3].textContent.replace(/,/g, ''));
                if (Math.random() > 0.8) announcementCount += 1; // 20% chance of new announcement
                statCards[3].textContent = announcementCount;
                
            }, 30000);
            
            // Update schedule item status based on current time
            setInterval(() => {
                const scheduleItems = document.querySelectorAll('.schedule-item');
                const now = new Date();
                const currentHour = now.getHours();
                const currentMinute = now.getMinutes();
                const currentTime = currentHour * 60 + currentMinute;
                
                scheduleItems.forEach(item => {
                    const timeText = item.querySelector('.schedule-time').textContent;
                    const timeMatch = timeText.match(/(\d+):(\d+)/);
                    
                    if (timeMatch) {
                        const hour = parseInt(timeMatch[1]);
                        const minute = parseInt(timeMatch[2]);
                        const scheduleTime = hour * 60 + minute;
                        
                        // Remove all status classes
                        item.classList.remove('active', 'completed');
                        
                        // Check if this class is currently happening (within 90 minutes of start)
                        if (Math.abs(currentTime - scheduleTime) <= 90 && currentTime >= scheduleTime) {
                            item.classList.add('active');
                        } 
                        // Mark as completed if it's in the past
                        else if (currentTime > scheduleTime + 90) {
                            item.classList.add('completed');
                        }
                    }
                });
            }, 60000); // Update every minute
        }
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if(window.innerWidth >= 992) {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            }
        });
        
        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl + A for attendance
            if (e.ctrlKey && e.key === 'a') {
                e.preventDefault();
                handleQuickAction('attendance');
            }
            
            // Ctrl + G for grades
            if (e.ctrlKey && e.key === 'g') {
                e.preventDefault();
                handleQuickAction('grades');
            }
            
            // Escape to close sidebar
            if (e.key === 'Escape' && window.innerWidth < 992) {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            }
        });
        
        // Add click effect to action items
        actionItems.forEach(item => {
            item.addEventListener('mousedown', function() {
                this.style.transform = 'scale(0.95)';
            });
            
            item.addEventListener('mouseup', function() {
                this.style.transform = '';
            });
            
            item.addEventListener('mouseleave', function() {
                this.style.transform = '';
            });
        });
    </script>
</body>
</html>