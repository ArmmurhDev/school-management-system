<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>T&T School | Attendance Hub</title>
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
            --warning: #e67e22;
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

        .attendance-container {
            max-width: 1400px;
            margin: 0 auto;
            background: var(--white);
            border-radius: 42px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        /* header */
        .attendance-header {
            background: linear-gradient(115deg, var(--primary-dark) 0%, var(--primary-medium) 100%);
            padding: 32px 42px;
            position: relative;
        }

        .attendance-header::after {
            content: "📋";
            font-size: 130px;
            opacity: 0.08;
            position: absolute;
            bottom: -20px;
            right: 20px;
            pointer-events: none;
        }

        .student-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .student-info h1 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: white;
            letter-spacing: -0.3px;
            margin-bottom: 8px;
        }

        .student-info p {
            color: rgba(255,255,255,0.85);
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            font-size: 0.9rem;
        }

        .stats-badge {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(6px);
            border-radius: 60px;
            padding: 12px 24px;
            text-align: center;
        }

        .stats-badge .percentage {
            font-size: 1.8rem;
            font-weight: 800;
            color: white;
            line-height: 1;
        }

        .stats-badge .label {
            font-size: 0.7rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: rgba(255,255,240,0.8);
        }

        /* main content */
        .attendance-content {
            padding: 40px 42px;
        }

        .section-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-title i {
            color: var(--primary-light);
            font-size: 1.7rem;
        }

        /* sign-in cards */
        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 28px;
            margin-bottom: 56px;
        }

        .course-card {
            background: var(--white);
            border-radius: 28px;
            box-shadow: var(--shadow-sm);
            transition: all 0.25s ease;
            border: 1px solid rgba(77, 143, 204, 0.2);
            overflow: hidden;
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-light);
        }

        .card-header {
            padding: 20px 24px 12px;
            border-bottom: 1px solid rgba(0,81,158,0.08);
        }

        .course-badge {
            display: inline-block;
            background: var(--light-bg);
            color: var(--primary-medium);
            font-size: 0.7rem;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 40px;
            margin-bottom: 12px;
        }

        .course-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 6px;
        }

        .course-meta {
            font-size: 0.8rem;
            color: var(--text-muted);
            display: flex;
            gap: 12px;
            margin-top: 6px;
        }

        .card-actions {
            padding: 16px 24px 24px;
        }

        .sign-btn {
            background: linear-gradient(95deg, var(--primary-medium), var(--primary-light));
            border: none;
            width: 100%;
            padding: 12px 0;
            border-radius: 60px;
            font-weight: 700;
            font-size: 0.85rem;
            color: white;
            cursor: pointer;
            transition: 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .sign-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            background: #9bb7d4;
        }

        .sign-btn:hover:not(:disabled) {
            background: linear-gradient(95deg, var(--primary-dark), var(--primary-medium));
            transform: scale(0.98);
        }

        .already-signed {
            font-size: 0.75rem;
            text-align: center;
            margin-top: 10px;
            color: var(--success);
            font-weight: 500;
        }

        /* history table */
        .history-wrapper {
            overflow-x: auto;
            border-radius: 28px;
            background: var(--white);
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(0, 81, 158, 0.1);
            margin-top: 16px;
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
            min-width: 560px;
        }

        .history-table th {
            background: var(--light-bg);
            padding: 16px 16px;
            text-align: left;
            font-weight: 700;
            color: var(--primary-dark);
            border-bottom: 2px solid rgba(77, 143, 204, 0.3);
        }

        .history-table td {
            padding: 14px 16px;
            border-bottom: 1px solid rgba(0, 81, 158, 0.08);
            color: var(--text-soft);
        }

        .history-table tr:last-child td {
            border-bottom: none;
        }

        .empty-state {
            text-align: center;
            padding: 48px 24px;
            color: var(--text-muted);
            background: var(--light-bg);
            border-radius: 28px;
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
            .attendance-header { padding: 24px 24px; }
            .attendance-content { padding: 28px 20px; }
            .student-info h1 { font-size: 1.6rem; }
            .student-row { flex-direction: column; align-items: flex-start; }
        }

        @media (max-width: 480px) {
            .courses-grid { grid-template-columns: 1fr; }
            .history-table th, .history-table td { padding: 10px 12px; }
        }

        .toast-msg {
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
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            font-size: 0.9rem;
            pointer-events: none;
            transition: 0.2s;
            opacity: 0;
        }
        .toast-msg.show { opacity: 1; bottom: 40px; }
    </style>
</head>
<body>

