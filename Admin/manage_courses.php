<?php
require_once '../auth/session.php';
require_once '../include/config.php';
checkAccess('admin');

$success_message = "";
$error_message = "";

// Handle Delete Request
if (isset($_POST['delete_course_id'])) {
    $course_id = filter_input(INPUT_POST, 'delete_course_id', FILTER_SANITIZE_NUMBER_INT);
    try {
        $stmt = $pdo->prepare("DELETE FROM courses WHERE course_id = ?");
        if ($stmt->execute([$course_id])) {
            $success_message = "Course deleted successfully!";
        } else {
            $error_message = "Failed to delete course.";
        }
    } catch (PDOException $e) {
        $error_message = "Error: " . $e->getMessage();
    }
}

// Handle Update Request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_course'])) {
    $course_id = $_POST['course_id'];
    $course_name = $_POST['course_name'];
    $description = $_POST['description'];
    $level = $_POST['level'];
    $class_name = $_POST['class_name'];
    $instructor_id = $_POST['instructor_id'];
    $schedule = $_POST['schedule'];

    try {
        $stmt = $pdo->prepare("UPDATE courses SET course_name=?, description=?, level=?, class_name=?, instructor_id=?, schedule=? WHERE course_id=?");
        if ($stmt->execute([$course_name, $description, $level, $class_name, $instructor_id, $schedule, $course_id])) {
            $success_message = "Course updated successfully!";
        } else {
            $error_message = "Failed to update course.";
        }
    } catch (PDOException $e) {
        $error_message = "Error: " . $e->getMessage();
    }
}

// Fetch Courses
$courses = [];
try {
    $stmt = $pdo->query("SELECT c.*, s.full_name as instructor_name, s.image as instructor_image FROM courses c LEFT JOIN staff s ON c.instructor_id = s.staff_id ORDER BY c.created_at DESC");
    $courses = $stmt->fetchAll();
} catch (PDOException $e) {
    $error_message = "Error fetching courses: " . $e->getMessage();
}

// Fetch Staff for Edit Modal
$instructors = [];
try {
    $stmt = $pdo->query("SELECT staff_id, full_name FROM staff WHERE position LIKE '%Teacher%' OR position LIKE '%Staff%' ORDER BY full_name ASC");
    $instructors = $stmt->fetchAll();
} catch (PDOException $e) {}

// Fetch Classes for Edit Modal
$classes = [];
if (function_exists('getClasses')) {
    $classes = getClasses($pdo);
} else {
    // Fallback if helper not found
    $classes = ['SS1', 'SS2', 'SS3'];
}

