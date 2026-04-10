<?php
require_once '../auth/session.php';
require_once '../include/config.php';
checkAccess('staff');

$staff_id = $_SESSION['user_id'];

// Create student_results table if not exists
try {
    $pdo->query("CREATE TABLE IF NOT EXISTS `student_results` (
      `result_id` int(11) NOT NULL AUTO_INCREMENT,
      `student_id` int(11) NOT NULL,
      `staff_id` int(11) NOT NULL,
      `subject` varchar(100) NOT NULL,
      `test_name` varchar(100) NOT NULL,
      `score` decimal(5,2) NOT NULL,
      `grade` varchar(2) NOT NULL,
      `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
      PRIMARY KEY (`result_id`),
      KEY `student_id` (`student_id`),
      KEY `staff_id` (`staff_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
} catch (PDOException $e) {
    // Ignore error
}

// Fetch staff info
$query = "SELECT * FROM staff WHERE staff_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$staff_id]);
$staff = $stmt->fetch(PDO::FETCH_ASSOC);

$staff_name_display = $staff['full_name'] ?? 'Staff Member';
$staff_subject = $staff['subject'] ?? '';

// Handle Add Result Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_result') {
    $student_id = intval($_POST['student_id']);
    $subject = $staff_subject;
    $test_name = trim($_POST['test_name']);
    $score = floatval($_POST['score']);
    $result_date = $_POST['result_date'];

    // Grading Logic: > 80 is A, else > 70 is B, else > 60 is C, else > 35 is D, < 34 is F
    $grade = 'F';
    if ($score > 80) $grade = 'A';
    elseif ($score > 70) $grade = 'B';
    elseif ($score > 60) $grade = 'C';
    elseif ($score > 35) $grade = 'D';
    else $grade = 'F';

    if ($student_id > 0 && !empty($test_name)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO student_results (student_id, staff_id, subject, test_name, score, grade, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$student_id, $staff_id, $subject, $test_name, $score, $grade, $result_date]);
            header("Location: enter_results.php?success=1");
            exit;
        } catch (PDOException $e) {
            $error_message = "Error adding result: " . $e->getMessage();
        }
    }
}

// Handle Delete
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    $stmt = $pdo->prepare("DELETE FROM student_results WHERE result_id = ? AND staff_id = ?");
    $stmt->execute([$delete_id, $staff_id]);
    header("Location: enter_results.php?deleted=1");
    exit;
}

// Fetch Enrolled Students for this Staff's courses
// We assume staff is instructor for courses, and students register for those courses
$students_query = "
    SELECT DISTINCT s.student_id, s.full_name 
    FROM students s
    JOIN course_registrations cr ON s.student_id = cr.student_id
    JOIN courses c ON cr.course_id = c.course_id
    WHERE c.instructor_id = ?
    ORDER BY s.full_name ASC
";
$stmt = $pdo->prepare($students_query);
$stmt->execute([$staff_id]);
$enrolled_students = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch existing results for this staff
$results_query = "
    SELECT r.*, s.full_name as student_name 
    FROM student_results r
    JOIN students s ON r.student_id = s.student_id
    WHERE r.staff_id = ?
    ORDER BY r.created_at DESC
