<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>T&T School | Assignment Hub — Submit & Track</title>
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
            --accent-wave: #7bb3db;
            --light-bg: #F0F8FF;
            --white: #FFFFFF;
            --gray-light: #f8fafd;
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

        .assignment-container {
            max-width: 1400px;
            margin: 0 auto;
            background: var(--white);
            border-radius: 42px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
            transition: all 0.2s;
        }

        /* header */
        .assign-header {
            background: linear-gradient(115deg, var(--primary-dark) 0%, var(--primary-medium) 100%);
            padding: 32px 42px;
            position: relative;
        }

        .assign-header::after {
            content: "📝";
            font-size: 130px;
            opacity: 0.08;
            position: absolute;
            bottom: -20px;
            right: 20px;
            pointer-events: none;
        }

        .student-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .welcome-text h1 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: white;
            letter-spacing: -0.3px;
            margin-bottom: 8px;
        }

        .welcome-text p {
            color: rgba(255,255,255,0.85);
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            font-size: 0.9rem;
        }

        .stats-badge {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(6px);
            border-radius: 60px;
            padding: 10px 24px;
            text-align: center;
        }

        .stats-badge .stat-number {
            font-size: 1.8rem;
            font-weight: 800;
            color: white;
            line-height: 1;
        }

        .stats-badge .stat-label {
            font-size: 0.7rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: rgba(255,255,240,0.8);
        }

        /* main content */
        .assign-content {
            padding: 40px 42px;
        }

        .section-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-title i {
            color: var(--primary-light);
            font-size: 1.7rem;
        }

        .assignments-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 28px;
            margin-bottom: 20px;
        }

        /* assignment card */
        .assignment-card {
            background: var(--white);
            border-radius: 28px;
            box-shadow: var(--shadow-sm);
            transition: all 0.25s ease;
            border: 1px solid rgba(77, 143, 204, 0.2);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .assignment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 30px -12px rgba(0, 51, 102, 0.2);
            border-color: var(--primary-light);
        }

        .card-header {
            padding: 20px 24px 12px;
            border-bottom: 1px solid rgba(0,81,158,0.08);
        }

        .course-badge {
            display: inline-block;
            background: var(--light-bg);
            color: var(--primary-medium);
            font-size: 0.7rem;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 40px;
            margin-bottom: 12px;
        }

        .assignment-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 8px;
        }

        .due-date {
            font-size: 0.8rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 6px;
        }

        .card-details {
            padding: 16px 24px;
            flex: 1;
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

        .points {
            background: var(--light-bg);
            padding: 4px 10px;
            border-radius: 30px;
            font-weight: 600;
            color: var(--primary-dark);
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 40px;
        }

        .status-submitted {
            background: var(--success-light);
            color: var(--success);
        }

        .status-pending {
            background: #fff0db;
            color: var(--warning);
        }

        .card-actions {
            padding: 16px 24px 24px;
            border-top: 1px solid rgba(0,81,158,0.08);
        }

        .file-input-wrapper {
            margin-bottom: 12px;
        }

        .file-label {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--light-bg);
            padding: 10px 14px;
            border-radius: 60px;
            cursor: pointer;
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--primary-medium);
            transition: 0.2s;
            border: 1px dashed var(--primary-light);
        }

        .file-label:hover {
            background: #e3f0fa;
        }

        .file-label i {
            font-size: 1rem;
        }

        input[type="file"] {
            display: none;
        }

        .submit-btn {
            background: linear-gradient(95deg, var(--primary-medium), var(--primary-light));
            border: none;
            width: 100%;
            padding: 12px 0;
            border-radius: 60px;
            font-weight: 700;
            font-size: 0.85rem;
            color: white;
            cursor: pointer;
            transition: 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .submit-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .submit-btn:hover:not(:disabled) {
            background: linear-gradient(95deg, var(--primary-dark), var(--primary-medium));
            transform: scale(0.98);
        }

        .file-name {
            font-size: 0.7rem;
            color: var(--text-muted);
            margin-top: 8px;
            text-align: center;
            word-break: break-all;
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
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            backdrop-filter: blur(8px);
            font-size: 0.9rem;
            pointer-events: none;
            transition: 0.2s;
            opacity: 0;
        }

        .toast.show {
            opacity: 1;
            bottom: 40px;
        }

        footer {
            background: var(--primary-dark);
            padding: 28px 42px;
            text-align: center;
            color: #bcd0e6;
            font-size: 0.8rem;
        }

        @media (max-width: 780px) {
            body { padding: 16px; }
            .assign-header { padding: 24px 24px; }
            .assign-content { padding: 28px 20px; }
            .welcome-text h1 { font-size: 1.6rem; }
            .student-info { flex-direction: column; align-items: flex-start; }
            .assignments-grid { gap: 20px; }
        }

        @media (max-width: 480px) {
            .assignments-grid { grid-template-columns: 1fr; }
            .card-header, .card-details, .card-actions { padding-left: 18px; padding-right: 18px; }
        }

        .resubmit-note {
            font-size: 0.7rem;
            color: var(--primary-light);
            text-align: center;
            margin-top: 8px;
        }
    </style>
</head>
<body>

<div class="assignment-container">
    <div class="assign-header">
        <div class="student-info">
            <div class="welcome-text">
                <h1><i class="fas fa-tasks" style="margin-right: 12px;"></i> Assignment Hub</h1>
                <p><i class="fas fa-user-graduate"></i> Alex Morgan · STU-3412-TT · <i class="far fa-envelope"></i> alex.morgan@ttschool.edu</p>
            </div>
            <div class="stats-badge" id="submissionStats">
                <div class="stat-number" id="submittedCount">0</div>
                <div class="stat-label">submitted / total</div>
            </div>
        </div>
    </div>

    <div class="assign-content">
        <div class="section-title">
            <i class="fas fa-list-check"></i> Current Assignments
        </div>
        <div id="assignmentsGrid" class="assignments-grid">
            <!-- dynamic cards will appear here -->
        </div>
    </div>

    <footer>
        <p><i class="fas fa-cloud-upload-alt"></i> Submit your work as PDF — keep track of deadlines</p>
        <p style="font-size: 0.7rem; margin-top: 6px;">T&T School · every submission is recorded locally</p>
    </footer>
</div>

<div id="toastMessage" class="toast"></div>

<script>
    // ---------- MOCK ASSIGNMENTS DATABASE ----------
    const assignmentsData = [
        { id: "as1", course: "CS 210", title: "Data Structures - Binary Tree Implementation", dueDate: "2025-04-18", points: 100, description: "Implement BST with traversal methods." },
        { id: "as2", course: "MATH 205", title: "Calculus II: Integration Techniques", dueDate: "2025-04-22", points: 85, description: "Solve integrals using substitution and parts." },
        { id: "as3", course: "ENG 210", title: "Research Paper Draft", dueDate: "2025-04-25", points: 120, description: "Submit first draft (min 1500 words)." },
        { id: "as4", course: "PHYS 101", title: "Newton's Laws Lab Report", dueDate: "2025-04-20", points: 75, description: "Include data analysis and conclusions." },
        { id: "as5", course: "ART 250", title: "UI/UX Wireframe Project", dueDate: "2025-04-30", points: 100, description: "Interactive prototype (PDF with explanation)." }
    ];

    // Storage key for submissions
    const STORAGE_KEY = "tt_assignments_submissions";

    // Load submissions from localStorage: { assignmentId: { fileName, submittedAt, status } }
    let submissions = {};

    function loadSubmissions() {
        const stored = localStorage.getItem(STORAGE_KEY);
        if (stored) {
            try {
                submissions = JSON.parse(stored);
            } catch(e) { submissions = {}; }
        } else {
            submissions = {};
        }
    }

    function saveSubmissions() {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(submissions));
    }

    // Helper to show toast
    function showToast(message, isError = false) {
        const toast = document.getElementById('toastMessage');
        toast.textContent = message;
        toast.style.backgroundColor = isError ? '#c23b22' : '#00509E';
        toast.classList.add('show');
        setTimeout(() => {
            toast.classList.remove('show');
        }, 2800);
    }

    // Validate PDF file
    function isValidPDF(file) {
        return file && file.type === 'application/pdf';
    }

    // Submit assignment: update submissions and re-render
    function submitAssignment(assignmentId, file) {
        if (!isValidPDF(file)) {
            showToast("❌ Please select a valid PDF file (only .pdf allowed).", true);
            return false;
        }

        // store submission info
        submissions[assignmentId] = {
            fileName: file.name,
            submittedAt: new Date().toISOString(),
            status: "submitted"
        };
        saveSubmissions();
        showToast(`✅ "${file.name}" submitted successfully!`, false);
        renderAll();
        return true;
    }

    // Remove submission (allow resubmission)
    function removeSubmission(assignmentId) {
        delete submissions[assignmentId];
        saveSubmissions();
        showToast("🔄 Submission removed — you can upload a new PDF.", false);
        renderAll();
    }

    // Render all assignment cards
    function renderAll() {
        const container = document.getElementById('assignmentsGrid');
        if (!container) return;

        let total = assignmentsData.length;
        let submittedTotal = 0;

        let cardsHtml = '';

        assignmentsData.forEach(assign => {
            const isSubmitted = !!submissions[assign.id];
            if (isSubmitted) submittedTotal++;

            const dueDateFormatted = new Date(assign.dueDate).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
            const statusClass = isSubmitted ? 'status-submitted' : 'status-pending';
            const statusText = isSubmitted ? '✓ Submitted' : '⏳ Pending';
            const submittedFile = isSubmitted ? submissions[assign.id].fileName : null;

            // build card
            cardsHtml += `
                <div class="assignment-card" data-id="${assign.id}">
                    <div class="card-header">
                        <span class="course-badge"><i class="fas fa-code"></i> ${escapeHtml(assign.course)}</span>
                        <h3 class="assignment-title">${escapeHtml(assign.title)}</h3>
                        <div class="due-date"><i class="far fa-calendar-alt"></i> Due: ${dueDateFormatted}</div>
                    </div>
                    <div class="card-details">
                        <div class="detail-row">
                            <span class="detail-label"><i class="fas fa-star"></i> Points</span>
                            <span class="points">${assign.points} pts</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label"><i class="fas fa-info-circle"></i> Description</span>
                            <span style="text-align: right; max-width: 60%;">${escapeHtml(assign.description)}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label"><i class="fas fa-flag-checkered"></i> Status</span>
                            <span class="status ${statusClass}"><i class="${isSubmitted ? 'fas fa-check-circle' : 'far fa-hourglass'}"></i> ${statusText}</span>
                        </div>
                        ${isSubmitted ? `<div class="detail-row"><span class="detail-label"><i class="fas fa-paperclip"></i> Submitted file</span><span style="font-size:0.75rem;">${escapeHtml(submittedFile)}</span></div>` : ''}
                    </div>
                    <div class="card-actions">
                        ${!isSubmitted ? `
                            <div class="file-input-wrapper">
                                <label class="file-label" for="file-${assign.id}">
                                    <i class="fas fa-upload"></i> Choose PDF file
                                </label>
                                <input type="file" id="file-${assign.id}" accept=".pdf,application/pdf" style="display:none;" />
                                <div id="fileName-${assign.id}" class="file-name"></div>
                            </div>
                            <button class="submit-btn" id="submitBtn-${assign.id}" disabled><i class="fas fa-paper-plane"></i> Submit Assignment</button>
                        ` : `
                            <button class="submit-btn" id="resubmitBtn-${assign.id}" style="background: #e0e7ff; color: #00509E; border: 1px solid #4D8FCC;"><i class="fas fa-sync-alt"></i> Resubmit (replace PDF)</button>
                            <div class="resubmit-note"><i class="fas fa-info-circle"></i> Upload new PDF to replace previous submission</div>
                        `}
                    </div>
                </div>
            `;
        });

        container.innerHTML = cardsHtml;

        // attach event listeners for each assignment
        assignmentsData.forEach(assign => {
            const isSubmitted = !!submissions[assign.id];

            if (!isSubmitted) {
                const fileInput = document.getElementById(`file-${assign.id}`);
                const submitBtn = document.getElementById(`submitBtn-${assign.id}`);
                const fileNameSpan = document.getElementById(`fileName-${assign.id}`);

                if (fileInput && submitBtn) {
                    let selectedFile = null;
                    fileInput.addEventListener('change', (e) => {
                        const file = e.target.files[0];
                        if (file) {
                            if (file.type === 'application/pdf') {
                                selectedFile = file;
                                fileNameSpan.textContent = `📄 ${file.name}`;
                                submitBtn.disabled = false;
                            } else {
                                fileNameSpan.textContent = '❌ Only PDF files allowed';
                                selectedFile = null;
                                submitBtn.disabled = true;
                                fileInput.value = '';
                            }
                        } else {
                            selectedFile = null;
                            fileNameSpan.textContent = '';
                            submitBtn.disabled = true;
                        }
                    });

                    submitBtn.addEventListener('click', () => {
                        if (selectedFile) {
                            submitAssignment(assign.id, selectedFile);
                            // reset file input for that card after submission? not needed because re-render will replace card.
                        } else {
                            showToast("Please select a PDF file first.", true);
                        }
                    });
                }
            } else {
                // resubmit button: allow replace
                const resubmitBtn = document.getElementById(`resubmitBtn-${assign.id}`);
                if (resubmitBtn) {
                    // Create temporary file input for resubmission
                    const tempInput = document.createElement('input');
                    tempInput.type = 'file';
                    tempInput.accept = '.pdf,application/pdf';
                    tempInput.style.display = 'none';
                    document.body.appendChild(tempInput);

                    resubmitBtn.addEventListener('click', () => {
                        tempInput.click();
                    });

                    tempInput.addEventListener('change', (e) => {
                        const file = e.target.files[0];
                        if (file) {
                            if (file.type === 'application/pdf') {
                                // overwrite submission
                                submissions[assign.id] = {
                                    fileName: file.name,
                                    submittedAt: new Date().toISOString(),
                                    status: "submitted"
                                };
                                saveSubmissions();
                                showToast(`🔄 Updated submission: ${file.name}`, false);
                                renderAll();
                            } else {
                                showToast("❌ Only PDF files are accepted.", true);
                            }
                        }
                        tempInput.value = '';
                        document.body.removeChild(tempInput);
                    });
                }
            }
        });

        // update stats
        const submittedCount = Object.keys(submissions).length;
        document.getElementById('submittedCount').innerText = `${submittedCount} / ${assignmentsData.length}`;
    }

    // helper to escape HTML
    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/[&<>]/g, function(m) {
            if (m === '&') return '&amp;';
            if (m === '<') return '&lt;';
            if (m === '>') return '&gt;';
            return m;
        }).replace(/[\uD800-\uDBFF][\uDC00-\uDFFF]/g, function(c) {
            return c;
        });
    }

    // init
    loadSubmissions();
    renderAll();
</script>
</body>
</html>