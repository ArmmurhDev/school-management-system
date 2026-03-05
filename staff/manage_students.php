<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students - T&T School Management System</title>
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
        
        /* Student Management Header */
        .student-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .student-header h2 {
            font-size: 1.8rem;
        }
        
        .student-actions {
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
        
        .btn-warning {
            background-color: var(--warning);
            color: var(--text-dark);
        }
        
        /* Stats Overview */
        .stats-overview {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-item {
            background-color: var(--white);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px var(--shadow);
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }
        
        .stat-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 51, 102, 0.15);
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.3rem;
        }
        
        .stat-icon.total {
            background-color: rgba(30, 136, 229, 0.1);
            color: var(--accent-blue);
        }
        
        .stat-icon.active {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }
        
        .stat-icon.inactive {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger);
        }
        
        .stat-icon.new {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning);
        }
        
        .stat-info h3 {
            font-size: 1.5rem;
            margin-bottom: 5px;
        }
        
        .stat-info p {
            font-size: 0.9rem;
            color: var(--text-light);
        }
        
        /* Filters Bar */
        .filters-bar {
            background-color: var(--white);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px var(--shadow);
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
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
            font-size: 0.9rem;
        }
        
        .filter-group select,
        .filter-group input {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-family: 'Open Sans', sans-serif;
            font-size: 0.95rem;
            background-color: #f9f9f9;
        }
        
        .filter-group input:focus,
        .filter-group select:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(77, 143, 204, 0.1);
        }
        
        /* Student Table */
        .student-table-container {
            background-color: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px var(--shadow);
            margin-bottom: 40px;
        }
        
        .table-header {
            padding: 25px 30px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .table-header h3 {
            font-size: 1.3rem;
        }
        
        .table-responsive {
            overflow-x: auto;
        }
        
        .student-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .student-table thead {
            background-color: var(--light-bg);
        }
        
        .student-table th {
            padding: 18px 20px;
            text-align: left;
            font-weight: 600;
            color: var(--primary-dark);
            border-bottom: 2px solid #eee;
            white-space: nowrap;
        }
        
        .student-table td {
            padding: 20px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }
        
        .student-table tbody tr {
            transition: all 0.3s;
        }
        
        .student-table tbody tr:hover {
            background-color: #f9f9f9;
        }
        
        .student-info {
            display: flex;
            align-items: center;
        }
        
        .student-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 15px;
            border: 3px solid var(--light-bg);
        }
        
        .student-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .student-details h4 {
            font-size: 1rem;
            margin-bottom: 5px;
        }
        
        .student-details p {
            font-size: 0.85rem;
            color: var(--text-light);
        }
        
        .grade-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            background-color: var(--light-bg);
            color: var(--primary-medium);
        }
        
        .status-indicator {
            display: inline-flex;
            align-items: center;
        }
        
        .status-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 8px;
        }
        
        .status-dot.active {
            background-color: var(--success);
        }
        
        .status-dot.inactive {
            background-color: var(--danger);
        }
        
        .status-dot.graduated {
            background-color: var(--accent-blue);
        }
        
        .action-buttons {
            display: flex;
            gap: 8px;
        }
        
        .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .action-btn.edit {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning);
        }
        
        .action-btn.delete {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger);
        }
        
        .action-btn.view {
            background-color: rgba(30, 136, 229, 0.1);
            color: var(--accent-blue);
        }
        
        .action-btn:hover {
            transform: scale(1.1);
        }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .modal.active {
            display: flex;
        }
        
        .modal-content {
            background-color: var(--white);
            border-radius: 15px;
            width: 100%;
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        }
        
        .modal-header {
            padding: 25px 30px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-header h3 {
            font-size: 1.5rem;
            color: var(--primary-dark);
        }
        
        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text-light);
            cursor: pointer;
            transition: color 0.3s;
        }
        
        .close-modal:hover {
            color: var(--danger);
        }
        
        .modal-body {
            padding: 30px;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 20px;
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
        
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: 'Open Sans', sans-serif;
            font-size: 0.95rem;
            background-color: #f9f9f9;
        }
        
        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }
        
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(77, 143, 204, 0.1);
        }
        
        .modal-footer {
            padding: 20px 30px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
            gap: 15px;
        }
        
        /* Student Detail View */
        .student-detail-modal .modal-content {
            max-width: 900px;
        }
        
        .student-profile-header {
            display: flex;
            align-items: center;
            padding: 30px;
            background: linear-gradient(to right, var(--primary-dark), var(--primary-medium));
            color: var(--white);
        }
        
        .student-profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 30px;
            border: 5px solid rgba(255, 255, 255, 0.3);
        }
        
        .student-profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .student-profile-info h2 {
            color: var(--white);
            font-size: 1.8rem;
            margin-bottom: 10px;
        }
        
        .student-profile-info p {
            opacity: 0.9;
            margin-bottom: 5px;
        }
        
        .student-detail-content {
            padding: 30px;
        }
        
        .detail-section {
            margin-bottom: 30px;
        }
        
        .detail-section h4 {
            font-size: 1.2rem;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--light-bg);
            color: var(--primary-medium);
        }
        
        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .detail-item {
            display: flex;
            flex-direction: column;
        }
        
        .detail-label {
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 5px;
            font-size: 0.9rem;
        }
        
        .detail-value {
            color: var(--text-dark);
            font-size: 1rem;
        }
        
        /* Quick Actions */
        .quick-actions {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        
        .quick-action-btn {
            display: inline-flex;
            align-items: center;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            border: none;
            background-color: var(--white);
            color: var(--primary-medium);
            box-shadow: 0 3px 10px var(--shadow);
        }
        
        .quick-action-btn i {
            margin-right: 8px;
            font-size: 1rem;
        }
        
        .quick-action-btn:hover {
            background-color: var(--light-bg);
            transform: translateY(-2px);
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
            .detail-grid {
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
            
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .stats-overview {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .student-profile-header {
                flex-direction: column;
                text-align: center;
            }
            
            .student-profile-avatar {
                margin-right: 0;
                margin-bottom: 20px;
            }
        }
        
        @media (max-width: 768px) {
            .student-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }
            
            .student-actions {
                width: 100%;
                justify-content: space-between;
            }
            
            .top-header {
                padding: 20px;
            }
            
            .dashboard-content {
                padding: 20px;
            }
            
            .modal-content {
                max-width: 95%;
            }
            
            .stats-overview {
                grid-template-columns: 1fr;
            }
            
            .table-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .detail-grid {
                grid-template-columns: 1fr;
            }
            
            .quick-actions {
                justify-content: center;
            }
        }
        
        @media (max-width: 576px) {
            .student-actions {
                flex-direction: column;
                gap: 10px;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
            
            .filters-bar {
                flex-direction: column;
                align-items: stretch;
            }
            
            .action-buttons {
                flex-wrap: wrap;
            }
            
            .quick-action-btn {
                flex: 1;
                min-width: 150px;
                justify-content: center;
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
                    <p>Student Management</p>
                </div>
            </div>
            
            <div class="sidebar-menu">
                <a href="dashboard.html" class="menu-item">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
                
                <a href="manage-students.html" class="menu-item active">
                    <i class="fas fa-users"></i>
                    <span class="menu-text">Students</span>
                </a>
                
                <a href="manage-teachers.html" class="menu-item">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span class="menu-text">Teachers</span>
                </a>
                
                <a href="manage-courses.html" class="menu-item">
                    <i class="fas fa-book"></i>
                    <span class="menu-text">Courses</span>
                </a>
                
                <a href="manage-staff.html" class="menu-item">
                    <i class="fas fa-user-tie"></i>
                    <span class="menu-text">Staff</span>
                </a>
                
                <a href="attendance.html" class="menu-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span class="menu-text">Attendance</span>
                </a>
                
                <a href="grades.html" class="menu-item">
                    <i class="fas fa-chart-bar"></i>
                    <span class="menu-text">Grades</span>
                </a>
            </div>
            
            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Admin">
                    </div>
                    <div class="user-details">
                        <h4>Dr. Sarah Williams</h4>
                        <p>Academic Director</p>
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
                        <h1>Student Management</h1>
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
                <!-- Student Header -->
                <div class="student-header">
                    <h2>All Students</h2>
                    <div class="student-actions">
                        <button class="btn btn-secondary" id="filterBtn">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <button class="btn btn-primary" id="addStudentBtn">
                            <i class="fas fa-user-plus"></i> Add New Student
                        </button>
                    </div>
                </div>
                
                <!-- Quick Actions -->
                <div class="quick-actions">
                    <button class="quick-action-btn" id="bulkEnrollBtn">
                        <i class="fas fa-user-friends"></i> Bulk Enrollment
                    </button>
                    <button class="quick-action-btn" id="exportBtn">
                        <i class="fas fa-file-export"></i> Export Data
                    </button>
                    <button class="quick-action-btn" id="importBtn">
                        <i class="fas fa-file-import"></i> Import Students
                    </button>
                    <button class="quick-action-btn" id="printBtn">
                        <i class="fas fa-print"></i> Print Report
                    </button>
                </div>
                
                <!-- Stats Overview -->
                <div class="stats-overview">
                    <div class="stat-item">
                        <div class="stat-icon total">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <h3>1,245</h3>
                            <p>Total Students</p>
                        </div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-icon active">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="stat-info">
                            <h3>1,182</h3>
                            <p>Active Students</p>
                        </div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-icon inactive">
                            <i class="fas fa-user-slash"></i>
                        </div>
                        <div class="stat-info">
                            <h3>42</h3>
                            <p>Inactive Students</p>
                        </div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-icon new">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="stat-info">
                            <h3>21</h3>
                            <p>New This Month</p>
                        </div>
                    </div>
                </div>
                
                <!-- Filters Bar -->
                <div class="filters-bar" id="filtersBar">
                    <div class="filter-group">
                        <label for="studentGrade">Grade Level</label>
                        <select id="studentGrade">
                            <option value="">All Grades</option>
                            <option value="1">Grade 1</option>
                            <option value="2">Grade 2</option>
                            <option value="3">Grade 3</option>
                            <option value="4">Grade 4</option>
                            <option value="5">Grade 5</option>
                            <option value="6">Grade 6</option>
                            <option value="7">Grade 7</option>
                            <option value="8">Grade 8</option>
                            <option value="9">Grade 9</option>
                            <option value="10">Grade 10</option>
                            <option value="11">Grade 11</option>
                            <option value="12">Grade 12</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="studentStatus">Status</label>
                        <select id="studentStatus">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="graduated">Graduated</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="studentSearch">Search</label>
                        <input type="text" id="studentSearch" placeholder="Search by name or ID...">
                    </div>
                    
                    <div class="filter-group">
                        <button class="btn btn-secondary" id="clearFiltersBtn">
                            <i class="fas fa-times"></i> Clear Filters
                        </button>
                    </div>
                </div>
                
                <!-- Student Table -->
                <div class="student-table-container">
                    <div class="table-header">
                        <h3>Student Records</h3>
                        <div>
                            <span id="studentCount">1,245</span> students found
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="student-table" id="studentTable">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Grade</th>
                                    <th>Parent/Guardian</th>
                                    <th>Contact</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="studentTableBody">
                                <!-- Student rows will be dynamically generated -->
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="dashboard-footer">
                    <p>&copy; 2023 T&T School Management System. All rights reserved. | Student Management Module v1.4</p>
                </div>
            </div>
        </div>
        
        <!-- Add/Edit Student Modal -->
        <div class="modal" id="studentModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="modalTitle">Add New Student</h3>
                    <button class="close-modal" id="closeModal">&times;</button>
                </div>
                
                <div class="modal-body">
                    <form id="studentForm">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="studentFirstName">First Name *</label>
                                <input type="text" id="studentFirstName" required placeholder="Enter first name">
                            </div>
                            
                            <div class="form-group">
                                <label for="studentLastName">Last Name *</label>
                                <input type="text" id="studentLastName" required placeholder="Enter last name">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="studentDOB">Date of Birth *</label>
                                <input type="date" id="studentDOB" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="studentGender">Gender *</label>
                                <select id="studentGender" required>
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="studentGradeModal">Grade Level *</label>
                                <select id="studentGradeModal" required>
                                    <option value="">Select Grade</option>
                                    <option value="1">Grade 1</option>
                                    <option value="2">Grade 2</option>
                                    <option value="3">Grade 3</option>
                                    <option value="4">Grade 4</option>
                                    <option value="5">Grade 5</option>
                                    <option value="6">Grade 6</option>
                                    <option value="7">Grade 7</option>
                                    <option value="8">Grade 8</option>
                                    <option value="9">Grade 9</option>
                                    <option value="10">Grade 10</option>
                                    <option value="11">Grade 11</option>
                                    <option value="12">Grade 12</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="studentEnrollmentDate">Enrollment Date *</label>
                                <input type="date" id="studentEnrollmentDate" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="parentName">Parent/Guardian Name *</label>
                                <input type="text" id="parentName" required placeholder="Enter parent/guardian name">
                            </div>
                            
                            <div class="form-group">
                                <label for="parentEmail">Parent Email *</label>
                                <input type="email" id="parentEmail" required placeholder="Enter parent email">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="parentPhone">Parent Phone *</label>
                                <input type="tel" id="parentPhone" required placeholder="Enter parent phone">
                            </div>
                            
                            <div class="form-group">
                                <label for="studentAddress">Address</label>
                                <input type="text" id="studentAddress" placeholder="Enter address">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="studentStatusModal">Status *</label>
                                <select id="studentStatusModal" required>
                                    <option value="">Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="graduated">Graduated</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="studentMedical">Medical Notes</label>
                                <input type="text" id="studentMedical" placeholder="Any medical conditions">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="studentNotes">Additional Notes</label>
                            <textarea id="studentNotes" placeholder="Enter any additional notes"></textarea>
                        </div>
                    </form>
                </div>
                
                <div class="modal-footer">
                    <button class="btn btn-secondary" id="cancelModalBtn">Cancel</button>
                    <button class="btn btn-primary" id="saveStudentBtn">Save Student</button>
                </div>
            </div>
        </div>
        
        <!-- Student Detail Modal -->
        <div class="modal student-detail-modal" id="studentDetailModal">
            <div class="modal-content">
                <div class="student-profile-header" id="studentDetailHeader">
                    <!-- Will be populated dynamically -->
                </div>
                
                <div class="student-detail-content">
                    <div class="detail-section">
                        <h4>Personal Information</h4>
                        <div class="detail-grid" id="personalInfo">
                            <!-- Will be populated dynamically -->
                        </div>
                    </div>
                    
                    <div class="detail-section">
                        <h4>Academic Information</h4>
                        <div class="detail-grid" id="academicInfo">
                            <!-- Will be populated dynamically -->
                        </div>
                    </div>
                    
                    <div class="detail-section">
                        <h4>Parent/Guardian Information</h4>
                        <div class="detail-grid" id="parentInfo">
                            <!-- Will be populated dynamically -->
                        </div>
                    </div>
                    
                    <div class="detail-section">
                        <h4>Additional Information</h4>
                        <div class="detail-grid" id="additionalInfo">
                            <!-- Will be populated dynamically -->
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button class="btn btn-secondary" id="closeDetailModalBtn">Close</button>
                    <button class="btn btn-primary" id="editDetailStudentBtn">Edit Student</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sample student data
        const sampleStudents = [
            {
                id: 1,
                firstName: "Michael",
                lastName: "Johnson",
                fullName: "Michael Johnson",
                dob: "2007-05-15",
                age: 16,
                gender: "male",
                grade: "10",
                enrollmentDate: "2023-09-01",
                parentName: "John Johnson",
                parentEmail: "john.johnson@email.com",
                parentPhone: "+1 (555) 123-4567",
                address: "123 Maple Street, Knowledge City",
                status: "active",
                medicalNotes: "None",
                additionalNotes: "Honor roll student, participates in basketball",
                avatar: "https://randomuser.me/api/portraits/men/45.jpg",
                studentId: "STU-2023-001"
            },
            {
                id: 2,
                firstName: "Sarah",
                lastName: "Williams",
                fullName: "Sarah Williams",
                dob: "2008-08-22",
                age: 15,
                gender: "female",
                grade: "9",
                enrollmentDate: "2023-09-10",
                parentName: "Mary Williams",
                parentEmail: "mary.williams@email.com",
                parentPhone: "+1 (555) 234-5678",
                address: "456 Oak Avenue, Knowledge City",
                status: "active",
                medicalNotes: "Asthma (inhaler required)",
                additionalNotes: "Excellent in mathematics, art club member",
                avatar: "https://randomuser.me/api/portraits/women/65.jpg",
                studentId: "STU-2023-002"
            },
            {
                id: 3,
                firstName: "Emily",
                lastName: "Davis",
                fullName: "Emily Davis",
                dob: "2006-02-10",
                age: 17,
                gender: "female",
                grade: "11",
                enrollmentDate: "2022-08-15",
                parentName: "Robert Davis",
                parentEmail: "robert.davis@email.com",
                parentPhone: "+1 (555) 345-6789",
                address: "789 Pine Road, Knowledge City",
                status: "active",
                medicalNotes: "None",
                additionalNotes: "Science fair winner, debate team captain",
                avatar: "https://randomuser.me/api/portraits/women/32.jpg",
                studentId: "STU-2022-015"
            },
            {
                id: 4,
                firstName: "James",
                lastName: "Wilson",
                fullName: "James Wilson",
                dob: "2009-11-30",
                age: 14,
                gender: "male",
                grade: "8",
                enrollmentDate: "2023-09-05",
                parentName: "Patricia Wilson",
                parentEmail: "patricia.wilson@email.com",
                parentPhone: "+1 (555) 456-7890",
                address: "321 Cedar Lane, Knowledge City",
                status: "active",
                medicalNotes: "Food allergies (peanuts)",
                additionalNotes: "Soccer team member, needs help with English",
                avatar: "https://randomuser.me/api/portraits/men/22.jpg",
                studentId: "STU-2023-003"
            },
            {
                id: 5,
                firstName: "Olivia",
                lastName: "Martinez",
                fullName: "Olivia Martinez",
                dob: "2007-07-18",
                age: 16,
                gender: "female",
                grade: "10",
                enrollmentDate: "2023-09-01",
                parentName: "Carlos Martinez",
                parentEmail: "carlos.martinez@email.com",
                parentPhone: "+1 (555) 567-8901",
                address: "654 Birch Boulevard, Knowledge City",
                status: "inactive",
                medicalNotes: "None",
                additionalNotes: "Transferred to another school",
                avatar: "https://randomuser.me/api/portraits/women/45.jpg",
                studentId: "STU-2023-004"
            },
            {
                id: 6,
                firstName: "Daniel",
                lastName: "Thompson",
                fullName: "Daniel Thompson",
                dob: "2005-12-05",
                age: 18,
                gender: "male",
                grade: "12",
                enrollmentDate: "2021-08-20",
                parentName: "Susan Thompson",
                parentEmail: "susan.thompson@email.com",
                parentPhone: "+1 (555) 678-9012",
                address: "987 Elm Street, Knowledge City",
                status: "graduated",
                medicalNotes: "None",
                additionalNotes: "Valedictorian, accepted to State University",
                avatar: "https://randomuser.me/api/portraits/men/55.jpg",
                studentId: "STU-2021-028"
            },
            {
                id: 7,
                firstName: "Sophia",
                lastName: "Anderson",
                fullName: "Sophia Anderson",
                dob: "2008-03-25",
                age: 15,
                gender: "female",
                grade: "9",
                enrollmentDate: "2023-09-12",
                parentName: "Thomas Anderson",
                parentEmail: "thomas.anderson@email.com",
                parentPhone: "+1 (555) 789-0123",
                address: "147 Walnut Avenue, Knowledge City",
                status: "active",
                medicalNotes: "Wears glasses",
                additionalNotes: "Music club, plays violin",
                avatar: "https://randomuser.me/api/portraits/women/68.jpg",
                studentId: "STU-2023-005"
            },
            {
                id: 8,
                firstName: "Ethan",
                lastName: "Brown",
                fullName: "Ethan Brown",
                dob: "2009-09-14",
                age: 14,
                gender: "male",
                grade: "8",
                enrollmentDate: "2023-09-08",
                parentName: "Lisa Brown",
                parentEmail: "lisa.brown@email.com",
                parentPhone: "+1 (555) 890-1234",
                address: "258 Spruce Road, Knowledge City",
                status: "active",
                medicalNotes: "ADHD (medication managed)",
                additionalNotes: "Chess club, needs extra time for tests",
                avatar: "https://randomuser.me/api/portraits/men/33.jpg",
                studentId: "STU-2023-006"
            }
        ];
        
        // DOM Elements
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const menuToggle = document.getElementById('menuToggle');
        const studentTableBody = document.getElementById('studentTableBody');
        const addStudentBtn = document.getElementById('addStudentBtn');
        const filterBtn = document.getElementById('filterBtn');
        const filtersBar = document.getElementById('filtersBar');
        const clearFiltersBtn = document.getElementById('clearFiltersBtn');
        const studentModal = document.getElementById('studentModal');
        const studentDetailModal = document.getElementById('studentDetailModal');
        const modalTitle = document.getElementById('modalTitle');
        const studentForm = document.getElementById('studentForm');
        const closeModal = document.getElementById('closeModal');
        const cancelModalBtn = document.getElementById('cancelModalBtn');
        const saveStudentBtn = document.getElementById('saveStudentBtn');
        const studentCount = document.getElementById('studentCount');
        const closeDetailModalBtn = document.getElementById('closeDetailModalBtn');
        const editDetailStudentBtn = document.getElementById('editDetailStudentBtn');
        
        // Filter elements
        const studentGradeFilter = document.getElementById('studentGrade');
        const studentStatusFilter = document.getElementById('studentStatus');
        const studentSearchFilter = document.getElementById('studentSearch');
        
        // Quick action buttons
        const bulkEnrollBtn = document.getElementById('bulkEnrollBtn');
        const exportBtn = document.getElementById('exportBtn');
        const importBtn = document.getElementById('importBtn');
        const printBtn = document.getElementById('printBtn');
        
        // Form elements
        const studentFirstNameInput = document.getElementById('studentFirstName');
        const studentLastNameInput = document.getElementById('studentLastName');
        const studentDOBInput = document.getElementById('studentDOB');
        const studentGenderInput = document.getElementById('studentGender');
        const studentGradeModalInput = document.getElementById('studentGradeModal');
        const studentEnrollmentDateInput = document.getElementById('studentEnrollmentDate');
        const parentNameInput = document.getElementById('parentName');
        const parentEmailInput = document.getElementById('parentEmail');
        const parentPhoneInput = document.getElementById('parentPhone');
        const studentAddressInput = document.getElementById('studentAddress');
        const studentStatusModalInput = document.getElementById('studentStatusModal');
        const studentMedicalInput = document.getElementById('studentMedical');
        const studentNotesInput = document.getElementById('studentNotes');
        
        // Student detail elements
        const studentDetailHeader = document.getElementById('studentDetailHeader');
        const personalInfo = document.getElementById('personalInfo');
        const academicInfo = document.getElementById('academicInfo');
        const parentInfo = document.getElementById('parentInfo');
        const additionalInfo = document.getElementById('additionalInfo');
        
        // State variables
        let students = [...sampleStudents];
        let currentEditId = null;
        let filtersVisible = true;
        let currentDetailStudentId = null;
        
        // Set default dates for the form
        const today = new Date();
        const fifteenYearsAgo = new Date();
        fifteenYearsAgo.setFullYear(today.getFullYear() - 15);
        
        studentDOBInput.valueAsDate = fifteenYearsAgo;
        studentEnrollmentDateInput.valueAsDate = today;
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            renderStudents();
            setupEventListeners();
            updateStudentCount();
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
            
            // Modal controls
            addStudentBtn.addEventListener('click', () => openModal('add'));
            
            closeModal.addEventListener('click', closeModalFunc);
            cancelModalBtn.addEventListener('click', closeModalFunc);
            
            // Save student
            saveStudentBtn.addEventListener('click', saveStudent);
            
            // Filter toggle
            filterBtn.addEventListener('click', () => {
                filtersVisible = !filtersVisible;
                filtersBar.style.display = filtersVisible ? 'flex' : 'none';
                filterBtn.innerHTML = filtersVisible 
                    ? '<i class="fas fa-filter"></i> Hide Filters' 
                    : '<i class="fas fa-filter"></i> Show Filters';
            });
            
            // Clear filters
            clearFiltersBtn.addEventListener('click', clearFilters);
            
            // Filter events
            studentGradeFilter.addEventListener('change', applyFilters);
            studentStatusFilter.addEventListener('change', applyFilters);
            studentSearchFilter.addEventListener('input', applyFilters);
            
            // Quick action buttons
            bulkEnrollBtn.addEventListener('click', () => {
                alert('Bulk enrollment feature would open here.');
            });
            
            exportBtn.addEventListener('click', () => {
                alert('Export feature would open here. Exporting student data.');
            });
            
            importBtn.addEventListener('click', () => {
                alert('Import feature would open here. You can import student data from a CSV file.');
            });
            
            printBtn.addEventListener('click', () => {
                alert('Printing student report...');
                // In a real app, this would trigger print functionality
            });
            
            // Student detail modal
            closeDetailModalBtn.addEventListener('click', () => {
                studentDetailModal.classList.remove('active');
            });
            
            editDetailStudentBtn.addEventListener('click', () => {
                if (currentDetailStudentId) {
                    studentDetailModal.classList.remove('active');
                    openModal('edit', currentDetailStudentId);
                }
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
        
        // Render students to table
        function renderStudents(filteredStudents = students) {
            studentTableBody.innerHTML = '';
            
            if (filteredStudents.length === 0) {
                const emptyRow = document.createElement('tr');
                emptyRow.innerHTML = `
                    <td colspan="6" style="text-align: center; padding: 40px; color: var(--text-light);">
                        <i class="fas fa-user-graduate" style="font-size: 2rem; margin-bottom: 15px; display: block;"></i>
                        <h4>No students found</h4>
                        <p>Try adjusting your filters or add a new student</p>
                    </td>
                `;
                studentTableBody.appendChild(emptyRow);
                return;
            }
            
            filteredStudents.forEach(student => {
                const row = createStudentTableRow(student);
                studentTableBody.appendChild(row);
            });
        }
        
        // Create a student table row
        function createStudentTableRow(student) {
            const row = document.createElement('tr');
            row.dataset.id = student.id;
            
            // Calculate age from DOB
            const age = calculateAge(student.dob);
            
            // Get status dot class and text
            let statusDotClass = '';
            let statusText = '';
            switch(student.status) {
                case 'active':
                    statusDotClass = 'active';
                    statusText = 'Active';
                    break;
                case 'inactive':
                    statusDotClass = 'inactive';
                    statusText = 'Inactive';
                    break;
                case 'graduated':
                    statusDotClass = 'graduated';
                    statusText = 'Graduated';
                    break;
            }
            
            row.innerHTML = `
                <td>
                    <div class="student-info">
                        <div class="student-avatar">
                            <img src="${student.avatar}" alt="${student.fullName}">
                        </div>
                        <div class="student-details">
                            <h4>${student.fullName}</h4>
                            <p>ID: ${student.studentId} | Age: ${age}</p>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="grade-badge">Grade ${student.grade}</span>
                </td>
                <td>
                    <div>${student.parentName}</div>
                    <small>${student.parentEmail}</small>
                </td>
                <td>${student.parentPhone}</td>
                <td>
                    <div class="status-indicator">
                        <span class="status-dot ${statusDotClass}"></span>
                        <span>${statusText}</span>
                    </div>
                </td>
                <td>
                    <div class="action-buttons">
                        <button class="action-btn view" data-id="${student.id}">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="action-btn edit" data-id="${student.id}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="action-btn delete" data-id="${student.id}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            `;
            
            // Add event listeners to action buttons
            const viewBtn = row.querySelector('.action-btn.view');
            const editBtn = row.querySelector('.action-btn.edit');
            const deleteBtn = row.querySelector('.action-btn.delete');
            
            viewBtn.addEventListener('click', () => viewStudent(student.id));
            editBtn.addEventListener('click', () => openModal('edit', student.id));
            deleteBtn.addEventListener('click', () => deleteStudent(student.id));
            
            return row;
        }
        
        // Calculate age from date of birth
        function calculateAge(dob) {
            const birthDate = new Date(dob);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            
            return age;
        }
        
        // Apply filters to students
        function applyFilters() {
            const gradeFilter = studentGradeFilter.value;
            const statusFilter = studentStatusFilter.value;
            const searchFilter = studentSearchFilter.value.toLowerCase();
            
            const filteredStudents = students.filter(student => {
                // Grade filter
                if (gradeFilter && student.grade !== gradeFilter) return false;
                
                // Status filter
                if (statusFilter && student.status !== statusFilter) return false;
                
                // Search filter
                if (searchFilter) {
                    const searchInName = student.fullName.toLowerCase().includes(searchFilter);
                    const searchInParent = student.parentName.toLowerCase().includes(searchFilter);
                    const searchInId = student.studentId.toLowerCase().includes(searchFilter);
                    
                    if (!searchInName && !searchInParent && !searchInId) return false;
                }
                
                return true;
            });
            
            renderStudents(filteredStudents);
            updateStudentCount(filteredStudents.length);
        }
        
        // Clear all filters
        function clearFilters() {
            studentGradeFilter.value = '';
            studentStatusFilter.value = '';
            studentSearchFilter.value = '';
            applyFilters();
        }
        
        // Open modal for adding/editing student
        function openModal(mode, studentId = null) {
            if (mode === 'add') {
                modalTitle.textContent = 'Add New Student';
                currentEditId = null;
                resetForm();
                
                // Set default dates
                const today = new Date();
                const fifteenYearsAgo = new Date();
                fifteenYearsAgo.setFullYear(today.getFullYear() - 15);
                
                studentDOBInput.valueAsDate = fifteenYearsAgo;
                studentEnrollmentDateInput.valueAsDate = today;
            } else if (mode === 'edit' && studentId) {
                modalTitle.textContent = 'Edit Student';
                currentEditId = studentId;
                populateForm(studentId);
            }
            
            studentModal.classList.add('active');
        }
        
        // Close modal
        function closeModalFunc() {
            studentModal.classList.remove('active');
            resetForm();
            currentEditId = null;
        }
        
        // Reset form
        function resetForm() {
            studentForm.reset();
            
            // Reset dates to defaults
            const today = new Date();
            const fifteenYearsAgo = new Date();
            fifteenYearsAgo.setFullYear(today.getFullYear() - 15);
            
            studentDOBInput.valueAsDate = fifteenYearsAgo;
            studentEnrollmentDateInput.valueAsDate = today;
        }
        
        // Populate form with student data
        function populateForm(studentId) {
            const student = students.find(s => s.id == studentId);
            if (!student) return;
            
            const nameParts = student.fullName.split(' ');
            const firstName = nameParts.length > 1 ? nameParts.slice(0, -1).join(' ') : nameParts[0];
            const lastName = nameParts.length > 1 ? nameParts[nameParts.length - 1] : '';
            
            studentFirstNameInput.value = firstName;
            studentLastNameInput.value = lastName;
            studentDOBInput.value = student.dob;
            studentGenderInput.value = student.gender;
            studentGradeModalInput.value = student.grade;
            studentEnrollmentDateInput.value = student.enrollmentDate;
            parentNameInput.value = student.parentName;
            parentEmailInput.value = student.parentEmail;
            parentPhoneInput.value = student.parentPhone;
            studentAddressInput.value = student.address || '';
            studentStatusModalInput.value = student.status;
            studentMedicalInput.value = student.medicalNotes || '';
            studentNotesInput.value = student.additionalNotes || '';
        }
        
        // Save student (add or update)
        function saveStudent() {
            // Validate form
            if (!studentForm.checkValidity()) {
                alert('Please fill in all required fields correctly.');
                return;
            }
            
            // Validate dates
            const dob = new Date(studentDOBInput.value);
            const enrollmentDate = new Date(studentEnrollmentDateInput.value);
            const today = new Date();
            
            if (dob >= today) {
                alert('Date of birth must be in the past.');
                return;
            }
            
            if (enrollmentDate > today) {
                alert('Enrollment date cannot be in the future.');
                return;
            }
            
            // Generate full name
            const fullName = `${studentFirstNameInput.value} ${studentLastNameInput.value}`;
            
            // Calculate age
            const age = calculateAge(studentDOBInput.value);
            
            if (currentEditId) {
                // Update existing student
                const index = students.findIndex(s => s.id == currentEditId);
                if (index !== -1) {
                    // Generate avatar if not already exists
                    let avatar = students[index].avatar;
                    if (!avatar) {
                        const gender = studentGenderInput.value === 'female' ? 'women' : 'men';
                        const randomId = Math.floor(Math.random() * 70) + 1;
                        avatar = `https://randomuser.me/api/portraits/${gender}/${randomId}.jpg`;
                    }
                    
                    students[index] = {
                        ...students[index],
                        firstName: studentFirstNameInput.value,
                        lastName: studentLastNameInput.value,
                        fullName: fullName,
                        dob: studentDOBInput.value,
                        age: age,
                        gender: studentGenderInput.value,
                        grade: studentGradeModalInput.value,
                        enrollmentDate: studentEnrollmentDateInput.value,
                        parentName: parentNameInput.value,
                        parentEmail: parentEmailInput.value,
                        parentPhone: parentPhoneInput.value,
                        address: studentAddressInput.value,
                        status: studentStatusModalInput.value,
                        medicalNotes: studentMedicalInput.value,
                        additionalNotes: studentNotesInput.value,
                        avatar: avatar
                    };
                }
                
                alert('Student updated successfully!');
            } else {
                // Add new student
                const gender = studentGenderInput.value === 'female' ? 'women' : 'men';
                const randomId = Math.floor(Math.random() * 70) + 1;
                const avatar = `https://randomuser.me/api/portraits/${gender}/${randomId}.jpg`;
                
                // Generate student ID
                const currentYear = new Date().getFullYear();
                const studentIdNum = students.filter(s => s.enrollmentDate.includes(currentYear.toString())).length + 1;
                const studentId = `STU-${currentYear}-${studentIdNum.toString().padStart(3, '0')}`;
                
                const newStudent = {
                    id: students.length > 0 ? Math.max(...students.map(s => s.id)) + 1 : 1,
                    firstName: studentFirstNameInput.value,
                    lastName: studentLastNameInput.value,
                    fullName: fullName,
                    dob: studentDOBInput.value,
                    age: age,
                    gender: studentGenderInput.value,
                    grade: studentGradeModalInput.value,
                    enrollmentDate: studentEnrollmentDateInput.value,
                    parentName: parentNameInput.value,
                    parentEmail: parentEmailInput.value,
                    parentPhone: parentPhoneInput.value,
                    address: studentAddressInput.value,
                    status: studentStatusModalInput.value,
                    medicalNotes: studentMedicalInput.value,
                    additionalNotes: studentNotesInput.value,
                    avatar: avatar,
                    studentId: studentId
                };
                
                students.unshift(newStudent);
                alert('Student added successfully!');
            }
            
            // Update display and close modal
            applyFilters();
            closeModalFunc();
        }
        
        // View student details
        function viewStudent(studentId) {
            const student = students.find(s => s.id == studentId);
            if (!student) return;
            
            currentDetailStudentId = studentId;
            
            // Format dates
            const dob = new Date(student.dob);
            const enrollmentDate = new Date(student.enrollmentDate);
            const formattedDOB = dob.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
            const formattedEnrollmentDate = enrollmentDate.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
            
            // Update header
            studentDetailHeader.innerHTML = `
                <div class="student-profile-avatar">
                    <img src="${student.avatar}" alt="${student.fullName}">
                </div>
                <div class="student-profile-info">
                    <h2>${student.fullName}</h2>
                    <p>Student ID: ${student.studentId}</p>
                    <p>Grade ${student.grade} | ${student.gender === 'male' ? 'Male' : 'Female'} | ${student.age} years old</p>
                    <div style="margin-top: 10px; display: flex; align-items: center; gap: 10px;">
                        <span style="background-color: rgba(255,255,255,0.2); padding: 3px 10px; border-radius: 12px; font-size: 0.9rem;">
                            ${student.status.charAt(0).toUpperCase() + student.status.slice(1)}
                        </span>
                    </div>
                </div>
            `;
            
            // Update personal information
            personalInfo.innerHTML = `
                <div class="detail-item">
                    <span class="detail-label">Full Name</span>
                    <span class="detail-value">${student.fullName}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Date of Birth</span>
                    <span class="detail-value">${formattedDOB}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Age</span>
                    <span class="detail-value">${student.age} years</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Gender</span>
                    <span class="detail-value">${student.gender === 'male' ? 'Male' : 'Female'}</span>
                </div>
            `;
            
            // Update academic information
            academicInfo.innerHTML = `
                <div class="detail-item">
                    <span class="detail-label">Grade Level</span>
                    <span class="detail-value">Grade ${student.grade}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Enrollment Date</span>
                    <span class="detail-value">${formattedEnrollmentDate}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Student Status</span>
                    <span class="detail-value">${student.status.charAt(0).toUpperCase() + student.status.slice(1)}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Student ID</span>
                    <span class="detail-value">${student.studentId}</span>
                </div>
            `;
            
            // Update parent information
            parentInfo.innerHTML = `
                <div class="detail-item">
                    <span class="detail-label">Parent/Guardian</span>
                    <span class="detail-value">${student.parentName}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Parent Email</span>
                    <span class="detail-value">${student.parentEmail}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Parent Phone</span>
                    <span class="detail-value">${student.parentPhone}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Address</span>
                    <span class="detail-value">${student.address || 'Not specified'}</span>
                </div>
            `;
            
            // Update additional information
            additionalInfo.innerHTML = `
                <div class="detail-item">
                    <span class="detail-label">Medical Notes</span>
                    <span class="detail-value">${student.medicalNotes || 'None'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Additional Notes</span>
                    <span class="detail-value">${student.additionalNotes || 'None'}</span>
                </div>
            `;
            
            // Show the modal
            studentDetailModal.classList.add('active');
        }
        
        // Delete student
        function deleteStudent(studentId) {
            if (!confirm('Are you sure you want to delete this student? This action cannot be undone.')) {
                return;
            }
            
            const studentName = students.find(s => s.id == studentId)?.fullName || 'Unknown Student';
            
            students = students.filter(s => s.id != studentId);
            applyFilters();
            
            alert(`Student "${studentName}" has been deleted.`);
        }
        
        // Update student count
        function updateStudentCount(count = students.length) {
            studentCount.textContent = count;
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