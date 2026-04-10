<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>T&T School – Admin Fee Payment Overview</title>
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

        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 32px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        /* header */
        .top-bar {
            background: linear-gradient(98deg, #0b2b44 0%, #0a4c6e 100%);
            padding: 28px 32px;
            color: white;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
            align-items: center;
        }
        .logo-area h1 {
            font-size: 1.8rem;
            font-weight: 700;
        }
        .logo-area p {
            font-size: 0.85rem;
            opacity: 0.85;
            margin-top: 5px;
        }
        .admin-badge {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(4px);
            padding: 10px 24px;
            border-radius: 40px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
        }

        /* content */
        .main-content {
            padding: 32px;
        }

        /* summary cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }
        .stat-card {
            background: #f8fcff;
            border-radius: 24px;
            padding: 24px 20px;
            text-align: center;
            border: 1px solid #e2edf7;
            transition: 0.2s;
        }
        .stat-card i {
            font-size: 2rem;
            color: #2c7da0;
            margin-bottom: 12px;
        }
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #0b2b44;
        }
        .stat-label {
            font-size: 0.9rem;
            color: #4a6f8a;
        }

        /* filters */
        .filter-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }
        .filter-group {
            display: flex;
            gap: 12px;
            align-items: center;
        }
        .filter-group select, .filter-group input {
            padding: 10px 16px;
            border-radius: 40px;
            border: 1px solid #cbdde9;
            background: white;
            font-family: 'Inter', sans-serif;
        }
        .btn {
            border: none;
            padding: 10px 20px;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-primary {
            background: linear-gradient(105deg, #0b2b44, #1b6b8f);
            color: white;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
        }
        .btn-outline {
            border: 1px solid #2c7da0;
            background: white;
            color: #1e4a6b;
        }

        /* table */
        .table-wrapper {
            overflow-x: auto;
            border-radius: 20px;
            border: 1px solid #e2edf7;
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
            vertical-align: middle;
        }
        .status-paid {
            background: #e6f4ea;
            color: #2e7d32;
            padding: 4px 12px;
            border-radius: 30px;
            font-weight: 600;
            display: inline-block;
        }
        .status-unpaid {
            background: #fff0f0;
            color: #c0392b;
            padding: 4px 12px;
            border-radius: 30px;
            font-weight: 600;
            display: inline-block;
        }
        .action-icons i {
            font-size: 1.2rem;
            margin: 0 6px;
            cursor: pointer;
            padding: 6px;
            border-radius: 30px;
            transition: 0.1s;
        }
        .action-icons .fa-check-circle {
            color: #2e7d32;
        }
        .action-icons .fa-edit {
            color: #2c7da0;
        }
        .action-icons i:hover {
            background: #eef2ff;
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
        .modal.active {
            display: flex;
        }
        .modal-content {
            background: white;
            max-width: 500px;
            width: 90%;
            border-radius: 32px;
            padding: 28px;
        }
        .modal-content h3 {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: 600;
            display: block;
            margin-bottom: 6px;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 12px;
            border-radius: 16px;
            border: 1px solid #cbdde9;
        }
        .modal-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
        }

        @media (max-width: 700px) {
            .main-content { padding: 20px; }
            .filter-bar { flex-direction: column; align-items: stretch; }
        }
    </style>
</head>
<body>
<div class="dashboard-container">
    <div class="top-bar">
        <div class="logo-area">
            <h1><i class="fas fa-chalkboard-user"></i> T&T School</h1>
            <p>Admin – Fee Payment Overview</p>
        </div>
        <div class="admin-badge">
            <i class="fas fa-user-shield"></i>
            <span>Admin: Said Umar</span>
        </div>
    </div>

    <div class="main-content">
        <!-- stats -->
        <div class="stats-grid" id="statsGrid"></div>

        <!-- filter and actions -->
        <div class="filter-bar">
            <div class="filter-group">
                <label><i class="fas fa-filter"></i> Show:</label>
                <select id="filterStatus">
                    <option value="all">All Students</option>
                    <option value="paid">Paid Only</option>
                    <option value="unpaid">Unpaid Only</option>
                </select>
                <input type="text" id="searchInput" placeholder="Search name or ID" style="width: 200px;">
            </div>
            <div>
                <button class="btn btn-primary" id="addPaymentBtn"><i class="fas fa-plus-circle"></i> Add Payment Record</button>
                <button class="btn btn-outline" id="refreshBtn"><i class="fas fa-sync-alt"></i> Refresh</button>
            </div>
        </div>

        <!-- student table -->
        <div class="table-wrapper">
            <table class="payments-table" id="studentTable">
                <thead>
                    <tr><th>Student ID</th><th>Student Name</th><th>Class</th><th>Amount Paid (₦)</th><th>Payment Date</th><th>Status</th><th>Actions</th></tr>
                </thead>
                <tbody id="tableBody"></tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for adding/editing payment -->
<div id="paymentModal" class="modal">
    <div class="modal-content">
        <h3 id="modalTitle"><i class="fas fa-credit-card"></i> Record Payment</h3>
        <input type="hidden" id="editStudentId">
        <div class="form-group">
            <label>Student Name *</label>
            <input type="text" id="modalStudentName" placeholder="Full name">
        </div>
        <div class="form-group">
            <label>Student ID *</label>
            <input type="text" id="modalStudentId" placeholder="e.g. STU-001">
        </div>
        <div class="form-group">
            <label>Class *</label>
            <input type="text" id="modalClass" placeholder="Grade 10A">
        </div>
        <div class="form-group">
            <label>Amount Paid (₦) *</label>
            <input type="number" id="modalAmount" placeholder="0" min="0">
        </div>
        <div class="form-group">
            <label>Payment Date *</label>
            <input type="date" id="modalDate">
        </div>
        <div class="modal-buttons">
            <button class="btn btn-outline" id="closeModalBtn">Cancel</button>
            <button class="btn btn-primary" id="savePaymentBtn">Save Payment</button>
        </div>
    </div>
</div>

<script>
    // ---------- STORAGE ----------
    const STORAGE_KEY = 'tt_fee_payments';
    let students = []; // each: { id, studentId, name, class, amount, date, status }

    // load initial demo data if empty
    function loadData() {
        const stored = localStorage.getItem(STORAGE_KEY);
        if(stored) {
            students = JSON.parse(stored);
        } else {
            // sample students (some paid, some unpaid)
            students = [
                { id: 1, studentId: "STU-001", name: "Michael Johnson", class: "Grade 10A", amount: 150000, date: "2025-03-10", status: "paid" },
                { id: 2, studentId: "STU-002", name: "Sarah Williams", class: "Grade 10A", amount: 150000, date: "2025-03-12", status: "paid" },
                { id: 3, studentId: "STU-003", name: "James Wilson", class: "Grade 11B", amount: 0, date: "", status: "unpaid" },
                { id: 4, studentId: "STU-004", name: "Emily Davis", class: "Grade 9C", amount: 150000, date: "2025-03-05", status: "paid" },
                { id: 5, studentId: "STU-005", name: "David Chen", class: "Grade 12A", amount: 0, date: "", status: "unpaid" },
                { id: 6, studentId: "STU-006", name: "Olivia Martinez", class: "Grade 10B", amount: 75000, date: "2025-03-01", status: "partial" },
                { id: 7, studentId: "STU-007", name: "Robert Brown", class: "Grade 11A", amount: 150000, date: "2025-03-14", status: "paid" }
            ];
            persist();
        }
        renderAll();
    }

    function persist() {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(students));
    }

    // compute stats
    function updateStats() {
        const total = students.length;
        const paidCount = students.filter(s => s.status === 'paid').length;
        const unpaidCount = students.filter(s => s.status === 'unpaid').length;
        const partialCount = students.filter(s => s.status === 'partial').length;
        const totalCollected = students.reduce((sum, s) => sum + (s.amount || 0), 0);
        document.getElementById('statsGrid').innerHTML = `
            <div class="stat-card"><i class="fas fa-users"></i><div class="stat-number">${total}</div><div class="stat-label">Total Students</div></div>
            <div class="stat-card"><i class="fas fa-check-circle"></i><div class="stat-number">${paidCount}</div><div class="stat-label">Fully Paid</div></div>
            <div class="stat-card"><i class="fas fa-clock"></i><div class="stat-number">${unpaidCount}</div><div class="stat-label">Unpaid</div></div>
            <div class="stat-card"><i class="fas fa-chart-line"></i><div class="stat-number">₦${totalCollected.toLocaleString()}</div><div class="stat-label">Total Collected</div></div>
        `;
    }

    function renderTable(filterStatus = 'all', searchTerm = '') {
        let filtered = [...students];
        if(filterStatus === 'paid') filtered = filtered.filter(s => s.status === 'paid');
        else if(filterStatus === 'unpaid') filtered = filtered.filter(s => s.status === 'unpaid');
        
        if(searchTerm) {
            const term = searchTerm.toLowerCase();
            filtered = filtered.filter(s => s.name.toLowerCase().includes(term) || s.studentId.toLowerCase().includes(term));
        }

        const tbody = document.getElementById('tableBody');
        if(filtered.length === 0) {
            tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;">No students found</td></tr>';
            return;
        }

        let html = '';
        filtered.forEach(student => {
            const statusClass = student.status === 'paid' ? 'status-paid' : (student.status === 'partial' ? 'status-paid' : 'status-unpaid');
            const statusText = student.status === 'paid' ? 'Paid' : (student.status === 'partial' ? 'Partial' : 'Unpaid');
            const amountDisplay = student.amount ? `₦${student.amount.toLocaleString()}` : '—';
            const dateDisplay = student.date || '—';
            html += `
                <tr>
                    <td>${student.studentId}</td>
                    <td>${student.name}</td>
                    <td>${student.class}</td>
                    <td>${amountDisplay}</td>
                    <td>${dateDisplay}</td>
                    <td><span class="${statusClass}">${statusText}</span></td>
                    <td class="action-icons">
                        <i class="fas fa-check-circle" title="Mark as Paid" data-id="${student.id}" data-action="markPaid"></i>
                        <i class="fas fa-edit" title="Edit Payment" data-id="${student.id}" data-action="edit"></i>
                    </td>
                </tr>
            `;
        });
        tbody.innerHTML = html;
        updateStats();
    }

    function renderAll() {
        const filter = document.getElementById('filterStatus').value;
        const search = document.getElementById('searchInput').value;
        renderTable(filter, search);
    }

    // mark as paid (full amount)
    function markAsPaid(studentId) {
        const student = students.find(s => s.id === studentId);
        if(student) {
            student.status = 'paid';
            if(!student.amount) student.amount = 150000; // default full fee
            if(!student.date) student.date = new Date().toISOString().slice(0,10);
            persist();
            renderAll();
            alert(`${student.name} marked as PAID.`);
        }
    }

    // edit / add payment modal
    let currentEditId = null;
    function openModal(editId = null) {
        const modal = document.getElementById('paymentModal');
        document.getElementById('modalTitle').innerHTML = editId ? '<i class="fas fa-edit"></i> Edit Payment' : '<i class="fas fa-plus-circle"></i> Add New Payment';
        if(editId) {
            const student = students.find(s => s.id === editId);
            if(student) {
                document.getElementById('editStudentId').value = student.id;
                document.getElementById('modalStudentName').value = student.name;
                document.getElementById('modalStudentId').value = student.studentId;
                document.getElementById('modalClass').value = student.class;
                document.getElementById('modalAmount').value = student.amount || '';
                document.getElementById('modalDate').value = student.date || new Date().toISOString().slice(0,10);
                currentEditId = editId;
            }
        } else {
            // reset form
            document.getElementById('editStudentId').value = '';
            document.getElementById('modalStudentName').value = '';
            document.getElementById('modalStudentId').value = '';
            document.getElementById('modalClass').value = '';
            document.getElementById('modalAmount').value = '';
            document.getElementById('modalDate').value = new Date().toISOString().slice(0,10);
            currentEditId = null;
        }
        modal.classList.add('active');
    }

    function closeModal() {
        document.getElementById('paymentModal').classList.remove('active');
        currentEditId = null;
    }

    function savePaymentFromModal() {
        const name = document.getElementById('modalStudentName').value.trim();
        const studentId = document.getElementById('modalStudentId').value.trim();
        const className = document.getElementById('modalClass').value.trim();
        let amount = parseFloat(document.getElementById('modalAmount').value);
        const date = document.getElementById('modalDate').value;
        if(!name || !studentId || !className || isNaN(amount) || amount < 0) {
            alert("Please fill all fields correctly (amount must be numeric).");
            return;
        }
        const status = amount >= 150000 ? 'paid' : (amount > 0 ? 'partial' : 'unpaid'); // assuming full fee 150k
        if(currentEditId) {
            // update existing
            const idx = students.findIndex(s => s.id === currentEditId);
            if(idx !== -1) {
                students[idx] = { ...students[idx], name, studentId, class: className, amount, date, status };
                persist();
            }
        } else {
            // add new student record
            const newId = Date.now();
            students.push({ id: newId, studentId, name, class: className, amount, date, status });
            persist();
        }
        closeModal();
        renderAll();
    }

    // event listeners
    function bindEvents() {
        document.getElementById('filterStatus').addEventListener('change', () => renderAll());
        document.getElementById('searchInput').addEventListener('input', () => renderAll());
        document.getElementById('refreshBtn').addEventListener('click', () => renderAll());
        document.getElementById('addPaymentBtn').addEventListener('click', () => openModal());
        document.getElementById('closeModalBtn').addEventListener('click', closeModal);
        document.getElementById('savePaymentBtn').addEventListener('click', savePaymentFromModal);
        
        document.getElementById('tableBody').addEventListener('click', (e) => {
            const target = e.target;
            const action = target.getAttribute('data-action');
            const id = parseInt(target.getAttribute('data-id'));
            if(action === 'markPaid') markAsPaid(id);
            if(action === 'edit') openModal(id);
        });
        // close modal on outside click
        window.onclick = (e) => { if(e.target === document.getElementById('paymentModal')) closeModal(); };
    }

    loadData();
    bindEvents();
</script>
</body>
</html>