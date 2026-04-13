<?php
require_once '../auth/session.php';
require_once '../include/config.php';
checkAccess('staff');

$staff_id = $_SESSION['user_id'];

// Fetch staff details
$stmt = $pdo->prepare("SELECT * FROM staff WHERE staff_id = ?");
$stmt->execute([$staff_id]);
$staff = $stmt->fetch();
$staff_name = $staff['full_name'] ?? 'Staff Member';
$staff_image = !empty($staff['image']) ? "../assets/images/staff/" . $staff['image'] : "../assets/images/staff/default.png";

// Fetch Total Students count
$stmt = $pdo->prepare("
    SELECT COUNT(DISTINCT s.student_id) 
    FROM students s
    JOIN course_registrations cr ON s.student_id = cr.student_id
    JOIN courses c ON cr.course_id = c.course_id
    WHERE c.instructor_id = ?
");
$stmt->execute([$staff_id]);
$total_students = $stmt->fetchColumn();

// Fetch Enrolled Students for the table
$stmt = $pdo->prepare("
    SELECT DISTINCT s.*
    FROM students s
    JOIN course_registrations cr ON s.student_id = cr.student_id
    JOIN courses c ON cr.course_id = c.course_id
    WHERE c.instructor_id = ?
    ORDER BY s.full_name ASC
    LIMIT 5
");
$stmt->execute([$staff_id]);
$enrolled_students = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard - T&T School Management System</title>
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
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Open Sans', sans-serif; color: var(--text-dark); line-height: 1.6; background-color: #f5f7fb; overflow-x: hidden; }
        h1, h2, h3, h4, h5 { font-family: 'Poppins', sans-serif; font-weight: 600; color: var(--primary-dark); }
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
        
        .main-content { flex: 1; margin-left: 250px; transition: margin-left 0.3s ease; min-height: 100vh; }
        .top-header { background-color: var(--white); padding: 20px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px var(--shadow); position: sticky; top: 0; z-index: 99; }
        .header-left { display: flex; align-items: center; }
        .menu-toggle { background: none; border: none; font-size: 1.5rem; color: var(--primary-dark); cursor: pointer; margin-right: 20px; display: none; }
        .page-title h1 { font-size: 1.8rem; color: var(--primary-dark); }
        
        .dashboard-content { padding: 30px; }
        .welcome-section { background: linear-gradient(135deg, var(--primary-dark), var(--primary-medium)); border-radius: 15px; padding: 30px; color: var(--white); margin-bottom: 40px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 10px 30px rgba(0, 51, 102, 0.2); }
        .welcome-text h2 { font-size: 1.8rem; color: var(--white); margin-bottom: 10px; }
        .welcome-date { background-color: rgba(255, 255, 255, 0.1); padding: 15px 25px; border-radius: 10px; text-align: center; }
        .welcome-date .day { font-size: 2rem; font-weight: 700; margin-bottom: 5px; }
        .welcome-date .date { font-size: 1.1rem; opacity: 0.9; }
        
        .stats-cards { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 25px; margin-bottom: 40px; }
        .stat-card { background-color: var(--white); border-radius: 12px; padding: 25px; box-shadow: 0 5px 15px var(--shadow); display: flex; align-items: center; transition: transform 0.3s ease; border-left: 5px solid var(--accent-blue); }
        .stat-icon { width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 20px; font-size: 1.8rem; background-color: rgba(30, 136, 229, 0.1); color: var(--accent-blue); }
        .stat-info h3 { font-size: 2rem; margin-bottom: 5px; }
        .stat-info p { color: var(--text-light); font-size: 0.95rem; }
        
        .dashboard-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 30px; margin-bottom: 40px; }
        @media (max-width: 1200px) { .dashboard-grid { grid-template-columns: 1fr; } }
        
        .card { background-color: var(--white); border-radius: 12px; padding: 30px; box-shadow: 0 5px 15px var(--shadow); margin-bottom: 30px; }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .card-header h3 { font-size: 1.3rem; }
        
        .actions-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }
        .action-item { background-color: var(--light-bg); border-radius: 10px; padding: 20px; text-align: center; cursor: pointer; transition: all 0.3s; border: 1px solid rgba(77, 143, 204, 0.2); text-decoration: none; color: inherit; display: block; }
        .action-item:hover { background-color: #e3f2fd; transform: translateY(-5px); }
        .action-icon { width: 50px; height: 50px; border-radius: 10px; background-color: var(--white); display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; color: var(--primary-medium); font-size: 1.3rem; }
        
        .table-responsive { overflow-x: auto; }
        .students-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .students-table thead { background-color: var(--light-bg); }
        .students-table th { padding: 15px; text-align: left; font-weight: 600; color: var(--primary-dark); border-bottom: 2px solid #eee; }
        .students-table td { padding: 15px; border-bottom: 1px solid #eee; vertical-align: middle; }
        .student-info { display: flex; align-items: center; }
        .student-avatar { width: 40px; height: 40px; border-radius: 50%; overflow: hidden; margin-right: 15px; }
        .student-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .student-name { font-weight: 500; }
        .student-id { font-size: 0.85rem; color: var(--text-light); }
        
        .overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 99; display: none; }
        .overlay.active { display: block; }
        .dashboard-footer { padding: 20px 30px; text-align: center; color: var(--text-light); font-size: 0.9rem; border-top: 1px solid #eee; background-color: var(--white); }

        /* Loading Spinner */
        .loader { border: 4px solid #f3f3f3; border-top: 4px solid var(--primary-medium); border-radius: 50%; width: 30px; height: 30px; animation: spin 2s linear infinite; display: none; margin: 20px auto; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }

        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); width: 280px; }
            .sidebar.active { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .menu-toggle { display: block; }
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include '../include/staff_sidebar.php'; ?>
        <div class="overlay" id="overlay"></div>
        
        <div class="main-content" id="mainContent">
            <div class="top-header">
                <div class="header-left">
                    <button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
                    <div class="page-title">
                        <h1 id="pageTitle">Staff Dashboard</h1>
                    </div>
                </div>
                <div class="header-right">
                    <img src="<?php echo htmlspecialchars($staff_image); ?>" alt="Profile" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover;">
                </div>
            </div>
            
            <div class="dashboard-content" id="displayArea">
                <!-- Welcome Section -->
                <div class="welcome-section">
                    <div class="welcome-text">
                        <h2>Welcome back, <?php echo htmlspecialchars($staff_name); ?>!</h2>
                    </div>
                    <div class="welcome-date">
                        <div class="day"><?php echo date('l'); ?></div>
                        <div class="date"><?php echo date('F d, Y'); ?></div>
                    </div>
                </div>
                
                <!-- Stats Cards -->
                <div class="stats-cards">
                    <div class="stat-card students">
                        <div class="stat-icon"><i class="fas fa-users"></i></div>
                        <div class="stat-info">
                            <h3><?php echo number_format($total_students); ?></h3>
                            <p>Total Students Enrolled</p>
                        </div>
                    </div>
                </div>
                
                <div class="dashboard-grid">
                    <!-- Left Column: Recent Students -->
                    <div class="card recent-students-card">
                        <div class="card-header">
                            <h3>Recent Student Performance</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="students-table">
                                <thead>
                                    <tr>
                                        <th>Student</th>
                                        <th>Class</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($enrolled_students)): ?>
                                        <tr><td colspan="3" style="text-align: center;">No students enrolled yet.</td></tr>
                                    <?php else: ?>
                                        <?php foreach ($enrolled_students as $s): ?>
                                            <tr>
                                                <td>
                                                    <div class="student-info">
                                                        <div class="student-avatar">
                                                            <img src="../assets/images/student/<?php echo $s['image'] ?: 'default.png'; ?>" alt="Student">
                                                        </div>
                                                        <div>
                                                            <div class="student-name"><?php echo htmlspecialchars($s['full_name']); ?></div>
                                                            <div class="student-id">ID: <?php echo htmlspecialchars($s['admission_no']); ?></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?php echo htmlspecialchars($s['class_name'] ?: 'N/A'); ?></td>
                                                <td><?php echo htmlspecialchars($s['email']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Right Column: Quick Actions -->
                    <div class="card actions-card">
                        <div class="card-header">
                            <h3>Quick Actions</h3>
                        </div>
                        <div class="actions-grid">
                            <a href="enter_results.php" class="action-item">
                                <div class="action-icon"><i class="fas fa-edit"></i></div>
                                <h4>Enter Grade</h4>
                                <p>Update student scores</p>
                            </a>
                            <a href="message.php" class="action-item">
                                <div class="action-icon"><i class="fas fa-comments"></i></div>
                                <h4>Message Student</h4>
                                <p>Send updates to students</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="loader" class="loader"></div>
            
            <div class="dashboard-footer">
                <p>&copy; <?php echo date('Y'); ?> T&T School Management System. All rights reserved.</p>
            </div>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const menuToggle = document.getElementById('menuToggle');
        const displayArea = document.getElementById('displayArea');
        const pageTitle = document.getElementById('pageTitle');
        const loader = document.getElementById('loader');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });
        
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });

        async function loadContent(url, title) {
            loader.style.display = 'block';
            displayArea.style.opacity = '0.5';
            
            try {
                const response = await fetch(url + (url.includes('?') ? '&' : '?') + 'ajax=1');
                if (response.ok) {
                    const html = await response.text();
                    displayArea.innerHTML = html;
                    pageTitle.textContent = title;
                    
                    // Update URL without reload (optional but good for UX)
                    // history.pushState({path: url}, title, url);
                } else {
                    displayArea.innerHTML = '<div class="card"><div class="card-body">Error loading content.</div></div>';
                }
            } catch (error) {
                console.error('Error:', error);
                displayArea.innerHTML = '<div class="card"><div class="card-body">Connection error.</div></div>';
            } finally {
                loader.style.display = 'none';
                displayArea.style.opacity = '1';
                if (window.innerWidth < 992) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                }
            }
        }

        window.addEventListener('resize', function() {
            if(window.innerWidth >= 992) {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            }
        });
    </script>
</body>
</html>
