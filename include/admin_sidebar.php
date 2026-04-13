<?php
// Determine the current page for active state (optional but good for UX)
$current_page = basename($_SERVER['PHP_SELF']);
require_once __DIR__ . '/config.php';

// Fetch admin details if logged in
$admin_name = $_SESSION['full_name'] ?? "Admin User";
$admin_position = "Administrator";
$admin_image_path = ""; // Initialize empty

if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin') {
    try {
        $stmt = $pdo->prepare("SELECT * FROM admin WHERE admin_id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $admin = $stmt->fetch();
        
        if ($admin) {
            $admin_name = $admin['full_name'];
            if (!empty($admin['image']) && file_exists(__DIR__ . "/../assets/images/admin/" . $admin['image'])) {
                $admin_image_path = "../assets/images/admin/" . $admin['image'];
            }
        }
    } catch (PDOException $e) {
        // Fallback to session data
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
        
        <!--a href="#" class="menu-item">
            <i class="fas fa-calendar-alt"></i>
            <span class="menu-text">Attendance</span>
        </a-->
        
        <a href="admin_fees.php" class="menu-item">
            <i class="fas fa-file-invoice-dollar"></i>
            <span class="menu-text">Fees</span>
        </a>
        
        <a href="upload_results.php" class="menu-item <?php echo ($current_page == 'upload_results.php') ? 'active' : ''; ?>">
            <i class="fas fa-chart-bar"></i>
            <span class="menu-text">Reports / Results</span>
        </a>

        <a href="promotion.php" class="menu-item <?php echo ($current_page == 'promotion.php') ? 'active' : ''; ?>">
            <i class="fas fa-chart-bar"></i>
            <span class="menu-text">Promotion</span>
        </a>

        <!---a href="../staff/message.php" class="menu-item <?php echo (strpos($_SERVER['PHP_SELF'], 'message.php') !== false) ? 'active' : ''; ?>">
            <i class="fas fa-envelope"></i>
            <span class="menu-text">Messages</span>
        </a--->
        
        <a href="../auth/logout.php" class="menu-item">
            <i class="fas fa-sign-out-alt"></i>
            <span class="menu-text">Logout</span>
        </a>
    </div>
    
    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar">
                <?php if ($admin_image_path): ?>
                    <img src="<?php echo htmlspecialchars($admin_image_path); ?>" alt="Admin Profile">
                <?php else: ?>
                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: var(--primary-light); color: white; font-size: 1.2rem;">
                        <i class="fas fa-user-shield"></i>
                    </div>
                <?php endif; ?>
            </div>
            <div class="user-details">
                <h4><?php echo htmlspecialchars($admin_name); ?></h4>
                <p><?php echo htmlspecialchars($admin_position); ?></p>
            </div>
        </div>
    </div>
</div>