// Fetch Subjects for Edit Modal
$subjects_list = [];
try {
    $stmt = $pdo->query("SELECT subject_name FROM subjects ORDER BY subject_name ASC");
    $subjects_list = $stmt->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {}
?>
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
        <!-- Sidebar -->
        <?php include '../include/admin_sidebar.php'; ?>
        
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
                        <a href="add_new_courses.php" class="btn btn-primary">
                            <i class="fas fa-plus-circle"></i> Add New Course
                        </a>
                    </div>
                </div>

                <?php if ($success_message): ?>
                    <div class="alert alert-success" style="padding: 15px; background: #d4edda; color: #155724; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;"><?php echo $success_message; ?></div>
                <?php endif; ?>
                <?php if ($error_message): ?>
                    <div class="alert alert-danger" style="padding: 15px; background: #f8d7da; color: #721c24; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;"><?php echo $error_message; ?></div>
                <?php endif; ?>
                
                <!-- Courses Grid -->
                <div class="courses-grid" id="coursesGrid">
                    <?php if (empty($courses)): ?>
                        <div class="empty-state" id="emptyState" style="grid-column: 1 / -1;">
                            <i class="fas fa-book-open"></i>
                            <h3>No Courses Found</h3>
                            <p>There are no courses registered yet. Click the button above to add a new course.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($courses as $course): ?>
                            <div class="course-card">
                                <div class="course-card-header">
                                    <div class="course-code"><?php echo htmlspecialchars($course['course_name']); ?></div>
                                    <div class="course-status status-active"><?php echo ucfirst(htmlspecialchars($course['level'])); ?></div>
                                </div>
                                
                                <div class="course-card-body">
                                    <h3 class="course-title"><?php echo htmlspecialchars($course['course_name']); ?></h3>
                                    <p class="course-description"><?php echo htmlspecialchars($course['description']); ?></p>
                                    
                                    <div class="course-details">
                                        <div class="detail-item">
                                            <i class="fas fa-graduation-cap"></i>
                                            <span>Class: <?php echo htmlspecialchars($course['class_name']); ?></span>
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-clock"></i>
                                            <span><?php echo htmlspecialchars($course['schedule']); ?></span>
                                        </div>
                                    </div>
                                    
                                    <div class="course-instructor">
                                        <div class="instructor-avatar">
                                            <?php if (!empty($course['instructor_image'])): ?>
                                                <img src="../assets/images/staff/<?php echo $course['instructor_image']; ?>" alt="Instructor">
                                            <?php else: ?>
                                                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($course['instructor_name']); ?>&background=random" alt="Instructor">
                                            <?php endif; ?>
                                        </div>
                                        <div class="instructor-info">
                                            <h5><?php echo htmlspecialchars($course['instructor_name'] ?? 'Not Assigned'); ?></h5>
                                            <p>Course Instructor</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="course-card-footer">
                                    <div class="course-enrollment">Active Course</div>
                                    <div class="course-actions-btns">
                                        <button class="action-btn view" onclick="openEditModal(<?php echo htmlspecialchars(json_encode($course)); ?>)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <form method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this course?');">
                                            <input type="hidden" name="delete_course_id" value="<?php echo $course['course_id']; ?>">
                                            <button type="submit" class="action-btn delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                
                <!-- Footer -->
                <div class="dashboard-footer">
                    <p>&copy; 2023 T&T School Management System. All rights reserved. | Course Management Module v1.2</p>
                </div>
            </div>
        </div>
        
        <!-- View/Edit Course Modal -->
        <div class="modal" id="courseModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="modalTitle">View / Edit Course</h3>
                    <button class="close-modal" id="closeModal">&times;</button>
                </div>
                
                <div class="modal-body">
                    <form id="courseForm" method="POST">
                        <input type="hidden" name="update_course" value="1">
                        <input type="hidden" name="course_id" id="edit_course_id">
                        
                        <div class="form-group">
                            <label>Subject Name *</label>
                            <select name="course_name" id="edit_course_name" required>
                                <option value="">Select Subject</option>
                                <?php foreach ($subjects_list as $subject): ?>
                                    <option value="<?php echo htmlspecialchars($subject); ?>"><?php echo htmlspecialchars($subject); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" id="edit_description" placeholder="Provide a detailed description of the course..."></textarea>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label>Level *</label>
                                <select name="level" id="edit_level" required>
                                    <option value="beginner">Beginner</option>
                                    <option value="intermediate">Intermediate</option>
                                    <option value="advanced">Advanced</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Class *</label>
                                <select name="class_name" id="edit_class_name" required>
                                    <option value="">Select Class</option>
                                    <?php foreach ($classes as $c): ?>
                                        <option value="<?php echo $c; ?>"><?php echo $c; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label>Instructor *</label>
                                <select name="instructor_id" id="edit_instructor_id" required>
                                    <option value="">Select Instructor</option>
                                    <?php foreach ($instructors as $ins): ?>
                                        <option value="<?php echo $ins['staff_id']; ?>"><?php echo $ins['full_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Schedule *</label>
                                <input type="text" name="schedule" id="edit_schedule" required placeholder="e.g. Mon/Wed/Fri 10:00-11:30 AM">
                            </div>
                        </div>
                        
                        <div style="text-align: right; margin-top: 20px;">
                            <button type="button" class="btn btn-secondary" onclick="closeModalFunc()">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // DOM Elements
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const menuToggle = document.getElementById('menuToggle');
        const courseModal = document.getElementById('courseModal');
        const closeModal = document.getElementById('closeModal');
        
        // Mobile sidebar toggle
        if (menuToggle) {
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            });
        }
        
        if (overlay) {
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });
        }

        if (closeModal) {
            closeModal.addEventListener('click', closeModalFunc);
        }
        
        function closeModalFunc() {
            courseModal.classList.remove('active');
        }
        
        function openEditModal(course) {
            document.getElementById('edit_course_id').value = course.course_id;
            document.getElementById('edit_course_name').value = course.course_name;
            document.getElementById('edit_description').value = course.description;
            document.getElementById('edit_level').value = course.level;
            document.getElementById('edit_class_name').value = course.class_name;
            document.getElementById('edit_instructor_id').value = course.instructor_id;
            document.getElementById('edit_schedule').value = course.schedule;
            
            courseModal.classList.add('active');
        }

        // Handle window resize
        window.addEventListener('resize', function() {
            if(window.innerWidth >= 992) {
                if (sidebar) sidebar.classList.remove('active');
                if (overlay) overlay.classList.remove('active');
            }
        });
    </script>
</body>
</html>