<div class="attendance-container">
    <div class="attendance-header">
        <div class="student-row">
            <div class="student-info">
                <h1><i class="fas fa-fingerprint"></i> Attendance Portal</h1>
                <p><i class="fas fa-user-graduate"></i> Taylor Johnson · STU-5214-TT · <i class="fas fa-envelope"></i> taylor.j@ttschool.edu</p>
            </div>
            <div class="stats-badge" id="attendanceStats">
                <div class="percentage" id="attPercent">0%</div>
                <div class="label">Attendance Rate</div>
            </div>
        </div>
    </div>

    <div class="attendance-content">
        <!-- Sign Attendance Section -->
        <div class="section-title">
            <i class="fas fa-calendar-check"></i> Sign Attendance · Today's Classes
        </div>
        <div id="todayCoursesContainer" class="courses-grid">
            <!-- dynamic course cards -->
        </div>

        <!-- Attendance History Section -->
        <div class="section-title" style="margin-top: 24px;">
            <i class="fas fa-history"></i> My Attendance History
        </div>
        <div id="historyContainer">
            <!-- dynamic table or empty state -->
        </div>
    </div>

    <footer>
        <p><i class="fas fa-clock"></i> Sign in before the end of each class to record your presence.</p>
        <p style="font-size: 0.7rem;">T&T School · accurate attendance tracking</p>
    </footer>
</div>

<div id="toastMessage" class="toast-msg"></div>

