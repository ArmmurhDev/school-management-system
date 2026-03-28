<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>T&T School | My Class Schedule</title>
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
            padding: 32px 42px;
            position: relative;
        }

        .staff-header::after {
            content: "👩‍🏫";
            font-size: 130px;
            opacity: 0.08;
            position: absolute;
            bottom: -20px;
            right: 20px;
            pointer-events: none;
        }

        .staff-row {
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

        .stats-badge {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(6px);
            border-radius: 60px;
            padding: 8px 24px;
            font-weight: 500;
        }

        /* today highlight */
        .today-highlight {
            background: var(--light-bg);
            border-radius: 28px;
            padding: 20px 28px;
            margin: 32px 42px 0 42px;
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

        /* section headers */
        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 40px 42px 24px 42px;
        }

        .section-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-dark);
        }

        .section-header i {
            font-size: 1.6rem;
            color: var(--primary-light);
        }

        /* classes grid */
        .classes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 28px;
            margin: 0 42px 48px 42px;
        }

        .class-card {
            background: var(--white);
            border-radius: 28px;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(77, 143, 204, 0.2);
            overflow: hidden;
            transition: all 0.25s ease;
        }

        .class-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-light);
        }

        .card-header {
            padding: 20px 24px;
            background: var(--light-bg);
            border-bottom: 1px solid rgba(77, 143, 204, 0.2);
        }

        .course-code {
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--primary-light);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .course-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-top: 4px;
        }

        .card-body {
            padding: 20px 24px;
        }

        .class-detail {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            font-size: 0.85rem;
        }

        .class-detail i {
            width: 24px;
            color: var(--primary-light);
        }

        .students-count {
            background: var(--light-bg);
            padding: 2px 8px;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--primary-medium);
        }

        .date-badge {
            display: inline-block;
            background: var(--primary-light);
            color: white;
            padding: 2px 10px;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px;
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
            .staff-header { padding: 24px 24px; }
            .today-highlight { margin: 24px 24px 0 24px; padding: 16px 20px; }
            .section-header { margin: 32px 24px 20px 24px; }
            .classes-grid { margin: 0 24px 40px 24px; gap: 20px; }
        }

        @media (max-width: 480px) {
            .class-card .card-header, .class-card .card-body { padding: 16px; }
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

<div class="staff-container">
    <div class="staff-header">
        <div class="staff-row">
            <div class="title-section">
                <h1><i class="fas fa-chalkboard-user"></i> My Class Schedule</h1>
                <p><i class="fas fa-user-graduate"></i> Prof. Sophia Lin · Computer Science Department · Staff ID: TCH-0042</p>
            </div>
            <div class="stats-badge">
                <i class="fas fa-calendar-alt"></i> Spring 2025 Semester
            </div>
        </div>
    </div>

    <!-- Today's classes highlight -->
    <div class="today-highlight" id="todayHighlight">
        <div class="today-text"><i class="fas fa-sun"></i> <strong id="todayDate"></strong></div>
        <div class="today-classes" id="todayClasses">Loading today's classes...</div>
    </div>

    <!-- Upcoming Classes Section -->
    <div class="section-header">
        <i class="fas fa-calendar-week"></i>
        <h2>Upcoming Classes</h2>
    </div>
    <div id="upcomingContainer" class="classes-grid">
        <!-- dynamic cards -->
    </div>

    <!-- Past Classes Section -->
    <div class="section-header">
        <i class="fas fa-history"></i>
        <h2>Past Classes</h2>
    </div>
    <div id="pastContainer" class="classes-grid">
        <!-- dynamic cards -->
    </div>

    <footer>
        <p><i class="fas fa-clock"></i> Schedule reflects current semester · Contact admin for any changes</p>
        <p style="font-size: 0.7rem;">T&T School · Empowering Educators</p>
    </footer>
</div>

<div id="toastMsg" class="toast"></div>

<script>
    // ---------- MOCK DATA: TEACHER'S CLASS SCHEDULE (recurring and one-off) ----------
    // For simplicity, we'll generate classes for the next 14 days and past 7 days
    // based on a fixed weekly schedule for the teacher.
    
    const teacherSchedule = [
        { courseId: "CS210", courseName: "Data Structures", credits: 4, room: "Room 304", students: 28, days: [1, 3], time: "09:00 – 10:30", duration: "1h 30m" },
        { courseId: "CS210L", courseName: "Data Structures Lab", credits: 0, room: "CS Lab 2", students: 28, days: [2], time: "13:00 – 14:30", duration: "1h 30m" },
        { courseId: "CS301", courseName: "Algorithms", credits: 3, room: "Room 305", students: 24, days: [1, 3], time: "11:00 – 12:30", duration: "1h 30m" },
        { courseId: "CS401", courseName: "Machine Learning", credits: 3, room: "Room 307", students: 22, days: [4], time: "15:00 – 17:00", duration: "2h" }
    ];
    
    // Helper: get today's date (local date)
    function getTodayDate() {
        const today = new Date();
        return today.toISOString().slice(0,10);
    }
    
    // Generate class instances for a given date range
    function generateClasses(startDate, endDate) {
        const classes = [];
        let current = new Date(startDate);
        while (current <= endDate) {
            const dayOfWeek = current.getDay(); // 0=Sun, 1=Mon, ..., 6=Sat
            // Only include weekdays 1-5 (Mon-Fri)
            if (dayOfWeek >= 1 && dayOfWeek <= 5) {
                teacherSchedule.forEach(course => {
                    if (course.days.includes(dayOfWeek)) {
                        const classDate = new Date(current);
                        const dateStr = classDate.toISOString().slice(0,10);
                        classes.push({
                            id: `${course.courseId}_${dateStr}`,
                            courseId: course.courseId,
                            courseName: course.courseName,
                            date: dateStr,
                            dayName: classDate.toLocaleDateString('en-US', { weekday: 'long' }),
                            time: course.time,
                            room: course.room,
                            students: course.students,
                            duration: course.duration,
                            isLab: course.courseId.includes('L')
                        });
                    }
                });
            }
            current.setDate(current.getDate() + 1);
        }
        return classes;
    }
    
    // Generate all classes for the semester (for demo, we'll generate from March 1, 2025 to April 15, 2025)
    const semesterStart = new Date(2025, 2, 1); // March 1, 2025
    const semesterEnd = new Date(2025, 3, 15);  // April 15, 2025
    let allClasses = generateClasses(semesterStart, semesterEnd);
    
    // For variety, also add some special events (e.g., midterm exam)
    allClasses.push({
        id: "midterm_cs210",
        courseId: "CS210",
        courseName: "Data Structures - Midterm Exam",
        date: "2025-03-25",
        dayName: "Tuesday",
        time: "10:00 – 12:00",
        room: "Auditorium A",
        students: 28,
        duration: "2h",
        isExam: true
    });
    allClasses.push({
        id: "project_cs401",
        courseId: "CS401",
        courseName: "ML Project Presentation",
        date: "2025-04-10",
        dayName: "Thursday",
        time: "14:00 – 16:00",
        room: "Room 307",
        students: 22,
        duration: "2h",
        isProject: true
    });
    
    // Sort by date
    allClasses.sort((a,b) => new Date(a.date) - new Date(b.date));
    
    // Get today's date
    const todayStr = getTodayDate();
    const today = new Date(todayStr);
    
    // Split classes into upcoming (today and future) and past (strictly before today)
    const upcomingClasses = allClasses.filter(cls => new Date(cls.date) >= today);
    const pastClasses = allClasses.filter(cls => new Date(cls.date) < today);
    
    // Helper: format date nicely
    function formatDate(dateStr) {
        const date = new Date(dateStr);
        return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
    }
    
    // Helper: get relative day label
    function getRelativeLabel(dateStr) {
        const clsDate = new Date(dateStr);
        const todayDate = new Date(todayStr);
        const diffTime = clsDate - todayDate;
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        if (diffDays === 0) return "Today";
        if (diffDays === 1) return "Tomorrow";
        if (diffDays === -1) return "Yesterday";
        if (diffDays > 0 && diffDays <= 7) return `In ${diffDays} days`;
        if (diffDays < 0 && diffDays >= -7) return `${Math.abs(diffDays)} days ago`;
        return "";
    }
    
    // Show toast (optional)
    function showToast(message) {
        const toast = document.getElementById('toastMsg');
        toast.textContent = message;
        toast.classList.add('show');
        setTimeout(() => {
            toast.classList.remove('show');
        }, 2500);
    }
    
    // Render today's highlight
    function renderTodayHighlight() {
        const todayClasses = upcomingClasses.filter(cls => cls.date === todayStr);
        const todayDateElem = document.getElementById('todayDate');
        const todayClassesElem = document.getElementById('todayClasses');
        
        todayDateElem.innerHTML = `<i class="far fa-calendar-check"></i> ${today.toLocaleDateString('en-US', { weekday: 'long', month: 'long', day: 'numeric', year: 'numeric' })}`;
        
        if (todayClasses.length === 0) {
            todayClassesElem.innerHTML = '<i class="fas fa-coffee"></i> No classes scheduled for today. Enjoy your free time!';
        } else {
            let text = '';
            todayClasses.forEach(cls => {
                text += `${cls.courseName} (${cls.time}) · `;
            });
            todayClassesElem.innerHTML = `<i class="fas fa-chalkboard"></i> ${text.slice(0, -3)}`;
        }
    }
    
    // Render a list of classes into a container
    function renderClassList(classes, containerId, emptyMessage) {
        const container = document.getElementById(containerId);
        if (!container) return;
        
        if (classes.length === 0) {
            container.innerHTML = `<div class="empty-state"><i class="fas fa-calendar-alt"></i><p style="margin-top: 12px;">${emptyMessage}</p></div>`;
            return;
        }
        
        let cardsHtml = '';
        classes.forEach(cls => {
            const relativeLabel = getRelativeLabel(cls.date);
            const isToday = cls.date === todayStr;
            const cardClass = isToday ? 'class-card' : 'class-card';
            
            cardsHtml += `
                <div class="${cardClass}">
                    <div class="card-header">
                        <div class="course-code">${cls.courseId} ${cls.isExam ? '· Exam' : (cls.isProject ? '· Project' : (cls.isLab ? '· Lab' : ''))}</div>
                        <div class="course-title">${escapeHtml(cls.courseName)}</div>
                    </div>
                    <div class="card-body">
                        <div class="class-detail">
                            <i class="far fa-calendar-alt"></i>
                            <span>${formatDate(cls.date)} <span style="font-weight: 600; color: var(--primary-medium);">${relativeLabel ? '(' + relativeLabel + ')' : ''}</span></span>
                        </div>
                        <div class="class-detail">
                            <i class="far fa-clock"></i>
                            <span>${cls.time} (${cls.duration})</span>
                        </div>
                        <div class="class-detail">
                            <i class="fas fa-location-dot"></i>
                            <span>${escapeHtml(cls.room)}</span>
                        </div>
                        <div class="class-detail">
                            <i class="fas fa-users"></i>
                            <span>${cls.students} students <span class="students-count"><i class="fas fa-user-graduate"></i> Enrolled</span></span>
                        </div>
                    </div>
                </div>
            `;
        });
        container.innerHTML = cardsHtml;
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
    
    // Show a small message for empty sections (already handled)
    // Initial render
    function init() {
        renderTodayHighlight();
        renderClassList(upcomingClasses, 'upcomingContainer', 'No upcoming classes scheduled.');
        renderClassList(pastClasses, 'pastContainer', 'No past classes available.');
    }
    
    init();
</script>
</body>
</html>