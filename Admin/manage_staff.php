<?php
require_once '../auth/session.php';
require_once '../include/config.php';
checkAccess('admin');

// Handle Staff Deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    try {
        $stmt = $pdo->prepare("SELECT image FROM staff WHERE staff_id = ?");
        $stmt->execute([$delete_id]);
        $staff_member = $stmt->fetch();
        
        if ($staff_member && $staff_member['image'] && file_exists("../assets/images/staff/" . $staff_member['image'])) {
            unlink("../assets/images/staff/" . $staff_member['image']);
        }

        $stmt = $pdo->prepare("DELETE FROM staff WHERE staff_id = ?");
        $stmt->execute([$delete_id]);
        header("Location: manage_staff.php?msg=deleted");
        exit;
    } catch (PDOException $e) {
        $error = "Error deleting staff: " . $e->getMessage();
    }
}

// Handle Staff Update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_staff'])) {
    $staff_id = $_POST['staff_id'];
    $full_name = filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $qualification = filter_input(INPUT_POST, 'qualification', FILTER_SANITIZE_STRING);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_STRING);

    try {
        $stmt = $pdo->prepare("UPDATE staff SET full_name = ?, email = ?, phone = ?, qualification = ?, subject = ?, position = ? WHERE staff_id = ?");
        $stmt->execute([$full_name, $email, $phone, $qualification, $subject, $position, $staff_id]);
        header("Location: manage_staff.php?msg=updated");
        exit;
    } catch (PDOException $e) {
        $error = "Error updating staff: " . $e->getMessage();
    }
}

// Fetch Staff, Positions, and Subjects
$staff_list = [];
$teaching_count = 0;
$admin_count = 0;