";
$stmt = $pdo->prepare($results_query);
$stmt->execute([$staff_id]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Results Entry - T&T School Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            background-color: #f5f7fb;
            color: var(--text-dark);
            overflow-x: hidden;
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
            padding: 30px;
            min-height: 100vh;
        }

        /* Overlay for mobile */
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

        /* Top Header (Top Bar) */
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
            margin-bottom: 30px;
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
            font-family: 'Poppins', sans-serif;
            font-size: 1.8rem;
            color: var(--primary-dark);
        }

        .staff-badge {
            background: var(--light-bg);
            padding: 8px 20px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--primary-dark);
            border: 1px solid var(--primary-light);
        }

        /* cards & forms */
        .card {
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 5px 15px var(--shadow);
            margin-bottom: 30px;
            overflow: hidden;
        }

        .card-header {
            padding: 20px 25px;
            background-color: #f9f9f9;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-header h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.3rem;
            color: var(--primary-dark);
            margin: 0;
        }

        .card-body {
            padding: 25px;
        }

        /* form grid */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .input-group label {
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--primary-dark);
        }

        .input-group input, .input-group select {
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: 'Open Sans', sans-serif;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .input-group input:focus, .input-group select:focus {
            outline: none;
            border-color: var(--primary-medium);
            box-shadow: 0 0 0 3px rgba(0, 80, 158, 0.1);
        }

        .btn {
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(to right, var(--primary-dark), var(--primary-medium));
            color: white;
            box-shadow: 0 4px 10px rgba(0, 51, 102, 0.1);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 51, 102, 0.2);
        }

        .btn-outline {
            background-color: var(--light-bg);
            color: var(--primary-medium);
            border: 1px solid var(--primary-light);
        }

        .btn-outline:hover {
            background-color: #e3f2fd;
        }

        /* table wrapper */
        .table-wrapper {
            overflow-x: auto;
        }

        .results-table {
            width: 100%;
            border-collapse: collapse;
        }

        .results-table th {
            text-align: left;
            padding: 15px;
            background-color: var(--light-bg);
            color: var(--primary-dark);
            font-weight: 600;
            border-bottom: 2px solid #eee;
        }

        .results-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .grade-badge {
            background: rgba(40, 167, 69, 0.1);
            color: var(--success);
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .action-icons {
            display: flex;
            gap: 10px;
        }

        .action-icons i {
            padding: 8px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .delete-icon { color: var(--danger); background: rgba(220, 53, 69, 0.1); }

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
        }
    </style>
</head>
<body>
<div class="container">
    <?php include '../include/staff_sidebar.php'; ?>
    
    <!-- Overlay for mobile -->
    <div class="overlay" id="overlay"></div>
    
    <div class="main-content">
        <!-- Top Header -->
        <div class="top-header">
            <div class="header-left">
                <button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
                <div class="page-title">
                    <h1>Results Entry</h1>
                </div>
            </div>
            <div class="staff-badge">
                <i class="fas fa-user-check"></i>
                <span><?php echo htmlspecialchars($staff_name_display); ?></span>
            </div>
        </div>

        <?php if (isset($_GET['success'])): ?>
            <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                <i class="fas fa-check-circle"></i> Result added successfully!
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['deleted'])): ?>
            <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                <i class="fas fa-trash"></i> Result deleted successfully!
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header">
                <h2><i class="fas fa-upload"></i> Upload New Test Result</h2>
            </div>
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" name="action" value="add_result">
                    <div class="form-grid">
                        <div class="input-group">
                            <label>Student Name *</label>
                            <select name="student_id" required>
                                <option value="">Select Student</option>
                                <?php foreach ($enrolled_students as $std): ?>
                                    <option value="<?php echo $std['student_id']; ?>"><?php echo htmlspecialchars($std['full_name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="input-group">
                            <label>Subject *</label>
                            <input type="text" name="subject" value="<?php echo htmlspecialchars($staff_subject); ?>" readonly style="background-color: #f0f0f0;">
                        </div>
                        <div class="input-group">
                            <label>Test Name *</label>
                            <input type="text" name="test_name" placeholder="e.g. Midterm" required>
                        </div>
                        <div class="input-group">
                            <label>Score (%) *</label>
                            <input type="number" name="score" min="0" max="100" step="0.01" placeholder="0-100" required>
                        </div>
                        <div class="input-group">
                            <label>Date</label>
                            <input type="date" name="result_date" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                    </div>
                    <div style="display: flex; justify-content: flex-end; gap: 15px;">
                        <button type="reset" class="btn btn-outline">Clear</button>
                        <button type="submit" class="btn btn-primary">Save Result</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2><i class="fas fa-table-list"></i> Uploaded Results</h2>
                <div><span><?php echo count($results); ?></span> records</div>
            </div>
            <div class="card-body">
                <div class="table-wrapper">
                    <table class="results-table">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Subject</th>
                                <th>Test</th>
                                <th>Score</th>
                                <th>Grade</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($results)): ?>
                                <tr>
                                    <td colspan="7" style="text-align:center; padding: 30px;">No results found</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($results as $res): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($res['student_name']); ?></td>
                                        <td><?php echo htmlspecialchars($res['subject']); ?></td>
                                        <td><?php echo htmlspecialchars($res['test_name']); ?></td>
                                        <td><strong><?php echo number_format($res['score'], 1); ?>%</strong></td>
                                        <td><span class="grade-badge"><?php echo $res['grade']; ?></span></td>
                                        <td><?php echo date('M d, Y', strtotime($res['created_at'])); ?></td>
                                        <td class="action-icons">
                                            <a href="?delete=<?php echo $res['result_id']; ?>" onclick="return confirm('Delete this result?')" class="delete-icon" style="text-decoration: none;">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // DOM Elements
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

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