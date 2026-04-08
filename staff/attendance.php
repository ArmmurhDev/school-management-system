<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>T&T School | Staff Attendance View</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-dark: #003366;
            --primary-deep: #00264d;
            --primary-medium: #00509E;
            --primary-soft: #1a6fb0;
            --primary-light: #4D8FCC;
            --accent-blue: #1E88E5;
            --light-bg: #F0F8FF;
            --sidebar-bg: #002147;
            --white: #FFFFFF;
            --text-dark: #1A2C3E;
            --text-soft: #2c3e50;
            --text-muted: #5a6e7c;
            --shadow-sm: 0 8px 20px rgba(0, 51, 102, 0.08);
            --shadow-md: 0 12px 28px rgba(0, 51, 102, 0.12);
            --shadow: rgba(0, 51, 102, 0.1);
            --success: #2b7e3a;
            --success-light: #e0f5e3;
            --danger: #c23b22;
            --border-radius-card: 28px;
            --warning: #ffc107;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fb;
            color: var(--text-dark);
            line-height: 1.5;
            min-height: 100vh;
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

        .main-content {
            flex: 1;
            margin-left: 250px;
            transition: margin-left 0.3s ease;
            min-height: 100vh;
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
            font-family: 'Poppins', sans-serif;
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
        }

        .staff-container {
            max-width: 1400px;
            margin: 0 auto;
            background: var(--white);
            border-radius: 42px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        /* header */
        .staff-header {
            background: linear-gradient(115deg, var(--primary-dark) 0%, var(--primary-medium) 100%);
            padding: 28px 42px;
            position: relative;
        }

        .staff-header::after {
            content: "📊";
            font-size: 120px;
            opacity: 0.08;
            position: absolute;
            bottom: -15px;
            right: 20px;
            pointer-events: none;
        }

        .staff-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .staff-details h1 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: white;
            margin-bottom: 6px;
        }

        .staff-details p {
            color: rgba(255,255,255,0.85);
            font-size: 0.9rem;
        }

        .semester-badge {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(6px);
            border-radius: 60px;
            padding: 8px 20px;
            font-weight: 500;
        }

        /* filter bar */
        .filter-bar {
            padding: 24px 42px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: flex-end;
            border-bottom: 1px solid rgba(77, 143, 204, 0.2);
        }

        .filter-group {
            flex: 1;
            min-width: 180px;
        }

        .filter-group label {
            display: block;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--primary-medium);
            margin-bottom: 6px;
        }

        .filter-group select, .filter-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid rgba(77, 143, 204, 0.3);
            border-radius: 60px;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            background: var(--white);
            transition: 0.2s;
        }

        .filter-group select:focus, .filter-group input:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(77, 143, 204, 0.2);
        }

        .view-btn {
            background: linear-gradient(95deg, var(--primary-medium), var(--primary-light));
            border: none;
            padding: 12px 28px;
            border-radius: 60px;
            font-weight: 600;
            color: white;
            cursor: pointer;
            transition: 0.2s;
        }

        .view-btn:hover {
            background: linear-gradient(95deg, var(--primary-dark), var(--primary-medium));
            transform: scale(0.98);
        }

        /* stats cards */
        .stats-row {
            display: flex;
            gap: 24px;
            padding: 28px 42px 0 42px;
            flex-wrap: wrap;
        }

        .stat-card {
            background: var(--white);
            border-radius: 28px;
            padding: 20px 24px;
            flex: 1;
            min-width: 160px;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(77, 143, 204, 0.2);
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            background: var(--light-bg);
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-medium);
            font-size: 1.3rem;
        }

        .stat-info h3 {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 6px;
        }

        .stat-number {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--primary-dark);
        }

        /* table */
        .table-wrapper {
            margin: 24px 42px 32px 42px;
            overflow-x: auto;
            border-radius: 28px;
            background: var(--white);
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(0, 81, 158, 0.1);
        }

        .attendance-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
            min-width: 500px;
        }

        .attendance-table th {
            background: var(--light-bg);
            padding: 16px 16px;
            text-align: left;
            font-weight: 700;
            color: var(--primary-dark);
            border-bottom: 2px solid rgba(77, 143, 204, 0.3);
        }

        .attendance-table td {
            padding: 14px 16px;
            border-bottom: 1px solid rgba(0, 81, 158, 0.08);
            color: var(--text-soft);
        }

        .attendance-table tr:last-child td {
            border-bottom: none;
        }

        .present-badge {
            background: var(--success-light);
            color: var(--success);
            padding: 4px 12px;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 700;
            display: inline-block;
        }

        .absent-badge {
            background: #ffe6e2;
            color: var(--danger);
            padding: 4px 12px;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 700;
            display: inline-block;
        }

        /* previous sessions */
        .prev-sessions {
            margin: 0 42px 42px 42px;
            background: var(--light-bg);
            border-radius: 28px;
            padding: 24px;
        }

        .prev-sessions h3 {
            font-size: 1.1rem;
            color: var(--primary-dark);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sessions-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .session-chip {
            background: white;
            border: 1px solid var(--primary-light);
            border-radius: 40px;
            padding: 8px 18px;
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--primary-dark);
            cursor: pointer;
            transition: 0.2s;
        }

        .session-chip:hover {
            background: var(--primary-light);
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: var(--text-muted);
        }

        footer {
            background: var(--primary-dark);
            padding: 20px 42px;
            text-align: center;
            color: #bcd0e6;
            font-size: 0.75rem;
        }

        @media (max-width: 780px) {
            body { padding: 16px; }
            .staff-header { padding: 20px 24px; }
            .filter-bar { padding: 20px 24px; flex-direction: column; align-items: stretch; }
            .stats-row { padding: 20px 24px 0 24px; gap: 16px; }
            .table-wrapper { margin: 20px 24px 24px 24px; }
            .prev-sessions { margin: 0 24px 32px 24px; padding: 20px; }
        }

        @media (max-width: 480px) {
            .stat-card { min-width: 100%; }
        }

        .toast {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--primary-dark);
            color: white;
            padding: 10px 24px;
            border-radius: 60px;
            font-size: 0.8rem;
            z-index: 1000;
            opacity: 0;
            transition: 0.2s;
            pointer-events: none;
        }
        .toast.show { opacity: 1; bottom: 40px; }
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
                        <h1>Attendance</h1>
                    </div>
                </div>
                
                <div class="header-right">
                    <div class="header-action" style="margin-left: 25px; cursor: pointer;">
                        <i class="fas fa-search" style="color: var(--primary-medium);"></i>
                    </div>
                    <div class="header-action" style="margin-left: 25px; cursor: pointer;">
                        <i class="fas fa-bell" style="color: var(--primary-medium);"></i>
                    </div>
                    <div class="header-action" style="margin-left: 25px; cursor: pointer;">
                        <i class="fas fa-user-circle" style="color: var(--primary-medium);"></i>
                    </div>
                </div>
            </div>

            <div class="dashboard-content">
                <div class="staff-container">
                    <div class="staff-header">
                        <div class="staff-info">
                            <div class="staff-details">
                                <h1><i class="fas fa-chalkboard-user"></i> Attendance Overview</h1>
                                <p><i class="fas fa-user-graduate"></i> Prof. Sophia Lin · Computer Science · Staff ID: TCH-0042</p>
                            </div>
                            <div class="semester-badge">
                                <i class="fas fa-calendar-alt"></i> Spring 2025
                            </div>
                        </div>
                    </div>

                    <div class="filter-bar">
                        <div class="filter-group">
                            <label><i class="fas fa-book"></i> Select Course</label>
                            <select id="courseSelect">
                                <option value="">Loading courses...</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label><i class="fas fa-calendar-day"></i> Attendance Date</label>
                            <input type="date" id="attendanceDate">
                        </div>
                        <button class="view-btn" id="viewAttendanceBtn"><i class="fas fa-search"></i> View Attendance</button>
                    </div>

                    <div class="stats-row" id="statsContainer">
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fas fa-users"></i></div>
                            <div class="stat-info">
                                <h3>Total Students</h3>
                                <div class="stat-number" id="totalStudents">0</div>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                            <div class="stat-info">
                                <h3>Present</h3>
                                <div class="stat-number" id="presentCount">0</div>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fas fa-times-circle"></i></div>
                            <div class="stat-info">
                                <h3>Absent</h3>
                                <div class="stat-number" id="absentCount">0</div>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                            <div class="stat-info">
                                <h3>Attendance Rate</h3>
                                <div class="stat-number" id="attRate">0%</div>
                            </div>
                        </div>
                    </div>

                    <div class="table-wrapper">
                        <table class="attendance-table">
                            <thead>
                                <tr><th>Student ID</th><th>Student Name</th><th>Status</th><th>Sign-in Time</th></tr>
                            </thead>
                            <tbody id="attendanceTableBody">
                                <tr><td colspan="4" style="text-align: center;">Select a course and date to view attendance</td></tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="prev-sessions" id="prevSessions">
                        <h3><i class="fas fa-history"></i> Previous Class Sessions</h3>
                        <div id="sessionsList" class="sessions-grid"></div>
                    </div>

                    <footer>
                        <p><i class="fas fa-chart-line"></i> Real-time attendance tracking | T&T School Staff Portal</p>
                    </footer>
                </div>
            </div>
        </div>
    </div>

