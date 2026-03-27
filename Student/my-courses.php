<?php
require_once '../auth/session.php';
checkAccess('student');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses - T&T School Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/student-dashboard.css">
    <style>
        /* Unique styles for My Courses Hub */
        .header-glow {
            background: linear-gradient(115deg, var(--primary-dark) 0%, var(--primary-medium) 100%);
            padding: 28px 42px;
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            color: white;
            margin-bottom: 30px;
        }

        .header-glow::after {
            content: "📚";
            font-size: 100px;
            opacity: 0.08;
            position: absolute;
            bottom: -10px;
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

        .welcome-badge h2 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: white;
            margin-bottom: 8px;
        }

        .welcome-badge p {
            color: rgba(255,255,255,0.85);
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .student-id-badge {
            background: rgba(255,255,255,0.18);
            backdrop-filter: blur(2px);
            padding: 4px 12px;
            border-radius: 60px;
            font-size: 0.8rem;
        }

        .stats-mini {
            display: flex;
            gap: 20px;
            background: rgba(255,255,255,0.12);
            padding: 10px 20px;
            border-radius: 40px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-weight: 800;
            font-size: 1.4rem;
            color: white;
        }

        .stat-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            color: rgba(255,255,240,0.8);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: var(--primary-light);
        }

        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .course-card {
            background: var(--white);
            border-radius: 20px;
            box-shadow: var(--shadow);
            transition: all 0.25s ease;
            border: 1px solid rgba(77, 143, 204, 0.2);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 51, 102, 0.1);
        }

        .card-body {
            padding: 20px;
            flex: 1;
        }

        .course-badge {
            display: inline-block;
            background: var(--light-bg);
            color: var(--primary-medium);
            font-size: 0.7rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 30px;
            margin-bottom: 12px;
        }

        .course-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 5px;
        }

        .course-code {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--primary-light);
            background: rgba(77,143,204,0.1);
            padding: 2px 8px;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 15px;
        }

        .course-details {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .detail-row {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.85rem;
            color: var(--text-light);
        }

        .detail-row i {
            width: 20px;
            color: var(--primary-light);
        }

        .credits-chip {
            background: #eef2fa;
            padding: 4px 10px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.7rem;
            color: var(--primary-dark);
        }

        .card-actions {
            padding: 15px 20px 20px;
            border-top: 1px solid rgba(0, 81, 158, 0.05);
            display: flex;
            gap: 10px;
        }

        .btn-sm {
            padding: 8px 15px;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            transition: 0.2s;
        }

        .btn-register {
            background: linear-gradient(95deg, var(--primary-medium), var(--primary-light));
            color: white;
        }

        .btn-drop {
            background: transparent;
            border: 1px solid #ffcdd2;
            color: var(--danger);
        }

        .btn-drop:hover {
            background: #ffebee;
        }

        .toast-msg {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--primary-dark);
            color: white;
            padding: 12px 25px;
            border-radius: 50px;
            font-size: 0.9rem;
            z-index: 1000;
            opacity: 0;
            transition: 0.3s;
            pointer-events: none;
        }

        .toast-msg.show {
            opacity: 1;
            bottom: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <?php include '../include/student-sidebar.php'; ?>
        
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
                        <h1>My Course Hub</h1>
                    </div>
                </div>
                
                <div class="header-right">
                    <div class="header-action">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="header-action">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div class="header-action">
                        <i class="fas fa-user-circle"></i>
                    </div>
                </div>
            </div>
            
            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <!-- Header Glow -->
                <div class="header-glow">
                    <div class="student-info">
                        <div class="welcome-badge">
                            <h2><i class="fas fa-graduation-cap" style="margin-right: 12px;"></i> My Course Studio</h2>
                            <p>Michael Johnson · <span class="student-id-badge">STU-2471-TT</span> <span>michael.j@ttschool.edu</span></p>
                        </div>
                        <div class="stats-mini">
                            <div class="stat-item"><div class="stat-number" id="totalCoursesStat">4</div><div class="stat-label">Enrolled</div></div>
                            <div class="stat-item"><div class="stat-number" id="totalCreditsStat">15</div><div class="stat-label">Credits</div></div>
                        </div>
                    </div>
                </div>

                <!-- Enrolled Courses -->
                <div class="section-header">
                    <div class="section-title">
                        <i class="fas fa-book-open"></i> My Registered Courses
                    </div>
                </div>

                <div id="registeredCoursesContainer" class="courses-grid">
                    <!-- Cards will be injected by JS -->
                </div>

                <!-- Available Courses -->
                <div class="section-header">
                    <div class="section-title">
                        <i class="fas fa-compass"></i> Explore & Register
                    </div>
                </div>

                <div id="availableCoursesContainer" class="courses-grid">
                    <!-- Cards will be injected by JS -->
                </div>

                <!-- Footer -->
                <div class="dashboard-footer">
                    <p>&copy; 2023 T&T School Management System. All rights reserved. | Student Portal v2.3</p>
                </div>
            </div>
        </div>
    </div>

    <div id="toastMsg" class="toast-msg"></div>

    <script>
        // DOM Elements
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const menuToggle = document.getElementById('menuToggle');
        
        // Sidebar Toggle
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

        // Course Data
        const allCourses = [
            { id: "CS101", code: "CS 101", name: "Intro to Programming", instructor: "Dr. Ethan Rivera", credits: 3, schedule: "Mon/Wed 10:30–12:00", description: "Python & logic fundamentals" },
            { id: "CS210", code: "CS 210", name: "Data Structures", instructor: "Prof. Sophia Lin", credits: 4, schedule: "Tue/Thu 09:00–10:45", description: "Algorithms & efficiency" },
            { id: "MATH205", code: "MATH 205", name: "Calculus II", instructor: "Dr. James Carter", credits: 4, schedule: "Mon/Wed/Fri 08:30–09:45", description: "Integrals & series" },
            { id: "ENG210", code: "ENG 210", name: "Academic Writing", instructor: "Prof. Maya Gupta", credits: 3, schedule: "Tue/Thu 13:00–14:30", description: "Research & rhetoric" },
            { id: "PHYS101", code: "PHYS 101", name: "Physics: Mechanics", instructor: "Dr. Oliver Chen", credits: 4, schedule: "Mon/Wed 14:00–15:45", description: "Newtonian physics" },
            { id: "ART250", code: "ART 250", name: "Digital Design", instructor: "Elena Vasquez", credits: 3, schedule: "Fri 10:00–13:00", description: "UI/UX & creative tools" }
        ];

        let registeredIds = new Set(["CS101", "MATH205", "ENG210", "PHYS101"]);

        function showMessage(text, isError = false) {
            const toast = document.getElementById('toastMsg');
            toast.textContent = text;
            toast.style.background = isError ? 'var(--danger)' : 'var(--primary-dark)';
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 2400);
        }

        function renderAll() {
            renderRegistered();
            renderAvailable();
            updateStats();
        }

        function renderRegistered() {
            const container = document.getElementById('registeredCoursesContainer');
            const registered = allCourses.filter(c => registeredIds.has(c.id));
            
            container.innerHTML = registered.map(course => `
                <div class="course-card">
                    <div class="card-body">
                        <div style="display:flex; justify-content: space-between; align-items:center;">
                            <span class="course-badge"><i class="fas fa-check-circle"></i> Enrolled</span>
                            <span class="credits-chip">${course.credits} credits</span>
                        </div>
                        <h3 class="course-title">${course.name}</h3>
                        <span class="course-code">${course.code}</span>
                        <div class="course-details">
                            <div class="detail-row"><i class="fas fa-user-tie"></i> <span>${course.instructor}</span></div>
                            <div class="detail-row"><i class="far fa-clock"></i> <span>${course.schedule}</span></div>
                        </div>
                    </div>
                    <div class="card-actions">
                        <button class="btn-sm btn-drop" onclick="dropCourse('${course.id}')"><i class="fas fa-trash-alt"></i> Drop Course</button>
                    </div>
                </div>
            `).join('');
        }

        function renderAvailable() {
            const container = document.getElementById('availableCoursesContainer');
            const available = allCourses.filter(c => !registeredIds.has(c.id));
            
            container.innerHTML = available.map(course => `
                <div class="course-card">
                    <div class="card-body">
                        <div style="display:flex; justify-content: space-between;">
                            <span class="course-badge"><i class="fas fa-star"></i> Available</span>
                            <span class="credits-chip">${course.credits} credits</span>
                        </div>
                        <h3 class="course-title">${course.name}</h3>
                        <span class="course-code">${course.code}</span>
                        <div class="course-details">
                            <div class="detail-row"><i class="fas fa-user-tie"></i> ${course.instructor}</div>
                            <div class="detail-row"><i class="far fa-calendar-alt"></i> ${course.schedule}</div>
                        </div>
                    </div>
                    <div class="card-actions">
                        <button class="btn-sm btn-register" onclick="registerCourse('${course.id}')"><i class="fas fa-plus-circle"></i> Register Now</button>
                    </div>
                </div>
            `).join('');
        }

        function registerCourse(id) {
            registeredIds.add(id);
            renderAll();
            showMessage("Course added successfully!");
        }

        function dropCourse(id) {
            if (confirm("Are you sure you want to drop this course?")) {
                registeredIds.delete(id);
                renderAll();
                showMessage("Course dropped.", true);
            }
        }

        function updateStats() {
            const registered = allCourses.filter(c => registeredIds.has(c.id));
            document.getElementById('totalCoursesStat').innerText = registered.length;
            document.getElementById('totalCreditsStat').innerText = registered.reduce((sum, c) => sum + c.credits, 0);
        }

        renderAll();
    </script>
</body>
</html>
