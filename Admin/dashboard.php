<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T&T School - Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        
        .menu-item.active .menu-text {
            font-weight: 600;
        }
        
        .menu-item.has-submenu {
            position: relative;
        }
        
        .submenu {
            padding-left: 55px;
            background-color: rgba(0, 0, 0, 0.1);
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }
        
        .submenu.active {
            max-height: 300px;
        }
        
        .submenu-item {
            padding: 12px 0;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            display: block;
            transition: color 0.3s;
        }
        
        .submenu-item:hover {
            color: var(--white);
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
        
        .stat-card.teachers {
            border-left-color: var(--success);
        }
        
        .stat-card.classes {
            border-left-color: var(--warning);
        }
        
        .stat-card.revenue {
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
        
        .stat-card.students .stat-icon {
            background-color: rgba(30, 136, 229, 0.1);
            color: var(--accent-blue);
        }
        
        .stat-card.teachers .stat-icon {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }
        
        .stat-card.classes .stat-icon {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning);
        }
        
        .stat-card.revenue .stat-icon {
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
        
        /* Charts Section */
        .charts-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }
        
        .chart-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 15px var(--shadow);
        }
        
        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .chart-header h3 {
            font-size: 1.3rem;
        }
        
        .chart-container {
            height: 300px;
            position: relative;
        }
        
        /* Recent Activity & Quick Actions */
        .activity-actions {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }
        
        .activity-card, .actions-card {
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
        
        .activity-list {
            list-style: none;
        }
        
        .activity-item {
            padding: 15px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
        }
        
        .activity-item:last-child {
            border-bottom: none;
        }
        
        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1rem;
        }
        
        .activity-icon.student {
            background-color: rgba(30, 136, 229, 0.1);
            color: var(--accent-blue);
        }
        
        .activity-icon.teacher {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }
        
        .activity-icon.fee {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger);
        }
        
        .activity-icon.event {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning);
        }
        
        .activity-details {
            flex: 1;
        }
        
        .activity-details h4 {
            font-size: 0.95rem;
            margin-bottom: 5px;
        }
        
        .activity-details p {
            color: var(--text-light);
            font-size: 0.85rem;
        }
        
        .activity-time {
            color: var(--text-light);
            font-size: 0.8rem;
        }
        
        .actions-list {
            list-style: none;
        }
        
        .action-item {
            padding: 15px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
        }
        
        .action-item:last-child {
            border-bottom: none;
        }
        
        .action-icon {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            background-color: var(--light-bg);
            color: var(--primary-medium);
            font-size: 1.2rem;
        }
        
        .action-details h4 {
            font-size: 0.95rem;
            margin-bottom: 5px;
        }
        
        .action-details p {
            color: var(--text-light);
            font-size: 0.85rem;
        }
        
        /* Recent Students Table */
        .recent-table-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 15px var(--shadow);
            margin-bottom: 40px;
        }
        
        .table-responsive {
            overflow-x: auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        thead {
            background-color: var(--light-bg);
        }
        
        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: var(--primary-dark);
            border-bottom: 2px solid #eee;
        }
        
        td {
            padding: 15px;
            border-bottom: 1px solid #eee;
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
        
        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .status-badge.active {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }
        
        .status-badge.inactive {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger);
        }
        
        .action-btn {
            padding: 6px 12px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .action-btn.view {
            background-color: rgba(30, 136, 229, 0.1);
            color: var(--accent-blue);
        }
        
        .action-btn.edit {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning);
        }
        
        .action-btn.delete {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger);
        }
        
        .action-btn:hover {
            opacity: 0.8;
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
            .charts-section {
                grid-template-columns: 1fr;
            }
            
            .activity-actions {
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
        }
        
        @media (max-width: 768px) {
            .stats-cards {
                grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            }
            
            .chart-container {
                height: 250px;
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
            .stats-cards {
                grid-template-columns: 1fr;
            }
            
            .stat-card {
                padding: 20px;
            }
            
            .chart-card, .activity-card, .actions-card, .recent-table-card {
                padding: 20px;
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
                    <p>Admin Dashboard</p>
                </div>
            </div>
            
            <div class="sidebar-menu">
                <a href="#" class="menu-item active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
                
                <a href="#" class="menu-item">
                    <i class="fas fa-users"></i>
                    <span class="menu-text">Students</span>
                </a>
                
                <a href="#" class="menu-item">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span class="menu-text">Teachers</span>
                </a>
                
                <a href="#" class="menu-item">
                    <i class="fas fa-book"></i>
                    <span class="menu-text">Classes</span>
                </a>
                
                <a href="#" class="menu-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span class="menu-text">Attendance</span>
                </a>
                
                <a href="#" class="menu-item">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span class="menu-text">Fees</span>
                </a>
                
                <a href="#" class="menu-item">
                    <i class="fas fa-chart-bar"></i>
                    <span class="menu-text">Reports</span>
                </a>
                
                <a href="#" class="menu-item">
                    <i class="fas fa-cog"></i>
                    <span class="menu-text">Settings</span>
                </a>
            </div>
            
            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Admin">
                    </div>
                    <div class="user-details">
                        <h4>Admin User</h4>
                        <p>Super Administrator</p>
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
                        <h1>Dashboard Overview</h1>
                    </div>
                </div>
                
                <div class="header-right">
                    <div class="header-action">
                        <i class="fas fa-search"></i>
                    </div>
                    
                    <div class="header-action">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">5</span>
                    </div>
                    
                    <div class="header-action">
                        <i class="fas fa-envelope"></i>
                        <span class="notification-badge">3</span>
                    </div>
                    
                    <div class="header-action">
                        <i class="fas fa-user-circle"></i>
                    </div>
                </div>
            </div>
            
            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <!-- Stats Cards -->
                <div class="stats-cards">
                    <div class="stat-card students">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <h3>1,245</h3>
                            <p>Total Students</p>
                        </div>
                    </div>
                    
                    <div class="stat-card teachers">
                        <div class="stat-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="stat-info">
                            <h3>68</h3>
                            <p>Total Teachers</p>
                        </div>
                    </div>
                    
                    <div class="stat-card classes">
                        <div class="stat-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="stat-info">
                            <h3>42</h3>
                            <p>Active Classes</p>
                        </div>
                    </div>
                    
                    <div class="stat-card revenue">
                        <div class="stat-icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="stat-info">
                            <h3>$124,580</h3>
                            <p>Annual Revenue</p>
                        </div>
                    </div>
                </div>
                
                <!-- Charts Section -->
                <div class="charts-section">
                    <div class="chart-card">
                        <div class="chart-header">
                            <h3>Student Enrollment Trend</h3>
                            <select class="period-select">
                                <option>Last 7 days</option>
                                <option>Last 30 days</option>
                                <option selected>Last 12 months</option>
                            </select>
                        </div>
                        <div class="chart-container">
                            <!-- Chart will be implemented with Chart.js in real application -->
                            <div style="height: 100%; display: flex; align-items: center; justify-content: center; background-color: #f9f9f9; border-radius: 8px;">
                                <div style="text-align: center; color: #888;">
                                    <i class="fas fa-chart-line" style="font-size: 3rem; margin-bottom: 10px;"></i>
                                    <p>Student Enrollment Chart</p>
                                    <p style="font-size: 0.9rem;">(Chart.js would be implemented here)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="chart-card">
                        <div class="chart-header">
                            <h3>Fee Collection Status</h3>
                            <select class="period-select">
                                <option>Current Month</option>
                                <option selected>Current Quarter</option>
                                <option>Current Year</option>
                            </select>
                        </div>
                        <div class="chart-container">
                            <!-- Chart will be implemented with Chart.js in real application -->
                            <div style="height: 100%; display: flex; align-items: center; justify-content: center; background-color: #f9f9f9; border-radius: 8px;">
                                <div style="text-align: center; color: #888;">
                                    <i class="fas fa-chart-pie" style="font-size: 3rem; margin-bottom: 10px;"></i>
                                    <p>Fee Collection Chart</p>
                                    <p style="font-size: 0.9rem;">(Chart.js would be implemented here)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Activity & Quick Actions -->
                <div class="activity-actions">
                    <div class="activity-card">
                        <div class="card-header">
                            <h3>Recent Activity</h3>
                            <a href="#" class="view-all">View All</a>
                        </div>
                        <ul class="activity-list">
                            <li class="activity-item">
                                <div class="activity-icon student">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="activity-details">
                                    <h4>New Student Registered</h4>
                                    <p>Michael Johnson enrolled in Grade 10</p>
                                </div>
                                <div class="activity-time">10 min ago</div>
                            </li>
                            
                            <li class="activity-item">
                                <div class="activity-icon fee">
                                    <i class="fas fa-money-check-alt"></i>
                                </div>
                                <div class="activity-details">
                                    <h4>Fee Payment Received</h4>
                                    <p>Sarah Williams paid quarterly fee</p>
                                </div>
                                <div class="activity-time">1 hour ago</div>
                            </li>
                            
                            <li class="activity-item">
                                <div class="activity-icon teacher">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                <div class="activity-details">
                                    <h4>New Teacher Joined</h4>
                                    <p>Mr. Robert Chen joined as Physics teacher</p>
                                </div>
                                <div class="activity-time">3 hours ago</div>
                            </li>
                            
                            <li class="activity-item">
                                <div class="activity-icon event">
                                    <i class="fas fa-calendar-day"></i>
                                </div>
                                <div class="activity-details">
                                    <h4>Upcoming Event</h4>
                                    <p>Annual Sports Day scheduled for next week</p>
                                </div>
                                <div class="activity-time">1 day ago</div>
                            </li>
                            
                            <li class="activity-item">
                                <div class="activity-icon student">
                                    <i class="fas fa-award"></i>
                                </div>
                                <div class="activity-details">
                                    <h4>Student Achievement</h4>
                                    <p>Emily Davis won Science Fair competition</p>
                                </div>
                                <div class="activity-time">2 days ago</div>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="actions-card">
                        <div class="card-header">
                            <h3>Quick Actions</h3>
                        </div>
                        <ul class="actions-list">
                            <li class="action-item">
                                <div class="action-icon">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="action-details">
                                    <h4>Add New Student</h4>
                                    <p>Register a new student</p>
                                </div>
                            </li>
                            
                            <li class="action-item">
                                <div class="action-icon">
                                    <i class="fas fa-file-invoice"></i>
                                </div>
                                <div class="action-details">
                                    <h4>Generate Fee Receipt</h4>
                                    <p>Create fee receipt for student</p>
                                </div>
                            </li>
                            
                            <li class="action-item">
                                <div class="action-icon">
                                    <i class="fas fa-calendar-plus"></i>
                                </div>
                                <div class="action-details">
                                    <h4>Schedule Event</h4>
                                    <p>Add new school event</p>
                                </div>
                            </li>
                            
                            <li class="action-item">
                                <div class="action-icon">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                                <div class="action-details">
                                    <h4>Generate Report</h4>
                                    <p>Create attendance report</p>
                                </div>
                            </li>
                            
                            <li class="action-item">
                                <div class="action-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="action-details">
                                    <h4>Send Notification</h4>
                                    <p>Notify parents/students</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Recent Students Table -->
                <div class="recent-table-card">
                    <div class="card-header">
                        <h3>Recently Added Students</h3>
                        <a href="#" class="view-all">View All Students</a>
                    </div>
                    
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Grade</th>
                                    <th>Parent Contact</th>
                                    <th>Enrollment Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="student-info">
                                            <div class="student-avatar">
                                                <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Student">
                                            </div>
                                            <div>
                                                <div class="student-name">Michael Johnson</div>
                                                <div class="student-id">ID: STU-2023-045</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Grade 10</td>
                                    <td>+1 (555) 123-4567</td>
                                    <td>2023-09-15</td>
                                    <td><span class="status-badge active">Active</span></td>
                                    <td>
                                        <button class="action-btn view">View</button>
                                        <button class="action-btn edit">Edit</button>
                                    </td>
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
                                    <td>Grade 9</td>
                                    <td>+1 (555) 234-5678</td>
                                    <td>2023-09-10</td>
                                    <td><span class="status-badge active">Active</span></td>
                                    <td>
                                        <button class="action-btn view">View</button>
                                        <button class="action-btn edit">Edit</button>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>
                                        <div class="student-info">
                                            <div class="student-avatar">
                                                <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Student">
                                            </div>
                                            <div>
                                                <div class="student-name">Emily Davis</div>
                                                <div class="student-id">ID: STU-2023-047</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Grade 11</td>
                                    <td>+1 (555) 345-6789</td>
                                    <td>2023-09-05</td>
                                    <td><span class="status-badge active">Active</span></td>
                                    <td>
                                        <button class="action-btn view">View</button>
                                        <button class="action-btn edit">Edit</button>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>
                                        <div class="student-info">
                                            <div class="student-avatar">
                                                <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Student">
                                            </div>
                                            <div>
                                                <div class="student-name">James Wilson</div>
                                                <div class="student-id">ID: STU-2023-048</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Grade 8</td>
                                    <td>+1 (555) 456-7890</td>
                                    <td>2023-08-28</td>
                                    <td><span class="status-badge active">Active</span></td>
                                    <td>
                                        <button class="action-btn view">View</button>
                                        <button class="action-btn edit">Edit</button>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>
                                        <div class="student-info">
                                            <div class="student-avatar">
                                                <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Student">
                                            </div>
                                            <div>
                                                <div class="student-name">Olivia Martinez</div>
                                                <div class="student-id">ID: STU-2023-049</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Grade 7</td>
                                    <td>+1 (555) 567-8901</td>
                                    <td>2023-08-20</td>
                                    <td><span class="status-badge inactive">Inactive</span></td>
                                    <td>
                                        <button class="action-btn view">View</button>
                                        <button class="action-btn edit">Edit</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="dashboard-footer">
                <p>&copy; 2023 T&T School Management System. All rights reserved. | Version 2.1.5</p>
            </div>
        </div>
    </div>

    <script>
        // Mobile sidebar toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const mainContent = document.getElementById('mainContent');
        
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
        
        // Simulate chart data (in a real app, you would use Chart.js or similar)
        function updateStats() {
            // Simulate real-time updates to stats
            const statCards = document.querySelectorAll('.stat-info h3');
            
            // Update student count with a slight random variation
            let studentCount = parseInt(statCards[0].textContent.replace(/,/g, ''));
            studentCount += Math.floor(Math.random() * 3);
            statCards[0].textContent = studentCount.toLocaleString();
            
            // Update teacher count
            let teacherCount = parseInt(statCards[1].textContent.replace(/,/g, ''));
            if (Math.random() > 0.95) teacherCount += 1; // Rare teacher addition
            statCards[1].textContent = teacherCount;
            
            // Update revenue (adding small random amount)
            let revenue = parseFloat(statCards[3].textContent.replace(/[$,]/g, ''));
            revenue += Math.random() * 50;
            statCards[3].textContent = '$' + revenue.toLocaleString(undefined, {maximumFractionDigits: 0});
        }
        
        // Update stats every 30 seconds
        setInterval(updateStats, 30000);
        
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
        
        // Simulate notification click
        document.querySelectorAll('.header-action').forEach(action => {
            action.addEventListener('click', function() {
                if(this.querySelector('.notification-badge')) {
                    // In a real app, this would mark notifications as read
                    const badge = this.querySelector('.notification-badge');
                    const currentCount = parseInt(badge.textContent);
                    
                    if(currentCount > 0) {
                        badge.textContent = currentCount - 1;
                        
                        // Hide badge if count reaches 0
                        if(currentCount - 1 === 0) {
                            badge.style.display = 'none';
                        }
                    }
                }
            });
        });
        
        // Quick action buttons functionality
        document.querySelectorAll('.action-item').forEach(item => {
            item.addEventListener('click', function() {
                const actionTitle = this.querySelector('h4').textContent;
                alert(`"${actionTitle}" action would be performed here.`);
            });
        });
        
        // Table action buttons
        document.querySelectorAll('.action-btn.view').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const studentName = this.closest('tr').querySelector('.student-name').textContent;
                alert(`Viewing details for ${studentName}`);
            });
        });
        
        document.querySelectorAll('.action-btn.edit').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const studentName = this.closest('tr').querySelector('.student-name').textContent;
                alert(`Editing ${studentName}'s information`);
            });
        });
        
        // Table row click (view details)
        document.querySelectorAll('tbody tr').forEach(row => {
            row.addEventListener('click', function() {
                const studentName = this.querySelector('.student-name').textContent;
                alert(`Viewing full profile for ${studentName}`);
            });
        });
        
        // Period select change
        document.querySelectorAll('.period-select').forEach(select => {
            select.addEventListener('change', function() {
                const period = this.value;
                const chartTitle = this.closest('.chart-header').querySelector('h3').textContent;
                alert(`Updating ${chartTitle} for ${period}`);
            });
        });
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if(window.innerWidth >= 992) {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            }
        });
    </script>
</body>
</html>