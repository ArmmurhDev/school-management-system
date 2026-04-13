<?php
require_once '../auth/session.php';
require_once '../include/config.php';
checkAccess(['staff', 'admin']);

$user_id = $_SESSION['user_id'];
$user_role = $_SESSION['role'];

// Fetch sender details
$sender_name = "User";
$sender_image = "";

if ($user_role === 'staff') {
    $stmt = $pdo->prepare("SELECT * FROM staff WHERE staff_id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();
    $sender_name = $user['full_name'] ?? 'Staff Member';
    $sender_image = !empty($user['image']) ? "../assets/images/staff/" . $user['image'] : "../assets/images/staff/default.png";
} else {
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE admin_id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();
    $sender_name = $user['full_name'] ?? 'Administrator';
    $sender_image = "../assets/images/admin/default.png"; // Or fetch from admin table if exists
}

$msg = '';
$error = '';

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_message'])) {
    $recipient_id = !empty($_POST['student_id']) ? intval($_POST['student_id']) : null;
    $message_text = trim($_POST['message']);
    
    if (empty($message_text)) {
        $error = "Message content cannot be empty.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO messages (sender_id, sender_role, recipient_id, message_text) VALUES (?, ?, ?, ?)");
            $stmt->execute([$user_id, $user_role, $recipient_id, $message_text]);
            $msg = "Message sent successfully!";
        } catch (PDOException $e) {
            $error = "Error sending message: " . $e->getMessage();
        }
    }
}

