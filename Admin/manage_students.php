<?php
require_once '../auth/session.php';
require_once '../include/config.php';
checkAccess('admin');

// Handle Student Deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    try {
        // Get image name before deleting record
        $stmt = $pdo->prepare("SELECT image FROM students WHERE student_id = ?");
        $stmt->execute([$delete_id]);
        $student = $stmt->fetch();
        
        if ($student && $student['image'] && file_exists("../assets/images/student/" . $student['image'])) {
            unlink("../assets/images/student/" . $student['image']);
        }

        $stmt = $pdo->prepare("DELETE FROM students WHERE student_id = ?");
        $stmt->execute([$delete_id]);
        header("Location: manage_students.php?msg=deleted");
        exit;
    } catch (PDOException $e) {
        $error = "Error deleting student: " . $e->getMessage();
    }
}

// Handle Student Update (if submitted via POST to this same page)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_student'])) {
    $student_id = $_POST['student_id'];
    $full_name = filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_STRING);
    $admission_no = filter_input(INPUT_POST, 'admission_no', FILTER_SANITIZE_STRING);
    $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT);
    $parent_guardian = filter_input(INPUT_POST, 'parent_guardian', FILTER_SANITIZE_STRING);
    $contact_number = filter_input(INPUT_POST, 'contact_number', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $session_of_year = filter_input(INPUT_POST, 'session_of_year', FILTER_SANITIZE_STRING);

    try {
        $stmt = $pdo->prepare("UPDATE students SET full_name = ?, admission_no = ?, age = ?, parent_guardian = ?, contact_number = ?, email = ?, session_of_year = ? WHERE student_id = ?");
        $stmt->execute([$full_name, $admission_no, $age, $parent_guardian, $contact_number, $email, $session_of_year, $student_id]);
        header("Location: manage_students.php?msg=updated");
        exit;
    } catch (PDOException $e) {
        $error = "Error updating student: " . $e->getMessage();
    }
}

