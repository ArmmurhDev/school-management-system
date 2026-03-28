<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>T&T School | Fee Management Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-dark: #003366;
            --primary-deep: #00264d;
            --primary-medium: #00509E;
            --primary-soft: #1a6fb0;
            --primary-light: #4D8FCC;
            --light-bg: #F0F8FF;
            --white: #FFFFFF;
            --text-dark: #1A2C3E;
            --text-soft: #2c3e50;
            --text-muted: #5a6e7c;
            --shadow-sm: 0 8px 20px rgba(0, 51, 102, 0.08);
            --shadow-md: 0 12px 28px rgba(0, 51, 102, 0.12);
            --success: #2b7e3a;
            --success-light: #e0f5e3;
            --warning: #e67e22;
            --danger: #c23b22;
            --border-radius-card: 28px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(145deg, #eef5fc 0%, #e2edf7 100%);
            color: var(--text-dark);
            line-height: 1.5;
            padding: 28px 20px;
            min-height: 100vh;
        }

        .fee-container {
            max-width: 1440px;
            margin: 0 auto;
            background: var(--white);
            border-radius: 42px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        /* header */
        .fee-header {
            background: linear-gradient(115deg, var(--primary-dark) 0%, var(--primary-medium) 100%);
            padding: 32px 42px;
            position: relative;
        }

        .fee-header::after {
            content: "💰";
            font-size: 130px;
            opacity: 0.08;
            position: absolute;
            bottom: -20px;
            right: 20px;
            pointer-events: none;
        }

        .admin-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .title-section h1 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: white;
            letter-spacing: -0.3px;
            margin-bottom: 8px;
        }

        .title-section p {
            color: rgba(255,255,255,0.85);
            font-size: 0.9rem;
        }

        .semester-badge {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(6px);
            border-radius: 60px;
            padding: 8px 24px;
            font-weight: 500;
        }

        /* stats row */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 24px;
            padding: 32px 42px 0 42px;
        }

        .stat-card {
            background: var(--white);
            border-radius: 28px;
            padding: 22px 24px;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(77, 143, 204, 0.2);
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            background: var(--light-bg);
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            color: var(--primary-medium);
            font-size: 1.3rem;
        }

        .stat-card h3 {
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary-dark);
        }

        .stat-sub {
            font-size: 0.7rem;
            color: var(--text-muted);
            margin-top: 6px;
        }

        /* filter bar */
        .filter-bar {
            padding: 24px 42px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: flex-end;
            border-bottom: 1px solid rgba(77, 143, 204, 0.2);
        }

        .filter-group {
            flex: 1;
            min-width: 180px;
        }

        .filter-group label {
            display: block;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--primary-medium);
            margin-bottom: 6px;
        }

        .filter-group input, .filter-group select {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid rgba(77, 143, 204, 0.3);
            border-radius: 60px;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            background: var(--white);
            transition: 0.2s;
        }

        .filter-group input:focus, .filter-group select:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(77, 143, 204, 0.2);
        }

        .reset-btn {
            background: var(--light-bg);
            border: 1px solid var(--primary-light);
            padding: 10px 24px;
            border-radius: 60px;
            font-weight: 600;
            color: var(--primary-medium);
            cursor: pointer;
            transition: 0.2s;
        }

        .reset-btn:hover {
            background: var(--primary-light);
            color: white;
        }

        /* table */
        .table-wrapper {
            margin: 24px 42px 42px 42px;
            overflow-x: auto;
            border-radius: 28px;
            background: var(--white);
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(0, 81, 158, 0.1);
        }

        .fee-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
            min-width: 800px;
        }

        .fee-table th {
            background: var(--light-bg);
            padding: 18px 16px;
            text-align: left;
            font-weight: 700;
            color: var(--primary-dark);
            border-bottom: 2px solid rgba(77, 143, 204, 0.3);
        }

        .fee-table td {
            padding: 14px 16px;
            border-bottom: 1px solid rgba(0, 81, 158, 0.08);
            color: var(--text-soft);
        }

        .fee-table tr:last-child td {
            border-bottom: none;
        }

        .status-paid {
            background: var(--success-light);
            color: var(--success);
            padding: 4px 12px;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 700;
            display: inline-block;
        }

        .status-unpaid {
            background: #ffe6e2;
            color: var(--danger);
            padding: 4px 12px;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 700;
            display: inline-block;
        }

        .empty-state {
            text-align: center;
            padding: 60px 24px;
            color: var(--text-muted);
            background: var(--light-bg);
            border-radius: 28px;
            margin: 20px 42px;
        }

        footer {
            background: var(--primary-dark);
            padding: 24px 42px;
            text-align: center;
            color: #bcd0e6;
            font-size: 0.8rem;
        }

        @media (max-width: 780px) {
            body { padding: 16px; }
            .fee-header { padding: 24px 24px; }
            .stats-grid { padding: 24px 24px 0 24px; gap: 16px; }
            .filter-bar { padding: 20px 24px; flex-direction: column; align-items: stretch; }
            .table-wrapper { margin: 20px 24px 32px 24px; }
            .empty-state { margin: 20px 24px; }
        }

        @media (max-width: 480px) {
            .stat-card { padding: 16px; }
            .stat-number { font-size: 1.6rem; }
        }

        .toast {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--primary-dark);
            color: white;
            padding: 12px 28px;
            border-radius: 60px;
            font-weight: 500;
            z-index: 1000;
            font-size: 0.9rem;
            pointer-events: none;
            transition: 0.2s;
            opacity: 0;
        }
        .toast.show { opacity: 1; bottom: 40px; }
    </style>
