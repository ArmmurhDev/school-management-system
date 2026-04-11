<?php
require_once '../auth/session.php';
require_once '../include/config.php';
checkAccess('admin');

// Fetch current school fee
$stmt = $pdo->query("SELECT fee_amount FROM school_fees WHERE fee_id = 1");
$schoolFee = $stmt->fetchColumn() ?: 47000.00;

// Handle AJAX request to update fee
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_fee'])) {
    header('Content-Type: application/json');
    $newFee = filter_input(INPUT_POST, 'new_fee', FILTER_VALIDATE_FLOAT);
    if ($newFee !== false && $newFee >= 0) {
        $stmt = $pdo->prepare("INSERT INTO school_fees (fee_id, fee_amount) VALUES (1, ?) ON DUPLICATE KEY UPDATE fee_amount = ?");
        if ($stmt->execute([$newFee, $newFee])) {
            echo json_encode(['success' => true, 'message' => 'School fee updated successfully!', 'new_fee' => $newFee]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update fee']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid fee amount']);
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <title>Fee Settings · T&T School Management</title>
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

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: #002147;
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
            transition: all 0.3s ease;
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

        .dashboard-content {
            padding: 30px;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }

        /* ----- FEE CONFIG CARD ----- */
        .config-container {
            max-width: 680px;
            width: 100%;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 30px;
            text-align: left;
            width: 100%;
        }

        .page-header h2 {
            font-size: 2rem;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .page-header p {
            color: var(--text-light);
            font-size: 1rem;
        }

        .fee-card {
            background: var(--white);
            border-radius: 24px;
            box-shadow: 0 15px 30px var(--shadow);
            padding: 32px 30px;
            transition: transform 0.2s;
        }

        .fee-card:hover {
            box-shadow: 0 20px 35px rgba(0, 51, 102, 0.12);
        }

        .current-fee-display {
            background: var(--light-bg);
            border-radius: 18px;
            padding: 20px 24px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            border-left: 6px solid var(--primary-medium);
        }

        .fee-label {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .fee-label i {
            font-size: 2rem;
            color: var(--primary-dark);
        }

        .fee-label span {
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--primary-dark);
        }

        .fee-amount {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-dark);
            font-family: 'Poppins', sans-serif;
        }

        .fee-amount small {
            font-size: 1rem;
            font-weight: 400;
            color: var(--text-light);
            margin-left: 6px;
        }

        .form-group {
            margin-bottom: 28px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 10px;
            font-size: 1rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-light);
            font-size: 1.2rem;
        }

        .fee-input {
            width: 100%;
            padding: 18px 20px 18px 55px;
            font-size: 1.3rem;
            font-weight: 500;
            border: 2px solid #e0e7ef;
            border-radius: 16px;
            background: #fbfdff;
            font-family: 'Open Sans', sans-serif;
            transition: border 0.2s, box-shadow 0.2s;
        }

        .fee-input:focus {
            outline: none;
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 4px rgba(30, 136, 229, 0.15);
        }

        .fee-input::placeholder {
            font-weight: 400;
            color: #aaa;
            font-size: 1rem;
        }

        .hint-text {
            margin-top: 8px;
            font-size: 0.9rem;
            color: var(--text-light);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 16px 28px;
            border-radius: 14px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 6px 14px var(--shadow);
            background: var(--white);
            color: var(--primary-medium);
            border: 1px solid var(--primary-light);
            width: 100%;
        }

        .btn i {
            margin-right: 10px;
        }

        .btn-primary {
            background: linear-gradient(to right, var(--primary-dark), var(--primary-medium));
            color: var(--white);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(to right, var(--primary-medium), var(--accent-blue));
            transform: translateY(-3px);
            box-shadow: 0 12px 20px rgba(0, 51, 102, 0.2);
        }

        .success-message {
            margin-top: 16px;
            color: var(--success);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .success-message.show {
            opacity: 1;
        }

        .dashboard-footer {
            margin-top: 50px;
            padding: 20px 30px;
            text-align: center;
            color: var(--text-light);
            font-size: 0.9rem;
            border-top: 1px solid #eee;
            background: var(--white);
            width: 100%;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .top-header { padding: 16px 20px; }
            .dashboard-content { padding: 20px 16px; }
            .fee-card { padding: 24px 20px; }
            .fee-amount { font-size: 2rem; }
            .current-fee-display { flex-direction: column; align-items: flex-start; gap: 12px; }
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
            <!-- Top Header -->
            <div class="top-header">
                <div class="header-left">
                    <button class="menu-toggle" id="menuToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <a href="admin_fees.php" style="margin-right: 20px; color: var(--primary-dark); font-size: 1.2rem; display: flex; align-items: center; text-decoration: none;">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <div class="page-title">
                        <h1>Fee Configuration</h1>
                    </div>
                </div>
                <div class="header-right">
                    <div class="header-action"><i class="fas fa-cog"></i></div>
                    <div class="header-action"><i class="fas fa-user-shield"></i></div>
                </div>
            </div>

            <div class="dashboard-content">
                <div class="config-container">
                    <div class="page-header">
                        <h2><i class="fas fa-dollar-sign" style="color: var(--primary-medium); background: var(--light-bg); padding: 10px; border-radius: 14px;"></i> School Fees Price</h2>
                        <p>Set or update the standard annual tuition fee. Changes apply to new invoices.</p>
                    </div>

                    <!-- Main Fee Card -->
                    <div class="fee-card">
                        <!-- Current fee display (dynamically updated) -->
                        <div class="current-fee-display">
                            <div class="fee-label">
                                <i class="fas fa-graduation-cap"></i>
                                <span>Current Annual Fee</span>
                            </div>
                            <div class="fee-amount" id="currentFeeDisplay">₦<?php echo number_format($schoolFee, 2); ?></div>
                        </div>

                        <!-- Simple form: only input and save -->
                        <form id="feeForm">
                            <div class="form-group">
                                <label for="feeAmount">Set new fee amount (₦)</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <input type="number" 
                                           id="feeAmount" 
                                           class="fee-input" 
                                           placeholder="e.g. 47000.00" 
                                           step="0.01" 
                                           min="0" 
                                           value="<?php echo $schoolFee; ?>" 
                                           required>
                                </div>
                                <div class="hint-text">
                                    <i class="fas fa-info-circle"></i>
                                    <span>Enter the full annual tuition. You can update it anytime.</span>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary" id="saveFeeBtn">
                                <i class="fas fa-save"></i> Update Fee Price
                            </button>
                            <div class="success-message" id="successMessage">
                                <i class="fas fa-check-circle"></i> Fee updated successfully!
                            </div>
                        </form>
                    </div>

                    <!-- small extra note (edit only via form, no extra buttons) -->
                    <p style="margin-top: 25px; color: var(--text-light); font-size: 0.9rem; text-align: center;">
                        <i class="fas fa-lock" style="margin-right: 6px;"></i> Admin only · Changes are logged for audit.
                    </p>
                </div>
                <div class="dashboard-footer">
                    <p>© 2025 T&T School Management System · Fee Settings</p>
                </div>
            </div>
        </div>
    </div>

<script>
    (function(){
        "use strict";

        // Mobile Menu Toggle
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

        // DOM elements
        const feeInput = document.getElementById('feeAmount');
        const currentFeeDisplay = document.getElementById('currentFeeDisplay');
        const feeForm = document.getElementById('feeForm');
        const successMsg = document.getElementById('successMessage');

        // Update display with currency formatting
        function updateFeeDisplay(value) {
            const formatted = '₦' + parseFloat(value).toLocaleString('en-NG', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            currentFeeDisplay.textContent = formatted;
        }

        // Show success message temporarily
        function showTemporarySuccess() {
            successMsg.classList.add('show');
            setTimeout(() => {
                successMsg.classList.remove('show');
            }, 3000);
        }

        // Handle form submission
        feeForm.addEventListener('submit', (e) => {
            e.preventDefault();

            // Get raw value and parse
            const rawValue = feeInput.value.trim();
            if (!rawValue) return;

            let newFee = parseFloat(rawValue);
            if (isNaN(newFee) || newFee < 0) {
                alert('Please enter a valid positive amount.');
                return;
            }

            const formData = new FormData();
            formData.append('update_fee', '1');
            formData.append('new_fee', newFee);

            fetch('school_fees_price.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateFeeDisplay(data.new_fee);
                    feeInput.value = parseFloat(data.new_fee).toFixed(2);
                    showTemporarySuccess();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("An error occurred while updating the fee");
            });
        });

        // Initialize display
        updateFeeDisplay(<?php echo $schoolFee; ?>);

        // Optional: format on blur (user-friendly)
        feeInput.addEventListener('blur', () => {
            let val = parseFloat(feeInput.value);
            if (!isNaN(val) && val >= 0) {
                val = Math.round(val * 100) / 100;
                feeInput.value = val.toFixed(2);
            }
        });
    })();
</script>
</body>
</html>