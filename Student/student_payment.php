<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>T&T School – Student Payment Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #eef2ff 0%, #d9e4f5 100%);
            padding: 30px 20px;
            color: #1e293b;
        }

        /* main container */
        .payment-container {
            max-width: 1280px;
            margin: 0 auto;
            background: white;
            border-radius: 32px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        /* header */
        .portal-header {
            background: linear-gradient(98deg, #0b2b44 0%, #0a4c6e 100%);
            padding: 28px 32px;
            color: white;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
            align-items: center;
        }

        .logo h1 {
            font-size: 1.8rem;
            font-weight: 700;
        }
        .logo p {
            font-size: 0.85rem;
            opacity: 0.85;
            margin-top: 5px;
        }
        .student-badge {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(4px);
            padding: 10px 24px;
            border-radius: 40px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
        }

        /* main content */
        .main-content {
            padding: 40px;
        }

        /* two columns */
        .payment-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 32px;
            margin-bottom: 32px;
        }

        /* card style */
        .card {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 8px 20px rgba(0, 51, 102, 0.06);
            border: 1px solid #e2edf7;
            overflow: hidden;
            transition: 0.2s;
        }

        .card-header {
            padding: 20px 28px;
            border-bottom: 1px solid #eef2ff;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .card-header i {
            font-size: 1.6rem;
            color: #2c7da0;
        }
        .card-header h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #0b2b44;
        }
        .card-body {
            padding: 28px;
        }

        /* bank details highlight */
        .bank-details {
            background: #f0f8ff;
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 24px;
        }
        .bank-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px dashed #cde3f0;
        }
        .bank-row:last-child {
            border-bottom: none;
        }
        .bank-label {
            font-weight: 600;
            color: #1e4a6b;
        }
        .bank-value {
            font-weight: 700;
            color: #0b2b44;
            letter-spacing: 0.3px;
        }
        .copy-icon {
            margin-left: 10px;
            cursor: pointer;
            color: #2c7da0;
            font-size: 0.9rem;
        }
        .copy-icon:hover {
            color: #0f5b7a;
        }

        /* payment form */
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: 600;
            font-size: 0.85rem;
            display: block;
            margin-bottom: 8px;
            color: #1e4a6b;
        }
        input, select, textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #cbdde9;
            border-radius: 16px;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            background: #fefefe;
            transition: 0.2s;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #2c7da0;
            box-shadow: 0 0 0 3px rgba(44,125,160,0.15);
        }
        .btn {
            border: none;
            padding: 12px 24px;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        .btn-primary {
            background: linear-gradient(105deg, #0b2b44, #1b6b8f);
            color: white;
            box-shadow: 0 4px 8px rgba(0,51,102,0.1);
            width: 100%;
            justify-content: center;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            background: linear-gradient(105deg, #124263, #227d9e);
        }
        .btn-outline {
            border: 1px solid #2c7da0;
            background: white;
            color: #1e4a6b;
        }

        /* recent payments table */
        .recent-payments {
            margin-top: 32px;
        }
        .table-wrapper {
            overflow-x: auto;
            border-radius: 20px;
        }
        .payments-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }
        .payments-table th {
            text-align: left;
            padding: 16px 12px;
            background: #f0f7fe;
            color: #0b2b44;
        }
        .payments-table td {
            padding: 14px 12px;
            border-bottom: 1px solid #e9eff5;
        }
        .status-badge {
            background: #e6f4ea;
            color: #2e7d32;
            padding: 4px 12px;
            border-radius: 30px;
            font-weight: 500;
            font-size: 0.75rem;
            display: inline-block;
        }
        .status-pending {
            background: #fff3e0;
            color: #b45f06;
        }

        /* responsive */
        @media (max-width: 900px) {
            .payment-grid {
                grid-template-columns: 1fr;
            }
            .main-content {
                padding: 24px;
            }
        }
        @media (max-width: 600px) {
            .portal-header {
                flex-direction: column;
                text-align: center;
            }
        }

        .footer-note {
            text-align: center;
            margin-top: 30px;
            font-size: 0.8rem;
            color: #5b7f95;
            border-top: 1px solid #e2edf7;
            padding-top: 24px;
        }
    </style>
</head>
<body>
<div class="payment-container">
    <div class="portal-header">
        <div class="logo">
            <h1><i class="fas fa-graduation-cap"></i> T&T School</h1>
            <p>Student Payment Portal</p>
        </div>
        <div class="student-badge">
            <i class="fas fa-user-circle"></i>
            <span>Michael Johnson | Grade 10A</span>
        </div>
    </div>

    <div class="main-content">
        <div class="payment-grid">
            <!-- LEFT: Bank account details -->
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-university"></i>
                    <h2>School Account Details</h2>
                </div>
                <div class="card-body">
                    <div class="bank-details">
                        <div class="bank-row">
                            <span class="bank-label"><i class="fas fa-building"></i> Bank Name</span>
                            <span class="bank-value">Access Bank Plc</span>
                        </div>
                        <div class="bank-row">
                            <span class="bank-label"><i class="fas fa-hashtag"></i> Account Number</span>
                            <span class="bank-value">1657584637 
                                <i class="fas fa-copy copy-icon" data-copy="1657584637" title="Copy account number"></i>
                            </span>
                        </div>
                        <div class="bank-row">
                            <span class="bank-label"><i class="fas fa-user-tie"></i> Account Name</span>
                            <span class="bank-value">Saidu Umar 
                                <i class="fas fa-copy copy-icon" data-copy="Saidu Umar" title="Copy account name"></i>
                            </span>
                        </div>
                    </div>
                    <div style="background: #eef2ff; border-radius: 16px; padding: 16px; margin-top: 12px;">
                        <i class="fas fa-info-circle" style="color: #2c7da0;"></i> 
                        <span style="font-size: 0.9rem;">Please use your Student ID as payment reference. After transfer, submit the form below to notify the finance office.</span>
                    </div>
                </div>
            </div>

            <!-- RIGHT: Payment submission form -->
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-credit-card"></i>
                    <h2>Submit Payment Details</h2>
                </div>
                <div class="card-body">
                    <form id="paymentForm">
                        <div class="form-group">
                            <label><i class="fas fa-user"></i> Full Name *</label>
                            <input type="text" id="studentName" placeholder="e.g. Michael Johnson" required>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-id-card"></i> Student ID *</label>
                            <input type="text" id="studentId" placeholder="e.g. STU-2023-045" required>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-tag"></i> Payment For (e.g., Tuition, Exam Fee) *</label>
                            <input type="text" id="paymentPurpose" placeholder="Tuition - Term 2" required>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-money-bill-wave"></i> Amount (₦ or USD) *</label>
                            <input type="number" id="amount" placeholder="e.g. 150000" required min="100">
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-calendar"></i> Payment Date *</label>
                            <input type="date" id="paymentDate" required>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-hashtag"></i> Transaction Reference / Deposit Slip No.</label>
                            <input type="text" id="reference" placeholder="Enter transaction ID or teller number">
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-upload"></i> Payment Proof (optional)</label>
                            <input type="file" id="proofUpload" accept="image/*,.pdf">
                            <small style="color:#5b7f95;">Upload screenshot or bank slip (max 2MB)</small>
                        </div>
                        <button type="submit" class="btn btn-primary" id="submitPaymentBtn">
                            <i class="fas fa-paper-plane"></i> Submit Payment Notification
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Recent payment history (demo / localStorage) -->
        <div class="recent-payments card">
            <div class="card-header">
                <i class="fas fa-history"></i>
                <h2>Recent Payment Submissions</h2>
            </div>
            <div class="card-body">
                <div class="table-wrapper">
                    <table class="payments-table" id="paymentsTable">
                        <thead>
                            <tr><th>Date</th><th>Student</th><th>Purpose</th><th>Amount</th><th>Status</th><th>Ref</th></tr>
                        </thead>
                        <tbody id="paymentHistoryBody">
                            <tr><td colspan="6" style="text-align: center;">No payments recorded yet. Submit the form to track.</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="footer-note">
            <i class="fas fa-lock"></i> Secured payment notification system. After submission, the finance team will verify your transfer.
        </div>
    </div>
</div>

<script>
    // ---------- LOCAL STORAGE FOR PAYMENT HISTORY ----------
    const STORAGE_KEY = 'tt_school_payments';
    let paymentsArray = [];

    // load existing
    function loadPayments() {
        const stored = localStorage.getItem(STORAGE_KEY);
        if(stored) {
            paymentsArray = JSON.parse(stored);
        } else {
            // demo placeholder
            paymentsArray = [];
        }
        renderPaymentHistory();
    }

    function savePayments() {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(paymentsArray));
    }

    function renderPaymentHistory() {
        const tbody = document.getElementById('paymentHistoryBody');
        if(!paymentsArray.length) {
            tbody.innerHTML = '<tr><td colspan="6" style="text-align: center;">📭 No payment submissions yet. Complete the form above.</td></tr>';
            return;
        }
        let html = '';
        // show latest first
        [...paymentsArray].reverse().forEach(p => {
            const statusClass = p.status === 'Pending' ? 'status-pending' : 'status-badge';
            html += `
                <tr>
                    <td>${p.date}</td>
                    <td>${escapeHtml(p.studentName)} (${p.studentId})</td>
                    <td>${escapeHtml(p.purpose)}</td>
                    <td>${p.amount}</td>
                    <td><span class="status-badge ${statusClass}">${p.status}</span></td>
                    <td>${p.reference || '—'}</td>
                </tr>
            `;
        });
        tbody.innerHTML = html;
    }

    function escapeHtml(str) { if(!str) return ''; return str.replace(/[&<>]/g, function(m){if(m==='&') return '&amp;'; if(m==='<') return '&lt;'; if(m==='>') return '&gt;'; return m;}); }

    // add new payment record
    function addPaymentRecord(studentName, studentId, purpose, amount, paymentDate, reference, proofFile) {
        if(!studentName || !studentId || !purpose || !amount || !paymentDate) {
            alert("Please fill all required fields (*).");
            return false;
        }
        const amountVal = parseFloat(amount);
        if(isNaN(amountVal) || amountVal <= 0) {
            alert("Enter a valid amount.");
            return false;
        }
        // create record
        const newRecord = {
            id: Date.now(),
            studentName: studentName.trim(),
            studentId: studentId.trim(),
            purpose: purpose.trim(),
            amount: amountVal,
            date: paymentDate,
            reference: reference || 'N/A',
            status: 'Pending',
            proofName: proofFile ? proofFile.name : null,
            timestamp: new Date().toISOString()
        };
        paymentsArray.push(newRecord);
        savePayments();
        renderPaymentHistory();
        return true;
    }

    // Copy functionality for account details
    function setupCopyButtons() {
        const copyIcons = document.querySelectorAll('.copy-icon');
        copyIcons.forEach(icon => {
            icon.addEventListener('click', (e) => {
                const textToCopy = icon.getAttribute('data-copy');
                if(textToCopy) {
                    navigator.clipboard.writeText(textToCopy).then(() => {
                        // temporary tooltip feedback
                        const originalTitle = icon.getAttribute('title');
                        icon.setAttribute('title', 'Copied!');
                        setTimeout(() => icon.setAttribute('title', originalTitle), 1500);
                        // optional alert
                        const msg = document.createElement('div');
                        msg.innerText = `Copied: ${textToCopy}`;
                        msg.style.position = 'fixed'; msg.style.bottom = '20px'; msg.style.right = '20px';
                        msg.style.background = '#0b2b44'; msg.style.color = 'white'; msg.style.padding = '10px 18px';
                        msg.style.borderRadius = '30px'; msg.style.fontSize = '0.8rem'; msg.style.zIndex = '999';
                        document.body.appendChild(msg);
                        setTimeout(() => msg.remove(), 2000);
                    }).catch(() => alert('Press Ctrl+C to copy'));
                }
            });
        });
    }

    // Form submission
    document.getElementById('paymentForm').addEventListener('submit', (e) => {
        e.preventDefault();
        const studentName = document.getElementById('studentName').value.trim();
        const studentId = document.getElementById('studentId').value.trim();
        const purpose = document.getElementById('paymentPurpose').value.trim();
        const amount = document.getElementById('amount').value;
        const paymentDate = document.getElementById('paymentDate').value;
        const reference = document.getElementById('reference').value.trim();
        const proofFile = document.getElementById('proofUpload').files[0];

        if(addPaymentRecord(studentName, studentId, purpose, amount, paymentDate, reference, proofFile)) {
            // clear form but keep account details visible
            document.getElementById('studentName').value = '';
            document.getElementById('studentId').value = '';
            document.getElementById('paymentPurpose').value = '';
            document.getElementById('amount').value = '';
            document.getElementById('paymentDate').value = '';
            document.getElementById('reference').value = '';
            document.getElementById('proofUpload').value = '';
            alert('✅ Payment notification submitted! The finance office will verify and update status.');
        }
    });

    // set default date as today
    const today = new Date().toISOString().slice(0,10);
    document.getElementById('paymentDate').value = today;

    loadPayments();
    setupCopyButtons();
</script>
</body>
</html>