<?php
// Determine the current page for active state
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo-icon">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <div class="logo-text">
            <h2>T&T School</h2>
            <p>Student Portal</p>
        </div>
    </div>
    
    <div class="sidebar-menu">
        <a href="dashboard.php" class="menu-item <?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>">
            <i class="fas fa-tachometer-alt"></i>
            <span class="menu-text">Dashboard</span>
        </a>
        
        <a href="my-courses.php" class="menu-item <?php echo ($current_page == 'my-courses.php') ? 'active' : ''; ?>">
            <i class="fas fa-book"></i>
            <span class="menu-text">My Courses</span>
        </a>

        <a href="course_registration.php" class="menu-item <?php echo ($current_page == 'course_registration.php') ? 'active' : ''; ?>">
            <i class="fas fa-file-signature"></i>
            <span class="menu-text">Course Registration</span>
        </a>
        
        <a href="view_results.php" class="menu-item <?php echo ($current_page == 'view_results.php') ? 'active' : ''; ?>">
            <i class="fas fa-chart-line"></i>
            <span class="menu-text">Grades</span>
        </a>
        
        <a href="student-assignments.php" class="menu-item <?php echo ($current_page == 'student-assignments.php') ? 'active' : ''; ?>">
            <i class="fas fa-tasks"></i>
            <span class="menu-text">Assignments</span>
        </a>
        
        <a href="student-schedule.php" class="menu-item <?php echo ($current_page == 'student-schedule.php') ? 'active' : ''; ?>">
            <i class="fas fa-calendar-alt"></i>
            <span class="menu-text">Schedule</span>
        </a>
        
        <a href="student-attendance.php" class="menu-item <?php echo ($current_page == 'student-attendance.php') ? 'active' : ''; ?>">
            <i class="fas fa-calendar-check"></i>
            <span class="menu-text">Attendance</span>
        </a>
        
        <a href="student-messages.php" class="menu-item <?php echo ($current_page == 'student-messages.php') ? 'active' : ''; ?>">
            <i class="fas fa-envelope"></i>
            <span class="menu-text">Messages</span>
        </a>
        
        <a href="../auth/logout.php" class="menu-item">
            <i class="fas fa-sign-out-alt"></i>
            <span class="menu-text">Logout</span>
        </a>
    </div>
    
    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar">
                <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Student">
            </div>
            <div class="user-details">
                <h4>Michael Johnson</h4>
                <p>Grade 10 | Section A</p>
            </div>
        </div>
    </div>
</div>