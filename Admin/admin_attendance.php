<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>T&T School | Admin Attendance Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-dark: #003366;
            --primary-deep: #00264d;
            --primary-medium: #00509E;
            --primary-soft: #1a6fb0;
            --primary-light: #4D8FCC;
            --accent-wave: #7bb3db;
            --light-bg: #F0F8FF;
            --white: #FFFFFF;
            --gray-light: #f8fafd;
            --text-dark: #1A2C3E;
            --text-soft: #2c3e50;
            --text-muted: #5a6e7c;
            --shadow-sm: 0 8px 20px rgba(0, 51, 102, 0.08);
            --shadow-md: 0 12px 28px rgba(0, 51, 102, 0.12);
            --success: #2b7e3a;
            --success-light: #e0f5e3;
            --danger: #c23b22;
            --border-radius-card: 28px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(145deg, #eef5fc 0%, #e2edf7 100%);
            color: var(--text-dark);
            line-height: 1.5;
            padding: 28px 20px;
            min-height: 100vh;
        }

        .admin-container {
            max-width: 1400px;
            margin: 0 auto;
            background: var(--white);
            border-radius: 42px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        /* header */
        .admin-header {
            background: linear-gradient(115deg, var(--primary-dark) 0%, var(--primary-medium) 100%);
            padding: 32px 42px;
            position: relative;
        }

        .admin-header::after {
            content: "👩‍💼";
            font-size: 130px;
            opacity: 0.08;
            position: absolute;
            bottom: -20px;
            right: 20px;
            pointer-events: none;
        }

        .admin-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .title-section h1 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: white;
            letter-spacing: -0.3px;
            margin-bottom: 8px;
        }

        .title-section p {
            color: rgba(255,255,255,0.85);
            font-size: 0.9rem;
        }

        .admin-badge {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(6px);
            border-radius: 60px;
            padding: 8px 24px;
            text-align: center;
        }

        .admin-badge i {
            margin-right: 8px;
        }

        /* filter bar */
        .filter-bar {
            padding: 28px 42px;
            background: var(--light-bg);
            border-bottom: 1px solid rgba(77, 143, 204, 0.2);
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: flex-end;
        }

        .filter-group {
            flex: 1;
            min-width: 180px;
        }

        .filter-group label {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--primary-medium);
            margin-bottom: 6px;
        }

        .filter-group input, .filter-group select {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid rgba(77, 143, 204, 0.3);
            border-radius: 60px;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            background: var(--white);
            transition: 0.2s;
        }

        .filter-group input:focus, .filter-group select:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(77, 143, 204, 0.2);
        }

        .quick-buttons {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .quick-btn {
            background: var(--white);
            border: 1px solid var(--primary-light);
            padding: 10px 18px;
            border-radius: 60px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--primary-medium);
            cursor: pointer;
            transition: 0.2s;
        }

        .quick-btn:hover {
            background: var(--primary-light);
            color: white;
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
            padding: 20px 28px;
            flex: 1;
            min-width: 160px;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(77, 143, 204, 0.15);
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
            font-size: 1.4rem;
        }

        .stat-info h3 {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 6px;
        }

        .stat-number {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--primary-dark);
        }

        /* attendance table */
        .table-wrapper {
            margin: 32px 42px 42px 42px;
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
            min-width: 600px;
        }

        .attendance-table th {
            background: var(--light-bg);
            padding: 18px 16px;
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

        .time-stamp {
            font-size: 0.7rem;
            color: var(--text-muted);
        }

        .empty-state {
            text-align: center;
            padding: 60px 24px;
            color: var(--text-muted);
            background: var(--light-bg);
            border-radius: 28px;
            margin: 20px 42px;
        }

        footer {
            background: var(--primary-dark);
            padding: 24px 42px;
            text-align: center;
            color: #bcd0e6;
            font-size: 0.8rem;
        }

        @media (max-width: 780px) {
            body { padding: 16px; }
            .admin-header { padding: 24px 24px; }
            .filter-bar { padding: 20px 24px; flex-direction: column; align-items: stretch; }
            .quick-buttons { justify-content: flex-start; }
            .stats-row { padding: 20px 24px 0 24px; }
            .table-wrapper { margin: 24px 24px 32px 24px; }
            .empty-state { margin: 20px 24px; }
        }

        @media (max-width: 480px) {
            .stat-card { min-width: 100%; }
            .attendance-table th, .attendance-table td { padding: 10px 12px; }
        }

        .toast {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--primary-dark);
            color: white;
            padding: 12px 28px;
            border-radius: 60px;
            font-weight: 500;
            z-index: 1000;
            font-size: 0.9rem;
            pointer-events: none;
            transition: 0.2s;
            opacity: 0;
        }
        .toast.show { opacity: 1; bottom: 40px; }
    </style>
</head>
<body>

