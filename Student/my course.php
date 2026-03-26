<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>T&T School | Course Hub — My Registrations</title>
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
            --danger: #c23b22;
            --border-radius-card: 28px;
            --border-radius-element: 20px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(145deg, #eef5fc 0%, #e2edf7 100%);
            color: var(--text-dark);
            line-height: 1.5;
            padding: 28px 20px;
            min-height: 100vh;
        }

        .dashboard-container {
            max-width: 1440px;
            margin: 0 auto;
            background: var(--white);
            border-radius: 42px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
            transition: all 0.2s;
        }

        /* header with student identity */
        .header-glow {
            background: linear-gradient(115deg, var(--primary-dark) 0%, var(--primary-medium) 100%);
            padding: 28px 42px;
            position: relative;
            overflow: hidden;
        }

        .header-glow::after {
            content: "📚";
            font-size: 140px;
            opacity: 0.08;
            position: absolute;
            bottom: -20px;
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

        .welcome-badge h1 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: white;
            letter-spacing: -0.3px;
            margin-bottom: 8px;
        }

        .welcome-badge p {
            color: rgba(255,255,255,0.85);
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .student-id-badge {
            background: rgba(255,255,255,0.18);
            backdrop-filter: blur(2px);
            padding: 6px 16px;
            border-radius: 60px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .stats-mini {
            display: flex;
            gap: 24px;
            background: rgba(255,255,255,0.12);
            padding: 10px 24px;
            border-radius: 60px;
            backdrop-filter: blur(4px);
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-weight: 800;
            font-size: 1.7rem;
            color: white;
            line-height: 1.2;
        }

        .stat-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: rgba(255,255,240,0.8);
        }

        /* main content */
        .main-content {
            padding: 38px 42px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            flex-wrap: wrap;
            margin-bottom: 28px;
        }

        .section-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-dark);
            position: relative;
            display: inline-block;
            letter-spacing: -0.2px;
        }

        .section-title i {
            color: var(--primary-light);
            margin-right: 12px;
            font-size: 1.6rem;
        }

        .credit-pill {
            background: var(--light-bg);
            padding: 6px 18px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--primary-medium);
            border: 1px solid rgba(77, 143, 204, 0.3);
        }

        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 28px;
            margin-bottom: 56px;
        }

        /* course card */
        .course-card {
            background: var(--white);
            border-radius: var(--border-radius-card);
            box-shadow: var(--shadow-sm);
            transition: all 0.25s ease;
            border: 1px solid rgba(77, 143, 204, 0.2);
            overflow: hidden;
            position: relative;
            backdrop-filter: blur(0px);
        }

        .course-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 30px -12px rgba(0, 51, 102, 0.2);
            border-color: var(--primary-light);
        }

        .card-body {
            padding: 24px 24px 20px;
        }

        .course-badge {
            display: inline-block;
            background: var(--light-bg);
            color: var(--primary-medium);
            font-size: 0.7rem;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 40px;
            letter-spacing: 0.3px;
            margin-bottom: 16px;
        }

        .course-title {
            font-size: 1.45rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .course-code {
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--primary-light);
            margin-bottom: 14px;
            display: inline-block;
            background: rgba(77,143,204,0.1);
            padding: 2px 10px;
            border-radius: 30px;
        }

        .course-details {
            margin: 16px 0;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .detail-row {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.85rem;
            color: var(--text-soft);
        }

        .detail-row i {
            width: 24px;
            color: var(--primary-light);
            font-size: 0.9rem;
        }

        .credits-chip {
            background: #eef2fa;
            padding: 4px 10px;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.75rem;
            color: var(--primary-dark);
        }

        .card-actions {
            padding: 12px 24px 24px;
            border-top: 1px solid rgba(0, 81, 158, 0.08);
            display: flex;
            gap: 12px;
        }

        .btn {
            border: none;
            font-weight: 600;
            padding: 10px 0;
            border-radius: 50px;
            font-size: 0.85rem;
            cursor: pointer;
            transition: 0.2s;
            width: 100%;
            font-family: 'Inter', sans-serif;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(95deg, var(--primary-medium), var(--primary-light));
            color: white;
            box-shadow: 0 4px 8px rgba(0,81,158,0.2);
        }

        .btn-primary:hover {
            background: linear-gradient(95deg, var(--primary-dark), var(--primary-medium));
            transform: scale(0.98);
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .btn-outline-danger {
            background: transparent;
            border: 1.5px solid #e0cfc9;
            color: var(--danger);
        }

        .btn-outline-danger:hover {
            background: #fff3f0;
            border-color: var(--danger);
        }

        .empty-state {
            background: var(--light-bg);
            border-radius: 40px;
            padding: 48px 24px;
            text-align: center;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--primary-light);
            margin-bottom: 16px;
            opacity: 0.6;
        }

        .toast-msg {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--primary-dark);
            color: white;
            padding: 12px 26px;
            border-radius: 60px;
            font-weight: 500;
            z-index: 1000;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            backdrop-filter: blur(8px);
            font-size: 0.9rem;
            pointer-events: none;
            transition: 0.2s;
            opacity: 0;
        }

        .toast-msg.show {
            opacity: 1;
            bottom: 40px;
        }

        footer {
            background: var(--primary-dark);
            padding: 28px 42px;
            text-align: center;
            color: #bcd0e6;
            font-size: 0.85rem;
            border-top: 1px solid rgba(255,255,255,0.05);
        }

        @media (max-width: 780px) {
            body { padding: 16px; }
            .main-content { padding: 24px 20px; }
            .header-glow { padding: 20px 24px; }
            .student-info { flex-direction: column; align-items: flex-start; }
            .stats-mini { width: 100%; justify-content: space-between; }
            .welcome-badge h1 { font-size: 1.7rem; }
            .section-title { font-size: 1.5rem; }
            .courses-grid { gap: 20px; }
            .btn { padding: 8px 0; }
        }

        @media (max-width: 480px) {
            .courses-grid { grid-template-columns: 1fr; }
            .card-body { padding: 18px; }
            .course-title { font-size: 1.25rem; }
        }

        .status-badge-enrolled {
            background: var(--success-light);
            color: var(--success);
            border-radius: 60px;
            font-size: 0.7rem;
            padding: 2px 10px;
            font-weight: 600;
            display: inline-block;
            margin-left: 8px;
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <!-- header student area -->
    <div class="header-glow">
        <div class="student-info">
            <div class="welcome-badge">
                <h1><i class="fas fa-graduation-cap" style="margin-right: 12px;"></i> My Course Studio</h1>
                <p>Olivia Chen · <span class="student-id-badge"><i class="far fa-id-card"></i> STU-2471-TT</span> 
                <span><i class="far fa-envelope"></i> olivia.chen@ttschool.edu</span></p>
            </div>
            <div class="stats-mini" id="statsPanel">
                <div class="stat-item"><div class="stat-number" id="totalCoursesStat">0</div><div class="stat-label">Enrolled</div></div>
                <div class="stat-item"><div class="stat-number" id="totalCreditsStat">0</div><div class="stat-label">Credits</div></div>
            </div>
        </div>
    </div>

    <div class="main-content">
        <!-- REGISTERED COURSES SECTION (View registered courses) -->
        <div class="section-header">
            <div class="section-title">
                <i class="fas fa-book-open"></i> My Registered Courses
            </div>
            <div class="credit-pill"><i class="fas fa-chalkboard-user"></i> Active semester · Spring 2025</div>
        </div>

        <div id="registeredCoursesContainer" class="courses-grid">
            <!-- dynamic registered cards -->
        </div>

        <!-- AVAILABLE COURSES CATALOG (view courses to register) -->
        <div class="section-header" style="margin-top: 16px;">
            <div class="section-title">
                <i class="fas fa-compass"></i> Explore & Register
            </div>
            <div class="credit-pill"><i class="fas fa-plus-circle"></i> Expand your skills</div>
        </div>

        <div id="availableCoursesContainer" class="courses-grid">
            <!-- dynamic available courses -->
        </div>
    </div>

    <footer>
        <p><i class="fas fa-university"></i> T&T School — smart course management · inclusive & accessible</p>
        <p style="font-size: 0.75rem; margin-top: 6px;">© 2025 T&T School | real-time enrollment hub</p>
    </footer>
</div>
<div id="toastMsg" class="toast-msg"></div>

<script>
    // ---------- COURSE DATABASE (rich & realistic) ----------
    const allCourses = [
        { id: "CS101", code: "CS 101", name: "Intro to Programming", instructor: "Dr. Ethan Rivera", credits: 3, schedule: "Mon/Wed 10:30–12:00", description: "Python & logic fundamentals", category: "CS" },
        { id: "CS210", code: "CS 210", name: "Data Structures", instructor: "Prof. Sophia Lin", credits: 4, schedule: "Tue/Thu 09:00–10:45", description: "Algorithms & efficiency" },
        { id: "MATH205", code: "MATH 205", name: "Calculus II", instructor: "Dr. James Carter", credits: 4, schedule: "Mon/Wed/Fri 08:30–09:45", description: "Integrals & series" },
        { id: "ENG210", code: "ENG 210", name: "Academic Writing", instructor: "Prof. Maya Gupta", credits: 3, schedule: "Tue/Thu 13:00–14:30", description: "Research & rhetoric" },
        { id: "PHYS101", code: "PHYS 101", name: "Physics: Mechanics", instructor: "Dr. Oliver Chen", credits: 4, schedule: "Mon/Wed 14:00–15:45", description: "Newtonian physics" },
        { id: "ART250", code: "ART 250", name: "Digital Design", instructor: "Elena Vasquez", credits: 3, schedule: "Fri 10:00–13:00", description: "UI/UX & creative tools" },
        { id: "DATA300", code: "DATA 300", name: "Data Science Intro", instructor: "Dr. Anika Sharma", credits: 3, schedule: "Tue/Thu 15:30–17:00", description: "Pandas, ML basics" },
        { id: "BUS202", code: "BUS 202", name: "Entrepreneurship", instructor: "Prof. Michael Osei", credits: 3, schedule: "Wed 16:00–19:00", description: "Startup mindset" },
        { id: "HIST101", code: "HIST 101", name: "World Civilizations", instructor: "Dr. Laura Bennett", credits: 3, schedule: "Mon 13:00–15:30", description: "Global heritage" },
        { id: "DS420", code: "DS 420", name: "Ethical AI", instructor: "Prof. Nadia K.", credits: 3, schedule: "Thu 11:00–13:30", description: "Responsible innovation" }
    ];

    // initial registered courses (student's current enrollment)
    let registeredIds = new Set(["CS101", "MATH205", "ENG210", "PHYS101"]);  // 4 courses

    // Helper: show floating message
    function showMessage(text, isError = false) {
        const toast = document.getElementById('toastMsg');
        toast.textContent = text;
        toast.style.background = isError ? '#c23b22' : '#00509E';
        toast.classList.add('show');
        setTimeout(() => {
            toast.classList.remove('show');
        }, 2400);
    }

    // Get course by id
    function getCourseById(id) {
        return allCourses.find(c => c.id === id);
    }

    // Render both sections & update stats
    function renderAll() {
        renderRegisteredCourses();
        renderAvailableCourses();
        updateStats();
    }

    // Render registered courses (student enrolled)
    function renderRegisteredCourses() {
        const container = document.getElementById('registeredCoursesContainer');
        const registeredCoursesList = Array.from(registeredIds).map(id => getCourseById(id)).filter(c => c);
        
        if (registeredCoursesList.length === 0) {
            container.innerHTML = `
                <div class="empty-state" style="grid-column:1/-1;">
                    <i class="fas fa-folder-open"></i>
                    <h3 style="margin: 10px 0;">No registered courses yet</h3>
                    <p>Browse the catalog below and enroll in exciting classes ✨</p>
                </div>
            `;
            return;
        }
        
        container.innerHTML = registeredCoursesList.map(course => `
            <div class="course-card" data-course-id="${course.id}">
                <div class="card-body">
                    <div style="display:flex; justify-content: space-between; align-items:center;">
                        <span class="course-badge"><i class="fas fa-check-circle"></i> Enrolled</span>
                        <span class="credits-chip"><i class="fas fa-star-of-life"></i> ${course.credits} credits</span>
                    </div>
                    <h3 class="course-title">${escapeHtml(course.name)}</h3>
                    <span class="course-code">${course.code}</span>
                    <div class="course-details">
                        <div class="detail-row"><i class="fas fa-chalkboard-user"></i> <span>${escapeHtml(course.instructor)}</span></div>
                        <div class="detail-row"><i class="far fa-clock"></i> <span>${course.schedule}</span></div>
                        <div class="detail-row"><i class="fas fa-layer-group"></i> <span>${course.description}</span></div>
                    </div>
                </div>
                <div class="card-actions">
                    <button class="btn btn-outline-danger drop-btn" data-id="${course.id}"><i class="fas fa-trash-alt"></i> Drop Course</button>
                </div>
            </div>
        `).join('');
        
        // attach drop events
        document.querySelectorAll('.drop-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const courseId = btn.getAttribute('data-id');
                dropCourse(courseId);
            });
        });
    }
    
    // Render available courses (not registered)
    function renderAvailableCourses() {
        const container = document.getElementById('availableCoursesContainer');
        const available = allCourses.filter(course => !registeredIds.has(course.id));
        
        if (available.length === 0) {
            container.innerHTML = `
                <div class="empty-state" style="grid-column:1/-1;">
                    <i class="fas fa-trophy"></i>
                    <h3>All courses enrolled! 🎉</h3>
                    <p>You've registered for every course. Amazing dedication!</p>
                </div>
            `;
            return;
        }
        
        container.innerHTML = available.map(course => `
            <div class="course-card" data-course-id="${course.id}">
                <div class="card-body">
                    <div style="display:flex; justify-content: space-between;">
                        <span class="course-badge"><i class="fas fa-gem"></i> Available</span>
                        <span class="credits-chip"><i class="fas fa-coins"></i> ${course.credits} cr</span>
                    </div>
                    <h3 class="course-title">${escapeHtml(course.name)}</h3>
                    <span class="course-code">${course.code}</span>
                    <div class="course-details">
                        <div class="detail-row"><i class="fas fa-user-graduate"></i> ${escapeHtml(course.instructor)}</div>
                        <div class="detail-row"><i class="far fa-calendar-alt"></i> ${course.schedule}</div>
                        <div class="detail-row"><i class="fas fa-microchip"></i> ${course.description}</div>
                    </div>
                </div>
                <div class="card-actions">
                    <button class="btn btn-primary register-btn" data-id="${course.id}"><i class="fas fa-plus-circle"></i> Register Now</button>
                </div>
            </div>
        `).join('');
        
        document.querySelectorAll('.register-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const courseId = btn.getAttribute('data-id');
                registerCourse(courseId);
            });
        });
    }
    
    // Register logic
    function registerCourse(courseId) {
        const course = getCourseById(courseId);
        if (!course) return;
        if (registeredIds.has(courseId)) {
            showMessage(`⚠️ You are already registered in ${course.name}`, true);
            return;
        }
        // optional: max credits limit (soft limit 21, just friendly)
        let currentCredits = Array.from(registeredIds).reduce((sum, id) => sum + (getCourseById(id)?.credits || 0), 0);
        if (currentCredits + course.credits > 24) {
            showMessage(`⚠️ Credit overload (max 24). You have ${currentCredits} credits. Drop a course first.`, true);
            return;
        }
        registeredIds.add(courseId);
        renderAll();
        showMessage(`✅ Success! ${course.name} added to your schedule.`, false);
    }
    
    // Drop course
    function dropCourse(courseId) {
        const course = getCourseById(courseId);
        if (!course) return;
        if (!registeredIds.has(courseId)) {
            showMessage(`❌ ${course.name} is not in your registered list.`, true);
            return;
        }
        // confirm for smoother UX
        if (confirm(`Are you sure you want to drop "${course.name}"? This will free up ${course.credits} credits.`)) {
            registeredIds.delete(courseId);
            renderAll();
            showMessage(`🗑️ Dropped: ${course.name}. You can re-register anytime.`, false);
        }
    }
    
    // update total enrolled & credits
    function updateStats() {
        const registeredCoursesList = Array.from(registeredIds).map(id => getCourseById(id)).filter(c => c);
        const totalCourses = registeredCoursesList.length;
        const totalCredits = registeredCoursesList.reduce((sum, c) => sum + c.credits, 0);
        document.getElementById('totalCoursesStat').innerText = totalCourses;
        document.getElementById('totalCreditsStat').innerText = totalCredits;
    }
    
    // simple escape
    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/[&<>]/g, function(m) {
            if (m === '&') return '&amp;';
            if (m === '<') return '&lt;';
            if (m === '>') return '&gt;';
            return m;
        }).replace(/[\uD800-\uDBFF][\uDC00-\uDFFF]/g, function(c) {
            return c;
        });
    }
    
    // initialize page
    renderAll();
    
    // subtle micro-interaction for responsive dynamic resizing - no extra
    window.addEventListener('resize', () => {});
</script>
</body>
</html>