</head>
<body>

<div class="fee-container">
    <div class="fee-header">
        <div class="admin-row">
            <div class="title-section">
                <h1><i class="fas fa-coins"></i> Fee Management</h1>
                <p><i class="fas fa-user-shield"></i> Admin · Finance Dashboard · Spring 2025 Semester</p>
            </div>
            <div class="semester-badge">
                <i class="fas fa-calendar-alt"></i> Academic Year 2024-2025
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid" id="statsGrid">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-users"></i></div>
            <h3>Total Students</h3>
            <div class="stat-number" id="totalStudents">0</div>
            <div class="stat-sub">Enrolled this semester</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
            <h3>Fees Paid</h3>
            <div class="stat-number" id="paidCount">0</div>
            <div class="stat-sub">Students fully paid</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-hourglass-half"></i></div>
            <h3>Pending</h3>
            <div class="stat-number" id="pendingCount">0</div>
            <div class="stat-sub">Outstanding balance</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
            <h3>Total Collected</h3>
            <div class="stat-number" id="totalAmount">$0</div>
            <div class="stat-sub">All transactions</div>
        </div>
    </div>

    <!-- Filter Controls -->
    <div class="filter-bar">
        <div class="filter-group">
            <label><i class="fas fa-search"></i> Search Student</label>
            <input type="text" id="searchInput" placeholder="Name or Student ID...">
        </div>
        <div class="filter-group">
            <label><i class="fas fa-filter"></i> Payment Status</label>
            <select id="statusFilter">
                <option value="all">All Students</option>
                <option value="paid">Paid</option>
                <option value="unpaid">Unpaid</option>
            </select>
        </div>
        <div class="filter-group">
            <label>&nbsp;</label>
            <button class="reset-btn" id="resetFilters"><i class="fas fa-sync-alt"></i> Reset</button>
        </div>
    </div>

    <!-- Fee Table -->
    <div id="tableContainer">
        <div class="table-wrapper">
            <table class="fee-table">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Total Fee</th>
                        <th>Amount Paid</th>
                        <th>Balance</th>
                        <th>Status</th>
                        <th>Last Transaction</th>
                    </tr>
                </thead>
                <tbody id="feeTableBody">
                    <tr><td colspan="7" style="text-align: center;">Loading...</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <footer>
        <p><i class="fas fa-file-invoice-dollar"></i> All financial records are securely stored | T&T School Administration</p>
        <p style="font-size: 0.7rem;">Last updated: <span id="lastUpdated"></span></p>
    </footer>
</div>

<div id="toastMsg" class="toast"></div>

