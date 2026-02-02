<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses - T&T School Management System</title>
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
        
        /* Course Management Header */
        .course-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .course-header h2 {
            font-size: 1.8rem;
        }
        
        .course-actions {
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
        
        /* Courses Grid */
        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .course-card {
            background-color: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px var(--shadow);
            transition: all 0.3s ease;
            border-top: 5px solid var(--primary-medium);
        }
        
        .course-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 51, 102, 0.15);
        }
        
        .course-card-header {
            padding: 25px 25px 15px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        
        .course-code {
            background-color: var(--light-bg);
            color: var(--primary-medium);
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .course-status {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .status-active {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }
        
        .status-upcoming {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning);
        }
        
        .status-ended {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger);
        }
        
        .course-card-body {
            padding: 0 25px 20px;
        }
        
        .course-title {
            font-size: 1.3rem;
            margin-bottom: 10px;
            color: var(--primary-dark);
        }
        
        .course-description {
            color: var(--text-light);
            font-size: 0.95rem;
            margin-bottom: 20px;
            line-height: 1.6;
        }
        
        .course-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .detail-item {
            display: flex;
            align-items: center;
        }
        
        .detail-item i {
            width: 30px;
            color: var(--primary-medium);
            font-size: 1rem;
        }
        
        .detail-item span {
            font-size: 0.9rem;
            color: var(--text-dark);
        }
        
        .course-instructor {
            display: flex;
            align-items: center;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }
        
        .instructor-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 12px;
        }
        
        .instructor-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .instructor-info h5 {
            font-size: 0.95rem;
            margin-bottom: 3px;
        }
        
        .instructor-info p {
            font-size: 0.85rem;
            color: var(--text-light);
        }
        
        .course-card-footer {
            padding: 20px 25px;
            background-color: #f9f9f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #eee;
        }
        
        .course-enrollment {
            font-weight: 600;
            color: var(--primary-medium);
        }
        
        .course-actions-btns {
            display: flex;
            gap: 10px;
        }
        
        .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
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
            max-width: 700px;
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
            min-height: 120px;
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
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 30px;
            background-color: var(--white);
            border-radius: 12px;
            box-shadow: 0 5px 15px var(--shadow);
            margin-bottom: 40px;
        }
        
        .empty-state i {
            font-size: 4rem;
            color: var(--primary-light);
            margin-bottom: 20px;
        }
        
        .empty-state h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: var(--primary-dark);
        }
        
        .empty-state p {
            color: var(--text-light);
            max-width: 500px;
            margin: 0 auto 30px;
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
            .courses-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
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
        }
        
        @media (max-width: 768px) {
            .course-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }
            
            .course-actions {
                width: 100%;
                justify-content: space-between;
            }
            
            .top-header {
                padding: 20px;
            }
            
            .dashboard-content {
                padding: 20px;
            }
            
            .courses-grid {
                grid-template-columns: 1fr;
            }
            
            .modal-content {
                max-width: 95%;
            }
        }
        
        @media (max-width: 576px) {
            .course-actions {
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
            
            .course-card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .course-details {
                grid-template-columns: 1fr;
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
                    <p>Course Management</p>
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
                
                <a href="manage-courses.html" class="menu-item active">
                    <i class="fas fa-book"></i>
                    <span class="menu-text">Courses</span>
                </a>
                
                <a href="attendance.html" class="menu-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span class="menu-text">Attendance</span>
                </a>
                
                <a href="grades.html" class="menu-item">
                    <i class="fas fa-chart-bar"></i>
                    <span class="menu-text">Grades</span>
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
                        <h1>Course Management</h1>
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
                <!-- Course Header -->
                <div class="course-header">
                    <h2>All Courses</h2>
                    <div class="course-actions">
                        <button class="btn btn-secondary" id="filterBtn">
                            <i class="fas fa-filter"></i> Filter Courses
                        </button>
                        <button class="btn btn-primary" id="addCourseBtn">
                            <i class="fas fa-plus-circle"></i> Add New Course
                        </button>
                    </div>
                </div>
                
                <!-- Filters Bar -->
                <div class="filters-bar" id="filtersBar">
                    <div class="filter-group">
                        <label for="courseLevel">Course Level</label>
                        <select id="courseLevel">
                            <option value="">All Levels</option>
                            <option value="beginner">Beginner</option>
                            <option value="intermediate">Intermediate</option>
                            <option value="advanced">Advanced</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="courseStatus">Status</label>
                        <select id="courseStatus">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="upcoming">Upcoming</option>
                            <option value="ended">Ended</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="courseInstructor">Instructor</label>
                        <select id="courseInstructor">
                            <option value="">All Instructors</option>
                            <option value="dr-smith">Dr. Robert Smith</option>
                            <option value="ms-johnson">Ms. Emily Johnson</option>
                            <option value="mr-chen">Mr. David Chen</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="searchCourse">Search</label>
                        <input type="text" id="searchCourse" placeholder="Search course name or code...">
                    </div>
                </div>
                
                <!-- Courses Grid -->
                <div class="courses-grid" id="coursesGrid">
                    <!-- Course cards will be dynamically generated -->
                </div>
                
                <!-- Empty State (hidden by default) -->
                <div class="empty-state" id="emptyState" style="display: none;">
                    <i class="fas fa-book-open"></i>
                    <h3>No Courses Found</h3>
                    <p>There are no courses matching your current filters. Try adjusting your search criteria or add a new course to get started.</p>
                    <button class="btn btn-primary" id="addCourseEmptyBtn">
                        <i class="fas fa-plus-circle"></i> Add New Course
                    </button>
                </div>
                
                <!-- Footer -->
                <div class="dashboard-footer">
                    <p>&copy; 2023 T&T School Management System. All rights reserved. | Course Management Module v1.2</p>
                </div>
            </div>
        </div>
        
        <!-- Add/Edit Course Modal -->
        <div class="modal" id="courseModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="modalTitle">Add New Course</h3>
                    <button class="close-modal" id="closeModal">&times;</button>
                </div>
                
                <div class="modal-body">
                    <form id="courseForm">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="courseCode">Course Code *</label>
                                <input type="text" id="courseCode" required placeholder="e.g. MATH-101">
                            </div>
                            
                            <div class="form-group">
                                <label for="courseName">Course Name *</label>
                                <input type="text" id="courseName" required placeholder="e.g. Advanced Mathematics">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="courseDescription">Course Description *</label>
                            <textarea id="courseDescription" required placeholder="Provide a detailed description of the course..."></textarea>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="courseLevel">Course Level *</label>
                                <select id="modalCourseLevel" required>
                                    <option value="">Select Level</option>
                                    <option value="beginner">Beginner</option>
                                    <option value="intermediate">Intermediate</option>
                                    <option value="advanced">Advanced</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="courseCredits">Credits *</label>
                                <select id="courseCredits" required>
                                    <option value="">Select Credits</option>
                                    <option value="1">1 Credit</option>
                                    <option value="2">2 Credits</option>
                                    <option value="3">3 Credits</option>
                                    <option value="4">4 Credits</option>
                                    <option value="5">5 Credits</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="courseInstructor">Instructor *</label>
                                <select id="modalCourseInstructor" required>
                                    <option value="">Select Instructor</option>
                                    <option value="dr-smith">Dr. Robert Smith</option>
                                    <option value="ms-johnson">Ms. Emily Johnson</option>
                                    <option value="mr-chen">Mr. David Chen</option>
                                    <option value="dr-williams">Dr. Sarah Williams</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="courseSchedule">Schedule *</label>
                                <input type="text" id="courseSchedule" required placeholder="e.g. Mon/Wed/Fri 10:00-11:30 AM">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="courseStartDate">Start Date *</label>
                                <input type="date" id="courseStartDate" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="courseEndDate">End Date *</label>
                                <input type="date" id="courseEndDate" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="courseCapacity">Student Capacity *</label>
                                <input type="number" id="courseCapacity" required min="1" max="100" placeholder="e.g. 30">
                            </div>
                            
                            <div class="form-group">
                                <label for="courseStatus">Status *</label>
                                <select id="modalCourseStatus" required>
                                    <option value="">Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="upcoming">Upcoming</option>
                                    <option value="ended">Ended</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div class="modal-footer">
                    <button class="btn btn-secondary" id="cancelModalBtn">Cancel</button>
                    <button class="btn btn-primary" id="saveCourseBtn">Save Course</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sample course data
        const sampleCourses = [
            {
                id: 1,
                code: "MATH-101",
                name: "Advanced Mathematics",
                description: "Comprehensive course covering advanced mathematical concepts including calculus, linear algebra, and differential equations.",
                level: "advanced",
                credits: 4,
                instructor: "Dr. Robert Smith",
                instructorId: "dr-smith",
                schedule: "Mon/Wed/Fri 10:00-11:30 AM",
                startDate: "2023-09-01",
                endDate: "2023-12-15",
                capacity: 35,
                enrolled: 32,
                status: "active"
            },
            {
                id: 2,
                code: "SCI-201",
                name: "Physics Fundamentals",
                description: "Introduction to classical mechanics, thermodynamics, and electromagnetism with practical laboratory sessions.",
                level: "intermediate",
                credits: 3,
                instructor: "Ms. Emily Johnson",
                instructorId: "ms-johnson",
                schedule: "Tue/Thu 1:00-2:30 PM",
                startDate: "2023-09-05",
                endDate: "2023-12-20",
                capacity: 30,
                enrolled: 28,
                status: "active"
            },
            {
                id: 3,
                code: "CS-301",
                name: "Computer Science Principles",
                description: "Foundational course in computer science covering algorithms, data structures, and programming concepts.",
                level: "beginner",
                credits: 3,
                instructor: "Mr. David Chen",
                instructorId: "mr-chen",
                schedule: "Mon/Wed 2:00-3:30 PM",
                startDate: "2023-10-01",
                endDate: "2024-01-15",
                capacity: 40,
                enrolled: 35,
                status: "upcoming"
            },
            {
                id: 4,
                code: "ENG-102",
                name: "Literature & Composition",
                description: "Study of literary works from various periods with emphasis on critical analysis and writing skills development.",
                level: "intermediate",
                credits: 3,
                instructor: "Dr. Sarah Williams",
                instructorId: "dr-williams",
                schedule: "Tue/Thu 9:00-10:30 AM",
                startDate: "2023-08-15",
                endDate: "2023-11-30",
                capacity: 25,
                enrolled: 25,
                status: "ended"
            },
            {
                id: 5,
                code: "BIO-202",
                name: "Advanced Biology",
                description: "In-depth study of cellular biology, genetics, and molecular biology with laboratory experiments.",
                level: "advanced",
                credits: 4,
                instructor: "Dr. Robert Smith",
                instructorId: "dr-smith",
                schedule: "Mon/Wed/Fri 1:00-2:30 PM",
                startDate: "2023-09-10",
                endDate: "2023-12-18",
                capacity: 30,
                enrolled: 30,
                status: "active"
            },
            {
                id: 6,
                code: "ART-103",
                name: "Visual Arts Studio",
                description: "Practical course focusing on drawing, painting, and design principles for creative expression.",
                level: "beginner",
                credits: 2,
                instructor: "Ms. Emily Johnson",
                instructorId: "ms-johnson",
                schedule: "Fri 3:00-5:30 PM",
                startDate: "2023-10-15",
                endDate: "2024-02-10",
                capacity: 20,
                enrolled: 15,
                status: "upcoming"
            }
        ];
        
        // DOM Elements
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const menuToggle = document.getElementById('menuToggle');
        const coursesGrid = document.getElementById('coursesGrid');
        const emptyState = document.getElementById('emptyState');
        const courseModal = document.getElementById('courseModal');
        const modalTitle = document.getElementById('modalTitle');
        const courseForm = document.getElementById('courseForm');
        const closeModal = document.getElementById('closeModal');
        const cancelModalBtn = document.getElementById('cancelModalBtn');
        const saveCourseBtn = document.getElementById('saveCourseBtn');
        const addCourseBtn = document.getElementById('addCourseBtn');
        const addCourseEmptyBtn = document.getElementById('addCourseEmptyBtn');
        const filterBtn = document.getElementById('filterBtn');
        const filtersBar = document.getElementById('filtersBar');
        
        // Filter elements
        const courseLevelFilter = document.getElementById('courseLevel');
        const courseStatusFilter = document.getElementById('courseStatus');
        const courseInstructorFilter = document.getElementById('courseInstructor');
        const searchCourseFilter = document.getElementById('searchCourse');
        
        // Form elements
        const courseCodeInput = document.getElementById('courseCode');
        const courseNameInput = document.getElementById('courseName');
        const courseDescriptionInput = document.getElementById('courseDescription');
        const modalCourseLevelInput = document.getElementById('modalCourseLevel');
        const courseCreditsInput = document.getElementById('courseCredits');
        const modalCourseInstructorInput = document.getElementById('modalCourseInstructor');
        const courseScheduleInput = document.getElementById('courseSchedule');
        const courseStartDateInput = document.getElementById('courseStartDate');
        const courseEndDateInput = document.getElementById('courseEndDate');
        const courseCapacityInput = document.getElementById('courseCapacity');
        const modalCourseStatusInput = document.getElementById('modalCourseStatus');
        
        // State variables
        let courses = [...sampleCourses];
        let currentEditId = null;
        let filtersVisible = true;
        
        // Set default dates for the form
        const today = new Date();
        const nextMonth = new Date();
        nextMonth.setMonth(today.getMonth() + 1);
        
        courseStartDateInput.valueAsDate = today;
        courseEndDateInput.valueAsDate = nextMonth;
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            renderCourses();
            setupEventListeners();
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
            addCourseBtn.addEventListener('click', () => openModal('add'));
            addCourseEmptyBtn.addEventListener('click', () => openModal('add'));
            
            closeModal.addEventListener('click', closeModalFunc);
            cancelModalBtn.addEventListener('click', closeModalFunc);
            
            // Save course
            saveCourseBtn.addEventListener('click', saveCourse);
            
            // Filter toggle
            filterBtn.addEventListener('click', () => {
                filtersVisible = !filtersVisible;
                filtersBar.style.display = filtersVisible ? 'flex' : 'none';
                filterBtn.innerHTML = filtersVisible 
                    ? '<i class="fas fa-filter"></i> Hide Filters' 
                    : '<i class="fas fa-filter"></i> Show Filters';
            });
            
            // Filter events
            courseLevelFilter.addEventListener('change', applyFilters);
            courseStatusFilter.addEventListener('change', applyFilters);
            courseInstructorFilter.addEventListener('change', applyFilters);
            searchCourseFilter.addEventListener('input', applyFilters);
            
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
        
        // Render courses to the grid
        function renderCourses(filteredCourses = courses) {
            coursesGrid.innerHTML = '';
            
            if (filteredCourses.length === 0) {
                coursesGrid.style.display = 'none';
                emptyState.style.display = 'block';
                return;
            }
            
            coursesGrid.style.display = 'grid';
            emptyState.style.display = 'none';
            
            filteredCourses.forEach(course => {
                const courseCard = createCourseCard(course);
                coursesGrid.appendChild(courseCard);
            });
        }
        
        // Create a course card element
        function createCourseCard(course) {
            const card = document.createElement('div');
            card.className = 'course-card';
            card.dataset.id = course.id;
            
            // Get status class
            let statusClass = '';
            let statusText = '';
            switch(course.status) {
                case 'active':
                    statusClass = 'status-active';
                    statusText = 'Active';
                    break;
                case 'upcoming':
                    statusClass = 'status-upcoming';
                    statusText = 'Upcoming';
                    break;
                case 'ended':
                    statusClass = 'status-ended';
                    statusText = 'Ended';
                    break;
            }
            
            // Get instructor avatar
            const instructorAvatar = getInstructorAvatar(course.instructorId);
            
            card.innerHTML = `
                <div class="course-card-header">
                    <div class="course-code">${course.code}</div>
                    <div class="course-status ${statusClass}">${statusText}</div>
                </div>
                
                <div class="course-card-body">
                    <h3 class="course-title">${course.name}</h3>
                    <p class="course-description">${course.description}</p>
                    
                    <div class="course-details">
                        <div class="detail-item">
                            <i class="fas fa-layer-group"></i>
                            <span>Level: ${course.level.charAt(0).toUpperCase() + course.level.slice(1)}</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-star"></i>
                            <span>Credits: ${course.credits}</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span>${course.schedule}</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-users"></i>
                            <span>${course.enrolled}/${course.capacity} Students</span>
                        </div>
                    </div>
                    
                    <div class="course-instructor">
                        <div class="instructor-avatar">
                            <img src="${instructorAvatar}" alt="${course.instructor}">
                        </div>
                        <div class="instructor-info">
                            <h5>${course.instructor}</h5>
                            <p>Course Instructor</p>
                        </div>
                    </div>
                </div>
                
                <div class="course-card-footer">
                    <div class="course-enrollment">${course.enrolled} Enrolled</div>
                    <div class="course-actions-btns">
                        <button class="action-btn view" data-id="${course.id}">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="action-btn edit" data-id="${course.id}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="action-btn delete" data-id="${course.id}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;
            
            // Add event listeners to action buttons
            const viewBtn = card.querySelector('.action-btn.view');
            const editBtn = card.querySelector('.action-btn.edit');
            const deleteBtn = card.querySelector('.action-btn.delete');
            
            viewBtn.addEventListener('click', () => viewCourse(course.id));
            editBtn.addEventListener('click', () => openModal('edit', course.id));
            deleteBtn.addEventListener('click', () => deleteCourse(course.id));
            
            return card;
        }
        
        // Get instructor avatar based on ID
        function getInstructorAvatar(instructorId) {
            const avatars = {
                'dr-smith': 'https://randomuser.me/api/portraits/men/45.jpg',
                'ms-johnson': 'https://randomuser.me/api/portraits/women/65.jpg',
                'mr-chen': 'https://randomuser.me/api/portraits/men/32.jpg',
                'dr-williams': 'https://randomuser.me/api/portraits/women/32.jpg'
            };
            
            return avatars[instructorId] || 'https://randomuser.me/api/portraits/men/1.jpg';
        }
        
        // Apply filters to courses
        function applyFilters() {
            const levelFilter = courseLevelFilter.value;
            const statusFilter = courseStatusFilter.value;
            const instructorFilter = courseInstructorFilter.value;
            const searchFilter = searchCourseFilter.value.toLowerCase();
            
            const filteredCourses = courses.filter(course => {
                // Level filter
                if (levelFilter && course.level !== levelFilter) return false;
                
                // Status filter
                if (statusFilter && course.status !== statusFilter) return false;
                
                // Instructor filter
                if (instructorFilter && course.instructorId !== instructorFilter) return false;
                
                // Search filter
                if (searchFilter) {
                    const searchInCode = course.code.toLowerCase().includes(searchFilter);
                    const searchInName = course.name.toLowerCase().includes(searchFilter);
                    const searchInDesc = course.description.toLowerCase().includes(searchFilter);
                    
                    if (!searchInCode && !searchInName && !searchInDesc) return false;
                }
                
                return true;
            });
            
            renderCourses(filteredCourses);
        }
        
        // Open modal for adding/editing course
        function openModal(mode, courseId = null) {
            if (mode === 'add') {
                modalTitle.textContent = 'Add New Course';
                currentEditId = null;
                resetForm();
                
                // Set default dates
                const today = new Date();
                const nextMonth = new Date();
                nextMonth.setMonth(today.getMonth() + 1);
                
                courseStartDateInput.valueAsDate = today;
                courseEndDateInput.valueAsDate = nextMonth;
            } else if (mode === 'edit' && courseId) {
                modalTitle.textContent = 'Edit Course';
                currentEditId = courseId;
                populateForm(courseId);
            }
            
            courseModal.classList.add('active');
        }
        
        // Close modal
        function closeModalFunc() {
            courseModal.classList.remove('active');
            resetForm();
            currentEditId = null;
        }
        
        // Reset form
        function resetForm() {
            courseForm.reset();
            
            // Reset dates to today and next month
            const today = new Date();
            const nextMonth = new Date();
            nextMonth.setMonth(today.getMonth() + 1);
            
            courseStartDateInput.valueAsDate = today;
            courseEndDateInput.valueAsDate = nextMonth;
        }
        
        // Populate form with course data
        function populateForm(courseId) {
            const course = courses.find(c => c.id == courseId);
            if (!course) return;
            
            courseCodeInput.value = course.code;
            courseNameInput.value = course.name;
            courseDescriptionInput.value = course.description;
            modalCourseLevelInput.value = course.level;
            courseCreditsInput.value = course.credits;
            modalCourseInstructorInput.value = course.instructorId;
            courseScheduleInput.value = course.schedule;
            courseStartDateInput.value = course.startDate;
            courseEndDateInput.value = course.endDate;
            courseCapacityInput.value = course.capacity;
            modalCourseStatusInput.value = course.status;
        }
        
        // Save course (add or update)
        function saveCourse() {
            // Validate form
            if (!courseForm.checkValidity()) {
                alert('Please fill in all required fields correctly.');
                return;
            }
            
            // Validate dates
            const startDate = new Date(courseStartDateInput.value);
            const endDate = new Date(courseEndDateInput.value);
            
            if (endDate <= startDate) {
                alert('End date must be after start date.');
                return;
            }
            
            if (currentEditId) {
                // Update existing course
                const index = courses.findIndex(c => c.id == currentEditId);
                if (index !== -1) {
                    courses[index] = {
                        ...courses[index],
                        code: courseCodeInput.value,
                        name: courseNameInput.value,
                        description: courseDescriptionInput.value,
                        level: modalCourseLevelInput.value,
                        credits: parseInt(courseCreditsInput.value),
                        instructorId: modalCourseInstructorInput.value,
                        instructor: getInstructorName(modalCourseInstructorInput.value),
                        schedule: courseScheduleInput.value,
                        startDate: courseStartDateInput.value,
                        endDate: courseEndDateInput.value,
                        capacity: parseInt(courseCapacityInput.value),
                        status: modalCourseStatusInput.value
                    };
                }
                
                alert('Course updated successfully!');
            } else {
                // Add new course
                const newCourse = {
                    id: courses.length > 0 ? Math.max(...courses.map(c => c.id)) + 1 : 1,
                    code: courseCodeInput.value,
                    name: courseNameInput.value,
                    description: courseDescriptionInput.value,
                    level: modalCourseLevelInput.value,
                    credits: parseInt(courseCreditsInput.value),
                    instructorId: modalCourseInstructorInput.value,
                    instructor: getInstructorName(modalCourseInstructorInput.value),
                    schedule: courseScheduleInput.value,
                    startDate: courseStartDateInput.value,
                    endDate: courseEndDateInput.value,
                    capacity: parseInt(courseCapacityInput.value),
                    enrolled: 0,
                    status: modalCourseStatusInput.value
                };
                
                courses.unshift(newCourse);
                alert('Course added successfully!');
            }
            
            // Update display and close modal
            applyFilters();
            closeModalFunc();
        }
        
        // Get instructor name from ID
        function getInstructorName(instructorId) {
            const instructorNames = {
                'dr-smith': 'Dr. Robert Smith',
                'ms-johnson': 'Ms. Emily Johnson',
                'mr-chen': 'Mr. David Chen',
                'dr-williams': 'Dr. Sarah Williams'
            };
            
            return instructorNames[instructorId] || 'Unknown Instructor';
        }
        
        // View course details
        function viewCourse(courseId) {
            const course = courses.find(c => c.id == courseId);
            if (!course) return;
            
            alert(`Viewing details for: ${course.name}\n\nCode: ${course.code}\nDescription: ${course.description}\nInstructor: ${course.instructor}\nSchedule: ${course.schedule}\nStatus: ${course.status}\nEnrolled: ${course.enrolled}/${course.capacity} students`);
        }
        
        // Delete course
        function deleteCourse(courseId) {
            if (!confirm('Are you sure you want to delete this course? This action cannot be undone.')) {
                return;
            }
            
            const courseName = courses.find(c => c.id == courseId)?.name || 'Unknown Course';
            
            courses = courses.filter(c => c.id != courseId);
            applyFilters();
            
            alert(`Course "${courseName}" has been deleted.`);
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