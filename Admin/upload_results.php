<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Student Results - T&T School Management System</title>
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
        
        /* Results Upload Header */
        .upload-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .upload-header h2 {
            font-size: 1.8rem;
        }
        
        .upload-actions {
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
        
        /* Upload Steps */
        .upload-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
            position: relative;
        }
        
        .upload-steps::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 3px;
            background-color: #e0e0e0;
            z-index: 1;
        }
        
        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
            width: 25%;
        }
        
        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e0e0e0;
            color: var(--text-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-bottom: 10px;
            border: 3px solid var(--white);
            transition: all 0.3s;
        }
        
        .step.active .step-circle {
            background-color: var(--primary-medium);
            color: var(--white);
        }
        
        .step.completed .step-circle {
            background-color: var(--success);
            color: var(--white);
        }
        
        .step.completed .step-circle i {
            font-size: 1.2rem;
        }
        
        .step-text {
            font-size: 0.9rem;
            color: var(--text-light);
            text-align: center;
        }
        
        .step.active .step-text {
            color: var(--primary-dark);
            font-weight: 600;
        }
        
        /* Upload Container */
        .upload-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }
        
        @media (max-width: 992px) {
            .upload-container {
                grid-template-columns: 1fr;
            }
        }
        
        /* Upload Form */
        .upload-form-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 15px var(--shadow);
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
        
        .form-group {
            margin-bottom: 25px;
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
        
        /* File Upload Area */
        .file-upload-area {
            border: 2px dashed var(--primary-light);
            border-radius: 10px;
            padding: 40px 20px;
            text-align: center;
            background-color: var(--light-bg);
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 20px;
        }
        
        .file-upload-area:hover {
            border-color: var(--primary-medium);
            background-color: #e8f4ff;
        }
        
        .file-upload-area.dragover {
            border-color: var(--success);
            background-color: rgba(40, 167, 69, 0.05);
        }
        
        .upload-icon {
            font-size: 3rem;
            color: var(--primary-light);
            margin-bottom: 15px;
        }
        
        .file-upload-area h4 {
            margin-bottom: 10px;
            color: var(--primary-dark);
        }
        
        .file-upload-area p {
            color: var(--text-light);
            margin-bottom: 20px;
        }
        
        .file-input {
            display: none;
        }
        
        .file-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: var(--white);
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
            border: 1px solid #eee;
        }
        
        .file-details {
            display: flex;
            align-items: center;
        }
        
        .file-icon {
            width: 40px;
            height: 40px;
            background-color: var(--light-bg);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: var(--primary-medium);
        }
        
        .file-name {
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .file-size {
            font-size: 0.85rem;
            color: var(--text-light);
        }
        
        .remove-file {
            background: none;
            border: none;
            color: var(--danger);
            cursor: pointer;
            font-size: 1.2rem;
        }
        
        /* Instructions Panel */
        .instructions-panel {
            background-color: var(--white);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 15px var(--shadow);
        }
        
        .instructions-list {
            list-style: none;
            margin-top: 20px;
        }
        
        .instructions-list li {
            padding: 15px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: flex-start;
        }
        
        .instructions-list li:last-child {
            border-bottom: none;
        }
        
        .instruction-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: var(--light-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
            color: var(--primary-medium);
        }
        
        .instruction-text h5 {
            font-size: 1rem;
            margin-bottom: 5px;
        }
        
        .instruction-text p {
            color: var(--text-light);
            font-size: 0.9rem;
        }
        
        .template-download {
            background-color: var(--light-bg);
            border-radius: 10px;
            padding: 20px;
            margin-top: 30px;
            text-align: center;
        }
        
        .template-download h4 {
            margin-bottom: 10px;
            color: var(--primary-dark);
        }
        
        .template-download p {
            color: var(--text-light);
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
        
        /* Preview Table */
        .preview-container {
            background-color: var(--white);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 15px var(--shadow);
            margin-bottom: 40px;
            display: none;
        }
        
        .preview-container.active {
            display: block;
        }
        
        .preview-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .preview-table-container {
            overflow-x: auto;
        }
        
        .preview-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .preview-table thead {
            background-color: var(--light-bg);
        }
        
        .preview-table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: var(--primary-dark);
            border-bottom: 2px solid #eee;
            white-space: nowrap;
        }
        
        .preview-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }
        
        .preview-table tbody tr:hover {
            background-color: #f9f9f9;
        }
        
        .grade-cell {
            font-weight: 600;
        }
        
        .grade-a {
            color: var(--success);
        }
        
        .grade-b {
            color: #17a2b8;
        }
        
        .grade-c {
            color: var(--warning);
        }
        
        .grade-d {
            color: #fd7e14;
        }
        
        .grade-f {
            color: var(--danger);
        }
        
        /* Validation Results */
        .validation-results {
            background-color: var(--white);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 15px var(--shadow);
            margin-bottom: 40px;
            display: none;
        }
        
        .validation-results.active {
            display: block;
        }
        
        .validation-header {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .validation-header i {
            font-size: 1.5rem;
            margin-right: 15px;
        }
        
        .validation-success .validation-header i {
            color: var(--success);
        }
        
        .validation-warning .validation-header i {
            color: var(--warning);
        }
        
        .validation-error .validation-header i {
            color: var(--danger);
        }
        
        .validation-items {
            margin-bottom: 25px;
        }
        
        .validation-item {
            display: flex;
            align-items: flex-start;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
        }
        
        .validation-item.success {
            border-left: 4px solid var(--success);
        }
        
        .validation-item.warning {
            border-left: 4px solid var(--warning);
        }
        
        .validation-item.error {
            border-left: 4px solid var(--danger);
        }
        
        .validation-icon {
            margin-right: 15px;
            font-size: 1.2rem;
        }
        
        .validation-item.success .validation-icon {
            color: var(--success);
        }
        
        .validation-item.warning .validation-icon {
            color: var(--warning);
        }
        
        .validation-item.error .validation-icon {
            color: var(--danger);
        }
        
        .validation-text h5 {
            font-size: 1rem;
            margin-bottom: 5px;
        }
        
        .validation-text p {
            color: var(--text-light);
            font-size: 0.9rem;
        }
        
        /* Upload Progress */
        .upload-progress {
            background-color: var(--white);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 15px var(--shadow);
            margin-bottom: 40px;
            display: none;
        }
        
        .upload-progress.active {
            display: block;
        }
        
        .progress-container {
            margin: 30px 0;
        }
        
        .progress-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .progress-bar {
            height: 10px;
            background-color: #e0e0e0;
            border-radius: 5px;
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(to right, var(--primary-light), var(--primary-medium));
            width: 0%;
            transition: width 0.5s ease;
        }
        
        .progress-status {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }
        
        .progress-status i {
            font-size: 2rem;
            margin-right: 15px;
        }
        
        .progress-success .progress-status i {
            color: var(--success);
        }
        
        .progress-error .progress-status i {
            color: var(--danger);
        }
        
        /* Recent Uploads */
        .recent-uploads {
            background-color: var(--white);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 15px var(--shadow);
        }
        
        .uploads-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .uploads-table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: var(--primary-dark);
            border-bottom: 2px solid #eee;
        }
        
        .uploads-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .upload-status {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .status-completed {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }
        
        .status-pending {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning);
        }
        
        .status-failed {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger);
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
            
            .upload-steps {
                flex-wrap: wrap;
                justify-content: center;
                gap: 20px;
            }
            
            .step {
                width: 45%;
            }
        }
        
        @media (max-width: 768px) {
            .upload-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }
            
            .upload-actions {
                width: 100%;
                justify-content: space-between;
            }
            
            .top-header {
                padding: 20px;
            }
            
            .dashboard-content {
                padding: 20px;
            }
            
            .step {
                width: 100%;
            }
            
            .upload-steps::before {
                display: none;
            }
        }
        
        @media (max-width: 576px) {
            .upload-actions {
                flex-direction: column;
                gap: 10px;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
            
            .preview-table th,
            .preview-table td {
                padding: 10px 5px;
                font-size: 0.85rem;
            }
            
            .validation-item {
                flex-direction: column;
            }
            
            .validation-icon {
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
                    <p>Results Management</p>
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
                
                <a href="manage-courses.html" class="menu-item">
                    <i class="fas fa-book"></i>
                    <span class="menu-text">Courses</span>
                </a>
                
                <a href="upload-results.html" class="menu-item active">
                    <i class="fas fa-file-upload"></i>
                    <span class="menu-text">Upload Results</span>
                </a>
                
                <a href="view-results.html" class="menu-item">
                    <i class="fas fa-chart-bar"></i>
                    <span class="menu-text">View Results</span>
                </a>
                
                <a href="reports.html" class="menu-item">
                    <i class="fas fa-file-alt"></i>
                    <span class="menu-text">Reports</span>
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
                        <h1>Upload Student Results</h1>
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
                <!-- Upload Steps -->
                <div class="upload-steps">
                    <div class="step active" id="step1">
                        <div class="step-circle">1</div>
                        <div class="step-text">Select Exam & Upload</div>
                    </div>
                    
                    <div class="step" id="step2">
                        <div class="step-circle">2</div>
                        <div class="step-text">Preview Data</div>
                    </div>
                    
                    <div class="step" id="step3">
                        <div class="step-circle">3</div>
                        <div class="step-text">Validate</div>
                    </div>
                    
                    <div class="step" id="step4">
                        <div class="step-circle">4</div>
                        <div class="step-text">Confirm & Save</div>
                    </div>
                </div>
                
                <!-- Upload Container -->
                <div class="upload-container">
                    <!-- Upload Form -->
                    <div class="upload-form-card">
                        <div class="card-header">
                            <i class="fas fa-file-upload"></i>
                            <h3>Upload Results File</h3>
                        </div>
                        
                        <form id="uploadForm">
                            <div class="form-group">
                                <label for="academicYear">Academic Year *</label>
                                <select id="academicYear" required>
                                    <option value="">Select Academic Year</option>
                                    <option value="2023-2024">2023-2024</option>
                                    <option value="2022-2023">2022-2023</option>
                                    <option value="2021-2022">2021-2022</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="term">Term/Semester *</label>
                                <select id="term" required>
                                    <option value="">Select Term</option>
                                    <option value="1">Term 1</option>
                                    <option value="2">Term 2</option>
                                    <option value="3">Term 3</option>
                                    <option value="sem1">Semester 1</option>
                                    <option value="sem2">Semester 2</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="gradeLevel">Grade Level *</label>
                                <select id="gradeLevel" required>
                                    <option value="">Select Grade</option>
                                    <option value="9">Grade 9</option>
                                    <option value="10">Grade 10</option>
                                    <option value="11">Grade 11</option>
                                    <option value="12">Grade 12</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="section">Section *</label>
                                <select id="section" required>
                                    <option value="">Select Section</option>
                                    <option value="A">Section A</option>
                                    <option value="B">Section B</option>
                                    <option value="C">Section C</option>
                                    <option value="D">Section D</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="examType">Exam Type *</label>
                                <select id="examType" required>
                                    <option value="">Select Exam Type</option>
                                    <option value="midterm">Midterm Exam</option>
                                    <option value="final">Final Exam</option>
                                    <option value="quiz">Quiz</option>
                                    <option value="assignment">Assignment</option>
                                    <option value="project">Project</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="subject">Subject *</label>
                                <select id="subject" required>
                                    <option value="">Select Subject</option>
                                    <option value="math">Mathematics</option>
                                    <option value="physics">Physics</option>
                                    <option value="chemistry">Chemistry</option>
                                    <option value="biology">Biology</option>
                                    <option value="english">English</option>
                                    <option value="history">History</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="remarks">Remarks/Notes</label>
                                <textarea id="remarks" placeholder="Add any notes about this results upload..."></textarea>
                            </div>
                        </form>
                    </div>
                    
                    <!-- File Upload Area -->
                    <div class="upload-form-card">
                        <div class="card-header">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <h3>Upload File</h3>
                        </div>
                        
                        <div class="file-upload-area" id="fileDropArea">
                            <div class="upload-icon">
                                <i class="fas fa-file-excel"></i>
                            </div>
                            <h4>Drag & Drop Your File Here</h4>
                            <p>Supported formats: CSV, Excel (.xlsx, .xls)</p>
                            <p>Max file size: 10MB</p>
                            <button class="btn btn-secondary" id="browseBtn">
                                <i class="fas fa-folder-open"></i> Browse Files
                            </button>
                            <input type="file" id="fileInput" class="file-input" accept=".csv,.xlsx,.xls">
                        </div>
                        
                        <div id="fileInfo" style="display: none;">
                            <div class="file-info">
                                <div class="file-details">
                                    <div class="file-icon">
                                        <i class="fas fa-file-excel"></i>
                                    </div>
                                    <div>
                                        <div class="file-name" id="fileName">sample_results.csv</div>
                                        <div class="file-size" id="fileSize">245 KB</div>
                                    </div>
                                </div>
                                <button class="remove-file" id="removeFile">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="instructions-panel">
                            <h4>File Requirements</h4>
                            <ul class="instructions-list">
                                <li>
                                    <div class="instruction-icon">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="instruction-text">
                                        <h5>Correct Format</h5>
                                        <p>Use CSV or Excel format with proper column headers</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="instruction-icon">
                                        <i class="fas fa-columns"></i>
                                    </div>
                                    <div class="instruction-text">
                                        <h5>Required Columns</h5>
                                        <p>Student ID, Student Name, Score (out of 100), Grade</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="instruction-icon">
                                        <i class="fas fa-list-ol"></i>
                                    </div>
                                    <div class="instruction-text">
                                        <h5>Data Validation</h5>
                                        <p>Scores must be between 0-100, grades A-F format</p>
                                    </div>
                                </li>
                            </ul>
                            
                            <div class="template-download">
                                <h4>Need a template?</h4>
                                <p>Download our standard results template to ensure correct formatting</p>
                                <button class="btn btn-secondary" id="downloadTemplateBtn">
                                    <i class="fas fa-download"></i> Download Template
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Preview Table -->
                <div class="preview-container" id="previewContainer">
                    <div class="preview-header">
                        <h3>Data Preview</h3>
                        <div>
                            <span id="previewCount">15</span> records ready for upload
                        </div>
                    </div>
                    
                    <div class="preview-table-container">
                        <table class="preview-table" id="previewTable">
                            <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Student Name</th>
                                    <th>Score</th>
                                    <th>Grade</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="previewTableBody">
                                <!-- Preview rows will be dynamically generated -->
                            </tbody>
                        </table>
                    </div>
                    
                    <div style="margin-top: 25px; display: flex; justify-content: space-between;">
                        <button class="btn btn-secondary" id="backToUploadBtn">
                            <i class="fas fa-arrow-left"></i> Back to Upload
                        </button>
                        <button class="btn btn-primary" id="validateDataBtn">
                            <i class="fas fa-check-circle"></i> Validate Data
                        </button>
                    </div>
                </div>
                
                <!-- Validation Results -->
                <div class="validation-results" id="validationResults">
                    <div class="validation-header">
                        <i class="fas fa-check-circle"></i>
                        <h3>Validation Results</h3>
                    </div>
                    
                    <div class="validation-items" id="validationItems">
                        <!-- Validation items will be dynamically generated -->
                    </div>
                    
                    <div style="display: flex; justify-content: space-between;">
                        <button class="btn btn-secondary" id="backToPreviewBtn">
                            <i class="fas fa-arrow-left"></i> Back to Preview
                        </button>
                        <button class="btn btn-primary" id="uploadResultsBtn">
                            <i class="fas fa-cloud-upload-alt"></i> Upload Results
                        </button>
                    </div>
                </div>
                
                <!-- Upload Progress -->
                <div class="upload-progress" id="uploadProgress">
                    <div class="validation-header">
                        <i class="fas fa-spinner fa-spin"></i>
                        <h3>Uploading Results</h3>
                    </div>
                    
                    <div class="progress-container">
                        <div class="progress-info">
                            <span>Upload Progress</span>
                            <span id="progressPercent">0%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" id="progressFill"></div>
                        </div>
                    </div>
                    
                    <div class="progress-status">
                        <i class="fas fa-spinner fa-spin"></i>
                        <div>
                            <h4 id="progressMessage">Preparing upload...</h4>
                            <p id="progressDetail">Please wait while we process your results</p>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Uploads -->
                <div class="recent-uploads">
                    <div class="card-header">
                        <i class="fas fa-history"></i>
                        <h3>Recent Uploads</h3>
                    </div>
                    
                    <table class="uploads-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Subject</th>
                                <th>Grade</th>
                                <th>Records</th>
                                <th>Uploaded By</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2023-10-15</td>
                                <td>Mathematics</td>
                                <td>Grade 10</td>
                                <td>32</td>
                                <td>Dr. Smith</td>
                                <td><span class="upload-status status-completed">Completed</span></td>
                            </tr>
                            <tr>
                                <td>2023-10-12</td>
                                <td>Physics</td>
                                <td>Grade 11</td>
                                <td>28</td>
                                <td>Ms. Johnson</td>
                                <td><span class="upload-status status-completed">Completed</span></td>
                            </tr>
                            <tr>
                                <td>2023-10-10</td>
                                <td>English</td>
                                <td>Grade 9</td>
                                <td>35</td>
                                <td>Mr. Chen</td>
                                <td><span class="upload-status status-completed">Completed</span></td>
                            </tr>
                            <tr>
                                <td>2023-10-08</td>
                                <td>Chemistry</td>
                                <td>Grade 12</td>
                                <td>30</td>
                                <td>Dr. Williams</td>
                                <td><span class="upload-status status-failed">Failed</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <!-- Footer -->
                <div class="dashboard-footer">
                    <p>&copy; 2023 T&T School Management System. All rights reserved. | Results Upload Module v1.4</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sample data for preview
        const sampleResults = [
            { id: "STU-2023-001", name: "Michael Johnson", score: 92, grade: "A" },
            { id: "STU-2023-002", name: "Sarah Williams", score: 85, grade: "B" },
            { id: "STU-2023-003", name: "James Wilson", score: 78, grade: "C" },
            { id: "STU-2023-004", name: "Emily Davis", score: 95, grade: "A" },
            { id: "STU-2023-005", name: "Robert Chen", score: 88, grade: "B" },
            { id: "STU-2023-006", name: "Olivia Martinez", score: 72, grade: "C" },
            { id: "STU-2023-007", name: "David Brown", score: 65, grade: "D" },
            { id: "STU-2023-008", name: "Sophia Garcia", score: 91, grade: "A" },
            { id: "STU-2023-009", name: "William Taylor", score: 82, grade: "B" },
            { id: "STU-2023-010", name: "Ava Anderson", score: 77, grade: "C" }
        ];
        
        // DOM Elements
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const menuToggle = document.getElementById('menuToggle');
        const fileDropArea = document.getElementById('fileDropArea');
        const fileInput = document.getElementById('fileInput');
        const browseBtn = document.getElementById('browseBtn');
        const fileInfo = document.getElementById('fileInfo');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');
        const removeFile = document.getElementById('removeFile');
        const downloadTemplateBtn = document.getElementById('downloadTemplateBtn');
        const previewContainer = document.getElementById('previewContainer');
        const previewTableBody = document.getElementById('previewTableBody');
        const previewCount = document.getElementById('previewCount');
        const backToUploadBtn = document.getElementById('backToUploadBtn');
        const validateDataBtn = document.getElementById('validateDataBtn');
        const validationResults = document.getElementById('validationResults');
        const validationItems = document.getElementById('validationItems');
        const backToPreviewBtn = document.getElementById('backToPreviewBtn');
        const uploadResultsBtn = document.getElementById('uploadResultsBtn');
        const uploadProgress = document.getElementById('uploadProgress');
        const progressFill = document.getElementById('progressFill');
        const progressPercent = document.getElementById('progressPercent');
        const progressMessage = document.getElementById('progressMessage');
        const progressDetail = document.getElementById('progressDetail');
        
        // Step elements
        const step1 = document.getElementById('step1');
        const step2 = document.getElementById('step2');
        const step3 = document.getElementById('step3');
        const step4 = document.getElementById('step4');
        
        // Form elements
        const uploadForm = document.getElementById('uploadForm');
        const academicYear = document.getElementById('academicYear');
        const term = document.getElementById('term');
        const gradeLevel = document.getElementById('gradeLevel');
        const section = document.getElementById('section');
        const examType = document.getElementById('examType');
        const subject = document.getElementById('subject');
        
        // State variables
        let currentStep = 1;
        let selectedFile = null;
        let uploadInProgress = false;
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            setupEventListeners();
            updateSteps();
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
            
            // File upload
            browseBtn.addEventListener('click', () => fileInput.click());
            
            fileInput.addEventListener('change', handleFileSelect);
            
            // Drag and drop
            fileDropArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                fileDropArea.classList.add('dragover');
            });
            
            fileDropArea.addEventListener('dragleave', () => {
                fileDropArea.classList.remove('dragover');
            });
            
            fileDropArea.addEventListener('drop', (e) => {
                e.preventDefault();
                fileDropArea.classList.remove('dragover');
                
                if (e.dataTransfer.files.length) {
                    handleFileSelect({ target: { files: e.dataTransfer.files } });
                }
            });
            
            // Remove file
            removeFile.addEventListener('click', clearFile);
            
            // Download template
            downloadTemplateBtn.addEventListener('click', downloadTemplate);
            
            // Navigation buttons
            backToUploadBtn.addEventListener('click', () => goToStep(1));
            validateDataBtn.addEventListener('click', validateData);
            backToPreviewBtn.addEventListener('click', () => goToStep(2));
            uploadResultsBtn.addEventListener('click', startUpload);
            
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
        
        // Handle file selection
        function handleFileSelect(e) {
            const file = e.target.files[0];
            
            if (!file) return;
            
            // Check file type
            const validTypes = ['text/csv', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
            const fileExtension = file.name.split('.').pop().toLowerCase();
            const isValidType = validTypes.includes(file.type) || ['csv', 'xls', 'xlsx'].includes(fileExtension);
            
            if (!isValidType) {
                alert('Please select a valid file (CSV or Excel format).');
                return;
            }
            
            // Check file size (10MB limit)
            if (file.size > 10 * 1024 * 1024) {
                alert('File size exceeds 10MB limit.');
                return;
            }
            
            selectedFile = file;
            
            // Update UI
            fileName.textContent = file.name;
            fileSize.textContent = formatFileSize(file.size);
            fileInfo.style.display = 'block';
            
            // Simulate file processing and show preview
            setTimeout(() => {
                showPreview();
                goToStep(2);
            }, 500);
        }
        
        // Clear selected file
        function clearFile() {
            selectedFile = null;
            fileInput.value = '';
            fileInfo.style.display = 'none';
            goToStep(1);
        }
        
        // Format file size
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
        
        // Download template
        function downloadTemplate() {
            // In a real app, this would download an actual template file
            alert('Downloading results template...');
            
            // Simulate download
            const link = document.createElement('a');
            link.href = '#';
            link.download = 'TTSchool_Results_Template.csv';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
        
        // Show preview of data
        function showPreview() {
            previewTableBody.innerHTML = '';
            
            sampleResults.forEach((result, index) => {
                const row = document.createElement('tr');
                
                // Determine grade class
                let gradeClass = '';
                switch(result.grade) {
                    case 'A': gradeClass = 'grade-a'; break;
                    case 'B': gradeClass = 'grade-b'; break;
                    case 'C': gradeClass = 'grade-c'; break;
                    case 'D': gradeClass = 'grade-d'; break;
                    case 'F': gradeClass = 'grade-f'; break;
                }
                
                row.innerHTML = `
                    <td>${result.id}</td>
                    <td>${result.name}</td>
                    <td>${result.score}</td>
                    <td class="grade-cell ${gradeClass}">${result.grade}</td>
                    <td><span class="upload-status status-completed">Valid</span></td>
                `;
                
                previewTableBody.appendChild(row);
            });
            
            previewCount.textContent = sampleResults.length;
            previewContainer.classList.add('active');
        }
        
        // Validate data
        function validateData() {
            // Validate form
            if (!uploadForm.checkValidity()) {
                alert('Please fill in all required fields.');
                return;
            }
            
            if (!selectedFile) {
                alert('Please select a file to upload.');
                return;
            }
            
            // Show validation results
            validationItems.innerHTML = '';
            
            // Add validation items
            const validations = [
                { type: 'success', title: 'File Format Valid', message: 'CSV file format is correctly structured.' },
                { type: 'success', title: 'Column Headers Valid', message: 'All required columns are present.' },
                { type: 'warning', title: '2 Duplicate Records Found', message: 'Duplicate student entries detected.' },
                { type: 'success', title: 'Score Values Valid', message: 'All scores are within 0-100 range.' },
                { type: 'success', title: 'Grade Format Valid', message: 'All grades follow A-F format.' },
                { type: 'error', title: '3 Invalid Student IDs', message: 'Some student IDs do not exist in the system.' }
            ];
            
            let hasErrors = false;
            let hasWarnings = false;
            
            validations.forEach(validation => {
                const item = document.createElement('div');
                item.className = `validation-item ${validation.type}`;
                
                let icon = 'fa-check-circle';
                if (validation.type === 'warning') icon = 'fa-exclamation-triangle';
                if (validation.type === 'error') icon = 'fa-times-circle';
                
                if (validation.type === 'error') hasErrors = true;
                if (validation.type === 'warning') hasWarnings = true;
                
                item.innerHTML = `
                    <div class="validation-icon">
                        <i class="fas ${icon}"></i>
                    </div>
                    <div class="validation-text">
                        <h5>${validation.title}</h5>
                        <p>${validation.message}</p>
                    </div>
                `;
                
                validationItems.appendChild(item);
            });
            
            // Update validation header
            const validationHeader = validationResults.querySelector('.validation-header i');
            const validationTitle = validationResults.querySelector('.validation-header h3');
            
            if (hasErrors) {
                validationHeader.className = 'fas fa-times-circle';
                validationResults.className = 'validation-results validation-error active';
                validationTitle.textContent = 'Validation Failed';
            } else if (hasWarnings) {
                validationHeader.className = 'fas fa-exclamation-triangle';
                validationResults.className = 'validation-results validation-warning active';
                validationTitle.textContent = 'Validation Warnings';
            } else {
                validationHeader.className = 'fas fa-check-circle';
                validationResults.className = 'validation-results validation-success active';
                validationTitle.textContent = 'Validation Successful';
            }
            
            // Update upload button based on validation
            if (hasErrors) {
                uploadResultsBtn.disabled = true;
                uploadResultsBtn.innerHTML = '<i class="fas fa-ban"></i> Fix Errors to Upload';
                uploadResultsBtn.className = 'btn btn-danger';
            } else {
                uploadResultsBtn.disabled = false;
                uploadResultsBtn.innerHTML = '<i class="fas fa-cloud-upload-alt"></i> Upload Results';
                uploadResultsBtn.className = 'btn btn-primary';
            }
            
            goToStep(3);
        }
        
        // Start upload process
        function startUpload() {
            if (uploadInProgress) return;
            
            uploadInProgress = true;
            goToStep(4);
            
            // Reset progress
            progressFill.style.width = '0%';
            progressPercent.textContent = '0%';
            progressMessage.textContent = 'Preparing upload...';
            progressDetail.textContent = 'Please wait while we process your results';
            
            // Simulate upload progress
            let progress = 0;
            const interval = setInterval(() => {
                progress += Math.random() * 10;
                
                if (progress >= 100) {
                    progress = 100;
                    clearInterval(interval);
                    
                    // Upload complete
                    setTimeout(() => {
                        uploadComplete(true);
                    }, 500);
                }
                
                progressFill.style.width = `${progress}%`;
                progressPercent.textContent = `${Math.round(progress)}%`;
                
                // Update messages based on progress
                if (progress < 30) {
                    progressMessage.textContent = 'Validating data...';
                    progressDetail.textContent = 'Checking for errors and inconsistencies';
                } else if (progress < 60) {
                    progressMessage.textContent = 'Processing records...';
                    progressDetail.textContent = 'Updating student records in the database';
                } else if (progress < 90) {
                    progressMessage.textContent = 'Generating reports...';
                    progressDetail.textContent = 'Creating result summaries and analytics';
                } else {
                    progressMessage.textContent = 'Finalizing upload...';
                    progressDetail.textContent = 'Completing the upload process';
                }
            }, 200);
        }
        
        // Upload complete
        function uploadComplete(success) {
            uploadInProgress = false;
            
            const progressStatus = uploadProgress.querySelector('.progress-status');
            const progressIcon = progressStatus.querySelector('i');
            
            if (success) {
                // Success
                progressIcon.className = 'fas fa-check-circle';
                progressMessage.textContent = 'Upload Successful!';
                progressDetail.textContent = 'Results have been successfully uploaded to the system';
                uploadProgress.className = 'upload-progress progress-success active';
                
                // Reset form after delay
                setTimeout(() => {
                    resetForm();
                    goToStep(1);
                    alert('Results uploaded successfully!');
                }, 3000);
            } else {
                // Error
                progressIcon.className = 'fas fa-times-circle';
                progressMessage.textContent = 'Upload Failed';
                progressDetail.textContent = 'An error occurred during the upload process';
                uploadProgress.className = 'upload-progress progress-error active';
            }
        }
        
        // Reset form
        function resetForm() {
            uploadForm.reset();
            clearFile();
            previewContainer.classList.remove('active');
            validationResults.classList.remove('active');
            uploadProgress.classList.remove('active');
        }
        
        // Navigate between steps
        function goToStep(step) {
            currentStep = step;
            updateSteps();
            
            // Hide all containers
            previewContainer.classList.remove('active');
            validationResults.classList.remove('active');
            uploadProgress.classList.remove('active');
            
            // Show appropriate container
            if (step === 2) {
                previewContainer.classList.add('active');
            } else if (step === 3) {
                validationResults.classList.add('active');
            } else if (step === 4) {
                uploadProgress.classList.add('active');
            }
        }
        
        // Update step indicators
        function updateSteps() {
            // Reset all steps
            step1.className = 'step';
            step2.className = 'step';
            step3.className = 'step';
            step4.className = 'step';
            
            // Mark previous steps as completed
            for (let i = 1; i < currentStep; i++) {
                document.getElementById(`step${i}`).className = 'step completed';
                document.getElementById(`step${i}`).querySelector('.step-circle').innerHTML = '<i class="fas fa-check"></i>';
            }
            
            // Mark current step as active
            if (currentStep >= 1 && currentStep <= 4) {
                document.getElementById(`step${currentStep}`).classList.add('active');
            }
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