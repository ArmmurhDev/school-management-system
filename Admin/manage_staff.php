<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Staff - T&T School Management System</title>
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
        
        /* Staff Management Header */
        .staff-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .staff-header h2 {
            font-size: 1.8rem;
        }
        
        .staff-actions {
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
        
        .stat-icon.teachers {
            background-color: rgba(30, 136, 229, 0.1);
            color: var(--accent-blue);
        }
        
        .stat-icon.administrative {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }
        
        .stat-icon.support {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning);
        }
        
        .stat-icon.vacant {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger);
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
        
        /* Staff Table */
        .staff-table-container {
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
        
        .staff-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .staff-table thead {
            background-color: var(--light-bg);
        }
        
        .staff-table th {
            padding: 18px 20px;
            text-align: left;
            font-weight: 600;
            color: var(--primary-dark);
            border-bottom: 2px solid #eee;
            white-space: nowrap;
        }
        
        .staff-table td {
            padding: 20px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }
        
        .staff-table tbody tr {
            transition: all 0.3s;
        }
        
        .staff-table tbody tr:hover {
            background-color: #f9f9f9;
        }
        
        .staff-info {
            display: flex;
            align-items: center;
        }
        
        .staff-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 15px;
            border: 3px solid var(--light-bg);
        }
        
        .staff-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .staff-details h4 {
            font-size: 1rem;
            margin-bottom: 5px;
        }
        
        .staff-details p {
            font-size: 0.85rem;
            color: var(--text-light);
        }
        
        .department-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .department-teaching {
            background-color: rgba(30, 136, 229, 0.1);
            color: var(--accent-blue);
        }
        
        .department-administrative {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }
        
        .department-support {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning);
        }
        
        .department-management {
            background-color: rgba(103, 58, 183, 0.1);
            color: #673ab7;
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
        
        .status-dot.on-leave {
            background-color: var(--warning);
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
        
        /* Staff Grid View */
        .staff-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .staff-card {
            background-color: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px var(--shadow);
            transition: all 0.3s ease;
        }
        
        .staff-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 51, 102, 0.15);
        }
        
        .staff-card-header {
            background: linear-gradient(to right, var(--primary-dark), var(--primary-medium));
            padding: 25px;
            text-align: center;
            color: var(--white);
            position: relative;
        }
        
        .staff-card-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 15px;
            border: 5px solid rgba(255, 255, 255, 0.3);
        }
        
        .staff-card-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .staff-card-header h3 {
            color: var(--white);
            font-size: 1.3rem;
            margin-bottom: 5px;
        }
        
        .staff-card-header p {
            opacity: 0.9;
            font-size: 0.9rem;
        }
        
        .staff-card-body {
            padding: 25px;
        }
        
        .staff-card-details {
            margin-bottom: 20px;
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid #eee;
        }
        
        .detail-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .detail-label {
            font-weight: 600;
            color: var(--primary-dark);
            font-size: 0.9rem;
        }
        
        .detail-value {
            color: var(--text-light);
            font-size: 0.9rem;
            text-align: right;
        }
        
        .staff-card-footer {
            padding: 20px 25px;
            background-color: #f9f9f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #eee;
        }
        
        /* View Toggle */
        .view-toggle {
            display: flex;
            background-color: var(--light-bg);
            border-radius: 8px;
            padding: 5px;
            margin-bottom: 20px;
            width: fit-content;
        }
        
        .view-toggle-btn {
            padding: 10px 20px;
            border: none;
            background: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .view-toggle-btn.active {
            background-color: var(--white);
            color: var(--primary-medium);
            box-shadow: 0 3px 10px rgba(0, 51, 102, 0.1);
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
            .staff-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
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
        }
        
        @media (max-width: 768px) {
            .staff-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }
            
            .staff-actions {
                width: 100%;
                justify-content: space-between;
            }
            
            .top-header {
                padding: 20px;
            }
            
            .dashboard-content {
                padding: 20px;
            }
            
            .staff-grid {
                grid-template-columns: 1fr;
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
        }
        
        @media (max-width: 576px) {
            .staff-actions {
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
            
            .view-toggle {
                width: 100%;
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
                    <p>Staff Management</p>
                </div>
            </div>
            
            <div class="sidebar-menu">
                <a href="dashboard.html" class="menu-item">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
                
                <a href="manage-students.html" class="menu-item">
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
                
                <a href="manage-staff.html" class="menu-item active">
                    <i class="fas fa-user-tie"></i>
                    <span class="menu-text">Staff</span>
                </a>
                
                <a href="attendance.html" class="menu-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span class="menu-text">Attendance</span>
                </a>
                
                <a href="settings.html" class="menu-item">
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
                        <h1>Staff Management</h1>
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
                <!-- Staff Header -->
                <div class="staff-header">
                    <h2>All Staff Members</h2>
                    <div class="staff-actions">
                        <button class="btn btn-secondary" id="filterBtn">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <button class="btn btn-primary" id="addStaffBtn">
                            <i class="fas fa-user-plus"></i> Add New Staff
                        </button>
                    </div>
                </div>
                
                <!-- Stats Overview -->
                <div class="stats-overview">
                    <div class="stat-item">
                        <div class="stat-icon teachers">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="stat-info">
                            <h3>68</h3>
                            <p>Teaching Staff</p>
                        </div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-icon administrative">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="stat-info">
                            <h3>24</h3>
                            <p>Administrative</p>
                        </div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-icon support">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <div class="stat-info">
                            <h3>18</h3>
                            <p>Support Staff</p>
                        </div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-icon vacant">
                            <i class="fas fa-user-clock"></i>
                        </div>
                        <div class="stat-info">
                            <h3>5</h3>
                            <p>Vacant Positions</p>
                        </div>
                    </div>
                </div>
                
                <!-- View Toggle -->
                <div class="view-toggle" id="viewToggle">
                    <button class="view-toggle-btn active" data-view="table">
                        <i class="fas fa-table"></i> Table View
                    </button>
                    <button class="view-toggle-btn" data-view="grid">
                        <i class="fas fa-th-large"></i> Grid View
                    </button>
                </div>
                
                <!-- Filters Bar -->
                <div class="filters-bar" id="filtersBar">
                    <div class="filter-group">
                        <label for="staffDepartment">Department</label>
                        <select id="staffDepartment">
                            <option value="">All Departments</option>
                            <option value="teaching">Teaching</option>
                            <option value="administrative">Administrative</option>
                            <option value="support">Support</option>
                            <option value="management">Management</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="staffStatus">Status</label>
                        <select id="staffStatus">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="on-leave">On Leave</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="staffSearch">Search</label>
                        <input type="text" id="staffSearch" placeholder="Search by name or ID...">
                    </div>
                    
                    <div class="filter-group">
                        <button class="btn btn-secondary" id="clearFiltersBtn">
                            <i class="fas fa-times"></i> Clear Filters
                        </button>
                    </div>
                </div>
                
                <!-- Staff Table View -->
                <div class="staff-table-container" id="tableView">
                    <div class="table-header">
                        <h3>Staff Members</h3>
                        <div>
                            <span id="staffCount">92</span> staff members
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="staff-table" id="staffTable">
                            <thead>
                                <tr>
                                    <th>Staff Member</th>
                                    <th>Department</th>
                                    <th>Position</th>
                                    <th>Contact</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="staffTableBody">
                                <!-- Staff rows will be dynamically generated -->
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Staff Grid View -->
                <div class="staff-grid" id="gridView" style="display: none;">
                    <!-- Staff cards will be dynamically generated -->
                </div>
                
                <!-- Footer -->
                <div class="dashboard-footer">
                    <p>&copy; 2023 T&T School Management System. All rights reserved. | Staff Management Module v1.3</p>
                </div>
            </div>
        </div>
        
        <!-- Add/Edit Staff Modal -->
        <div class="modal" id="staffModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="modalTitle">Add New Staff Member</h3>
                    <button class="close-modal" id="closeModal">&times;</button>
                </div>
                
                <div class="modal-body">
                    <form id="staffForm">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="staffFirstName">First Name *</label>
                                <input type="text" id="staffFirstName" required placeholder="Enter first name">
                            </div>
                            
                            <div class="form-group">
                                <label for="staffLastName">Last Name *</label>
                                <input type="text" id="staffLastName" required placeholder="Enter last name">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="staffEmail">Email Address *</label>
                                <input type="email" id="staffEmail" required placeholder="Enter email address">
                            </div>
                            
                            <div class="form-group">
                                <label for="staffPhone">Phone Number *</label>
                                <input type="tel" id="staffPhone" required placeholder="Enter phone number">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="staffDepartmentModal">Department *</label>
                                <select id="staffDepartmentModal" required>
                                    <option value="">Select Department</option>
                                    <option value="teaching">Teaching</option>
                                    <option value="administrative">Administrative</option>
                                    <option value="support">Support</option>
                                    <option value="management">Management</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="staffPosition">Position *</label>
                                <input type="text" id="staffPosition" required placeholder="Enter position/title">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="staffHireDate">Hire Date *</label>
                                <input type="date" id="staffHireDate" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="staffSalary">Salary ($)</label>
                                <input type="number" id="staffSalary" placeholder="Enter salary">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="staffStatusModal">Status *</label>
                                <select id="staffStatusModal" required>
                                    <option value="">Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="on-leave">On Leave</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="staffType">Employment Type *</label>
                                <select id="staffType" required>
                                    <option value="">Select Type</option>
                                    <option value="full-time">Full-time</option>
                                    <option value="part-time">Part-time</option>
                                    <option value="contract">Contract</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="staffAddress">Address</label>
                            <textarea id="staffAddress" placeholder="Enter address"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="staffQualifications">Qualifications</label>
                            <textarea id="staffQualifications" placeholder="Enter qualifications"></textarea>
                        </div>
                    </form>
                </div>
                
                <div class="modal-footer">
                    <button class="btn btn-secondary" id="cancelModalBtn">Cancel</button>
                    <button class="btn btn-primary" id="saveStaffBtn">Save Staff Member</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sample staff data
        const sampleStaff = [
            {
                id: 1,
                firstName: "Robert",
                lastName: "Smith",
                fullName: "Dr. Robert Smith",
                email: "r.smith@ttschool.edu",
                phone: "+1 (555) 123-4567",
                department: "teaching",
                position: "Mathematics Teacher",
                hireDate: "2018-03-15",
                salary: 65000,
                status: "active",
                type: "full-time",
                address: "123 Education Ave, Knowledge City",
                qualifications: "Ph.D. in Mathematics, 10+ years teaching experience",
                avatar: "https://randomuser.me/api/portraits/men/45.jpg"
            },
            {
                id: 2,
                firstName: "Emily",
                lastName: "Johnson",
                fullName: "Ms. Emily Johnson",
                email: "e.johnson@ttschool.edu",
                phone: "+1 (555) 234-5678",
                department: "teaching",
                position: "Physics Teacher",
                hireDate: "2020-08-22",
                salary: 58000,
                status: "active",
                type: "full-time",
                address: "456 Science Street, Knowledge City",
                qualifications: "M.Sc. in Physics, 5 years teaching experience",
                avatar: "https://randomuser.me/api/portraits/women/65.jpg"
            },
            {
                id: 3,
                firstName: "David",
                lastName: "Chen",
                fullName: "Mr. David Chen",
                email: "d.chen@ttschool.edu",
                phone: "+1 (555) 345-6789",
                department: "administrative",
                position: "Registrar",
                hireDate: "2019-05-10",
                salary: 52000,
                status: "active",
                type: "full-time",
                address: "789 Admin Road, Knowledge City",
                qualifications: "B.A. in Business Administration, 8 years admin experience",
                avatar: "https://randomuser.me/api/portraits/men/32.jpg"
            },
            {
                id: 4,
                firstName: "Sarah",
                lastName: "Williams",
                fullName: "Dr. Sarah Williams",
                email: "s.williams@ttschool.edu",
                phone: "+1 (555) 456-7890",
                department: "management",
                position: "Academic Director",
                hireDate: "2015-01-05",
                salary: 85000,
                status: "active",
                type: "full-time",
                address: "321 Leadership Blvd, Knowledge City",
                qualifications: "Ph.D. in Education, 15+ years in educational leadership",
                avatar: "https://randomuser.me/api/portraits/women/32.jpg"
            },
            {
                id: 5,
                firstName: "Michael",
                lastName: "Brown",
                fullName: "Mr. Michael Brown",
                email: "m.brown@ttschool.edu",
                phone: "+1 (555) 567-8901",
                department: "support",
                position: "IT Support Specialist",
                hireDate: "2021-02-18",
                salary: 48000,
                status: "active",
                type: "full-time",
                address: "654 Tech Street, Knowledge City",
                qualifications: "B.Sc. in Computer Science, 3 years IT experience",
                avatar: "https://randomuser.me/api/portraits/men/22.jpg"
            },
            {
                id: 6,
                firstName: "Jennifer",
                lastName: "Davis",
                fullName: "Ms. Jennifer Davis",
                email: "j.davis@ttschool.edu",
                phone: "+1 (555) 678-9012",
                department: "teaching",
                position: "English Teacher",
                hireDate: "2017-09-10",
                salary: 62000,
                status: "on-leave",
                type: "full-time",
                address: "987 Literature Lane, Knowledge City",
                qualifications: "M.A. in English Literature, 8 years teaching experience",
                avatar: "https://randomuser.me/api/portraits/women/45.jpg"
            },
            {
                id: 7,
                firstName: "James",
                lastName: "Wilson",
                fullName: "Mr. James Wilson",
                email: "j.wilson@ttschool.edu",
                phone: "+1 (555) 789-0123",
                department: "administrative",
                position: "Finance Officer",
                hireDate: "2016-11-30",
                salary: 55000,
                status: "active",
                type: "full-time",
                address: "147 Finance Ave, Knowledge City",
                qualifications: "B.Com in Accounting, 10 years finance experience",
                avatar: "https://randomuser.me/api/portraits/men/55.jpg"
            },
            {
                id: 8,
                firstName: "Patricia",
                lastName: "Miller",
                fullName: "Ms. Patricia Miller",
                email: "p.miller@ttschool.edu",
                phone: "+1 (555) 890-1234",
                department: "support",
                position: "Librarian",
                hireDate: "2022-04-12",
                salary: 45000,
                status: "active",
                type: "part-time",
                address: "258 Library Road, Knowledge City",
                qualifications: "M.L.I.S., 2 years library experience",
                avatar: "https://randomuser.me/api/portraits/women/68.jpg"
            }
        ];
        
        // DOM Elements
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const menuToggle = document.getElementById('menuToggle');
        const staffTableBody = document.getElementById('staffTableBody');
        const staffGrid = document.getElementById('gridView');
        const addStaffBtn = document.getElementById('addStaffBtn');
        const filterBtn = document.getElementById('filterBtn');
        const filtersBar = document.getElementById('filtersBar');
        const clearFiltersBtn = document.getElementById('clearFiltersBtn');
        const staffModal = document.getElementById('staffModal');
        const modalTitle = document.getElementById('modalTitle');
        const staffForm = document.getElementById('staffForm');
        const closeModal = document.getElementById('closeModal');
        const cancelModalBtn = document.getElementById('cancelModalBtn');
        const saveStaffBtn = document.getElementById('saveStaffBtn');
        const staffCount = document.getElementById('staffCount');
        
        // Filter elements
        const staffDepartmentFilter = document.getElementById('staffDepartment');
        const staffStatusFilter = document.getElementById('staffStatus');
        const staffSearchFilter = document.getElementById('staffSearch');
        
        // View toggle elements
        const viewToggle = document.getElementById('viewToggle');
        const tableView = document.getElementById('tableView');
        const gridView = document.getElementById('gridView');
        
        // Form elements
        const staffFirstNameInput = document.getElementById('staffFirstName');
        const staffLastNameInput = document.getElementById('staffLastName');
        const staffEmailInput = document.getElementById('staffEmail');
        const staffPhoneInput = document.getElementById('staffPhone');
        const staffDepartmentModalInput = document.getElementById('staffDepartmentModal');
        const staffPositionInput = document.getElementById('staffPosition');
        const staffHireDateInput = document.getElementById('staffHireDate');
        const staffSalaryInput = document.getElementById('staffSalary');
        const staffStatusModalInput = document.getElementById('staffStatusModal');
        const staffTypeInput = document.getElementById('staffType');
        const staffAddressInput = document.getElementById('staffAddress');
        const staffQualificationsInput = document.getElementById('staffQualifications');
        
        // State variables
        let staff = [...sampleStaff];
        let currentEditId = null;
        let filtersVisible = true;
        let currentView = 'table';
        
        // Set default hire date for the form
        staffHireDateInput.valueAsDate = new Date();
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            renderStaff();
            setupEventListeners();
            updateStaffCount();
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
            addStaffBtn.addEventListener('click', () => openModal('add'));
            
            closeModal.addEventListener('click', closeModalFunc);
            cancelModalBtn.addEventListener('click', closeModalFunc);
            
            // Save staff
            saveStaffBtn.addEventListener('click', saveStaff);
            
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
            staffDepartmentFilter.addEventListener('change', applyFilters);
            staffStatusFilter.addEventListener('change', applyFilters);
            staffSearchFilter.addEventListener('input', applyFilters);
            
            // View toggle events
            viewToggle.addEventListener('click', function(e) {
                if (e.target.classList.contains('view-toggle-btn')) {
                    const view = e.target.dataset.view;
                    switchView(view);
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
        
        // Render staff to table and grid
        function renderStaff(filteredStaff = staff) {
            renderStaffTable(filteredStaff);
            renderStaffGrid(filteredStaff);
            updateStaffCount(filteredStaff.length);
        }
        
        // Render staff table
        function renderStaffTable(filteredStaff) {
            staffTableBody.innerHTML = '';
            
            if (filteredStaff.length === 0) {
                const emptyRow = document.createElement('tr');
                emptyRow.innerHTML = `
                    <td colspan="6" style="text-align: center; padding: 40px; color: var(--text-light);">
                        <i class="fas fa-user-slash" style="font-size: 2rem; margin-bottom: 15px; display: block;"></i>
                        <h4>No staff members found</h4>
                        <p>Try adjusting your filters or add a new staff member</p>
                    </td>
                `;
                staffTableBody.appendChild(emptyRow);
                return;
            }
            
            filteredStaff.forEach(member => {
                const row = createStaffTableRow(member);
                staffTableBody.appendChild(row);
            });
        }
        
        // Create a staff table row
        function createStaffTableRow(member) {
            const row = document.createElement('tr');
            row.dataset.id = member.id;
            
            // Get department badge class
            let departmentClass = '';
            let departmentText = '';
            switch(member.department) {
                case 'teaching':
                    departmentClass = 'department-teaching';
                    departmentText = 'Teaching';
                    break;
                case 'administrative':
                    departmentClass = 'department-administrative';
                    departmentText = 'Administrative';
                    break;
                case 'support':
                    departmentClass = 'department-support';
                    departmentText = 'Support';
                    break;
                case 'management':
                    departmentClass = 'department-management';
                    departmentText = 'Management';
                    break;
            }
            
            // Get status dot class
            let statusDotClass = '';
            let statusText = '';
            switch(member.status) {
                case 'active':
                    statusDotClass = 'active';
                    statusText = 'Active';
                    break;
                case 'inactive':
                    statusDotClass = 'inactive';
                    statusText = 'Inactive';
                    break;
                case 'on-leave':
                    statusDotClass = 'on-leave';
                    statusText = 'On Leave';
                    break;
            }
            
            row.innerHTML = `
                <td>
                    <div class="staff-info">
                        <div class="staff-avatar">
                            <img src="${member.avatar}" alt="${member.fullName}">
                        </div>
                        <div class="staff-details">
                            <h4>${member.fullName}</h4>
                            <p>ID: STF-${member.id.toString().padStart(3, '0')}</p>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="department-badge ${departmentClass}">${departmentText}</span>
                </td>
                <td>${member.position}</td>
                <td>
                    <div>${member.email}</div>
                    <small>${member.phone}</small>
                </td>
                <td>
                    <div class="status-indicator">
                        <span class="status-dot ${statusDotClass}"></span>
                        <span>${statusText}</span>
                    </div>
                </td>
                <td>
                    <div class="action-buttons">
                        <button class="action-btn view" data-id="${member.id}">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="action-btn edit" data-id="${member.id}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="action-btn delete" data-id="${member.id}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            `;
            
            // Add event listeners to action buttons
            const viewBtn = row.querySelector('.action-btn.view');
            const editBtn = row.querySelector('.action-btn.edit');
            const deleteBtn = row.querySelector('.action-btn.delete');
            
            viewBtn.addEventListener('click', () => viewStaff(member.id));
            editBtn.addEventListener('click', () => openModal('edit', member.id));
            deleteBtn.addEventListener('click', () => deleteStaff(member.id));
            
            return row;
        }
        
        // Render staff grid
        function renderStaffGrid(filteredStaff) {
            staffGrid.innerHTML = '';
            
            if (filteredStaff.length === 0) {
                const emptyState = document.createElement('div');
                emptyState.className = 'empty-state';
                emptyState.style.textAlign = 'center';
                emptyState.style.padding = '40px';
                emptyState.style.gridColumn = '1 / -1';
                emptyState.innerHTML = `
                    <i class="fas fa-user-slash" style="font-size: 3rem; color: var(--primary-light); margin-bottom: 20px;"></i>
                    <h3>No staff members found</h3>
                    <p>Try adjusting your filters or add a new staff member</p>
                `;
                staffGrid.appendChild(emptyState);
                return;
            }
            
            filteredStaff.forEach(member => {
                const card = createStaffCard(member);
                staffGrid.appendChild(card);
            });
        }
        
        // Create a staff card
        function createStaffCard(member) {
            const card = document.createElement('div');
            card.className = 'staff-card';
            card.dataset.id = member.id;
            
            // Get department text
            let departmentText = '';
            switch(member.department) {
                case 'teaching':
                    departmentText = 'Teaching';
                    break;
                case 'administrative':
                    departmentText = 'Administrative';
                    break;
                case 'support':
                    departmentText = 'Support';
                    break;
                case 'management':
                    departmentText = 'Management';
                    break;
            }
            
            // Get status text and color
            let statusText = '';
            let statusColor = '';
            switch(member.status) {
                case 'active':
                    statusText = 'Active';
                    statusColor = 'var(--success)';
                    break;
                case 'inactive':
                    statusText = 'Inactive';
                    statusColor = 'var(--danger)';
                    break;
                case 'on-leave':
                    statusText = 'On Leave';
                    statusColor = 'var(--warning)';
                    break;
            }
            
            // Format hire date
            const hireDate = new Date(member.hireDate);
            const formattedHireDate = hireDate.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
            
            card.innerHTML = `
                <div class="staff-card-header">
                    <div class="staff-card-avatar">
                        <img src="${member.avatar}" alt="${member.fullName}">
                    </div>
                    <h3>${member.fullName}</h3>
                    <p>${member.position}</p>
                    <div style="margin-top: 10px; display: flex; align-items: center; justify-content: center; gap: 10px;">
                        <span style="background-color: rgba(255,255,255,0.2); padding: 3px 10px; border-radius: 12px; font-size: 0.8rem;">${departmentText}</span>
                        <span style="display: flex; align-items: center; gap: 5px;">
                            <span style="width: 8px; height: 8px; border-radius: 50%; background-color: ${statusColor};"></span>
                            <span style="font-size: 0.8rem;">${statusText}</span>
                        </span>
                    </div>
                </div>
                
                <div class="staff-card-body">
                    <div class="staff-card-details">
                        <div class="detail-row">
                            <span class="detail-label">Email</span>
                            <span class="detail-value">${member.email}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Phone</span>
                            <span class="detail-value">${member.phone}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Hire Date</span>
                            <span class="detail-value">${formattedHireDate}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Employment</span>
                            <span class="detail-value">${member.type.charAt(0).toUpperCase() + member.type.slice(1)}</span>
                        </div>
                    </div>
                </div>
                
                <div class="staff-card-footer">
                    <div>ID: STF-${member.id.toString().padStart(3, '0')}</div>
                    <div class="action-buttons">
                        <button class="action-btn view" data-id="${member.id}">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="action-btn edit" data-id="${member.id}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="action-btn delete" data-id="${member.id}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;
            
            // Add event listeners to action buttons
            const viewBtn = card.querySelector('.action-btn.view');
            const editBtn = card.querySelector('.action-btn.edit');
            const deleteBtn = card.querySelector('.action-btn.delete');
            
            viewBtn.addEventListener('click', () => viewStaff(member.id));
            editBtn.addEventListener('click', () => openModal('edit', member.id));
            deleteBtn.addEventListener('click', () => deleteStaff(member.id));
            
            return card;
        }
        
        // Apply filters to staff
        function applyFilters() {
            const departmentFilter = staffDepartmentFilter.value;
            const statusFilter = staffStatusFilter.value;
            const searchFilter = staffSearchFilter.value.toLowerCase();
            
            const filteredStaff = staff.filter(member => {
                // Department filter
                if (departmentFilter && member.department !== departmentFilter) return false;
                
                // Status filter
                if (statusFilter && member.status !== statusFilter) return false;
                
                // Search filter
                if (searchFilter) {
                    const searchInName = member.fullName.toLowerCase().includes(searchFilter);
                    const searchInPosition = member.position.toLowerCase().includes(searchFilter);
                    const searchInEmail = member.email.toLowerCase().includes(searchFilter);
                    
                    if (!searchInName && !searchInPosition && !searchInEmail) return false;
                }
                
                return true;
            });
            
            renderStaff(filteredStaff);
        }
        
        // Clear all filters
        function clearFilters() {
            staffDepartmentFilter.value = '';
            staffStatusFilter.value = '';
            staffSearchFilter.value = '';
            applyFilters();
        }
        
        // Switch between table and grid view
        function switchView(view) {
            currentView = view;
            
            // Update active button
            document.querySelectorAll('.view-toggle-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            document.querySelector(`[data-view="${view}"]`).classList.add('active');
            
            // Show/hide views
            if (view === 'table') {
                tableView.style.display = 'block';
                gridView.style.display = 'none';
            } else {
                tableView.style.display = 'none';
                gridView.style.display = 'grid';
            }
        }
        
        // Open modal for adding/editing staff
        function openModal(mode, staffId = null) {
            if (mode === 'add') {
                modalTitle.textContent = 'Add New Staff Member';
                currentEditId = null;
                resetForm();
                
                // Set default hire date to today
                staffHireDateInput.valueAsDate = new Date();
            } else if (mode === 'edit' && staffId) {
                modalTitle.textContent = 'Edit Staff Member';
                currentEditId = staffId;
                populateForm(staffId);
            }
            
            staffModal.classList.add('active');
        }
        
        // Close modal
        function closeModalFunc() {
            staffModal.classList.remove('active');
            resetForm();
            currentEditId = null;
        }
        
        // Reset form
        function resetForm() {
            staffForm.reset();
            staffHireDateInput.valueAsDate = new Date();
        }
        
        // Populate form with staff data
        function populateForm(staffId) {
            const member = staff.find(s => s.id == staffId);
            if (!member) return;
            
            const nameParts = member.fullName.split(' ');
            const firstName = nameParts.length > 1 ? nameParts.slice(0, -1).join(' ') : nameParts[0];
            const lastName = nameParts.length > 1 ? nameParts[nameParts.length - 1] : '';
            
            staffFirstNameInput.value = firstName;
            staffLastNameInput.value = lastName;
            staffEmailInput.value = member.email;
            staffPhoneInput.value = member.phone;
            staffDepartmentModalInput.value = member.department;
            staffPositionInput.value = member.position;
            staffHireDateInput.value = member.hireDate;
            staffSalaryInput.value = member.salary;
            staffStatusModalInput.value = member.status;
            staffTypeInput.value = member.type;
            staffAddressInput.value = member.address || '';
            staffQualificationsInput.value = member.qualifications || '';
        }
        
        // Save staff (add or update)
        function saveStaff() {
            // Validate form
            if (!staffForm.checkValidity()) {
                alert('Please fill in all required fields correctly.');
                return;
            }
            
            // Generate full name
            const fullName = `${staffFirstNameInput.value} ${staffLastNameInput.value}`;
            
            if (currentEditId) {
                // Update existing staff
                const index = staff.findIndex(s => s.id == currentEditId);
                if (index !== -1) {
                    // Generate avatar if not already exists
                    let avatar = staff[index].avatar;
                    if (!avatar) {
                        const gender = Math.random() > 0.5 ? 'men' : 'women';
                        const randomId = Math.floor(Math.random() * 70) + 1;
                        avatar = `https://randomuser.me/api/portraits/${gender}/${randomId}.jpg`;
                    }
                    
                    staff[index] = {
                        ...staff[index],
                        firstName: staffFirstNameInput.value,
                        lastName: staffLastNameInput.value,
                        fullName: fullName,
                        email: staffEmailInput.value,
                        phone: staffPhoneInput.value,
                        department: staffDepartmentModalInput.value,
                        position: staffPositionInput.value,
                        hireDate: staffHireDateInput.value,
                        salary: parseFloat(staffSalaryInput.value) || 0,
                        status: staffStatusModalInput.value,
                        type: staffTypeInput.value,
                        address: staffAddressInput.value,
                        qualifications: staffQualificationsInput.value,
                        avatar: avatar
                    };
                }
                
                alert('Staff member updated successfully!');
            } else {
                // Add new staff
                const gender = Math.random() > 0.5 ? 'men' : 'women';
                const randomId = Math.floor(Math.random() * 70) + 1;
                const avatar = `https://randomuser.me/api/portraits/${gender}/${randomId}.jpg`;
                
                const newStaff = {
                    id: staff.length > 0 ? Math.max(...staff.map(s => s.id)) + 1 : 1,
                    firstName: staffFirstNameInput.value,
                    lastName: staffLastNameInput.value,
                    fullName: fullName,
                    email: staffEmailInput.value,
                    phone: staffPhoneInput.value,
                    department: staffDepartmentModalInput.value,
                    position: staffPositionInput.value,
                    hireDate: staffHireDateInput.value,
                    salary: parseFloat(staffSalaryInput.value) || 0,
                    status: staffStatusModalInput.value,
                    type: staffTypeInput.value,
                    address: staffAddressInput.value,
                    qualifications: staffQualificationsInput.value,
                    avatar: avatar
                };
                
                staff.unshift(newStaff);
                alert('Staff member added successfully!');
            }
            
            // Update display and close modal
            applyFilters();
            closeModalFunc();
        }
        
        // View staff details
        function viewStaff(staffId) {
            const member = staff.find(s => s.id == staffId);
            if (!member) return;
            
            const hireDate = new Date(member.hireDate);
            const formattedHireDate = hireDate.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
            
            const details = `
                Staff ID: STF-${member.id.toString().padStart(3, '0')}
                Name: ${member.fullName}
                Position: ${member.position}
                Department: ${getDepartmentText(member.department)}
                Email: ${member.email}
                Phone: ${member.phone}
                Hire Date: ${formattedHireDate}
                Status: ${member.status.charAt(0).toUpperCase() + member.status.slice(1)}
                Employment Type: ${member.type.charAt(0).toUpperCase() + member.type.slice(1)}
                ${member.salary ? `Salary: $${member.salary.toLocaleString()}` : ''}
                ${member.address ? `Address: ${member.address}` : ''}
                ${member.qualifications ? `Qualifications: ${member.qualifications}` : ''}
            `;
            
            alert(details);
        }
        
        // Delete staff
        function deleteStaff(staffId) {
            if (!confirm('Are you sure you want to delete this staff member? This action cannot be undone.')) {
                return;
            }
            
            const staffName = staff.find(s => s.id == staffId)?.fullName || 'Unknown Staff';
            
            staff = staff.filter(s => s.id != staffId);
            applyFilters();
            
            alert(`Staff member "${staffName}" has been deleted.`);
        }
        
        // Get department display text
        function getDepartmentText(department) {
            switch(department) {
                case 'teaching': return 'Teaching';
                case 'administrative': return 'Administrative';
                case 'support': return 'Support';
                case 'management': return 'Management';
                default: return 'Unknown';
            }
        }
        
        // Update staff count
        function updateStaffCount(count = staff.length) {
            staffCount.textContent = count;
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