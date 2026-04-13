<?php
require_once '../auth/session.php';
require_once '../include/config.php';
checkAccess('admin');

// Fetch Stats
$total_students = $pdo->query("SELECT COUNT(*) FROM students")->fetchColumn();
$total_teachers = $pdo->query("SELECT COUNT(*) FROM staff")->fetchColumn();
$annual_revenue = $pdo->query("SELECT SUM(amount) FROM payments WHERE status = 'success' AND YEAR(created_at) = YEAR(CURRENT_DATE)")->fetchColumn() ?: 0;

// Enrollment Trend (Last 12 Months)
$enrollment_data = [];
$months = [];
for ($i = 11; $i >= 0; $i--) {
    $date = date('Y-m', strtotime("-$i months"));
    $month_name = date('M Y', strtotime("-$i months"));
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM students WHERE DATE_FORMAT(created_at, '%Y-%m') = ?");
    $stmt->execute([$date]);
    $enrollment_data[] = $stmt->fetchColumn();
    $months[] = $month_name;
}

// Fee Collection Status (Paid vs Unpaid)
$school_fee = $pdo->query("SELECT fee_amount FROM school_fees WHERE fee_id = 1")->fetchColumn() ?: 47000;
$paid_students = $pdo->query("SELECT COUNT(*) FROM (SELECT student_id FROM payments WHERE status = 'success' GROUP BY student_id HAVING SUM(amount) >= $school_fee) as paid_count")->fetchColumn();
$unpaid_students = max(0, $total_students - $paid_students);

// Recent Activity (Last 24 Hours)
$activities = [];

// New Students
$stmt = $pdo->query("SELECT full_name, created_at, 'student' as type FROM students WHERE created_at >= NOW() - INTERVAL 1 DAY");
while ($row = $stmt->fetch()) {
    $activities[] = $row;
}

// New Staff
$stmt = $pdo->query("SELECT full_name, created_at, 'teacher' as type FROM staff WHERE created_at >= NOW() - INTERVAL 1 DAY");
while ($row = $stmt->fetch()) {
    $activities[] = $row;
}

// New Payments
$stmt = $pdo->query("SELECT s.full_name, p.amount, p.created_at, 'fee' as type FROM payments p JOIN students s ON p.student_id = s.student_id WHERE p.status = 'success' AND p.created_at >= NOW() - INTERVAL 1 DAY");
while ($row = $stmt->fetch()) {
    $activities[] = $row;
}

// Sort activities by date DESC
usort($activities, function($a, $b) {
    return strtotime($b['created_at']) - strtotime($a['created_at']);
});