<div class="admin-container">
    <div class="admin-header">
        <div class="admin-info">
            <div class="title-section">
                <h1><i class="fas fa-chalkboard-user"></i> Attendance Oversight</h1>
                <p><i class="fas fa-shield-alt"></i> Admin · Dr. Sarah Chen · View student attendance records</p>
            </div>
            <div class="admin-badge">
                <i class="fas fa-calendar-alt"></i> Spring 2025
            </div>
        </div>
    </div>

    <!-- Filter Controls -->
    <div class="filter-bar">
        <div class="filter-group">
            <label><i class="fas fa-calendar-day"></i> Select Date</label>
            <input type="date" id="attendanceDate" value="">
        </div>
        <div class="filter-group">
            <label><i class="fas fa-book"></i> Course</label>
            <select id="courseSelect">
                <option value="all">All Courses</option>
            </select>
        </div>
        <div class="quick-buttons">
            <button class="quick-btn" id="yesterdayBtn"><i class="fas fa-arrow-left"></i> Yesterday</button>
            <button class="quick-btn" id="todayBtn">Today</button>
            <button class="quick-btn" id="weekBtn"><i class="fas fa-calendar-week"></i> Last 7 days</button>
        </div>
    </div>

    <!-- Stats Cards -->
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
            <div class="stat-icon"><i class="fas fa-percent"></i></div>
            <div class="stat-info">
                <h3>Attendance Rate</h3>
                <div class="stat-number" id="attRate">0%</div>
            </div>
        </div>
    </div>

    <!-- Attendance Table -->
    <div id="tableContainer">
        <div class="table-wrapper">
            <table class="attendance-table">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Status</th>
                        <th>Sign-in Time</th>
                    </tr>
                </thead>
                <tbody id="attendanceTableBody">
                    <tr><td colspan="4" style="text-align: center;">Loading...</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <footer>
        <p><i class="fas fa-chart-line"></i> Real-time attendance records · T&T School Admin Portal</p>
        <p style="font-size: 0.7rem;">Data persists locally · accurate reflection of student check-ins</p>
    </footer>
</div>

<div id="toastMsg" class="toast"></div>

