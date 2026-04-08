<?php
require_once '../auth/session.php';
require_once '../include/config.php';
checkAccess('student');

// Get current student ID from session
$student_id = $_SESSION['user_id'];

// --- AUTO-FIX: Ensure course_registrations table exists ---
try {
    $pdo->query("SELECT 1 FROM course_registrations LIMIT 1");
} catch (PDOException $e) {
    $pdo->exec("CREATE TABLE IF NOT EXISTS course_registrations (
        registration_id INT AUTO_INCREMENT PRIMARY KEY,
        student_id INT NOT NULL,
        course_id INT NOT NULL,
        registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        UNIQUE KEY student_course (student_id, course_id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
}

$message = "";
$is_error = false;

// Handle Course Registration
if (isset($_POST['register_course_id'])) {
    $course_id = $_POST['register_course_id'];
    try {
        $stmt = $pdo->prepare("INSERT INTO course_registrations (student_id, course_id) VALUES (?, ?)");
        if ($stmt->execute([$student_id, $course_id])) {
            $message = "Course registered successfully!";
        }
    } catch (PDOException $e) {
        $message = "Registration failed: " . $e->getMessage();
        $is_error = true;
    }
}

// Handle Course Dropping
if (isset($_POST['drop_course_id'])) {
    $course_id = $_POST['drop_course_id'];
    try {
        $stmt = $pdo->prepare("DELETE FROM course_registrations WHERE student_id = ? AND course_id = ?");
        if ($stmt->execute([$student_id, $course_id])) {
            $message = "Course dropped successfully.";
        }
    } catch (PDOException $e) {
        $message = "Failed to drop course: " . $e->getMessage();
        $is_error = true;
    }
}

// Fetch Student Info
$stmt = $pdo->prepare("SELECT * FROM students WHERE student_id = ?");
$stmt->execute([$student_id]);
$student = $stmt->fetch();

// Fetch Available Courses matching student's specific class (SS1, SS2, or SS3)
$stmt = $pdo->prepare("SELECT c.*, s.full_name as instructor_name FROM courses c LEFT JOIN staff s ON c.instructor_id = s.staff_id WHERE c.class_name = ? ORDER BY c.course_name ASC");
$stmt->execute([$student['class_name']]);
$all_courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch Registered Course IDs for current student
$stmt = $pdo->prepare("SELECT course_id FROM course_registrations WHERE student_id = ?");
$stmt->execute([$student_id]);
$registered_ids = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Prepare course data for JavaScript
$courses_json = json_encode($all_courses);
$registered_ids_json = json_encode($registered_ids);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses - T&T School Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/student-dashboard.css">
    <style>
        /* Unique styles for My Courses Hub */
        .header-glow {
            background: linear-gradient(115deg, var(--primary-dark) 0%, var(--primary-medium) 100%);
            padding: 28px 42px;
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            color: white;
            margin-bottom: 30px;
        }

        .header-glow::after {
            content: "📚";
            font-size: 100px;
            opacity: 0.08;
            position: absolute;
            bottom: -10px;
            right: 10px;
            pointer-events: none;
        }

        .student-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .welcome-badge h2 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: white;
            margin-bottom: 8px;
        }

        .welcome-badge p {
            color: rgba(255,255,255,0.85);
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .student-id-badge {
            background: rgba(255,255,255,0.18);
            backdrop-filter: blur(2px);
            padding: 4px 12px;
            border-radius: 60px;
            font-size: 0.8rem;
        }

        .stats-mini {
            display: flex;
            gap: 20px;
            background: rgba(255,255,255,0.12);
            padding: 10px 20px;
            border-radius: 40px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-weight: 800;
            font-size: 1.4rem;
            color: white;
        }

        .stat-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            color: rgba(255,255,240,0.8);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: var(--primary-light);
        }

        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .course-card {
            background: var(--white);
            border-radius: 20px;
            box-shadow: var(--shadow);
            transition: all 0.25s ease;
            border: 1px solid rgba(77, 143, 204, 0.2);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 51, 102, 0.1);
        }

        .card-body {
            padding: 20px;
            flex: 1;
        }

        .course-badge {
            display: inline-block;
            background: var(--light-bg);
            color: var(--primary-medium);
            font-size: 0.7rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 30px;
            margin-bottom: 12px;
        }

        .course-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 5px;
        }

        .course-code {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--primary-light);
            background: rgba(77,143,204,0.1);
            padding: 2px 8px;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 10px;
        }

        .course-description {
            font-size: 0.85rem;
            color: var(--text-light);
            margin-bottom: 15px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .course-details {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .detail-row {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.85rem;
            color: var(--text-light);
        }

        .detail-row i {
            width: 20px;
            color: var(--primary-light);
        }

        .credits-chip {
            background: #eef2fa;
            padding: 4px 10px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.7rem;
            color: var(--primary-dark);
        }

        .card-actions {
            padding: 15px 20px 20px;
            border-top: 1px solid rgba(0, 81, 158, 0.05);
            display: flex;
            gap: 10px;
        }

        .btn-sm {
            padding: 8px 15px;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            transition: 0.2s;
        }

        .btn-register {
            background: linear-gradient(95deg, var(--primary-medium), var(--primary-light));
            color: white;
        }

        .btn-drop {
            background: transparent;
            border: 1px solid #ffcdd2;
            color: var(--danger);
        }

        .btn-drop:hover {
            background: #ffebee;
        }

        .toast-msg {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--primary-dark);
            color: white;
            padding: 12px 25px;
            border-radius: 50px;
            font-size: 0.9rem;
            z-index: 1000;
            opacity: 0;
            transition: 0.3s;
            pointer-events: none;
        }

        .toast-msg.show {
            opacity: 1;
            bottom: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <?php include '../include/student-sidebar.php'; ?>
        
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
                        <h1>My Course Hub</h1>
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
                <?php if ($message): ?>
                    <div class="alert <?php echo $is_error ? 'alert-danger' : 'alert-success'; ?>" style="padding: 15px; border-radius: 10px; margin-bottom: 20px; background: <?php echo $is_error ? '#f8d7da' : '#d4edda'; ?>; color: <?php echo $is_error ? '#721c24' : '#155724'; ?>; border: 1px solid <?php echo $is_error ? '#f5c6cb' : '#c3e6cb'; ?>;">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>

                <!-- Header Glow -->
                <div class="header-glow">
                    <div class="student-info">
                        <div class="welcome-badge">
                            <h2><i class="fas fa-graduation-cap" style="margin-right: 12px;"></i> My Course Studio</h2>
                            <p><?php echo htmlspecialchars($student['full_name']); ?> · <span class="student-id-badge"><?php echo htmlspecialchars($student['admission_no']); ?></span> <span><?php echo htmlspecialchars($student['email']); ?></span></p>
                        </div>
                        <div class="stats-mini">
                            <div class="stat-item"><div class="stat-number" id="totalCoursesStat">0</div><div class="stat-label">Enrolled</div></div>
                        </div>
                    </div>
                </div>

                <!-- Enrolled Courses -->
                <div class="section-header">
                    <div class="section-title">
                        <i class="fas fa-book-open"></i> My Registered Courses
                    </div>
                </div>

                <div id="registeredCoursesContainer" class="courses-grid">
                    <!-- Cards will be injected by JS -->
                </div>

                <!-- Available Courses -->
                <div class="section-header">
                    <div class="section-title">
                        <i class="fas fa-compass"></i> Explore & Register
                    </div>
                </div>

                <div id="availableCoursesContainer" class="courses-grid">
                    <!-- Cards will be injected by JS -->
                </div>

                <!-- Hidden forms for registration/dropping -->
                <form id="regForm" method="POST" style="display:none;"><input type="hidden" name="register_course_id" id="regCourseId"></form>
                <form id="dropForm" method="POST" style="display:none;"><input type="hidden" name="drop_course_id" id="dropCourseId"></form>

                <!-- Footer -->
                <div class="dashboard-footer">
                    <p>&copy; 2023 T&T School Management System. All rights reserved. | Student Portal v2.3</p>
                </div>
            </div>
        </div>
    </div>

    <div id="toastMsg" class="toast-msg"></div>

    <script>
        // DOM Elements
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const menuToggle = document.getElementById('menuToggle');
        
        // Sidebar Toggle
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

        window.addEventListener('resize', function() {
            if(window.innerWidth >= 992) {
                if (sidebar) sidebar.classList.remove('active');
                if (overlay) overlay.classList.remove('active');
            }
        });

        // Dynamic Course Data from PHP
        const allCourses = <?php echo $courses_json; ?>.map(c => ({
            id: c.course_id,
            code: c.course_name.split(' ').map(w => w[0]).join('').toUpperCase(), // Generate a short code
            name: c.course_name,
            instructor: c.instructor_name || 'Not Assigned',
            className: c.class_name || 'All Classes',
            credits: c.level === 'advanced' ? 4 : (c.level === 'intermediate' ? 3 : 2), // Mock units
            schedule: c.schedule || 'TBA',
            description: c.description || 'No description available.'
        }));

        let registeredIds = new Set(<?php echo $registered_ids_json; ?>.map(id => id.toString()));

        function renderAll() {
            renderRegistered();
            renderAvailable();
            updateStats();
        }

        function renderRegistered() {
            const container = document.getElementById('registeredCoursesContainer');
            const registered = allCourses.filter(c => registeredIds.has(c.id.toString()));
            
            if (registered.length === 0) {
                container.innerHTML = '<p style="grid-column: 1/-1; text-align: center; padding: 40px; color: #666; background: white; border-radius: 20px;">You haven\'t registered for any courses yet.</p>';
                return;
            }

            container.innerHTML = registered.map(course => `
                <div class="course-card">
                    <div class="card-body">
                        <div style="display:flex; justify-content: space-between; align-items:center;">
                            <span class="course-badge"><i class="fas fa-check-circle"></i> Enrolled</span>
                            <span class="credits-chip">${course.className}</span>
                        </div>
                        <h3 class="course-title">${course.name}</h3>
                        <span class="course-code">${course.code}</span>
                        <p class="course-description">${course.description}</p>
                        <div class="course-details">
                            <div class="detail-row"><i class="fas fa-user-tie"></i> <span>${course.instructor}</span></div>
                            <div class="detail-row"><i class="far fa-clock"></i> <span>${course.schedule}</span></div>
                        </div>
                    </div>
                    <div class="card-actions">
                        <button class="btn-sm btn-drop" onclick="dropCourse('${course.id}')"><i class="fas fa-trash-alt"></i> Drop Course</button>
                    </div>
                </div>
            `).join('');
        }

        function renderAvailable() {
            const container = document.getElementById('availableCoursesContainer');
            const available = allCourses.filter(c => !registeredIds.has(c.id.toString()));
            
            if (available.length === 0) {
                container.innerHTML = '<p style="grid-column: 1/-1; text-align: center; padding: 40px; color: #666; background: white; border-radius: 20px;">No available courses at the moment.</p>';
                return;
            }

            container.innerHTML = available.map(course => `
                <div class="course-card">
                    <div class="card-body">
                        <div style="display:flex; justify-content: space-between;">
                            <span class="course-badge"><i class="fas fa-star"></i> Available</span>
                            <span class="credits-chip">${course.className}</span>
                        </div>
                        <h3 class="course-title">${course.name}</h3>
                        <span class="course-code">${course.code}</span>
                        <p class="course-description">${course.description}</p>
                        <div class="course-details">
                            <div class="detail-row"><i class="fas fa-user-tie"></i> ${course.instructor}</div>
                            <div class="detail-row"><i class="far fa-calendar-alt"></i> ${course.schedule}</div>
                        </div>
                    </div>
                    <div class="card-actions">
                        <button class="btn-sm btn-register" onclick="registerCourse('${course.id}')"><i class="fas fa-plus-circle"></i> Register Now</button>
                    </div>
                </div>
            `).join('');
        }

        function registerCourse(id) {
            document.getElementById('regCourseId').value = id;
            document.getElementById('regForm').submit();
        }

        function dropCourse(id) {
            if (confirm("Are you sure you want to drop this course?")) {
                document.getElementById('dropCourseId').value = id;
                document.getElementById('dropForm').submit();
            }
        }

        function updateStats() {
            const registered = allCourses.filter(c => registeredIds.has(c.id.toString()));
            document.getElementById('totalCoursesStat').innerText = registered.length;
        }

        renderAll();
    </script>
</body>
</html>
