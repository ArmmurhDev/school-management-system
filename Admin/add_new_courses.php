<?php
require_once '../auth/session.php';
require_once '../include/config.php';
checkAccess('admin');

$success_message = "";
$error_message = "";

// Fetch dynamic data for dropdowns
$instructors = [];
$classes = [];
$subjects = [];
try {
    $stmt = $pdo->query("SELECT staff_id, full_name FROM staff WHERE position LIKE '%Teacher%' OR position LIKE '%Staff%' ORDER BY full_name ASC");
    $instructors = $stmt->fetchAll();
    
    $stmt = $pdo->query("SELECT subject_name FROM subjects ORDER BY subject_name ASC");
    $subjects = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    $classes = getClasses($pdo);
} catch (PDOException $e) {
    // Handle error
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_name = filter_input(INPUT_POST, 'course_name', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $level = filter_input(INPUT_POST, 'level', FILTER_SANITIZE_STRING);
    $class_name = filter_input(INPUT_POST, 'class_name', FILTER_SANITIZE_STRING);
    $instructor_id = filter_input(INPUT_POST, 'instructor_id', FILTER_SANITIZE_NUMBER_INT);
    $schedule = filter_input(INPUT_POST, 'schedule', FILTER_SANITIZE_STRING);

    if (empty($course_name)) {
        $error_message = "Subject name is required.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO courses (course_name, description, level, class_name, instructor_id, schedule) VALUES (?, ?, ?, ?, ?, ?)");
            if ($stmt->execute([$course_name, $description, $level, $class_name, $instructor_id, $schedule])) {
                $success_message = "Subject registered successfully!";
            } else {
                $error_message = "Failed to register subject.";
            }
        } catch (PDOException $e) {
            $error_message = "Database error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Subject - T&T School Management System</title>
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
            --danger: #dc3545;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Open Sans', sans-serif; background-color: #f5f7fb; overflow-x: hidden; }
        h1, h2 { font-family: 'Poppins', sans-serif; color: var(--primary-dark); }
        .container { display: flex; min-height: 100vh; }
        
        /* Sidebar Styles */
        .sidebar { width: 250px; background-color: var(--sidebar-bg); color: var(--white); transition: all 0.3s ease; position: fixed; height: 100vh; z-index: 100; overflow-y: auto; box-shadow: 3px 0 15px rgba(0, 0, 0, 0.1); }
        .sidebar-header { padding: 25px 20px; display: flex; align-items: center; border-bottom: 1px solid rgba(255, 255, 255, 0.1); }
        .logo-icon { width: 45px; height: 45px; background: linear-gradient(135deg, var(--accent-blue), var(--primary-light)); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 15px; }
        .logo-icon i { font-size: 22px; color: var(--white); }
        .logo-text h2 { font-size: 1.5rem; color: var(--white); margin-bottom: 3px; }
        .logo-text p { font-size: 0.8rem; color: rgba(255, 255, 255, 0.7); }
        .sidebar-menu { padding: 20px 0; }
        .menu-item { padding: 15px 20px; display: flex; align-items: center; cursor: pointer; transition: all 0.3s; text-decoration: none; color: rgba(255, 255, 255, 0.8); border-left: 3px solid transparent; }
        .menu-item:hover, .menu-item.active { background-color: rgba(255, 255, 255, 0.1); color: var(--white); border-left-color: var(--accent-blue); }
        .menu-item i { width: 25px; margin-right: 15px; font-size: 1.1rem; }
        .menu-text { font-size: 0.95rem; font-weight: 500; }
        .sidebar-footer { padding: 20px; border-top: 1px solid rgba(255, 255, 255, 0.1); position: absolute; bottom: 0; width: 100%; }
        .user-info { display: flex; align-items: center; }
        .user-avatar { width: 45px; height: 45px; border-radius: 50%; overflow: hidden; margin-right: 15px; border: 2px solid var(--primary-light); }
        .user-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .user-details h4 { color: var(--white); font-size: 0.95rem; margin-bottom: 3px; }
        .user-details p { color: rgba(255, 255, 255, 0.7); font-size: 0.8rem; }

        .overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 99; display: none; }
        .overlay.active { display: block; }
        
        .main-content { flex: 1; margin-left: 250px; transition: margin-left 0.3s ease; min-height: 100vh; }
        .top-header { background-color: var(--white); padding: 20px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px var(--shadow); position: sticky; top: 0; z-index: 99; }
        .header-left { display: flex; align-items: center; }
        .menu-toggle { background: none; border: none; font-size: 1.5rem; color: var(--primary-dark); cursor: pointer; margin-right: 20px; display: none; }
        .page-title h1 { font-size: 1.8rem; color: var(--primary-dark); }
        .header-right { display: flex; align-items: center; }
        .header-action { margin-left: 25px; position: relative; cursor: pointer; }
        .header-action i { font-size: 1.3rem; color: var(--primary-medium); transition: color 0.3s; }
        .header-action:hover i { color: var(--accent-blue); }

        .dashboard-content { padding: 30px; }
        .registration-card { background: white; border-radius: 15px; box-shadow: var(--shadow); overflow: hidden; max-width: 900px; margin: 0 auto; }
        .card-header { background: linear-gradient(to right, var(--primary-dark), var(--primary-medium)); padding: 25px; color: white; }
        .card-body { padding: 30px; }
        
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 600; color: var(--primary-dark); }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 0.95rem; }
        .form-group textarea { min-height: 100px; resize: vertical; }
        
        .btn { display: inline-flex; align-items: center; padding: 12px 24px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: 0.3s; text-decoration: none; border: none; }
        .btn-primary { background: linear-gradient(to right, var(--primary-dark), var(--primary-medium)); color: white; width: 100%; justify-content: center; }
        .btn-secondary { background-color: var(--light-bg); color: var(--primary-medium); border: 1px solid var(--primary-light); margin-bottom: 20px; }
        
        .alert { padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); width: 280px; }
            .sidebar.active { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .menu-toggle { display: block; }
        }
        @media (max-width: 600px) { .form-row { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <div class="container">
        <?php include '../include/admin_sidebar.php'; ?>
        <div class="overlay" id="overlay"></div>
        
        <div class="main-content" id="mainContent">
            <div class="top-header">
                <div class="header-left">
                    <button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
                    <div class="page-title"><h1>Course Management</h1></div>
                </div>
                <div class="header-right">
                    <div class="header-action"><i class="fas fa-search"></i></div>
                    <div class="header-action"><i class="fas fa-bell"></i></div>
                    <div class="header-action"><i class="fas fa-user-circle"></i></div>
                </div>
            </div>
            
            <div class="dashboard-content">
                <div style="max-width: 900px; margin: 0 auto;">
                    <a href="manage_courses.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Course List
                    </a>

                    <?php if ($success_message): ?>
                        <div class="alert alert-success"><?php echo $success_message; ?></div>
                    <?php endif; ?>
                    <?php if ($error_message): ?>
                        <div class="alert alert-danger"><?php echo $error_message; ?></div>
                    <?php endif; ?>

                    <div class="registration-card">
                        <div class="card-header">
                            <h2><i class="fas fa-plus-circle"></i> Register New Subject</h2>
                            <p style="opacity: 0.8; font-size: 0.9rem;">Fill in the details below to create a new academic subject.</p>
                        </div>
                        <div class="card-body">
                            <form action="add_new_courses.php" method="POST">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label>Subject Name *</label>
                                        <select name="course_name" required>
                                            <option value="">Select Subject</option>
                                            <?php foreach ($subjects as $subject): ?>
                                                <option value="<?php echo htmlspecialchars($subject); ?>"><?php echo htmlspecialchars($subject); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Class *</label>
                                        <select name="class_name" required>
                                            <option value="">Select Class</option>
                                            <?php foreach ($classes as $c): ?>
                                                <option value="<?php echo $c; ?>"><?php echo $c; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Subject Description</label>
                                    <textarea name="description" placeholder="Describe the subject content..."></textarea>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label>Subject Level</label>
                                        <select name="level">
                                            <option value="beginner">Beginner</option>
                                            <option value="intermediate">Intermediate</option>
                                            <option value="advanced">Advanced</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Instructor</label>
                                        <select name="instructor_id">
                                            <option value="">Select Instructor</option>
                                            <?php foreach ($instructors as $ins): ?>
                                                <option value="<?php echo $ins['staff_id']; ?>"><?php echo $ins['full_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Schedule</label>
                                    <input type="text" name="schedule" placeholder="e.g. Mon/Wed 10:00 AM">
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Register New Subject
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const menuToggle = document.getElementById('menuToggle');
        
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
    </script>
</body>
</html>