<script>
    // ---------- MOCK DATA ----------
    // Student list
    const students = [
        { id: "STU-1001", name: "Olivia Chen" },
        { id: "STU-1002", name: "Liam Rodriguez" },
        { id: "STU-1003", name: "Emma Thompson" },
        { id: "STU-1004", name: "Noah Williams" },
        { id: "STU-1005", name: "Ava Johnson" },
        { id: "STU-1006", name: "Mason Brown" },
        { id: "STU-1007", name: "Sophia Davis" },
        { id: "STU-1008", name: "Ethan Miller" },
        { id: "STU-1009", name: "Isabella Wilson" },
        { id: "STU-1010", name: "James Martinez" }
    ];

    // Courses list
    const courses = [
        { id: "CS210", name: "Data Structures" },
        { id: "MATH205", name: "Calculus II" },
        { id: "ENG210", name: "Academic Writing" },
        { id: "PHYS101", name: "Physics: Mechanics" }
    ];

    // Storage key for attendance records (shared with student side if needed)
    const STORAGE_KEY = "tt_admin_attendance_records";

    // Helper: get today's date as YYYY-MM-DD
    function getTodayDate() {
        const today = new Date();
        return today.toISOString().slice(0,10);
    }

    // Generate mock attendance data for past dates (to simulate previous classes)
    // We'll populate localStorage if empty or incomplete.
    function generateMockAttendance() {
        let records = [];
        const startDate = new Date(2025, 2, 1); // March 1, 2025
        const endDate = new Date(); // today
        let current = new Date(startDate);
        
        // For each course, for each day in range, generate random attendance (60-90% present)
        while (current <= endDate) {
            const dateStr = current.toISOString().slice(0,10);
            // Only weekdays (Monday to Friday) for class days
            const dayOfWeek = current.getDay();
            if (dayOfWeek >= 1 && dayOfWeek <= 5) {
                courses.forEach(course => {
                    // Randomly decide if this course meets on this day (simplified: each course meets 2-3 times a week)
                    // For realism, CS210 meets Mon/Wed, MATH205 Mon/Wed, ENG210 Tue/Thu, PHYS101 Mon/Thu
                    let meets = false;
                    if (course.id === "CS210" && (dayOfWeek === 1 || dayOfWeek === 3)) meets = true;
                    if (course.id === "MATH205" && (dayOfWeek === 1 || dayOfWeek === 3)) meets = true;
                    if (course.id === "ENG210" && (dayOfWeek === 2 || dayOfWeek === 4)) meets = true;
                    if (course.id === "PHYS101" && (dayOfWeek === 1 || dayOfWeek === 4)) meets = true;
                    
                    if (meets) {
                        students.forEach(student => {
                            // 75% chance present for past days, for today we'll simulate based on a separate "signed" logic
                            const isPresent = Math.random() < 0.75;
                            if (isPresent) {
                                records.push({
                                    studentId: student.id,
                                    studentName: student.name,
                                    courseId: course.id,
                                    courseName: course.name,
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

    // Load or initialize attendance records
    let attendanceRecords = [];

    function loadAttendanceRecords() {
        const stored = localStorage.getItem(STORAGE_KEY);
        if (stored) {
            try {
                attendanceRecords = JSON.parse(stored);
                // if empty or too old, regenerate some mock
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

    // Get attendance for specific date and course (or all courses)
    function getAttendanceForDateAndCourse(date, courseId = null) {
        let filtered = attendanceRecords.filter(rec => rec.date === date);
        if (courseId && courseId !== "all") {
            filtered = filtered.filter(rec => rec.courseId === courseId);
        }
        // Group by student: for a given date and course, a student can only have one record
        const studentMap = new Map();
        filtered.forEach(rec => {
            if (!studentMap.has(rec.studentId)) {
                studentMap.set(rec.studentId, rec);
            }
        });
        return Array.from(studentMap.values());
    }

    // Build full attendance table for selected date & course
    function renderAttendanceTable(date, courseId) {
        const tbody = document.getElementById('attendanceTableBody');
        if (!tbody) return;

        const presentRecords = getAttendanceForDateAndCourse(date, courseId);
        const presentStudentIds = new Set(presentRecords.map(r => r.studentId));

        // For all students, determine present/absent
        let rows = '';
        students.forEach(student => {
            const record = presentRecords.find(r => r.studentId === student.id);
            const isPresent = !!record;
            rows += `
                <tr>
                    <td>${student.id}</td>
                    <td><strong>${escapeHtml(student.name)}</strong></td>
                    <td>
                        ${isPresent ? 
                            '<span class="present-badge"><i class="fas fa-check"></i> Present</span>' : 
                            '<span class="absent-badge"><i class="fas fa-times"></i> Absent</span>'}
                    </td>
                    <td class="time-stamp">
                        ${isPresent ? `<i class="far fa-clock"></i> ${record.timestamp || 'Signed'}` : '—'}
                    </td>
                </tr>
            `;
        });
        tbody.innerHTML = rows;

        // Update stats
        const presentCount = presentStudentIds.size;
        const absentCount = students.length - presentCount;
        const attendanceRate = students.length ? ((presentCount / students.length) * 100).toFixed(1) : 0;

        document.getElementById('totalStudents').innerText = students.length;
        document.getElementById('presentCount').innerText = presentCount;
        document.getElementById('absentCount').innerText = absentCount;
        document.getElementById('attRate').innerText = `${attendanceRate}%`;

        // Show a toast if no data for this date (optional)
        if (presentCount === 0 && students.length > 0) {
            showToast(`No attendance records for ${date} ${courseId !== 'all' ? 'in selected course' : ''}.`, false);
        }
    }

    // Populate course dropdown
    function populateCourses() {
        const select = document.getElementById('courseSelect');
        if (!select) return;
        select.innerHTML = '<option value="all">All Courses</option>';
        courses.forEach(course => {
            select.innerHTML += `<option value="${course.id}">${course.name} (${course.id})</option>`;
        });
    }

    // Set date picker to today initially
    function setDatePicker() {
        const today = getTodayDate();
        const dateInput = document.getElementById('attendanceDate');
        if (dateInput) {
            dateInput.value = today;
        }
    }

    // Handle filter changes
    function applyFilters() {
        const date = document.getElementById('attendanceDate').value;
        const courseId = document.getElementById('courseSelect').value;
        if (!date) {
            showToast("Please select a date", true);
            return;
        }
        renderAttendanceTable(date, courseId);
    }

    // Quick date buttons
    function setupQuickButtons() {
        const todayBtn = document.getElementById('todayBtn');
        const yesterdayBtn = document.getElementById('yesterdayBtn');
        const weekBtn = document.getElementById('weekBtn');
        const dateInput = document.getElementById('attendanceDate');

        todayBtn.addEventListener('click', () => {
            dateInput.value = getTodayDate();
            applyFilters();
        });

        yesterdayBtn.addEventListener('click', () => {
            const today = new Date();
            today.setDate(today.getDate() - 1);
            const yest = today.toISOString().slice(0,10);
            dateInput.value = yest;
            applyFilters();
        });

        weekBtn.addEventListener('click', () => {
            const today = new Date();
            const oneWeekAgo = new Date();
            oneWeekAgo.setDate(today.getDate() - 7);
            const dateStr = oneWeekAgo.toISOString().slice(0,10);
            dateInput.value = dateStr;
            applyFilters();
            showToast(`Showing attendance for ${dateStr} (last 7 days)`, false);
        });
    }

    // Helper: show toast
    function showToast(message, isError = false) {
        const toast = document.getElementById('toastMsg');
        toast.textContent = message;
        toast.style.backgroundColor = isError ? '#c23b22' : '#00509E';
        toast.classList.add('show');
        setTimeout(() => {
            toast.classList.remove('show');
        }, 2800);
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

    // Initialize the page
    function init() {
        loadAttendanceRecords();
        populateCourses();
        setDatePicker();
        setupQuickButtons();
        applyFilters(); // initial render with today's date & all courses

        // Add event listeners for filter changes
        document.getElementById('attendanceDate').addEventListener('change', applyFilters);
        document.getElementById('courseSelect').addEventListener('change', applyFilters);
    }

    init();
</script>
</body>
</html>