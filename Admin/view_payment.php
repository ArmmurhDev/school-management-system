<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>T&T School – Admin Fee Management</title>
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
            padding: 25px 20px;
            color: #1e293b;
        }

        .admin-container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 32px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        /* header */
        .admin-header {
            background: linear-gradient(98deg, #0b2b44 0%, #0a4c6e 100%);
            padding: 24px 32px;
            color: white;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            align-items: center;
            gap: 15px;
        }
        .logo h1 { font-size: 1.7rem; font-weight: 700; }
        .logo p { font-size: 0.8rem; opacity: 0.85; margin-top: 4px; }
        .admin-badge {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(4px);
            padding: 8px 20px;
            border-radius: 40px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* stats cards */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding: 32px 32px 0 32px;
        }
        .stat-card {
            background: #f0f8ff;
            border-radius: 24px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.02);
        }
        .stat-icon {
            width: 50px;
            height: 50px;
            background: #d4e7f1;
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #0b2b44;
        }
        .stat-info h3 { font-size: 1.8rem; font-weight: 700; color: #0b2b44; }
        .stat-info p { font-size: 0.8rem; color: #3b6e8f; }

        /* main content */
        .main-content {
            padding: 32px;
        }

        /* student table */
        .card {
            background: white;
            border-radius: 24px;
            border: 1px solid #e2edf7;
            margin-bottom: 32px;
            overflow: hidden;
        }
        .card-header {
            padding: 20px 28px;
            border-bottom: 1px solid #eef2ff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        .card-header h2 {
            font-size: 1.4rem;
            font-weight: 600;
            color: #0b2b44;
        }
        .filter-group {
            display: flex;
            gap: 12px;
            align-items: center;
        }
        .filter-group select, .filter-group input {
            padding: 8px 16px;
            border-radius: 30px;
            border: 1px solid #cbdde9;
            font-family: 'Inter', sans-serif;
        }

        .table-wrapper {
            overflow-x: auto;
        }
        .student-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }
        .student-table th {
            text-align: left;
            padding: 16px 12px;
            background: #f7fbfe;
            color: #1e4a6b;
        }
        .student-table td {
            padding: 14px 12px;
            border-bottom: 1px solid #e9eff5;
            vertical-align: middle;
        }
        .paid-badge {
            background: #e0f2e9;
            color: #1e6f3f;
            padding: 4px 12px;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.75rem;
            display: inline-block;
        }
        .partial-badge {
            background: #fff3e0;
            color: #b45f06;
        }
        .late-badge {
            background: #ffebee;
            color: #c62828;
        }
        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        .btn-icon {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.1rem;
            padding: 6px;
            border-radius: 30px;
            transition: 0.1s;
        }
        .btn-pay { color: #2c7da0; }
        .btn-pay:hover { background: #e0f0fa; }
        .btn-late { color: #e67e22; }
        .btn-late:hover { background: #fee8dd; }
        .amount-input {
            width: 90px;
            padding: 6px 8px;
            border: 1px solid #cbdde9;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        /* modal */
        .modal {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
        .modal.active { display: flex; }
        .modal-content {
            background: white;
            max-width: 450px;
            width: 90%;
            border-radius: 28px;
            padding: 28px;
        }
        .modal-content h3 { margin-bottom: 20px; color: #0b2b44; }
        .modal-buttons { display: flex; justify-content: flex-end; gap: 12px; margin-top: 24px; }
        .btn-primary {
            background: linear-gradient(105deg, #0b2b44, #1b6b8f);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 40px;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-outline {
            background: white;
            border: 1px solid #2c7da0;
            padding: 10px 20px;
            border-radius: 40px;
            cursor: pointer;
        }

        @media (max-width: 700px) {
            .main-content { padding: 20px; }
            .stats-row { padding: 20px; }
            .student-table th, .student-table td { padding: 10px 6px; font-size: 0.75rem; }
            .amount-input { width: 70px; }
        }
    </style>
</head>
<body>
<div class="admin-container">
    <div class="admin-header">
        <div class="logo">
            <h1><i class="fas fa-school"></i> T&T School</h1>
            <p>Admin Fee Management</p>
        </div>
        <div class="admin-badge">
            <i class="fas fa-user-shield"></i> <span>Finance Admin</span>
        </div>
    </div>

    <!-- Stats -->
    <div class="stats-row" id="statsContainer"></div>

    <div class="main-content">
        <div class="card">
            <div class="card-header">
                <h2><i class="fas fa-users"></i> Student Fee Records</h2>
                <div class="filter-group">
                    <select id="statusFilter">
                        <option value="all">All status</option>
                        <option value="paid">Fully Paid</option>
                        <option value="partial">Partial</option>
                        <option value="unpaid">Unpaid</option>
                    </select>
                    <input type="text" id="searchInput" placeholder="Search student...">
                </div>
            </div>
            <div class="table-wrapper">
                <table class="student-table" id="studentTable">
                    <thead>
                        <tr><th>Student ID</th><th>Name</th><th>Class</th><th>Total Fees (₦)</th><th>Paid (₦)</th><th>Balance</th><th>Status</th><th>Record Payment</th><th>Late Penalty</th></tr>
                    </thead>
                    <tbody id="studentTableBody"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Payment Modal -->
<div id="paymentModal" class="modal">
    <div class="modal-content">
        <h3><i class="fas fa-money-bill-wave"></i> Record Payment</h3>
        <input type="hidden" id="modalStudentId">
        <p><strong id="modalStudentName"></strong></p>
        <div style="margin: 15px 0;">
            <label>Amount to pay (₦)</label>
            <input type="number" id="paymentAmount" class="amount-input" style="width:100%; padding: 10px;" placeholder="Enter amount">
        </div>
        <div style="margin-bottom: 15px;">
            <label><i class="fas fa-clock"></i> Late payment fee (₦) – optional</label>
            <input type="number" id="lateFee" class="amount-input" style="width:100%; padding: 10px;" placeholder="Additional late charge" value="0">
        </div>
        <div class="modal-buttons">
            <button class="btn-outline" id="closeModalBtn">Cancel</button>
            <button class="btn-primary" id="confirmPaymentBtn">Submit Payment</button>
        </div>
    </div>
</div>

<script>
    // -------- MOCK STUDENT DATA (will be stored in localStorage) --------
    const STORAGE_KEY = 'tt_admin_fees';
    let students = [];

    // default demo students
    const defaultStudents = [
        { id: "STU-1001", name: "Michael Johnson", class: "Grade 10A", totalFee: 150000, paidAmount: 0, latePenalty: 0 },
        { id: "STU-1002", name: "Sarah Williams", class: "Grade 10A", totalFee: 150000, paidAmount: 75000, latePenalty: 0 },
        { id: "STU-1003", name: "David Chen", class: "Grade 11B", totalFee: 160000, paidAmount: 160000, latePenalty: 0 },
        { id: "STU-1004", name: "Emily Davis", class: "Grade 12A", totalFee: 170000, paidAmount: 50000, latePenalty: 5000 },
        { id: "STU-1005", name: "James Wilson", class: "Grade 9C", totalFee: 140000, paidAmount: 0, latePenalty: 0 },
        { id: "STU-1006", name: "Olivia Martinez", class: "Grade 10B", totalFee: 150000, paidAmount: 140000, latePenalty: 0 }
    ];

    function loadData() {
        const stored = localStorage.getItem(STORAGE_KEY);
        if(stored) {
            students = JSON.parse(stored);
        } else {
            students = defaultStudents.map(s => ({ ...s }));
            saveData();
        }
        renderStats();
        renderTable();
    }

    function saveData() {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(students));
    }

    // compute derived fields
    function getStatus(student) {
        const balance = student.totalFee - student.paidAmount;
        if(balance <= 0) return "paid";
        if(student.paidAmount > 0) return "partial";
        return "unpaid";
    }

    function renderStats() {
        const totalCollected = students.reduce((sum, s) => sum + s.paidAmount, 0);
        const totalLate = students.reduce((sum, s) => sum + (s.latePenalty || 0), 0);
        const totalExpected = students.reduce((sum, s) => sum + s.totalFee, 0);
        const pending = totalExpected - totalCollected;
        const paidCount = students.filter(s => getStatus(s) === 'paid').length;
        const partialCount = students.filter(s => getStatus(s) === 'partial').length;
        const unpaidCount = students.filter(s => getStatus(s) === 'unpaid').length;

        document.getElementById('statsContainer').innerHTML = `
            <div class="stat-card"><div class="stat-icon"><i class="fas fa-coins"></i></div><div class="stat-info"><h3>₦${totalCollected.toLocaleString()}</h3><p>Collected</p></div></div>
            <div class="stat-card"><div class="stat-icon"><i class="fas fa-hourglass-half"></i></div><div class="stat-info"><h3>₦${pending.toLocaleString()}</h3><p>Pending</p></div></div>
            <div class="stat-card"><div class="stat-icon"><i class="fas fa-check-circle"></i></div><div class="stat-info"><h3>${paidCount}</h3><p>Fully Paid</p></div></div>
            <div class="stat-card"><div class="stat-icon"><i class="fas fa-exclamation-triangle"></i></div><div class="stat-info"><h3>${unpaidCount}</h3><p>Unpaid</p></div></div>
            <div class="stat-card"><div class="stat-icon"><i class="fas fa-clock"></i></div><div class="stat-info"><h3>₦${totalLate.toLocaleString()}</h3><p>Late Fees</p></div></div>
        `;
    }

    function renderTable() {
        const filterStatus = document.getElementById('statusFilter').value;
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        let filtered = students.filter(s => {
            if(filterStatus !== 'all' && getStatus(s) !== filterStatus) return false;
            if(searchTerm && !s.name.toLowerCase().includes(searchTerm) && !s.id.toLowerCase().includes(searchTerm)) return false;
            return true;
        });

        const tbody = document.getElementById('studentTableBody');
        if(filtered.length === 0) {
            tbody.innerHTML = '<tr><td colspan="9" style="text-align:center;">No students found</td></tr>';
            return;
        }

        let html = '';
        filtered.forEach(student => {
            const balance = student.totalFee - student.paidAmount;
            const status = getStatus(student);
            let statusHtml = '';
            if(status === 'paid') statusHtml = '<span class="paid-badge"><i class="fas fa-check"></i> Paid</span>';
            else if(status === 'partial') statusHtml = '<span class="paid-badge partial-badge"><i class="fas fa-charging-station"></i> Partial</span>';
            else statusHtml = '<span class="late-badge"><i class="fas fa-hourglass"></i> Unpaid</span>';
            
            const latePenalty = student.latePenalty || 0;
            html += `
                <tr>
                    <td>${student.id}</td>
                    <td>${student.name}</td>
                    <td>${student.class}</td>
                    <td>₦${student.totalFee.toLocaleString()}</td>
                    <td>₦${student.paidAmount.toLocaleString()}</td>
                    <td>₦${balance.toLocaleString()}</td>
                    <td>${statusHtml}</td>
                    <td>
                        <div style="display:flex; gap:6px; align-items:center;">
                            <input type="number" id="amount_${student.id}" placeholder="Amount" class="amount-input" style="width:100px;">
                            <button class="btn-icon btn-pay" data-id="${student.id}" data-action="pay"><i class="fas fa-credit-card"></i> Pay</button>
                        </div>
                    </td>
                    <td>
                        <button class="btn-icon btn-late" data-id="${student.id}" data-action="late"><i class="fas fa-clock"></i> Add Late Fee</button>
                    </td>
                </tr>
            `;
        });
        tbody.innerHTML = html;

        // attach event listeners
        document.querySelectorAll('[data-action="pay"]').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const studentId = btn.getAttribute('data-id');
                const amountInput = document.getElementById(`amount_${studentId}`);
                let amount = parseFloat(amountInput.value);
                if(isNaN(amount) || amount <= 0) {
                    alert("Please enter a valid positive amount.");
                    return;
                }
                const student = students.find(s => s.id === studentId);
                if(student) {
                    const newPaid = student.paidAmount + amount;
                    if(newPaid > student.totalFee) {
                        if(confirm(`Overpayment of ₦${(newPaid - student.totalFee).toLocaleString()}. Accept?`)) {
                            student.paidAmount = newPaid;
                        } else return;
                    } else {
                        student.paidAmount = newPaid;
                    }
                    saveData();
                    renderStats();
                    renderTable();
                }
            });
        });

        document.querySelectorAll('[data-action="late"]').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const studentId = btn.getAttribute('data-id');
                const student = students.find(s => s.id === studentId);
                if(student) {
                    let lateValue = prompt(`Enter late payment penalty for ${student.name} (₦):`, student.latePenalty || 0);
                    if(lateValue !== null) {
                        let penalty = parseFloat(lateValue);
                        if(isNaN(penalty)) penalty = 0;
                        student.latePenalty = penalty;
                        // optionally add to totalFee? Usually late fee is extra. We add it to totalFee for clarity.
                        student.totalFee += penalty;
                        saveData();
                        renderStats();
                        renderTable();
                        alert(`Late fee of ₦${penalty} added. Total fee updated.`);
                    }
                }
            });
        });
    }

    // filter event listeners
    document.getElementById('statusFilter').addEventListener('change', () => renderTable());
    document.getElementById('searchInput').addEventListener('input', () => renderTable());

    // modal for extra payment with late penalty (optional but we keep for demonstration)
    let currentModalStudent = null;
    function openPaymentModal(student) {
        currentModalStudent = student;
        document.getElementById('modalStudentId').value = student.id;
        document.getElementById('modalStudentName').innerText = `${student.name} (Balance: ₦${(student.totalFee - student.paidAmount).toLocaleString()})`;
        document.getElementById('paymentAmount').value = '';
        document.getElementById('lateFee').value = '0';
        document.getElementById('paymentModal').classList.add('active');
    }

    document.getElementById('confirmPaymentBtn').addEventListener('click', () => {
        const studentId = document.getElementById('modalStudentId').value;
        const student = students.find(s => s.id === studentId);
        if(student) {
            let amount = parseFloat(document.getElementById('paymentAmount').value);
            let lateFee = parseFloat(document.getElementById('lateFee').value);
            if(isNaN(amount)) amount = 0;
            if(isNaN(lateFee)) lateFee = 0;
            if(amount <= 0 && lateFee <= 0) {
                alert("Enter amount or late fee.");
                return;
            }
            if(lateFee > 0) {
                student.latePenalty = (student.latePenalty || 0) + lateFee;
                student.totalFee += lateFee;
            }
            if(amount > 0) {
                const newPaid = student.paidAmount + amount;
                if(newPaid > student.totalFee) {
                    if(!confirm(`Overpayment by ₦${(newPaid - student.totalFee).toLocaleString()}. Continue?`)) return;
                }
                student.paidAmount = newPaid;
            }
            saveData();
            renderStats();
            renderTable();
            document.getElementById('paymentModal').classList.remove('active');
        }
    });

    document.getElementById('closeModalBtn').addEventListener('click', () => {
        document.getElementById('paymentModal').classList.remove('active');
    });

    loadData();
</script>
</body>
</html>