<?php
require_once '../auth/session.php';
require_once '../include/config.php';
checkAccess('student');

// Fetch current school fee
$stmt = $pdo->query("SELECT fee_amount FROM school_fees WHERE fee_id = 1");
$schoolFee = $stmt->fetchColumn() ?: 47000.00;

// Get student details
$student_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM students WHERE student_id = ?");
$stmt->execute([$student_id]);
$student = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <title>Pay School Fees · T&T Student Portal</title>
    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/student-dashboard.css">
    <!-- Paystack JS -->
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <style>
        /* ----- T&T COLOR SCHEME (exact match) ----- */
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

        body {
            font-family: 'Open Sans', sans-serif;
            color: var(--text-dark);
            background-color: #f5f7fb;
        }

        /* ----- PAYMENT CARD (student view) ----- */
        .payment-container {
            max-width: 720px;
            width: 100%;
            margin: 50px auto;
        }

        .fee-card {
            background: var(--white);
            border-radius: 28px;
            box-shadow: 0 20px 35px var(--shadow);
            padding: 36px 32px;
            transition: all 0.2s;
            width: 100%;
        }

        .current-fee-banner {
            background: linear-gradient(145deg, var(--light-bg), #e6f0ff);
            border-radius: 20px;
            padding: 24px 28px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            border-left: 8px solid var(--primary-medium);
        }

        .fee-detail h3 {
            font-size: 1rem;
            font-weight: 500;
            color: var(--primary-dark);
            margin-bottom: 8px;
        }

        .fee-amount-large {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-dark);
            font-family: 'Poppins', sans-serif;
            line-height: 1.2;
        }

        .fee-amount-large small {
            font-size: 1rem;
            font-weight: 400;
            color: var(--text-light);
            margin-left: 8px;
        }

        .outstanding-tag {
            background: rgba(220, 53, 69, 0.08);
            padding: 8px 16px;
            border-radius: 40px;
            color: var(--danger);
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 8px;
            font-size: 0.95rem;
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

        .payment-input {
            width: 100%;
            padding: 16px 20px 16px 55px;
            font-size: 1.2rem;
            font-weight: 500;
            border: 2px solid #e0e7ef;
            border-radius: 18px;
            background: #fbfdff;
            font-family: 'Open Sans', sans-serif;
            transition: border 0.2s, box-shadow 0.2s;
        }

        .payment-input:focus {
            outline: none;
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 4px rgba(30, 136, 229, 0.1);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 18px 28px;
            border-radius: 18px;
            font-weight: 600;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 8px 18px var(--shadow);
            width: 100%;
            margin-top: 12px;
        }

        .btn i {
            margin-right: 10px;
        }

        .btn-primary {
            background: linear-gradient(to right, var(--primary-dark), var(--primary-medium));
            color: var(--white);
        }

        .btn-primary:hover {
            background: linear-gradient(to right, var(--primary-medium), var(--accent-blue));
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(0, 51, 102, 0.2);
        }

        .secure-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 20px;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        /* Success message */
        .toast-message {
            background: var(--success);
            color: white;
            padding: 14px 24px;
            border-radius: 50px;
            margin-top: 20px;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            opacity: 0;
            transition: opacity 0.3s;
            box-shadow: 0 8px 16px rgba(40,167,69,0.2);
        }

        .toast-message.show {
            opacity: 1;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .fee-card { padding: 24px 20px; }
            .fee-amount-large { font-size: 2.2rem; }
            .current-fee-banner { flex-direction: column; align-items: flex-start; gap: 15px; }
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
                        <h1>Pay School Fees</h1>
                    </div>
                </div>
                <div class="header-right">
                    <div class="header-action"><i class="fas fa-bell"></i></div>
                    <div class="header-action"><i class="fas fa-user-graduate"></i></div>
                </div>
            </div>

            <div class="dashboard-content">
                <div class="payment-container">
                    <!-- Main Payment Card -->
                    <div class="fee-card">
                        <div class="current-fee-banner">
                            <div class="fee-detail">
                                <h3><i class="fas fa-file-invoice" style="margin-right: 8px;"></i>Annual Tuition (2024‑2025)</h3>
                                <div class="fee-amount-large">
                                    ₦<?php echo number_format($schoolFee, 2); ?>
                                    <small>NGN</small>
                                </div>
                            </div>
                            <div class="outstanding-tag">
                                <i class="fas fa-exclamation-circle"></i> Outstanding: ₦<?php echo number_format($schoolFee, 2); ?>
                            </div>
                        </div>

                        <form id="paymentForm">
                            <!-- Amount to pay -->
                            <div class="form-group">
                                <label for="paymentAmount">Amount to pay</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <input type="number" 
                                           id="paymentAmount" 
                                           class="payment-input" 
                                           placeholder="Enter amount" 
                                           step="0.01" 
                                           min="0.01" 
                                           value="<?php echo $schoolFee; ?>" 
                                           required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary" id="payBtn">
                                <i class="fas fa-lock"></i> Pay ₦<?php echo number_format($schoolFee, 2); ?> Now
                            </button>

                            <div class="secure-note">
                                <i class="fas fa-shield-alt"></i>
                                <span>Secure SSL encrypted payment via Paystack</span>
                            </div>
                        </form>

                        <!-- Success toast -->
                        <div class="toast-message" id="successToast">
                            <i class="fas fa-check-circle"></i> Payment successful! Receipt sent to your email.
                        </div>
                    </div>
                </div>
                <div class="dashboard-footer">
                    <p>© 2025 T&T School Management System · Student Fee Payment</p>
                </div>
            </div>
        </div>
    </div>

<script>
    (function(){
        "use strict";

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

        // DOM Elements
        const paymentAmountInput = document.getElementById('paymentAmount');
        const payBtn = document.getElementById('payBtn');
        const successToast = document.getElementById('successToast');
        const paymentForm = document.getElementById('paymentForm');

        // Paystack Config
        const PAYSTACK_PUBLIC_KEY = '<?php echo PAYSTACK_PUBLIC_KEY; ?>';
        const STUDENT_EMAIL = '<?php echo $student['email']; ?>';
        const STUDENT_NAME = '<?php echo htmlspecialchars($student['full_name']); ?>';
        const STUDENT_ID = '<?php echo htmlspecialchars($student['admission_no']); ?>';
        
        // Update pay button text when amount changes
        function updatePayButtonText() {
            let amount = parseFloat(paymentAmountInput.value);
            if (isNaN(amount) || amount <= 0) {
                amount = 0;
            }
            const formatted = '₦' + amount.toLocaleString('en-NG', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            payBtn.innerHTML = `<i class="fas fa-lock"></i> Pay ${formatted} Now`;
        }

        paymentAmountInput.addEventListener('input', updatePayButtonText);
        updatePayButtonText(); // initial

        // Form submit: trigger Paystack
        paymentForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const amount = parseFloat(paymentAmountInput.value);
            if (isNaN(amount) || amount <= 0) {
                alert('Please enter a valid amount.');
                return;
            }

            // Paystack Inline logic
            const handler = PaystackPop.setup({
                key: PAYSTACK_PUBLIC_KEY,
                email: STUDENT_EMAIL,
                amount: amount * 100, // Amount in kobo
                currency: "NGN",
                ref: 'TT-' + Math.floor((Math.random() * 1000000000) + 1), // Generate random reference
                metadata: {
                    custom_fields: [
                        {
                            display_name: "Student Name",
                            variable_name: "student_name",
                            value: STUDENT_NAME
                        },
                        {
                            display_name: "Admission No",
                            variable_name: "admission_no",
                            value: STUDENT_ID
                        }
                    ]
                },
                callback: function(response) {
                    // Success! 
                    console.log(response);
                    successToast.classList.add('show');
                    
                    // In a real app, you would verify the transaction on your server here
                    // fetch('verify_payment.php?reference=' + response.reference)...

                    setTimeout(() => {
                        successToast.classList.remove('show');
                        // Optionally redirect to a confirmation page
                        window.location.reload();
                    }, 4000);
                },
                onClose: function() {
                    alert('Transaction cancelled.');
                }
            });

            handler.openIframe();
        });

        // Pre-fill amount with outstanding
        paymentAmountInput.value = <?php echo $schoolFee; ?>;
        updatePayButtonText();
    })();
</script>
</body>
</html>