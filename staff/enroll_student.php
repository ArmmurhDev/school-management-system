<?php
require_once '../auth/session.php';
require_once '../include/config.php';
checkAccess('staff');

// Fetch students registered for courses taught by this staff member
$staff_id = $_SESSION['user_id'];
$query = "
    SELECT DISTINCT 
        s.student_id as id,
        s.full_name as fullName,
        s.admission_no as studentId,
        s.image as avatar,
        s.class_name as class,
        s.session_of_year as session,
        (SELECT full_name FROM staff WHERE staff_id = ?) as classTeacher,
        s.age as age,
        'N/A' as gender,
        s.parent_guardian as parentName,
        'N/A' as parentEmail,
        s.contact_number as parentPhone,
        'N/A' as address,
        'Active' as status
    FROM students s
    JOIN course_registrations cr ON s.student_id = cr.student_id
    JOIN courses c ON cr.course_id = c.course_id
    WHERE c.instructor_id = ?
";
$stmt = $pdo->prepare($query);
$stmt->execute([$staff_id, $staff_id]);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Map avatars to correct path
foreach ($students as &$student) {
    if (!empty($student['avatar'])) {
        $student['avatar'] = '../assets/images/student/' . $student['avatar'];
    } else {
        $student['avatar'] = 'https://ui-avatars.com/api/?name=' . urlencode($student['fullName']) . '&background=random';
    }
}

$students_json = json_encode($students);