// Recently Added Students
$recent_students = $pdo->query("SELECT * FROM students ORDER BY created_at DESC LIMIT 5")->fetchAll();

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T&T School - Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        
        .menu-item.active .menu-text {
            font-weight: 600;
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
        
        /* Stats Cards */
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 15px var(--shadow);
            display: flex;
            align-items: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-left: 5px solid var(--primary-medium);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 51, 102, 0.15);
        }
        
        .stat-card.students {
            border-left-color: var(--accent-blue);
        }
        
        .stat-card.teachers {
            border-left-color: var(--success);
        }
        
        .stat-card.revenue {
            border-left-color: var(--danger);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            font-size: 1.8rem;
        }
        
        .stat-card.students .stat-icon {
            background-color: rgba(30, 136, 229, 0.1);
            color: var(--accent-blue);
        }
        
        .stat-card.teachers .stat-icon {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }
        
        .stat-card.revenue .stat-icon {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger);
        }
        
        .stat-info h3 {
            font-size: 2rem;
            margin-bottom: 5px;
        }
        
        .stat-info p {
            color: var(--text-light);
            font-size: 0.95rem;
        }
        
        /* Charts Section */
        .charts-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }
        
        .chart-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 15px var(--shadow);
        }
        
        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .chart-header h3 {
            font-size: 1.3rem;
        }
        
        .chart-container {
            height: 300px;
            position: relative;
        }
        
        /* Recent Activity & Quick Actions */
        .activity-actions {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }
        
        .activity-card, .actions-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 15px var(--shadow);
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .card-header h3 {
            font-size: 1.3rem;
        }
        
        .activity-list {
            list-style: none;
        }
        
        .activity-item {
            padding: 15px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
        }
        
        .activity-item:last-child {
            border-bottom: none;
        }
        
        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1rem;
        }
        
        .activity-icon.student {
            background-color: rgba(30, 136, 229, 0.1);
            color: var(--accent-blue);
        }
        
        .activity-icon.teacher {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }
        
        .activity-icon.fee {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger);
        }
        
        .activity-details {
            flex: 1;
        }
        
        .activity-details h4 {
            font-size: 0.95rem;
            margin-bottom: 5px;
        }
        
        .activity-details p {
            color: var(--text-light);
            font-size: 0.85rem;
        }
        
        .activity-time {
            color: var(--text-light);
            font-size: 0.8rem;
        }
        
        .actions-list {
            list-style: none;
        }
        
        .action-item {
            padding: 15px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            text-decoration: none;
            color: inherit;
            transition: background 0.3s;
        }
        
        .action-item:hover {
            background-color: var(--light-bg);
        }
        
        .action-item:last-child {
            border-bottom: none;
        }
        
        .action-icon {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            background-color: var(--light-bg);
            color: var(--primary-medium);
            font-size: 1.2rem;
        }
        
        .action-details h4 {
            font-size: 0.95rem;
            margin-bottom: 5px;
        }
        
        .action-details p {
            color: var(--text-light);
            font-size: 0.85rem;
        }
        
        /* Recent Students Table */
        .recent-table-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 15px var(--shadow);
            margin-bottom: 40px;
        }
        
        .table-responsive {
            overflow-x: auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        thead {
            background-color: var(--light-bg);
        }
        
        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: var(--primary-dark);
            border-bottom: 2px solid #eee;
        }
        
        td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .student-info {
            display: flex;
            align-items: center;
        }
        
        .student-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 15px;
        }
        
        .student-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .student-name {
            font-weight: 500;
            margin-bottom: 3px;
        }
        
        .student-id {
            font-size: 0.85rem;
            color: var(--text-light);
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
            .charts-section {
                grid-template-columns: 1fr;
            }
            
            .activity-actions {
                grid-template-columns: 1fr;
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
        }
        
        @media (max-width: 768px) {
            .stats-cards {
                grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            }
            
            .chart-container {
                height: 250px;
            }
            
            .top-header {
                padding: 20px;
            }
            
            .dashboard-content {
                padding: 20px;
            }
            
            .header-action {
                margin-left: 15px;
            }
        }
        
        @media (max-width: 576px) {
            .stats-cards {
                grid-template-columns: 1fr;
            }
            
            .stat-card {
                padding: 20px;
            }
            
            .chart-card, .activity-card, .actions-card, .recent-table-card {
                padding: 20px;
            }
            
            .page-title h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
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
                        <h1>Dashboard Overview</h1>
                    </div>
                </div>
            </div>
            
            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <!-- Stats Cards -->
                <div class="stats-cards">
                    <div class="stat-card students">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo number_format($total_students); ?></h3>
                            <p>Total Students</p>
                        </div>
                    </div>
                    
                    <div class="stat-card teachers">
                        <div class="stat-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo number_format($total_teachers); ?></h3>
                            <p>Total Staff</p>
                        </div>
                    </div>
                    
                    <div class="stat-card revenue">
                        <div class="stat-icon">
                            <i class="fas fa-naira-sign"></i>
                        </div>
                        <div class="stat-info">
                            <h3>₦<?php echo number_format($annual_revenue); ?></h3>
                            <p>Annual Revenue</p>
                        </div>
                    </div>
                </div>
                
                <!-- Charts Section -->
                <div class="charts-section">
                    <div class="chart-card">
                        <div class="chart-header">
                            <h3>Student Enrollment Trend</h3>
                        </div>
                        <div class="chart-container">
                            <canvas id="enrollmentChart"></canvas>
                        </div>
                    </div>
                    
                    <div class="chart-card">
                        <div class="chart-header">
                            <h3>Fee Collection Status</h3>
                        </div>
                        <div class="chart-container">
                            <canvas id="feeChart"></canvas>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Activity & Quick Actions -->
                <div class="activity-actions">
                    <div class="activity-card">
                        <div class="card-header">
                            <h3>Recent Activity (Last 24h)</h3>
                        </div>
                        <ul class="activity-list">
                            <?php if (empty($activities)): ?>
                                <li class="activity-item">No recent activities in the last 24 hours.</li>
                            <?php else: ?>
                                <?php foreach ($activities as $act): ?>
                                    <li class="activity-item">
                                        <div class="activity-icon <?php echo $act['type']; ?>">
                                            <i class="fas <?php 
                                                if($act['type'] == 'student') echo 'fa-user-plus';
                                                elseif($act['type'] == 'teacher') echo 'fa-chalkboard-teacher';
                                                elseif($act['type'] == 'fee') echo 'fa-money-check-alt';
                                            ?>"></i>
                                        </div>
                                        <div class="activity-details">
                                            <h4><?php 
                                                if($act['type'] == 'student') echo 'New Student Registered';
                                                elseif($act['type'] == 'teacher') echo 'New Teacher Registered';
                                                elseif($act['type'] == 'fee') echo 'Fee Payment Received';
                                            ?></h4>
                                            <p><?php 
                                                if($act['type'] == 'fee') echo htmlspecialchars($act['full_name']) . " paid ₦" . number_format($act['amount']);
                                                else echo htmlspecialchars($act['full_name']);
                                            ?></p>
                                        </div>
                                        <div class="activity-time"><?php echo time_elapsed_string($act['created_at']); ?></div>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    
                    <div class="actions-card">
                        <div class="card-header">
                            <h3>Quick Actions</h3>
                        </div>
                        <ul class="actions-list">
                            <a href="add_new_student.php" class="action-item">
                                <div class="action-icon">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="action-details">
                                    <h4>Add New Student</h4>
                                    <p>Register a new student</p>
                                </div>
                            </a>
                            
                            <a href="add_new_staff.php" class="action-item">
                                <div class="action-icon">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <div class="action-details">
                                    <h4>Add New Staff</h4>
                                    <p>Register a new staff member</p>
                                </div>
                            </a>
                        </ul>
                    </div>
                </div>
                
                <!-- Recent Students Table -->
                <div class="recent-table-card">
                    <div class="card-header">
                        <h3>Recently Added Students</h3>
                    </div>
                    
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Session</th>
                                    <th>Class</th>
                                    <th>Parent/Guardian</th>
                                    <th>Enrollment Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recent_students as $student): ?>
                                    <tr>
                                        <td>
                                            <div class="student-info">
                                                <div class="student-avatar">
                                                    <img src="../assets/images/student/<?php echo $student['image'] ?: 'default.png'; ?>" alt="Student">
                                                </div>
                                                <div>
                                                    <div class="student-name"><?php echo htmlspecialchars($student['full_name']); ?></div>
                                                    <div class="student-id">ID: <?php echo htmlspecialchars($student['admission_no']); ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?php echo htmlspecialchars($student['session_of_year']); ?></td>
                                        <td><?php echo htmlspecialchars($student['class_name']); ?></td>
                                        <td><?php echo htmlspecialchars($student['parent_guardian']); ?></td>
                                        <td><?php echo date('Y-m-d', strtotime($student['created_at'])); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="dashboard-footer">
                <p>&copy; 2023 T&T School Management System. All rights reserved.</p>
            </div>
        </div>
    </div>

    <script>
        // Enrollment Chart
        const enrollmentCtx = document.getElementById('enrollmentChart').getContext('2d');
        new Chart(enrollmentCtx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($months); ?>,
                datasets: [{
                    label: 'New Students',
                    data: <?php echo json_encode($enrollment_data); ?>,
                    borderColor: '#1E88E5',
                    backgroundColor: 'rgba(30, 136, 229, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 } }
                }
            }
        });

        // Fee Chart
        const feeCtx = document.getElementById('feeChart').getContext('2d');
        new Chart(feeCtx, {
            type: 'pie',
            data: {
                labels: ['Paid', 'Unpaid'],
                datasets: [{
                    data: [<?php echo $paid_students; ?>, <?php echo $unpaid_students; ?>],
                    backgroundColor: ['#28a745', '#dc3545'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });

        // Mobile sidebar toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });
        
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });

        window.addEventListener('resize', function() {
            if(window.innerWidth >= 992) {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            }
        });
    </script>
</body>
</html>