<script>
    // ---------- MOCK DATA ----------
    // Student fee records with payment history
    const studentsData = [
        { id: "STU-1001", name: "Olivia Chen", totalFee: 2500, paid: 2500, lastTransaction: "2025-03-15", transactionId: "TXN-001" },
        { id: "STU-1002", name: "Liam Rodriguez", totalFee: 2500, paid: 1500, lastTransaction: "2025-02-28", transactionId: "TXN-002" },
        { id: "STU-1003", name: "Emma Thompson", totalFee: 2500, paid: 0, lastTransaction: null, transactionId: null },
        { id: "STU-1004", name: "Noah Williams", totalFee: 2500, paid: 2500, lastTransaction: "2025-03-10", transactionId: "TXN-003" },
        { id: "STU-1005", name: "Ava Johnson", totalFee: 2500, paid: 2000, lastTransaction: "2025-03-05", transactionId: "TXN-004" },
        { id: "STU-1006", name: "Mason Brown", totalFee: 2500, paid: 2500, lastTransaction: "2025-02-20", transactionId: "TXN-005" },
        { id: "STU-1007", name: "Sophia Davis", totalFee: 2500, paid: 500, lastTransaction: "2025-03-01", transactionId: "TXN-006" },
        { id: "STU-1008", name: "Ethan Miller", totalFee: 2500, paid: 2500, lastTransaction: "2025-03-12", transactionId: "TXN-007" },
        { id: "STU-1009", name: "Isabella Wilson", totalFee: 2500, paid: 2500, lastTransaction: "2025-03-08", transactionId: "TXN-008" },
        { id: "STU-1010", name: "James Martinez", totalFee: 2500, paid: 0, lastTransaction: null, transactionId: null }
    ];

    // Function to format currency
    function formatCurrency(amount) {
        return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD', minimumFractionDigits: 0 }).format(amount);
    }

    // Format date
    function formatDate(dateStr) {
        if (!dateStr) return '—';
        const date = new Date(dateStr);
        return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
    }

    // Calculate summary stats
    function updateStats(students) {
        const total = students.length;
        const paid = students.filter(s => s.paid >= s.totalFee).length;
        const pending = total - paid;
        const totalCollected = students.reduce((sum, s) => sum + s.paid, 0);
        
        document.getElementById('totalStudents').innerText = total;
        document.getElementById('paidCount').innerText = paid;
        document.getElementById('pendingCount').innerText = pending;
        document.getElementById('totalAmount').innerHTML = formatCurrency(totalCollected);
    }

    // Render table with filters
    let currentFilter = { search: '', status: 'all' };

    function renderTable() {
        let filtered = [...studentsData];
        
        // Apply search
        if (currentFilter.search.trim() !== '') {
            const searchTerm = currentFilter.search.toLowerCase();
            filtered = filtered.filter(s => 
                s.name.toLowerCase().includes(searchTerm) || 
                s.id.toLowerCase().includes(searchTerm)
            );
        }
        
        // Apply status filter
        if (currentFilter.status === 'paid') {
            filtered = filtered.filter(s => s.paid >= s.totalFee);
        } else if (currentFilter.status === 'unpaid') {
            filtered = filtered.filter(s => s.paid < s.totalFee);
        }
        
        // Update stats based on filtered data
        updateStats(filtered);
        
        const tbody = document.getElementById('feeTableBody');
        if (!tbody) return;
        
        if (filtered.length === 0) {
            tbody.innerHTML = '<tr><td colspan="7" style="text-align: center; padding: 48px;"><i class="fas fa-search"></i> No students match the filters</td></tr>';
            return;
        }
        
        let rows = '';
        filtered.forEach(student => {
            const balance = student.totalFee - student.paid;
            const isPaid = student.paid >= student.totalFee;
            const statusClass = isPaid ? 'status-paid' : 'status-unpaid';
            const statusText = isPaid ? 'Paid' : 'Unpaid';
            const lastTrans = student.lastTransaction ? `${formatDate(student.lastTransaction)} (${student.transactionId})` : '—';
            
            rows += `
                <tr>
                    <td><strong>${student.id}</strong></td>
                    <td>${escapeHtml(student.name)}</td>
                    <td>${formatCurrency(student.totalFee)}</td>
                    <td>${formatCurrency(student.paid)}</td>
                    <td>${formatCurrency(balance)}</td>
                    <td><span class="${statusClass}"><i class="fas ${isPaid ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i> ${statusText}</span></td>
                    <td>${lastTrans}</td>
                </tr>
            `;
        });
        tbody.innerHTML = rows;
    }

    // Event listeners for filters
    function setupFilters() {
        const searchInput = document.getElementById('searchInput');
        const statusFilter = document.getElementById('statusFilter');
        const resetBtn = document.getElementById('resetFilters');
        
        searchInput.addEventListener('input', (e) => {
            currentFilter.search = e.target.value;
            renderTable();
        });
        
        statusFilter.addEventListener('change', (e) => {
            currentFilter.status = e.target.value;
            renderTable();
        });
        
        resetBtn.addEventListener('click', () => {
            searchInput.value = '';
            statusFilter.value = 'all';
            currentFilter = { search: '', status: 'all' };
            renderTable();
            showToast("Filters reset to show all students", false);
        });
    }
    
    // Helper: escape HTML
    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/[&<>]/g, function(m) {
            if (m === '&') return '&amp;';
            if (m === '<') return '&lt;';
            if (m === '>') return '&gt;';
            return m;
        });
    }
    
    function showToast(message, isError = false) {
        const toast = document.getElementById('toastMsg');
        toast.textContent = message;
        toast.style.backgroundColor = isError ? '#c23b22' : '#00509E';
        toast.classList.add('show');
        setTimeout(() => {
            toast.classList.remove('show');
        }, 2800);
    }
    
    // Set last updated timestamp
    function setLastUpdated() {
        const now = new Date();
        const formatted = now.toLocaleString('en-US', { dateStyle: 'medium', timeStyle: 'short' });
        document.getElementById('lastUpdated').innerText = formatted;
    }
    
    // Initialize
    function init() {
        setLastUpdated();
        renderTable();
        setupFilters();
    }
    
    init();
</script>
</body>
</html>