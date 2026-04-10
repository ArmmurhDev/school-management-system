<?php
require_once '../auth/session.php';
require_once '../include/config.php';
checkAccess('staff');

$staff_id = $_SESSION['user_id'];
$query = "SELECT * FROM staff WHERE staff_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$staff_id]);
$staff = $stmt->fetch(PDO::FETCH_ASSOC);

$staff_name_display = $staff['full_name'] ?? 'Staff Member';
$staff_position_display = $staff['position'] ?? 'Teacher';
$staff_subject_display = $staff['subject'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Results Entry - T&T School Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            background-color: #f5f7fb;
            color: var(--text-dark);
            overflow-x: hidden;
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

        /* Main Content Area */
        .main-content {
            flex: 1;
            margin-left: 250px;
            transition: margin-left 0.3s ease;
            padding: 30px;
            min-height: 100vh;
        }

        /* Overlay for mobile */
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

        /* Top Header (Top Bar) */
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
            margin-bottom: 30px;
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
            font-family: 'Poppins', sans-serif;
            font-size: 1.8rem;
            color: var(--primary-dark);
        }

        .staff-badge {
            background: var(--light-bg);
            padding: 8px 20px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--primary-dark);
            border: 1px solid var(--primary-light);
        }

        /* cards & forms */
        .card {
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 5px 15px var(--shadow);
            margin-bottom: 30px;
            overflow: hidden;
        }

        .card-header {
            padding: 20px 25px;
            background-color: #f9f9f9;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-header h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.3rem;
            color: var(--primary-dark);
            margin: 0;
        }

        .card-body {
            padding: 25px;
        }

        /* form grid */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .input-group label {
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--primary-dark);
        }

        .input-group input, .input-group select {
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: 'Open Sans', sans-serif;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .input-group input:focus {
            outline: none;
            border-color: var(--primary-medium);
            box-shadow: 0 0 0 3px rgba(0, 80, 158, 0.1);
        }

        .btn {
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(to right, var(--primary-dark), var(--primary-medium));
            color: white;
            box-shadow: 0 4px 10px rgba(0, 51, 102, 0.1);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 51, 102, 0.2);
        }

        .btn-outline {
            background-color: var(--light-bg);
            color: var(--primary-medium);
            border: 1px solid var(--primary-light);
        }

        .btn-outline:hover {
            background-color: #e3f2fd;
        }

        /* table wrapper */
        .table-wrapper {
            overflow-x: auto;
        }

        .results-table {
            width: 100%;
            border-collapse: collapse;
        }

        .results-table th {
            text-align: left;
            padding: 15px;
            background-color: var(--light-bg);
            color: var(--primary-dark);
            font-weight: 600;
            border-bottom: 2px solid #eee;
        }

        .results-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .grade-badge {
            background: rgba(40, 167, 69, 0.1);
            color: var(--success);
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .action-icons {
            display: flex;
            gap: 10px;
        }

        .action-icons i {
            padding: 8px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .edit-icon { color: var(--primary-medium); background: rgba(0, 80, 158, 0.1); }
        .delete-icon { color: var(--danger); background: rgba(220, 53, 69, 0.1); }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .menu-toggle {
                display: block;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <?php include '../include/staff_sidebar.php'; ?>
    
    <!-- Overlay for mobile -->
    <div class="overlay" id="overlay"></div>
    
    <div class="main-content">
        <!-- Top Header -->
        <div class="top-header">
            <div class="header-left">
                <button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
                <div class="page-title">
                    <h1>Results Entry</h1>
                </div>
            </div>
            <div class="staff-badge">
                <i class="fas fa-user-check"></i>
                <span><?php echo htmlspecialchars($staff_name_display); ?></span>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2><i class="fas fa-upload"></i> Upload New Test Result</h2>
            </div>
            <div class="card-body">
                <div class="form-grid">
                    <div class="input-group">
                        <label>Student Name *</label>
                        <input type="text" id="studentName" placeholder="e.g. Michael Johnson">
                    </div>
                    <div class="input-group">
                        <label>Subject *</label>
                        <input type="text" id="subject" value="<?php echo htmlspecialchars($staff_subject_display); ?>" placeholder="e.g. Physics">
                    </div>
                    <div class="input-group">
                        <label>Test Name *</label>
                        <input type="text" id="testName" placeholder="e.g. Midterm">
                    </div>
                    <div class="input-group">
                        <label>Score (%) *</label>
                        <input type="number" id="score" min="0" max="100" placeholder="0-100">
                    </div>
                    <div class="input-group">
                        <label>Date</label>
                        <input type="date" id="resultDate" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>
                <div style="display: flex; justify-content: flex-end; gap: 15px;">
                    <button class="btn btn-outline" id="clearFormBtn">Clear</button>
                    <button class="btn btn-primary" id="saveResultBtn">Save Result</button>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2><i class="fas fa-table-list"></i> Uploaded Results</h2>
                <div><span id="recordCount">0</span> records</div>
            </div>
            <div class="card-body">
                <div class="table-wrapper">
                    <table class="results-table">
                        <thead>
                            <tr>
                                <th>Student</th><th>Subject</th><th>Test</th><th>Score</th><th>Grade</th><th>Date</th><th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // DOM Elements
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    // Mobile sidebar toggle
    if (menuToggle) {
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });
    }

    if (overlay) {
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });
    }

    // Results logic
    const STORAGE_KEY = 'tt_school_results';
    let resultsArray = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [
        { id: 1, student: "Michael Johnson", subject: "Physics", testName: "Midterm", score: 88, date: "2025-03-10", grade: "A-" },
        { id: 2, student: "Sarah Williams", subject: "Mathematics", testName: "Quiz 2", score: 92, date: "2025-03-12", grade: "A" }
    ];

    function getGrade(score) {
        if(score >= 90) return "A";
        if(score >= 80) return "B";
        if(score >= 70) return "C";
        if(score >= 60) return "D";
        return "F";
    }

    function renderTable() {
        const tbody = document.getElementById('tableBody');
        tbody.innerHTML = resultsArray.length ? resultsArray.map(item => `
            <tr>
                <td>${item.student}</td>
                <td>${item.subject}</td>
                <td>${item.testName}</td>
                <td><strong>${item.score}%</strong></td>
                <td><span class="grade-badge">${item.grade}</span></td>
                <td>${item.date}</td>
                <td class="action-icons">
                    <i class="fas fa-edit edit-icon" onclick="alert('Edit logic goes here')"></i>
                    <i class="fas fa-trash-alt delete-icon" onclick="deleteItem(${item.id})"></i>
                </td>
            </tr>
        `).join('') : '<tr><td colspan="7" style="text-align:center; padding: 30px;">No results found</td></tr>';
        document.getElementById('recordCount').innerText = resultsArray.length;
    }

    window.deleteItem = (id) => {
        if(confirm('Delete this record?')) {
            resultsArray = resultsArray.filter(item => item.id !== id);
            localStorage.setItem(STORAGE_KEY, JSON.stringify(resultsArray));
            renderTable();
        }
    };

    document.getElementById('saveResultBtn').addEventListener('click', () => {
        const student = document.getElementById('studentName').value.trim();
        const subject = document.getElementById('subject').value.trim();
        const test = document.getElementById('testName').value.trim();
        const score = parseFloat(document.getElementById('score').value);
        const date = document.getElementById('resultDate').value;

        if(student && subject && test && !isNaN(score)) {
            resultsArray.unshift({ id: Date.now(), student, subject, testName: test, score, date, grade: getGrade(score) });
            localStorage.setItem(STORAGE_KEY, JSON.stringify(resultsArray));
            renderTable();
            document.getElementById('studentName').value = '';
            document.getElementById('score').value = '';
            document.getElementById('testName').value = '';
        } else {
            alert('Please fill all required fields');
        }
    });

    document.getElementById('clearFormBtn').addEventListener('click', () => {
        document.getElementById('studentName').value = '';
        document.getElementById('testName').value = '';
        document.getElementById('score').value = '';
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        if(window.innerWidth >= 992 && sidebar) {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        }
    });

    renderTable();
</script>
</body>
</html>