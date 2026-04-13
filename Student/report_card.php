<?php
require_once '../auth/session.php';
require_once '../include/config.php';
checkAccess('student');

$student_id = $_SESSION['user_id'];

// Check if results are released
$stmt = $pdo->query("SELECT setting_value FROM settings WHERE setting_key = 'results_released'");
$isReleased = $stmt->fetchColumn() == '1';

// Fetch student details
$stmt = $pdo->prepare("SELECT * FROM students WHERE student_id = ?");
$stmt->execute([$student_id]);
$student = $stmt->fetch();

// Fetch current term setting
$stmt = $pdo->query("SELECT setting_value FROM settings WHERE setting_key = 'current_term'");
$currentTermName = $stmt->fetchColumn() ?: 'First Term';

// Fetch results if released
$results = [];
if ($isReleased) {
    $stmt = $pdo->prepare("
        SELECT r.*, st.full_name as staff_name
        FROM student_results r
        LEFT JOIN staff st ON r.staff_id = st.staff_id
        WHERE r.student_id = ?
        ORDER BY r.subject ASC
    ");
    $stmt->execute([$student_id]);
    $results = $stmt->fetchAll();
}

// Calculations
$totalScore = 0;
$count = count($results);
foreach ($results as $res) {
    $totalScore += $res['score'];
}
$average = $count > 0 ? round($totalScore / $count, 1) : 0;

// Grade logic helper
function getReportRemark($grade) {
    switch ($grade) {
        case 'A': return 'Excellent';
        case 'B': return 'Very Good';
        case 'C': return 'Good';
        case 'D': return 'Fair';
        case 'F': return 'Poor';
        default: return 'N/A';
    }
}

// Overall Grade
$overallGrade = 'F';
if ($average >= 80) $overallGrade = 'A';
elseif ($average >= 70) $overallGrade = 'B';
elseif ($average >= 60) $overallGrade = 'C';
elseif ($average >= 40) $overallGrade = 'D';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Card · T&T Student Portal</title>
    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/student-dashboard.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background-color: #f5f7fb;
        }
        .report-card {
            max-width: 1000px;
            width: 100%;
            background: white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 40px 50px;
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            margin: 0 auto;
        }
        /* Watermark effect */
        .watermark {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            pointer-events: none;
            opacity: 0.05;
            font-size: 6rem;
            font-weight: bold;
            color: #aaa;
            transform: rotate(-30deg) scale(1.2);
            white-space: nowrap;
            z-index: 0;
        }
        .content {
            position: relative;
            z-index: 1;
        }
        .header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #003366;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .logo {
            width: 80px;
            height: 80px;
            background: #003366;
            color: white;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-right: 20px;
            font-weight: bold;
            text-align: center;
            line-height: 1.2;
        }
        .school-info {
            flex: 1;
        }
        .school-info h1 {
            color: #003366;
            font-size: 2rem;
            letter-spacing: 1px;
            font-family: 'Poppins', sans-serif;
        }
        .school-info p {
            color: #333;
            font-size: 0.9rem;
        }
        .title {
            text-align: center;
            margin: 20px 0;
            font-size: 1.5rem;
            font-weight: bold;
            text-transform: uppercase;
            color: #003366;
            border-bottom: 1px dashed #aaa;
            padding-bottom: 10px;
            font-family: 'Poppins', sans-serif;
        }
        .student-details {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            background: #f5f9ff;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
        }
        .student-details div {
            flex: 1 1 200px;
            font-size: 0.95rem;
        }
        .student-details strong {
            color: #003366;
        }
        .result-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 0.95rem;
        }
        .result-table th {
            background: #003366;
            color: white;
            padding: 12px 5px;
            font-weight: 600;
        }
        .result-table td, .result-table th {
            border: 1px solid #ccc;
            padding: 10px 5px;
            text-align: center;
        }
        .result-table td.subject {
            text-align: left;
            padding-left: 15px;
            font-weight: 500;
        }
        .summary {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            background: #f0f0f0;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .summary-item {
            flex: 1 1 150px;
            margin: 5px;
            font-size: 0.9rem;
        }
        .summary-item .label {
            font-weight: bold;
            color: #003366;
        }
        .comments {
            margin: 25px 0;
            padding: 15px;
            background: #fafafa;
            border-left: 5px solid #003366;
            font-size: 0.95rem;
        }
        .signatures {
            display: flex;
            justify-content: space-between;
            margin: 30px 0 15px;
        }
        .signature-box {
            text-align: center;
            width: 200px;
            font-size: 0.9rem;
        }
        .signature-line {
            border-top: 1px solid #333;
            width: 100%;
            margin: 5px 0;
            padding-top: 5px;
            font-weight: 600;
        }
        .card-footer {
            text-align: center;
            font-size: 0.8rem;
            color: #666;
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 15px;
        }
        .pending-notice {
            background: white;
            border-radius: 20px;
            padding: 60px 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            max-width: 600px;
            margin: 50px auto;
        }
        @media (max-width: 768px) {
            .report-card {
                padding: 20px;
            }
            .school-info h1 {
                font-size: 1.5rem;
            }
            .result-table {
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <?php include '../include/student-sidebar.php'; ?>
        
        <!-- Overlay for mobile -->
        <div class="overlay" id="overlay"></div>

        <div class="main-content" id="mainContent">
            <!-- Top Header -->
            <div class="top-header">
                <div class="header-left">
                    <button class="menu-toggle" id="menuToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="page-title">
                        <h1>Grades & Report Card</h1>
                    </div>
                </div>
                <div class="header-right">
                    <div class="header-action"><i class="fas fa-bell"></i></div>
                    <div class="header-action"><i class="fas fa-user-graduate"></i></div>
                </div>
            </div>

            <div class="dashboard-content">
                <?php if (!$isReleased): ?>
                    <div class="pending-notice">
                        <i class="fas fa-clock" style="font-size: 4rem; color: var(--warning); margin-bottom: 20px;"></i>
                        <h2>Results Pending</h2>
                        <p style="color: var(--text-light); margin-top: 10px;">The academic results for this term have not been released by the administration yet. Please check back later.</p>
                    </div>
                <?php elseif (empty($results)): ?>
                    <div class="pending-notice">
                        <i class="fas fa-exclamation-triangle" style="font-size: 4rem; color: var(--danger); margin-bottom: 20px;"></i>
                        <h2>No Records Found</h2>
                        <p style="color: var(--text-light); margin-top: 10px;">We couldn't find any result records for you in our database for this session.</p>
                    </div>
                <?php else: ?>
                    <div class="report-card">
                        <!-- Watermark -->
                        <div class="watermark">T & T SCHOOL</div>
                        
                        <div class="content">
                            <!-- Header with Logo and School Info -->
                            <div class="header">
                                <div class="logo">T&T<br>SCHOOL</div>
                                <div class="school-info">
                                    <h1>T & T SCHOOL</h1>
                                    <p>123 Education Avenue, Knowledge City | +234 801 234 5678 | info@ttschool.edu</p>
                                </div>
                            </div>

                            <!-- Report Title -->
                            <div class="title">STUDENT RESULT CARD – <?php echo htmlspecialchars($student['session_of_year']); ?></div>

                            <!-- Student Details -->
                            <div class="student-details">
                                <div><strong>Name:</strong> <?php echo htmlspecialchars($student['full_name']); ?></div>
                                <div><strong>Admission No:</strong> <?php echo htmlspecialchars($student['admission_no']); ?></div>
                                <div><strong>Class:</strong> <?php echo htmlspecialchars($student['class_name'] ?? 'N/A'); ?></div>
                                <div><strong>Term:</strong> <?php echo $currentTermName; ?></div>
                            </div>

                            <!-- Results Table -->
                            <table class="result-table">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>CA (40)</th>
                                        <th>Exam (60)</th>
                                        <th>Total (100)</th>
                                        <th>Grade</th>
                                        <th>Remark</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($results as $res): ?>
                                        <tr>
                                            <td class="subject"><?php echo htmlspecialchars($res['subject']); ?></td>
                                            <td><?php echo number_format($res['ca_score'], 1); ?></td>
                                            <td><?php echo number_format($res['exam_score'], 1); ?></td>
                                            <td><?php echo number_format($res['score'], 1); ?></td>
                                            <td><strong><?php echo $res['grade']; ?></strong></td>
                                            <td><?php echo getReportRemark($res['grade']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                            <!-- Summary Section -->
                            <div class="summary">
                                <div class="summary-item"><span class="label">Total Subjects:</span> <?php echo $count; ?></div>
                                <div class="summary-item"><span class="label">Total Score:</span> <?php echo number_format($totalScore, 1); ?></div>
                                <div class="summary-item"><span class="label">Average:</span> <?php echo $average; ?>%</div>
                                <div class="summary-item"><span class="label">Overall Grade:</span> <?php echo $overallGrade; ?></div>
                                <div class="summary-item"><span class="label">Overall Remark:</span> <?php echo getReportRemark($overallGrade); ?></div>
                            </div>

                            <!-- Signatures -->
                            <div class="signatures">
                                <div class="signature-box">
                                    <div class="signature-line">Class Teacher</div>
                                    <div>Verification Only</div>
                                </div>
                                <div class="signature-box">
                                    <div class="signature-line">Principal</div>
                                    <div>Official Seal Required</div>
                                </div>
                            </div>

                            <!-- Footer -->
                            <div class="card-footer">
                                Generated: <?php echo date('F j, Y \a\t g:i A'); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="dashboard-footer">
                    <p>&copy; 2025 T&T School Management System | Student Portal</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sidebar Toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        if (menuToggle && sidebar && overlay) {
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            });

            overlay.addEventListener('click', () => {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });
        }
    </script>
</body>
</html>