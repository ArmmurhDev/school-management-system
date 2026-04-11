<?php
require_once '../auth/session.php';
require_once '../include/config.php';
checkAccess('staff');

$student_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$staff_id = $_SESSION['user_id'];

// Ensure student_notes table exists
try {
    $pdo->query("CREATE TABLE IF NOT EXISTS `student_notes` (
      `note_id` int(11) NOT NULL AUTO_INCREMENT,
      `student_id` int(11) NOT NULL,
      `staff_id` int(11) NOT NULL,
      `note_text` text NOT NULL,
      `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
      PRIMARY KEY (`note_id`),
      KEY `student_id` (`student_id`),
      KEY `staff_id` (`staff_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
} catch (PDOException $e) {
    // Ignore error if table exists or cannot be created
}

if ($student_id <= 0) {
    header("Location: enroll_student.php");
    exit;
}

// Handle Add Note Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_note') {
    $note_text = trim($_POST['note_text']);
    if (!empty($note_text)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO student_notes (student_id, staff_id, note_text) VALUES (?, ?, ?)");
            $stmt->execute([$student_id, $staff_id, $note_text]);
            header("Location: view_students.php?id=$student_id&success=note_added");
            exit;
        } catch (PDOException $e) {
            $error_message = "Error adding note: " . $e->getMessage();
        }
    }
}

// Fetch Student Info
$query = "
    SELECT * FROM students WHERE student_id = ?