// Fetch Students
$students = [];
try {
    $sessions = getAcademicSessions($pdo);
    $stmt = $pdo->query("SELECT * FROM students ORDER BY created_at DESC");
    $students = $stmt->fetchAll();
    
    // Get stats
    $total_students = count($students);
    $stmt = $pdo->query("SELECT COUNT(*) FROM students WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)");
    $new_students = $stmt->fetchColumn();
} catch (PDOException $e) {
    $error = "Error fetching data: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students - T&T School Management System</title>
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
        
        h1, h2, h3, h4, h5 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: var(--primary-dark);
        }
        
        .container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Styles */
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
        
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 99;
            display: none;
        }
        
        .overlay.active {
            display: block;
        }
        
        /* Main Content Area */
        .main-content {
            flex: 1;
            margin-left: 250px;
            transition: margin-left 0.3s ease;
            min-height: 100vh;
        }
        
        /* Top Header */
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
        
        /* Dashboard Content */
        .dashboard-content {
            padding: 30px;
        }
        
        /* Student Management Header */
        .student-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            border: none;
            box-shadow: 0 4px 10px rgba(0, 51, 102, 0.1);
        }
        
        .btn-primary {
            background: linear-gradient(to right, var(--primary-dark), var(--primary-medium));
            color: var(--white);
        }
        
        .btn-primary:hover {
            background: linear-gradient(to right, var(--primary-medium), var(--accent-blue));
            transform: translateY(-2px);
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }
        
        /* Stats Overview */
        .stats-overview {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-item {
            background-color: var(--white);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px var(--shadow);
            display: flex;
            align-items: center;
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.3rem;
        }
        
        .stat-icon.total { background-color: rgba(30, 136, 229, 0.1); color: var(--accent-blue); }
        .stat-icon.new { background-color: rgba(40, 167, 69, 0.1); color: var(--success); }
        
        /* Student Table */
        .student-table-container {
            background-color: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px var(--shadow);
        }
        
        .table-header {
            padding: 25px 30px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .student-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .student-table th {
            padding: 18px 20px;
            text-align: left;
            background-color: var(--light-bg);
            color: var(--primary-dark);
            border-bottom: 2px solid #eee;
        }
        
        .student-table td {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }
        
        .student-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 12px;
            border: 2px solid var(--light-bg);
        }
        
        .student-avatar img { width: 100%; height: 100%; object-fit: cover; }
        
        .action-buttons { display: flex; gap: 8px; }
        
        .action-btn {
            width: 34px;
            height: 34px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            transition: 0.2s;
        }
        
        .action-btn.view { background-color: rgba(30, 136, 229, 0.1); color: var(--accent-blue); }
        .action-btn.edit { background-color: rgba(255, 193, 7, 0.1); color: var(--warning); }
        .action-btn.delete { background-color: rgba(220, 53, 69, 0.1); color: var(--danger); }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .modal.active { display: flex; }
        
        .modal-content {
            background-color: var(--white);
            border-radius: 15px;
            width: 100%;
            max-width: 700px;
            max-height: 90vh;
            overflow-y: auto;
        }
        
        .modal-header {
            padding: 20px 30px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-body { padding: 30px; }
        
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 15px; }
        
        .form-group label { display: block; margin-bottom: 5px; font-weight: 600; }
        
        .form-group input, .form-group select {
            width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;
        }

        .alert {
            padding: 15px; margin-bottom: 20px; border-radius: 8px;
        }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); }
            .main-content { margin-left: 0; }
            .menu-toggle { display: block; }
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include '../include/admin_sidebar.php'; ?>
        
        <div class="main-content" id="mainContent">
            <div class="top-header">
                <div class="header-left">
                    <button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
                    <div class="page-title"><h1>Student Management</h1></div>
                </div>
            </div>
            
            <div class="dashboard-content">
                <?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
                    <div class="alert alert-success">Student record deleted successfully.</div>
                <?php endif; ?>
                <?php if (isset($_GET['msg']) && $_GET['msg'] == 'updated'): ?>
                    <div class="alert alert-success">Student record updated successfully.</div>
                <?php endif; ?>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>

                <div class="student-header">
                    <h2>Manage Students</h2>
                    <a href="add_new_student.php" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Add New Student
                    </a>
                </div>
                
                <div class="stats-overview">
                    <div class="stat-item">
                        <div class="stat-icon total"><i class="fas fa-users"></i></div>
                        <div class="stat-info">
                            <h3><?php echo $total_students; ?></h3>
                            <p>Total Students</p>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon new"><i class="fas fa-user-plus"></i></div>
                        <div class="stat-info">
                            <h3><?php echo $new_students; ?></h3>
                            <p>New This Month</p>
                        </div>
                    </div>
                </div>
                
                <div class="student-table-container">
                    <div class="table-header">
                        <h3>Student Records</h3>
                        <span>Showing <?php echo count($students); ?> students</span>
                    </div>
                    
                    <div style="overflow-x: auto;">
                        <table class="student-table">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Session</th>
                                    <th>Parent/Guardian</th>
                                    <th>Contact Number</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($students as $student): ?>
                                <tr>
                                    <td>
                                        <div style="display: flex; align-items: center;">
                                            <div class="student-avatar">
                                                <img src="../assets/images/student/<?php echo $student['image'] ? $student['image'] : 'default.png'; ?>" alt="">
                                            </div>
                                            <div>
                                                <div style="font-weight: 600;"><?php echo htmlspecialchars($student['full_name']); ?></div>
                                                <small style="color: #666;"><?php echo htmlspecialchars($student['admission_no']); ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo htmlspecialchars($student['session_of_year']); ?></td>
                                    <td><?php echo htmlspecialchars($student['parent_guardian']); ?></td>
                                    <td><?php echo htmlspecialchars($student['contact_number']); ?></td>
                                    <td><?php echo htmlspecialchars($student['email']); ?></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-btn view" onclick='viewStudent(<?php echo json_encode($student); ?>)' title="View">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="action-btn edit" onclick='editStudent(<?php echo json_encode($student); ?>)' title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="action-btn delete" onclick="if(confirm('Are you sure you want to delete this student?')) window.location.href='manage_students.php?delete_id=<?php echo $student['student_id']; ?>'" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php if (empty($students)): ?>
                                <tr><td colspan="6" style="text-align: center; padding: 30px;">No student records found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Student Modal -->
    <div class="modal" id="editModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit Student Details</h3>
                <button onclick="closeModal('editModal')" style="background:none; border:none; font-size:1.5rem; cursor:pointer;">&times;</button>
            </div>
            <div class="modal-body">
                <form action="manage_students.php" method="POST">
                    <input type="hidden" name="student_id" id="edit_student_id">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="full_name" id="edit_full_name" required>
                        </div>
                        <div class="form-group">
                            <label>Admission No</label>
                            <input type="text" name="admission_no" id="edit_admission_no" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Age</label>
                            <input type="number" name="age" id="edit_age" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" id="edit_email" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Parent/Guardian</label>
                            <input type="text" name="parent_guardian" id="edit_parent_guardian" required>
                        </div>
                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="text" name="contact_number" id="edit_contact_number" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Academic Session</label>
                        <select name="session_of_year" id="edit_session">
                            <?php foreach ($sessions as $session): ?>
                                <option value="<?php echo $session; ?>"><?php echo $session; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div style="text-align: right; margin-top: 20px;">
                        <button type="button" class="btn btn-secondary" onclick="closeModal('editModal')">Cancel</button>
                        <button type="submit" name="update_student" class="btn btn-primary">Update Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Student Modal -->
    <div class="modal" id="viewModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Student Profile</h3>
                <button onclick="closeModal('viewModal')" style="background:none; border:none; font-size:1.5rem; cursor:pointer;">&times;</button>
            </div>
            <div class="modal-body" id="viewDetails">
                <!-- Populated by JS -->
            </div>
        </div>
    </div>

    <script>
        function editStudent(student) {
            document.getElementById('edit_student_id').value = student.student_id;
            document.getElementById('edit_full_name').value = student.full_name;
            document.getElementById('edit_admission_no').value = student.admission_no;
            document.getElementById('edit_age').value = student.age;
            document.getElementById('edit_email').value = student.email;
            document.getElementById('edit_parent_guardian').value = student.parent_guardian;
            document.getElementById('edit_contact_number').value = student.contact_number;
            document.getElementById('edit_session').value = student.session_of_year;
            document.getElementById('editModal').classList.add('active');
        }

        function viewStudent(student) {
            const container = document.getElementById('viewDetails');
            const imgPath = '../assets/images/student/' + (student.image ? student.image : 'default.png');
            container.innerHTML = `
                <div style="text-align:center; margin-bottom:20px;">
                    <img src="${imgPath}" style="width:120px; height:120px; border-radius:50%; object-fit:cover; border:4px solid var(--primary-light);">
                    <h2 style="margin-top:10px;">${student.full_name}</h2>
                    <p style="color:#666;">Admission No: ${student.admission_no}</p>
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px; background:#f9f9f9; padding:20px; border-radius:10px;">
                    <div><strong>Age:</strong><br>${student.age}</div>
                    <div><strong>Email:</strong><br>${student.email}</div>
                    <div><strong>Parent/Guardian:</strong><br>${student.parent_guardian}</div>
                    <div><strong>Contact:</strong><br>${student.contact_number}</div>
                    <div><strong>Session:</strong><br>${student.session_of_year}</div>
                    <div><strong>Registered On:</strong><br>${new Date(student.created_at).toLocaleDateString()}</div>
                </div>
            `;
            document.getElementById('viewModal').classList.add('active');
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('active');
        }

        // Mobile toggle
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>