<script>
    // ---------- MOCK COURSES (current semester) ----------
    const courses = [
        { id: "CS210", name: "Data Structures", instructor: "Prof. Sophia Lin", schedule: "Mon/Wed 9:00-10:30", room: "Room 304" },
        { id: "MATH205", name: "Calculus II", instructor: "Dr. James Carter", schedule: "Mon/Wed 11:00-12:30", room: "Hall 212" },
        { id: "ENG210", name: "Academic Writing", instructor: "Prof. Maya Gupta", schedule: "Tue/Thu 10:00-11:30", room: "Humanities 45" },
        { id: "PHYS101", name: "Physics: Mechanics", instructor: "Dr. Oliver Chen", schedule: "Mon 14:00-15:30, Thu 13:00-14:30", room: "Sci 101" }
    ];

    // localStorage key
    const STORAGE_KEY = "tt_attendance_records";

    // Helper: get today's date as YYYY-MM-DD (local)
    function getTodayDate() {
        const today = new Date();
        return today.toISOString().slice(0,10);
    }

    // Load attendance records from localStorage
    // structure: [{ courseId, courseName, date, timestamp, status }]
    let attendanceRecords = [];

    function loadRecords() {
        const stored = localStorage.getItem(STORAGE_KEY);
        if (stored) {
            try {
                attendanceRecords = JSON.parse(stored);
            } catch(e) { attendanceRecords = []; }
        } else {
            attendanceRecords = [];
        }
    }

    function saveRecords() {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(attendanceRecords));
    }

    // Check if a student already signed a specific course today
    function isSignedToday(courseId) {
        const today = getTodayDate();
        return attendanceRecords.some(record => record.courseId === courseId && record.date === today);
    }

    // Sign attendance for a course
    function signAttendance(courseId, courseName) {
        if (isSignedToday(courseId)) {
            showToast(`⚠️ You already signed attendance for ${courseName} today.`, true);
            return false;
        }
        const newRecord = {
            courseId: courseId,
            courseName: courseName,
            date: getTodayDate(),
            timestamp: new Date().toLocaleTimeString(),
            status: "Present"
        };
        attendanceRecords.push(newRecord);
        saveRecords();
        showToast(`✅ Attendance recorded for ${courseName}!`, false);
        renderAll();
        return true;
    }

    // Show toast message
    function showToast(message, isError = false) {
        const toast = document.getElementById('toastMessage');
        toast.textContent = message;
        toast.style.backgroundColor = isError ? '#c23b22' : '#00509E';
        toast.classList.add('show');
        setTimeout(() => {
            toast.classList.remove('show');
        }, 2800);
    }

    // Render today's courses (cards)
    function renderTodayCourses() {
        const container = document.getElementById('todayCoursesContainer');
        if (!container) return;
        const today = new Date();
        const weekday = today.toLocaleDateString('en-US', { weekday: 'long' });
        // For demo, we show all courses, but can filter by day if needed. We'll keep all and show status.
        let html = '';
        courses.forEach(course => {
            const signed = isSignedToday(course.id);
            html += `
                <div class="course-card">
                    <div class="card-header">
                        <span class="course-badge"><i class="fas fa-chalkboard"></i> ${course.id}</span>
                        <h3 class="course-title">${escapeHtml(course.name)}</h3>
                        <div class="course-meta">
                            <span><i class="fas fa-user"></i> ${escapeHtml(course.instructor)}</span>
                            <span><i class="fas fa-location-dot"></i> ${escapeHtml(course.room)}</span>
                        </div>
                        <div class="course-meta" style="margin-top: 6px;">
                            <span><i class="far fa-clock"></i> ${escapeHtml(course.schedule)}</span>
                        </div>
                    </div>
                    <div class="card-actions">
                        <button class="sign-btn" data-id="${course.id}" data-name="${escapeHtml(course.name)}" ${signed ? 'disabled' : ''}>
                            <i class="fas ${signed ? 'fa-check-circle' : 'fa-pen'}"></i> ${signed ? 'Already Signed' : 'Sign Attendance'}
                        </button>
                        ${signed ? '<div class="already-signed"><i class="fas fa-check"></i> Recorded for today</div>' : ''}
                    </div>
                </div>
            `;
        });
        container.innerHTML = html;

        // attach event listeners to sign buttons
        document.querySelectorAll('.sign-btn').forEach(btn => {
            if (!btn.disabled) {
                btn.addEventListener('click', (e) => {
                    const courseId = btn.getAttribute('data-id');
                    const courseName = btn.getAttribute('data-name');
                    signAttendance(courseId, courseName);
                });
            }
        });
    }

    // Render attendance history table
    function renderHistory() {
        const container = document.getElementById('historyContainer');
        if (!container) return;

        if (attendanceRecords.length === 0) {
            container.innerHTML = `<div class="empty-state"><i class="fas fa-calendar-alt"></i><p style="margin-top: 12px;">No attendance records yet. Sign in for today's classes above!</p></div>`;
            return;
        }

        // sort by date descending (most recent first)
        const sorted = [...attendanceRecords].sort((a,b) => b.date.localeCompare(a.date));
        let tableHtml = `
            <div class="history-wrapper">
                <table class="history-table">
                    <thead>
                        <tr><th>Date</th><th>Course Code</th><th>Course Name</th><th>Time Signed</th><th>Status</th></tr>
                    </thead>
                    <tbody>
        `;
        sorted.forEach(rec => {
            const displayDate = new Date(rec.date).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
            tableHtml += `
                <tr>
                    <td>${displayDate}</td>
                    <td><strong>${escapeHtml(rec.courseId)}</strong></td>
                    <td>${escapeHtml(rec.courseName)}</td>
                    <td>${rec.timestamp || '—'}</td>
                    <td><span style="background:#e0f5e3; color:#2b7e3a; padding:2px 12px; border-radius:40px; font-size:0.7rem; font-weight:600;">✓ Present</span></td>
                </tr>
            `;
        });
        tableHtml += `</tbody></table></div>`;
        container.innerHTML = tableHtml;
    }

    // Calculate attendance percentage based on total possible sessions
    // We define total sessions per course as number of days from semester start (simplified).
    // For realism: we assume semester started Jan 13, 2025, and today is within semester.
    // We'll calculate number of possible class meetings per course up to today.
    // But for simplicity and demo, we compute % based on number of signed days vs total possible class days (based on course schedule).
    // This function computes overall attendance % across all courses.
    function calculateAttendancePercentage() {
        const semesterStart = new Date(2025, 0, 13); // Jan 13, 2025
        const today = new Date();
        if (today < semesterStart) return 0;

        let totalPossible = 0;
        let totalAttended = 0;

        courses.forEach(course => {
            // determine meeting days per week from schedule string (simplified)
            let days = [];
            if (course.schedule.includes('Mon')) days.push(1);
            if (course.schedule.includes('Tue')) days.push(2);
            if (course.schedule.includes('Wed')) days.push(3);
            if (course.schedule.includes('Thu')) days.push(4);
            if (course.schedule.includes('Fri')) days.push(5);
            if (days.length === 0) days = [1,3]; // fallback

            // iterate weeks from semesterStart to today (excluding future dates)
            let current = new Date(semesterStart);
            let possibleCount = 0;
            while (current <= today) {
                const dayOfWeek = current.getDay(); // 1=Mon ... 5=Fri
                if (days.includes(dayOfWeek)) {
                    possibleCount++;
                }
                current.setDate(current.getDate() + 1);
            }
            totalPossible += possibleCount;

            // count attended records for this course
            const attendedCount = attendanceRecords.filter(rec => rec.courseId === course.id).length;
            totalAttended += attendedCount;
        });

        if (totalPossible === 0) return 0;
        const percent = (totalAttended / totalPossible) * 100;
        return Math.min(100, Math.round(percent));
    }

    // Update stats badge
    function updateStats() {
        const percent = calculateAttendancePercentage();
        document.getElementById('attPercent').innerText = `${percent}%`;
    }

    // Escape helper
    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/[&<>]/g, function(m) {
            if (m === '&') return '&amp;';
            if (m === '<') return '&lt;';
            if (m === '>') return '&gt;';
            return m;
        });
    }

    // Main render
    function renderAll() {
        renderTodayCourses();
        renderHistory();
        updateStats();
    }

    // Initialize
    loadRecords();
    renderAll();
</script>
</body>
</html>