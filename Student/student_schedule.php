<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>T&T School | My Term Schedule</title>
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
            --today-border: #4D8FCC;
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

        .schedule-container {
            max-width: 1400px;
            margin: 0 auto;
            background: var(--white);
            border-radius: 42px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        /* header */
        .schedule-header {
            background: linear-gradient(115deg, var(--primary-dark) 0%, var(--primary-medium) 100%);
            padding: 32px 42px;
            position: relative;
        }

        .schedule-header::after {
            content: "📅";
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

        .term-badge {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(6px);
            border-radius: 60px;
            padding: 12px 24px;
            text-align: center;
        }

        .term-badge .term-name {
            font-size: 1rem;
            font-weight: 700;
            color: white;
        }

        .term-badge .term-dates {
            font-size: 0.7rem;
            color: rgba(255,255,240,0.8);
        }

        /* main content */
        .schedule-content {
            padding: 40px 42px;
        }

        /* today highlight */
        .today-highlight {
            background: var(--light-bg);
            border-radius: 24px;
            padding: 18px 24px;
            margin-bottom: 36px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            border-left: 6px solid var(--primary-light);
        }

        .today-text i {
            color: var(--primary-medium);
            margin-right: 12px;
        }

        .today-classes {
            font-weight: 600;
            color: var(--primary-dark);
        }

        /* schedule grid - desktop (days as columns) */
        .schedule-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            margin-bottom: 48px;
        }

        .day-column {
            background: var(--white);
            border-radius: 28px;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(77, 143, 204, 0.2);
            overflow: hidden;
            transition: all 0.2s;
        }

        .day-column:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }

        .day-header {
            background: linear-gradient(135deg, var(--primary-light), var(--primary-medium));
            padding: 16px;
            text-align: center;
            color: white;
        }

        .day-name {
            font-weight: 800;
            font-size: 1.2rem;
        }

        .day-date {
            font-size: 0.75rem;
            opacity: 0.9;
        }

        .course-slot {
            padding: 16px;
            border-bottom: 1px solid rgba(0,81,158,0.08);
        }

        .course-slot:last-child {
            border-bottom: none;
        }

        .course-time {
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--primary-medium);
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .course-title {
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 4px;
        }

        .course-detail {
            font-size: 0.7rem;
            color: var(--text-muted);
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 6px;
        }

        .empty-day {
            padding: 32px 16px;
            text-align: center;
            color: var(--text-muted);
            font-size: 0.8rem;
        }

        /* term info & upcoming */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 28px;
            margin-top: 20px;
        }

        .info-card {
            background: var(--light-bg);
            border-radius: 28px;
            padding: 24px;
            transition: 0.2s;
            border: 1px solid rgba(77, 143, 204, 0.2);
        }

        .info-card h3 {
            font-size: 1.2rem;
            color: var(--primary-dark);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-list {
            list-style: none;
        }

        .info-list li {
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.9rem;
        }

        .info-list i {
            width: 24px;
            color: var(--primary-light);
        }

        /* responsive */
        @media (max-width: 880px) {
            .schedule-content {
                padding: 28px 24px;
            }
            .schedule-grid {
                gap: 12px;
            }
        }

        @media (max-width: 768px) {
            .schedule-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            .day-column {
                margin-bottom: 0;
            }
            .today-highlight {
                flex-direction: column;
                align-items: flex-start;
            }
            .student-row {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        footer {
            background: var(--primary-dark);
            padding: 24px 42px;
            text-align: center;
            color: #bcd0e6;
            font-size: 0.8rem;
        }

        .btn-print {
            background: transparent;
            border: 1px solid rgba(255,255,255,0.3);
            color: white;
            padding: 8px 18px;
            border-radius: 40px;
            font-size: 0.8rem;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-print:hover {
            background: rgba(255,255,255,0.1);
        }
    </style>
</head>
<body>

<div class="schedule-container">
    <div class="schedule-header">
        <div class="student-row">
            <div class="student-info">
                <h1><i class="fas fa-calendar-alt" style="margin-right: 12px;"></i> My Term Schedule</h1>
                <p><i class="fas fa-user-graduate"></i> Jordan Lee · STU-7823-TT · <i class="fas fa-envelope"></i> jordan.lee@ttschool.edu</p>
            </div>
            <div class="term-badge">
                <div class="term-name">Spring Semester 2025</div>
                <div class="term-dates">Jan 13 – May 9 · Final exams: May 12-23</div>
            </div>
        </div>
    </div>

    <div class="schedule-content">
        <!-- Today's highlight (dynamic) -->
        <div class="today-highlight" id="todayHighlight">
            <div class="today-text"><i class="fas fa-sun"></i> <strong id="todayDate"></strong></div>
            <div class="today-classes" id="todayClasses">Loading today's classes...</div>
        </div>

        <!-- Weekly schedule grid -->
        <div id="weeklySchedule" class="schedule-grid">
            <!-- days injected via JS -->
        </div>

        <!-- Term details & upcoming events -->
        <div class="info-grid">
            <div class="info-card">
                <h3><i class="fas fa-info-circle"></i> Term Summary</h3>
                <ul class="info-list">
                    <li><i class="fas fa-calendar-week"></i> Weeks: 15 instructional weeks</li>
                    <li><i class="fas fa-chalkboard"></i> Total credits: 18</li>
                    <li><i class="fas fa-star"></i> Current GPA: 3.68</li>
                    <li><i class="fas fa-hourglass-half"></i> Midterm week: Mar 3-7</li>
                </ul>
            </div>
            <div class="info-card">
                <h3><i class="fas fa-bell"></i> Important Dates</h3>
                <ul class="info-list">
                    <li><i class="fas fa-file-alt"></i> Apr 18 · Project submission (CS210)</li>
                    <li><i class="fas fa-pen-fancy"></i> Apr 22 · Calculus II exam</li>
                    <li><i class="fas fa-chalkboard-user"></i> Apr 25 · Research paper due</li>
                    <li><i class="fas fa-laptop-code"></i> Apr 30 · UI/UX final prototype</li>
                </ul>
            </div>
            <div class="info-card">
                <h3><i class="fas fa-graduation-cap"></i> Academic Support</h3>
                <ul class="info-list">
                    <li><i class="fas fa-clock"></i> Tutoring: Mon–Thu 2–5 PM (Library)</li>
                    <li><i class="fas fa-comments"></i> Office hours: check each course</li>
                    <li><i class="fas fa-universal-access"></i> Accessibility services available</li>
                </ul>
            </div>
        </div>
    </div>

    <footer>
        <p><i class="fas fa-clock"></i> Schedule is subject to change. Always verify with instructors.</p>
        <p style="font-size: 0.7rem; margin-top: 8px;">T&T School · Commitment to academic excellence</p>
    </footer>
</div>

<script>
    // ---------- SCHEDULE DATA (Monday to Friday) ----------
    // Each day has an array of course slots
    const scheduleData = {
        Monday: [
            { time: "09:00 – 10:30", course: "CS 210", title: "Data Structures", instructor: "Prof. Sophia Lin", room: "Room 304" },
            { time: "11:00 – 12:30", course: "MATH 205", title: "Calculus II", instructor: "Dr. James Carter", room: "Hall 212" },
            { time: "14:00 – 15:30", course: "PHYS 101", title: "Physics: Mechanics", instructor: "Dr. Oliver Chen", room: "Sci 101" }
        ],
        Tuesday: [
            { time: "10:00 – 11:30", course: "ENG 210", title: "Academic Writing", instructor: "Prof. Maya Gupta", room: "Humanities 45" },
            { time: "13:00 – 14:30", course: "CS 210 Lab", title: "Data Structures Lab", instructor: "TA Group", room: "CS Lab 2" }
        ],
        Wednesday: [
            { time: "09:00 – 10:30", course: "CS 210", title: "Data Structures", instructor: "Prof. Sophia Lin", room: "Room 304" },
            { time: "11:00 – 12:30", course: "MATH 205", title: "Calculus II", instructor: "Dr. James Carter", room: "Hall 212" },
            { time: "15:00 – 16:30", course: "ART 250", title: "Digital Design", instructor: "Elena Vasquez", room: "Design Studio" }
        ],
        Thursday: [
            { time: "10:00 – 11:30", course: "ENG 210", title: "Academic Writing", instructor: "Prof. Maya Gupta", room: "Humanities 45" },
            { time: "13:00 – 14:30", course: "PHYS 101", title: "Physics: Mechanics", instructor: "Dr. Oliver Chen", room: "Sci 101" }
        ],
        Friday: [
            { time: "09:00 – 10:30", course: "CS 210", title: "Data Structures", instructor: "Prof. Sophia Lin", room: "Room 304" },
            { time: "11:00 – 12:30", course: "MATH 205", title: "Calculus II", instructor: "Dr. James Carter", room: "Hall 212" }
        ]
    };

    // Get current date reference (we'll simulate week of April 14-18, 2025 for realism)
    // But we want to show actual dates based on today? We'll compute week days from a fixed start (Spring 2025 week starting Apr 14)
    // For dynamic highlighting: we'll use the actual current date to detect "today" and highlight the matching weekday.
    function getCurrentWeekDates() {
        // For demo, we'll anchor to a known Monday (e.g., April 14, 2025) but we want to show dynamic dates based on current week
        // To make it realistic, we compute the dates for the current week (Monday to Friday) based on today's date.
        const today = new Date();
        const dayOfWeek = today.getDay(); // 0 = Sunday, 1 = Monday ...
        // Calculate the Monday of this week
        const diffToMonday = (dayOfWeek === 0 ? -6 : 1 - dayOfWeek);
        const mondayDate = new Date(today);
        mondayDate.setDate(today.getDate() + diffToMonday);
        
        const weekDays = [];
        for (let i = 0; i < 5; i++) {
            const d = new Date(mondayDate);
            d.setDate(mondayDate.getDate() + i);
            weekDays.push(d);
        }
        return weekDays;
    }

    function formatDate(date) {
        return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
    }

    function renderSchedule() {
        const weekDates = getCurrentWeekDates();
        const weekDays = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
        const container = document.getElementById('weeklySchedule');
        if (!container) return;

        let html = '';
        const today = new Date();
        const todayDateStr = today.toDateString();

        for (let idx = 0; idx < weekDays.length; idx++) {
            const dayName = weekDays[idx];
            const dateObj = weekDates[idx];
            const dateStr = formatDate(dateObj);
            const isToday = dateObj.toDateString() === todayDateStr;
            const courses = scheduleData[dayName] || [];

            // add a special class for today's column
            const columnClass = isToday ? 'day-column today-column' : 'day-column';
            html += `<div class="${columnClass}" style="${isToday ? 'border: 2px solid var(--primary-light); box-shadow: 0 8px 20px rgba(0,81,158,0.15);' : ''}">`;
            html += `<div class="day-header" style="${isToday ? 'background: linear-gradient(135deg, #1e88e5, #00509E);' : ''}">
                        <div class="day-name">${dayName}</div>
                        <div class="day-date">${dateStr}</div>
                     </div>`;
            if (courses.length === 0) {
                html += `<div class="empty-day"><i class="far fa-calendar-times"></i><br>No classes</div>`;
            } else {
                courses.forEach(course => {
                    html += `
                        <div class="course-slot">
                            <div class="course-time"><i class="far fa-clock"></i> ${course.time}</div>
                            <div class="course-title">${escapeHtml(course.course)}: ${escapeHtml(course.title)}</div>
                            <div class="course-detail">
                                <span><i class="fas fa-chalkboard-user"></i> ${escapeHtml(course.instructor)}</span>
                                <span><i class="fas fa-location-dot"></i> ${escapeHtml(course.room)}</span>
                            </div>
                        </div>
                    `;
                });
            }
            html += `</div>`;
        }
        container.innerHTML = html;

        // Update today's highlight
        const todayWeekday = today.toLocaleDateString('en-US', { weekday: 'long' });
        const todayCourses = scheduleData[todayWeekday] || [];
        const todayClassesHtml = todayCourses.length ? 
            todayCourses.map(c => `${c.course} (${c.time})`).join(' · ') : 
            "No classes scheduled for today. Enjoy your free time!";
        document.getElementById('todayClasses').innerHTML = `<i class="fas fa-chalkboard"></i> ${todayClassesHtml}`;
        document.getElementById('todayDate').innerHTML = `<i class="far fa-calendar-check"></i> ${today.toLocaleDateString('en-US', { weekday: 'long', month: 'long', day: 'numeric', year: 'numeric' })}`;
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

    // initial render
    renderSchedule();
</script>
</body>
</html>