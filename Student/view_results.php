<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Results - T&T School Student Portal</title>
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
        
        .student-info {
            display: flex;
            align-items: center;
        }
        
        .student-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 15px;
            border: 2px solid var(--primary-light);
        }
        
        .student-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .student-details h4 {
            color: var(--white);
            font-size: 0.95rem;
            margin-bottom: 3px;
        }
        
        .student-details p {
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
        
        /* Results Header */
        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .results-header h2 {
            font-size: 1.8rem;
        }
        
        .results-actions {
            display: flex;
            gap: 15px;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            border: none;
            box-shadow: 0 4px 10px rgba(0, 51, 102, 0.1);
        }
        
        .btn i {
            margin-right: 8px;
        }
        
        .btn-primary {
            background: linear-gradient(to right, var(--primary-dark), var(--primary-medium));
            color: var(--white);
        }
        
        .btn-primary:hover {
            background: linear-gradient(to right, var(--primary-medium), var(--accent-blue));
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 51, 102, 0.2);
        }
        
        .btn-secondary {
            background-color: var(--light-bg);
            color: var(--primary-medium);
            border: 1px solid var(--primary-light);
        }
        
        .btn-secondary:hover {
            background-color: #e3f2fd;
            transform: translateY(-2px);
        }
        
        .btn-success {
            background-color: var(--success);
            color: var(--white);
        }
        
        .btn-danger {
            background-color: var(--danger);
            color: var(--white);
        }
        
        /* Academic Summary */
        .academic-summary {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .summary-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 15px var(--shadow);
            text-align: center;
            transition: all 0.3s ease;
            border-top: 5px solid var(--primary-medium);
        }
        
        .summary-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 51, 102, 0.15);
        }
        
        .summary-card.gpa {
            border-top-color: var(--accent-blue);
        }
        
        .summary-card.cgpa {
            border-top-color: var(--success);
        }
        
        .summary-card.rank {
            border-top-color: var(--warning);
        }
        
        .summary-card.attendance {
            border-top-color: var(--info);
        }
        
        .summary-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 1.8rem;
        }
        
        .summary-card.gpa .summary-icon {
            background-color: rgba(30, 136, 229, 0.1);
            color: var(--accent-blue);
        }
        
        .summary-card.cgpa .summary-icon {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }
        
        .summary-card.rank .summary-icon {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning);
        }
        
        .summary-card.attendance .summary-icon {
            background-color: rgba(23, 162, 184, 0.1);
            color: var(--info);
        }
        
        .summary-value {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .summary-card.gpa .summary-value {
            color: var(--accent-blue);
        }
        
        .summary-card.cgpa .summary-value {
            color: var(--success);
        }
        
        .summary-card.rank .summary-value {
            color: var(--warning);
        }
        
        .summary-card.attendance .summary-value {
            color: var(--info);
        }
        
        .summary-label {
            font-size: 1.1rem;
            color: var(--text-light);
            margin-bottom: 10px;
        }
        
        .summary-subtext {
            font-size: 0.9rem;
            color: var(--text-light);
        }
        
        /* Results Filter Bar */
        .filter-bar {
            background-color: var(--white);
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px var(--shadow);
            display: flex;
            flex-wrap: wrap;
            gap: 25px;
            align-items: center;
        }
        
        .filter-group {
            flex: 1;
            min-width: 200px;
        }
        
        .filter-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--primary-dark);
            font-size: 0.95rem;
        }
        
        .filter-group select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: 'Open Sans', sans-serif;
            font-size: 0.95rem;
            background-color: #f9f9f9;
            cursor: pointer;
        }
        
        .filter-group select:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(77, 143, 204, 0.1);
        }
        
        /* Results Card */
        .results-card {
            background-color: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px var(--shadow);
            margin-bottom: 40px;
        }
        
        .results-card-header {
            padding: 25px 30px;
            background-color: var(--light-bg);
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .results-card-header h3 {
            font-size: 1.4rem;
            color: var(--primary-dark);
        }
        
        .term-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .term-badge {
            padding: 8px 20px;
            background-color: var(--primary-medium);
            color: var(--white);
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .results-card-body {
            padding: 30px;
        }
        
        /* Results Table */
        .results-table-container {
            overflow-x: auto;
        }
        
        .results-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .results-table thead {
            background-color: var(--light-bg);
        }
        
        .results-table th {
            padding: 18px 20px;
            text-align: left;
            font-weight: 600;
            color: var(--primary-dark);
            border-bottom: 2px solid #eee;
            white-space: nowrap;
        }
        
        .results-table td {
            padding: 20px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }
        
        .results-table tbody tr {
            transition: all 0.3s;
        }
        
        .results-table tbody tr:hover {
            background-color: #f9f9f9;
        }
        
        .subject-info {
            display: flex;
            align-items: center;
        }
        
        .subject-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.3rem;
        }
        
        .subject-icon.math {
            background-color: rgba(30, 136, 229, 0.1);
            color: var(--accent-blue);
        }
        
        .subject-icon.science {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }
        
        .subject-icon.english {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning);
        }
        
        .subject-icon.history {
            background-color: rgba(103, 58, 183, 0.1);
            color: #673ab7;
        }
        
        .subject-icon.computer {
            background-color: rgba(23, 162, 184, 0.1);
            color: var(--info);
        }
        
        .subject-icon.arts {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger);
        }
        
        .subject-details h4 {
            font-size: 1.1rem;
            margin-bottom: 5px;
        }
        
        .subject-details p {
            font-size: 0.85rem;
            color: var(--text-light);
        }
        
        .grade-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 1rem;
            min-width: 60px;
            text-align: center;
        }
        
        .grade-a {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
            border: 2px solid rgba(40, 167, 69, 0.3);
        }
        
        .grade-b {
            background-color: rgba(23, 162, 184, 0.1);
            color: var(--info);
            border: 2px solid rgba(23, 162, 184, 0.3);
        }
        
        .grade-c {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning);
            border: 2px solid rgba(255, 193, 7, 0.3);
        }
        
        .grade-d {
            background-color: rgba(253, 126, 20, 0.1);
            color: #fd7e14;
            border: 2px solid rgba(253, 126, 20, 0.3);
        }
        
        .grade-f {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger);
            border: 2px solid rgba(220, 53, 69, 0.3);
        }
        
        .grade-comment {
            color: var(--text-light);
            font-size: 0.9rem;
            font-style: italic;
        }
        
        /* Performance Chart */
        .performance-chart {
            background-color: var(--white);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px var(--shadow);
            margin-bottom: 40px;
        }
        
        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .chart-header h3 {
            font-size: 1.4rem;
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
            border-radius: 10px;
            color: #888;
            flex-direction: column;
        }
        
        .chart-placeholder i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: var(--primary-light);
        }
        
        /* Result History */
        .result-history {
            background-color: var(--white);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px var(--shadow);
        }
        
        .history-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .history-table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: var(--primary-dark);
            border-bottom: 2px solid #eee;
        }
        
        .history-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .history-table tbody tr:hover {
            background-color: #f9f9f9;
        }
        
        .trend-indicator {
            display: inline-flex;
            align-items: center;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        
        .trend-up {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }
        
        .trend-down {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger);
        }
        
        .trend-stable {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning);
        }
        
        /* Performance Summary */
        .performance-summary {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .performance-item {
            background-color: var(--white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 15px var(--shadow);
        }
        
        .performance-item h4 {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            color: var(--primary-medium);
        }
        
        .performance-item h4 i {
            margin-right: 12px;
            color: var(--primary-medium);
        }
        
        .performance-details {
            list-style: none;
        }
        
        .performance-details li {
            padding: 15px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
        }
        
        .performance-details li:last-child {
            border-bottom: none;
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
            .academic-summary {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .performance-summary {
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
            
            .filter-bar {
                flex-direction: column;
                align-items: stretch;
            }
        }
        
        @media (max-width: 768px) {
            .results-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }
            
            .results-actions {
                width: 100%;
                justify-content: space-between;
            }
            
            .top-header {
                padding: 20px;
            }
            
            .dashboard-content {
                padding: 20px;
            }
            
            .academic-summary {
                grid-template-columns: 1fr;
            }
            
            .results-table th, 
            .results-table td {
                padding: 12px 10px;
                font-size: 0.9rem;
            }
            
            .subject-info {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .subject-icon {
                margin-right: 0;
                margin-bottom: 10px;
            }
            
            .chart-container {
                height: 250px;
            }
        }
        
        @media (max-width: 576px) {
            .results-actions {
                flex-direction: column;
                gap: 10px;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
            
            .results-card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .term-info {
                width: 100%;
                justify-content: space-between;
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
                <a href="student-dashboard.html" class="menu-item">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
                
                <a href="student-results.html" class="menu-item active">
                    <i class="fas fa-chart-line"></i>
                    <span class="menu-text">My Results</span>
                </a>
                
                <a href="student-courses.html" class="menu-item">
                    <i class="fas fa-book"></i>
                    <span class="menu-text">My Courses</span>
                </a>
                
                <a href="student-attendance.html" class="menu-item">
                    <i class="fas fa-calendar-check"></i>
                    <span class="menu-text">Attendance</span>
                </a>
                
                <a href="student-schedule.html" class="menu-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span class="menu-text">Class Schedule</span>
                </a>
                
                <a href="student-assignments.html" class="menu-item">
                    <i class="fas fa-tasks"></i>
                    <span class="menu-text">Assignments</span>
                </a>
                
                <a href="student-messages.html" class="menu-item">
                    <i class="fas fa-envelope"></i>
                    <span class="menu-text">Messages</span>
                </a>
            </div>
            
            <div class="sidebar-footer">
                <div class="student-info">
                    <div class="student-avatar">
                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Student">
                    </div>
                    <div class="student-details">
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
                        <h1>My Academic Results</h1>
                    </div>
                </div>
                
                <div class="header-right">
                    <div class="header-action">
                        <i class="fas fa-search"></i>
                    </div>
                    
                    <div class="header-action">
                        <i class="fas fa-bell"></i>
                    </div>
                    
                    <div class="header-action">
                        <i class="fas fa-user-circle"></i>
                    </div>
                </div>
            </div>
            
            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <!-- Academic Summary -->
                <div class="academic-summary">
                    <div class="summary-card gpa">
                        <div class="summary-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="summary-value">3.75</div>
                        <div class="summary-label">Current GPA</div>
                        <div class="summary-subtext">Out of 4.0 Scale</div>
                    </div>
                    
                    <div class="summary-card cgpa">
                        <div class="summary-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div class="summary-value">3.68</div>
                        <div class="summary-label">Cumulative GPA</div>
                        <div class="summary-subtext">Since Grade 9</div>
                    </div>
                    
                    <div class="summary-card rank">
                        <div class="summary-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="summary-value">#8</div>
                        <div class="summary-label">Class Rank</div>
                        <div class="summary-subtext">Top 19% of Grade 10</div>
                    </div>
                    
                    <div class="summary-card attendance">
                        <div class="summary-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="summary-value">96.5%</div>
                        <div class="summary-label">Attendance</div>
                        <div class="summary-subtext">Current Academic Year</div>
                    </div>
                </div>
                
                <!-- Results Filter Bar -->
                <div class="filter-bar">
                    <div class="filter-group">
                        <label for="academicYear">Academic Year</label>
                        <select id="academicYear">
                            <option value="2023-2024" selected>2023-2024</option>
                            <option value="2022-2023">2022-2023</option>
                            <option value="2021-2022">2021-2022</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="term">Term/Semester</label>
                        <select id="term">
                            <option value="term2" selected>Term 2 (Current)</option>
                            <option value="term1">Term 1</option>
                            <option value="semester1">Semester 1</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="subjectFilter">Subject Filter</label>
                        <select id="subjectFilter">
                            <option value="all">All Subjects</option>
                            <option value="math">Mathematics</option>
                            <option value="science">Science</option>
                            <option value="english">English</option>
                            <option value="history">History</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <button class="btn btn-primary" id="downloadResultsBtn">
                            <i class="fas fa-download"></i> Download Report
                        </button>
                    </div>
                </div>
                
                <!-- Performance Chart -->
                <div class="performance-chart">
                    <div class="chart-header">
                        <h3>Performance Trend</h3>
                        <div>
                            <select id="chartType" style="padding: 8px 15px; border-radius: 6px; border: 1px solid #ddd;">
                                <option value="gpa">GPA Over Time</option>
                                <option value="subject">Subject Performance</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="chart-container">
                        <div class="chart-placeholder">
                            <i class="fas fa-chart-line"></i>
                            <p>Performance Chart</p>
                            <p style="font-size: 0.9rem;">(Chart.js would be implemented here)</p>
                        </div>
                    </div>
                </div>
                
                <!-- Current Term Results -->
                <div class="results-card">
                    <div class="results-card-header">
                        <h3>Term 2 Results - 2023-2024 Academic Year</h3>
                        <div class="term-info">
                            <div class="term-badge">Current Term</div>
                            <div>Published: October 25, 2023</div>
                        </div>
                    </div>
                    
                    <div class="results-card-body">
                        <div class="results-table-container">
                            <table class="results-table">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Teacher</th>
                                        <th>Score</th>
                                        <th>Grade</th>
                                        <th>Grade Points</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="subject-info">
                                                <div class="subject-icon math">
                                                    <i class="fas fa-calculator"></i>
                                                </div>
                                                <div class="subject-details">
                                                    <h4>Advanced Mathematics</h4>
                                                    <p>MATH-101 | 4 Credits</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Dr. Robert Smith</td>
                                        <td>92/100</td>
                                        <td><span class="grade-badge grade-a">A</span></td>
                                        <td>4.0</td>
                                        <td class="grade-comment">Excellent performance</td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <div class="subject-info">
                                                <div class="subject-icon science">
                                                    <i class="fas fa-atom"></i>
                                                </div>
                                                <div class="subject-details">
                                                    <h4>Physics Fundamentals</h4>
                                                    <p>SCI-201 | 3 Credits</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Ms. Emily Johnson</td>
                                        <td>88/100</td>
                                        <td><span class="grade-badge grade-a">A-</span></td>
                                        <td>3.7</td>
                                        <td class="grade-comment">Strong improvement shown</td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <div class="subject-info">
                                                <div class="subject-icon english">
                                                    <i class="fas fa-book-open"></i>
                                                </div>
                                                <div class="subject-details">
                                                    <h4>Literature & Composition</h4>
                                                    <p>ENG-102 | 3 Credits</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Mr. David Chen</td>
                                        <td>95/100</td>
                                        <td><span class="grade-badge grade-a">A</span></td>
                                        <td>4.0</td>
                                        <td class="grade-comment">Outstanding writing skills</td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <div class="subject-info">
                                                <div class="subject-icon computer">
                                                    <i class="fas fa-laptop-code"></i>
                                                </div>
                                                <div class="subject-details">
                                                    <h4>Computer Science Principles</h4>
                                                    <p>CS-301 | 3 Credits</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Ms. Patricia Miller</td>
                                        <td>85/100</td>
                                        <td><span class="grade-badge grade-b">B+</span></td>
                                        <td>3.3</td>
                                        <td class="grade-comment">Good understanding of concepts</td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <div class="subject-info">
                                                <div class="subject-icon history">
                                                    <i class="fas fa-landmark"></i>
                                                </div>
                                                <div class="subject-details">
                                                    <h4>World History</h4>
                                                    <p>HIS-103 | 3 Credits</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Dr. Sarah Williams</td>
                                        <td>82/100</td>
                                        <td><span class="grade-badge grade-b">B-</span></td>
                                        <td>2.7</td>
                                        <td class="grade-comment">Improved from previous term</td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <div class="subject-info">
                                                <div class="subject-icon arts">
                                                    <i class="fas fa-palette"></i>
                                                </div>
                                                <div class="subject-details">
                                                    <h4>Visual Arts Studio</h4>
                                                    <p>ART-105 | 2 Credits</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Ms. Jennifer Davis</td>
                                        <td>91/100</td>
                                        <td><span class="grade-badge grade-a">A</span></td>
                                        <td>4.0</td>
                                        <td class="grade-comment">Exceptional creative work</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div style="margin-top: 30px; padding: 25px; background-color: var(--light-bg); border-radius: 10px;">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <h4 style="margin-bottom: 10px;">Term Summary</h4>
                                    <p>Total Credits: <strong>18</strong> | Term GPA: <strong>3.75</strong></p>
                                </div>
                                <div style="text-align: right;">
                                    <p style="font-size: 0.9rem; color: var(--text-light);">Class Average GPA: 3.42</p>
                                    <p style="font-size: 0.9rem; color: var(--text-light);">Rank in Class: #8 of 42 students</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Performance Summary -->
                <div class="performance-summary">
                    <div class="performance-item">
                        <h4><i class="fas fa-medal"></i> Academic Achievements</h4>
                        <ul class="performance-details">
                            <li>
                                <span>Highest Scoring Subject</span>
                                <span>Literature & Composition (95%)</span>
                            </li>
                            <li>
                                <span>Most Improved Subject</span>
                                <span>World History (+12%)</span>
                            </li>
                            <li>
                                <span>Academic Honors</span>
                                <span>Honor Roll - Term 2</span>
                            </li>
                            <li>
                                <span>Extracurricular Points</span>
                                <span>45 points (Top 10%)</span>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="performance-item">
                        <h4><i class="fas fa-bullseye"></i> Learning Goals</h4>
                        <ul class="performance-details">
                            <li>
                                <span>Target GPA for Next Term</span>
                                <span>3.85 / 4.0</span>
                            </li>
                            <li>
                                <span>Physics Score Target</span>
                                <span>90+ (Currently 88)</span>
                            </li>
                            <li>
                                <span>Computer Science Goal</span>
                                <span>Achieve A- Grade</span>
                            </li>
                            <li>
                                <span>Attendance Goal</span>
                                <span>Maintain 95%+</span>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="performance-item">
                        <h4><i class="fasfa-comment-alt"></i> Teacher Comments</h4>
                        <div style="margin-top: 15px; padding: 15px; background-color: #f9f9f9; border-radius: 8px; border-left: 4px solid var(--primary-light);">
                            <p style="font-style: italic; color: var(--text-dark);">
                                "Michael has shown remarkable improvement this term. His analytical skills in mathematics are exceptional, and his writing in English class has developed significantly. With continued effort, he has the potential to be a top-ranking student in his grade."
                            </p>
                            <p style="margin-top: 10px; font-size: 0.9rem; color: var(--primary-medium);">
                                — Dr. Sarah Williams, Academic Advisor
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Result History -->
                <div class="result-history">
                    <h3>Academic History</h3>
                    <p>Track your performance over time</p>
                    
                    <div class="results-table-container" style="margin-top: 25px;">
                        <table class="history-table">
                            <thead>
                                <tr>
                                    <th>Academic Period</th>
                                    <th>GPA</th>
                                    <th>Class Rank</th>
                                    <th>Top Subject</th>
                                    <th>Performance Trend</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2023-2024 | Term 2 (Current)</td>
                                    <td><strong>3.75</strong></td>
                                    <td>#8 / 42</td>
                                    <td>Literature (95%)</td>
                                    <td><span class="trend-indicator trend-up"><i class="fas fa-arrow-up"></i> Improving</span></td>
                                </tr>
                                
                                <tr>
                                    <td>2023-2024 | Term 1</td>
                                    <td>3.62</td>
                                    <td>#11 / 42</td>
                                    <td>Mathematics (91%)</td>
                                    <td><span class="trend-indicator trend-up"><i class="fas fa-arrow-up"></i> Improving</span></td>
                                </tr>
                                
                                <tr>
                                    <td>2022-2023 | Semester 2</td>
                                    <td>3.58</td>
                                    <td>#13 / 40</td>
                                    <td>Physics (89%)</td>
                                    <td><span class="trend-indicator trend-stable"><i class="fas fa-minus"></i> Stable</span></td>
                                </tr>
                                
                                <tr>
                                    <td>2022-2023 | Semester 1</td>
                                    <td>3.45</td>
                                    <td>#16 / 40</td>
                                    <td>Computer Science (87%)</td>
                                    <td><span class="trend-indicator trend-up"><i class="fas fa-arrow-up"></i> Improving</span></td>
                                </tr>
                                
                                <tr>
                                    <td>2021-2022 | Grade 9 Final</td>
                                    <td>3.40</td>
                                    <td>#18 / 38</td>
                                    <td>Mathematics (85%)</td>
                                    <td><span class="trend-indicator trend-up"><i class="fas fa-arrow-up"></i> Improving</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="dashboard-footer">
                    <p>&copy; 2023 T&T School Management System. All rights reserved. | Student Portal v2.3</p>
                    <p style="margin-top: 10px; font-size: 0.8rem;">
                        <i class="fas fa-info-circle" style="margin-right: 5px;"></i>
                        Results are published by the Academic Department. Contact your advisor with any questions.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // DOM Elements
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const menuToggle = document.getElementById('menuToggle');
        const academicYearSelect = document.getElementById('academicYear');
        const termSelect = document.getElementById('term');
        const subjectFilterSelect = document.getElementById('subjectFilter');
        const downloadResultsBtn = document.getElementById('downloadResultsBtn');
        const chartTypeSelect = document.getElementById('chartType');
        
        // Sample student data
        const studentData = {
            name: "Michael Johnson",
            grade: "10",
            section: "A",
            currentGPA: 3.75,
            cumulativeGPA: 3.68,
            classRank: 8,
            totalStudents: 42,
            attendanceRate: 96.5,
            termResults: [
                {
                    subject: "Advanced Mathematics",
                    code: "MATH-101",
                    credits: 4,
                    teacher: "Dr. Robert Smith",
                    score: 92,
                    maxScore: 100,
                    grade: "A",
                    gradePoints: 4.0,
                    comment: "Excellent performance"
                },
                {
                    subject: "Physics Fundamentals",
                    code: "SCI-201",
                    credits: 3,
                    teacher: "Ms. Emily Johnson",
                    score: 88,
                    maxScore: 100,
                    grade: "A-",
                    gradePoints: 3.7,
                    comment: "Strong improvement shown"
                },
                {
                    subject: "Literature & Composition",
                    code: "ENG-102",
                    credits: 3,
                    teacher: "Mr. David Chen",
                    score: 95,
                    maxScore: 100,
                    grade: "A",
                    gradePoints: 4.0,
                    comment: "Outstanding writing skills"
                },
                {
                    subject: "Computer Science Principles",
                    code: "CS-301",
                    credits: 3,
                    teacher: "Ms. Patricia Miller",
                    score: 85,
                    maxScore: 100,
                    grade: "B+",
                    gradePoints: 3.3,
                    comment: "Good understanding of concepts"
                },
                {
                    subject: "World History",
                    code: "HIS-103",
                    credits: 3,
                    teacher: "Dr. Sarah Williams",
                    score: 82,
                    maxScore: 100,
                    grade: "B-",
                    gradePoints: 2.7,
                    comment: "Improved from previous term"
                },
                {
                    subject: "Visual Arts Studio",
                    code: "ART-105",
                    credits: 2,
                    teacher: "Ms. Jennifer Davis",
                    score: 91,
                    maxScore: 100,
                    grade: "A",
                    gradePoints: 4.0,
                    comment: "Exceptional creative work"
                }
            ]
        };
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            setupEventListeners();
            updateStudentData();
            updateResultsTable();
            calculateTermSummary();
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
            
            // Filter changes
            academicYearSelect.addEventListener('change', filterResults);
            termSelect.addEventListener('change', filterResults);
            subjectFilterSelect.addEventListener('change', filterResults);
            chartTypeSelect.addEventListener('change', updateChart);
            
            // Download results
            downloadResultsBtn.addEventListener('click', downloadResults);
            
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
        
        // Update student data in UI
        function updateStudentData() {
            // Update sidebar student info
            document.querySelector('.student-details h4').textContent = studentData.name;
            document.querySelector('.student-details p').textContent = `Grade ${studentData.grade} | Section ${studentData.section}`;
            
            // Update summary cards
            document.querySelector('.summary-card.gpa .summary-value').textContent = studentData.currentGPA;
            document.querySelector('.summary-card.cgpa .summary-value').textContent = studentData.cumulativeGPA;
            document.querySelector('.summary-card.rank .summary-value').textContent = `#${studentData.classRank}`;
            document.querySelector('.summary-card.rank .summary-subtext').textContent = `Top ${Math.round((studentData.classRank / studentData.totalStudents) * 100)}% of Grade ${studentData.grade}`;
            document.querySelector('.summary-card.attendance .summary-value').textContent = `${studentData.attendanceRate}%`;
        }
        
        // Update results table with data
        function updateResultsTable() {
            const tableBody = document.querySelector('.results-table tbody');
            
            // Clear existing rows
            tableBody.innerHTML = '';
            
            // Add rows for each subject
            studentData.termResults.forEach(subject => {
                const row = document.createElement('tr');
                
                // Determine subject icon class
                let iconClass = '';
                let icon = '';
                
                if (subject.subject.includes('Math')) {
                    iconClass = 'math';
                    icon = 'fa-calculator';
                } else if (subject.subject.includes('Physics') || subject.subject.includes('Science')) {
                    iconClass = 'science';
                    icon = 'fa-atom';
                } else if (subject.subject.includes('Literature') || subject.subject.includes('English')) {
                    iconClass = 'english';
                    icon = 'fa-book-open';
                } else if (subject.subject.includes('History')) {
                    iconClass = 'history';
                    icon = 'fa-landmark';
                } else if (subject.subject.includes('Computer')) {
                    iconClass = 'computer';
                    icon = 'fa-laptop-code';
                } else if (subject.subject.includes('Arts')) {
                    iconClass = 'arts';
                    icon = 'fa-palette';
                }
                
                // Determine grade badge class
                let gradeClass = '';
                if (subject.grade === 'A') gradeClass = 'grade-a';
                else if (subject.grade === 'A-') gradeClass = 'grade-a';
                else if (subject.grade === 'B+') gradeClass = 'grade-b';
                else if (subject.grade === 'B') gradeClass = 'grade-b';
                else if (subject.grade === 'B-') gradeClass = 'grade-b';
                else if (subject.grade === 'C+') gradeClass = 'grade-c';
                else if (subject.grade === 'C') gradeClass = 'grade-c';
                else if (subject.grade === 'C-') gradeClass = 'grade-c';
                else if (subject.grade === 'D+') gradeClass = 'grade-d';
                else if (subject.grade === 'D') gradeClass = 'grade-d';
                else if (subject.grade === 'F') gradeClass = 'grade-f';
                
                row.innerHTML = `
                    <td>
                        <div class="subject-info">
                            <div class="subject-icon ${iconClass}">
                                <i class="fas ${icon}"></i>
                            </div>
                            <div class="subject-details">
                                <h4>${subject.subject}</h4>
                                <p>${subject.code} | ${subject.credits} Credits</p>
                            </div>
                        </div>
                    </td>
                    <td>${subject.teacher}</td>
                    <td>${subject.score}/${subject.maxScore}</td>
                    <td><span class="grade-badge ${gradeClass}">${subject.grade}</span></td>
                    <td>${subject.gradePoints}</td>
                    <td class="grade-comment">${subject.comment}</td>
                `;
                
                tableBody.appendChild(row);
            });
        }
        
        // Calculate term summary
        function calculateTermSummary() {
            let totalCredits = 0;
            let totalGradePoints = 0;
            let highestScore = 0;
            let highestSubject = '';
            
            studentData.termResults.forEach(subject => {
                totalCredits += subject.credits;
                totalGradePoints += subject.credits * subject.gradePoints;
                
                if (subject.score > highestScore) {
                    highestScore = subject.score;
                    highestSubject = subject.subject;
                }
            });
            
            const termGPA = totalGradePoints / totalCredits;
            
            // Update term summary
            const summaryElement = document.querySelector('.results-card-body > div:last-child');
            summaryElement.querySelector('strong:nth-child(1)').textContent = totalCredits;
            summaryElement.querySelector('strong:nth-child(2)').textContent = termGPA.toFixed(2);
            
            // Update achievements
            document.querySelector('.performance-details li:nth-child(1) span:last-child').textContent = 
                `${highestSubject} (${highestScore}%)`;
        }
        
        // Filter results based on selections
        function filterResults() {
            const academicYear = academicYearSelect.value;
            const term = termSelect.value;
            const subjectFilter = subjectFilterSelect.value;
            
            // Show loading state
            const originalText = downloadResultsBtn.innerHTML;
            downloadResultsBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Filtering...';
            downloadResultsBtn.disabled = true;
            
            // Simulate API call delay
            setTimeout(() => {
                // Update results card header based on selections
                const resultsCardHeader = document.querySelector('.results-card-header h3');
                let termText = '';
                
                if (term === 'term2') termText = 'Term 2';
                else if (term === 'term1') termText = 'Term 1';
                else if (term === 'semester1') termText = 'Semester 1';
                
                resultsCardHeader.textContent = `${termText} Results - ${academicYear} Academic Year`;
                
                // Filter table rows if subject filter is not "all"
                if (subjectFilter !== 'all') {
                    const rows = document.querySelectorAll('.results-table tbody tr');
                    rows.forEach(row => {
                        const subjectName = row.querySelector('.subject-details h4').textContent.toLowerCase();
                        let showRow = false;
                        
                        if (subjectFilter === 'math' && (subjectName.includes('math') || subjectName.includes('calculus'))) {
                            showRow = true;
                        } else if (subjectFilter === 'science' && (subjectName.includes('physics') || subjectName.includes('science') || subjectName.includes('chemistry') || subjectName.includes('biology'))) {
                            showRow = true;
                        } else if (subjectFilter === 'english' && (subjectName.includes('english') || subjectName.includes('literature') || subjectName.includes('writing'))) {
                            showRow = true;
                        } else if (subjectFilter === 'history' && (subjectName.includes('history') || subjectName.includes('social'))) {
                            showRow = true;
                        }
                        
                        row.style.display = showRow ? '' : 'none';
                    });
                } else {
                    // Show all rows
                    const rows = document.querySelectorAll('.results-table tbody tr');
                    rows.forEach(row => {
                        row.style.display = '';
                    });
                }
                
                // Reset button
                downloadResultsBtn.innerHTML = originalText;
                downloadResultsBtn.disabled = false;
                
                // Show notification
                showNotification(`Results filtered for ${termText} - ${academicYear}`);
            }, 800);
        }
        
        // Update chart based on selection
        function updateChart() {
            const chartType = chartTypeSelect.value;
            const chartPlaceholder = document.querySelector('.chart-placeholder');
            
            if (chartType === 'gpa') {
                chartPlaceholder.innerHTML = `
                    <i class="fas fa-chart-line"></i>
                    <p>GPA Trend Chart</p>
                    <p style="font-size: 0.9rem;">(Chart.js would show GPA over past terms)</p>
                `;
            } else if (chartType === 'subject') {
                chartPlaceholder.innerHTML = `
                    <i class="fas fa-chart-bar"></i>
                    <p>Subject Performance Chart</p>
                    <p style="font-size: 0.9rem;">(Chart.js would show scores by subject)</p>
                `;
            }
        }
        
        // Download results as PDF
        function downloadResults() {
            // Show loading state
            const originalText = downloadResultsBtn.innerHTML;
            downloadResultsBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Generating PDF...';
            downloadResultsBtn.disabled = true;
            
            // Simulate PDF generation
            setTimeout(() => {
                // Reset button
                downloadResultsBtn.innerHTML = originalText;
                downloadResultsBtn.disabled = false;
                
                // Show success message
                showNotification('Results PDF downloaded successfully!', 'success');
                
                // In a real app, this would trigger an actual download
                // For now, we'll simulate it
                const academicYear = academicYearSelect.value;
                const term = termSelect.value;
                let termText = '';
                
                if (term === 'term2') termText = 'Term 2';
                else if (term === 'term1') termText = 'Term 1';
                else if (term === 'semester1') termText = 'Semester 1';
                
                alert(`Downloading: ${studentData.name} - ${termText} Results ${academicYear}.pdf`);
            }, 1500);
        }
        
        // Show notification
        function showNotification(message, type = 'info') {
            // Create notification element
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background-color: ${type === 'success' ? 'var(--success)' : 'var(--primary-medium)'};
                color: white;
                padding: 15px 25px;
                border-radius: 8px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.2);
                z-index: 1000;
                display: flex;
                align-items: center;
                gap: 10px;
                animation: slideIn 0.3s ease;
            `;
            
            notification.innerHTML = `
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-info-circle'}"></i>
                <span>${message}</span>
            `;
            
            document.body.appendChild(notification);
            
            // Remove notification after 3 seconds
            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
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
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if(window.innerWidth >= 992) {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            }
        });
        
        // Simulate live updates (in a real app, this would be from WebSocket)
        function simulateLiveUpdates() {
            // Update attendance percentage randomly
            setInterval(() => {
                const attendanceCard = document.querySelector('.summary-card.attendance .summary-value');
                const currentValue = parseFloat(attendanceCard.textContent);
                const change = (Math.random() - 0.5) * 0.05; // Very small random change
                const newValue = Math.max(90, Math.min(100, currentValue + change));
                attendanceCard.textContent = newValue.toFixed(1) + '%';
            }, 30000); // Every 30 seconds
        }
        
        // Start simulated updates
        simulateLiveUpdates();
    </script>
</body>
</html>