// Fetch sessions for the dropdown from the registrations table
$sessions_stmt = $pdo->query("
    SELECT DISTINCT s.session_of_year 
    FROM students s 
    JOIN course_registrations cr ON s.student_id = cr.student_id 
    ORDER BY s.session_of_year DESC
");
$sessions = $sessions_stmt->fetchAll(PDO::FETCH_COLUMN);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <title>Class Roster · T&T School Management</title>
    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* ----- EXACT COLOR SCHEME ----- */
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
            display: flex;
            flex-direction: column;
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
        
        .dashboard-content {
            padding: 30px;
            flex: 1;
        }
        
        /* ----- PAGE SPECIFIC (ROSTER) ----- */
        .roster-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .roster-header h2 {
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .class-badge {
            background: var(--light-bg);
            color: var(--primary-medium);
            padding: 6px 16px;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: 500;
            border: 1px solid var(--primary-light);
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            border: none;
            box-shadow: 0 4px 10px var(--shadow);
            background: var(--white);
            color: var(--primary-medium);
            border: 1px solid var(--primary-light);
        }
        
        .btn i {
            margin-right: 8px;
        }
        
        .btn-primary {
            background: linear-gradient(to right, var(--primary-dark), var(--primary-medium));
            color: var(--white);
            border: none;
        }
        
        .btn-primary:hover {
            background: linear-gradient(to right, var(--primary-medium), var(--accent-blue));
            transform: translateY(-2px);
        }
        
        .btn-outline {
            background: transparent;
            border: 1px solid var(--primary-light);
            color: var(--primary-dark);
            box-shadow: none;
        }
        
        .btn-outline:hover {
            background: var(--light-bg);
        }
        
        /* filter bar */
        .filter-mini {
            background: var(--white);
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px var(--shadow);
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 15px;
        }
        
        .filter-mini .filter-group {
            flex: 1 1 180px;
        }
        
        .filter-group label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 5px;
        }
        
        .filter-group select, .filter-group input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: 'Open Sans', sans-serif;
            background: #f9f9f9;
        }
        
        /* table container */
        .table-container {
            background: var(--white);
            border-radius: 16px;
            box-shadow: 0 8px 20px var(--shadow);
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        .table-header {
            padding: 20px 25px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }
        
        .table-header h3 {
            font-size: 1.3rem;
        }
        
        .student-count {
            color: var(--text-light);
            font-size: 0.9rem;
        }
        
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        .roster-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }
        
        .roster-table thead {
            background: var(--light-bg);
        }
        
        .roster-table th {
            padding: 18px 20px;
            text-align: left;
            font-weight: 600;
            color: var(--primary-dark);
            border-bottom: 2px solid #e0e7ef;
            white-space: nowrap;
            font-size: 0.95rem;
        }
        
        .roster-table td {
            padding: 16px 20px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }
        
        .roster-table tbody tr {
            transition: background 0.2s;
        }
        
        .roster-table tbody tr:hover {
            background-color: #fafcff;
        }
        
        .student-name-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .student-avatar-sm {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--light-bg);
        }
        
        .student-info-sm h4 {
            font-size: 1rem;
            margin-bottom: 2px;
        }
        
        .student-info-sm .student-id {
            font-size: 0.75rem;
            color: var(--text-light);
        }
        
        .class-badge-sm {
            background: var(--light-bg);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--primary-medium);
        }
        
        .session-badge {
            background: #e9f0fa;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            color: var(--primary-dark);
        }
        
        .action-btn.view-only {
            background: rgba(30, 136, 229, 0.08);
            color: var(--accent-blue);
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 1rem;
        }
        
        .action-btn.view-only:hover {
            background: var(--accent-blue);
            color: white;
            transform: scale(1.05);
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
        
        /* footer */
        .dashboard-footer {
            padding: 20px 30px;
            text-align: center;
            color: var(--text-light);
            font-size: 0.9rem;
            border-top: 1px solid #eee;
            background: var(--white);
        }
        
        /* mobile responsive */
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

        @media (max-width: 768px) {
            .top-header {
                padding: 16px 20px;
            }
            .dashboard-content {
                padding: 20px 16px;
            }
            .roster-header h2 {
                font-size: 1.5rem;
            }
            .filter-mini {
                flex-direction: column;
                align-items: stretch;
            }
            .table-header {
                padding: 16px 20px;
            }
        }
        
        @media (max-width: 480px) {
            .btn {
                padding: 10px 14px;
                font-size: 0.85rem;
            }
            .class-badge {
                font-size: 0.85rem;
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

    <div class="main-content" id="mainContent">
        <!-- Top Header -->
        <div class="top-header">
            <div class="header-left">
                <button class="menu-toggle" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="page-title">
                    <h1>Class Roster</h1>
                </div>
            </div>
            <div class="header-right">
                <div class="header-action"><i class="fas fa-search"></i></div>
                <div class="header-action"><i class="fas fa-bell"></i></div>
                <div class="header-action"><i class="fas fa-user-circle"></i></div>
            </div>
        </div>

        <div class="dashboard-content">
            <!-- Header with class info -->
            <div class="roster-header">
                <h2>
                    <i class="fas fa-user-graduate" style="color: var(--primary-medium);"></i> 
                    My Students
                </h2>
                <div>
                    <button class="btn btn-outline" id="refreshRosterBtn"><i class="fas fa-sync-alt"></i> Refresh</button>
                </div>
            </div>

            <!-- Simple filter -->
            <div class="filter-mini">
                <div class="filter-group">
                    <label>Academic Session</label>
                    <select id="sessionFilter">
                        <option value="all">All Sessions</option>
                        <?php foreach ($sessions as $session): ?>
                            <option value="<?php echo htmlspecialchars($session); ?>">
                                <?php echo htmlspecialchars($session); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Search by name</label>
                    <input type="text" id="searchInput" placeholder="Student name or ID...">
                </div>
                <div class="filter-group" style="display: flex; align-items: flex-end;">
                    <button class="btn btn-primary" id="applyFilterBtn" style="width:100%;"><i class="fas fa-filter"></i> Apply</button>
                </div>
            </div>

            <!-- Table Card -->
            <div class="table-container">
                <div class="table-header">
                    <h3>Student List</h3>
                    <span class="student-count" id="recordCount">0 students</span>
                </div>
                <div class="table-responsive">
                    <table class="roster-table" id="rosterTable">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Class</th>
                                <th>Session</th>
                                <th>Class Teacher</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <!-- dynamic rows -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="dashboard-footer">
                <p>© 2025 T&T School Management System · Class Roster View</p>
            </div>
        </div>
    </div>
</div>

<script>
    (function(){
        "use strict";

        // ---------- DYNAMIC DATA ----------
        const studentsData = <?php echo $students_json; ?>;

        // DOM elements
        const tbody = document.getElementById('tableBody');
        const recordCountSpan = document.getElementById('recordCount');
        const sessionFilter = document.getElementById('sessionFilter');
        const searchInput = document.getElementById('searchInput');
        const applyFilterBtn = document.getElementById('applyFilterBtn');
        const refreshBtn = document.getElementById('refreshRosterBtn');
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        let currentStudents = [...studentsData];

        // ----- Render table -----
        function renderTable(data) {
            if (!data.length) {
                tbody.innerHTML = `<tr><td colspan="5" style="text-align:center; padding: 40px; color: var(--text-light);">
                    <i class="fas fa-user-slash" style="font-size:2rem; margin-bottom:10px; display:block;"></i>
                    <h4>No students found</h4><p>Try adjusting filters</p></td></tr>`;
                recordCountSpan.textContent = `0 students`;
                return;
            }
            let html = '';
            data.forEach(s => {
                html += `<tr>
                    <td>
                        <div class="student-name-cell">
                            <img class="student-avatar-sm" src="${s.avatar}" alt="${s.fullName}">
                            <div class="student-info-sm">
                                <h4>${s.fullName}</h4>
                                <span class="student-id">${s.studentId}</span>
                            </div>
                        </div>
                    </td>
                    <td><span class="class-badge-sm">${s.class}</span></td>
                    <td><span class="session-badge">${s.session}</span></td>
                    <td>${s.classTeacher}</td>
                    <td style="text-align: center;">
                        <button class="action-btn view-only" data-id="${s.id}" title="View details"><i class="fas fa-eye"></i></button>
                    </td>
                </tr>`;
            });
            tbody.innerHTML = html;
            recordCountSpan.textContent = `${data.length} student${data.length !== 1 ? 's' : ''}`;

            // Attach view events
            document.querySelectorAll('.action-btn.view-only').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const id = Number(btn.dataset.id);
                    // Redirect to student profile page
                    window.location.href = `view_students.php?id=${id}`;
                });
            });
        }

        // ----- Filter logic -----
        function filterData() {
            const sessionVal = sessionFilter.value;
            const searchTerm = searchInput.value.trim().toLowerCase();
            
            const filtered = studentsData.filter(s => {
                if (sessionVal !== 'all' && s.session !== sessionVal) return false;
                if (searchTerm) {
                    const inName = s.fullName.toLowerCase().includes(searchTerm);
                    const inId = s.studentId.toLowerCase().includes(searchTerm);
                    if (!inName && !inId) return false;
                }
                return true;
            });
            currentStudents = filtered;
            renderTable(currentStudents);
        }

        // ----- Initialize -----
        function init() {
            renderTable(studentsData);
            
            // Set dynamic default session
            if (sessionFilter.options.length > 1) {
                sessionFilter.selectedIndex = 1; // Pick the first available session after "All Sessions"
            } else if (sessionFilter.options.length === 1) {
                sessionFilter.selectedIndex = 0;
            }
            
            filterData();

            applyFilterBtn.addEventListener('click', filterData);
            refreshBtn.addEventListener('click', () => {
                if (sessionFilter.options.length > 1) {
                    sessionFilter.selectedIndex = 1;
                }
                searchInput.value = '';
                filterData();
            });
            searchInput.addEventListener('keyup', (e) => { if(e.key === 'Enter') filterData(); });
            
            // Sidebar toggle for mobile
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

            window.addEventListener('resize', () => {
                if (window.innerWidth >= 992) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                }
            });
        }

        init();
    })();
</script>
</body>
</html>