";
$stmt = $pdo->prepare($query);
$stmt->execute([$student_id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    echo "Student not found.";
    exit;
}

// Fetch Notes
$notes_query = "
    SELECT n.*, s.full_name as staff_name, s.position as staff_position 
    FROM student_notes n 
    JOIN staff s ON n.staff_id = s.staff_id 
    WHERE n.student_id = ? 
    ORDER BY n.created_at DESC
";
$stmt = $pdo->prepare($notes_query);
$stmt->execute([$student_id]);
$notes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch student results
$results_query = "
    SELECT r.*, s.full_name as teacher_name 
    FROM student_results r
    JOIN staff s ON r.staff_id = s.staff_id
    WHERE r.student_id = ?
    ORDER BY r.created_at DESC
";
$stmt = $pdo->prepare($results_query);
$stmt->execute([$student_id]);
$student_results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Map avatar
$avatar = !empty($student['image']) ? '../assets/images/student/' . $student['image'] : 'https://ui-avatars.com/api/?name=' . urlencode($student['full_name']) . '&background=random';

// Format enrollment date
$enrollment_date = date('M d, Y', strtotime($student['created_at']));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student - <?php echo htmlspecialchars($student['full_name']); ?> - T&T School Management</title>
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
        
        /* Student Profile Header */
        .student-profile-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
        }
        
        .student-profile-header h2 {
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
        
        /* Student Profile Container */
        .student-profile-container {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }
        
        @media (max-width: 992px) {
            .student-profile-container {
                grid-template-columns: 1fr;
            }
        }
        
        /* Student Profile Card */
        .student-profile-card {
            background-color: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px var(--shadow);
            position: sticky;
            top: 100px;
            height: fit-content;
        }
        
        .profile-header {
            background: linear-gradient(to right, var(--primary-dark), var(--primary-medium));
            padding: 40px 30px;
            text-align: center;
            color: var(--white);
            position: relative;
        }
        
        .profile-avatar {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 20px;
            border: 5px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .profile-header h3 {
            font-size: 1.5rem;
            color: var(--white);
            margin-bottom: 8px;
        }
        
        .profile-header p {
            opacity: 0.9;
            font-size: 0.95rem;
        }
        
        .profile-status {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        .status-active {
            background-color: rgba(40, 167, 69, 0.9);
        }
        
        .status-inactive {
            background-color: rgba(220, 53, 69, 0.9);
        }
        
        .profile-body {
            padding: 30px;
        }
        
        .profile-detail {
            display: flex;
            justify-content: space-between;
            margin-bottom: 18px;
            padding-bottom: 18px;
            border-bottom: 1px solid #eee;
        }
        
        .profile-detail:last-child {
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
        
        .profile-footer {
            padding: 20px 30px;
            background-color: #f9f9f9;
            border-top: 1px solid #eee;
        }
        
        .emergency-contact h4 {
            font-size: 1rem;
            margin-bottom: 15px;
            color: var(--primary-dark);
        }
        
        .contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 12px;
        }
        
        .contact-item i {
            width: 20px;
            color: var(--primary-medium);
            margin-right: 10px;
            margin-top: 3px;
        }
        
        /* Student Details Tabs */
        .student-details-tabs {
            background-color: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px var(--shadow);
        }
        
        .tabs-header {
            display: flex;
            background-color: var(--light-bg);
            border-bottom: 1px solid #eee;
            overflow-x: auto;
        }
        
        .tab-btn {
            padding: 18px 30px;
            background: none;
            border: none;
            font-weight: 600;
            color: var(--text-light);
            cursor: pointer;
            transition: all 0.3s;
            white-space: nowrap;
            border-bottom: 3px solid transparent;
            display: flex;
            align-items: center;
        }
        
        .tab-btn i {
            margin-right: 10px;
        }
        
        .tab-btn:hover {
            color: var(--primary-medium);
            background-color: rgba(77, 143, 204, 0.05);
        }
        
        .tab-btn.active {
            color: var(--primary-medium);
            border-bottom-color: var(--primary-medium);
            background-color: rgba(77, 143, 204, 0.1);
        }
        
        .tab-content {
            padding: 30px;
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        /* Academic Info */
        .academic-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .academic-card {
            background-color: var(--light-bg);
            border-radius: 10px;
            padding: 20px;
            border-left: 4px solid var(--primary-medium);
        }
        
        .academic-card h4 {
            font-size: 1rem;
            margin-bottom: 10px;
            color: var(--primary-dark);
        }
        
        .academic-card p {
            color: var(--text-light);
            font-size: 0.9rem;
        }
        
        .grades-table-container {
            overflow-x: auto;
            margin-top: 30px;
        }
        
        .grades-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .grades-table thead {
            background-color: var(--light-bg);
        }
        
        .grades-table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: var(--primary-dark);
            border-bottom: 2px solid #eee;
        }
        
        .grades-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .grade-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
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
            background-color: rgba(255, 133, 27, 0.1);
            color: #FF851B;
        }
        
        .grade-f {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger);
        }
        
        /* Attendance */
        .attendance-stats {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .attendance-stat {
            background-color: var(--white);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0, 51, 102, 0.05);
            border: 1px solid #eee;
        }
        
        .attendance-stat h3 {
            font-size: 2rem;
            margin-bottom: 5px;
        }
        
        .attendance-stat p {
            color: var(--text-light);
            font-size: 0.9rem;
        }
        
        /* Behavior Timeline */
        .behavior-timeline {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .behavior-timeline::before {
            content: '';
            position: absolute;
            width: 3px;
            background-color: var(--primary-light);
            top: 0;
            bottom: 0;
            left: 20px;
        }
        
        .behavior-item {
            padding-left: 50px;
            position: relative;
            margin-bottom: 30px;
        }
        
        .behavior-item::before {
            content: '';
            position: absolute;
            width: 15px;
            height: 15px;
            background-color: var(--white);
            border: 3px solid var(--primary-light);
            border-radius: 50%;
            left: 14px;
            top: 5px;
        }
        
        .behavior-content {
            background-color: var(--light-bg);
            border-radius: 10px;
            padding: 20px;
        }
        
        .behavior-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        
        .behavior-title {
            font-weight: 600;
            color: var(--primary-dark);
        }
        
        .behavior-date {
            font-size: 0.85rem;
            color: var(--text-light);
        }
        
        .behavior-description {
            color: var(--text-light);
            font-size: 0.95rem;
            line-height: 1.6;
        }
        
        /* Notes Section */
        .notes-section {
            background-color: var(--white);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 15px var(--shadow);
            margin-bottom: 40px;
        }
        
        .notes-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .notes-header h3 {
            font-size: 1.3rem;
            color: var(--primary-dark);
        }
        
        .notes-list {
            margin-bottom: 25px;
        }
        
        .note-item {
            padding: 20px;
            border-radius: 10px;
            background-color: #f9f9f9;
            margin-bottom: 15px;
            border-left: 4px solid var(--primary-light);
        }
        
        .note-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }
        
        .note-author {
            font-weight: 600;
            color: var(--primary-dark);
        }
        
        .note-date {
            font-size: 0.85rem;
            color: var(--text-light);
        }
        
        .note-content {
            color: var(--text-light);
            font-size: 0.95rem;
            line-height: 1.6;
        }
        
        .note-form textarea {
            width: 100%;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: 'Open Sans', sans-serif;
            font-size: 0.95rem;
            background-color: #f9f9f9;
            min-height: 100px;
            resize: vertical;
            margin-bottom: 15px;
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
            
            .tabs-header {
                flex-wrap: wrap;
            }
            
            .tab-btn {
                padding: 15px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <?php include '../include/staff_sidebar.php'; ?>
        
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
                        <h1>Student Profile</h1>
                    </div>
                </div>
                
                <div class="header-right">
                    <div class="header-action">
                        <i class="fas fa-print" title="Print Profile"></i>
                    </div>
                    <div class="header-action">
                        <i class="fas fa-user-circle"></i>
                    </div>
                </div>
            </div>
            
            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <!-- Student Profile Header -->
                <div class="student-profile-header">
                    <h2><?php echo htmlspecialchars($student['full_name']); ?></h2>
                </div>
                
                <!-- Student Profile Container -->
                <div class="student-profile-container">
                    <!-- Student Profile Card -->
                    <div class="student-profile-card">
                        <div class="profile-header">
                            <div class="profile-status status-active">Active</div>
                            <div class="profile-avatar">
                                <img src="<?php echo $avatar; ?>" alt="<?php echo htmlspecialchars($student['full_name']); ?>">
                            </div>
                            <h3><?php echo htmlspecialchars($student['full_name']); ?></h3>
                            <p><?php echo htmlspecialchars($student['class_name'] ?? 'N/A'); ?> | <?php echo htmlspecialchars($student['session_of_year'] ?? 'N/A'); ?></p>
                            <p style="font-size: 0.9rem; margin-top: 5px;">Admission No: <?php echo htmlspecialchars($student['admission_no']); ?></p>
                        </div>
                        
                        <div class="profile-body">
                            <div class="profile-detail">
                                <span class="detail-label">Email</span>
                                <span class="detail-value"><?php echo htmlspecialchars($student['email']); ?></span>
                            </div>
                            
                            <div class="profile-detail">
                                <span class="detail-label">Age</span>
                                <span class="detail-value"><?php echo htmlspecialchars($student['age']); ?> years</span>
                            </div>
                            
                            <div class="profile-detail">
                                <span class="detail-label">Enrollment Date</span>
                                <span class="detail-value"><?php echo $enrollment_date; ?></span>
                            </div>
                            
                            <div class="profile-detail">
                                <span class="detail-label">Class</span>
                                <span class="detail-value"><?php echo htmlspecialchars($student['class_name'] ?? 'N/A'); ?></span>
                            </div>
                        </div>
                        
                        <div class="profile-footer">
                            <div class="emergency-contact">
                                <h4>Guardian Info</h4>
                                
                                <div class="contact-item">
                                    <i class="fas fa-user"></i>
                                    <div>
                                        <div style="font-weight: 600;"><?php echo htmlspecialchars($student['parent_guardian']); ?></div>
                                        <div style="font-size: 0.85rem; color: var(--text-light);">Guardian</div>
                                    </div>
                                </div>
                                
                                <div class="contact-item">
                                    <i class="fas fa-phone"></i>
                                    <div><?php echo htmlspecialchars($student['contact_number']); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Student Details Tabs -->
                    <div class="student-details-tabs">
                        <div class="tabs-header">
                            <button class="tab-btn active" data-tab="academic">
                                <i class="fas fa-graduation-cap"></i> Academic
                            </button>
                            <button class="tab-btn" data-tab="behavior">
                                <i class="fas fa-chart-line"></i> Behavior
                            </button>
                        </div>
                        
                        <!-- Academic Tab -->
                        <div class="tab-content active" id="academicTab">
                            <h3 style="margin-bottom: 25px;">Academic Information</h3>
                            
                            <div class="academic-info-grid">
                                <div class="academic-card">
                                    <h4>Current Session</h4>
                                    <p style="font-size: 1.5rem; font-weight: 600; color: var(--primary-medium);"><?php echo htmlspecialchars($student['session_of_year']); ?></p>
                                    <p style="font-size: 0.9rem; color: var(--text-light);">Current Level: <?php echo htmlspecialchars($student['class_name']); ?></p>
                                </div>
                                
                                <div class="academic-card">
                                    <h4>Current Grade</h4>
                                    <p style="font-size: 1.5rem; font-weight: 600; color: var(--accent-blue);"><?php echo htmlspecialchars($student['class_name']); ?></p>
                                    <p style="font-size: 0.9rem; color: var(--text-light);">T&T School Management</p>
                                </div>
                            </div>
                            
                            <h4 style="margin: 30px 0 20px;">Recent Course Performance</h4>
                            <div class="grades-table-container">
                                <table class="grades-table">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Teacher</th>
                                            <th>Score</th>
                                            <th>Grade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($student_results)): ?>
                                            <tr>
                                                <td colspan="4" style="text-align: center; color: var(--text-light); padding: 20px;">No results found for this student.</td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($student_results as $res): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($res['subject']); ?> (<?php echo htmlspecialchars($res['test_name']); ?>)</td>
                                                    <td><?php echo htmlspecialchars($res['teacher_name']); ?></td>
                                                    <td><?php echo htmlspecialchars($res['score']); ?></td>
                                                    <td><span class="grade-badge grade-<?php echo strtolower($res['grade']); ?>"><?php echo htmlspecialchars($res['grade']); ?></span></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Behavior Tab -->
                        <div class="tab-content" id="behaviorTab">
                            <h3 style="margin-bottom: 25px;">Behavior & Conduct</h3>
                            
                            <div class="behavior-timeline" id="behaviorTimeline">
                                <?php if (empty($notes)): ?>
                                    <p style="color: var(--text-light); text-align: center; padding: 20px;">No behavior records found for this student.</p>
                                <?php else: ?>
                                    <?php foreach ($notes as $note): ?>
                                        <div class="behavior-item">
                                            <div class="behavior-content">
                                                <div class="behavior-header">
                                                    <div class="behavior-title"><?php echo htmlspecialchars($note['staff_name']); ?> (<?php echo htmlspecialchars($note['staff_position']); ?>)</div>
                                                    <div class="behavior-date"><?php echo date('M d, Y h:i A', strtotime($note['created_at'])); ?></div>
                                                </div>
                                                <div class="behavior-description">
                                                    <?php echo nl2br(htmlspecialchars($note['note_text'])); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Notes Section -->
                <div class="notes-section">
                    <div class="notes-header">
                        <h3>Add Staff Note</h3>
                        <button class="btn btn-secondary" id="addNoteBtn">
                            <i class="fas fa-plus"></i> Add New Note
                        </button>
                    </div>
                    
                    <div class="note-form" id="noteForm" style="display: none;">
                        <form method="POST">
                            <input type="hidden" name="action" value="add_note">
                            <textarea name="note_text" id="newNote" placeholder="Enter behavior or conduct note here..." required></textarea>
                            <div style="display: flex; justify-content: flex-end; gap: 15px;">
                                <button type="button" class="btn btn-secondary" id="cancelNoteBtn">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save Note</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="dashboard-footer">
                    <p>&copy; <?php echo date('Y'); ?> T&T School Management System. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // DOM Elements
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const menuToggle = document.getElementById('menuToggle');
        const tabBtns = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');
        const addNoteBtn = document.getElementById('addNoteBtn');
        const noteForm = document.getElementById('noteForm');
        const cancelNoteBtn = document.getElementById('cancelNoteBtn');
        const newNote = document.getElementById('newNote');
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            setupEventListeners();
            
            // If success message in URL, maybe switch to behavior tab
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('success') === 'note_added') {
                switchTab('behavior');
            }
        });
        
        // Setup event listeners
        function setupEventListeners() {
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
            
            // Tab switching
            tabBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const tabId = btn.dataset.tab;
                    switchTab(tabId);
                });
            });
            
            // Notes functionality
            addNoteBtn.addEventListener('click', () => {
                noteForm.style.display = 'block';
                addNoteBtn.style.display = 'none';
                newNote.focus();
            });
            
            cancelNoteBtn.addEventListener('click', () => {
                noteForm.style.display = 'none';
                addNoteBtn.style.display = 'flex';
                newNote.value = '';
            });
        }
        
        // Switch between tabs
        function switchTab(tabId) {
            tabBtns.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            
            document.querySelector(`[data-tab="${tabId}"]`).classList.add('active');
            document.getElementById(`${tabId}Tab`).classList.add('active');
        }
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if(window.innerWidth >= 992 && sidebar) {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            }
        });
    </script>
</body>
</html>