// Fetch Students for the dropdown
if ($user_role === 'admin') {
    // Admins see all students
    $stmt = $pdo->query("SELECT student_id, full_name FROM students ORDER BY full_name ASC");
    $students_list = $stmt->fetchAll();
} else {
    // Staff see only their enrolled students
    $stmt = $pdo->prepare("
        SELECT DISTINCT s.student_id, s.full_name 
        FROM students s
        JOIN course_registrations cr ON s.student_id = cr.student_id
        JOIN courses c ON cr.course_id = c.course_id
        WHERE c.instructor_id = ?
        ORDER BY s.full_name ASC
    ");
    $stmt->execute([$user_id]);
    $students_list = $stmt->fetchAll();
}

// AJAX Support
if (isset($_GET['ajax'])) {
    ?>
    <?php if ($msg): ?>
        <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
            <i class="fas fa-check-circle"></i> <?php echo $msg; ?>
        </div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
            <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <h2><i class="fas fa-comments"></i> Message Students</h2>
        </div>
        <div class="card-body">
            <p>Communicate with specific students or broadcast to everyone.</p>
            <form method="POST" action="message.php">
                <input type="hidden" name="send_message" value="1">
                <div class="form-grid">
                    <div class="input-group">
                        <label>Select Recipient</label>
                        <select name="student_id" required>
                            <option value="">All Students</option>
                            <?php foreach ($students_list as $std): ?>
                                <option value="<?php echo $std['student_id']; ?>"><?php echo htmlspecialchars($std['full_name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-group" style="grid-column: span 2;">
                        <label>Message Content</label>
                        <textarea name="message" rows="6" style="width: 100%; padding: 15px; border-radius: 8px; border: 1px solid #ddd; font-family: inherit;" placeholder="Type your message here..." required></textarea>
                    </div>
                </div>
                <div style="display: flex; justify-content: flex-end; margin-top: 20px;">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Send Message</button>
                </div>
            </form>
        </div>
    </div>
    <?php
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Students - T&T School Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-dark: #003366;
            --primary-medium: #00509E;
            --primary-light: #4D8FCC;
            --accent-blue: #1E88E5;
            --light-bg: #F0F8FF;
            --sidebar-bg: #002147;
            --text-dark: #333333;
            --text-light: #666666;
            --white: #FFFFFF;
            --shadow: rgba(0, 51, 102, 0.1);
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
            --info: #17a2b8;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Open Sans', sans-serif; color: var(--text-dark); line-height: 1.6; background-color: #f5f7fb; overflow-x: hidden; }
        h1, h2, h3, h4, h5 { font-family: 'Poppins', sans-serif; font-weight: 600; color: var(--primary-dark); }
        .container { display: flex; min-height: 100vh; }
        
        /* Sidebar Styles */
        .sidebar { width: 250px; background-color: var(--sidebar-bg); color: var(--white); transition: all 0.3s ease; position: fixed; height: 100vh; z-index: 100; overflow-y: auto; box-shadow: 3px 0 15px rgba(0, 0, 0, 0.1); }
        .sidebar-header { padding: 25px 20px; display: flex; align-items: center; border-bottom: 1px solid rgba(255, 255, 255, 0.1); }
        .logo-icon { width: 45px; height: 45px; background: linear-gradient(135deg, var(--accent-blue), var(--primary-light)); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 15px; }
        .logo-icon i { font-size: 22px; color: var(--white); }
        .logo-text h2 { font-size: 1.5rem; color: var(--white); margin-bottom: 3px; }
        .logo-text p { font-size: 0.8rem; color: rgba(255, 255, 255, 0.7); }
        .sidebar-menu { padding: 20px 0; }
        .menu-item { padding: 15px 20px; display: flex; align-items: center; cursor: pointer; transition: all 0.3s; text-decoration: none; color: rgba(255, 255, 255, 0.8); border-left: 3px solid transparent; }
        .menu-item:hover, .menu-item.active { background-color: rgba(255, 255, 255, 0.1); color: var(--white); border-left-color: var(--accent-blue); }
        .menu-item i { width: 25px; margin-right: 15px; font-size: 1.1rem; }
        .menu-text { font-size: 0.95rem; font-weight: 500; }
        .sidebar-footer { padding: 20px; border-top: 1px solid rgba(255, 255, 255, 0.1); position: absolute; bottom: 0; width: 100%; }
        .user-info { display: flex; align-items: center; }
        .user-avatar { width: 45px; height: 45px; border-radius: 50%; overflow: hidden; margin-right: 15px; border: 2px solid var(--primary-light); }
        .user-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .user-details h4 { color: var(--white); font-size: 0.95rem; margin-bottom: 3px; }
        .user-details p { color: rgba(255, 255, 255, 0.7); font-size: 0.8rem; }
        
        .main-content { flex: 1; margin-left: 250px; transition: margin-left 0.3s ease; min-height: 100vh; }
        .top-header { background-color: var(--white); padding: 20px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px var(--shadow); position: sticky; top: 0; z-index: 99; }
        .header-left { display: flex; align-items: center; }
        .menu-toggle { background: none; border: none; font-size: 1.5rem; color: var(--primary-dark); cursor: pointer; margin-right: 20px; display: none; }
        .page-title h1 { font-size: 1.8rem; color: var(--primary-dark); }
        
        .dashboard-content { padding: 30px; }
        .card { background: var(--white); border-radius: 12px; box-shadow: 0 5px 15px var(--shadow); margin-bottom: 30px; overflow: hidden; }
        .card-header { padding: 20px 25px; background-color: #f9f9f9; border-bottom: 1px solid #eee; display: flex; align-items: center; justify-content: space-between; }
        .card-header h2 { font-family: 'Poppins', sans-serif; font-size: 1.3rem; color: var(--primary-dark); margin: 0; }
        .card-body { padding: 25px; }
        
        .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 20px; }
        .input-group { display: flex; flex-direction: column; gap: 8px; }
        .input-group label { font-weight: 600; font-size: 0.85rem; color: var(--primary-dark); }
        .input-group input, .input-group select { padding: 12px 15px; border: 1px solid #ddd; border-radius: 8px; font-family: 'Open Sans', sans-serif; font-size: 0.9rem; transition: all 0.3s; }
        
        .btn { border: none; padding: 12px 25px; border-radius: 8px; font-weight: 600; font-size: 0.9rem; cursor: pointer; transition: all 0.3s; display: inline-flex; align-items: center; gap: 10px; text-decoration: none; }
        .btn-primary { background: linear-gradient(to right, var(--primary-dark), var(--primary-medium)); color: white; box-shadow: 0 4px 10px rgba(0, 51, 102, 0.1); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 15px rgba(0, 51, 102, 0.2); }
        
        .overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 99; display: none; }
        .overlay.active { display: block; }
        .dashboard-footer { padding: 20px 30px; text-align: center; color: var(--text-light); font-size: 0.9rem; border-top: 1px solid #eee; background-color: var(--white); }

        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); width: 280px; }
            .sidebar.active { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .menu-toggle { display: block; }
        }
    </style>
</head>
<body>
    <div class="container">
        <?php 
        if ($user_role === 'staff') {
            include '../include/staff_sidebar.php'; 
        } else {
            include '../include/admin_sidebar.php';
        }
        ?>
        <div class="overlay" id="overlay"></div>
        
        <div class="main-content">
            <div class="top-header">
                <div class="header-left">
                    <button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
                    <div class="page-title">
                        <h1>Message Students</h1>
                    </div>
                </div>
                <div class="header-right">
                    <img src="<?php echo htmlspecialchars($sender_image); ?>" alt="Profile" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover;">
                </div>
            </div>
            
            <div class="dashboard-content">
                <?php if ($msg): ?>
                    <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                        <i class="fas fa-check-circle"></i> <?php echo $msg; ?>
                    </div>
                <?php endif; ?>
                <?php if ($error): ?>
                    <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                        <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-header">
                        <h2><i class="fas fa-comments"></i> New Message</h2>
                    </div>
                    <div class="card-body">
                        <p style="margin-bottom: 20px; color: var(--text-light);">Send a new message to students.</p>
                        <form method="POST">
                            <input type="hidden" name="send_message" value="1">
                            <div class="form-grid">
                                <div class="input-group">
                                    <label>Select Recipient</label>
                                    <select name="student_id" required>
                                        <option value="">All Students</option>
                                        <?php foreach ($students_list as $std): ?>
                                            <option value="<?php echo $std['student_id']; ?>"><?php echo htmlspecialchars($std['full_name']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="input-group" style="grid-column: span 2;">
                                    <label>Message Content</label>
                                    <textarea name="message" rows="6" style="width: 100%; padding: 15px; border-radius: 8px; border: 1px solid #ddd; font-family: inherit; font-size: 0.9rem;" placeholder="Type your message here..." required></textarea>
                                </div>
                            </div>
                            <div style="display: flex; justify-content: flex-end; margin-top: 20px;">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="dashboard-footer">
                <p>&copy; <?php echo date('Y'); ?> T&T School Management System. All rights reserved.</p>
            </div>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const menuToggle = document.getElementById('menuToggle');

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
