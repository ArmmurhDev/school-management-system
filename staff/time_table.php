<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>T&T School | Staff Timetable</title>
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
            --light-bg: #F0F8FF;
            --white: #FFFFFF;
            --text-dark: #1A2C3E;
            --text-soft: #2c3e50;
            --text-muted: #5a6e7c;
            --shadow-sm: 0 8px 20px rgba(0, 51, 102, 0.08);
            --shadow-md: 0 12px 28px rgba(0, 51, 102, 0.12);
            --today-bg: #e3f0fa;
            --border-radius-card: 24px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(145deg, #eef5fc 0%, #e2edf7 100%);
            color: var(--text-dark);
            line-height: 1.5;
            padding: 28px 20px;
            min-height: 100vh;
        }

        .timetable-container {
            max-width: 1400px;
            margin: 0 auto;
            background: var(--white);
            border-radius: 42px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        /* header */
        .timetable-header {
            background: linear-gradient(115deg, var(--primary-dark) 0%, var(--primary-medium) 100%);
            padding: 28px 42px;
            position: relative;
        }

        .timetable-header::after {
            content: "📅";
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

        /* week navigation */
        .week-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 42px;
            background: var(--light-bg);
            border-bottom: 1px solid rgba(77, 143, 204, 0.2);
            flex-wrap: wrap;
            gap: 16px;
        }

        .week-range {
            font-weight: 700;
            color: var(--primary-dark);
            background: white;
            padding: 8px 20px;
            border-radius: 60px;
            box-shadow: var(--shadow-sm);
        }

        .nav-buttons {
            display: flex;
            gap: 12px;
        }

        .nav-btn {
            background: white;
            border: 1px solid var(--primary-light);
            padding: 8px 20px;
            border-radius: 60px;
            font-weight: 600;
            color: var(--primary-medium);
            cursor: pointer;
            transition: 0.2s;
            font-size: 0.85rem;
        }

        .nav-btn:hover {
            background: var(--primary-light);
            color: white;
        }

        /* timetable grid - desktop */
        .timetable-grid {
            display: grid;
            grid-template-columns: 100px repeat(5, 1fr);
            margin: 0 42px 42px 42px;
            overflow-x: auto;
            border-radius: 28px;
            background: var(--white);
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(77, 143, 204, 0.2);
        }

        .time-slot-header, .day-header {
            background: var(--light-bg);
            padding: 16px 12px;
            font-weight: 700;
            text-align: center;
            border-bottom: 1px solid rgba(77, 143, 204, 0.2);
            border-right: 1px solid rgba(77, 143, 204, 0.1);
        }

        .time-slot-header {
            background: var(--primary-dark);
            color: white;
            font-size: 0.8rem;
        }

        .day-header {
            background: var(--primary-light);
            color: white;
            font-size: 0.9rem;
        }

        .day-header .day-date {
            font-size: 0.7rem;
            opacity: 0.9;
        }

        .timetable-cell {
            padding: 8px;
            border-bottom: 1px solid rgba(77, 143, 204, 0.1);
            border-right: 1px solid rgba(77, 143, 204, 0.1);
            min-height: 100px;
            vertical-align: top;
            background: var(--white);
        }

        .time-row {
            display: contents;
        }

        .time-label {
            background: var(--light-bg);
            padding: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            text-align: center;
            border-bottom: 1px solid rgba(77, 143, 204, 0.1);
            border-right: 1px solid rgba(77, 143, 204, 0.1);
        }

        .class-block {
            background: linear-gradient(135deg, var(--primary-light), var(--primary-medium));
            color: white;
            border-radius: 16px;
            padding: 10px;
            margin-bottom: 8px;
            font-size: 0.75rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .class-block .course-name {
            font-weight: 700;
            margin-bottom: 4px;
        }

        .class-block .room {
            font-size: 0.7rem;
            opacity: 0.9;
        }

        /* mobile view (stacked cards) */
        .mobile-timetable {
            display: none;
            margin: 0 20px 32px 20px;
            gap: 24px;
        }

        .mobile-day-card {
            background: white;
            border-radius: 28px;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(77, 143, 204, 0.2);
            overflow: hidden;
        }

        .mobile-day-header {
            background: var(--primary-light);
            padding: 14px 20px;
            color: white;
            font-weight: 700;
        }

        .mobile-day-header .day-name {
            font-size: 1.1rem;
        }

        .mobile-day-header .day-date {
            font-size: 0.75rem;
            opacity: 0.9;
        }

        .mobile-class-list {
            padding: 16px;
        }

        .mobile-class-item {
            background: var(--light-bg);
            border-radius: 20px;
            padding: 12px;
            margin-bottom: 12px;
            border-left: 4px solid var(--primary-medium);
        }

        .mobile-class-time {
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--primary-medium);
            margin-bottom: 6px;
        }

        .mobile-class-name {
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 4px;
        }

        .mobile-class-room {
            font-size: 0.7rem;
            color: var(--text-muted);
        }

        .empty-mobile {
            color: var(--text-muted);
            text-align: center;
            padding: 20px;
            font-style: italic;
        }

        footer {
            background: var(--primary-dark);
            padding: 20px 42px;
            text-align: center;
            color: #bcd0e6;
            font-size: 0.75rem;
        }

        @media (max-width: 880px) {
            .timetable-grid {
                display: none;
            }
            .mobile-timetable {
                display: flex;
                flex-direction: column;
            }
            .week-nav {
                padding: 16px 24px;
            }
            .timetable-header {
                padding: 24px 24px;
            }
        }

        @media (max-width: 480px) {
            .staff-details h1 {
                font-size: 1.4rem;
            }
            .week-range {
                font-size: 0.8rem;
            }
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
        .toast.show {
            opacity: 1;
            bottom: 40px;
        }
    </style>
</head>
<body>
<?php include '../include/staff_sidebar.php'; ?>
<div class="timetable-container">
    <div class="timetable-header">
        <div class="staff-info">
            <div class="staff-details">
                <h1><i class="fas fa-calendar-week"></i> My Weekly Timetable</h1>
                <p><i class="fas fa-chalkboard-user"></i> <?php echo htmlspecialchars($staff_name); ?> · <?php echo htmlspecialchars($staff_subject); ?> · Staff ID: <?php echo htmlspecialchars($staff_id_display); ?></p>
            </div>
            <div class="semester-badge">
                <i class="fas fa-graduation-cap"></i> Spring 2025
            </div>
        </div>
    </div>

    <!-- Week Navigation -->
    <div class="week-nav">
        <div class="week-range" id="weekRange">Week of Apr 14 - Apr 18, 2025</div>
        <div class="nav-buttons">
            <button class="nav-btn" id="prevWeek"><i class="fas fa-chevron-left"></i> Prev</button>
            <button class="nav-btn" id="nextWeek">Next <i class="fas fa-chevron-right"></i></button>
            <button class="nav-btn" id="todayWeek">Today</button>
        </div>
    </div>

    <!-- Desktop Timetable Grid -->
    <div class="timetable-grid" id="desktopGrid">
        <!-- will be populated by JS -->
    </div>

    <!-- Mobile Timetable (stacked cards) -->
    <div class="mobile-timetable" id="mobileGrid"></div>

    <footer>
        <p><i class="fas fa-clock"></i> Timetable reflects current teaching assignments · Subject to change</p>
        <p style="font-size: 0.65rem;">T&T School · Academic Planning</p>
    </footer>
</div>

<div id="toastMsg" class="toast"></div>

<script>
    // ---------- TEACHER'S WEEKLY SCHEDULE ----------
    // Fixed weekly schedule (Monday to Friday, time slots)
    const schedule = {
        // Time slots (each with start time and duration)
        timeSlots: [
            { start: "09:00", end: "10:30", label: "09:00 – 10:30" },
            { start: "11:00", end: "12:30", label: "11:00 – 12:30" },
            { start: "13:00", end: "14:30", label: "13:00 – 14:30" },
            { start: "15:00", end: "16:30", label: "15:00 – 16:30" }
        ],
        // Classes per day (Monday=1, Tuesday=2, etc.)
        classes: [
            { day: 1, timeSlot: 0, course: "CS210 Data Structures", room: "Room 304", students: 28 },
            { day: 1, timeSlot: 1, course: "CS301 Algorithms", room: "Room 305", students: 24 },
            { day: 2, timeSlot: 2, course: "CS210L Lab", room: "CS Lab 2", students: 28, lab: true },
            { day: 3, timeSlot: 0, course: "CS210 Data Structures", room: "Room 304", students: 28 },
            { day: 3, timeSlot: 1, course: "CS301 Algorithms", room: "Room 305", students: 24 },
            { day: 4, timeSlot: 3, course: "CS401 Machine Learning", room: "Room 307", students: 22 },
            { day: 5, timeSlot: 0, course: "CS210 Data Structures (Review)", room: "Room 304", students: 28 },
            { day: 5, timeSlot: 2, course: "CS301 Problem Session", room: "Room 305", students: 24 }
        ]
    };

    // Helper: get Monday of a given week
    function getMonday(date) {
        const d = new Date(date);
        const day = d.getDay();
        const diff = (day === 0 ? -6 : 1 - day);
        d.setDate(d.getDate() + diff);
        return d;
    }

    // Current week reference (Monday)
    let currentMonday = getMonday(new Date());

    // Format date as "MMM DD"
    function formatDateShort(date) {
        return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
    }

    // Update week range display
    function updateWeekRange() {
        const monday = new Date(currentMonday);
        const friday = new Date(monday);
        friday.setDate(monday.getDate() + 4);
        const rangeStr = `Week of ${formatDateShort(monday)} – ${formatDateShort(friday)}, ${monday.getFullYear()}`;
        document.getElementById('weekRange').innerText = rangeStr;
    }

    // Get date for a given day (Monday=0, Tuesday=1, ... Friday=4)
    function getDateForDay(offset) {
        const date = new Date(currentMonday);
        date.setDate(currentMonday.getDate() + offset);
        return date;
    }

    // Check if a date is today
    function isToday(date) {
        const today = new Date();
        return date.toDateString() === today.toDateString();
    }

    // Render desktop grid
    function renderDesktop() {
        const container = document.getElementById('desktopGrid');
        if (!container) return;
        // Build headers: first empty cell, then days
        const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        let html = `
            <div class="time-slot-header">Time</div>
            ${days.map((day, idx) => {
                const date = getDateForDay(idx);
                const dateStr = formatDateShort(date);
                const todayClass = isToday(date) ? 'today-col' : '';
                return `<div class="day-header ${todayClass}">${day}<div class="day-date">${dateStr}</div></div>`;
            }).join('')}
        `;

        // For each time slot
        schedule.timeSlots.forEach((slot, slotIdx) => {
            html += `<div class="time-label">${slot.label}</div>`;
            for (let dayIdx = 0; dayIdx < 5; dayIdx++) {
                const dayNum = dayIdx + 1; // Monday=1
                const classObj = schedule.classes.find(c => c.day === dayNum && c.timeSlot === slotIdx);
                let cellContent = '';
                if (classObj) {
                    cellContent = `
                        <div class="class-block">
                            <div class="course-name">${escapeHtml(classObj.course)}</div>
                            <div class="room"><i class="fas fa-location-dot"></i> ${escapeHtml(classObj.room)}</div>
                            <div class="room"><i class="fas fa-users"></i> ${classObj.students} students</div>
                        </div>
                    `;
                }
                html += `<div class="timetable-cell">${cellContent}</div>`;
            }
        });
        container.innerHTML = html;
    }

    // Render mobile version (stacked by day)
    function renderMobile() {
        const container = document.getElementById('mobileGrid');
        if (!container) return;
        const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        let html = '';
        for (let dayIdx = 0; dayIdx < 5; dayIdx++) {
            const dayNum = dayIdx + 1;
            const date = getDateForDay(dayIdx);
            const dateStr = formatDateShort(date);
            const todayClass = isToday(date) ? 'today-card' : '';
            // Find classes for this day
            const dayClasses = schedule.classes.filter(c => c.day === dayNum);
            // Sort by time slot
            dayClasses.sort((a,b) => a.timeSlot - b.timeSlot);
            let classesHtml = '';
            if (dayClasses.length === 0) {
                classesHtml = `<div class="empty-mobile"><i class="far fa-calendar-times"></i> No classes</div>`;
            } else {
                dayClasses.forEach(cls => {
                    const slot = schedule.timeSlots[cls.timeSlot];
                    classesHtml += `
                        <div class="mobile-class-item">
                            <div class="mobile-class-time"><i class="far fa-clock"></i> ${slot.label}</div>
                            <div class="mobile-class-name">${escapeHtml(cls.course)}</div>
                            <div class="mobile-class-room"><i class="fas fa-location-dot"></i> ${escapeHtml(cls.room)} · ${cls.students} students</div>
                        </div>
                    `;
                });
            }
            html += `
                <div class="mobile-day-card ${todayClass}">
                    <div class="mobile-day-header">
                        <div class="day-name">${days[dayIdx]}</div>
                        <div class="day-date">${dateStr}</div>
                    </div>
                    <div class="mobile-class-list">
                        ${classesHtml}
                    </div>
                </div>
            `;
        }
        container.innerHTML = html;
    }

    // Show toast message
    function showToast(msg) {
        const toast = document.getElementById('toastMsg');
        toast.textContent = msg;
        toast.classList.add('show');
        setTimeout(() => {
            toast.classList.remove('show');
        }, 2000);
    }

    // Navigation
    function prevWeek() {
        currentMonday.setDate(currentMonday.getDate() - 7);
        updateWeekRange();
        renderDesktop();
        renderMobile();
        showToast("Previous week loaded");
    }

    function nextWeek() {
        currentMonday.setDate(currentMonday.getDate() + 7);
        updateWeekRange();
        renderDesktop();
        renderMobile();
        showToast("Next week loaded");
    }

    function goToToday() {
        currentMonday = getMonday(new Date());
        updateWeekRange();
        renderDesktop();
        renderMobile();
        showToast("Jumped to current week");
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

    // Add event listeners
    document.getElementById('prevWeek').addEventListener('click', prevWeek);
    document.getElementById('nextWeek').addEventListener('click', nextWeek);
    document.getElementById('todayWeek').addEventListener('click', goToToday);

    // Initial render
    updateWeekRange();
    renderDesktop();
    renderMobile();
</script>
</body>
</html>