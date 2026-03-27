<?php
require_once '../auth/session.php';
checkAccess('student');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule - T&T School Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/student-dashboard.css">
    <style>
        /* Unique styles for Schedule */
        .schedule-header {
            background: linear-gradient(115deg, var(--primary-dark) 0%, var(--primary-medium) 100%);
            padding: 32px 42px;
            position: relative;
            border-radius: 20px;
            color: white;
            margin-bottom: 30px;
        }

        .schedule-header::after {
            content: "📅";
            font-size: 100px;
            opacity: 0.08;
            position: absolute;
            bottom: -20px;
            right: 20px;
            pointer-events: none;
        }

        .term-badge {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(6px);
            border-radius: 60px;
            padding: 12px 24px;
            text-align: center;
        }

        .today-highlight {
            background: var(--light-bg);
            border-radius: 15px;
            padding: 15px 25px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
            border-left: 5px solid var(--primary-light);
        }

        .schedule-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 15px;
            margin-bottom: 40px;
        }

        .day-column {
            background: var(--white);
            border-radius: 15px;
            box-shadow: var(--shadow);
            border: 1px solid rgba(77, 143, 204, 0.2);
            overflow: hidden;
        }

        .day-header {
            background: linear-gradient(135deg, var(--primary-light), var(--primary-medium));
            padding: 12px;
            text-align: center;
            color: white;
        }

        .day-name {
            font-weight: 800;
            font-size: 1rem;
        }

        .course-slot {
            padding: 15px;
            border-bottom: 1px solid rgba(0,81,158,0.05);
        }

        .course-time {
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--primary-medium);
            margin-bottom: 5px;
        }

        .course-title {
            font-weight: 700;
            font-size: 0.9rem;
            color: var(--primary-dark);
            margin-bottom: 3px;
        }

        .course-detail {
            font-size: 0.75rem;
            color: var(--text-light);
        }

        @media (max-width: 1200px) {
            .schedule-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .schedule-grid {
                grid-template-columns: 1fr;
            }
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
                        <h1>Class Schedule</h1>
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
                <div class="schedule-header">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
                        <div>
                            <h2 style="color: white; margin-bottom: 5px;"><i class="fas fa-calendar-alt" style="margin-right: 12px;"></i> My Term Schedule</h2>
                            <p style="color: rgba(255,255,255,0.85); font-size: 0.9rem;">Michael Johnson · STU-7823-TT · michael.j@ttschool.edu</p>
                        </div>
                        <div class="term-badge">
                            <div style="font-weight:700;">Spring 2025</div>
                            <div style="font-size:0.7rem; opacity:0.8;">Jan 13 – May 9</div>
                        </div>
                    </div>
                </div>

                <!-- Today -->
                <div class="today-highlight">
                    <div><i class="fas fa-sun"></i> <strong>Today:</strong> Monday, March 24, 2025</div>
                    <div style="font-weight:600;"><i class="fas fa-clock"></i> Next Class: Calculus II @ 11:00 AM</div>
                </div>

                <!-- Grid -->
                <div id="weeklySchedule" class="schedule-grid">
                    <!-- Days -->
                    <div class="day-column">
                        <div class="day-header"><div class="day-name">Monday</div></div>
                        <div class="course-slot">
                            <div class="course-time">09:00 – 10:30</div>
                            <div class="course-title">Data Structures</div>
                            <div class="course-detail">Prof. Lin | Room 304</div>
                        </div>
                        <div class="course-slot">
                            <div class="course-time">11:00 – 12:30</div>
                            <div class="course-title">Calculus II</div>
                            <div class="course-detail">Dr. Carter | Hall 212</div>
                        </div>
                    </div>

                    <div class="day-column">
                        <div class="day-header"><div class="day-name">Tuesday</div></div>
                        <div class="course-slot">
                            <div class="course-time">10:00 – 11:30</div>
                            <div class="course-title">Academic Writing</div>
                            <div class="course-detail">Prof. Gupta | Hum 45</div>
                        </div>
                    </div>

                    <div class="day-column">
                        <div class="day-header"><div class="day-name">Wednesday</div></div>
                        <div class="course-slot">
                            <div class="course-time">09:00 – 10:30</div>
                            <div class="course-title">Data Structures</div>
                            <div class="course-detail">Prof. Lin | Room 304</div>
                        </div>
                        <div class="course-slot">
                            <div class="course-time">11:00 – 12:30</div>
                            <div class="course-title">Calculus II</div>
                            <div class="course-detail">Dr. Carter | Hall 212</div>
                        </div>
                    </div>

                    <div class="day-column">
                        <div class="day-header"><div class="day-name">Thursday</div></div>
                        <div class="course-slot">
                            <div class="course-time">10:00 – 11:30</div>
                            <div class="course-title">Academic Writing</div>
                            <div class="course-detail">Prof. Gupta | Hum 45</div>
                        </div>
                    </div>

                    <div class="day-column">
                        <div class="day-header"><div class="day-name">Friday</div></div>
                        <div class="course-slot">
                            <div class="course-time">09:00 – 10:30</div>
                            <div class="course-title">Data Structures</div>
                            <div class="course-detail">Prof. Lin | Room 304</div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="dashboard-footer">
                    <p>&copy; 2023 T&T School Management System. All rights reserved. | Student Portal v2.3</p>
                </div>
            </div>
        </div>
    </div>

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
    </script>
</body>
</html>
