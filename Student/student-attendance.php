<?php
require_once '../auth/session.php';
checkAccess('student');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance - T&T School Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/student-dashboard.css">
    <style>
        /* Unique styles for Attendance */
        .attendance-header {
            background: linear-gradient(115deg, var(--primary-dark) 0%, var(--primary-medium) 100%);
            padding: 32px 42px;
            position: relative;
            border-radius: 20px;
            color: white;
            margin-bottom: 30px;
        }

        .attendance-header::after {
            content: "📋";
            font-size: 100px;
            opacity: 0.08;
            position: absolute;
            bottom: -20px;
            right: 20px;
            pointer-events: none;
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
        }

        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
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
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 51, 102, 0.1);
        }

        .card-header {
            padding: 20px 24px 12px;
            border-bottom: 1px solid rgba(0,81,158,0.05);
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
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 6px;
        }

        .course-meta {
            font-size: 0.8rem;
            color: var(--text-light);
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
            padding: 12px;
            border-radius: 30px;
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

        .history-wrapper {
            overflow-x: auto;
            border-radius: 20px;
            background: var(--white);
            box-shadow: var(--shadow);
            border: 1px solid rgba(0, 81, 158, 0.1);
            margin-top: 16px;
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }

        .history-table th {
            background: var(--light-bg);
            padding: 16px;
            text-align: left;
            font-weight: 700;
            color: var(--primary-dark);
        }

        .history-table td {
            padding: 14px 16px;
            border-bottom: 1px solid rgba(0, 81, 158, 0.05);
            color: var(--text-dark);
        }

        .status-present {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 2px 12px;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 600;
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
                        <h1>Attendance Portal</h1>
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
                <!-- Header -->
                <div class="attendance-header">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
                        <div>
                            <h2 style="color: white; margin-bottom: 5px;"><i class="fas fa-fingerprint"></i> Attendance Portal</h2>
                            <p style="color: rgba(255,255,255,0.85); font-size: 0.9rem;">Michael Johnson · STU-5214-TT · michael.j@ttschool.edu</p>
                        </div>
                        <div class="stats-badge">
                            <div class="percentage" id="attPercent">96%</div>
                            <div class="label">Attendance Rate</div>
                        </div>
                    </div>
                </div>

                <!-- Sign Attendance -->
                <div class="section-title">
                    <i class="fas fa-calendar-check"></i> Today's Classes
                </div>
                <div id="todayCoursesContainer" class="courses-grid">
                    <!-- dynamic course cards -->
                </div>

                <!-- History -->
                <div class="section-title" style="margin-top: 30px;">
                    <i class="fas fa-history"></i> Attendance History
                </div>
                <div id="historyContainer">
                    <!-- dynamic table or empty state -->
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

        const courses = [
            { id: "CS210", name: "Data Structures", instructor: "Prof. Sophia Lin", schedule: "Mon/Wed 9:00-10:30", room: "Room 304" },
            { id: "MATH205", name: "Calculus II", instructor: "Dr. James Carter", schedule: "Mon/Wed 11:00-12:30", room: "Hall 212" },
            { id: "ENG210", name: "Academic Writing", instructor: "Prof. Maya Gupta", schedule: "Tue/Thu 10:00-11:30", room: "Humanities 45" }
        ];

        let attendanceRecords = [
            { courseId: "CS210", courseName: "Data Structures", date: "2025-03-24", timestamp: "09:05 AM", status: "Present" },
            { courseId: "MATH205", courseName: "Calculus II", date: "2025-03-24", timestamp: "11:02 AM", status: "Present" }
        ];

        function showMessage(text) {
            const toast = document.getElementById('toastMsg');
            toast.textContent = text;
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 2400);
        }

        function renderAll() {
            renderToday();
            renderHistory();
        }

        function renderToday() {
            const container = document.getElementById('todayCoursesContainer');
            container.innerHTML = courses.map(course => {
                const signed = attendanceRecords.some(r => r.courseId === course.id && r.date === new Date().toISOString().split('T')[0]);
                return `
                    <div class="course-card">
                        <div class="card-header">
                            <span class="course-badge">${course.id}</span>
                            <h3 class="course-title">${course.name}</h3>
                            <div class="course-meta">
                                <span><i class="fas fa-user"></i> ${course.instructor}</span>
                                <span><i class="fas fa-location-dot"></i> ${course.room}</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <button class="sign-btn" onclick="sign('${course.id}', '${course.name}')" ${signed ? 'disabled' : ''}>
                                <i class="fas ${signed ? 'fa-check-circle' : 'fa-pen'}"></i> ${signed ? 'Signed' : 'Sign Attendance'}
                            </button>
                        </div>
                    </div>
                `;
            }).join('');
        }

        function renderHistory() {
            const container = document.getElementById('historyContainer');
            if (attendanceRecords.length === 0) {
                container.innerHTML = '<p>No records found.</p>';
                return;
            }

            let html = `
                <div class="history-wrapper">
                    <table class="history-table">
                        <thead>
                            <tr><th>Date</th><th>Course</th><th>Time</th><th>Status</th></tr>
                        </thead>
                        <tbody>
            `;
            attendanceRecords.slice().reverse().forEach(rec => {
                html += `
                    <tr>
                        <td>${rec.date}</td>
                        <td><strong>${rec.courseId}</strong> - ${rec.courseName}</td>
                        <td>${rec.timestamp}</td>
                        <td><span class="status-present">Present</span></td>
                    </tr>
                `;
            });
            html += '</tbody></table></div>';
            container.innerHTML = html;
        }

        function sign(id, name) {
            attendanceRecords.push({
                courseId: id,
                courseName: name,
                date: new Date().toISOString().split('T')[0],
                timestamp: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
                status: "Present"
            });
            renderAll();
            showMessage("Attendance recorded!");
        }

        renderAll();
    </script>
</body>
</html>
