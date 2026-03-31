<?php
// Determine the current page for active state (optional but good for UX)
$current_page = basename($_SERVER['PHP_SELF']);
?>
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo-icon">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <div class="logo-text">
            <h2>T&T School</h2>
            <p>Admin Dashboard</p>
        </div>
    </div>
    
    <div class="sidebar-menu">
        <a href="dashboard.php" class="menu-item <?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>">
            <i class="fas fa-tachometer-alt"></i>
            <span class="menu-text">Dashboard</span>
        </a>
        
        <a href="manage_students.php" class="menu-item <?php echo ($current_page == 'manage_students.php') ? 'active' : ''; ?>">
            <i class="fas fa-users"></i>
            <span class="menu-text">Students</span>
        </a>
        
        <a href="manage_staff.php" class="menu-item <?php echo ($current_page == 'manage_staff.php') ? 'active' : ''; ?>">
            <i class="fas fa-chalkboard-teacher"></i>
            <span class="menu-text">Teachers / Staff</span>
        </a>
        
        <a href="manage_courses.php" class="menu-item <?php echo ($current_page == 'manage_courses.php') ? 'active' : ''; ?>">
            <i class="fas fa-book"></i>
            <span class="menu-text">Courses</span>
        </a>
        
        <a href="#" class="menu-item">
            <i class="fas fa-calendar-alt"></i>
            <span class="menu-text">Attendance</span>
        </a>
        
        <a href="#" class="menu-item">
            <i class="fas fa-file-invoice-dollar"></i>
            <span class="menu-text">Fees</span>
        </a>
        
        <a href="upload_results.php" class="menu-item <?php echo ($current_page == 'upload_results.php') ? 'active' : ''; ?>">
            <i class="fas fa-chart-bar"></i>
            <span class="menu-text">Reports / Results</span>
        </a>
        
        <a href="../auth/logout.php" class="menu-item">
            <i class="fas fa-sign-out-alt"></i>
            <span class="menu-text">Logout</span>
        </a>
    </div>
    
    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Admin">
            </div>
            <div class="user-details">
                <h4>Admin User</h4>
                <p>Academic Director</p>
            </div>
        </div>
    </div>
</div>