<div id="toastMsg" class="toast"></div>

<script>
    // Sidebar Toggle Script
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

    // Handle window resize
    window.addEventListener('resize', function() {
        if(window.innerWidth >= 992) {
            if (sidebar) sidebar.classList.remove('active');
            if (overlay) overlay.classList.remove('active');
        }
    });

    // ---------- MOCK DATA FOR STAFF COURSES, STUDENTS, ATTENDANCE ----------
    const staffCourses = [
        { id: "CS210", name: "Data Structures" },
        { id: "CS301", name: "Algorithms" },
        { id: "CS401", name: "Machine Learning" }
    ];

    // Students per course (each course has different set)
    const courseStudents = {
        "CS210": [
            { id: "STU-1001", name: "Olivia Chen" },
            { id: "STU-1002", name: "Liam Rodriguez" },
            { id: "STU-1003", name: "Emma Thompson" },
            { id: "STU-1004", name: "Noah Williams" },
            { id: "STU-1005", name: "Ava Johnson" },
            { id: "STU-1006", name: "Mason Brown" },
            { id: "STU-1007", name: "Sophia Davis" }
        ],
        "CS301": [
            { id: "STU-1001", name: "Olivia Chen" },
            { id: "STU-1002", name: "Liam Rodriguez" },
            { id: "STU-1004", name: "Noah Williams" },
            { id: "STU-1005", name: "Ava Johnson" },
            { id: "STU-1008", name: "Ethan Miller" },
            { id: "STU-1009", name: "Isabella Wilson" }
        ],
        "CS401": [
            { id: "STU-1003", name: "Emma Thompson" },
            { id: "STU-1006", name: "Mason Brown" },
            { id: "STU-1007", name: "Sophia Davis" },
            { id: "STU-1008", name: "Ethan Miller" },
            { id: "STU-1010", name: "James Martinez" }
        ]
    };

    // Storage key for attendance records
    const STORAGE_KEY = "tt_staff_attendance_records";

    // Generate mock attendance records for all courses and dates (March 1 - April 15, 2025)
    let attendanceRecords = [];

    function generateMockAttendance() {
        const records = [];
        const startDate = new Date(2025, 2, 1); // March 1
        const endDate = new Date(2025, 3, 15);   // April 15
        let current = new Date(startDate);
        
        while (current <= endDate) {
            const dayOfWeek = current.getDay();
            // Only weekdays (Monday to Friday) have classes
            if (dayOfWeek >= 1 && dayOfWeek <= 5) {
                const dateStr = current.toISOString().slice(0,10);
                // For each course, generate attendance based on course meeting days (simplified: each course meets 2-3 times a week)
                staffCourses.forEach(course => {
                    let meets = false;
                    if (course.id === "CS210" && (dayOfWeek === 1 || dayOfWeek === 3 || dayOfWeek === 5)) meets = true;
                    if (course.id === "CS301" && (dayOfWeek === 1 || dayOfWeek === 3)) meets = true;
                    if (course.id === "CS401" && (dayOfWeek === 4)) meets = true;
                    
                    if (meets) {
                        const students = courseStudents[course.id];
                        students.forEach(student => {
                            // 75-90% present for past dates
                            const isPresent = Math.random() < 0.82;
                            if (isPresent) {
                                records.push({
                                    courseId: course.id,
                                    studentId: student.id,
                                    studentName: student.name,
                                    date: dateStr,
                                    timestamp: `${Math.floor(Math.random() * 3) + 8}:${Math.random() > 0.5 ? '30' : '00'} ${Math.random() > 0.5 ? 'AM' : 'PM'}`,
                                    status: "Present"
                                });
                            }
                        });
                    }
                });
            }
            current.setDate(current.getDate() + 1);
        }
        return records;
    }

    function loadAttendanceRecords() {
        const stored = localStorage.getItem(STORAGE_KEY);
        if (stored) {
            try {
                attendanceRecords = JSON.parse(stored);
                if (attendanceRecords.length === 0) {
                    attendanceRecords = generateMockAttendance();
                    saveAttendanceRecords();
                }
            } catch(e) {
                attendanceRecords = generateMockAttendance();
                saveAttendanceRecords();
            }
        } else {
            attendanceRecords = generateMockAttendance();
            saveAttendanceRecords();
        }
    }

    function saveAttendanceRecords() {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(attendanceRecords));
    }

    // Helper: get unique dates for a course (sorted descending)
    function getCourseDates(courseId) {
        const dates = new Set();
        attendanceRecords.forEach(rec => {
            if (rec.courseId === courseId) {
                dates.add(rec.date);
            }
        });
        return Array.from(dates).sort().reverse();
    }

    // Get attendance for a specific course and date
    function getAttendanceForCourseDate(courseId, date) {
        const records = attendanceRecords.filter(rec => rec.courseId === courseId && rec.date === date);
        // Map to student ID for quick lookup
        const recordMap = new Map();
        records.forEach(rec => {
            recordMap.set(rec.studentId, rec);
        });
        return recordMap;
    }

    // Render UI
    let currentCourseId = "";
    let currentDate = "";

    function populateCourseSelect() {
        const select = document.getElementById('courseSelect');
        select.innerHTML = '<option value="">Select a course</option>';
        staffCourses.forEach(course => {
            select.innerHTML += `<option value="${course.id}">${course.name} (${course.id})</option>`;
        });
    }

    function renderAttendance(courseId, date) {
        if (!courseId || !date) {
            document.getElementById('attendanceTableBody').innerHTML = '<tr><td colspan="4" style="text-align: center;">Please select a course and date</td></tr>';
            document.getElementById('totalStudents').innerText = '0';
            document.getElementById('presentCount').innerText = '0';
            document.getElementById('absentCount').innerText = '0';
            document.getElementById('attRate').innerText = '0%';
            return;
        }

        const students = courseStudents[courseId] || [];
        const recordMap = getAttendanceForCourseDate(courseId, date);
        
        let presentCount = 0;
        let absentCount = 0;
        let rows = '';
        
        students.forEach(student => {
            const record = recordMap.get(student.id);
            const isPresent = !!record;
            if (isPresent) presentCount++;
            else absentCount++;
            
            rows += `
                <tr>
                    <td><strong>${student.id}</strong></td>
                    <td>${escapeHtml(student.name)}</td>
                    <td>${isPresent ? '<span class="present-badge"><i class="fas fa-check"></i> Present</span>' : '<span class="absent-badge"><i class="fas fa-times"></i> Absent</span>'}</td>
                    <td>${isPresent ? `<i class="far fa-clock"></i> ${record.timestamp}` : '—'}</td>
                </tr>
            `;
        });
        
        const total = students.length;
        const attendanceRate = total ? ((presentCount / total) * 100).toFixed(1) : 0;
        
        document.getElementById('attendanceTableBody').innerHTML = rows;
        document.getElementById('totalStudents').innerText = total;
        document.getElementById('presentCount').innerText = presentCount;
        document.getElementById('absentCount').innerText = absentCount;
        document.getElementById('attRate').innerText = `${attendanceRate}%`;
    }

    function renderPreviousSessions(courseId) {
        const container = document.getElementById('sessionsList');
        if (!courseId) {
            container.innerHTML = '<div class="empty-state">Select a course to see previous sessions</div>';
            return;
        }
        
        const dates = getCourseDates(courseId);
        if (dates.length === 0) {
            container.innerHTML = '<div class="empty-state">No previous sessions found</div>';
            return;
        }
        
        let chips = '';
        dates.forEach(date => {
            const formattedDate = new Date(date).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
            chips += `<div class="session-chip" data-date="${date}"><i class="far fa-calendar-alt"></i> ${formattedDate}</div>`;
        });
        container.innerHTML = chips;
        
        // Attach click handlers
        document.querySelectorAll('.session-chip').forEach(chip => {
            chip.addEventListener('click', () => {
                const date = chip.getAttribute('data-date');
                document.getElementById('attendanceDate').value = date;
                viewAttendance();
            });
        });
    }

    function viewAttendance() {
        const courseId = document.getElementById('courseSelect').value;
        const date = document.getElementById('attendanceDate').value;
        if (!courseId) {
            showToast("Please select a course", true);
            return;
        }
        if (!date) {
            showToast("Please select a date", true);
            return;
        }
        currentCourseId = courseId;
        currentDate = date;
        renderAttendance(courseId, date);
        renderPreviousSessions(courseId);
    }

    function setDefaultDate() {
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        document.getElementById('attendanceDate').value = `${yyyy}-${mm}-${dd}`;
    }

    function showToast(message, isError = false) {
        const toast = document.getElementById('toastMsg');
        toast.textContent = message;
        toast.style.backgroundColor = isError ? '#c23b22' : '#00509E';
        toast.classList.add('show');
        setTimeout(() => {
            toast.classList.remove('show');
        }, 2500);
    }

    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/[&<>]/g, function(m) {
            if (m === '&') return '&amp;';
            if (m === '<') return '&lt;';
            if (m === '>') return '&gt;';
            return m;
        });
    }

    function init() {
        loadAttendanceRecords();
        populateCourseSelect();
        setDefaultDate();
        document.getElementById('viewAttendanceBtn').addEventListener('click', viewAttendance);
        // Optional: auto-select first course and view today's attendance
        setTimeout(() => {
            const select = document.getElementById('courseSelect');
            if (select.options.length > 1) {
                select.selectedIndex = 1;
                viewAttendance();
            }
        }, 100);
    }

    init();
</script>
</body>
</html>