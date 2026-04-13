<?php
require_once '../auth/session.php';
require_once '../include/config.php';
checkAccess('student');

$student_id = $_SESSION['user_id'];

// Fetch messages: Personal (specific to student) or Broadcast (NULL recipient) - Only from last 3 days
$query = "
    (SELECT m.*, a.full_name as sender_name, 'Admin' as role_display 
     FROM messages m 
     JOIN admin a ON m.sender_id = a.admin_id 
     WHERE m.sender_role = 'admin' AND (m.recipient_id = ? OR m.recipient_id IS NULL)
     AND m.created_at >= NOW() - INTERVAL 3 DAY)
    UNION
    (SELECT m.*, s.full_name as sender_name, 'Staff' as role_display 
     FROM messages m 
     JOIN staff s ON m.sender_id = s.staff_id 
     WHERE m.sender_role = 'staff' AND (m.recipient_id = ? OR m.recipient_id IS NULL)
     AND m.created_at >= NOW() - INTERVAL 3 DAY)
    ORDER BY created_at DESC
";

$stmt = $pdo->prepare($query);
$stmt->execute([$student_id, $student_id]);
$messages = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages - T&T School Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/student-dashboard.css">
    <style>
        .message-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            padding: 25px;
            margin-bottom: 20px;
            border-left: 5px solid var(--primary-medium);
            transition: transform 0.3s ease;
        }
        .message-card:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,0.1); }
        .message-card.broadcast { border-left-color: var(--warning); }
        
        .message-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px; }
        .sender-info { display: flex; align-items: center; gap: 12px; }
        .sender-avatar { width: 45px; height: 45px; background: var(--light-bg); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--primary-medium); font-size: 1.2rem; }
        .sender-name { font-weight: 600; color: var(--primary-dark); font-size: 1.05rem; }
        .sender-role { font-size: 0.8rem; background: var(--light-bg); padding: 2px 10px; border-radius: 20px; color: var(--text-light); margin-left: 10px; }
        
        .message-time { font-size: 0.85rem; color: var(--text-light); }
        .message-body { color: var(--text-dark); line-height: 1.7; white-space: pre-wrap; }
        
        .broadcast-badge { font-size: 0.75rem; background: #fff3cd; color: #856404; padding: 2px 12px; border-radius: 20px; font-weight: 600; }
        
        .empty-state { text-align: center; padding: 60px 20px; background: white; border-radius: 15px; }
        .empty-state i { font-size: 4rem; color: #eee; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <?php include '../include/student-sidebar.php'; ?>
        <div class="overlay" id="overlay"></div>
        <div class="main-content" id="mainContent">
            <div class="top-header">
                <div class="header-left">
                    <button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
                    <div class="page-title"><h1>Communications</h1></div>
                </div>
            </div>
            <div class="dashboard-content">
                <?php if (empty($messages)): ?>
                    <div class="empty-state">
                        <i class="fas fa-envelope-open"></i>
                        <h3>No messages yet</h3>
                        <p>You haven't received any personal or school-wide messages.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($messages as $m): ?>
                        <div class="message-card <?php echo is_null($m['recipient_id']) ? 'broadcast' : ''; ?>">
                            <div class="message-header">
                                <div class="sender-info">
                                    <div class="sender-avatar">
                                        <i class="fas <?php echo $m['sender_role'] == 'admin' ? 'fa-user-shield' : 'fa-chalkboard-teacher'; ?>"></i>
                                    </div>
                                    <div>
                                        <span class="sender-name"><?php echo htmlspecialchars($m['sender_name']); ?></span>
                                        <span class="sender-role"><?php echo $m['role_display']; ?></span>
                                        <?php if (is_null($m['recipient_id'])): ?>
                                            <span class="broadcast-badge"><i class="fas fa-bullhorn"></i> Announcement</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="message-time">
                                    <?php echo date('M d, Y · h:i A', strtotime($m['created_at'])); ?>
                                </div>
                            </div>
                            <div class="message-body"><?php echo htmlspecialchars($m['message_text']); ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                
                <div class="dashboard-footer">
                    <p>&copy; <?php echo date('Y'); ?> T&T School Management System. All rights reserved.</p>
                </div>
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
    </script>
</body>
</html>