try {
    $positions = getStaffPositions($pdo);
    $subjects = getSubjects($pdo);
    $stmt = $pdo->query("SELECT * FROM staff ORDER BY created_at DESC");
    $staff_list = $stmt->fetchAll();
    
    foreach ($staff_list as $s) {
        $pos = strtolower($s['position']);
        if (strpos($pos, 'teacher') !== false || strpos($pos, 'staff') !== false) $teaching_count++;
        elseif (strpos($pos, 'admin') !== false || strpos($pos, 'registra') !== false || strpos($pos, 'director') !== false) $admin_count++;
    }
} catch (PDOException $e) {
    $error = "Error fetching data: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Staff - T&T School Management System</title>
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
        .sidebar-menu { padding: 20px 0; }
        .menu-item { padding: 15px 20px; display: flex; align-items: center; cursor: pointer; transition: all 0.3s; text-decoration: none; color: rgba(255, 255, 255, 0.8); border-left: 3px solid transparent; }
        .menu-item:hover, .menu-item.active { background-color: rgba(255, 255, 255, 0.1); color: var(--white); border-left-color: var(--accent-blue); }
        .menu-item i { width: 25px; margin-right: 15px; font-size: 1.1rem; }

        /* Main Content Area */
        .main-content { flex: 1; margin-left: 250px; transition: margin-left 0.3s ease; min-height: 100vh; }
        .top-header { background-color: var(--white); padding: 20px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px var(--shadow); position: sticky; top: 0; z-index: 99; }
        .menu-toggle { background: none; border: none; font-size: 1.5rem; color: var(--primary-dark); cursor: pointer; margin-right: 20px; display: none; }
        .dashboard-content { padding: 30px; }

        /* Staff Management Header */
        .staff-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .btn { display: inline-flex; align-items: center; padding: 12px 24px; border-radius: 8px; font-weight: 600; font-size: 0.95rem; cursor: pointer; transition: all 0.3s ease; text-decoration: none; border: none; box-shadow: 0 4px 10px rgba(0, 51, 102, 0.1); }
        .btn-primary { background: linear-gradient(to right, var(--primary-dark), var(--primary-medium)); color: var(--white); }
        .btn-secondary { background-color: var(--light-bg); color: var(--primary-medium); border: 1px solid var(--primary-light); }

        /* Stats Overview */
        .stats-overview { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 30px; }
        .stat-item { background-color: var(--white); border-radius: 10px; padding: 20px; box-shadow: 0 5px 15px var(--shadow); display: flex; align-items: center; transition: all 0.3s ease; }
        .stat-item:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0, 51, 102, 0.15); }
        .stat-icon { width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 15px; font-size: 1.3rem; }
        .stat-icon.teachers { background-color: rgba(30, 136, 229, 0.1); color: var(--accent-blue); }
        .stat-icon.administrative { background-color: rgba(40, 167, 69, 0.1); color: var(--success); }
        .stat-info h3 { font-size: 1.5rem; margin-bottom: 5px; }
        .stat-info p { font-size: 0.9rem; color: var(--text-light); }

        /* Filters Bar */
        .filters-bar { background-color: var(--white); border-radius: 10px; padding: 20px; margin-bottom: 30px; box-shadow: 0 5px 15px var(--shadow); display: flex; flex-wrap: wrap; gap: 20px; align-items: center; }
        .filter-group { flex: 1; min-width: 200px; }
        .filter-group label { display: block; margin-bottom: 8px; font-weight: 600; color: var(--primary-dark); font-size: 0.9rem; }
        .filter-group select, .filter-group input { width: 100%; padding: 10px 15px; border: 1px solid #ddd; border-radius: 6px; font-size: 0.95rem; background-color: #f9f9f9; }

        /* Staff Table */
        .staff-table-container { background-color: var(--white); border-radius: 12px; overflow: hidden; box-shadow: 0 5px 15px var(--shadow); margin-bottom: 40px; }
        .table-header { padding: 25px 30px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
        .table-responsive { overflow-x: auto; }
        .staff-table { width: 100%; border-collapse: collapse; }
        .staff-table thead { background-color: var(--light-bg); }
        .staff-table th { padding: 18px 20px; text-align: left; font-weight: 600; color: var(--primary-dark); border-bottom: 2px solid #eee; white-space: nowrap; }
        .staff-table td { padding: 20px; border-bottom: 1px solid #eee; vertical-align: middle; }
        .staff-info { display: flex; align-items: center; }
        .staff-avatar { width: 50px; height: 50px; border-radius: 50%; overflow: hidden; margin-right: 15px; border: 3px solid var(--light-bg); }
        .staff-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .action-buttons { display: flex; gap: 8px; }
        .action-btn { width: 36px; height: 36px; border-radius: 6px; display: flex; align-items: center; justify-content: center; border: none; cursor: pointer; transition: 0.3s; }
        .action-btn.edit { background-color: rgba(255, 193, 7, 0.1); color: var(--warning); }
        .action-btn.delete { background-color: rgba(220, 53, 69, 0.1); color: var(--danger); }
        .action-btn.view { background-color: rgba(30, 136, 229, 0.1); color: var(--accent-blue); }

        /* Modal Styles */
        .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1000; align-items: center; justify-content: center; padding: 20px; }
        .modal.active { display: flex; }
        .modal-content { background-color: var(--white); border-radius: 15px; width: 100%; max-width: 700px; max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2); }
        .modal-header { padding: 25px 30px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
        .modal-body { padding: 30px; }
        .form-row { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 600; }
        .form-group input, .form-group select { width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 8px; font-size: 0.95rem; }
        .overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 99; display: none; }
        .overlay.active { display: block; }

        @media (max-width: 992px) { .sidebar { transform: translateX(-100%); } .main-content { margin-left: 0; } .menu-toggle { display: block; } }
    </style>
</head>
<body>
    <div class="container">
        <?php include '../include/admin_sidebar.php'; ?>
        <div class="overlay" id="overlay"></div>
        
        <div class="main-content" id="mainContent">
            <div class="top-header">
                <div class="header-left">
                    <button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
                    <div class="page-title"><h1>Staff Management</h1></div>
                </div>
            </div>
            
            <div class="dashboard-content">
                <?php if (isset($_GET['msg'])): ?>
                    <div style="background:#d4edda; color:#155724; padding:15px; border-radius:8px; margin-bottom:20px; border:1px solid #c3e6cb;">Operation completed successfully.</div>
                <?php endif; ?>

                <div class="staff-header">
                    <h2>Manage Staff Members</h2>
                    <div class="staff-actions">
                        <a href="add_new_staff.php" class="btn btn-primary"><i class="fas fa-user-plus"></i> Add New Staff</a>
                    </div>
                </div>
                
                <div class="stats-overview">
                    <div class="stat-item">
                        <div class="stat-icon teachers"><i class="fas fa-chalkboard-teacher"></i></div>
                        <div class="stat-info"><h3><?php echo $teaching_count; ?></h3><p>Teaching Staff</p></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon administrative"><i class="fas fa-user-tie"></i></div>
                        <div class="stat-info"><h3><?php echo $admin_count; ?></h3><p>Administrative Staff</p></div>
                    </div>
                </div>
                
                <div class="filters-bar" id="filtersBar">
                    <div class="filter-group">
                        <label for="staffPositionFilter">Position</label>
                        <select id="staffPositionFilter">
                            <option value="">All Positions</option>
                            <?php foreach ($positions as $pos): ?>
                                <option value="<?php echo $pos; ?>"><?php echo $pos; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="staffSearch">Search</label>
                        <input type="text" id="staffSearch" placeholder="Search by name or email...">
                    </div>
                    <div class="filter-group">
                        <button class="btn btn-secondary" id="clearFiltersBtn"><i class="fas fa-times"></i> Clear Filters</button>
                    </div>
                </div>
                
                <div class="staff-table-container">
                    <div class="table-header"><h3>Staff Records</h3><div><span id="staffCount"><?php echo count($staff_list); ?></span> staff found</div></div>
                    <div class="table-responsive">
                        <table class="staff-table">
                            <thead><tr><th>Staff Member</th><th>Position</th><th>Subject</th><th>Contact</th><th>Actions</th></tr></thead>
                            <tbody id="staffTableBody"></tbody>
                        </table>
                    </div>
                </div>
                
                <div class="dashboard-footer"><p>&copy; 2023 T&T School Management System. All rights reserved.</p></div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal" id="staffModal">
        <div class="modal-content">
            <div class="modal-header"><h3>Edit Staff Member</h3><button class="close-modal" onclick="closeModal('staffModal')" style="background:none; border:none; font-size:1.5rem; cursor:pointer;">&times;</button></div>
            <div class="modal-body">
                <form action="manage_staff.php" method="POST">
                    <input type="hidden" name="staff_id" id="edit_staff_id">
                    <div class="form-row">
                        <div class="form-group"><label>Full Name</label><input type="text" name="full_name" id="edit_full_name" required></div>
                        <div class="form-group"><label>Email</label><input type="email" name="email" id="edit_email" required></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group"><label>Phone</label><input type="text" name="phone" id="edit_phone"></div>
                        <div class="form-group"><label>Qualification</label><input type="text" name="qualification" id="edit_qualification"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Position</label>
                            <select name="position" id="edit_position" required>
                                <?php foreach ($positions as $pos): ?>
                                    <option value="<?php echo $pos; ?>"><?php echo $pos; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Subject</label>
                            <select name="subject" id="edit_subject">
                                <option value="">None</option>
                                <?php foreach ($subjects as $sub): ?>
                                    <option value="<?php echo $sub; ?>"><?php echo $sub; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div style="text-align: right; margin-top: 20px;">
                        <button type="button" class="btn btn-secondary" onclick="closeModal('staffModal')">Cancel</button>
                        <button type="submit" name="update_staff" class="btn btn-primary">Update Staff Information</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div class="modal" id="viewModal">
        <div class="modal-content">
            <div class="modal-header"><h3>Staff Member Profile</h3><button class="close-modal" onclick="closeModal('viewModal')" style="background:none; border:none; font-size:1.5rem; cursor:pointer;">&times;</button></div>
            <div class="modal-body" id="viewDetails"></div>
            <div style="padding: 20px 30px; border-top: 1px solid #eee; text-align: right;">
                <button class="btn btn-secondary" onclick="closeModal('viewModal')">Close Profile</button>
            </div>
        </div>
    </div>

    <script>
        const staffData = <?php echo json_encode($staff_list); ?>;
        const staffTableBody = document.getElementById('staffTableBody');
        
        function renderStaff(filtered = staffData) {
            staffTableBody.innerHTML = '';
            document.getElementById('staffCount').textContent = filtered.length;

            if (filtered.length === 0) {
                staffTableBody.innerHTML = '<tr><td colspan="5" style="text-align:center; padding:30px;">No matching records found.</td></tr>';
                return;
            }

            filtered.forEach(s => {
                const img = s.image ? '../assets/images/staff/' + s.image : '../assets/images/staff/default.png';
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><div class="staff-info"><div class="staff-avatar"><img src="${img}"></div>
                    <div><h4>${s.full_name}</h4><p>ID: STF-${s.staff_id}</p></div></div></td>
                    <td>${s.position}</td>
                    <td>${s.subject || 'N/A'}</td>
                    <td><div>${s.email}</div><small>${s.phone}</small></td>
                    <td><div class="action-buttons">
                        <button class="action-btn view" title="View Profile" onclick='viewStaff(${JSON.stringify(s)})'><i class="fas fa-eye"></i></button>
                        <button class="action-btn edit" title="Edit Info" onclick='editStaff(${JSON.stringify(s)})'><i class="fas fa-edit"></i></button>
                        <button class="action-btn delete" title="Delete Staff" onclick="deleteStaff(${s.staff_id})"><i class="fas fa-trash"></i></button>
                    </div></td>`;
                staffTableBody.appendChild(row);
            });
        }

        function editStaff(s) {
            document.getElementById('edit_staff_id').value = s.staff_id;
            document.getElementById('edit_full_name').value = s.full_name;
            document.getElementById('edit_email').value = s.email;
            document.getElementById('edit_phone').value = s.phone;
            document.getElementById('edit_qualification').value = s.qualification;
            document.getElementById('edit_position').value = s.position;
            document.getElementById('edit_subject').value = s.subject;
            document.getElementById('staffModal').classList.add('active');
        }

        function viewStaff(s) {
            const img = s.image ? '../assets/images/staff/' + s.image : '../assets/images/staff/default.png';
            document.getElementById('viewDetails').innerHTML = `
                <div style="text-align:center; margin-bottom:20px;">
                    <img src="${img}" style="width:120px; height:120px; border-radius:50%; object-fit:cover; border:4px solid var(--primary-light);">
                    <h2 style="margin-top:10px;">${s.full_name}</h2><p style="color:var(--primary-medium); font-weight:600;">${s.position}</p>
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px; background:#f9f9f9; padding:25px; border-radius:12px;">
                    <div><strong style="font-size:0.8rem; color:#666;">EMAIL ADDRESS</strong><br>${s.email}</div>
                    <div><strong style="font-size:0.8rem; color:#666;">PHONE NUMBER</strong><br>${s.phone}</div>
                    <div><strong style="font-size:0.8rem; color:#666;">SUBJECT</strong><br>${s.subject || 'N/A'}</div>
                    <div><strong style="font-size:0.8rem; color:#666;">QUALIFICATION</strong><br>${s.qualification || 'N/A'}</div>
                    <div style="grid-column: span 2;"><strong style="font-size:0.8rem; color:#666;">JOINED DATE</strong><br>${new Date(s.created_at).toLocaleDateString()}</div>
                </div>`;
            document.getElementById('viewModal').classList.add('active');
        }

        function deleteStaff(id) { if(confirm('Are you sure you want to delete this staff member? This action is permanent.')) window.location.href = 'manage_staff.php?delete_id=' + id; }
        function closeModal(id) { document.getElementById(id).classList.remove('active'); }

        // Filter functionality
        document.getElementById('staffSearch').addEventListener('input', e => {
            const term = e.target.value.toLowerCase();
            renderStaff(staffData.filter(s => s.full_name.toLowerCase().includes(term) || s.email.toLowerCase().includes(term)));
        });

        document.getElementById('staffPositionFilter').addEventListener('change', e => {
            const val = e.target.value;
            renderStaff(val ? staffData.filter(s => s.position === val) : staffData);
        });

        document.getElementById('clearFiltersBtn').addEventListener('click', () => {
            document.getElementById('staffSearch').value = '';
            document.getElementById('staffPositionFilter').value = '';
            renderStaff();
        });

        document.getElementById('menuToggle').addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('overlay').classList.toggle('active');
        });

        document.getElementById('overlay').addEventListener('click', () => {
            document.getElementById('sidebar').classList.remove('active');
            document.getElementById('overlay').classList.remove('active');
        });

        document.addEventListener('DOMContentLoaded', () => renderStaff());
    </script>
</body>
</html>