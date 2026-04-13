<?php
require_once '../auth/session.php';
require_once '../include/config.php';
checkAccess('admin');

$msg = '';
$error = '';

// Handle Promotion Logic
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['promote_students'])) {
    $raw_ids = isset($_POST['selected_students']) ? $_POST['selected_students'] : '';
    $student_ids = !empty($raw_ids) ? explode(',', $raw_ids) : [];
    $promote_to = isset($_POST['promote_to']) ? trim($_POST['promote_to']) : '';
    $new_session = isset($_POST['new_session']) ? trim($_POST['new_session']) : '';
    
    if (empty($student_ids)) {
        $error = "No students selected for promotion.";
    } elseif (empty($promote_to)) {
        $error = "Please select a class to promote students to.";
    } else {
        try {
            $pdo->beginTransaction();
            
            foreach ($student_ids as $id) {
                // Get current class info for history
                $stmt = $pdo->prepare("SELECT class_name, session_of_year FROM students WHERE student_id = ?");
                $stmt->execute([$id]);
                $current = $stmt->fetch();
                
                if ($current) {
                    // Update student
                    $update_sql = "UPDATE students SET class_name = ?";
                    $params = [$promote_to];
                    
                    if (!empty($new_session)) {
                        $update_sql .= ", session_of_year = ?";
                        $params[] = $new_session;
                    }
                    
                    $update_sql .= " WHERE student_id = ?";
                    $params[] = $id;
                    
                    $stmt = $pdo->prepare($update_sql);
                    $stmt->execute($params);
                    
                    // Record history
                    $stmt = $pdo->prepare("INSERT INTO promotions (student_id, from_class, to_class, session) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$id, $current['class_name'] ?: 'N/A', $promote_to, $new_session ?: $current['session_of_year']]);
                }
            }
            
            $pdo->commit();
            $msg = "Successfully promoted " . count($student_ids) . " student(s) to $promote_to.";
        } catch (PDOException $e) {
            $pdo->rollBack();
            $error = "Error promoting students: " . $e->getMessage();
        }
    }
}

// Fetch Classes for dropdowns
$classes = getClasses($pdo);
$academic_sessions = getAcademicSessions($pdo);

// Fetch Students based on filter
$filter_level = isset($_GET['level']) ? $_GET['level'] : 'all';
try {
    if ($filter_level == 'all') {
        $stmt = $pdo->query("SELECT * FROM students ORDER BY class_name ASC, full_name ASC");
    } else {
        $stmt = $pdo->prepare("SELECT * FROM students WHERE class_name = ? ORDER BY full_name ASC");
        $stmt->execute([$filter_level]);
    }
    $students = $stmt->fetchAll();
} catch (PDOException $e) {
    $error = "Error fetching students: " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <title>Promote Students · T&T School Admin</title>
    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* ----- T&T COLOR SCHEME (exact) ----- */
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            color: var(--text-dark);
            line-height: 1.6;
            background-color: #f5f7fb;
            overflow-x: hidden;
        }

        h1, h2, h3, h4 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: var(--primary-dark);
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* ----- SIDEBAR STYLES (from dashboard) ----- */
        .sidebar {
            width: 250px;
            background-color: var(--sidebar-bg);
            color: var(--white);
            transition: all 0.3s ease;
            position: fixed;
            height: 100vh;
            z-index: 100;
            overflow-y: auto;
            box-shadow: 3px 0 15px rgba(0, 0, 0, 0.1);
        }
        
        .sidebar-header {
            padding: 25px 20px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .logo-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--accent-blue), var(--primary-light));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }
        
        .logo-icon i {
            font-size: 22px;
            color: var(--white);
        }
        
        .logo-text h2 {
            font-size: 1.5rem;
            color: var(--white);
            margin-bottom: 3px;
        }
        
        .logo-text p {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.7);
        }
        
        .sidebar-menu {
            padding: 20px 0;
        }
        
        .menu-item {
            padding: 15px 20px;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.8);
            border-left: 3px solid transparent;
        }
        
        .menu-item:hover, .menu-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--white);
            border-left-color: var(--accent-blue);
        }
        
        .menu-item i {
            width: 25px;
            margin-right: 15px;
            font-size: 1.1rem;
        }
        
        .menu-text {
            font-size: 0.95rem;
            font-weight: 500;
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            position: absolute;
            bottom: 0;
            width: 100%;
        }
        
        .user-info {
            display: flex;
            align-items: center;
        }
        
        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 15px;
            border: 2px solid var(--primary-light);
        }
        
        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .user-details h4 {
            color: var(--white);
            font-size: 0.95rem;
            margin-bottom: 3px;
        }
        
        .user-details p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.8rem;
        }

        /* ----- MAIN CONTENT ----- */
        .main-content {
            flex: 1;
            margin-left: 250px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s ease;
        }

        .top-header {
            background-color: var(--white);
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px var(--shadow);
            position: sticky;
            top: 0;
            z-index: 99;
        }

        .header-left {
            display: flex;
            align-items: center;
        }

        .menu-toggle {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--primary-dark);
            cursor: pointer;
            margin-right: 20px;
            display: none;
        }

        .page-title h1 {
            font-size: 1.8rem;
            color: var(--primary-dark);
        }

        .header-right {
            display: flex;
            align-items: center;
        }

        .header-action {
            margin-left: 25px;
            cursor: pointer;
        }

        .header-action i {
            font-size: 1.3rem;
            color: var(--primary-medium);
            transition: color 0.3s;
        }

        .header-action:hover i {
            color: var(--accent-blue);
        }

        .dashboard-content {
            padding: 30px;
            flex: 1;
        }

        /* ----- PROMOTION CONTROLS CARD ----- */
        .promo-card {
            background: var(--white);
            border-radius: 24px;
            padding: 24px 28px;
            box-shadow: 0 12px 24px var(--shadow);
            margin-bottom: 30px;
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            gap: 20px;
        }

        .promo-group {
            flex: 1 1 180px;
        }

        .promo-group label {
            display: block;
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .promo-group select {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e0e7ef;
            border-radius: 14px;
            font-family: 'Open Sans', sans-serif;
            background: #fbfdff;
            font-size: 1rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 24px;
            border-radius: 14px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 6px 14px var(--shadow);
            background: var(--white);
            color: var(--primary-medium);
            border: 1px solid var(--primary-light);
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(to right, var(--primary-dark), var(--primary-medium));
            color: var(--white);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(to right, var(--primary-medium), var(--accent-blue));
            transform: translateY(-2px);
        }

        .btn-success {
            background: var(--success);
            color: white;
            border: none;
        }

        .btn-success:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        /* Filter bar */
        .filter-bar {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .filter-group {
            min-width: 200px;
        }

        .filter-group select {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e0e7ef;
            border-radius: 14px;
            background: #fbfdff;
        }

        /* Table */
        .table-container {
            background: var(--white);
            border-radius: 24px;
            box-shadow: 0 15px 30px var(--shadow);
            overflow: hidden;
        }

        .table-header {
            padding: 20px 25px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .table-header h3 {
            font-size: 1.3rem;
        }

        .student-count {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .student-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        .student-table thead {
            background: var(--light-bg);
        }

        .student-table th {
            padding: 18px 16px;
            text-align: left;
            font-weight: 600;
            color: var(--primary-dark);
            border-bottom: 2px solid #e0e7ef;
            white-space: nowrap;
            font-size: 0.95rem;
        }

        .student-table td {
            padding: 16px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        .student-table tbody tr:hover {
            background-color: #fafcff;
        }

        .student-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .student-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--light-bg);
        }

        .checkbox-cell {
            width: 40px;
            text-align: center;
        }

        .checkbox-cell input {
            width: 18px;
            height: 18px;
            accent-color: var(--primary-medium);
        }

        .academic-badge {
            display: inline-block;
            padding: 5px 14px;
            border-radius: 30px;
            font-weight: 500;
            font-size: 0.85rem;
            background: var(--light-bg);
            color: var(--primary-medium);
        }

        .alert {
            padding: 15px 25px;
            border-radius: 14px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

        .overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 99;
            display: none;
        }

        .overlay.active { display: block; }

        .dashboard-footer {
            margin-top: 40px;
            padding: 20px 30px;
            text-align: center;
            color: var(--text-light);
            font-size: 0.9rem;
            border-top: 1px solid #eee;
            background: var(--white);
        }

        /* mobile */
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); width: 280px; }
            .sidebar.active { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .menu-toggle { display: block; }
        }

        @media (max-width: 700px) {
            .top-header { padding: 16px 20px; }
            .dashboard-content { padding: 20px 16px; }
            .promo-card { flex-direction: column; align-items: stretch; }
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Sidebar -->
    <?php include '../include/admin_sidebar.php'; ?>
    
    <!-- Overlay for mobile -->
    <div class="overlay" id="overlay"></div>

    <div class="main-content" id="mainContent">
        <!-- Header -->
        <div class="top-header">
            <div class="header-left">
                <button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
                <div class="page-title">
                    <h1>Student Promotion</h1>
                </div>
            </div>
            <div class="header-right">
                <div class="header-action"><i class="fas fa-bell"></i></div>
                <div class="header-action"><i class="fas fa-user-cog"></i></div>
            </div>
        </div>

        <div class="dashboard-content">
            <?php if ($msg): ?>
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?php echo $msg; ?></div>
            <?php endif; ?>
            <?php if ($error): ?>
                <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?php echo $error; ?></div>
            <?php endif; ?>

            <!-- Promotion Controls -->
            <form id="promotionForm" method="POST" action="promotion.php">
                <input type="hidden" name="selected_students" id="selectedStudentsInput">
                <input type="hidden" name="promote_students" value="1">
                <div class="promo-card">
                    <div class="promo-group">
                        <label><i class="fas fa-arrow-right-from-bracket"></i> Filter Current Class</label>
                        <select id="currentClassSelect">
                            <option value="all">All Classes</option>
                            <?php foreach ($classes as $class): ?>
                                <option value="<?php echo htmlspecialchars($class); ?>" <?php echo $filter_level == $class ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($class); ?>
                                </option>
                            <?php endforeach; ?>
                            <option value="Graduate" <?php echo $filter_level == 'Graduate' ? 'selected' : ''; ?>>Graduate</option>
                        </select>
                    </div>
                    <div class="promo-group">
                        <label><i class="fas fa-arrow-right-to-bracket"></i> Promote To</label>
                        <select name="promote_to" id="promoteToSelect">
                            <option value="">Select Target Class</option>
                            <?php foreach ($classes as $class): ?>
                                <option value="<?php echo htmlspecialchars($class); ?>">
                                    <?php echo htmlspecialchars($class); ?>
                                </option>
                            <?php endforeach; ?>
                            <option value="Graduate">Graduate</option>
                        </select>
                    </div>
                    <div class="promo-group">
                        <label><i class="fas fa-calendar-alt"></i> New Session (Optional)</label>
                        <select name="new_session" id="newSessionSelect">
                            <option value="">Keep Current Session</option>
                            <?php foreach ($academic_sessions as $session): ?>
                                <option value="<?php echo htmlspecialchars($session); ?>">
                                    <?php echo htmlspecialchars($session); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="promo-group" style="flex: 0 0 auto;">
                        <button type="button" class="btn btn-success" id="promoteBtn">
                            <i class="fas fa-arrow-up"></i> Promote Selected
                        </button>
                    </div>
                    <div class="promo-group" style="flex: 0 0 auto;">
                        <button type="button" class="btn" id="selectAllBtn">
                            <i class="far fa-check-square"></i> Select All
                        </button>
                    </div>
                </div>
            </form>

            <!-- Students Table -->
            <div class="table-container">
                <div class="table-header">
                    <h3><i class="fas fa-users"></i> Student List</h3>
                    <span class="student-count" id="recordCount"><?php echo count($students); ?> students</span>
                </div>
                <div class="table-responsive">
                    <table class="student-table" id="studentTable">
                        <thead>
                            <tr>
                                <th style="width: 40px;"><input type="checkbox" id="masterCheckbox"></th>
                                <th>Name</th>
                                <th>Current Class</th>
                                <th>Session</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php foreach ($students as $s): ?>
                                <tr>
                                    <td class="checkbox-cell">
                                        <input type="checkbox" class="student-checkbox" data-id="<?php echo $s['student_id']; ?>">
                                    </td>
                                    <td>
                                        <div class="student-info">
                                            <img class="student-avatar" src="../assets/images/student/<?php echo $s['image'] ? $s['image'] : 'default.png'; ?>" alt="">
                                            <div>
                                                <strong><?php echo htmlspecialchars($s['full_name']); ?></strong><br>
                                                <small style="color:var(--text-light);"><?php echo htmlspecialchars($s['admission_no']); ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo htmlspecialchars($s['class_name']); ?></td>
                                    <td><?php echo htmlspecialchars($s['session_of_year']); ?></td>
                                    <td><span class="academic-badge"><?php echo htmlspecialchars($s['class_name']); ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($students)): ?>
                                <tr>
                                    <td colspan="5" style="text-align:center; padding:40px; color: var(--text-light);">
                                        <i class="fas fa-user-graduate" style="font-size:2rem; margin-bottom:10px; display:block;"></i>
                                        <h4>No students found in this class</h4>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="dashboard-footer">
                <p>© 2025 T&T School Management System · Admin Promotion Module</p>
            </div>
        </div>
    </div>
</div>

<script>
    (function(){
        "use strict";

        // DOM elements
        const masterCheckbox = document.getElementById('masterCheckbox');
        const levelFilterSelect = document.getElementById('levelFilterSelect');
        const applyFilterBtn = document.getElementById('applyFilterBtn');
        const clearFilterBtn = document.getElementById('clearFilterBtn');
        const promoteBtn = document.getElementById('promoteBtn');
        const selectAllBtn = document.getElementById('selectAllBtn');
        const promoteToSelect = document.getElementById('promoteToSelect');
        const currentClassSelect = document.getElementById('currentClassSelect');
        const promotionForm = document.getElementById('promotionForm');
        const selectedStudentsInput = document.getElementById('selectedStudentsInput');
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        let selectedIds = new Set();

        // Automatic filter on change
        currentClassSelect.addEventListener('change', () => {
            const level = currentClassSelect.value;
            window.location.href = `promotion.php?level=${level}`;
        });

        // Mobile sidebar toggle
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });
        
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });

        // Individual checkbox listeners
        const checkboxes = document.querySelectorAll('.student-checkbox');
        checkboxes.forEach(cb => {
            cb.addEventListener('change', () => {
                const id = cb.dataset.id;
                if (cb.checked) {
                    selectedIds.add(id);
                } else {
                    selectedIds.delete(id);
                }
                updateMasterCheckboxState();
            });
        });

        function updateMasterCheckboxState() {
            const allChecked = checkboxes.length > 0 && Array.from(checkboxes).every(cb => cb.checked);
            masterCheckbox.checked = allChecked;
        }

        // Master checkbox toggle
        masterCheckbox.addEventListener('change', () => {
            const isChecked = masterCheckbox.checked;
            checkboxes.forEach(cb => {
                cb.checked = isChecked;
                const id = cb.dataset.id;
                if (isChecked) {
                    selectedIds.add(id);
                } else {
                    selectedIds.delete(id);
                }
            });
        });

        // Select all (visible)
        selectAllBtn.addEventListener('click', () => {
            checkboxes.forEach(cb => {
                cb.checked = true;
                selectedIds.add(cb.dataset.id);
            });
            masterCheckbox.checked = true;
        });

        // Apply filter button
        applyFilterBtn.addEventListener('click', () => {
            const level = levelFilterSelect.value;
            window.location.href = `promotion.php?level=${level}`;
        });

        // Clear filter
        clearFilterBtn.addEventListener('click', () => {
            window.location.href = 'promotion.php';
        });

        // Promote selected students
        promoteBtn.addEventListener('click', () => {
            if (selectedIds.size === 0) {
                alert('Please select at least one student to promote.');
                return;
            }

            const promoteTo = promoteToSelect.value;
            if (!promoteTo) {
                alert('Please select a target class to promote students to.');
                return;
            }

            if (!confirm(`Promote ${selectedIds.size} student(s) to ${promoteTo}?`)) return;

            // Prepare for submission
            selectedStudentsInput.value = Array.from(selectedIds).join(',');
            promotionForm.submit();
        });

        // Initial update of master checkbox if some are pre-checked (unlikely here but good practice)
        updateMasterCheckboxState();
    })();
</script>
</body>
</html>
