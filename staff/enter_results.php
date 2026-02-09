<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Results - T&T School Management System</title>
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
        
        /* Enter Results Header */
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
        
        .btn-warning {
            background-color: var(--warning);
            color: var(--white);
        }
        
        .btn-danger {
            background-color: var(--danger);
            color: var(--white);
        }
        
        /* Exam Selection Card */
        .exam-selection-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 15px var(--shadow);
            margin-bottom: 30px;
        }
        
        .card-header {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .card-header i {
            font-size: 1.5rem;
            color: var(--primary-medium);
            margin-right: 15px;
        }
        
        .card-header h3 {
            font-size: 1.4rem;
        }
        
        .selection-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--primary-dark);
        }
        
        .form-group select,
        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: 'Open Sans', sans-serif;
            font-size: 0.95rem;
            background-color: #f9f9f9;
        }
        
        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(77, 143, 204, 0.1);
        }
        
        /* Student Results Entry */
        .results-entry-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 15px var(--shadow);
            margin-bottom: 30px;
            display: none;
        }
        
        .results-entry-card.active {
            display: block;
        }
        
        .class-summary {
            display: flex;
            justify-content: space-between;
            background-color: var(--light-bg);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
        }
        
        .summary-item {
            text-align: center;
        }
        
        .summary-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-medium);
            margin-bottom: 5px;
        }
        
        .summary-label {
            font-size: 0.9rem;
            color: var(--text-light);
        }
        
        /* Results Table */
        .results-table-container {
            overflow-x: auto;
            margin-bottom: 30px;
            border-radius: 10px;
            border: 1px solid #eee;
        }
        
        .results-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1000px;
        }
        
        .results-table thead {
            background-color: var(--light-bg);
            position: sticky;
            top: 0;
            z-index: 10;
        }
        
        .results-table th {
            padding: 18px 15px;
            text-align: left;
            font-weight: 600;
            color: var(--primary-dark);
            border-bottom: 2px solid #eee;
            white-space: nowrap;
        }
        
        .results-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }
        
        .results-table tbody tr {
            transition: all 0.3s;
        }
        
        .results-table tbody tr:hover {
            background-color: #f9f9f9;
        }
        
        .student-info-cell {
            display: flex;
            align-items: center;
        }
        
        .student-avatar-small {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 12px;
            flex-shrink: 0;
        }
        
        .student-avatar-small img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .student-details-small h4 {
            font-size: 0.95rem;
            margin-bottom: 3px;
        }
        
        .student-details-small p {
            font-size: 0.8rem;
            color: var(--text-light);
        }
        
        .score-input {
            width: 80px;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            text-align: center;
            font-family: 'Open Sans', sans-serif;
            font-size: 0.95rem;
            transition: all 0.3s;
        }
        
        .score-input:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(77, 143, 204, 0.1);
        }
        
        .score-input.valid {
            border-color: var(--success);
            background-color: rgba(40, 167, 69, 0.05);
        }
        
        .score-input.invalid {
            border-color: var(--danger);
            background-color: rgba(220, 53, 69, 0.05);
        }
        
        .grade-display {
            display: inline-block;
            width: 40px;
            padding: 8px 5px;
            border-radius: 6px;
            font-weight: 600;
            text-align: center;
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
        
        .remarks-input {
            width: 150px;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-family: 'Open Sans', sans-serif;
            font-size: 0.9rem;
        }
        
        .status-indicator {
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        
        .status-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }
        
        .status-dot.pending {
            background-color: var(--warning);
        }
        
        .status-dot.entered {
            background-color: var(--success);
        }
        
        /* Quick Actions Bar */
        .quick-actions-bar {
            background-color: var(--light-bg);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        
        .action-btn {
            padding: 10px 20px;
            border-radius: 6px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .action-btn.calculate {
            background-color: rgba(30, 136, 229, 0.1);
            color: var(--accent-blue);
        }
        
        .action-btn.calculate:hover {
            background-color: rgba(30, 136, 229, 0.2);
        }
        
        .action-btn.clear {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger);
        }
        
        .action-btn.clear:hover {
            background-color: rgba(220, 53, 69, 0.2);
        }
        
        .action-btn.save {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }
        
        .action-btn.save:hover {
            background-color: rgba(40, 167, 69, 0.2);
        }
        
        /* Statistics Panel */
        .statistics-panel {
            background-color: var(--white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 15px var(--shadow);
            margin-bottom: 30px;
        }
        
        .statistics-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .statistics-header i {
            font-size: 1.5rem;
            color: var(--primary-medium);
            margin-right: 15px;
        }
        
        .statistics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }
        
        .statistic-item {
            background-color: var(--light-bg);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
        }
        
        .statistic-value {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 8px;
        }
        
        .statistic-value.high {
            color: var(--success);
        }
        
        .statistic-value.medium {
            color: var(--warning);
        }
        
        .statistic-value.low {
            color: var(--danger);
        }
        
        .statistic-label {
            font-size: 0.9rem;
            color: var(--text-light);
        }
        
        /* Grade Distribution */
        .grade-distribution {
            background-color: var(--white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 15px var(--shadow);
            margin-bottom: 30px;
        }
        
        .distribution-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .distribution-bars {
            display: flex;
            align-items: flex-end;
            height: 150px;
            gap: 10px;
            margin-top: 30px;
        }
        
        .distribution-bar {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .bar {
            width: 80%;
            border-radius: 4px 4px 0 0;
            margin-bottom: 10px;
            transition: height 0.5s ease;
        }
        
        .bar-a {
            background-color: var(--success);
        }
        
        .bar-b {
            background-color: var(--info);
        }
        
        .bar-c {
            background-color: var(--warning);
        }
        
        .bar-d {
            background-color: #fd7e14;
        }
        
        .bar-f {
            background-color: var(--danger);
        }
        
        .bar-label {
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .bar-count {
            font-size: 0.9rem;
            color: var(--text-light);
        }
        
        /* Recent Entries */
        .recent-entries {
            background-color: var(--white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 15px var(--shadow);
            margin-bottom: 40px;
        }
        
        .entries-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .entries-table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: var(--primary-dark);
            border-bottom: 2px solid #eee;
        }
        
        .entries-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .entries-table tbody tr:hover {
            background-color: #f9f9f9;
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
            .selection-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .statistics-grid {
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
            
            .selection-grid {
                grid-template-columns: 1fr;
            }
            
            .quick-actions-bar {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .action-buttons {
                width: 100%;
                justify-content: space-between;
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
            
            .class-summary {
                flex-wrap: wrap;
                gap: 20px;
            }
            
            .summary-item {
                flex: 1;
                min-width: 120px;
            }
            
            .statistics-grid {
                grid-template-columns: 1fr;
            }
            
            .distribution-bars {
                height: 120px;
            }
            
            .bar-label {
                font-size: 0.8rem;
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
            
            .action-buttons {
                flex-direction: column;
            }
            
            .action-btn {
                width: 100%;
                justify-content: center;
            }
            
            .score-input {
                width: 70px;
            }
            
            .remarks-input {
                width: 120px;
            }
            
            .exam-selection-card,
            .results-entry-card,
            .statistics-panel,
            .grade-distribution,
            .recent-entries {
                padding: 20px;
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
                <a href="staff-dashboard.html" class="menu-item">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
                
                <a href="staff-students.html" class="menu-item">
                    <i class="fas fa-users"></i>
                    <span class="menu-text">Students</span>
                </a>
                
                <a href="staff-courses.html" class="menu-item">
                    <i class="fas fa-book"></i>
                    <span class="menu-text">My Courses</span>
                </a>
                
                <a href="staff-attendance.html" class="menu-item">
                    <i class="fas fa-calendar-check"></i>
                    <span class="menu-text">Attendance</span>
                </a>
                
                <a href="staff-enter-results.html" class="menu-item active">
                    <i class="fas fa-edit"></i>
                    <span class="menu-text">Enter Results</span>
                </a>
                
                <a href="staff-view-results.html" class="menu-item">
                    <i class="fas fa-chart-line"></i>
                    <span class="menu-text">View Results</span>
                </a>
                
                <a href="staff-messages.html" class="menu-item">
                    <i class="fas fa-envelope"></i>
                    <span class="menu-text">Messages</span>
                </a>
            </div>
            
            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">
                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Staff">
                    </div>
                    <div class="user-details">
                        <h4>Dr. Robert Smith</h4>
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
                        <h1>Enter Student Results</h1>
                    </div>
                </div>
                
                <div class="header-right">
                    <div class="header-action">
                        <i class="fas fa-question-circle"></i>
                    </div>
                    
                    <div class="header-action">
                        <i class="fas fa-history"></i>
                    </div>
                    
                    <div class="header-action">
                        <i class="fas fa-user-circle"></i>
                    </div>
                </div>
            </div>
            
            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <!-- Enter Results Header -->
                <div class="results-header">
                    <h2>Enter Examination Results</h2>
                    <div class="results-actions">
                        <button class="btn btn-secondary" id="loadTemplateBtn">
                            <i class="fas fa-download"></i> Load Template
                        </button>
                        <button class="btn btn-primary" id="loadClassBtn">
                            <i class="fas fa-users"></i> Load Class
                        </button>
                    </div>
                </div>
                
                <!-- Exam Selection Card -->
                <div class="exam-selection-card">
                    <div class="card-header">
                        <i class="fas fa-cog"></i>
                        <h3>Exam & Class Selection</h3>
                    </div>
                    
                    <div class="selection-grid">
                        <div class="form-group">
                            <label for="academicYear">Academic Year *</label>
                            <select id="academicYear">
                                <option value="">Select Academic Year</option>
                                <option value="2023-2024" selected>2023-2024</option>
                                <option value="2022-2023">2022-2023</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="term">Term/Semester *</label>
                            <select id="term">
                                <option value="">Select Term</option>
                                <option value="1">Term 1</option>
                                <option value="2" selected>Term 2</option>
                                <option value="3">Term 3</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="gradeLevel">Grade Level *</label>
                            <select id="gradeLevel">
                                <option value="">Select Grade</option>
                                <option value="9">Grade 9</option>
                                <option value="10" selected>Grade 10</option>
                                <option value="11">Grade 11</option>
                                <option value="12">Grade 12</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="section">Section *</label>
                            <select id="section">
                                <option value="">Select Section</option>
                                <option value="A" selected>Section A</option>
                                <option value="B">Section B</option>
                                <option value="C">Section C</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Subject *</label>
                            <select id="subject">
                                <option value="">Select Subject</option>
                                <option value="math" selected>Mathematics</option>
                                <option value="physics">Physics</option>
                                <option value="chemistry">Chemistry</option>
                                <option value="biology">Biology</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="examType">Exam Type *</label>
                            <select id="examType">
                                <option value="">Select Exam Type</option>
                                <option value="midterm" selected>Midterm Exam</option>
                                <option value="final">Final Exam</option>
                                <option value="quiz">Quiz</option>
                                <option value="assignment">Assignment</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="maxScore">Maximum Score *</label>
                            <input type="number" id="maxScore" value="100" min="1" max="200">
                        </div>
                        
                        <div class="form-group">
                            <label for="examDate">Exam Date *</label>
                            <input type="date" id="examDate" value="2023-10-20">
                        </div>
                    </div>
                </div>
                
                <!-- Student Results Entry -->
                <div class="results-entry-card" id="resultsEntryCard">
                    <div class="card-header">
                        <i class="fas fa-edit"></i>
                        <h3>Enter Scores for Grade 10 - Section A</h3>
                    </div>
                    
                    <div class="class-summary">
                        <div class="summary-item">
                            <div class="summary-value" id="totalStudents">32</div>
                            <div class="summary-label">Total Students</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-value" id="enteredCount">0</div>
                            <div class="summary-label">Scores Entered</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-value" id="averageScore">0</div>
                            <div class="summary-label">Average Score</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-value" id="highestScore">0</div>
                            <div class="summary-label">Highest Score</div>
                        </div>
                    </div>
                    
                    <!-- Quick Actions Bar -->
                    <div class="quick-actions-bar">
                        <div>
                            <h4>Quick Actions</h4>
                            <p>Use these tools to manage results entry</p>
                        </div>
                        <div class="action-buttons">
                            <button class="action-btn calculate" id="calculateGradesBtn">
                                <i class="fas fa-calculator"></i> Calculate Grades
                            </button>
                            <button class="action-btn clear" id="clearScoresBtn">
                                <i class="fas fa-eraser"></i> Clear All
                            </button>
                            <button class="action-btn save" id="saveDraftBtn">
                                <i class="fas fa-save"></i> Save Draft
                            </button>
                        </div>
                    </div>
                    
                    <!-- Results Table -->
                    <div class="results-table-container">
                        <table class="results-table" id="resultsTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Student Name</th>
                                    <th>Student ID</th>
                                    <th>Score (out of 100)</th>
                                    <th>Grade</th>
                                    <th>Percentage</th>
                                    <th>Remarks</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="resultsTableBody">
                                <!-- Results rows will be dynamically generated -->
                            </tbody>
                        </table>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; margin-top: 30px;">
                        <button class="btn btn-secondary" id="cancelEntryBtn">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                        <button class="btn btn-primary" id="submitResultsBtn">
                            <i class="fas fa-paper-plane"></i> Submit Results
                        </button>
                    </div>
                </div>
                
                <!-- Statistics Panel -->
                <div class="statistics-panel" id="statisticsPanel" style="display: none;">
                    <div class="statistics-header">
                        <i class="fas fa-chart-bar"></i>
                        <h3>Result Statistics</h3>
                    </div>
                    
                    <div class="statistics-grid">
                        <div class="statistic-item">
                            <div class="statistic-value high" id="statAverage">0</div>
                            <div class="statistic-label">Class Average</div>
                        </div>
                        
                        <div class="statistic-item">
                            <div class="statistic-value high" id="statHighest">0</div>
                            <div class="statistic-label">Highest Score</div>
                        </div>
                        
                        <div class="statistic-item">
                            <div class="statistic-value medium" id="statMedian">0</div>
                            <div class="statistic-label">Median Score</div>
                        </div>
                        
                        <div class="statistic-item">
                            <div class="statistic-value low" id="statLowest">0</div>
                            <div class="statistic-label">Lowest Score</div>
                        </div>
                    </div>
                </div>
                
                <!-- Grade Distribution -->
                <div class="grade-distribution" id="gradeDistribution" style="display: none;">
                    <div class="distribution-header">
                        <h3>Grade Distribution</h3>
                        <div>Total Students: <span id="distTotal">0</span></div>
                    </div>
                    
                    <div class="distribution-bars" id="distributionBars">
                        <!-- Distribution bars will be dynamically generated -->
                    </div>
                </div>
                
                <!-- Recent Entries -->
                <div class="recent-entries">
                    <div class="card-header">
                        <i class="fas fa-history"></i>
                        <h3>Recent Result Entries</h3>
                    </div>
                    
                    <table class="entries-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Subject</th>
                                <th>Grade</th>
                                <th>Exam Type</th>
                                <th>Students</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2023-10-15</td>
                                <td>Mathematics</td>
                                <td>Grade 10</td>
                                <td>Quiz 3</td>
                                <td>32</td>
                                <td><span class="grade-display grade-a">Submitted</span></td>
                                <td><button class="action-btn" style="padding: 5px 10px; font-size: 0.8rem;">View</button></td>
                            </tr>
                            <tr>
                                <td>2023-10-10</td>
                                <td>Mathematics</td>
                                <td>Grade 10</td>
                                <td>Assignment 2</td>
                                <td>32</td>
                                <td><span class="grade-display grade-a">Submitted</span></td>
                                <td><button class="action-btn" style="padding: 5px 10px; font-size: 0.8rem;">View</button></td>
                            </tr>
                            <tr>
                                <td>2023-10-05</td>
                                <td>Mathematics</td>
                                <td>Grade 10</td>
                                <td>Midterm Exam</td>
                                <td>32</td>
                                <td><span class="grade-display grade-b">Draft</span></td>
                                <td><button class="action-btn" style="padding: 5px 10px; font-size: 0.8rem;">Edit</button></td>
                            </tr>
                            <tr>
                                <td>2023-09-28</td>
                                <td>Mathematics</td>
                                <td>Grade 10</td>
                                <td>Quiz 2</td>
                                <td>32</td>
                                <td><span class="grade-display grade-a">Submitted</span></td>
                                <td><button class="action-btn" style="padding: 5px 10px; font-size: 0.8rem;">View</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <!-- Footer -->
                <div class="dashboard-footer">
                    <p>&copy; 2023 T&T School Management System. All rights reserved. | Results Entry Module v2.3</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sample student data
        const sampleStudents = [
            { id: "STU-2023-001", name: "Michael Johnson", avatar: "https://randomuser.me/api/portraits/men/45.jpg" },
            { id: "STU-2023-002", name: "Sarah Williams", avatar: "https://randomuser.me/api/portraits/women/65.jpg" },
            { id: "STU-2023-003", name: "James Wilson", avatar: "https://randomuser.me/api/portraits/men/32.jpg" },
            { id: "STU-2023-004", name: "Emily Davis", avatar: "https://randomuser.me/api/portraits/women/32.jpg" },
            { id: "STU-2023-005", name: "Robert Chen", avatar: "https://randomuser.me/api/portraits/men/22.jpg" },
            { id: "STU-2023-006", name: "Olivia Martinez", avatar: "https://randomuser.me/api/portraits/women/45.jpg" },
            { id: "STU-2023-007", name: "David Brown", avatar: "https://randomuser.me/api/portraits/men/55.jpg" },
            { id: "STU-2023-008", name: "Sophia Garcia", avatar: "https://randomuser.me/api/portraits/women/68.jpg" },
            { id: "STU-2023-009", name: "William Taylor", avatar: "https://randomuser.me/api/portraits/men/65.jpg" },
            { id: "STU-2023-010", name: "Ava Anderson", avatar: "https://randomuser.me/api/portraits/women/22.jpg" }
        ];
        
        // DOM Elements
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const menuToggle = document.getElementById('menuToggle');
        const loadClassBtn = document.getElementById('loadClassBtn');
        const loadTemplateBtn = document.getElementById('loadTemplateBtn');
        const resultsEntryCard = document.getElementById('resultsEntryCard');
        const resultsTableBody = document.getElementById('resultsTableBody');
        const totalStudents = document.getElementById('totalStudents');
        const enteredCount = document.getElementById('enteredCount');
        const averageScore = document.getElementById('averageScore');
        const highestScore = document.getElementById('highestScore');
        const calculateGradesBtn = document.getElementById('calculateGradesBtn');
        const clearScoresBtn = document.getElementById('clearScoresBtn');
        const saveDraftBtn = document.getElementById('saveDraftBtn');
        const cancelEntryBtn = document.getElementById('cancelEntryBtn');
        const submitResultsBtn = document.getElementById('submitResultsBtn');
        const statisticsPanel = document.getElementById('statisticsPanel');
        const gradeDistribution = document.getElementById('gradeDistribution');
        const distributionBars = document.getElementById('distributionBars');
        
        // Statistics elements
        const statAverage = document.getElementById('statAverage');
        const statHighest = document.getElementById('statHighest');
        const statMedian = document.getElementById('statMedian');
        const statLowest = document.getElementById('statLowest');
        const distTotal = document.getElementById('distTotal');
        
        // Form elements
        const academicYear = document.getElementById('academicYear');
        const term = document.getElementById('term');
        const gradeLevel = document.getElementById('gradeLevel');
        const section = document.getElementById('section');
        const subject = document.getElementById('subject');
        const examType = document.getElementById('examType');
        const maxScore = document.getElementById('maxScore');
        const examDate = document.getElementById('examDate');
        
        // State variables
        let students = [];
        let resultsData = {};
        let isDataLoaded = false;
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            setupEventListeners();
            initializeForm();
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
            
            // Load class button
            loadClassBtn.addEventListener('click', loadClassData);
            
            // Load template button
            loadTemplateBtn.addEventListener('click', downloadTemplate);
            
            // Calculate grades button
            calculateGradesBtn.addEventListener('click', calculateAllGrades);
            
            // Clear scores button
            clearScoresBtn.addEventListener('click', clearAllScores);
            
            // Save draft button
            saveDraftBtn.addEventListener('click', saveDraft);
            
            // Cancel entry button
            cancelEntryBtn.addEventListener('click', cancelEntry);
            
            // Submit results button
            submitResultsBtn.addEventListener('click', submitResults);
            
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
        
        // Initialize form with default values
        function initializeForm() {
            // Set today's date as default exam date
            const today = new Date();
            const formattedDate = today.toISOString().split('T')[0];
            examDate.value = formattedDate;
        }
        
        // Load class data
        function loadClassData() {
            // Validate form
            if (!validateForm()) {
                alert('Please fill in all required fields.');
                return;
            }
            
            // Get form values
            const grade = gradeLevel.value;
            const sectionValue = section.value;
            const subjectValue = subject.options[subject.selectedIndex].text;
            const examTypeValue = examType.options[examType.selectedIndex].text;
            
            // Show loading state
            loadClassBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
            loadClassBtn.disabled = true;
            
            // Simulate API call delay
            setTimeout(() => {
                // Load sample students
                students = [...sampleStudents];
                resultsData = {};
                
                // Initialize results data
                students.forEach(student => {
                    resultsData[student.id] = {
                        score: '',
                        grade: '',
                        percentage: '',
                        remarks: '',
                        status: 'pending'
                    };
                });
                
                // Update UI
                renderResultsTable();
                updateClassSummary();
                
                // Show results entry card
                resultsEntryCard.classList.add('active');
                
                // Update card title
                const cardTitle = resultsEntryCard.querySelector('h3');
                cardTitle.textContent = `Enter Scores for ${subjectValue} - ${examTypeValue} (Grade ${grade} - Section ${sectionValue})`;
                
                // Reset button
                loadClassBtn.innerHTML = '<i class="fas fa-users"></i> Load Class';
                loadClassBtn.disabled = false;
                
                isDataLoaded = true;
            }, 1000);
        }
        
        // Validate form
        function validateForm() {
            const requiredFields = [academicYear, term, gradeLevel, section, subject, examType, maxScore, examDate];
            
            for (let field of requiredFields) {
                if (!field.value) {
                    field.style.borderColor = 'var(--danger)';
                    return false;
                } else {
                    field.style.borderColor = '';
                }
            }
            
            return true;
        }
        
        // Render results table
        function renderResultsTable() {
            resultsTableBody.innerHTML = '';
            
            students.forEach((student, index) => {
                const row = document.createElement('tr');
                const result = resultsData[student.id] || { score: '', grade: '', percentage: '', remarks: '', status: 'pending' };
                
                // Determine input class based on score validity
                let inputClass = '';
                if (result.score !== '') {
                    const scoreNum = parseFloat(result.score);
                    const maxScoreNum = parseFloat(maxScore.value) || 100;
                    inputClass = (scoreNum >= 0 && scoreNum <= maxScoreNum) ? 'valid' : 'invalid';
                }
                
                // Determine grade display
                let gradeDisplay = result.grade ? `<span class="grade-display grade-${result.grade.toLowerCase()}">${result.grade}</span>` : '';
                
                // Determine status indicator
                let statusDotClass = result.status === 'entered' ? 'entered' : 'pending';
                let statusText = result.status === 'entered' ? 'Entered' : 'Pending';
                
                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>
                        <div class="student-info-cell">
                            <div class="student-avatar-small">
                                <img src="${student.avatar}" alt="${student.name}">
                            </div>
                            <div class="student-details-small">
                                <h4>${student.name}</h4>
                            </div>
                        </div>
                    </td>
                    <td>${student.id}</td>
                    <td>
                        <input type="number" 
                               class="score-input ${inputClass}" 
                               data-student-id="${student.id}"
                               value="${result.score}"
                               min="0" 
                               max="${maxScore.value || 100}"
                               step="0.5"
                               placeholder="0-${maxScore.value || 100}">
                    </td>
                    <td class="grade-cell">${gradeDisplay}</td>
                    <td class="percentage-cell">${result.percentage || ''}</td>
                    <td>
                        <input type="text" 
                               class="remarks-input" 
                               data-student-id="${student.id}"
                               value="${result.remarks}"
                               placeholder="Enter remarks...">
                    </td>
                    <td>
                        <div class="status-indicator">
                            <span class="status-dot ${statusDotClass}"></span>
                            <span>${statusText}</span>
                        </div>
                    </td>
                `;
                
                resultsTableBody.appendChild(row);
            });
            
            // Add event listeners to score inputs
            document.querySelectorAll('.score-input').forEach(input => {
                input.addEventListener('input', handleScoreInput);
                input.addEventListener('blur', handleScoreBlur);
            });
            
            // Add event listeners to remarks inputs
            document.querySelectorAll('.remarks-input').forEach(input => {
                input.addEventListener('input', handleRemarksInput);
            });
            
            totalStudents.textContent = students.length;
        }
        
        // Handle score input
        function handleScoreInput(e) {
            const studentId = e.target.getAttribute('data-student-id');
            const score = e.target.value;
            const maxScoreNum = parseFloat(maxScore.value) || 100;
            
            // Update results data
            if (resultsData[studentId]) {
                resultsData[studentId].score = score;
                
                // Validate score
                const scoreNum = parseFloat(score);
                if (score === '' || (scoreNum >= 0 && scoreNum <= maxScoreNum)) {
                    e.target.classList.remove('invalid');
                    e.target.classList.add('valid');
                    resultsData[studentId].status = score === '' ? 'pending' : 'entered';
                } else {
                    e.target.classList.remove('valid');
                    e.target.classList.add('invalid');
                    resultsData[studentId].status = 'pending';
                }
            }
            
            // Update class summary
            updateClassSummary();
        }
        
        // Handle score blur (calculate grade)
        function handleScoreBlur(e) {
            const studentId = e.target.getAttribute('data-student-id');
            const score = e.target.value;
            
            if (score === '') return;
            
            // Calculate grade and percentage
            const scoreNum = parseFloat(score);
            const maxScoreNum = parseFloat(maxScore.value) || 100;
            const percentage = (scoreNum / maxScoreNum * 100).toFixed(1);
            const grade = calculateGrade(percentage);
            
            // Update results data
            if (resultsData[studentId]) {
                resultsData[studentId].percentage = percentage;
                resultsData[studentId].grade = grade;
                
                // Update UI
                const row = e.target.closest('tr');
                const gradeCell = row.querySelector('.grade-cell');
                const percentageCell = row.querySelector('.percentage-cell');
                const statusIndicator = row.querySelector('.status-indicator');
                
                gradeCell.innerHTML = `<span class="grade-display grade-${grade.toLowerCase()}">${grade}</span>`;
                percentageCell.textContent = percentage + '%';
                
                // Update status
                if (score !== '') {
                    resultsData[studentId].status = 'entered';
                    statusIndicator.innerHTML = `
                        <span class="status-dot entered"></span>
                        <span>Entered</span>
                    `;
                }
            }
            
            // Update class summary
            updateClassSummary();
        }
        
        // Handle remarks input
        function handleRemarksInput(e) {
            const studentId = e.target.getAttribute('data-student-id');
            const remarks = e.target.value;
            
            // Update results data
            if (resultsData[studentId]) {
                resultsData[studentId].remarks = remarks;
            }
        }
        
        // Calculate grade from percentage
        function calculateGrade(percentage) {
            if (percentage >= 90) return 'A';
            if (percentage >= 80) return 'B';
            if (percentage >= 70) return 'C';
            if (percentage >= 60) return 'D';
            return 'F';
        }
        
        // Update class summary
        function updateClassSummary() {
            let entered = 0;
            let totalScore = 0;
            let highest = 0;
            let validScores = [];
            
            // Calculate statistics
            Object.values(resultsData).forEach(result => {
                if (result.score !== '') {
                    const scoreNum = parseFloat(result.score);
                    const maxScoreNum = parseFloat(maxScore.value) || 100;
                    
                    if (!isNaN(scoreNum) && scoreNum >= 0 && scoreNum <= maxScoreNum) {
                        entered++;
                        totalScore += scoreNum;
                        validScores.push(scoreNum);
                        
                        if (scoreNum > highest) {
                            highest = scoreNum;
                        }
                    }
                }
            });
            
            // Update UI
            enteredCount.textContent = entered;
            
            if (validScores.length > 0) {
                const average = (totalScore / validScores.length).toFixed(1);
                averageScore.textContent = average;
                highestScore.textContent = highest;
            } else {
                averageScore.textContent = '0';
                highestScore.textContent = '0';
            }
            
            // Update statistics panel if visible
            if (validScores.length > 0) {
                updateStatisticsPanel(validScores);
                updateGradeDistribution();
                
                // Show statistics panels
                statisticsPanel.style.display = 'block';
                gradeDistribution.style.display = 'block';
            } else {
                // Hide statistics panels
                statisticsPanel.style.display = 'none';
                gradeDistribution.style.display = 'none';
            }
        }
        
        // Update statistics panel
        function updateStatisticsPanel(scores) {
            if (scores.length === 0) return;
            
            // Calculate statistics
            const sum = scores.reduce((a, b) => a + b, 0);
            const avg = sum / scores.length;
            const max = Math.max(...scores);
            const min = Math.min(...scores);
            
            // Calculate median
            const sorted = [...scores].sort((a, b) => a - b);
            const middle = Math.floor(sorted.length / 2);
            const median = sorted.length % 2 === 0 
                ? (sorted[middle - 1] + sorted[middle]) / 2 
                : sorted[middle];
            
            // Update UI
            statAverage.textContent = avg.toFixed(1);
            statHighest.textContent = max.toFixed(1);
            statMedian.textContent = median.toFixed(1);
            statLowest.textContent = min.toFixed(1);
        }
        
        // Update grade distribution
        function updateGradeDistribution() {
            // Count grades
            const gradeCounts = { A: 0, B: 0, C: 0, D: 0, F: 0 };
            
            Object.values(resultsData).forEach(result => {
                if (result.grade) {
                    gradeCounts[result.grade] = (gradeCounts[result.grade] || 0) + 1;
                }
            });
            
            const total = Object.values(gradeCounts).reduce((a, b) => a + b, 0);
            distTotal.textContent = total;
            
            // Find maximum count for scaling
            const maxCount = Math.max(...Object.values(gradeCounts));
            
            // Clear previous bars
            distributionBars.innerHTML = '';
            
            // Create bars
            const grades = ['A', 'B', 'C', 'D', 'F'];
            grades.forEach(grade => {
                const count = gradeCounts[grade] || 0;
                const percentage = maxCount > 0 ? (count / maxCount * 100) : 0;
                
                const barElement = document.createElement('div');
                barElement.className = 'distribution-bar';
                
                barElement.innerHTML = `
                    <div class="bar-label">${grade}</div>
                    <div class="bar bar-${grade.toLowerCase()}" style="height: ${percentage}%"></div>
                    <div class="bar-count">${count}</div>
                `;
                
                distributionBars.appendChild(barElement);
            });
        }
        
        // Calculate all grades
        function calculateAllGrades() {
            document.querySelectorAll('.score-input').forEach(input => {
                if (input.value !== '') {
                    handleScoreBlur({ target: input });
                }
            });
            
            alert('All grades have been calculated.');
        }
        
        // Clear all scores
        function clearAllScores() {
            if (!confirm('Are you sure you want to clear all scores? This action cannot be undone.')) {
                return;
            }
            
            // Reset results data
            Object.keys(resultsData).forEach(studentId => {
                resultsData[studentId] = {
                    score: '',
                    grade: '',
                    percentage: '',
                    remarks: '',
                    status: 'pending'
                };
            });
            
            // Re-render table
            renderResultsTable();
            updateClassSummary();
            
            alert('All scores have been cleared.');
        }
        
        // Save draft
        function saveDraft() {
            // Validate that at least one score is entered
            const enteredScores = Object.values(resultsData).filter(result => result.score !== '').length;
            
            if (enteredScores === 0) {
                alert('Please enter at least one score before saving.');
                return;
            }
            
            // Show saving state
            saveDraftBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
            saveDraftBtn.disabled = true;
            
            // Simulate API call
            setTimeout(() => {
                // In a real app, this would save to a database
                console.log('Draft saved:', resultsData);
                
                // Reset button
                saveDraftBtn.innerHTML = '<i class="fas fa-save"></i> Save Draft';
                saveDraftBtn.disabled = false;
                
                alert('Draft saved successfully!');
            }, 1000);
        }
        
        // Cancel entry
        function cancelEntry() {
            if (!confirm('Are you sure you want to cancel? Any unsaved changes will be lost.')) {
                return;
            }
            
            // Reset everything
            resultsEntryCard.classList.remove('active');
            statisticsPanel.style.display = 'none';
            gradeDistribution.style.display = 'none';
            students = [];
            resultsData = {};
            isDataLoaded = false;
        }
        
        // Submit results
        function submitResults() {
            // Validate that all scores are entered
            const enteredScores = Object.values(resultsData).filter(result => result.score !== '').length;
            
            if (enteredScores === 0) {
                alert('Please enter at least one score before submitting.');
                return;
            }
            
            if (enteredScores < students.length) {
                if (!confirm(`${students.length - enteredScores} students are missing scores. Do you want to submit anyway?`)) {
                    return;
                }
            }
            
            // Show submitting state
            submitResultsBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
            submitResultsBtn.disabled = true;
            
            // Simulate API call
            setTimeout(() => {
                // In a real app, this would submit to a database
                console.log('Results submitted:', resultsData);
                
                // Show success message
                alert('Results submitted successfully!');
                
                // Reset form
                cancelEntry();
                
                // Reset button
                submitResultsBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Submit Results';
                submitResultsBtn.disabled = false;
            }, 1500);
        }
        
        // Download template
        function downloadTemplate() {
            alert('Downloading results template...');
            
            // Simulate download
            const link = document.createElement('a');
            link.href = '#';
            link.download = 'TTSchool_Results_Entry_Template.csv';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
        
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