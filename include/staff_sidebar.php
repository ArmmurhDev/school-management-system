<?php
$currentPage = basename($_SERVER['PHP_SELF']);
require_once __DIR__ . '/config.php';

// Fetch staff details if logged in
$staff_name = "Staff Member";
$staff_position = "Teacher";
$staff_image = "../assets/images/staff/default.png"; // Default image

if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'staff') {
    $stmt = $pdo->prepare("SELECT * FROM staff WHERE staff_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $staff = $stmt->fetch();
    
    if ($staff) {
        $staff_name = $staff['full_name'];
        $staff_position = $staff['position'];
        $staff_subject = $staff['subject'];
        $staff_id_display = "STF-" . str_pad($staff['staff_id'], 4, "0", STR_PAD_LEFT);
        if (!empty($staff['image'])) {
            $staff_image = "../assets/images/staff/" . $staff['image'];
        }
    }
}
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
        
        <!---a href="my_classes.php" class="menu-item <?php echo ($currentPage == 'my_classes.php') ? 'active' : ''; ?>">
            <i class="fas fa-chalkboard-teacher"></i>
            <span class="menu-text">My Classes</span>
        </a--->
        
        <a href="enroll_student.php" class="menu-item <?php echo ($currentPage == 'view_students.php') ? 'active' : ''; ?>">
            <i class="fas fa-users"></i>
            <span class="menu-text">My Students</span>
        </a>
        
        <a href="enter_results.php" class="menu-item <?php echo ($currentPage == 'enter_results.php') ? 'active' : ''; ?>">
            <i class="fas fa-edit"></i>
            <span class="menu-text">Enter Results</span>
        </a>
        
        <a href="#" class="menu-item">
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
                <img src="<?php echo htmlspecialchars($staff_image); ?>" alt="Staff Image">
            </div>
            <div class="user-details">
                <h4><?php echo htmlspecialchars($staff_name); ?></h4>
                <p><?php echo htmlspecialchars($staff_position); ?></p>
            </div>
        </div>
    </div>
</div>
