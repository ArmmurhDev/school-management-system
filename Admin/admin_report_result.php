<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>T&T School | Result Approval Dashboard</title>
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

        .approval-container {
            max-width: 1400px;
            margin: 0 auto;
            background: var(--white);
            border-radius: 42px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        /* header */
        .approval-header {
            background: linear-gradient(115deg, var(--primary-dark) 0%, var(--primary-medium) 100%);
            padding: 32px 42px;
            position: relative;
        }

        .approval-header::after {
            content: "✓";
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

        .academic-badge {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(6px);
            border-radius: 60px;
            padding: 8px 24px;
            font-weight: 500;
        }

        /* stats row */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 24px;
            padding: 32px 42px 0 42px;
        }

        .stat-card {
            background: var(--white);
            border-radius: 28px;
            padding: 20px 24px;
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
            font-size: 0.75rem;
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

        /* filter and class list */
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
            min-width: 200px;
        }

        .filter-group label {
            display: block;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--primary-medium);
            margin-bottom: 6px;
        }

        .filter-group select, .filter-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid rgba(77, 143, 204, 0.3);
            border-radius: 60px;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            background: var(--white);
            transition: 0.2s;
        }

        .filter-group select:focus, .filter-group input:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(77, 143, 204, 0.2);
        }

        /* class cards grid */
        .classes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 28px;
            padding: 32px 42px;
        }

        .class-card {
            background: var(--white);
            border-radius: 28px;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(77, 143, 204, 0.2);
            overflow: hidden;
            transition: all 0.25s;
        }

        .class-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-light);
        }

        .card-header {
            background: var(--light-bg);
            padding: 20px 24px;
            border-bottom: 1px solid rgba(77, 143, 204, 0.2);
        }

        .class-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 4px;
        }

        .teacher-info {
            font-size: 0.85rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
        }

        .card-body {
            padding: 20px 24px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 0.85rem;
        }

        .detail-label {
            font-weight: 600;
            color: var(--text-soft);
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 700;
        }

        .status-pending {
            background: #fff0db;
            color: var(--warning);
        }

        .status-approved {
            background: var(--success-light);
            color: var(--success);
        }

        .status-rejected {
            background: #ffe6e2;
            color: var(--danger);
        }

        .card-actions {
            padding: 16px 24px 24px;
            border-top: 1px solid rgba(77, 143, 204, 0.1);
            display: flex;
            gap: 12px;
        }

        .btn-approve {
            background: linear-gradient(95deg, var(--success), #3e9b4a);
            border: none;
            padding: 10px 0;
            border-radius: 60px;
            font-weight: 600;
            font-size: 0.8rem;
            color: white;
            cursor: pointer;
            transition: 0.2s;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-reject {
            background: transparent;
            border: 1.5px solid var(--danger);
            padding: 10px 0;
            border-radius: 60px;
            font-weight: 600;
            font-size: 0.8rem;
            color: var(--danger);
            cursor: pointer;
            transition: 0.2s;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-approve:hover {
            transform: scale(0.97);
            background: linear-gradient(95deg, #236b30, #2e7d3a);
        }

        .btn-reject:hover {
            background: #fff0ee;
            border-color: #a0351c;
        }

        .approval-meta {
            font-size: 0.7rem;
            color: var(--text-muted);
            text-align: center;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px dashed rgba(77, 143, 204, 0.2);
        }

        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px;
            color: var(--text-muted);
            background: var(--light-bg);
            border-radius: 28px;
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
            .approval-header { padding: 24px 24px; }
            .stats-grid { padding: 24px 24px 0 24px; gap: 16px; }
            .filter-bar { padding: 20px 24px; flex-direction: column; align-items: stretch; }
            .classes-grid { padding: 24px 24px; gap: 20px; }
        }

        @media (max-width: 480px) {
            .card-actions { flex-direction: column; }
            .btn-approve, .btn-reject { width: 100%; }
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

<div class="approval-container">
    <div class="approval-header">
        <div class="admin-row">
            <div class="title-section">
                <h1><i class="fas fa-clipboard-list"></i> Result Approval Panel</h1>
                <p><i class="fas fa-user-check"></i> Admin · Dr. Michael Adebayo · Approve teacher-submitted reports</p>
            </div>
            <div class="academic-badge">
                <i class="fas fa-calendar-alt"></i> Spring 2025 · Mid-Term Results
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid" id="statsGrid">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-chalkboard"></i></div>
            <h3>Total Classes</h3>
            <div class="stat-number" id="totalClasses">0</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-hourglass-half"></i></div>
            <h3>Pending Approval</h3>
            <div class="stat-number" id="pendingCount">0</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
            <h3>Approved</h3>
            <div class="stat-number" id="approvedCount">0</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-times-circle"></i></div>
            <h3>Rejected</h3>
            <div class="stat-number" id="rejectedCount">0</div>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="filter-bar">
        <div class="filter-group">
            <label><i class="fas fa-search"></i> Search Class / Teacher</label>
            <input type="text" id="searchInput" placeholder="Class name or teacher...">
        </div>
        <div class="filter-group">
            <label><i class="fas fa-filter"></i> Approval Status</label>
            <select id="statusFilter">
                <option value="all">All</option>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
            </select>
        </div>
        <div class="filter-group">
            <label>&nbsp;</label>
            <button class="reset-btn" id="resetFilters" style="background: var(--light-bg); border: 1px solid var(--primary-light); padding: 10px 24px; border-radius: 60px; font-weight: 600; color: var(--primary-medium); cursor: pointer;">Reset Filters</button>
        </div>
    </div>

    <!-- Classes Grid -->
    <div id="classesContainer" class="classes-grid">
        <!-- dynamic cards -->
    </div>

    <footer>
        <p><i class="fas fa-check-double"></i> Final approval publishes results to student portal</p>
        <p style="font-size: 0.7rem;">T&T School · Academic Integrity</p>
    </footer>
</div>

<div id="toastMsg" class="toast"></div>

<script>
    // ---------- MOCK DATA: CLASSES WITH TEACHERS AND SUBMITTED RESULTS ----------
    const classesData = [
        { id: "CS210", className: "Data Structures", teacher: "Prof. Sophia Lin", submittedDate: "2025-03-20", totalStudents: 28, avgScore: 82.5, status: "pending" },
        { id: "MATH205", className: "Calculus II", teacher: "Dr. James Carter", submittedDate: "2025-03-19", totalStudents: 32, avgScore: 76.8, status: "pending" },
        { id: "ENG210", className: "Academic Writing", teacher: "Prof. Maya Gupta", submittedDate: "2025-03-18", totalStudents: 25, avgScore: 88.2, status: "pending" },
        { id: "PHYS101", className: "Physics: Mechanics", teacher: "Dr. Oliver Chen", submittedDate: "2025-03-21", totalStudents: 30, avgScore: 79.4, status: "pending" },
        { id: "ART250", className: "Digital Design", teacher: "Elena Vasquez", submittedDate: "2025-03-17", totalStudents: 22, avgScore: 91.3, status: "pending" },
        { id: "DATA300", className: "Data Science Intro", teacher: "Dr. Anika Sharma", submittedDate: "2025-03-22", totalStudents: 27, avgScore: 85.1, status: "pending" }
    ];

    // Storage key for approvals
    const STORAGE_KEY = "tt_result_approvals";

    // Load approval state from localStorage
    let approvals = {};

    function loadApprovals() {
        const stored = localStorage.getItem(STORAGE_KEY);
        if (stored) {
            try {
                approvals = JSON.parse(stored);
            } catch(e) { approvals = {}; }
        } else {
            approvals = {};
            // Initialize with pending for all classes
            classesData.forEach(cls => {
                approvals[cls.id] = { status: cls.status, approvedBy: null, approvedAt: null, comments: "" };
            });
            saveApprovals();
        }
    }

    function saveApprovals() {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(approvals));
    }

    // Update class status in approval store
    function updateApproval(classId, newStatus, comments = "") {
        approvals[classId] = {
            status: newStatus,
            approvedBy: newStatus === "approved" ? "Dr. Michael Adebayo" : (newStatus === "rejected" ? "Admin Review" : null),
            approvedAt: new Date().toISOString(),
            comments: comments
        };
        saveApprovals();
    }

    // Helper: format date
    function formatDate(dateStr) {
        if (!dateStr) return "—";
        const date = new Date(dateStr);
        return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
    }

    // Show toast
    function showToast(message, isError = false) {
        const toast = document.getElementById('toastMsg');
        toast.textContent = message;
        toast.style.backgroundColor = isError ? '#c23b22' : '#00509E';
        toast.classList.add('show');
        setTimeout(() => {
            toast.classList.remove('show');
        }, 2800);
    }

    // Render classes based on filters
    let currentFilters = { search: '', status: 'all' };

    function renderClasses() {
        const container = document.getElementById('classesContainer');
        if (!container) return;

        // Filter data
        let filtered = [...classesData];
        
        // Search filter
        if (currentFilters.search.trim()) {
            const term = currentFilters.search.toLowerCase();
            filtered = filtered.filter(cls => 
                cls.className.toLowerCase().includes(term) || 
                cls.teacher.toLowerCase().includes(term) ||
                cls.id.toLowerCase().includes(term)
            );
        }
        
        // Status filter
        if (currentFilters.status !== 'all') {
            filtered = filtered.filter(cls => {
                const approvalStatus = approvals[cls.id]?.status || 'pending';
                return approvalStatus === currentFilters.status;
            });
        }
        
        // Update stats (based on full dataset)
        const total = classesData.length;
        const pendingTotal = classesData.filter(c => (approvals[c.id]?.status || 'pending') === 'pending').length;
        const approvedTotal = classesData.filter(c => (approvals[c.id]?.status) === 'approved').length;
        const rejectedTotal = classesData.filter(c => (approvals[c.id]?.status) === 'rejected').length;
        
        document.getElementById('totalClasses').innerText = total;
        document.getElementById('pendingCount').innerText = pendingTotal;
        document.getElementById('approvedCount').innerText = approvedTotal;
        document.getElementById('rejectedCount').innerText = rejectedTotal;
        
        if (filtered.length === 0) {
            container.innerHTML = `<div class="empty-state"><i class="fas fa-search"></i> No classes match your filters</div>`;
            return;
        }
        
        let cardsHtml = '';
        filtered.forEach(cls => {
            const approval = approvals[cls.id] || { status: 'pending', approvedAt: null };
            const currentStatus = approval.status;
            
            let statusClass = '';
            let statusText = '';
            let statusIcon = '';
            
            if (currentStatus === 'pending') {
                statusClass = 'status-pending';
                statusText = 'Pending Approval';
                statusIcon = '<i class="fas fa-hourglass-half"></i>';
            } else if (currentStatus === 'approved') {
                statusClass = 'status-approved';
                statusText = 'Approved';
                statusIcon = '<i class="fas fa-check-circle"></i>';
            } else {
                statusClass = 'status-rejected';
                statusText = 'Rejected';
                statusIcon = '<i class="fas fa-times-circle"></i>';
            }
            
            const approvalInfo = approval.approvedAt ? `<div class="approval-meta"><i class="far fa-calendar-check"></i> ${currentStatus === 'approved' ? 'Approved' : 'Reviewed'} on ${formatDate(approval.approvedAt)} by ${approval.approvedBy || 'Admin'}</div>` : '';
            
            cardsHtml += `
                <div class="class-card" data-id="${cls.id}">
                    <div class="card-header">
                        <div class="class-title">${escapeHtml(cls.className)} (${cls.id})</div>
                        <div class="teacher-info"><i class="fas fa-chalkboard-user"></i> ${escapeHtml(cls.teacher)}</div>
                    </div>
                    <div class="card-body">
                        <div class="detail-row">
                            <span class="detail-label">📅 Submitted</span>
                            <span>${formatDate(cls.submittedDate)}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">👩‍🎓 Students</span>
                            <span>${cls.totalStudents}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">📊 Avg. Score</span>
                            <span>${cls.avgScore}%</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">📋 Status</span>
                            <span class="status-badge ${statusClass}">${statusIcon} ${statusText}</span>
                        </div>
                        ${approvalInfo}
                    </div>
                    <div class="card-actions">
                        <button class="btn-approve" data-id="${cls.id}" data-status="approved" ${currentStatus === 'approved' ? 'disabled' : ''}>
                            <i class="fas fa-check"></i> Approve Results
                        </button>
                        <button class="btn-reject" data-id="${cls.id}" data-status="rejected" ${currentStatus === 'rejected' ? 'disabled' : ''}>
                            <i class="fas fa-ban"></i> Reject
                        </button>
                    </div>
                </div>
            `;
        });
        container.innerHTML = cardsHtml;
        
        // Attach event listeners
        document.querySelectorAll('.btn-approve').forEach(btn => {
            if (!btn.disabled) {
                btn.addEventListener('click', (e) => {
                    const classId = btn.getAttribute('data-id');
                    approveClass(classId);
                });
            }
        });
        
        document.querySelectorAll('.btn-reject').forEach(btn => {
            if (!btn.disabled) {
                btn.addEventListener('click', (e) => {
                    const classId = btn.getAttribute('data-id');
                    rejectClass(classId);
                });
            }
        });
    }
    
    function approveClass(classId) {
        const cls = classesData.find(c => c.id === classId);
        if (!cls) return;
        
        // Simulate approval with optional comment (simple prompt)
        let comments = prompt("Add an approval note (optional):", "Approved by admin");
        if (comments === null) return; // cancelled
        
        updateApproval(classId, "approved", comments || "Approved by administrator");
        showToast(`✅ Results for ${cls.className} have been approved.`, false);
        renderClasses();
    }
    
    function rejectClass(classId) {
        const cls = classesData.find(c => c.id === classId);
        if (!cls) return;
        
        let reason = prompt("Please provide a reason for rejection:", "Needs revision");
        if (reason === null) return;
        
        updateApproval(classId, "rejected", reason || "Rejected by admin");
        showToast(`❌ Results for ${cls.className} have been rejected. Teacher notified.`, false);
        renderClasses();
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
    
    // Setup filters
    function setupFilters() {
        const searchInput = document.getElementById('searchInput');
        const statusFilter = document.getElementById('statusFilter');
        const resetBtn = document.getElementById('resetFilters');
        
        searchInput.addEventListener('input', (e) => {
            currentFilters.search = e.target.value;
            renderClasses();
        });
        
        statusFilter.addEventListener('change', (e) => {
            currentFilters.status = e.target.value;
            renderClasses();
        });
        
        resetBtn.addEventListener('click', () => {
            searchInput.value = '';
            statusFilter.value = 'all';
            currentFilters = { search: '', status: 'all' };
            renderClasses();
            showToast("Filters cleared", false);
        });
    }
    
    // Initialize
    function init() {
        loadApprovals();
        setupFilters();
        renderClasses();
    }
    
    init();
</script>
</body>
</html>