<?php
require_once '../auth/session.php';
require_once '../include/config.php';
checkAccess('admin');

// Get student ID from URL
$student_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($student_id <= 0) {
    header("Location: upload_results.php");
    exit;
}

// Fetch student details
$stmt = $pdo->prepare("SELECT * FROM students WHERE student_id = ?");
$stmt->execute([$student_id]);
$student = $stmt->fetch();

if (!$student) {
    header("Location: upload_results.php");
    exit;
}

// Fetch student results with staff info
$stmt = $pdo->prepare("
    SELECT r.*, st.full_name as staff_name, st.image as staff_image
    FROM student_results r
    LEFT JOIN staff st ON r.staff_id = st.staff_id
    WHERE r.student_id = ?
    ORDER BY r.subject ASC
");
$stmt->execute([$student_id]);
$results = $stmt->fetchAll();

// Calculate Average
$totalScore = 0;
$count = count($results);
foreach ($results as $res) {
    $totalScore += $res['score'];
}
$average = $count > 0 ? round($totalScore / $count, 1) : 0;

// Helper grade remark logic if not in DB
function getRemark($grade) {
    switch ($grade) {
        case 'A': return 'Excellent';
        case 'B': return 'Very Good';
        case 'C': return 'Good';
        case 'D': return 'Fair';
        case 'F': return 'Poor';
        default: return 'N/A';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <title><?php echo htmlspecialchars($student['full_name']); ?> · Result Slip | T&T School</title>
    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* ----- T&T COLOR SCHEME (exact) ----- */
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

        h1, h2, h3, h4 {
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

        /* ----- MAIN CONTENT ----- */
        .main-content {
            flex: 1;
            margin-left: 250px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

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

        .dashboard-content {
            padding: 30px;
            flex: 1;
        }

        /* ----- STUDENT RESULT SPECIFIC ----- */
        .student-profile-header {
            background: var(--white);
            border-radius: 24px;
            padding: 28px 30px;
            box-shadow: 0 12px 24px var(--shadow);
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px 30px;
            border-left: 8px solid var(--primary-medium);
        }

        .student-avatar-large {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--light-bg);
        }

        .student-details h2 {
            font-size: 2rem;
            margin-bottom: 6px;
        }

        .student-details .meta {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            color: var(--text-light);
        }

        .student-details .meta i {
            margin-right: 6px;
            color: var(--primary-medium);
        }

        .academic-summary {
            margin-left: auto;
            background: var(--light-bg);
            padding: 12px 24px;
            border-radius: 40px;
            text-align: center;
        }

        .academic-summary .term {
            font-weight: 600;
            color: var(--primary-dark);
        }

        /* Table container */
        .table-container {
            background: var(--white);
            border-radius: 24px;
            box-shadow: 0 15px 30px var(--shadow);
            overflow: hidden;
        }

        .table-header {
            padding: 20px 28px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .table-header h3 {
            font-size: 1.3rem;
        }

        .result-badge {
            background: var(--success);
            color: white;
            padding: 6px 16px;
            border-radius: 30px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .result-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        .result-table thead {
            background: var(--light-bg);
        }

        .result-table th {
            padding: 18px 22px;
            text-align: left;
            font-weight: 600;
            color: var(--primary-dark);
            border-bottom: 2px solid #e0e7ef;
            white-space: nowrap;
            font-size: 0.95rem;
        }

        .result-table td {
            padding: 18px 22px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        .result-table tbody tr:hover {
            background-color: #fafcff;
        }

        .subject-cell {
            font-weight: 600;
        }

        .grade-badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .grade-a { background: #d4edda; color: #155724; }
        .grade-b { background: #fff3cd; color: #856404; }
        .grade-c { background: #f8d7da; color: #721c24; }
        .grade-d { background: #e2e3e5; color: #383d41; }

        .staff-info {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .staff-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* summary row */
        .summary-row {
            background: #f9fcff;
            font-weight: 600;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            box-shadow: 0 4px 10px var(--shadow);
            background: var(--white);
            color: var(--primary-medium);
            border: 1px solid var(--primary-light);
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(to right, var(--primary-dark), var(--primary-medium));
            color: white;
            border: none;
        }

        .dashboard-footer {
            margin-top: 40px;
            padding: 20px 30px;
            text-align: center;
            color: var(--text-light);
            font-size: 0.9rem;
            border-top: 1px solid #eee;
            background: var(--white);
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
        }

        /* Mobile */
        @media (max-width: 700px) {
            .top-header { padding: 16px 20px; }
            .dashboard-content { padding: 20px 16px; }
            .student-profile-header { flex-direction: column; align-items: flex-start; }
            .academic-summary { margin-left: 0; width: 100%; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <?php include '../include/admin_sidebar.php'; ?>
        
        <!-- Overlay for mobile -->
        <div class="overlay" id="overlay"></div>

        <div class="main-content" id="mainContent">
            <!-- Top Header -->
            <div class="top-header">
                <div class="header-left">
                    <button class="menu-toggle" id="menuToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <a href="upload_results.php" style="margin-right: 20px; color: var(--primary-dark); font-size: 1.2rem; display: flex; align-items: center; text-decoration: none;">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <div class="page-title">
                        <h1>Student Result Slip</h1>
                    </div>
                </div>
                <div class="header-right">
                    <div class="header-action"><i class="fas fa-print"></i></div>
                    <div class="header-action"><i class="fas fa-download"></i></div>
                    <div class="header-action"><i class="fas fa-user-graduate"></i></div>
                </div>
            </div>

            <div class="dashboard-content">
                <!-- Student Profile Summary -->
                <div class="student-profile-header">
                    <?php 
                    $student_img = !empty($student['image']) ? '../assets/images/student/'.$student['image'] : 'https://ui-avatars.com/api/?name='.urlencode($student['full_name']).'&background=random';
                    ?>
                    <img class="student-avatar-large" src="<?php echo $student_img; ?>" alt="">
                    <div class="student-details">
                        <h2><?php echo htmlspecialchars($student['full_name']); ?></h2>
                        <div class="meta">
                            <span><i class="fas fa-id-card"></i> <?php echo htmlspecialchars($student['admission_no']); ?></span>
                            <span><i class="fas fa-graduation-cap"></i> <?php echo htmlspecialchars($student['class_name'] ?? 'N/A'); ?></span>
                            <span><i class="fas fa-calendar-alt"></i> <?php echo htmlspecialchars($student['session_of_year'] ?? 'N/A'); ?></span>
                        </div>
                    </div>
                    <div class="academic-summary">
                        <div class="term"><i class="far fa-calendar-alt"></i> Current Session Overview</div>
                        <div style="font-size: 1.8rem; font-weight: 700; color: var(--primary-dark);"><?php echo $average; ?><span style="font-size:1rem;">%</span></div>
                        <div>Average Score</div>
                    </div>
                </div>

                <!-- Results Table -->
                <div class="table-container">
                    <div class="table-header">
                        <h3><i class="fas fa-book"></i> Subject Performance</h3>
                        <?php if ($isReleased): ?>
                            <span class="result-badge"><i class="fas fa-check-circle"></i> Results Released</span>
                        <?php else: ?>
                            <span class="result-badge" style="background: var(--warning);"><i class="fas fa-clock"></i> Not Released</span>
                        <?php endif; ?>
                    </div>
                    <div class="table-responsive">
                        <table class="result-table" id="resultTable">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>CA (40)</th>
                                    <th>Exam (60)</th>
                                    <th>Total (100)</th>
                                    <th>Grade</th>
                                    <th>Remark</th>
                                    <th>Staff</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($results)): ?>
                                    <tr><td colspan="7" style="text-align: center; padding: 30px;">No results recorded yet.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($results as $res): ?>
                                        <tr>
                                            <td class="subject-cell"><?php echo htmlspecialchars($res['subject']); ?></td>
                                            <td><?php echo number_format($res['ca_score'], 1); ?></td>
                                            <td><?php echo number_format($res['exam_score'], 1); ?></td>
                                            <td><strong><?php echo number_format($res['score'], 1); ?></strong></td>
                                            <td><span class="grade-badge grade-<?php echo strtolower($res['grade']); ?>"><?php echo $res['grade']; ?></span></td>
                                            <td><?php echo getRemark($res['grade']); ?></td>
                                            <td>
                                                <div class="staff-info">
                                                    <?php 
                                                    $staff_img = !empty($res['staff_image']) ? '../assets/images/staff/'.$res['staff_image'] : 'https://ui-avatars.com/api/?name='.urlencode($res['staff_name']).'&background=random';
                                                    ?>
                                                    <img class="staff-avatar" src="<?php echo $staff_img; ?>" alt="">
                                                    <span><?php echo htmlspecialchars($res['staff_name'] ?? 'N/A'); ?></span>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <!-- Summary Average Row -->
                                    <tr class="summary-row">
                                        <td colspan="3" style="text-align: right; font-weight: 700;">Overall Average</td>
                                        <td><strong><?php echo $average; ?>%</strong></td>
                                        <td colspan="3"></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Action buttons -->
                <div style="display: flex; justify-content: flex-end; gap: 15px; margin-top: 25px;">
                    <button class="btn" onclick="window.print()"><i class="fas fa-print"></i> Print Slip</button>
                    <button class="btn btn-primary" id="downloadPdfBtn"><i class="fas fa-file-pdf"></i> Download PDF</button>
                </div>

                <div class="dashboard-footer">
                    <p>© 2025 T&T School Management System · Official Result Slip</p>
                </div>
            </div>
        </div>
    </div>

<script>
    (function() {
        // Sidebar Toggle Logic
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

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

        // Download PDF simulation
        document.getElementById('downloadPdfBtn').addEventListener('click', function() {
            alert('📄 PDF generation started. Your result slip will download shortly. (Demo)');
        });
    })();
</script>
</body>
</html>