<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo-icon">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <div class="logo-text">
            <h2>T&T School</h2>
            <p>Staff Portal</p>
        </div>
    </div>
    
    <div class="sidebar-menu">
        <a href="dashboard.php" class="menu-item <?php echo ($currentPage == 'dashboard.php') ? 'active' : ''; ?>">
            <i class="fas fa-tachometer-alt"></i>
            <span class="menu-text">Dashboard</span>
        </a>
        
        <a href="#" class="menu-item">
            <i class="fas fa-chalkboard-teacher"></i>
            <span class="menu-text">My Classes</span>
        </a>
        
        <a href="view_students.php" class="menu-item <?php echo ($currentPage == 'view_students.php') ? 'active' : ''; ?>">
            <i class="fas fa-users"></i>
            <span class="menu-text">My Students</span>
        </a>
        
        <a href="#" class="menu-item">
            <i class="fas fa-calendar-check"></i>
            <span class="menu-text">Attendance</span>
        </a>
        
        <a href="enter_results.php" class="menu-item <?php echo ($currentPage == 'enter_results.php') ? 'active' : ''; ?>">
            <i class="fas fa-edit"></i>
            <span class="menu-text">Enter Results</span>
        </a>
        
        <a href="view_result.php" class="menu-item <?php echo ($currentPage == 'view_result.php') ? 'active' : ''; ?>">
            <i class="fas fa-chart-line"></i>
            <span class="menu-text">View Results</span>
        </a>
        
        <a href="#" class="menu-item">
            <i class="fas fa-calendar-alt"></i>
            <span class="menu-text">Timetable</span>
        </a>
        
        <a href="#" class="menu-item">
            <i class="fas fa-envelope"></i>
            <span class="menu-text">Messages</span>
        </a>
        
        <a href="logout.php" class="menu-item">
            <i class="fas fa-sign-out-alt"></i>
            <span class="menu-text">Logout</span>
        </a>
    </div>
    
    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar">
                <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Teacher">
            </div>
            <div class="user-details">
                <h4>Mr. David Chen</h4>
                <p>Mathematics Teacher</p>
            </div>
        </div>
    </div>
</div>
